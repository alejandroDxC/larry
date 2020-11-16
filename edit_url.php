<?php
$page_title = 'edit url';

include('header.inc');
include('connect.php');

 if(isset($_GET['uid'])){

    $uid = (int)$_GET['uid'];

 }elseif(isset($_POST['uid'])){

   $uid = (int)$_POST['uid'];

 }else{

 	$uid = 0;

 }

 if($uid <= 0){

    echo '<font  color="red"><p>this page was accesed in error !!</p></font>';

    include('footer.inc');

    exit();

 }

 if(isset($_POST['submit'])){

    if($_POST['which'] ==  'delete'){

       $query = "DELETE FROM urls WHERE url_id = $uid";

       $result = @mysql_query($query);

       $affect = @mysql_affected_rows();

       $query = "DELETE FROM url_associations WHERE url_id = $uid";

       $result = @mysql_query($query);

       $affect += @mysql_affected_rows();

       if($affect > 0){

          echo '<p> <b> the URL has been Deleted!! </b> </p>';

       }else{

          echo '<font color="red"><p> Your submission could not be processed sorry!!! D :  </p></font><br />';

          @mysql_error();

       }

       include('footer.inc');

       exit();

    }else{/*edit  url default option*/

      /*validate all form fields*/
      if(preg_match('^([[:alnum:]\-\.])+(\.)([[:alnum:]]){2,4}([[:alnum:]/+=%&_\.~?\-]*)$', $_POST['url'] == 0)) {

       echo  $u = $_POST['url'];

       } else {

         $u = FALSE;

         echo '<p> <font color="red"> Please enter a valid URL! </font> </p>';

       }

       if (!empty($_POST['title'])) {

       	   $t = $_POST['title'];

       } else {

       	 $t = FALSE;

       	 echo '<p><font color="red"> Please enter a URL name/title! </font> </p>';

       }

       if (!empty($_POST['description'])) {

       	   $d = $_POST['description'];

       } else {

       	 $d = FALSE;

       	 echo '<p><font color="red"> Please enter a description! </font> </p>';

       }

       if (isset($_POST['types']) && (is_array($_POST['types']))) {

           $type = TRUE;

        } else {

          $type = FALSE;

          echo '<p> <font color="red"> Please select at least one  category!</font> </p>';

        }

        if ($u && $t && $d && $type) {

        	$query1 = "UPDATE urls SET url='$u', title='$t', description='$d' WHERE url_id=$uid";

            $result1 = mysql_query($query1);

            $exist_types = unserialize(urldecode($_POST['exist_types']));

            if ($_POST['types'] != $exist_types) {

            	$add = array_diff($_POST['types'],$exist_types);

            	$delete = array_diff($exist_types,$_POST['types']);

                if (!empty($add)) {

                	$query2 = 'INSERT INTO url_associations (url_id,url_category_id, approved) VALUES ';

                	foreach ($add as $v) {

                		$query2 .= "($uid, $v, 'Y'), ";

                      }

                    $query2 = substr ($query2, 0, -2);

                    $result2 = mysql_query ($query2);

                 } else {

                 	 $result2 = TRUE;

                 }

                if (!empty($delete)) {

                	$query3 = "DELETE FROM url_associations WHERE" .
                			" (url_id=$uid) AND url_category_id IN (". implode(',', $delete) . "))";

                	$result3 = mysql_query($query3);

                 } else {

                 	$result3 = TRUE;

                }

              } else {

              	$result2 = TRUE;

              	$result3 = TRUE;

              }

               if ($result1 && $result2 && $result3) {

               	 echo '<p><b>The URL has been edited!</b></p>';

               } else {

               	echo '<p><font color="red"> Your submission could not be processed due to a system error.
                          We apologize for any inconvenience.</font></p>';

               }

             } else {

             	echo '<p><font color="red"> Please try again.</font> </p>';

             }

           }

          }

           $query = "SELECT url, title, description, url_category_id FROM urls LEFT JOIN
                     url_associations USING (url_id) WHERE urls.url_id=$uid";

           $result = mysql_query ($query);

           $exist_types = array();

           list($url, $title, $desc, $exist_types[]) = mysql_fetch_array ($result, MYSQL_NUM);

           while ($row = mysql_fetch_array($result, MYSQL_NUM)) {

           	       $exist_types[] = $row[3];

           }

?>

<form action="edit_url.php" method="post">

  <fieldset>

   <legend>

    Edit a URL:

   </legend>

  <p> <b> Select One: </b> <input type="radio" name="which" value="edit" checked="checked" /> Edit

                           <input type="radio" name="which" value="delete" /> Delete</p>

  <p ><b> URL: </b> <input type="text" name="url" size="60" maxlength="60" value="<?php echo $url; ?>" />
  <br /><small>Do NOT  include the initial <i>http:// </i>.</small></p>

  <p> <b>URL Name/Title:</b> <input type="text" name="title" size="60" maxlength="60" value="<?php echo $title;?>" /></p>

  <p> <b>Description:</b> <textarea name="description" cols="40" rows="5"><?php echo $desc; ?></textarea></p>

  <p><b>Category/Categories:</b>  <select name="types[]" multiple="multiple" size="5">

  <?php

        $query = "SELECT * FROM  url_categories ORDER BY category  ASC";

        $result = @mysql_query ($query);

        while ($row = mysql_fetch_array($result, MYSQL_NUM)) {

        	echo "<option value=\"$row[0]\"";

        	if (in_array($row[0],$exist_types)) {

        		echo ' selected="selected"';

        	 }

            echo ">$row[1]</option>\n";

          }

 ?>

</select></p>

</fieldset>

 <input type="hidden" name="submitted" value="TRUE" />

  <?php

   echo '<input type="hidden" name="exist_types" value="' . urlencode(serialize($exist_types)) . '" />
         <input type="hidden" name="uid" value="' . $uid . '" />';

?>

<div align="center"> <input type="submit" name="submit" value="Submit" /></div>

</form>

<?php
include('footer.inc');
?>