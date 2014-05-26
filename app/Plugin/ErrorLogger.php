<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 19/5/14
 * Time: 7:09 PM
 * To change this template use File | Settings | File Templates.
 */
App::uses('ErrorLogger', 'Error');
class ErrorLogger extends ErrorHandler
{
    public static $errorLog = null;
    public static function onError($type, $message, $file=null, $line=null, $context = null, $x = null)
    {
        echo "hiii";
        die();
        $errorLog = new ErrorLogger();

        if(!empty($message))
        {
            $message = '??? Dont know about error ???';
        }

        list($errorType, $log) = parent::mapErrorCode($type);
        $errorLog->controller->redirect(array('controller' => 'errors', 'action' => 'error'));

        $stackTrace = '';

        $errorLog->addLog($message, $type, $stackTrace, $file, $line, $context, $x);

//        parent::handleError($type, $message, $file, $line, $context, $x);
    }

    public static function onException(Exception $e)
    {
        echo "hiii";
        die();
        $errorLog = new ErrorLogger();

        if(!empty($message))
        {
            $message = '??? Dont know about error ???';
        }

        list($errorType, $log) = parent::mapErrorCode($type);
        $errorLog->controller->redirect(array('controller' => 'errors', 'action' => 'error'));

        $stackTrace = '';

        $errorLog->addLog($message, $type, $stackTrace, $file, $line, $context, $x);

        parent::handleError($type, $message, $file, $line, $context, $x);
    }
}
