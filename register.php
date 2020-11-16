<?php
$page_title ='register';

require_once('validarEmail.php');
//require_once('connect.php');

if(isset($_POST['submit'])){
   	 $errors =  array();
	 /*validamos el nombre*/
	   if(empty($_POST['first']) || is_numeric($_POST['first'])){
		$errors[] ="you forgot enter your First Name";
	   }else{
		  $name = trim($_POST['first']);
           }

		   if(empty($_POST['last']) || is_numeric($_POST['last'])){

			$errors[] = "you forgot enter your Last Name";

			   }else{

				$last = trim($_POST['last']);
			   }

			   if(empty($_POST['gender'])){

			   	  $errors[]= "you forgot enter your Gender";

			   }else{

			   	$gender = trim($_POST['gender']);

			   }

			   if(empty($_POST['age'])){

			   	  $errors[] = "you forgot enter your Age Range";

			   }else{

			   	$age = trim($_POST['age']);

			   }
                           
                           
                         // Check that they were born before this
                         if ($_POST['year'] >= date('Y') ) {
                             print '<p class="error">Either you entered your birth year wrong or you come from the'
                             . ' future!</p>';
                             $okay = false;
                         }
                         
                         if ( is_numeric($_POST['year']) && (strlen($_POST['year']) == 4) ) {
                             if ($_POST['year'] < date('Y')) {
                                 $age = date('Y') - $_POST['year'];
                              } else {
                                  print '<p class="error"> Either you entered your birth year wrong or you come from the
                                         future!</p>';
                                  $okay = false;
                              } // End of 2nd conditional.

                         } else { // Else for 1st conditional.
                             print '<p class="error"> Please enter the year you were born as four digits.</p>';
                             $okay = false;
                         } // End of 1st conditional.
                         
                         if(empty($_POST['terms'])){

			   	  $errors[] = "you forgot acept the term of use!! U_U____.i.";

			 } else {

			   echo	$terms = $_POST['terms'];

			}
                        
                        
                        // Validate the color:
                           switch ($_POST['color']) {
                               case 'red':
                                   $color_type = 'primary';
                                   break;
                               case 'yellow':
                                   $color_type = 'primary';
                                   break;
                               case 'green':
                                   $color_type = 'secondary';
                                   break;
                               case 'blue':
                                   $color_type = 'primary';
                                   break;
                               default:
                                   print '<p class="error">Please select your favorite color.</p>';
                                   $okay = false;
                                   break;
                           }
                        
			/* validamos el Email */
	   if(empty($_POST['email'])){

		  $errors[] = "you forgot enter your email" ;

	   }else{

		 $validarmail = comprobar_email($_POST['email']);

		 if($validarmail == 1){

		 $mail = trim($_POST['email']);

		   } else {

			   $errors[] = 'ingrese un email valido';

			   }
                           
	   }

		   /*validamos el username*/
	   if(empty($_POST['userName'])){

		  $errors[] = "you forgot enter your username";

	   }else{

		  $username = trim($_POST['userName']);

		   }

		   		   /*validamos el password y validamos la confirmacion*/
	   if(empty($_POST['password1'])){

                  $errors[] = " you forgot enter your password!! " ;


	   }else{

		   if($_POST['password1'] == $_POST['password2']){

		   $password = trim($_POST['password1']);

	   }else{

		  $errors[] = " your password and match against the confirmed password!!";

		    }
                    
	   }
           



	   if(!empty($errors)){

           echo '<h1 id="mainhead"> Error!!! </h1>'

               .'<p class="error"> The Following Errors Has Occurred </p>';

           foreach($errors as $msg){

                   echo '<p class="error">'.$msg.'</p><br />';

           }

            echo '<p class="error">Please Try Again</p>';

        }
        
        if ($_POST['color'] == 'red') {
            $color_type = 'primary';

        } elseif ($_POST['color'] == 'yellow') {
            $color_type = 'primary';
        } elseif ($_POST['color'] == 'green') {
            $color_type = 'secondary';
        } elseif ($_POST['color'] == 'blue') {
            $color_type = 'primary';
        } else { // Problem!
            print '<p class="error">Please select your favorite color.</p>';
            $okay = false;
        }

        
	   if(empty($errors)){
               print "<p>Your favorite color is a $color_type color.</p>";

	   $query = "select nickName from usuario where nickName ='".$username."'";

	   $result = @mysql_query($query);

		   if(@mysql_num_rows($result) == 0){

			  $now = date("Y/m/d");

			  $encrip = md5($password);

		      $sql = "insert into usuarios(firstName,lastName,gender,age,email,nickName,pass,terms,dateRegistration)values('".$name."',
		             '".$last."','".$gender."','".$age."','".$mail."','".$username."','".$encrip."','".$terms."','".$now."')";

			  $result = @mysql_query($sql);
                          
                          

			  $cabeceras  = 'MIME-Version: 1.0' . "\r\n";

              $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
              
              $scrubbed = array_map('spam_scrubber', $_POST);
              
               // Minimal form validation:
              if (!empty($scrubbed['name']) && !empty($scrubbed['email']) && !empty($scrubbed['comments']) ) {
              
                  // Create the body:
                 $body = "Name: {$scrubbed['name']}\n\nComments:{$scrubbed['comments']}";

/*$mensaje ="
<html>
<head>
  <title>Thanks for register</title>
</head>
<body>
<center>
<b> Data confirmation: </b>"."<br>"."<br />

   <table border='0' width='50%'>
     <tr>
      <td>
     <b>First Name:  &nbsp; </b>
      </td>
      <td>".
       $_POST["first"]."
      </td>
     </tr>
     <tr>
      <td>
        <b>Last Name:  &nbsp;  </b>
      </td>
      <td>"
	     .$_POST["last"]."
      </td>
     </tr>
     <tr>
      <td>
        <b>Gender:  &nbsp; </b>
      </td>
      <td>
       ".$_POST["gender"]."
      </td>
     </tr>
     <tr>
       <td>
       <b>Age:  &nbsp;  </b>
       </td>
       <td>
       ".$_POST["age"]."
       </td>
     </tr>
	 <tr>
	   <td>
	    <b> e-mail:  &nbsp;</b>
	   </td>
	   <td>"
	   .$_POST["email"]."
	   </td>
	   </tr>
	   <tr>
	      <td>
	      <b> nickname : &nbsp;</b>
	      </td>

	   <td>".$_POST["userName"]."</td>
	   </tr>
	   <tr>
	   <td>
	   <b> comments: &nbsp;</b>
	   </td>
	     	    </tr>
	    <tr>
		<td>
		 <b>password: &nbsp;</b>
		</td>
	  	    <td>
		  ".$_POST["password1"]."
	    </td>

	   </tr>
	   <tr>
	   <td><b>Date Registration:</b></td>

	   <td>".$now."</td>
	   </tr>
      </table>  </b><br>"."<br>"."


</body>
</html>
";

        mail($_POST["email"],"Info confirmation",$body,$cabeceras);*/

		 if($result!=""){

            $url ="http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);

            if(substr($url, -1) == "/" OR(substr($url,-1)=='\\')){

               $url =substr($url,0,-1);

            }

        $url .='/thanks.php';

    	header("location: $url");

		exit();

		}else{

		  $message='<font color="red"> you could not be registered due to a application error. we apologize for the inconvenience.                    </font>'.mysql_error();

		}

	   }else{

		echo $message='<p> <font color="red"> That username is already taken </font> </p>';

		}

		    mysql_close();


	}else{

		echo $message = '<p> <font color="red"> please try again </font> </p>';

		}

}

}
define('TITLE', 'Register');
  include('./header.inc');
