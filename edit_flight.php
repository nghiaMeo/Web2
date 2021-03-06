<?php
require_once('libraAd.php');
$conn = createDBConnection();
if(isLoginAd()){
if (isset($_REQUEST['btnsubmit'])) {

    $sql = sprintf(
        "UPDATE flight_details 
        SET flight_no='%s',from_city='%s',to_city='%s',departure_date='%s'
        ,arrival_date='%s',departure_time='%s',arrival_time='%s',seats_economy=%s,
        seats_business=%s,price_economy=%s,price_business=%s,jet_id='%s'
        WHERE flight_no='%s'", 
        $_REQUEST['flight_no'],
        $_REQUEST['from'],
        $_REQUEST['to'],
        $_REQUEST['departure_date'],
        $_REQUEST['arrival_date'],
        $_REQUEST['departure_time'],
        $_REQUEST['arrival_time'],
        $_REQUEST['number_econ'],
        $_REQUEST['number_bus'],
        $_REQUEST['price_econ'],
        $_REQUEST['price_bus'],
        $_REQUEST['jet_id'],
        $_REQUEST['flight_no'],
    );
    if ($conn->query($sql) == true) {
        echo '<script>alert("Edit flight success!"); window.location="flight_management.php";</script>';
    } else {
        echo '<script>alert("Please check input information"); window.location="edit_flight.php";</script>';
    }
    $conn->close();
} else {
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>Edit Flight</title>
        <link href="css/main.css" rel="stylesheet">
        <link href="css/fontAwesome.css" rel="stylesheet">
    </head>

    <body>
        <div class="app-header header-shadow" style="background-color:rgb(54, 50, 50);">
            <div class="app-header__logo">
                <img src="img/logo.png" alt="">
            </div>
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
                        <a href="admin.php">
                            <button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning"><i class="nav-link-icon fa fa-home"> Home</i></button>
                        </a>
                        <a href="flight_management.php">
                            <button class="mr-2 btn-icon btn-icon-only btn btn-outline-success"><i class="nav-link-icon fa fa-plane"> Flights Management</i></button>
                        </a>
                        <a href="qlDonHang.php">
                            <button class="mr-2 btn-icon btn-icon-only btn btn-outline-success"><i class="nav-link-icon fa fa-list"> Order management</i></button>
                        </a>
                    </ul>
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0"></div>
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <?php
                                if (isLoginAd()) {
                                ?>
                                    <a href="LogoutAd.php"><button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning"><i class="nav-link-icon fa fa-sign-out">LOGOUT</i></button></a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-left: 23%;" class="col-md-7">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title" style="text-align: center;">Edit Flights</h5>
                        <?php
                        $conn = createDBConnection();
                        $sql = sprintf(
                            "SELECT * FROM flight_details WHERE flight_no='%s' and departure_date='%s'",
                            $_REQUEST['flight_no'],
                            $_REQUEST['departure_date']
                        );
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        ?>
                        <form class="" action="edit_flight.php" method="GET">
                            <div class="form-row">
                                <div class="col-md-5">
                                    <div class="position-relative form-group">
                                        <label>Flight No</label>
                                        <input name="flight_no" id="exampleEmail11" placeholder="Ex: C01" value="<?= $row['flight_no'] ?>" type="text" required class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="col-md-4">
                                    <label for="deparure" style="margin-left: 20px;">From</label>
                                    <select required name='from' style="margin-left: 1em;" id="from" class="form-control">
                                        <option value="Japan">Japan</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="India">India</option>
                                        <option value="Korea">Korea</option>
                                        <option value="Laos">Laos</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Vietnam">Viet Nam</option>
                                    </select>
                                    <script>
                                        document.getElementById('from').value = "<?= $row['from_city'] ?>"
                                    </script>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="deparure" style="margin-left: 20px;">To</label>
                                        <select required name='to' id="to" style="margin-left: 1em;" class="form-control">
                                            <option value="Japan">Japan</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="India">India</option>
                                            <option value="Korea">Korea</option>
                                            <option value="Laos">Laos</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Vietnam">Viet Nam</option>
                                        </select>
                                        <script>
                                            document.getElementById('to').value = "<?= $row['to_city'] ?>"
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="deparure" style="margin-left: 20px;">Departure Date</label>
                                    <input type="date" value="<?= $row['departure_date'] ?>" name="departure_date" class="form-control" style="margin-left: 1em;" id="deparure" min=<?php $todays_date = date('Y-m-d');
                                                                                                                                                                                    echo $todays_date; ?> required="" disabled>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="deparure" style="margin-left: 20px;">Arrival Date</label>
                                        <input type="date" value="<?= $row['arrival_date'] ?>" name="arrival_date" class="form-control" style="margin-left: 1em;" min=<?php $todays_date =  $row['departure_date'];
                                                                                                                                                                        echo $todays_date; ?> id="deparure" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="deparure" style="margin-left: 20px;">Departure Time </label>
                                    <input type="time" value="<?= $row['departure_time'] ?>" name="departure_time" class="form-control" style="margin-left: 1em;" id="deparure" required="">
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="deparure" style="margin-left: 20px;">Arrival Time</label>
                                        <input type="time" value="<?= $row['arrival_time'] ?>" name="arrival_time" class="form-control" style="margin-left: 1em;" id="deparure" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="deparure" style="margin-left: 20px;">Number of Seats in Economy Class</label>
                                    <input type="number" value="<?= $row['seats_economy'] ?>" name="number_econ" class="form-control" style="margin-left: 1em;" id="deparure" required="">
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="deparure" style="margin-left: 20px;">Number of Seats in Business Class</label>
                                        <input type="number" value="<?= $row['seats_business'] ?>" name="number_bus" class="form-control" style="margin-left: 1em;" id="deparure" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="deparure" style="margin-left: 20px;">Ticket Price(Economy Class)</label>
                                    <input type="number" value="<?= $row["price_economy"] ?>" name="price_econ" class="form-control" style="margin-left: 1em;" id="deparure" required="">
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="deparure" style="margin-left: 20px;">Ticket Price(Business Class)</label>
                                        <input type="number" value="<?= $row["price_business"] ?>" name="price_bus" class="form-control" style="margin-left: 1em;" id="deparure" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-5">
                                    <div class="position-relative form-group">
                                        <label>Jet ID</label>
                                        <select required name='jet_id' style="margin-left: 1em;" class="form-control">
                                            <option value="<?= $row['jet_id'] ?>"><?= $row['jet_id'] ?></option>
                                            <?php
                                            $sql = "SELECT jet_id FROM jet_details";
                                            $result = $conn->query($sql);
                                            while ($row = $result->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $row['jet_id'] ?>"><?= $row['jet_id'] ?> </option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button class="mt-2 btn btn-primary" name="btnsubmit" value="btnsubmit">EDIT</button>
                        </form>
                    </div>
                </div>

            </div>
            <script type="text/javascript" src="js/main1.js"></script>
    </body>

    </html>
<?php
}
}else header("Location: LoginAd.php");
?>