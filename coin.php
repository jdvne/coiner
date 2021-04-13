<!DOCTYPE html>
<html>

<?php if (!isset($_GET['c'])) $_GET['c'] = "Bitcoin"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Joshua Devine and Abdullah Chaudry">
    <meta name="description" content="Let Coiner handle all your Cryptocurrency needs">

    <title><?php echo $_GET['c']; ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="res/styles.css" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <param name="" value="">
    <script src="res/search.js"></script>
    <script src="res/coins.js"></script>

</head>

<body>
    <?php include("header.php") ?>

    <div class="jumbotron">
        <div class="container">
            <h1><?php echo $_GET['c']; ?></h1>
            <p class="text-center">Daily Change: <span id="featured-dc"></span></p>
            <div>
                <canvas id="canvas" height="400"></canvas>
            </div>
        </div>
    </div>

    <!-- USER IS LOGGED IN -->
    <?php if (isset($_SESSION['user'])) {
        require('connect-db.php');
        loadWallet();
    ?>
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <h4>Purchase <?php echo $_GET['c']; ?></h4>
                </div>
                <div class="col-9">
                    - Your account balance (USD): <?php echo $_SESSION["wallet"]['balance']; ?>
                </div>
                <br>
                <br>
            </div>
            <form class="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <label for="coinAmount">Amount</label>
                <div class="row">
                    <div class="col-8">
                        <input type="number" class="form-control" id="coinAmount" placeholder="0.00" name="amount" required></input>
                        <div class="invalid-feedback">
                            Valid coin amount is required.
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" name="transact" value="buy" class="btn btn-secondary" style="margin-left:5px; width:33%">Purchase</button>
                    </div>
                </div>
                <br>
                <br>
            </form>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-3">
                    <h4>Sell <?php echo $_GET['c']; ?></h4>
                </div>
                <div class="col-9">
                    - Your <?php echo $_GET['c']; ?> balance: <?php echo $_SESSION["wallet"]['Bitcoin']; ?>
                </div>
                <br>
                <br>
            </div>
            <form class="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <label for="coinAmount">Amount</label>
                <div class="row">
                    <div class="col-8">
                        <input type="number" class="form-control" id="coinAmount" placeholder="0.00" name="amount" required></input>
                        <div class="invalid-feedback">
                            Valid coin amount is required.
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="button" name="transact" value="sell" class="btn btn-secondary" style="margin-left:5px; width:33%">Sell</button>
                    </div>
                </div>
                <br>
                <br>
            </form>
        </div>

    <?php } ?>

    <script>
        <?php echo "var featured = '" . $_GET['c'] . "';\n"; ?>
        var coins = [featured];

        makeChart(featured);

        window.setInterval(function() {
            updateCoinValues(coins);
            updateFeaturedCoin(featured);
            updateChart(featured);
        }, 1000);
    </script>

    <?php
    // handle transaction requests by the user
    if (isset($_POST['transact'])) {
        try {
            switch ($_POST['transact']) {
                case 'buy':
                    buyCoin();
                    break;
                case 'sell':
                    sellCoin();
                    break;
            }
        } catch (Exception $e)       // handle any type of exception
        {
            $error_message = $e->getMessage();
            echo "<p>Error message: $error_message </p>";
        }
    }

    // handle coin purchase by user
    function buyCoin()
    {
        if ($_POST["amount"] <= 0) return;

        // get cost to purchase specified amount of coin
        $cost =  $_POST["amount"] * 20;

        loadWallet();

        // check that cost < USD balance
        // error if insufficient funds
        if ($_SESSION["wallet"]["balance"] < $cost) {
            echo "ERROR: insufficient funds";
            return;
        }

        // update wallet values
        $_SESSION["wallet"]["balance"] -= $cost;
        $_SESSION["wallet"][$_GET['c']] += $_POST["amount"];

        updateWallet();
    }

    // handle coin sale by user
    function sellCoin()
    {
        if ($_POST["amount"] <= 0) return;

        // get amount owned
        $cost = $_POST["amount"] * 20;

        loadWallet();

        // check that amount owned > amount specified
        // error if insufficient coin funds
        if ($_SESSION['wallet'][$_GET['c']] < $_POST["amount"]) {
            echo "ERROR: insufficient coins";
            return;
        }

        // update wallet values
        $_SESSION["wallet"]["balance"] += $cost;
        $_SESSION["wallet"][$_GET['c']] -= $_POST["amount"];

        updateWallet();
    }
    ?>

    <?php include("footer.php") ?>

</body>

</html>