<?php
/* include connect with DB*/
	include('./connect.php');

function Authenticate($login,$pass){


         /*check for authentication*/
    if(isset($login) AND isset($pass)){


		 $login;

		 $pass = md5($pass);

         $query = "select nickName from usuario where nickName = '".$login."' and pass='".$pass."' ";

         echo mysql_error($query);

	     $result = mysql_query($query);

		 $row = @mysql_fetch_array($result);

		 $user = $row[0];

		 unset($login);

		 unset($pass);

		 return $user;

	}
   }
?>