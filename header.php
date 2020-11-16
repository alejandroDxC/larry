<?php
ini_set('display_errors', 1); // Let me learn from my mistakes!
error_reporting(E_ALL);       // Show all possible problems!
ob_start(); // Turn on output buffering:
?>

<!DOCTYPE html>
<html lang = 'sp'>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <!--<link rel="STYLESHEET" type="text/css" href="includes/css/bootstrap.css" /> -->
        <!-- Minified - Latest version -->
        <link media = "all" rel="stylesheet" type="text/css" href="https://getbootstrap.com/1.0.0/assets/css/bootstrap-1.0.0.min.css">      
        <link rel="stylesheet" type="text/css" href="estilos.css" />

        <title> 
            <?php // Print the page title. 
        if (defined('TITLE')) { // Is the title defined?
           print TITLE;
        } else { // The title is not defined.
          print 'Raise High the Roof Beam! A J.D. Salinger Fan Club';
        }
         ?> 
         </title>
    </head>
    <body>
<header>
    <div class="topbar-wrapper" style="z-index: 5;">
         <div class="topbar">
              <div class="container fixed">
                   <h4><a class="logo" href="">Cover your page</a></h4>
                       <ul>
                            <li class="active"><a class="nav-link active" href="index.php"> Home </a></li>
                            <li> <a class="nav-link" href="calendar.php"> Calendar </a> </li>
                            <li> <a class="nav-link" href="Calculator.php"> Calculator </a></li>
                            <li> <a class="nav-link" href="register.php"> Register </a> </li>
                            <li> <a class="nav-link" href="comments.php"> Comments </a> </li>
                          <!--  <li> <a class="nav-link" href="mysqli.php">View Comments</a> </li>
                            <li> <a class="nav-link" href="change_password.php"> Change Password </a> </li>
                            <li> <a class="nav-link"href="view_users.php">View Users</a> </li>
                            <li> <a class="nav-link active" href="images.php"> Images </a> </li>
                            <li> <a class="nav-link" href="upload_image.php"> Upload Images </a> </li>
                            <li> <a class="nav-link" href="view_urls.php"> Views URLs </a> </li>
                            <li> <a class="nav-link" href="add_url.php"> Add To Url </a> </li>
                            <li> <a class="nav-link" href="view_files.php">Views Files</a> </li>
                            <li> <a class="nav-link" href="add_file.php" >Add File</a> <l/i>
                            <li> <a class="nav-link" href="files.php" > Files </a> </li>
                            <li> <a class="nav-link" href="read_files.php" > Read Files </a> </li>
                            <li> <?php
                                      if (isset($_SESSION['nickName']) AND ( substr($_SERVER['PHP_SELF'], -10) != 'logout.php')) {
                                          echo '<a class="nav-link" class href="logout.php">Logout</a>';
                                       } else {
                                          echo '<a class="nav-link" href="login.php">Login</a>';
                                        }
                            ?> </li> -->
        </ul>
        <form action="">
          <input type="text" placeholder="Search">
        </form>
        <ul class="nav secondary-nav">
          <li class="menu">
            <a href="#" class="menu">Dropdown</a>
            <ul class="menu-dropdown" style="display: none;">
              <li><a href="">Secondary link</a></li>
              <li><a href="">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="">Another link</a></li>
            </ul>
        </ul> 
              </div>
         </div>
     </div>
    </heahder>
        
        
 