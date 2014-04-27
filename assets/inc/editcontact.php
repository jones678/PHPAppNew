<?php 
session_start();
include("config.php"); //including config.php in our file

if ($_POST)
	{
		$id = $_SESSION['UserID']; //Storing UID in $id variable.
		$fname = $_POST["fname"]; //Storing first name in $fname variable.
		$lname = $_POST["lname"]; //Storing last name in $lname variable.

		$db = new database;

		echo "HI";
		echo "# of phone numbers: " . count($_POST[phone]) . "<br />";
		foreach ($_POST[phone] as $key=>$value)
			echo "PHONES: " . $value . "<br />";
                               

		//check if the e-mail exists...
		/*old stuff from adduser.php
		$res = $db->query("*","user", " UserName = '$email'");

		if ($db->countrows($res) > 0) {


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
		
		
		}*/


	}
?>