<!DOCTYPE html >

 <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

  <head>

    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />

   <title> Handle Comments </title>

  </head>

 <body>

<?php # Script 10.2 - handle_comments.php

@session_start();

 $page_title = 'Handle Comments';

 $allowed = array('title','name','email','response','comments','submit');

 $received = array_keys($_POST);

  if($allowed == $received){

     require_once('./connect.php');
    
     if(!empty($_POST['title'])){

        $title = $_POST['title'];

     }else{

       echo '<p>you forgot enter your title</p>';

       $title = FALSE;

     }

     if(!empty($_POST['name'])){

        $name = trim(htmlspecialchars($_POST['name']));

     }else{

       echo '<p>you forgot enter your name</p>';

       $name = FALSE;

     }
     
      if(!empty($_POST['response'])){

        $response = trim($_POST['response']);

     }else{

       echo '<p>you forgot enter your response</p>';

       $response = FALSE;

     }
     if(!empty($_POST['email'])){

        $email = trim(htmlspecialchars($_POST['email']));

     }else{

       echo '<p>you forgot enter your email</p>';

       $email = FALSE;

     }

     if(!empty($_POST['comments'])){

 	    $comments =nl2br(htmlspecialchars($_POST['comments']));


     }else{

      echo '<p>you forgot enter your comments</p>';

      $comments = FALSE;

    }

    if ($title!="" && $name!="" && $comments!="") {

         $query = "INSERT INTO comments(comment,nickName,email,name,title,reponse) VALUES ('".$comments."', '".$_SESSION["nickName"]."',
             '".$email."','".$name."','".$title."','".$response."')";

         $result = @mysql_query ($query);

     if(@mysql_affected_rows() == 1){

     	include('header.inc');
        echo '<center><p>Thank you  for your commentes!!!!</p>'.stripslashes($comments).'</center>';

        include('footer.inc');

     }else{

     	echo '<p><font color="red"> you comments could not be added!!!</font></p>';

     	echo mysql_error().'<br /><br />'.$query;

     }

        mysql_close();

     }else{

      echo '<p><font color="red"> This Page Was acceced in Error!!!</font></p>';

     }
  }

?>