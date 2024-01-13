<?php
require "../functions/formfunctions.php";

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['studentLogin'])) {
        $errors = studentLogin($_POST);
    } elseif (isset($_POST['teacherLogin'])) {
        $errors = teacherLogin($_POST);
    }

}
?>

<!DOCTYPE html>
<html lang="en">
  <body>
    
<div class="background-image"></div>
  <style>@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
</style>

  
    <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Nemo Test</title>
    <link rel="stylesheet" href="../css/login.css">
   </head>
    <form action="" method="post">
    <div class="login-box">
      
      <div class="wlcm-back">
     <h1>Welcome back!</h1>
      <small>We're so excited to see you again!</small>
      </div>
      
      <reg1> EMAIL </reg1>
      <br>
      <input type="text" name="teacherEmail" id="teacherEmail" required>
      <br>
      <reg2> PASSWORD </reg2>
      <br>
      <input type="password" name="teacherPassword" id="teacherPassword" required>
      <br>
      <button type="submit" name="teacherLogin" onclick="submitForm()">Login</button>
    </div> 
    </form>

  </body>
</html>