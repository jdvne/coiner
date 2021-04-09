<div class="container">
    <div class="row">
        <div class="col-3">
            <h4>Purchase Bitcoin</h4>
        </div>
        <div class="col-9">
            - Your account balance (USD): 1203.56
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
                <button type="button" class="btn btn-secondary" style="margin-left:5px; width:33%">Purchase</button>
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
            - Your account balance (BTC): 0.2356
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
    // check that cost < USD balance
        // error if insufficient funds
    // update user row with USD balance - cost and coin balance + amount
}

function sellCoin(){
    // get amount owned
    // check that amount owned > amount specified
        // error if insufficient coin funds
    // get total sale amount
    // update user row with USD balance + sale amount and coin balance - amount
}
?>