<?php


  /*declaramos una variable para reportar problemas*/
    $okay = FALSE;

  /*asegurate de que el nombre de una imagen fue pasado al script*/
    if($_GET['image']){


     	/*obtenemos la extencion del nombre de la imagen*/
          $ext = substr($_GET['image'],-4);


        /*testeamos que sea una extencion valida*/
          if($ext == '.png' OR $ext == '.jpg' OR $ext == '.jpeg' OR $ext == '.gif'){

          	/*se obtiene la informacion de la imagen y se despliega*/
              if($image = @getimagesize('images/'.$_GET['image'])){

          	echo"<center><img src=\"images/{$_GET['image']}\"$image[3] border=\"2\"  style=\"max-width:250px; max-height:250px;\" />";

          	$okay = TRUE;

          	}

           }

          }

        /*si algo salio mal*/
          if(!$okay){

          	echo '<div align="center"><font color="red" size="+1">this script
          	  must receive a valid image name!!!</font></div>';

          	}

         ?>

         <br/>

         <div align="center"><a href="javascript:self.close();">Close this window</a></div>


