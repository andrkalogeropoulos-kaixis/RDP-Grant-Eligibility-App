<!-- ΣΥΝΔΕΣΗ ΜΕ ΒΑΣΗ ΔΕΔΟΜΕΝΩΝ -->

<?php session_start(); 

// Replace with your database credentials
$link = mysqli_connect('localhost', 'your_username', 'your_password');  

if (!$link)  

{  

  $error = 'Error: Η σύνδεση με την βάση δεν είναι δυνατή. Δοκιμάστε αργότερα.';  

  include 'error.html.php';  

  exit();  

}  

  

if (!mysqli_set_charset($link, 'utf8'))  

{  

  $error = 'Unable to set database connection encoding.';  

  include 'error.html.php';  

  exit();  

}  

  

if (!mysqli_select_db($link, 'points_paa'))  

{  

  $error = 'Unable to locate the database.';  

  include 'error.html.php';  

  exit();  

}

?>

