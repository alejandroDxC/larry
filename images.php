<?php

include('./header.inc');

?>
<script language="javascript" type="text/javascript">

function create_window(image,width,height){

      var     width = width + 25;
      var     height = height + 50;


           if(window.popup_window && !window.popup_window.closed){

            window.popup_window.resizeTo(width,height);

            }

           var window_specs = "location=no, scrollbars=no,menubars=no,toolbars=no,resizable=yes,left=0,top=0,width="+width+
                               ",height"+height;

           var url = "image_window.php?image=" + image;

           popup_window = window.open(url,"PictureWindow",window_specs);

           popup_window.focus();


}

</script>

<table align="center" cellspacing="0" cellpadding="0" border="0" >

 <tr bgcolor="#FFCC66">

   <td valign="top"  align="center" >Image Name</td>

   <td valign="top"  align="center" >Image Size</td>

 </tr>


<?php

 date_default_timezone_set('America/bogota');

 $image_size  = 0;

 $file_size = 0;

 $dir = 'images';
 
 $filemtime = "";
 
 $image_date = "";

 $files = scandir($dir);

 foreach($files as $image){

     	if (substr($image, 0, 1) != '.') {

     		$image_size = getimagesize("$dir/$image");

     		$file_size = round ( (filesize("$dir/$image")) / 1024) . "Kb";
                
                $filemtime = filemtime("$dir/$image");
                
                $image_date = date("F d, Y H:i:s ", $filemtime);

     	}

	echo " <tr>

                <td>

      		 <a href=\"javascript:create_window('$image',$image_size[0],$image_size[1])\">$image</a>$file_size($image_date)</td>

                <td>$file_size</td>

           </tr>";

}

?>

</table>

<?php

include ('./footer.inc');

?>