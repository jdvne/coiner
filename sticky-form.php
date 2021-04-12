<?php
$name = $email = NULL;
$name_msg = $email_msg = NULL;

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['name']))
   $name = $_GET['name'];

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
   if (empty($_POST['name'])) 
      $name_msg = "Please enter your name";
   else
   {
      $name = trim($_POST['name']);
      // You may reset $name_msg and use it to determine
      // when to display an error message  
      // $name_msg = "";     
   }
			 
   if (empty($_POST['emailaddr']))
      $email_msg = "Please enter your email address";
   else
   {
      $email = trim($_POST['emailaddr']);
      // You may reset $email_msg and use it to determine
      // when to display an error message
      // $email_msg = "";      
   }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">   
  <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title>PHP: Form handling</title>

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
    .greeting { padding: 20px; } 
   </style>
   
</head>
<body>
  
<!-- inlcude header here -->

<span class="greeting">
<?php 
// if the user has logged in successfully, greet the user
// else force login
if (isset($name))   
   echo "Hello, $name <br/>";
else 
   header("Location: login.php");     // redirect user to the login page    		
?>
</span>


<div class="container">

   <h1>PHP: Form Handling</h1>
      
 
   <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
     <label>Name: </label>
     <input type="text" name="name" 
            value="<?php if (isset($_POST['name'])) echo $_POST['name']; 
                         elseif (isset($_GET['name'])) echo $_GET['name']; ?>"
            <?php if (empty($_POST['name'])) { ?> autofocus <?php } ?>  />
     <span class="msg"><?php if (empty($_POST['name'])) echo '<br/>' . $name_msg ?></span>
<!--      <br/> -->
     
     <label>Email:</label>
     <input type="email" name="emailaddr" 
            value="<?php if (isset($_POST['emailaddr'])) echo $_POST['emailaddr'] ?>"
            <?php if (empty($_POST['emailaddr'])) { ?> autofocus <?php } ?>  />
     <span class="msg"><?php if (empty($_POST['emailaddr'])) echo '<br/>' . $email_msg ?></span> 
<!--      <br/> -->
     
     <label>Comment: </label>
     <textarea rows="5" cols="40" name="comment"  
            <?php if (empty($_POST['comment'])) { ?> autofocus <?php } ?> ><?php if (isset($_POST['comment'])) echo $_POST['comment'] ?></textarea>
     <span class="msg"><?php if (empty($_POST['comment'])) echo '<br/>' . $comment_msg ?></span> 
<!--      <br/> -->
     
     <input type="submit" value="Submit" class="btn btn-secondary" />
   </form>


<?php
if ($name != NULL && $email != NULL && $comment != NULL)
{
   echo "<hr/>";
   echo "Thanks for this comment, $name <br />";
   echo "<i>$comment</i> <br />";
   echo "We will reply to $email <br /><br />";
	
   $confirm = "Thanks for this comment, $name \n";
   $confirm .= "$comment \n";
   $confirm .= "We will reply to $email \n";

   $fname = 'comment.txt';
   include('file-processing.php');
   write_to_file($fname, $confirm);
} 
?>      

</div>
<!-- inlcude footer here -->
  
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>    

</body>
</html>