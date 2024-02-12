<?php
/*------------**connectServer**-----------------*/
function connectServer($host,$log,$pass,$mess)

{ 
	$dbc=@mysqli_connect($host,$log,$pass) 
	  or die("connection error:".@mysqli_errno($dbc).
	         ": ".@mysqli_error($dbc)
			 );
	
	//if($mess == 1)	print '<p>Successfully connected to MySQL!</p>';
	return $dbc;
}
function selectDB($dbc, $db, $mess)
{
	mysqli_select_db($dbc ,$db) 
	 or die ('<p style="color: red;">'.
			 "Could not select the database ".$db.
			 "because:<br/>".mysqli_error($dbc).
			 ".</p>");
	
	//if ($mess == 1) echo "<p>The database $db has been selected.</p>";
}

//------------**insertDataToTab**-----------------
 function insertDataToTab($dbc, $Tab, $query)
 {
   echo "added";
      @mysqli_query($dbc,$query) 
      or die ("DB Error: Could not insert $Tab! <br>".
 			  @mysqli_error($dbc));
   
      print( "<h2 style = 'color: blue'> The $Tab was added successfully! </h2>");	
 }


?>