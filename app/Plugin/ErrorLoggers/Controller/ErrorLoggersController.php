<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 3/6/14
 * Time: 8:10 AM
 * To change this template use File | Settings | File Templates.
 */

App::uses('ErrorLoggersAppController', 'ErrorLoggers.Controller');
App::uses('ErrorLoggersAppModel', 'ErrorLoggers.Model');

class ErrorLoggersController extends ErrorLoggersAppController {

    public function onError($type, $message, $file=null, $line=null, $context = null, $x = null)
    {

        echo "hiiii=================";
        $this->save($message, $type, $stackTrace, $file, $line, $context, $x);
    }
}