<?php
class Application_Model_User
{
	//declare the user's attributes
	private $id;
	private $email;
	private $password;
	private $salt;
	private $date_created;
	
	//upon construction, map the values
	//from the $user_row if available
	public function __construct($user_row = null)
	{
		if( !is_null($user_row) && $user_row instanceof Zend_Db_Table_Row ) {
			$this->id = $user_row->id;
			$this->email = $user_row->email;
			$this->password = $user_row->password;
			$this->salt = $user_row->salt;
			$this->date_created = $user_row->date_created;
		}
	}
	
	//magic function __set to set the
	//attributes of the User model
	public function __set($name, $value)
	{
		switch($name) {
			case 'id':
				//if the id isn't null, you shouldn't update it!
				if( !is_null($this->id) ) {
					throw new Exception('Cannot update User\'s id!');
				}
				break;
			case 'date_created':
				//same goes for date_created
				if( !is_null($this->date_created) ) {
					throw new Exception('Cannot update User\'s date_created');
				}
				break;
			case 'password':
				//if you're updating the password, hash it first with the salt
				$value = sha1($value.$this->salt);
				break;
		}
		
		//set the attribute with the value
		$this->$name = $value;
	}
	
	public function __get($name)
	{
		return $this->$name;
	}
}