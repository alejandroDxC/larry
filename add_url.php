<script type="text/javascript" language="Javascript">

  function check_data(submit_url) {

  	 var problem = false;

  	if (submit_url.name.value == "") {

       alert ("Enter your name.");

       submit_url.name.focus();

       problem = true;
    }

    if (submit_url.email.value == "") {

        alert ("Enter your email address.");

        submit_url.email.focus();

        problem = true;

     }

     if (submit_url.url.value == "") {

         alert ("Enter the URL.");

         submit_url.url.focus();

         problem = true;

     }

     if ((submit_url.url_category.selectedIndex == 0) || (my_form.url_category.value == 0) ) {

          alert ("Please select a category for this URL.");

          problem = true;

     }

      if (problem) {

          return false;

       } else {

          return true;

       }

  }

  </script>


<?php
session_start();

$errors = array();
  /*enviamos el nombre de la pagina e incluimos el "header" tambien incluimos la conexion
   *a la base de datos*/

   $page_title = 'Add Url';

    include('./header.inc');
    require_once ('connect.php');
    require_once('validarEmail.php');

    if(isset($_POST['submit'])){

       if (empty($_POST['url'])) {

           $errors[] =  "Please enter a valid URL!";

        } else {

          $url = $_POST['url'];

        }

        if(empty($_POST['title'])){

		  $errors[] = "you forgot enter the title.";

	   }else{

		 $title = $_POST['title'];

       }

       if(empty($_POST['description'])){

		  $errors[] = "you forgot enter your description";

	   }else{

		 $description = $_POST['description'];

	   }

	  if (isset($_POST['types']) &&  (is_array($_POST['types']))) {

          $type = TRUE;


       } else {

         $type = FALSE;

         $errors[] =  '<p><font color="red"> Please select at least one category!</font></p>';

       }
            if(!empty($errors)){

               echo '<h1 id="mainhead"> Error!!! </h1>'

               .'<p class="error"> The Following Errors Has Occurred </p>';

               foreach($errors as $msg){

                       echo '<font color="red">'.$msg.'</font><br />';

               }

                       echo '<p>Please Try Again</p>';

        }

    	if($url!="" && $title!="" && $description!="" ){

    		$query = "INSERT INTO urls (url,title,description) VALUES ('".$url."','".$title."','".$description."')";

    		$result = @mysql_query($query);

    		$tid = @mysql_insert_id();

    		if($tid > 0){

    		   $query = "INSERT INTO url_associations(url_id,url_category_id,approved)VALUES";

               foreach($_POST['types'] as $v){

                       $query .= "($tid,$v,'Y'), ";

               }

         $query = substr($query, 0 , -2);

         $result = @mysql_query($query);

         if(@mysql_affected_rows() == count($_POST['types'])){

         	echo '<p>thank you for your submission</p>';

         	$_POST = array();

         }else{

          echo '<p><font color="red">your submission could not be proccessed. we apologize for any inconvenience</font></p>';

          echo '<p><font color="red">'.mysql_error().'</font><br />'.$query.'</p>';

          $query = "DELETE FROM urls WHERE url_id = $tid ";

         }/*@mysql_affected_rows() end if*/

        }else{ /*if the first query don't run ok */

          echo '<p><font color="red">your submission could not be proccessed. we apologize for any inconvenience</font></p>';

          echo '<p><font color="red">'.mysql_error().'</font><br />'.$query.'</p>';

    		}

       }else{

       	  echo'<p> <font color="red"> please try again!! ^_^ </font> </p>';

       }


       }

    ?>

    <form name="submit_url" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

       <fieldset>

         <legend>

            Fill out the form to submit  a URL (you may choose up to 3 categories):

         </legend>

       <p><b>URL:</b><input type="text" name="url" size="60" maxlength="60" value="<?php

        if(isset($_POST['url'])){

           echo $_POST['url'];
           }

           ?>" /><br /><small> Do not include  the initial <i>http://</i></small></p>

       <p><b>URL Name/Tile :</b><input type="text" name="title" size="60" maxlength="60" value="<?php

        if(isset($_POST['title'])){

           echo $_POST['title'];
           }

           ?>" /></p>

       <p><b>Description :</b><textarea name="description" cols="40" rows="5"><?php

        if(isset($_POST['description'])){

           echo $_POST['description'];
           }

           ?></textarea></p>

       <p><b>URL Category:</b> <select name="types[]" multiple="multiple" size="5">

            <?php

              $query = "SELECT * FROM url_categories ORDER BY category ASC";

              $result = @mysql_query ($query);

              while ($row = mysql_fetch_array($result, MYSQL_NUM)) {

              	     echo "<option value=\"$row[0]\"";

              	     if (isset($_POST['types']) && (in_array($row[0], $_POST['types']))) {

              	     	 echo ' selected="selected"';

              	     }

                     echo ">$row[1]</option>\n";

                 }
?>
</select></p>

         <div align="center"><input type="submit" name="submit" value="Submit" /></div>

       </fieldset>

    </form>


<?php

  include('./footer.inc');

?>