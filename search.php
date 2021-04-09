<!DOCTYPE html> 
<html> 

<head> 

<title>Coiner</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Joshua Devine and Abdullah Chaudry">
<meta name="description" content="Let Coiner handle all your Cryptocurrency needs">

<title>Coiner</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link rel="stylesheet" href="styles.css" />

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script><param name="" value="">
<script src="search.js"></script>
<script src="coins.js"></script>
</head>

<body> 
    <?php include("header.php") ?>  
    
    <input id="main-search-bar" onkeyup="searchCoins()" type="text" name="search" placeholder="Search coins...">
    
    <!-- The current list of available cryptos-->
    <div class="container search-list">
        <ul class='table table-responsive'>
            <ul id="coin-list" type="circle"><br/></ul>
        </ul>
    </div>
    
    <script>
        var coins = ["Bitcoin", "Bitcoin Cash", "Cardano", "Chainlink", "Dogecoin", "Etherium", "Litecoin", "Polkadot", "Stellar"];
        
        makeSearchList(coins);
    </script>

    <?php include("footer.php") ?>
</body>

</html> 