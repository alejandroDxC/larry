<?php
include('./header.inc');
require_once ('./connect.php');

 $Page_title = 'delete user';

 if(isset($_GET['id'])){

 	$nickname = $_GET['id'];

 }elseif (isset($_POST['id'])){

 	$nickname = $_POST['id'];

 }else{

 	echo'<h1 id="mainhead">page error </h1>


 	     <p  class="error">this page has been acceced in error 1</p>';

 	include('./footer.inc');

 	exit();
 }

if($_POST['submitted'] == true){

	if($_POST['sure'] == 'yes'){


       $query = "DELETE FROM usuarios WHERE nickName = '$nickname'";

		 $result = @mysql_query($query);

		if($result == 1){

			echo '<h1 id="mainhead">Delete a user</h1>

			      <p>  the user has been deleted </p>
			';

		}else{

			echo '<h1 id="mainhead">System Error</h1>

			<p> the user cant be deleted due a system error  2</p>

			';

			echo'<p>'.mysql_error().'<br/><br/> query:'.$query;
		}

	}else{

		echo'<h1 id="mainhead">  Delete a user  </h1>   <br /> <br />


		';
	}


}else{

  $query = "SELECT CONCAT( lastName, firstName )FROM usuarios WHERE nickName= '$nickname'";

 $result = @mysql_query($query);

	if(mysql_num_rows($result) == 1){

		$row  =  mysql_fetch_array($result,MYSQL_NUM);

		echo '<center> <h2>  Delete a User </h2>

		      <form name="delete" action="delete_user.php" method="POST">

		        <h3> Name: '.$row[0].' </h3>

		        <p>  Are you sure you want delete this user??? </p>

		        <p>  <input type="radio" name="sure" value="yes" />  YES:  <br />

		             <input type="radio" name="sure" value="no" checked="checked" />  NO:  </p>

		        <p>  <input type="submit" name="submit" value="submit" />  </p>

                     <input type="hidden" name="submitted" value="true" />

                     <input type="hidden" name="nickName" value=".$nickname." />

            </form></center>';

	}else{

		echo'<h1 id="mainhead">Page Error!!!   </h1>

		     <p class="error">  </p>

		';
	}

	mysql_close();
}


include('./footer.inc');
?>