?>

<script type="text/javascript">

	function  validate(){

	 var afirst = document.register.first.value;
         
         if(afirst.length =="" || isNaN(afirst) == false){

			alert('Please Enter A Valid First Name');

			document.register.first.focus();

			}

	     var alast = document.register.last.value;
	     if(alast.length=="" && isNaN(alast) == false){

			alert('Please Enter A Valid Last Name')

			document.register.last.focus();
		   }

		var  aemail = document.register.email.value;
		if(aemail.length==""){

		    alert('Please Enter A Valid Email');

			document.register.email.focus();

			}


		var auser = document.register.userName.value;
		if(auser.length==""){

			 alert('Please Enter A UserName');

			 document.register.userName.focus();

			}


	    var pass1 = document.register.password1.value;
	    var pass2 = document.register.password2.value;
		if(pass1.length == ""){

			alert('Please Enter A Password');

			document.register.password1.focus();

			}else{

	            if(pass1!=pass2){

		            alert('Your Passwords Not Match :/');

		            document.register.password1.focus();
		            }
				}

		  }

    </script>

    <form name="register" action="<?php echo $_SERVER['PHP_SELF'];?>"  method="post" onsubmit="validate()" autocomplete="true" >

       <fieldset><legend> enter your information in the form below </legend>

       <p><b> First Name:</b><input type="text" name="first" size="20" maxlength="20" value="<?php if(isset($_POST['first'])) echo $_POST['first']; ?>"/></p>

       <p><b> Last Name:</b><input type="text" name="last" size="40" maxlength="40" value="<?php if(isset($_POST['last'])) echo $_POST['last']; ?>"/></p>

       <p><b>Gender:&nbsp; &nbsp; &nbsp; </b>M<input type="radio" name="gender" value="male" />&nbsp; &nbsp; &nbsp;
                        F<input type="radio" name="gender" value="female" checked="checked" /></p>

        <p> Date Of Birth:
            <select name="month">
                <option value="">Month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
            
            <select name="day">
                <option value="">Day</option>
                <?php
                
                for ($i = 1; $i <= 31; $i++) {
                    echo "<option value='".$i."'>".$i."</option>";
                 }
                ?>
            </select>       
       
       <p><b>Age Range</b><select name="age" >
                           <option value="0-29"> 0 - 29</option>
                           <option value="30-60">30 -60</option>
                           <option value="60+">60 +</option>
                           </select>
                            </p>
       <p><b> Year::</b><input type="text" name="year" size="40" maxlength="40" value="<?php if(isset($_POST['year'])) echo $_POST['year']; ?>"/></p>                     
       <p><b> E-Mail Adress:</b><input type="text" name="email" size="40" maxlength="40" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"/></p>

       <p><b> User Name:</b><input type="text" name="userName" size="20" value="<?php if(isset($_POST['userName'])) echo $_POST['userName']; ?>"/></p>

       <p><b> Password:</b><input type="password" name="password1" size="40" /></p>

       <p><b> Confirm Password:</b><input type="password" name="password2" size="20" maxlength="20" /></p>
       
       <p> <input type="checkbox" name="terms" value="yes" /> I agree to the terms (whatever  they may be).</p>


       <div align="center"><input type="submit" name="submit" value="submit information" /></div>

       </fieldset>

       </form>


<?php
include './footer.inc';