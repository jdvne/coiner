<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
  
  <title>PHP form handling</title>    
</head>
<body>

<?php session_start(); // make sessions available ?>
  
  <div class="container">
    <h1>CS4640 Survey</h1>
    <h3>Summary</h3>
      Question 1: What did you have for lunch?
      <ul>
        <li>You answered <?php if (isset($_SESSION['lunch'])) echo $_SESSION['lunch']; ?>
      </ul>
      Question 2: Who is your most favorite instructor?
      <ul>
        <li>You answered <?php if (isset($_SESSION['favorite_instr'])) echo $_SESSION['favorite_instr']; ?> 
      </ul>
    </p>    
    
    Successfully logged out 
  </div>

<?php
// Set session variables can be removed by specifying their element name to unset() function.
// A session can be completely terminated by calling the session_destroy() function.

if (count($_SESSION) > 0)     // Check if there are session variables
{   
   foreach ($_SESSION as $key => $value)
   {
      // Deletes the variable (array element) where the value is stored in this PHP.
      // However, the session object still remains on the server.    	
      unset($_SESSION[$key]);      
   }       
   session_destroy();     // complete terminate the session instance
      
   // redirect to the login page immediately 
//    header('Location: login.php');

   // redirect with 5 seconds delay
   header('refresh:5; url=login.php');
}

?>


</body>
</html>
