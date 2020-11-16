<?php

$page_title = 'View Files';

  include ('header.inc');
  require_once ('./connect.php');

  $first = TRUE;

 $query = "SELECT upload_id, file_name, ROUND(file_size/1024) AS fs, description, DATE_FORMAT (date_entered, '%M %e, %Y') AS d
           FROM uploads ORDER BY date_entered DESC";

 $result = @mysql_query ($query);

 while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

        if ($first) {

            echo '<table border="0" width="80%" cellspacing="3" cellpadding="3" align="center">
                  <tr>
                      <td align="left" width="20%"><font size="+1">File Name</font></td>
                      <td align="left" width="40%"><font size="+1">Description</font></td>
                      <td align="center" width="20%"><font size="+1">File Size</font></td>
                      <td align="left" width="20%"><font size="+1">Upload Date</font></td>
                  </tr>';

    $first = FALSE;
 }
  echo " <tr>
          <td align=\"left\"><a href=\"download_files.php?uid={$row['upload_id']}\">{$row['file_name']}</a></td>
          <td align=\"left\">" . stripslashes($row['description']) . "</td>
          <td align=\"center\">{$row['fs']}kb</td>
          <td align=\"left\">{$row['d']}</td>
         </tr>\n";
      }

      if ($first) {

      	  echo '<div align="center">There are currently no files to be viewed.</div>';

      	  } else {

             echo '</table>';

}

mysql_close();
include ('./footer.inc');
?>