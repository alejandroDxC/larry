<?php

include('header.inc');
include('connect.php');

$query = "SELECT nickName, comment,DATE_FORMAT(date_entered, '%M %D,%Y') FROM comments ORDER BY date_entered DESC";

if ($result = @mysql_query($query)) {

	if (@mysql_num_rows($result) > 0) {

        while ($row = @mysql_fetch_array($result, MYSQLI_NUM)) {

               echo "<h3>$row[0] ($row[2])</h3><p>$row[1]</p><br />";

       }

    } else {

      echo '<p>There are currently no comments in the database.</p>';

    }

}






include('footer.inc');
?>
