<?php
session_start();

//include './funciones/administrative.php';

$password = "";
$login = "";

    require_once('./header.inc');

	 $errors = array();

	    if ((!empty($_POST['email'])) && (!empty($_POST['password'])) ) {
                if ((strtolower($_POST['email']) == 'me@example.com') && ($_POST['password'] == 'testpass') ) { // Correct!
                    ob_end_clean(); // Destroy
                    header('Location: welcome.php'); 
                    exit();
                } else { // Incorrect!
                    print '<p class="text--error">The submitted email address and password do not match those on file!<br>Go
                          back and try again.</p>';
                }
                } else {
                    print '<form action="login. php" method="post" class="form--inline"> 
                                 <p> 
                                     <label for="email"> Email Address: </label>
                                     <input type="email" name="email" size="20">
                                 </p>
                                 <p>
                                     <label for="password">Password:</label>
                                     <input type="password" name="password" size="20">
                                 </p>
                                 <p>
                                    <input type="submit" name="submit" value="Log In!" class="button--pill">
                                 </p>
                             </form>';
                }
	?>
	<script type="text/javascript">

	function  validate(){

		 var alogin = document.login.login.value;
        if(alogin.length ==""){

			alert('Please Enter A Valid Login');

			document.login.login.focus();

			}

	     var apass = document.login.password.value;
	     if(apass.length==""){

			alert('Please Enter A Password')

			document.login.password.focus();
		   }
	}

    </script>

<!--	   <form name="login" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post" onsubmit="validate();">
         <fieldset><legend> enter your information in the form below </legend>

       <p><b> Login:</b><input type="text" name="login" size="20" maxlength="20" /></p>

       <p><b> Password: </b><input type="password" name="password" size="40" maxlength="40" /></p>


       <div align="center"><input type="submit" name="submit" value="submit information" /></div>


         </fieldset>
       </form>


  <?php

  include('./footer.inc');

  ob_end_flush();

  ?>