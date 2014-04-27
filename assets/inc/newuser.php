<?php 
session_start();
include("config.php"); //including config.php in our file

if ($_POST)
	{

		$email = $_POST["email"]; //Storing email in $email variable.
		$password = $_POST["password"]; //Storing password in $password variable.

		$db = new database;

		//check if the e-mail exists...
		$res = $db->query("*","user", " UserName = '$email'");

		if ($db->countrows($res) > 0) {

		?>
		  <script type="text/javascript">
			alert("The email address <?php echo $_POST['email']; ?> is already registered.");
			history.back();
		  </script>
		<?php
		} else {
	
		// after all DB validations of login attempt
		$db->create("user","UID, UserName, Upassword","null, '$email', '$password'");
		
		$res = $db->query("*","user", " UserName = '$email'");
		$row = mysqli_fetch_array($res);
		
		$id = $row[UID];
		?>
		  <script type="text/javascript">
			alert("The email: <?php echo $_POST['email']; ?> has been added successfully.");
			//history.back();
		  </script>
		<?php
		
		$_SESSION[user] = $_POST[email];
		setcookie("USER", $_POST[email], time()+3600);
		header("location: ../../register.php?adduser=success&newuser=$id");
		
		
		}


	}
?>