<?php

/******************************/
// connecting to GCP cloud SQL instance

// $username = 'root';
// $password = 'your-root-password';

// $dbname = 'your-database-name';

// if PHP is on GCP standard App Engine, use instance name to connect
// $host = 'instance-connection-name';

// if PHP is hosted somewhere else (non-GCP), use public IP address to connect
// $host = "public-IP-address-to-cloud-instance";

/******************************/
// connecting to DB on XAMPP (local)

$hostname = 'localhost:3306';
$dbname = 'coinerdb';
$username = 'coiner';
$password = 'password';

/******************************/

// DSN (Data Source Name) specifies the host computer for the MySQL database 
// and the name of the database. If the MySQL database is running on the same server
// as PHP, use the localhost keyword to specify the host computer

$dsn = "mysql:host=$hostname;dbname=$dbname";
$db = "";

// To connect to a MySQL database named web4640, need three arguments: 
// - specify a DSN, username, and password

// Create an instance of PDO (PHP Data Objects) which connects to a MySQL database
// (PDO defines an interface for accessing databases)
// Syntax: 
//    new PDO(dsn, username, password);


/** connect to the database **/
try 
{
//  $db = new PDO("mysql:host=$hostname;dbname=$dbname, $username, $password);
   $db = new PDO($dsn, $username, $password);
   
}
catch (PDOException $e)     // handle a PDO exception (errors thrown by the PDO library)
{
   // Call a method from any object, use the object's name followed by -> and then method's name
   // All exception objects provide a getMessage() method that returns the error message 
   $error_message = $e->getMessage();        
   echo "<p>An error occurred while connecting to the database: $error_message </p>";
}
catch (Exception $e)       // handle any type of exception
{
   $error_message = $e->getMessage();
   echo "<p>Error message: $error_message </p>";
}

function loadWallet(){
   global $db;
   $query = "SELECT * FROM wallets WHERE username = :user";
   $statement = $db->prepare($query);
   $statement->bindValue('user', $_SESSION["user"]);
   $statement->execute();
   $results = $statement->fetchAll();
   $statement->closeCursor();

   $_SESSION['wallet'] = $results[0];
}

function updateWallet(){
   global $db;
   $query = "UPDATE wallets
            SET balance = :balance,
            Bitcoin = :bitcoin,
            Etherium = :etherium,
            Dogecoin = :dogecoin,
            Litecoin = :litecoin,
            Cardano = :cardano,
            Stellar = :stellar,
            Chainlink = :chainlink,
            Polkadot = :polkadot
            WHERE username = :username";

   $statement = $db->prepare($query);
   $statement->bindValue('username', $_SESSION['user']);
   $statement->bindValue('balance', $_SESSION['wallet']['balance']);
   $statement->bindValue('bitcoin', $_SESSION['wallet']['Bitcoin']);
   $statement->bindValue('etherium', $_SESSION['wallet']['Etherium']);
   $statement->bindValue('dogecoin', $_SESSION['wallet']['Dogecoin']);
   $statement->bindValue('litecoin', $_SESSION['wallet']['Litecoin']);
   $statement->bindValue('cardano', $_SESSION['wallet']['Cardano']);
   $statement->bindValue('stellar', $_SESSION['wallet']['Stellar']);
   $statement->bindValue('chainlink', $_SESSION['wallet']['Chainlink']);
   $statement->bindValue('polkadot', $_SESSION['wallet']['Polkadot']);
   $statement->execute();
   $statement->closeCursor();
}
?>