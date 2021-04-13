<header>
    <?php session_start(); ?>

    <nav class="navbar bg-custom navbar-expand-md bg-dark navbar-dark">
        <div style="padding-left: 3%"></div>
        <a class="navbar-brand" type="button" href="index.php">
            <h1><b>₵oin<i style="color: green">er</i></b></h1>
        </a>

        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <!-- USER IS NOT LOGGED IN -->
                <?php if (!isset($_SESSION['user'])) {
                ?>
                    <li class="nav-item" id="main-signup">
                        <a class="nav-link" type="button" onClick="parent.location='login.php'" value='click here' href="#">Sign Up</a>
                    </li>
                    <li class="nav-item" id="main-login">
                        <a class="nav-link" type="button" onClick="parent.location='login.php'" value='click here' href="#">Login</a>
                    </li>
                <!-- USER IS LOGGED IN -->
                <?php } else {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Hello, <b><?php echo $_SESSION['user'] ?></b>!</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF'] . '?logout=true'; ?>">Log Out</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <form class="form-inline">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="button" onClick="parent.location='search.php'" value='click here'>Explore Coins</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <?php
    // log user out on logout button press
    if (isset($_GET['logout'])) {
        if (count($_SESSION) > 0) {
            foreach ($_SESSION as $k => $v) {
                unset($_SESSION[$k]);
            }
            session_destroy();
            setcookie("PHPSESSID", "", time() - 3600, "/");
        }

        header("Location: " . $_SERVER["PHP_SELF"]);
    }
    ?>
</header>