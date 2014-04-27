<?
	//require_once ($_SERVER[DOCUMENT_ROOT] . "/ist430/stinson14/project4/assets/inc/config.php");
	
	class database
	{
		
		//Class Constructor - Creates a new MySQLi Object 
        public function __construct()  
        {           
            $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);  
          
			// test your connection
			if (!$this->mysqli)
				die("BAD CONNNECTION.");  
        }  
		
		//this query2 function is for testing purposes only.
		public function query2($string)
		{
		$result = $this->mysqli->query($string);
		
		return $result;
		}
		
		//Query function - to run a query.
		public function query($fields, $from, $where, $order, $limit)
		{
			if (!$where) //if there is NO where parameter...
			{
				$query = "SELECT " . $fields . " FROM " . $from;  
			}
			else //if there IS a where parameter...
			{
				$query = "SELECT " . $fields . " FROM " . $from . " WHERE " . $where; 
				//for testing purposes...
				//echo "$query";
			}
			
			if ($order)
				$query .= " ORDER BY " . $order;

			if ($limit)
				$query .= " LIMIT " . $limit;

			$result = $this->mysqli->query($query);  
			

			
			//here is my echo for troubleshooting purposes.
			//echo $query;
			
			if (!$result)
				die ("Bad query.");
			
			return $result;		
        }
		
		//function to return the number of rows in a resulting query/array
		public function countrows($arr)
		{
			return $arr->num_rows;
		}
		
		//function to return the number of columns in a resulting query/array
		public function countcols($arr)
		{
			return $arr->field_count;
		}
		
		//function to create or add a new record
		public function create($into, $fields, $values)
		{
			$query = "INSERT INTO " . $into . "(" . $fields . ") VALUES(" . $values . ")";
			
			//echo $query;
			
			if ($this->mysqli->query($query))
			{
				//echo "values inserted correctly.";
			} else 
			{
				//echo "inserting didn't work.";
			}
			
		}
			
		//function to upddate a record
		public function update($table, $field, $where)
		{
			$query = "UPDATE " . $table . " SET " . $field . " WHERE " . $where;

			echo $query;
			
			if ($this->mysqli->query($query))
			{
				echo "record updated correctly.";
			} else 
			{
				echo "updating didn't work.";
			}			
		}
		
		//function to delete a record
		public function delete($from, $where)
		{
			$query = "DELETE FROM " . $from . " WHERE " . $where;
					
			if ($this->mysqli->query($query))
			{
				echo "value deleted correctly.";
			} else 
			{
				echo "deleting didn't work.";
			}
		}

		//deconstructor function
		public function __destruct()
		{
			$this->mysqli->close();
		}
	}	

?>  

