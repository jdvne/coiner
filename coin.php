
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Joshua Devine and Abdullah Chaudry">
    <meta name="description" content="Let Coiner handle all your Cryptocurrency needs">

    <title>Coiner</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="res/styles.css" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script><param name="" value="">
    <script src="res/search.js"></script>
    <script src="res/coins.js"></script>

</head>

<body>
    <?php include("header.php") ?>

    <div class="jumbotron">
        <div class="container">
            <h1>Bitcoin</h1>
            <p class="text-center">Daily Change: <span id="featured-dc"></span></p>
            <div>
                <canvas id="canvas" height="400"></canvas>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['user'])) { require('connect-db.php'); loadWallet(); //// LOGGED IN?>
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <h4>Purchase Bitcoin</h4>
                </div>
                <div class="col-9">
                    - Your account balance (USD): <?php echo $_SESSION["wallet"]['balance']; ?>
                </div>
                <br>
                <br>
            </div>
            <form class="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
                <label for="coinAmount">Amount</label>
                <div class="row">
                    <div class="col-8">
                        <input type="number" class="form-control" id="coinAmount" placeholder="0.00" value="" required></input>
                        <div class="invalid-feedback">
                            Valid coin amount is required.
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" name="btnaction" value="buy" class="btn btn-secondary" style="margin-left:5px; width:33%">Purchase</button>
                    </div>
                </div>
                <br>
                <br>
            </form>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-3">
                    <h4>Sell Bitcoin</h4>
                </div>
                <div class="col-9">
                    - Your account balance (BTC): <?php echo $_SESSION["wallet"]['Bitcoin']; ?>
                </div>
                <br>
                <br>
            </div>
            <form class="form">
                <label for="coinAmount">Amount</label>
                <div class="row">
                    <div class="col-8">
                        <input type="number" class="form-control" id="coinAmount" placeholder="0.00" value="" required></input>
                        <div class="invalid-feedback">
                            Valid coin amount is required.
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-secondary" style="margin-left:5px; width:33%">Sell</button>
                    </div>
                </div>
                <br>
                <br>
            </form>
        </div>
        <script>
            var coins = ["Bitcoin"];
            var featured = "Bitcoin";

            makeChart(featured);

            window.setInterval(function(){ 
            updateCoinValues(coins);
            updateFeaturedCoin(featured);
            updateChart(featured);
            }, 1000);
        </script>

    <?php } ?>

    <?php
    if (isset($_GET['btnaction']))
    {	
        try 
        { 	
            switch ($_GET['btnaction']) 
            {
                case 'buy': buyCoin(); break;
                case 'sell': sellCoin();  break;
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

    function buyCoin(){
        // get cost to purchase specified amount of coin
        $cost = 20;
        $amount = 55.533;

        loadWallet();

        // check that cost < USD balance
        // error if insufficient funds
        if ($_SESSION["wallet"]["balance"] < $cost) {
            echo "ERROR: insufficient funds";
            return;
        }

        // update wallet values
        $_SESSION["wallet"]["balance"] -= $cost;
        $_SESSION["wallet"]["Bitcoin"] += $amount;

        updateWallet();
    }

    function sellCoin(){
        // get amount owned
        $cost = 20;
        $amount = 55.533;

        loadWallet();

        // check that amount owned > amount specified
        // error if insufficient coin funds
        if($_SESSION['wallet']["Bitcoin"] < $amount) {
            echo "ERROR: insufficient coins";
            return;
        }

        // update wallet values
        $_SESSION["wallet"]["balance"] += $cost;
        $_SESSION["wallet"]["Bitcoin"] -= $amount;

        updateWallet();
    }
    ?>

    <?php include("footer.php") ?>

</body>
</html>