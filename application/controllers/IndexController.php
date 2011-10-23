<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
		$this->view->current_date_and_time = date('M d, Y - H:i:s');
    }


}

