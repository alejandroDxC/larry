<?php

require("./errorLogin.php");
include('./header.inc');
require_once("./connect.php");


$page_title = 'change password';


if(isset($_POST['submit'])){

 $message = NULL;

	 /*validamos el nickname*/
	   if(empty($_POST['username']) ){

		  $message.='<p>you forgot enter your nickname</p>';

	   }else{

		  $username = trim($_POST['username']);

		   }

		   /*validamos el password actual*/
	   if(empty($_POST['current'])){

		  $new = false;
		  $message.='<p>you forgot enter your existing password!!</p>';


	   }else{

		   if($_POST['newpass'] == $_POST['confirm']){

		   $new = trim($_POST['newpass']);

	   }else{

		  $new = false;
		  $message.='<p>your password and match against the confirmed password!!</p>';

		    }
	   }


	if($new!="" && $username!=""){

		 $current = md5($_POST['current']);
		 $new = md5($new);

       $query = "select nickName from usuario where nickName ='".$username."' and pass='".$current."' ";

	   $result = @mysql_query($query);

	   echo mysql_error($query);

       $num = mysql_num_rows($result);


		   if($num == 1){

			  $row = mysql_fetch_array($result,MYSQL_NUM);

			  $query = "UPDATE usuario SET pass ='".$new."' WHERE  nickName='".$row[0]."' ";

			  echo mysql_error($query);

		      $result = @mysql_query($query);

		  if(mysql_affected_rows() == 1){

		      echo'your password has been changed!!';

		}else{

		  $message='your password  could not be changed due to a application error. we apologize for the inconvenience.';

		}

	   }else{

		 $message='<p> your username and password do not match our records</p>';

		}

		    mysql_close();


	}else{
		$message='<p> please try again!!!</p>';
		}
}

			if(isset($message)){
			 echo '<font color="red">',$message,'</font>';
			 }
?>

<script type="text/javascript">

	function  validate(){

		 var alogin = document.change.username.value;
        if(alogin.length ==""){

			alert('Please Enter A Valid User Name');

			document.change.username.focus();

			}

	     var acurrent = document.change.current.value;
	     if(acurrent.length==""){

			alert('Please Enter A Password')

			document.change.current.focus();
		   }

		   var anew = document.change.newpass.value;
		   var aconfirm = document.change.confirm.value;

		   if(anew.length==""){

			   alert('Please Enter A New Password');

			   document.change.newpass.focus();

			   }else{
                    if(anew != aconfirm){

                       alert('Your Passwords Not Match');

                       document.change.newpass.focus();

                        }
				   }

	}

    </script>

	   <form name="change" action="<?php echo $_SERVER['PHP_SELF'];?>"  method="post" onsubmit="validate();">
         <fieldset><legend> enter your information in the form below </legend>

       <p><b> User Name:</b><input type="text" name="username" size="20" maxlength="20" value="<?php if(isset($_POST['username'])) echo                                                                                                    $_POST['username']?>"/></p>

       <p><b>Current Password:</b><input type="text" name="current" size="40" maxlength="40" value="<?php if(isset($_POST['current']))                                                                                                        echo $_POST['current']?>"/></p>

       <p><b> New Password:</b><input type="text" name="newpass" size="40" maxlength="40" value="<?php if(isset($_POST['new'])) echo                                                                                                $_POST['new']?>"/></p>

       <p><b> Confirm New Password:</b><input type="text" name="confirm" size="20" maxlenght="20" value="<?php

       if(isset($_POST['confirm'])) echo $_POST['confirm']?>"/></p>


       <div align="center"><input type="submit" name="submit" value="submit information" /></div>


         </fieldset>
       </form>


  <?php
include('./footer.inc');
?>