<?php

  function Conectarse(){

     if(!($link = mysql_connect("localhost","root",""))){

		  echo mysql_error($link);

          echo "Error conectando a la base de datos.";

		  exit();
     }

     if(!mysql_select_db('repaso',$link)){

		 echo mysql_error($link);

	     echo "Error seleccionando la base de datos.";

	     exit();
}


return $link;

}
Conectarse();
//echo "Conexión con la base de datos conseguida.<br>";
?>