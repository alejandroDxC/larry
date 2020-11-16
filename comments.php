<?php

$claveAntigua = sha1('4dm1nf0'.md5(sha1('solati123')));

$page_title= "comments";
include('./header.inc');
echo $claveAntigua ;



?>


  <form action='handle_comments.php' method='post'>

   <fieldset>

     <legend>

      Enter Your Comments In The Form Below:

     </legend>

     <p><b>Name:</b><select name="title">

                 <option value="Mr.">Mr.</option>
 
                 <option value="Mrs.">Mrs.</option>
                 
                 <option value="Ms.">Ms.</option>
 
                 </select> <input type="text" name="name" size="20" /></p>
     
     <p><b>Email Address:</b> <input type="text" name="email" size="20" /></p>
     
     <p><b>Response: This is...</b>
         
         <input type="radio" name="response" value="excellent" /> excellent
         
         <input type="radio" name="response" value="okay" /> okay
         
         <input type="radio" name="response" value="boring" /> boring</p>

     <p><b>Comments: </b><textarea name='comments' rows='3'  cols='40'></textarea></p>

     <div align='center'><input type='submit' name='submit' value='submit' /></div>

     </fieldset>

  </form>

<?php
include('./footer.inc');
?>
