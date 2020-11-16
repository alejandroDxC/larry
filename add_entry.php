<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Add a Blog Entry</title>
</head>
<body>
<h1>Add a Blog Entry</h1>
<?php // Script 12.4 - add_entry.php
/* This script adds a blog entry to the database. */
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form. Validate the form data:
    $problem = FALSE;
    if (!empty($_POST['title']) && !empty($_POST['entry'])) {
        $title = trim(strip_tags($_POST['title']));
        $entry = trim(strip_tags($_POST['entry']));
    } else {
        print '<p style="color: red;">Please submit both a title and an entry.</p>';
        $problem = TRUE;
    }
    if (!$problem) {// Connect and select:
        $dbc = mysqli_connect('localhost', 'username', 'password', 'myblog');
    }
}    