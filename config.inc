<?php 

  /*this script is for reporting is for report errors in the site*/
    error_reporting(0);
    
  /*log  a message  to a text file when a problem occurs*/
    $message = 'An Error Ocurred In Script '.__FILE.' on line'.__FILE__."\n";

    error_log($message,3,'errors.txt');
  
    
?>