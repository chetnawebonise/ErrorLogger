<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 3/6/14
 * Time: 4:32 PM
 * To change this template use File | Settings | File Templates.
 */

App::uses('ErrorLoggersAppModel', 'ErrorLoggers.Model');
class ErrorLogger extends ErrorLoggersAppModel {

    public function addLog($message, $type, $stackTrace, $file, $line, $context, $x)
    {
        $validFields = array(
            'file',
            'line',
            'function',
            'class'
        );
        $toReturn    = array();

        foreach ($stackTrace as $backtraceLevel) {
            $data = array();
            foreach ($backtraceLevel as $key => $value) {
                if (in_array($key, $validFields)) {
                    $data[$key] = $value;
                }
            }
            $toReturn[] = $data;
        }

        $data = array(
            'message' => $message,
            'type' => $type,
            'fileName' => $file,
            'lineNo' => $line,
            'x' => $x,
            'stackTrace' => serialize(json_encode($toReturn))
        );

        $this->create();
        return $this->save($data);
    }
}