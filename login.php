<!DOCTYPE html>
<html class="full_height">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Joshua Devine and Abdullah Chaudry">
    <meta name="description" content="Let Coiner handle all your Cryptocurrency needs">

    <title>Log In to Coiner</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="res/styles.css" />

</head>

<header id="login_header" class="no_height">
    <h1><br class="no_height">LOG<i style="color: green">IN</i></h1>
</header>

<?php session_start(); ?>

<body class="full_height">
   <div class="container h-100 d-flex justify-content-center">
      <div class="jumbotron my-auto">
         <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return checkLogin()">
            <div class="form-group">
               <div class="form-group">
                  <label>E-Mail Address: </label>
                  <input type="username" name="username" class="form-control" placeholder="email" autofocus required /> <br/>
               </div>
               <div class="form-group">
                  <label>Password:</label>
                  <input type="password" name="pwd" class="form-control" required /> <br/>
               </div>
            </div>
            <div class="form-group">
               <div class="row">
                  <div class="col-6">
                     <input class="btn btn-outline-success" type="submit" value="Login" style="width: 100%" />
                  </div>
                  <div class="col-6">
                     <input class="btn btn-outline-success" type="submit" value="Signup" style="width: 100%" />     
                  </div>
               </div>
            </div>
         </form>
      </div>
  </div>
</body>

<?php require("connect-db.php") ?>

<?php
// Define a function to handle failed validation attempts 
function reject($entry)
{
   echo 'rejected due to: ' . $entry . "<br/>";
   exit();    // exit the current script, no value is returned
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && strlen($_POST['username']) && strlen($_POST['pwd']))
{
   $user = trim($_POST['username']);
   $pass = $_POST['pwd'];
		
   if (!ctype_alnum($pass))
      reject('Password');
      
   // validation
   global $db;

   $query = "SELECT username, password FROM wallets WHERE username = :username";
   $statement = $db->prepare($query);
   $statement->bindValue('username', $user);
   $statement->execute();
   $results = $statement->fetchAll();
   $statement->closeCursor();

   if (!count($results))
      reject('User Name');

   // $hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);
   // $hash_pwd = password_hash($pwd, PASSWORD_BCRYPT);
   if (md5($pass) != $results[0]["password"])
      reject('Password');
   
   // set session attributes
   $_SESSION['user'] = $user;
   $_SESSION['pwd'] = $hash_pwd;
   
   // redirect the browser to another page using the header() function to specify the target URL
   header('Location: index.php');

}
?>

</html>
