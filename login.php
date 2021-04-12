<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">   
  <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title>Coiner Login</title>
 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <style>
    label { display: block; }
    input, textarea { display:inline-block; font-family:arial; margin: 5px 10px 5px 40px; padding: 8px 12px 8px 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; width: 90%; font-size: small; }
    div { margin-left: auto; margin-right: auto; width: 60%; }
    h1 { text-align: center; }    
    input[type=submit] { padding:5px 15px; border:0 none; cursor:pointer; border-radius: 5px; } 
    .msg { margin-left:40px; font-style: italic; color: red; }    
    html{ height:100%; }
    body{ min-height:100%; padding:0; margin:0; position:relative; }    
    footer { position: absolute; bottom: 0; width: 100%; height: 50px; color: WhiteSmoke; padding: 10px; }
   </style>   
</head>
<body>

<?php session_start(); ?>
  
<!-- include header file here-->
<?php 
$number_attempt = 0; // null;  
if (isset($_GET['attempt'])) 
{
   //echo "You will be locked out after 3 incorrect attempts";
   echo "number of incorrect attempts =" . $_GET['attempt'] . "<br/>";
   $number_attempt = intval($_GET['attempt']);
   
   if (intval($_GET['attempt']) >= 3)
      echo "Too many incorrect attempts. Please contact the admin <br/>";
}
else 
   $number_attempt = 0;
?>
  
  <div>  
  <header id="login_header" class="no_height">
    <h1><br class="no_height">LOG<i style="color: green">IN</i></h1>
</header>   
<br/>
<br/>
<br/>
   <body class="full_height">
    <div class="container h-100 d-flex justify-content-center">
        <div class="jumbotron my-auto">
    <form action="login.php" method="post">
    <div class="form-group">
      <div class="form-group">
         E-mail Address: <input type="text" name="name" required /> <br/>
      </div>
      <div class="form-group">
      Password: <input type="password" name="pwd" required /> <br/>
      </div>
   </div>
      <input type="hidden" value="<?php if (isset($_GET['attempt'])) echo $_GET['attempt']  // $number_attempt?>" name="attempt" />
      <div class="col-6">
      <input class="btn btn-outline-success" type="submit" value="Login" class="btn btn-secondary"
         <?php if ($number_attempt >= 3) { ?> disabled  <?php } ?>/>
         </div>
      <div class="col-6">
      <input class="btn btn-outline-success" type="submit" value="Signup" class="btn btn-secondary" />
      </div>
    </form>
    </body>
    <span class="msg"><?php if (isset($_GET['msg'])) echo $_GET['msg'] ?></span>
  
 
<?php 



function authenticate()
{
   global $mainpage;
   global $number_attempt;

   // Assume there exists a hashed password for a user (username='demo', password='nan') 
   $hash = '$2y$10$7yMQ/KY5uHu1CwMBdptV5O12zpR9jJA4WcxAZxCT6zXIjyg8G4AWa';     // hash for 'demo'
   
   if ($_SERVER['REQUEST_METHOD'] == 'POST')
   {   	  
      $pwd = htmlspecialchars($_POST['pwd']);      
         
      if (password_verify($pwd, $hash))
      {  
         // successfully login, redirect a user to the main page
         header("Location: ".$mainpage . "?name=" . $_POST['name']);
         
         // Alternatively, we can hardcoard the redirected URL here
         // header("Location: http://localhost/cs4640/state-maintenance/inclass/hidden-input-URL-rewriting/sticky-form.php?name=" . $_POST['name']);
      }
      else  
      {
//          echo "<span class='msg'>Username and password do not match our record</span> <br/>";
         $number_attempt = intval($_POST['attempt']) + 1;
         header("Location: ". $_SERVER['PHP_SELF'] . "?attempt=$number_attempt&msg=Username and password do not match our record");
      }
   }	
}

$mainpage = "index.php";   
authenticate();


?>




    </div>

<!-- include footer here-->
  
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
</body>
</html>