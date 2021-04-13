<header>
    <?php session_start(); ?>

    <nav class="navbar bg-custom navbar-expand-md bg-dark navbar-dark">
        <div style="padding-left: 3%"></div>
        <a class="navbar-brand" type="button" href="#"><h1><b>₵oin<i style="color: green">er</i></b></h1></a>

        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <?php if (!isset($_SESSION['user'])) { //// NOT LOGGED IN?>
                    <li class="nav-item" id="main-signup">
                        <a class="nav-link" type="button" onClick="parent.location='login.html'" value='click here' href="#">Sign Up</a>
                    </li>
                    <li class="nav-item" id="main-login">
                        <a class="nav-link" type="button" onClick="parent.location='login.html'" value='click here' href="#">Login</a> 
                    </li>
                <?php } else { //// LOGGED IN?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Hello, <b><?php echo $_SESSION['user'] ?></b>!</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Log Out</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <form class="form-inline">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="button" onClick="parent.location='search.html'" value='click here'>Explore Coins</button>                        
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <?php
    function logout(){
        if(isset($_GET[]))
    }
    ?>
</header>