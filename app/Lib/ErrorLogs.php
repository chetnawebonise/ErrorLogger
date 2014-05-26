<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 19/5/14
 * Time: 7:09 PM
 * To change this template use File | Settings | File Templates.
 */
App::import('Vendor', 'Swift', array('file' => 'Swift-5.0.1' . DS . 'lib' . DS . 'swift_required.php'));
App::uses('ErrorLogger', 'Model');
class ErrorLogs extends ErrorHandler
{
    public static $errorLog = array('ErrorLogger');
    public static function onError($type, $message, $file=null, $line=null, $context = null, $x = null)
    {
//        self::loadModel('ErrorLogger');
        $errorLog = new ErrorLogger();

        if(empty($message))
        {
            $message = '??? Dont know about error ???';

            list($errorType, $log) = parent::mapErrorCode($type);

        }


        $stackTrace = debug_backtrace();
        $errorLog->addLog($message, $type, $stackTrace, $file, $line, $context, $x);


        $email = Configure::read('enableEmail');
        if($email['enable'])
        {

            $data = 'Following are the error details<br>';
            $data .= 'URL:-' . FULL_BASE_URL . $_SERVER['REQUEST_URI'];
            $data .= 'Details:-' . $message;

            $transport  = Swift_SmtpTransport::newInstance($email['host'], $email['port'])
                ->setUsername(Configure::read('UserName'))
                ->setPassword(Configure::read('Password'));
            $mailer = Swift_Mailer::newInstance($transport);
            $emailDetails = Configure::read('emailDetails');
            // Create a message
            $message = Swift_Message::newInstance($message)
                ->setFrom(array($email['sender_email'] => $email['sender_name']))
                ->setTo(array($emailDetails['receiver_email'], $emailDetails['receiver_email'] => $emailDetails['receiver_name']))
                ->setBody($data, 'text/html');

            // Send the message
            $result = $mailer->send($message);
        }
    }
}
