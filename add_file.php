<?php
@session_start();

$page_title = 'add files';

include('header.inc');
include('connect.php');

$filename = "";
$description = "";

if (isset($_POST['submitted'])) {

  require_once ('./connect.php');

  	$filename = 'upload' ;
  	$description = 'description';

    if (isset($_FILES[$filename]) && ($_FILES[$filename]['error']!= 4)) {

        if (!empty($_POST[$description])) {

        	$d = $_POST[$description];

        } else {

        	$d = 'NULL';

        }

        $query = "INSERT INTO uploads (file_name, file_size, file_type,nickName, description) VALUES ('".$_FILES[$filename]['name']."' , '".$_FILES[$filename]['size']."', '".$_FILES[$filename]["type"]."','".$_SESSION['nickName']."', '".$d."')";

        $result = mysql_query ($query);

        if ($result) {

        	$upload_id = mysql_insert_id();

            if (move_uploaded_file($_FILES[$filename]['tmp_name'], "./upload/$upload_id")) {

            	echo '<p>File  has been uploaded!</p>';

            } else {

            	echo '<p><font color="red"> File number could not be moved.</font></p>';

            	$query = "DELETE FROM uploads WHERE upload_id = $upload_id";

            	$result = mysql_query ($query);

            }

            } else {

              echo '<p><font color="red">Your submission could not be processed due to a system error. We apologize for any inconvenience.</font> </p>';

        }



  }

  mysql_close();

}

?>
<form enctype="multipart/form-data" action="add_file.php" method="post">

  <fieldset>

   <legend>

     Fill out the form to upload a file:

   </legend>

   <input type="hidden" name="MAX_FILE_SIZE" value="524288" />



     	<p><b>File:</b> <input type="file" name="upload" /></p>
              <p><b>Description:</b> <textarea name="description" cols="40" rows="5"></textarea></p><br />


 </fieldset>

 <input type="hidden" name="submitted" value="TRUE" />

 <div align="center"><input type="submit" name="submit" value="Submit" /></div>
</form>

<?php
include ('./footer.inc');
?>