<!DOCTYPE html>
<html class="full_height">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="author" content="Joshua Devine and Abdullah Chaudry">
   <meta name="description" content="Let Coiner handle all your Cryptocurrency needs">

   <title>Log In to Coiner</title>

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
   <link rel="stylesheet" href="res/styles.css" />

</head>

<header id="login_header" class="no_height">
   <?php if (isset($_GET['reject'])) echo "<div class='alert alert-warning'>" . $_GET['reject'] . "</div>"; ?>
   <h1><?php if (!isset($_GET['reject'])) { ?>
         <br class="no_height" />
      <?php } ?>
      LOG<i style="color: green">IN</i></h1>
</header>

<?php session_start(); ?>

<body class="full_height">
   <div class="container h-100 d-flex justify-content-center">
      <div class="jumbotron my-auto">
         <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return checkLogin()">
            <div class="form-group">
               <div class="form-group">
                  <label>E-Mail Address: </label>
                  <input type="username" name="username" class="form-control" placeholder="email" autofocus required /> <br />
               </div>
               <div class="form-group">
                  <label>Password:</label>
                  <input type="password" name="pwd" class="form-control" required /> <br />
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

// handle failed validation attempts 
function reject($reason)
{
   header("Location: login.php?reject=" . $reason);
   exit();    // exit the current script, no value is returned
}

// handle login requests
if ($_SERVER['REQUEST_METHOD'] == "POST" && strlen($_POST['username']) && strlen($_POST['pwd'])) {
   $user = trim($_POST['username']);
   $pass = $_POST['pwd'];

   if (!ctype_alnum($pass))
      reject("Password contains non-alphanumeric characters.");

   // get username + hashed password from database
   global $db;
   $query = "SELECT username, password FROM wallets WHERE username = :username";
   $statement = $db->prepare($query);
   $statement->bindValue('username', $user);
   $statement->execute();
   $results = $statement->fetchAll();
   $statement->closeCursor();

   if (!count($results))
      reject('E-Mail is not registered.');

   if (md5($pass) != $results[0]["password"])
      reject('Password is incorrect.');

   // set session attributes
   $_SESSION['user'] = $user;
   $_SESSION['pwd'] = $hash_pwd;

   header('Location: index.php');
}
?>

</html>