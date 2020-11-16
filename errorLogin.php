<?php 
@session_start();

$_SESSION['lastpage'] = $_SERVER['PHP_SELF'];


if(!isset($_SESSION['nickName'])){
				
		include ('./header.inc');
		 	   
	       echo '<center><p>you are not logged please login <a href="login.php">Here</a></p></center>';						   
		
	    include('./footer.inc');
				 
					 
 }


?>