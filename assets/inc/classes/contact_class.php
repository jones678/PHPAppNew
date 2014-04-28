<?
//\\isat-cit.marshall.edu\shj$
	class contact extends database
	{
	
		//constructor function
		public function __construct()
		{	
			database::__construct();
		}
		
		function printContact($ContactID)
		{
			$result = database::query("*","contact", "CID=" . $ContactID);
			$row = mysqli_fetch_array($result);
			
			echo "Contact: " . $row[CFName] . " " . $row[CLName] . "</br>";
			echo "Image Path: ";
				//If there is no image, go to default picture path
				if(!$row[CImage])
				{
					echo "There is no image</br>";
				}
				else //else if there is an image, show the appropriate image
				{
					echo "There is an image<img src='img/" . $row[CImage] . "' alt='Picture'></br>";
				}
			
			echo "Group ID: ";
				//If there is a group ID, show what groups contact belongs to,
				if(!$row[GID])
				{
					echo "This contact doesn't have any groups</br>";
				}
				else
				{
					echo "This contact does have groups</br>";
				}
				//show capability to add client to group and/or create a new group for the client
			
			//This is the print out of phone info
			$resultp = database::query("*","phone", "CID=" . $ContactID);
						
			while ($row = mysqli_fetch_array($resultp))
			{						
				echo "Phone: " . $row[Pphone] . " (" . $row[PType] . ")</br>";
					
			}//end while for phone query
			//Need to: show capability to add another phone
			
			//This is the print out of the e-mail info
			$resulte = database::query("*","email", "CID=" . $ContactID);
						
			while ($row = mysqli_fetch_array($resulte))
			{						
				echo "E-mail: " . $row[CEmail] . " (" . $row[EType] . ")</br>";
					
			}//end while for email query
			//Need to: show capability to add another e-mail

			//This is the print out of the website info
			$resultw = database::query("*","website", "CID=" . $ContactID);
						
			while ($row = mysqli_fetch_array($resultw))
			{						
				echo "Website: " . $row[WURL] . "</br>";
					
			}//end while for website query
			//Need to: show capability to add another e-mail

			//This is the print out of the address info
			$resulta = database::query("*","address", "CID=" . $ContactID);
						
			while ($row = mysqli_fetch_array($resulta))
			{						
				echo $row[AType] . "Address: " . $row[Astreet] . "</br>";
				echo $row[Acity] . ", " . $row[Astate] . " " . $row[Azip] . "</br>";
					
			}//end while for email query
			//Need to: show capability to add another e-mail
			
		}
		
		//function to populate the contacts
		function populateContactsList($userID)
		{	
			echo "Contacts for User: " . $userID . "</br>";
			//query with select * from contacts where userID.. sort by CLName.
			$result = database::query("*","contact", "UID=" . $userID, "CLName");
						
			while ($row = mysqli_fetch_array($result))
			{	
				echo "This is the contact div start: <div class='contact'>";//start contact div
					
					echo "Contact: " . $row[CFName] . " " . $row[CLName] . "</br>";
					
					echo "CID: " . $row[CID] . "</br>";
				echo "This is the contact div ending:</div>";//end contact div
			}//end while for contact query
			echo "End of contacts for User: " . $userID;
		}

		
		function populateContactsList1($userID,$sortOn="first")
		{
			if($sortOn != "first"){$sort = "CLName";}//sets the criteria to sort on
			else {$sort = "CFName";}
			echo "Contacts for User: " . $userID . "</br>";
			echo '<table><thead><th>First Name</th><th>Last Name</th></thead>';// prints head of the table
		
			//query with select * from contacts where userID.. sort by CLName.
			$result = database::query("*","contact", "UID=" . $userID, $sort );// query the database for the userID and either sort on first or last name
				while ($row = mysqli_fetch_array($result))// processes results
				{
					if(!$temp){$temp = $row[$sort]; echo '<tr><td>'.$temp[0].'</td></tr>';}// temp is used to determine letter of contacts
				// and to determine if letters have changed
				if( strncmp ( $temp, $row[$sort] , 1 ) < 0){// compares the first letter name. 
				$temp = $row[$sort];
				echo "<tr><td>" . $temp[0] . "</td></tr>";}
				echo "<tbody><tr><td><a href='detail.php?cID=" . $row[CID] . "'> " . $row[CFName] . "</a></td><td>" . $row[CLName] . "</td></tr></tbody>";

				$temp = $row[$sort];
				}//end while for contact query
			echo"</table>";
		}// end populateContactsList
		
		
		function printPagination($numResultAll, $numResult, $page, $catID, $sort, $search, $prange, $rate)
		{			
			if ($numResultAll && $numResult && $page && $sort)
			{		
				echo "<ul class='pager'>";
					echo ($page==1 ? "" : " <li><a href='" . $_SERVER[PHP_SELF] . "?page=" . ($page-1) . ($catID ? "&amp;catID=" . $catID : "") . "&amp;sort=" . $sort . ($search ? "&amp;searchBox=" . $search : "") . ($prange ? "&amp;prange=" . $prange : "") . ($rate ? "&amp;rate=" . $rate : "") . "'>&laquo; Previous</a></li>");
					echo "<li> Page " . $page . " of " . ceil($numResultAll/PAGINATION) . " </li>";
					echo ($page != ceil($numResultAll/PAGINATION) ? "<li><a href='" . $_SERVER[PHP_SELF] . "?page=" . ($page+1) . ($catID ? "&amp;catID=" . $catID : "") . "&amp;sort=" . $sort . ($search ? "&amp;searchBox=" . $search : "") . ($prange ? "&amp;prange=" . $prange : "") . ($rate ? "&amp;rate=" . $rate : "") . "'>Next &raquo;</a></li>" : "");	
				echo "</ul>";
			}
			else
			{
				echo "There are no products that fall in this search.  Please try a different search.";
			}	
		}
		
		function printNumRecords($numResultAll, $numResult, $page)
		{			
			If ($page == 1)
			{
				echo "<div class='results'>Showing " . $page . " - " . ($numResult) . " of " . $numResultAll . " Results</div>";
			}
			else
			{
				//  showing 10-19 (page2) out of all of the results
				echo "<div class='results'><p>Showing " . (($page - 1)*PAGINATION + 1) . " - " . (($page-1)*PAGINATION+$numResult) . " of " . $numResultAll . " Results</p></div>";
			}
		}
		
		function printSort($catID, $page, $sort, $search, $prange, $sale)
		{
			echo "<div class='pull-right'>Sort by: ";
			//echo "Search string = " . $search;
			if(!$search)
			{
				//echo "<select name='order' onChange=\"window.location.search='&order='+this.value\">";
				echo "<select name='sort' onChange=\"window.location.search=" . "'catID=" . $catID . ($prange ? "&prange=" . $prange : "") . ($sale==Y ? "&sale=Y" : "") . "&page=" . $page . "&sort='+this.value\">";
			}
			else
			{
				echo "<select name='sort' onChange=\"window.location.search=" . "'searchBox=" . $search . ($prange ? "&prange=" . $prange : "") . ($sale==Y ? "&sale=Y" : "") . "&page=" . $page . "&sort='+this.value\">";
			}
			echo "<option value='pro_name' " . ($sort =='pro_name' ? "selected='selected'" : "") . ">Product Name</option>";
			echo "<option value='pro_price_up' " . ($sort =='pro_price_up' ? "selected='selected'" : "") . ">Price: Low to High</option>";
			echo "<option value='-pro_price' " . ($sort =='-pro_price' ? "selected='selected'" : "") . ">Price: High to Low</option>";
			echo "<option value='rate_up' " . ($sort =='rate_up' ? "selected='selected'" : "") . ">Rating: Low to High</option>";
			echo "<option value='rate_down' " . ($sort =='rate_down' ? "selected='selected'" : "") . ">Rating: High to Low</option>";
			
			echo "</select>";
						
			echo "</div>"; //end the sort div
		}
		
		function addVote($voted, $id)
		{
							//this is the code to process the voting (if it has been done)...
										 
					 //If the user has already voted on the particular thing, we do not allow them to vote again 	$cookie = "Mysite$id"; 
					 //commenting out cookie...
					/*	
						if(isset($_COOKIE[$cookie])) 
							{ 
							Echo "Sorry You have already ranked that site <p>"; 
							} 
					 
					 //Otherwise, we set a cooking telling us they have now voted 
						else 
							{ 
							$month = 2592000 + time(); 
							setcookie(Mysite.$id, Voted, $month); 
					*/
							//Then we update the voting information by adding 1 to the total votes and adding their vote (1,2,3,etc) to the total rating 
					database::create("REVIEW", "REV_ID, REV_RATING, PRO_ID, USER_ID","null, $voted, $id, null");
					echo "**Your vote has been cast**<br />";
					//("REVIEW","REV_ID, REV_RATING, PRO_ID, USER_ID","null,'3','1', null")
					//commenting out original:
					//mysql_query ("UPDATE vote SET total = total+$voted, votes = votes+1 WHERE id = $id"); 
					//		Echo "Your vote has been cast <p>"; 
					//		} 
					 
		}
	/*
	 * uploadFiles function accepts two parameters. The first parameter
	 * is the destination directory that the file is to reside in.
	 * If this directory does not exists, it will be created.
	 * The second parameter is the name given to the 
	 * input that will pass the file name.
	 */
	function uploadFiles($destinationDir, $inputName){
		 //$dir = $destinationDir;
 			// create new directory with 744 permissions if it does not exist yet
			// owner will be the user/group the PHP script is run under
			if (!file_exists($destinationDir)) {
				mkdir($destinationDir, 0744);
			}
			if(move_uploaded_file($_FILES[$inputName]['tmp_name'], $destinationDir."/{$_FILES[$inputName] ['name']}")){
				echo"upload successful!";
			}
	}// end uploadFiles function
	
		//deconstructor function
		public function __destruct()
		{
			database::__destruct();
		}
	
	}

?>