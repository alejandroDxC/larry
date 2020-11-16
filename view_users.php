<?php

$page_title ='View the Current Users';
include('./header.inc');



require_once('./connect.php');


echo '<center> <h1 id="mainhead"> Registered Users </h1></center>';

$display = 10;

if(isset($_GET['np'])){

	$num_pages = $_GET['np'];

}else{

	$query = "SELECT COUNT(*) FROM usuarios  ORDER BY dateRegstration ASC";

	$result = @mysql_query($query);

	$row = @mysql_fetch_array($result,MYSQL_NUM);

	$num_records = $row[0];

	if($num_records > $display){

		$num_pages = ceil($num_records/$display);

	}else{

		$num_pages = 1;
	}
}

if(isset($_GET['s'])){

	$start = $_GET['s'];

	}else{

		$start = 0;
	}


$link1 = "{$_SERVER['PHP_SELF']}?sort=lna";
$link2 = "{$_SERVER['PHP_SELF']}?sort=fna";
$link3 = "{$_SERVER['PHP_SELF']}?sort=dra";

if(isset($_GET['sort'])){

    switch($_GET['sort']){

        case'lna':

             $order_by ='lastName ASC';

             $link1 = "{$_SERVER['PHP_SELF']}?sort=lnd";

             break;

        case'lnd':

             $order_by ='lastName DESC';

             $link1 = "{$_SERVER['PHP_SELF']}?sort=lna";

             break;

        case'fna':

             $order_by ='firstName ASC';

             $link2 = "{$_SERVER['PHP_SELF']}?sort=fnd";

             break;

        case'fnd':

             $order_by ='firstName DESC';

             $link2 = "{$_SERVER['PHP_SELF']}?sort=fna";

             break;

        case'dra':

             $order_by ='dateRegistration ASC';

             $link3 = "{$_SERVER['PHP_SELF']}?sort=drd";

             break;

        case'drd':

             $order_by ='dateRegistration DESC';

             $link3 = "{$_SERVER['PHP_SELF']}?sort=dra";

             break;

        default:

         $order_by ='dateRegistration DESC';

         break;



}



$sort = $_GET['sort'];

}else{

	$order_by ='dateRegistration ASC';

	$sort ='rdd';


}


$query = "SELECT firstName,lastName,DATE_FORMAT(dateRegistration, '%M %d %y') AS dr,
 nickName FROM usuarios ORDER BY  $order_by LIMIT $start,$display";


$result = @mysql_query($query);

   echo'<table align="center" cellpadding="2" cellspacing="2">
	          <tr>
			    <td align="left">
				  <b>FIRST NAME</b>
				</td>
				<td align="left">
				  <b>LAST NAME</b>
				</td>
				<td align="left">
		          <b>DATE REGISTERED</b>
				</td>
				 <td align="left">
				  <b>EDIT</b>
				</td>
				 <td align="left">
				  <b>DELETE</b>
				</td>
			  </tr>
			 ';


    $bg = '#eeeee';
			 /*se imprimen los resultados de la consulta*/
			   while($row = @mysql_fetch_array($result,MYSQL_ASSOC)){

			   	$bg = ($bg =='#eeeee'?'#fffff':'#eeeee');

                     echo'<tr bgcolor="'.$bg.'">

                           <td align="left">'.$row['firstName'].'</td>

                           <td align="left">'.$row['lastName'].'</td>

					        <td align="left">'.$row['dr'].'</td>

					        <td align="left"><a href="edit_user.php?id='.$row['nickName'].'">Edit</a></td>

					        <td align="left"><a href="delete_user.php?id='.$row['nickName'].'">Delete</a></td>

                            <td align="left"><a href="'.$link1.'">Last Name</a></td>

                            <td align="left"><a href="'.$link2.'">First Name</a></td>

                            <td align="left"><a href="'.$link3.'">Date Registered</a></td>

                         </tr> ' ;

				    }

				   echo'</table>';

				  @mysql_free_result($result);


				   mysql_close();


		if($num_pages > 1){

			echo'<br /><p>';

			$current_Page = ($start/$display) + 1;

			if($current_Page != 1){

				echo '<a href="view_users.php?s=' . ($start -  $display) . '&np=' . $num_pages . '">Previous</a> ';

			}
               for($i = 1; $i <= $num_pages; $i++){

				if($i != $current_page){

 					echo '<a href="view_users.php?s=' . (($display * ($i - 1))) . '&np=' . $num_pages .'&sort='.$sort.'">' . $i . '</a> ';


                 }  else {

                     echo $i.'';
                 }

               }


			if($current_page != $num_pages){

			   echo '<a href="view_users.php?s=' . ( $start + $display ) . '&np=' . $num_pages . '&sort='.$sort.'">Next</a>';

			}

			echo'</p>';

		}

		include('./footer.inc');

?>