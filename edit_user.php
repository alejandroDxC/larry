<?php
include ('./header.inc');
require_once('connect.php') ;

$page_title= 'editar usuario';


if(isset($_GET['id'])){

	$nickName = $_GET['id'];

}elseif (isset($_POST['id'])){

	$nickName = $_POST['id'];

	}else{

		echo'<h1 id="mainhead">Page Error!!</h1>

		<p class="error">  this Page Was Accesses in Error!!! </p>';

		include('./footer.inc');

		exit();
	}

   if(isset($_POST['submitted'])){

   	  $errors = array();

   	  if(empty($_POST['firstName'])){

   		$errors[] = 'you forgot enter your first name';

   	  }else{

   	  	$fn = trim($_POST['firstName']);

   	  }

   if(empty($_POST['lastName'])){

   		$errors[] = 'you forgot enter your last name';

   	  }else{

   	  	$ln = trim($_POST['lastName']);

   	  }

   if(empty($_POST['email'])){

   		$errors[] = 'you forgot enter your email';

   	  }else{

   	  	$email = trim($_POST['email']);

   	  }

   	  if(empty($errors)){

     	$query = "SELECT nickName FROM usuarios WHERE nickName = '$nickName' AND
   	  	email = '$email'";

        $result = @mysql_query($query);

   	  	if(mysql_num_rows($result) == 0){

   	  		$query = "UPDATE usuarios SET firstName = '$fn', lastName = '$ln', email = '$email'
   	  		WHERE nickName = '$nickName' ";

   	  		$result = @mysql_query($query);

   	  		if(mysql_affected_rows() == 1){

   	  			echo'<h1 id="mainhead"> Edit a User </h1>

   	  			     <p> the user has been edited </p>';

   	  		}else{

   	  			echo'<h1 id="mainhead"> System error </h1>

   	  			<p class="error">  The user could not be edited due a system error. we
   	  			                   apologise for any inconvenience.</p> // public message';

   	  			echo'<p>'.mysql_error().' </p>  <br/>'.$query;

   	  			include('./footer.inc');

   	  			exit();

   	  		}

   	  	}else{

   	  		echo '<h1 id="meainhead">ERROR!!!</h1>

   	  		<p class="error">the email address has al ready been  registered</p>';

   	  	}

   	  }else{

   	  	//report the errors

   	  	echo '<h1 id="mainhead"> Error!! </h1>

   	  	      <p class="error"> the following error(s) ocurred </p> ';

   	  	foreach ($errors as $msg){

   	  		echo $msg.'<br />';
   	  	}

   	  	echo '<p>Please  try again</p>';

   	  }

     }

     $query = "SELECT firstName,lastName,email FROM usuarios WHERE nickName = '$nickName' ";

     $result = @mysql_query($query);

     if(mysql_num_rows($result)== 1){

     	$row = mysql_fetch_array($result,MYSQL_NUM);

     	echo '<center> <h2> Edit A User </h2>

     	      <form action="edit_user.php" method="post">

     	        <p> First Name : <input type="text" name="firstName" size="15" maxlength="15"
     	                        value="'.$row[0].'" /></p>

     	        <p> Last Name : <input type="text" name="lastName" size="15" maxlength="15"
     	                        value="'.$row[1].'" /></p>

     	        <p> Email : <input type="text" name="email" size="15" maxlength="15"
     	                        value="'.$row[2].'" /></p>

     	        <p> <input type="submit" name="submit" value="submit" /> </p>

                <input type="hidden" name="submitted" value="TRUE" />

                <input type="hidden" name="id" value="'.$nickName.'" />


     	      </form> </center>';

     }
include('./footer.inc');
?>