<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
  
  <title>PHP form handling</title>    
</head>
<body>
  
  <div class="container">
  <header id="login_header" class="no_height">
    <h1><br class="no_height">LOG<i style="color: green">IN</i></h1>
</header> 
<br/>
<br/>
<br/>
<body class="full_height">
<div class="container h-100 d-flex justify-content-center">
        <div class="jumbotron my-auto">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="form-group">
      E-mail Address: <input type="text" name="username" class="form-control" autofocus required /> <br/>
      </div>
      <div class="form-group">
      Password: <input type="password" name="pwd" class="form-control" required /> <br/>
      </div>
      <input class="btn btn-outline-success" type="Login" value="Login" class="btn btn-light"  />
      <input class="btn btn-outline-success" type="Signup" value="Signup" class="btn btn-light"  />     
      </div>
    </form>
  </div>
</body>


<?php session_start();     // make sessions available
// Session data are accessible from an implicit $_SESSION global array variable
// after a call is made to the session_start() function.
?>

<?php
// Define a function to handle failed validation attempts 
function reject($entry)
{
//    echo 'Please <a href="login.php">Log in </a>';
   exit();    // exit the current script, no value is returned
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && strlen($_POST['username']) > 0)
{
   $user = trim($_POST['username']);
   if (!ctype_alnum($user))   // ctype_alnum() check if the values contain only alphanumeric data
      reject('User Name');
		
   if (isset($_POST['pwd']))
   {
      $pwd = trim($_POST['pwd']);
      if (!ctype_alnum($pwd))
         reject('Password');
      else
      {
         // set session attributes
         $_SESSION['user'] = $user;
         
         $hash_pwd = md5($pwd);
//          $hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);
//          $hash_pwd = password_hash($pwd, PASSWORD_BCRYPT);
         
         $_SESSION['pwd'] = $hash_pwd;
         
         // redirect the browser to another page using the header() function to specify the target URL
         header('Location: index.php');
      }
   }
}

?>


</body>
</html>
