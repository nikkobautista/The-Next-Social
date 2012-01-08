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
		
		$user = Doctrine_Core::getTable('Model_User')->findOneByEmailAndPassword('new_user_2@test.local', 'test');
		$user->password = 'new_password';
		$user->save();
	}
}

