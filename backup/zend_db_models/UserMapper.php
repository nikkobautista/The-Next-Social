<?php
class Application_Model_UserMapper
{
	protected $_db_table;
	
	public function __construct()
	{
		//Instantiate the Table Data Gateway for the User table
		$this->_db_table = new Application_Model_DbTable_User();
	}
	
	public function save(Application_Model_User $user_object)
	{
		//Create an associative array
		//of the data you want to update
		$data = array(
			'email' => $user_object->email,
			'password' => $user_object->password,
		);
		
		//Check if the user object has an ID
		//if no, it means the user is a new user
		//if yes, then it means you're updating an old user
		if( is_null($user_object->id) ) {
			$data['salt'] = $user_object->salt;
			$data['date_created'] = date('Y-m-d H:i:s');
			$this->_db_table->insert($data);
		} else {
			$this->_db_table->update($data, array('id = ?' => $user_object->id));
		}
	}
	
	public function getUserById($id)
	{
		//use the Table Gateway to find the row that
		//the id represents
		$result = $this->_db_table->find($id);
		
		//if not found, throw an exsception
		if( count($result) == 0 ) {
			throw new Exception('User not found');
		}
		
		//if found, get the result, and map it to the
		//corresponding Data Object
		$row = $result->current();
		$user_object = new Application_Model_User($row);
		
		//return the user object
		return $user_object;
	}
}

