<?php
/*
 * Created on 09/09/2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 include('header.inc');

  if (isset($_POST['submitted'])) {

  if (isset($_FILES['upload'])) {

      $allowed = array ('image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg');

      if (in_array($_FILES['upload']['type'], $allowed)) {

      	  if (move_uploaded_file($_FILES['upload']['tmp_name'], "images/{$_FILES['upload']['name']}")) {

      	  	  echo '<p>The file has been uploaded!</p>';

          } else {

          	echo '<p><font color="red">The file could not be uploaded because: <b>';

            switch ($_FILES['upload']['error']) {

            	     case 1:

            	             print 'The file exceeds the upload_max_filesize setting in php.ini';

            	             break;

            	     case 2:

            	             print 'The file exceeds the MAX_FILE_SIZE setting in the HTML form';

            	             break;

            	    case 3:

            	             print 'The file was only partially uploaded';

            	             break;

            	    case 4:

            	             print 'No file was uploaded';

            	             break;

            	   case 5:

            	             print 'No temporary folder was available';

            	             break;

                   default:

                             print 'A system error occurred.';

                            break;

  }

  print '</b></font>.</p>';

}

} else {

        echo '<p><font color="red">Please upload a JPEG or GIF image.</font></p>';

        unlink ($_FILES['upload']['tmp_name']);

     }

   } else {

            echo '<p><font color="red">Please upload a JPEG or GIF image smaller than 512KB.</font></p>';

   }

}


?>

<form enctype="multipart/form-data" action="upload_image.php" method="post">

  <input type="hidden" name="MAX_FILE_SIZE" value="524288" />

  <fieldset>

    <legend>Select a JPEG or GIF image to be uploaded:</legend>

     <p><b>File:</b> <input type="file" name="upload" /></p>

     <div align="center"><input type="submit" name="submit" value="Submit" /></div>

     <input type="hidden" name="submitted" value="TRUE" />

   </fieldset>

</form>
<?php
include('footer.inc');
?>

