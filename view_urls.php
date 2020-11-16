<?php

include('header.inc');
include('connect.php');

 $page_title = 'view Urls';

  echo'<div align="center"> <form method="get" action="view_urls.php">

       <select name="type">

       		<option value="NULL"> choose a category option!! </option>';

  	   $query = "SELECT * FROM url_categories ORDER BY category ASC ";

       $result = @mysql_query($query);

       while($row = @mysql_fetch_array($result,MYSQL_NUM)){

             echo "<option value=\"$row[0]\">$row[1]</option>";

       }

       echo '</select> <input type="submit" name="submit" value="Go!">' .
       		'
             </form></div>';

       if (isset($_GET['type'])) {

           $type = (int) $_GET['type'];

       } else {

       	 $type = 0;

       }

       if ($type > 0) {

       	   $query = "SELECT category FROM url_categories WHERE url_category_id=$type";

       	   $result = mysql_query ($query);

       	   list ($category) = mysql_fetch_array ($result,MYSQL_NUM);


          echo "<hr /><div align=\"center\">" .
          		"" .
          		" <b>$category Links</b><br /><small>(All links will open in their own window. Recently added links are
                   listed first.)</small></div>\n";

          $first = TRUE;

          $query = "SELECT u.url_id, url, title, description FROM urls AS u, url_associations AS ua WHERE u.url_id = ua.url_id AND" .
          		   " ua.url_category_id=$type AND  ua.approved = 'Y' ORDER BY  date_submitted DESC";

          $result = mysql_query ($query);

          while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

          	       if ($first) {

          	       	   echo '<table border="0" width="100%" cellspacing="3" cellpadding="3" align="center">

		                    <tr>

		                         <td align="right" width="40%">

		                           <font size="+1">Link</font></td>

		                          <td align="left" width="50%">

		                               <font size="+1">Description  </font></td>

		                          <td align="center" width="10%"> &nbsp; </td>

		                     </tr>';

                         $first = FALSE;

                  }

          echo " <tr>

          		   <td align=\"right\">

          		    <a href=\"http://{$row['url']}\"target=\"_new\">{$row['title']}</a>

          		  </td>

          		   <td align=\"left\">

          		     {$row['description']}

          		   </td>

         		  <td align=\"center\">

          		    <a href=\"edit_url.php?uid={$row['url_id']}\">edit</a>

          		  </td>

          		 </tr>\n";

          }

          if ($first) {

              echo '<div align="center"> There are currently no links in this category.</div>';

          } else {

          	echo '</table>';

         }

  }

mysql_close();

include('footer.inc');
?>