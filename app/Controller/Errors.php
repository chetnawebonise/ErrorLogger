<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 19/5/14
 * Time: 7:34 PM
 * To change this template use File | Settings | File Templates.
 */
class Errors extends AppController
{
    public function errors()
    {
        $this->set(compact('errors'));
    }
}
