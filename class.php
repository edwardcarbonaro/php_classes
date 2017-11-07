<?php

$servername = "sql.njit.edu";
$username = "ejc23";
$password = "carabao74";


class User{	
	var $conn;
	public function __construct($servername,$username,$password,$conn){
		
		$this->conn = new PDO("mysql:host=$servername;dbname=ejc23", $username, $password);		
	}

	public function runQuery($query) {
		// $this->conn = $conn;
		try {
			$q = $this->conn->prepare($query);
			$q->execute();
			$results = $q->fetchAll();
			$q->closeCursor();
			return $results;
		}
		catch (PDOException $e) {
			$this->http_error("500 Internal Server Error\n\n"."There was a SQL error:\n\n" . $e->getMessage());
		}	  
	}

	public function http_error($message){
		header("Content-type: text/plain");
		die($message);
	}


	public function displayUser(){
		$sql = "select id,email,fname,password from accounts";
		$results = $this->runQuery($sql);
		print_r($results);
		// if(count($results) > 0){
		// 	echo ("<table border=\"1\"><tr><th>ID</th><th>Email</th><th>First Name</th><th>Pass</th></tr>");
		// 	foreach ($results as $row) {
		// 		echo ("<tr><td>".$row["id"]."</td><td>".$row["email"]."</td><td>".$row["fname"]."</td><td>".$row["password"]."</td></tr>");
		// 	}
		// }
		// else{
		// 	echo '0 results';
		// }
	}

	public function deleteUser(){
		$fname = 'Bongo';
		$sql ="delete from accounts where fname = '$fname' ";
		$results = runQuery($sql);
		//header("Location: test.php");
		
	}

	public function insertUser(){
		$date = date('Y-m-d',time());
		$sql = "insert into accounts (email, fname, lname,phone, birthday,
		gender,password) values ('yz746@njit.edu','Bongo', 'Zhao','911','$date','Male','1234');";
		$results = runQuery($sql);
		return $results;

		//header("Location: test.php");
		
	}

	public function updateUser(){
		$fname = 'Bongo';
		$sql ="update accounts set password = '4321' where fname = '$fname' ";
		$results = runQuery($sql);
		return $results;
		// header("Location: test.php");
		
	}

	

}	

$user1 = new User($servername,$username,$password);
print_r($user1);
$user1->displayUser();

echo "<br>";

$user2 = new User($servername,$username,$password);
print_r($user2);

//echo $user1->displayUser();



?>