<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
  
  <title>PHP and MySQL database</title>    
</head>
<body>
  
  <div class="container">
    <h1>PHP and MySQL database</h1>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
      <input type="submit" name="btnaction" value="create" class="btn btn-light" />
      <input type="submit" name="btnaction" value="insert" class="btn btn-light" />
      <input type="submit" name="btnaction" value="select" class="btn btn-light" />
      <input type="submit" name="btnaction" value="update" class="btn btn-light" />
      <input type="submit" name="btnaction" value="delete" class="btn btn-light" />
      <input type="submit" name="btnaction" value="drop" class="btn btn-light" />
    </form>

<?php require('connect-db.php'); ?>

<?php 
if (isset($_GET['btnaction']))
{	
   try 
   { 	
      switch ($_GET['btnaction']) 
      {
         case 'create': createTable(); break;
         case 'insert': insertData();  break;
         case 'select': selectData();  break;
         case 'update': updateData();  break;
         case 'delete': deleteData();  break;
         case 'drop':   dropTable();   break;      
      }
   }
   catch (Exception $e)       // handle any type of exception
   {
      $error_message = $e->getMessage();
      echo "<p>Error message: $error_message </p>";
   }   
}
?>

<?php 
/*************************/
/** create table **/
function createTable()
{
  global $db;
  $query = "CREATE TABLE courses (
    course_ID VARCHAR(8) PRIMARY KEY,
    course_desc VARCHAR(225) NOT NULL )";

  $statement = $db->prepare($query);
  $statement->execute();

  $statement->closeCursor();
}
?>

<?php 
/*************************/
/** drop table **/
function dropTable()
{
  global $db;
  $query = "DROP TABLE courses";

  $statement = $db->prepare($query);
  $statement->execute();

  $statement->closeCursor();
	
}
?>

<?php 
/*************************/
/** insert data **/
function insertData()
{
  global $db;

  $course_id_form = 'cs1111'; // retrieve from form
  $course_desc_form = 'Intro';

  // $query = "INSERT INTO courses (course_ID, course_desc) VALUES ('cs4650', 'WebPL')";
  $query = "INSERT INTO courses (course_ID, course_desc) VALUES (:course_id, :course_desc)";

  $statement = $db->prepare($query);
  $statement->bindValue('course-id', $course_id_form);
  $statement->bindValue('course-desc', $course_desc_form);
  $statement->execute();

  $statement->closeCursor();
	
}
?>

<?php  
/*************************/
/** get data **/
function selectData()
{

  global $db;

  $query = "SELECT * FROM courses";

  $statement = $db->prepare($query);
  $statement->execute();

  $results = $statement->fetchAll();  // get array of all rows

  $statement->closeCursor();

  foreach ($results as $result){
    echo $result['course_id'] . ":" . $result['course_desc'] . "<br/>";
  }

	
}
?>

<?php
/*************************/
/** update data **/
function updateData()
{
  global $db;

  $query = "UPDATE courses SET course_desc = 'intro to CS' WHERE course_ID = 'cs1111'";

  $statement = $db->prepare($query);
  $statement->bindValue('course-id', $course_id_form);
  $statement->bindValue('course-desc', $course_desc_form);
  $statement->execute();

  $statement->closeCursor();
	
}
?>

<?php
/*************************/
/** delete data **/
function deleteData()
{
  global $db;

  $query = "DELETE FROM courses WHERE course_ID = 'cs1111'";

  $statement = $db->prepare($query);
  $statement->execute();

  $statement->closeCursor();
}
?>


  </div>
</body>
</html>