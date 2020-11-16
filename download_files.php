<?php

if (isset($_GET['uid'])) {

    $uid = (int) $_GET['uid'];

 } else {// Big problem!

   $uid = 0;
}

if ($uid > 0) {

	require_once ('./connect.php');

	$query = "SELECT file_name, file_type, file_size FROM uploads  WHERE upload_id=$uid";

	$result = mysql_query ($query);

   list ($fn, $ft, $fs) = mysql_fetch_array ($result, MYSQL_NUM);

   mysql_close();

   $the_file = './upload/' . $uid;

   if (file_exists ($the_file)) {

   	   header ("Content-Type: $ft\n");
   	   header ("Content-disposition:attachment; filename=\"$fn\"\n");
       header ("Content-Length: $fs\n");
       readfile ($the_file);

   } else {

     $page_title = 'File Download';

     include ('./header.inc');

     echo ' <p> <font color="red"> The file could not be located on the server. We apologize for any inconvenience. </font></p>';

     include ('./footer.inc');

  }

} else {

  $page_title = 'File Download';

  include ('./header.inc');

  echo '<p><font color="red"> Please select a valid file to download.</font> </p>';

  include ('./footer.inc');
}

?>