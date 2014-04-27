<?
//\\isat-cit.marshall.edu\stinson14$
	class user extends database
	{
	
		//constructor function
		public function __construct()
		{	
			database::__construct();
		}
				
		function validateUser($username, $password)
		{			
			$result = database::query("*","USER"," UserName='" . $username . "' AND Upassword='" . $password . "'");
			$numRows = database::countrows($result);
			
			//if there is a user with that ID and password in the user table...
			if ($numRows >= 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		//deconstructor function
		public function __destruct()
		{
			database::__destruct();
		}
	
	}

?>