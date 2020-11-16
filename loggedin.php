<?php
 ob_start();

 session_start();

 if(!isset($_SESSION['nickName'])){

 	ob_end_clean();

	header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");

	exit();

	}else{

	$page_title = "loged in";

	include('./header.inc');

	echo '<p>You are now logged in '.$_SESSION['nickName'].'</p>';
	}

	include('./footer.inc');

	ob_end_flush();

	?>