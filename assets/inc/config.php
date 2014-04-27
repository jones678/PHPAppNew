<?
	session_start();
	
	function __autoload($class)
	{
		include_once("classes/" . $class . "_class.php");
	}

	define(DB_USER, "shj");
	define(DB_PASS, "shj");
	define(DB_HOST, "isat-cit.marshall.edu");
	define(DB_PORT, 3306);
	define(DB_DB, "shj");

	// define a pagination limit
	define(PAGINATION, 10);
	
	
	if ($_POST[username])
	{
		//validate login attempt
		$username = $_POST["username"]; //Storing username in $username variable.
		$password = $_POST["password"]; //Storing password in $password variable.
		
		$usr = new user;
		//validate the username, password
		if ($usr->validateUser($username, $password) == false)
		{
			//need to do some work here!
			
			//handle the invalid attempt
			
			
			
		}
		else{
		// after all DB validations of login attempt
		$_SESSION['user'] = $_POST[username];
		setcookie("USER", $_POST[username], time()+3600);
		setcookie("CARTID", session_id(), time()+3600);	
		
		//This is where I am trying to have the UID in the session.
		$email = $_SESSION['user'];
			
		$db = new database;
		
		$res = $db->query("*","user", "UserName = '$email'");
		$row = mysqli_fetch_array($res);
		
		$id = $row[UID];
		
		$_SESSION['UserID'] = $id;
		
		}
	}
/*	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DB);

	// test your connection
	if (!$conn)
		die("BAD CONNNECTION.");
	
	// issue a query, which returns a resource to the results of that query
	$query = "SELECT * from USER";
	$res = mysqli_query($conn, $query);
		
	//check for errors in query - don't output errors in production
	if (!$res)
		die ("Bad query." . mysqli_error($conn));
	
	//$res holds all of the rows that are returned from our query.
	//see how many records were returned in a given resource
	echo "ROWS RETURNED: " . mysqli_num_rows($res) . "<br />";
	
	//how many fields we have
	echo "FIELDS IN RESULT: " . mysqli_num_fields($res) . "<br />";
	
	//show the names of those fields
	echo "NAMES OF FIELDS:<br />";
	for ($i=0; $i<mysqli_num_fields($res); $i++)
	{
		$field = mysqli_fetch_field($res);
		echo $field->name . "<br / >";
	}
	
	//show all of the rows
	for ($i=0; $i<mysqli_num_rows($res); $i++)
	{
		$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
		print_r($row);
	}
	
	// Do a new query, generate a table of data
	$query = "select * from USER";
	$res2 = mysqli_query($conn, $query);
	
	// create a table and output the contents of the query
	$currentRow = 1;
	echo "<table border=1><thead>";
	while ($row = mysqli_fetch_array($res2, MYSQLI_ASSOC)) //while there are more rows to grab...
	{
		echo "<tr>";
		if ($currentRow == 1)
		{
			// output the header row
			foreach($row as $key=>$value)
				echo "<th>$key</th>";
		}
		
		if ($currentRow++ == 1)
			echo "<tr></thead><tbody><tr>";
			
		foreach($row as $key=>$value)
			echo "<td>$value</td>";
		echo "</tr>";
	}
	echo "</tbody></table>";
*/
?>