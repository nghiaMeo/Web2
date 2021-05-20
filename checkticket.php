<?php
require_once('libraCus.php');
$con = createDBConnection();
if (!isset($con)) {
    die("Database Not Found");
}


if (isset($_REQUEST["u_sub"])) {

    $id = $_GET['pnr'];

    if ($id != '') {
        $query = mysqli_query($con, "select * from ticket_details where pnr='" . $id . "'");
        $res = mysqli_fetch_row($query);

        if ($res) {
            header('location:pnrcheck.php?pnr=' . $_REQUEST["pnr"] . '');
        } else {

            echo '<script>';
            echo 'alert("PNR number does not exist")';
            echo '</script>';
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Check Tickets</title>
    <link href="css/main.css" rel="stylesheet">
    <link href="css/fontAwesome.css" rel="stylesheet">
</head>

<body>

    <div class="app-header header-shadow" style="background-color:rgb(54, 50, 50);">
        <?php
        if (isLoginedCus()) {
            echo "<div class=\"app-header__logo\">
            <a href=\"user.php\"><img src=\"img/logo.png\" ></a>
        </div>";
        } else {
            echo "<div class=\"app-header__logo\">
            <a href=\"index.php\"><img src=\"img/logo.png\" ></a>
        </div>";
        }
        ?>
        <div class="app-header__menu">
            <span>
                <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
                </button>
            </span>
        </div>
        <div class="app-header__content">
            <div class="app-header-left">
                <ul class="header-menu nav">
                    <?php
                    if (isLoginedCus()) {
                    ?>
                        <a href="user.php">
                            <button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning"><i class="nav-link-icon fa fa-home"> HOME</i></button>
                        </a>
                        <a href="bookedticket.php"><button class="mb-2 mr-2 btn-transition btn btn-outline-warning">BOOKED TICKET</button></a>
                        <a href="checkticket.php"><button class="mb-2 mr-2 btn-transition btn btn-outline-warning">CHECK TICKET</button></a>
                        <a href="reservationinfor.php"><button class="mb-2 mr-2 btn-transition btn btn-outline-warning">RESERVATION IFORMATION</button></a>

                    <?php
                    } else {
                    ?>
                        <a href="index.php">
                            <button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning"><i class="nav-link-icon fa fa-home"> HOME</i></button>
                        </a>
                        <a href="reservationinfor.php"><button class="mb-2 mr-2 btn-transition btn btn-outline-warning">RESERVATION IFORMATION</button></a>
                        <a href="checkticket.php"><button class="mb-2 mr-2 btn-transition btn btn-outline-warning">CHECK TICKET</button></a>

                    <?php
                    }
                    ?>
                </ul>
            </div>
            <?php
            if (!isLoginedCus()) {
            ?>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0"></div>
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="btn-group">
                                    <a href="SginIn.php"><button class="mb-2 mr-2 btn-transition btn btn-outline-warning">LOG IN
                                        </button></a>
                                    <a href="SignUp.php"><button class="mb-2 mr-2 btn-transition btn btn-outline-warning">SIGN UP
                                        </button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else {
            ?>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0"></div>
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <?php
                                        if (isLoginedCus()) {
                                            echo "<a href=\"LogoutCus.php\"><button class=\"mb-2 mr-2 btn-transition btn btn-outline-warning\"><i class=\"nav-link-icon fa fa-sign-out\">LOGOUT</i>
                                            </button></a>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="card-title text-center">Check Tickets</div>
                    <form id="index" action="checkticket.php" method="GET">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group" style="padding-left: 50%;">
                                    <label class="form-label " for="title">Enter your PNR number</label>
                                    <input id="pnr" name="pnr" type="text" class="form-control" placeholder="EX: 9235757" required />
                                    <p style="text-align: center;"><input style="margin: 5%;" class="mb-2 mr-2 btn-transition btn btn-outline-warning" id="u_sub" name="u_sub" type="submit" value="CHECK" /></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/main1.js"></script>
</body>

</html>