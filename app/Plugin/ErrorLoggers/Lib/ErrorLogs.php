<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 19/5/14
 * Time: 7:09 PM
 * To change this template use File | Settings | File Templates.
 */
App::uses('ErrorLogger', 'ErrorLoggers.Model');
App::uses('ErrorLoggersController', 'ErrorLoggers.Controller');
App::import('Component', 'SwiftMailer');
class ErrorLogs extends ErrorHandler
{
//    public static $errorLog = array('ErrorLogger');
    public $components = array('SwiftMailer');
    public $SwiftMailer;
    public function onError($type, $message, $file=null, $line=null, $context = null, $x = null)
    {
//        $errorLog = new ErrorLoggersAppModel();
        $errorLogs = new ErrorLogs();
//        $errorLog = new ErrorLoggersController();
        $errorLog = new ErrorLogger();
//
        if(empty($message))
        {
            $message = '??? Dont know about error ???';
        }

        list($type, $log) = parent::mapErrorCode($type);

        $stackTrace = debug_backtrace();

        echo "<br><br><br><br>";
        echo "Handled Error:--";
        echo "<br>";
        echo "Type:-" . $type;
        echo "<br>";
        echo "File:-" . $file;
        echo "<br>";
        echo "Line:-" . $line;
        echo "<br>";
        echo "Message:-" . $message;
        echo "<br>";
        echo "StackTrace:-" . json_encode($stackTrace);
        echo "<br>";

        $errorLog->addLog($message, $type, $stackTrace, $file, $line, $context, $x);
        $errorLogs->sendEmail($type, $message, $stackTrace);
        echo "<br>===================================================Cake PHP handle Error================";
        parent::handleError($type, $message, $file, $line, $context);
        echo "<br>===================================================End of Cake PHP handle Error=================";
    }

    public function onException(Exception $e)
    {
        $stackTrace = $e->getTrace() ? : debug_backtrace();
        $file      = $e->getFile() ? $e->getFile() : '';
        $line      = $e->getLine() ? $e->getLine() : '';
        $message = $e->getMessage();
        $type = $e->getCode();
        $context = "";
        $x = "";

        $errorLog = new ErrorLoggersAppModel();
        $errorLogs = new ErrorLogs();
        $errorLog->addLog($message, $type, $stackTrace, $file, $line, $context, $x);
        $errorLogs->sendEmail($type, $message, $stackTrace);
        echo "<br>===================================================onException";

        parent::handleException($e);
    }

    public function sendEmail($subject, $message, $stackTrace)
    {
        echo "<br>==========================sending Email===================";
        $errorLogs = new ErrorLogs();
        $this->SwiftMailer = & new SwiftMailerComponent();
        $this->SwiftMailer->smtpType = 'tls';
        $this->SwiftMailer->sendAs   = 'text';
        $this->SwiftMailer->from     = 'chetna.patil@weboniselab.com'; //'crucible@gmail.com';
        $this->SwiftMailer->fromName = 'Chetna';
        $this->SwiftMailer->to       = 'chetna.patil@weboniselab.com';

        $message = array(
            'message' => $message,
            'stackTrace' => $stackTrace
        );

        $formattedMessage = $this->formatMessage($message);

        try {
            if (!$this->SwiftMailer->send_mail($subject, $formattedMessage)) {
                $errorMessage = 'Error occurred while sending Email to : ' . $subject . ' Subject :' . $subject;
                echo "<br>" . $errorMessage;
            }
            else
                echo "<br>Mail Sent successfully";
        }
        catch (Exception $e) {
            echo "<br>Failed to send email: " . $e->getMessage();
        }
    }

    private static function formatMessage($message)
    {
        $data = '<hr>Following error has occurred.<br><br>Error Message: ' . $message['message'];
        $data .= '<br><br>Stacktrace:';
        foreach($message['stackTrace'] as  $key => $index)
        {
            $data .= "<br>" . $key;
            $data .= "<br>" . json_encode($index);
            $data .= "<br><br><br>";
        }

        return $data;
    }
}
