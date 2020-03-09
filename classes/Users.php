<?php 

class Users
{
	protected $collection_users;

	public function __construct($collection_users)
		{
			$this->collection_users = $collection_users;
		}


	public function checkInput($var)
	{
		$var = htmlspecialchars($var);
		$var = trim($var);
		$var = stripslashes($var);

		return $var;
	}

	public function register($username, $password, $email, $address)
	{
		$document = $this->collection_users->insertOne([

			'username'=>$username,
			'password'=>$password,
			'email'=>$email,
			'address' => $address,
			'admin'=>'no'
			
		]);

		$_SESSION['user_id'] = $document->getInsertedId();
	}

	public function userData($userId)
	{
		$document = $this->collection_users->findOne(["_id" => new MongoDB\BSON\ObjectID($userId)]);

		return $document;
	}
 

 	public function logout() {

		$_SESSION = array();

		session_destroy();

		header('Location: index.php');

	}


	public function login($username, $password) {

		$document = $this->collection_users->findOne(
			['username' => $username, 'password' => $password],
			['projection' => ['_id'=>1] ]

			);

		if(!empty($document->_id)) {
				$_SESSION['user_id'] = $document->_id;
			}

		else {
			return false;
			}

	}

	public function checkAdmin($username, $password) {

		$document = $this->collection_users->findOne(
			['username' => $username, 'password' => $password],
			['projection' => ['_id'=>1, 'admin'=>1] ]

			);

		if(!empty($document->_id)) {
			if($document->admin == 'yes' ) {
					$_SESSION['admin_id'] = $document->_id;
			} 
		}

		else {
			return false;
		}

	}
}
 ?>