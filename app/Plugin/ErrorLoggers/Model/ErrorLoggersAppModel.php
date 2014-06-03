<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 29/5/14
 * Time: 6:33 PM
 * To change this template use File | Settings | File Templates.
 */
App::uses('AppModel', 'Model');

class ErrorLoggersAppModel extends AppModel {

//    public function addLog($message, $type, $stackTrace, $file, $line, $context, $x)
//    {
//        $validFields = array(
//            'file',
//            'line',
//            'function',
//            'class'
//        );
//        $toReturn    = array();
//
//        foreach ($stackTrace as $backtraceLevel) {
//            $data = array();
//            foreach ($backtraceLevel as $key => $value) {
//                if (in_array($key, $validFields)) {
//                    $data[$key] = $value;
//                }
//            }
//            $toReturn[] = $data;
//        }
//
////        echo json_encode($toReturn);
//        $data = array(
//            'message' => $message,
//            'type' => $type,
//            'fileName' => $file,
//            'lineNo' => $line,
//            'x' => $x,
//            'stackTrace' => serialize(json_encode($toReturn))
//        );
//
//        $this->create();
//        return $this->save($data);
//    }
}