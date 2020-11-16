<?php
//session_name('YourVisitID');
session_start();


if(!isset($_SESSION['nickName'])){

   	header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");

	exit();

	}else{

	('despues array>>>>>>>>>'.$_SESSION['nickName']);

	  	$_SESSION = array();

	  	session_destroy();

		setcookie(session_name(), '' , time()-300, '/' , '' , 0);

		}

		$page_title = 'Logout!!!';

		include('./header.inc');

		echo'<p> you are now loged out</p>';

		include('./footer.inc');
?>