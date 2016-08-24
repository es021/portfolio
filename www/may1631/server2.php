<?php

	$cmd = $_REQUEST['cmd'];
	$id = $_REQUEST['id'];
	
	if($cmd == 'get')
	{
		echo 'Get request received';
	}
	else if($cmd == 'post')
	{
		echo 'Post request received';
	}
	else if($cmd == 'validate')
	{
		#$pass = $_REQUEST['pass'];
		echo validate($id);
	}
	else if($cmd == 'insert_user')
	{
		$table = $_REQUEST['table'];
		$values = array();
		$f_name = $_REQUEST['f_name'];
		$l_name = $_REQUEST['l_name'];
		$email = $_REQUEST['email'];
		$gender = $_REQUEST['gender'];
		
		array_push($values, $id, $f_name, $l_name, $email, $gender);
		insert($table,$values);
	}
	else if($cmd == 'insert_trans')
	{
		//echo "inserting transaction\n";
		$user_id = $_REQUEST['user_id'];
		$video_feeds = $_REQUEST['video_feeds'];
		$tools_taken = $_REQUEST['tools_taken'];
		$tools_returned = $_REQUEST['tools_returned'];
		$drawers_opened = $_REQUEST['drawers_opened'];
		$values = array();
		
		array_push($values, $user_id, $video_feeds, $tools_taken, $tools_returned, $drawers_opened);
		$table = 'transactions';
		//var_dump($values);
		insert($table,$values);
		
		
	}
	else
	{
		echo 'Error : Command not valid';
	}

	
	function insert($table, $values) 
	{
		$conn = db_connect();
		db_insert($conn,$table,$values);
		$conn->close();
		//return $json;
	}
	
	//check $id with database
	//return json object
		//status 1 for successfull with f_name and l_name
		//status 0 for failed
	function validate($id) 
	{
		$conn = db_connect();
		$json = db_select($conn,"users","student_id",$id);
		$conn->close();
		return $json;
	}
	
	function db_connect()
	{
		$servername = "sql5.freesqldatabase.com";
		$username = "sql5104477";
		$password = "9XUcya9tVl";
		$dbname = "sql5104477";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}	
		//echo "Connected successfully \n";
		return $conn;
	}
	
	//function db_select($table, $column, $key, $value)
	function db_select($conn,$table,$key,$value)
	{
		$sql = "SELECT * FROM ".$table." WHERE ".$key." = '".$value."'";
		$result = $conn->query($sql);
		//echo "Num Rows Return : ".$result->num_rows."\n"; 
		if($result->num_rows)
		{
			$row = $result->fetch_assoc();
			//$row["id"]
			$arr = array('status' => 1, 'id' => $row["id"], 'f_name' => $row["first_name"], 'l_name' => $row["last_name"]);
			return json_encode($arr);
			#echo "\nWelcome ".$row["first_name"]." ".
			#$row["last_name"]."\n";
		}
		else
		{
			$arr = array('status' => 0);
			return json_encode($arr);
		}
		
	}
	
	function db_insert($conn,$table,$values)
	{
		//$sql = "SELECT * FROM ".$table." WHERE ".$key." = '".$value."'";
		//$result = $conn->query($sql);
		
		if($table == "users")
		{
			$sql = "INSERT INTO user (id, first_name, last_name, email, gender)
			VALUES ('".
			$values[0]. "', '" .
			$values[1]. "', '" .
			$values[2]. "', '" .
			$values[3]. "', '" .
			$values[4]. "')";
			
			echo $sql."\n";
			
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully\n";
			} 
			else 
			{
				echo "Error: " . $sql . "\n" . $conn->error;
			}
			
		}
		
		else if($table == "transactions")
		{
			//echo("inserting stuff\n");
			$created_at = date("Y-m-d H:i:s");
			
			$sql = "INSERT INTO transactions (user_id, video_feeds, tools_taken, tools_returned, drawers_opened, created_at)
			VALUES ('".
			$values[0]. "', '" .
			$values[1]. "', '" .
			$values[2]. "', '" .
			$values[3]. "', '" .
			$values[4]. "', '" .
			$created_at. "')";
			
			//echo $sql."\n";
			
			//$status = "";
			
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully\n";
				//status = "New record created successfully\n";
			} 
			else 
			{
				echo "Error: " . $sql . "\n" . $conn->error;
				//status = "Error: " . $sql . "\n" . $conn->error;
			}
			
			//$arr = array('status' => $status);
			//echo json_encode($arr);	
			
			
		}
	}
	
?>