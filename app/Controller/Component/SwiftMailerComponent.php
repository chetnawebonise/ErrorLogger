<?php

App::import('Vendor', 'Swift', array('file' => 'Swift-5.0.1' . DS . 'lib' . DS . 'swift_required.php'));

class SwiftMailerComponent extends Object
{

    var $controller = false;
    public $layout = 'Emails';
    public $viewPath = '/Emails';
    var $from = null;
    var $fromName = null;
    var $to = null;
    var $toName = null;

    function startup(&$controller)
    {
        $this->controller = & $controller;
    }

    function initialize(&$controller)
    {
        $this->controller =& $controller;
    }

    function beforeRender()
    {

    }

    function beforeRedirect()
    {

    }

    function shutdown()
    {

    }

    function _getBodyText($view)
    {
        // Temporarily store vital variables used by the controller.
        $tmpLayout = $this->controller->layout;
        $tmpAction = $this->controller->action;
        $tmpOutput = $this->controller->output;
        $tmpRender = $this->controller->autoRender;

        // Render the plaintext email body.
        ob_start();
        $this->controller->output = null;

        $body = $this->controller->render($this->viewPath . DS . 'text' . DS . $view . '_text', $this->layout . DS . $view . '_text');
        ob_end_clean();

        //Restore the layout, view, output, and autoRender values to the controller.
        $this->controller->layout = $tmpLayout;
        $this->controller->action = $tmpAction;
        $this->controller->output = $tmpOutput;
        $this->controller->autoRender = $tmpRender;

        return $body;
    }

    function _getBodyHTML($view)
    {

        // Temporarily store vital variables used by the controller.
        $tmpLayout = $this->controller->layout;
        $tmpAction = $this->controller->action;
        $tmpOutput = $this->controller->output;
        $tmpRender = $this->controller->autoRender;

//        pr($this->viewPath . DS .'html' . DS .$view . '_html');
//        pr($this->layout . DS . $view . '_html');

        ob_start();
        $this->controller->output = null;
        $body = $this->controller->render($this->viewPath . DS . 'html' . DS . $view, $this->layout . DS . 'html' . DS . 'default');
        ob_end_clean();

        // Restore the layout, view, output, and autoRender values to the controller.
        $this->controller->layout = $tmpLayout;
        $this->controller->action = $tmpAction;
        $this->controller->output = $tmpOutput;
        $this->controller->autoRender = $tmpRender;

        return $body;
    }

    function send($view = 'default', $subject = '')
    {
     $message = &Swift_Message::newInstance();

        $message->setSubject($subject);


        // Append the HTML and plain text bodies.
//        $bodyHTML = $this->_getBodyHTML($view);
//        $bodyText = $this->_getBodyText($view);

        //$message->setBody($bodyText, "text/plain");
        $message->addPart($view, "text/html");


        // Set the from address/name.
        $message->setFrom(array($this->from => $this->fromName));
        $message->setReplyTo(array($this->from => $this->fromName));
        // Create the recipient list.
        //$recipients =& new Swift_RecipientList();
        $setarray = "";

        if (is_array($this->to)) {
            $recsize = sizeof($this->to);
            for ($i = 0; $i < $recsize; $i++) {
                $setarray[$this->to[$i]] = $this->toName[$i];
            }
        } else {
            $setarray = array($this->to => $this->toName);
        }

        $message->setTo($setarray);

        $transport = Swift_SmtpTransport::newInstance();

        $transport->setHost('localhost');
        $transport->setPort(25);
//        $transport->setEncryption('tls');
        $transport->setUsername('shardul@weboniselab.com'); //shardul@weboniselab.com
        $transport->setPassword('shardul6186'); //shardul6186

//        $transport->setHost('smtp.googlemail.com');
//        $transport->setPort(465);
//        $transport->setEncryption('tls');
//        $transport->setUsername('test.webonise@gmail.com');
//        $transport->setPassword('webonise6186');

        $mailer = Swift_Mailer::newInstance($transport);
        // Attempt to send the email.
        $result = $mailer->send($message);

        return $result;
    }

    public function send_mail($subject = '', $body = '') {
        $this->sendGridUserName = Configure::read('SendGridUserName');
        $this->sendGridPassword = Configure::read('SendGridPassword');

        $message = & Swift_Message::newInstance();

        $message->setSubject($subject);


//        $message->setBody($body, "text/plain");
        $message->addPart($body, "text/html");

        // Set the from address/name.
        $message->setFrom(array($this->from => $this->fromName));
        $message->setReplyTo(array($this->from => $this->fromName));
        // Create the recipient list.
        //$recipients =& new Swift_RecipientList();
        $setArray = "";

        if (is_array($this->to)) {
            $recSize = sizeof($this->to);
            for ($i = 0; $i < $recSize; $i++) {
                $setArray[$this->to[$i]] = $this->toName[$i];
            }
        } else {
            $setArray = array($this->to => $this->toName);
        }

        $message->setTo($setArray);

        $transport = Swift_SmtpTransport::newInstance();

        $transport->setHost('localhost');
        $transport->setPort(25);
        //        $transport->setEncryption('tls');
        $transport->setUsername($this->sendGridUserName);
        $transport->setPassword($this->sendGridPassword);

        $mailer = Swift_Mailer::newInstance($transport);
        // Attempt to send the email.
        $result = $mailer->send($message);

        return $result;
    }

}