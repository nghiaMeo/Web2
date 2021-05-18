<?php
require_once('libraAd.php');
?>
<!doctype html>
<html lang="en">

<head>
    <title>Add Flight</title>
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
                    <h5 class="card-title" style="text-align: center;">Add Flights</h5>
                    <form class="" action="" method="">
                        <div class="form-row">
                            <div class="col-md-5">
                                <div class="position-relative form-group">
                                    <label>Flight No</label>
                                    <input name="flight_no" id="exampleEmail11" placeholder="Ex: C01" type="text" required class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="deparure" style="margin-left: 20px;">From</label>
                                <select required name='from' style="margin-left: 1em;" class="form-control">
                                    <option value="">Select a location...</option>
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
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deparure" style="margin-left: 20px;">To</label>
                                    <select required name='from' style="margin-left: 1em;" class="form-control">
                                        <option value="">Select a location...</option>
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
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="deparure" style="margin-left: 20px;">Departure Date</label>
                                <input type="date" name="dep_date" class="form-control" style="margin-left: 1em;" id="deparure" min=<?php $todays_date = date('Y-m-d');
                                                                                                                                    echo $todays_date; ?> required="">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deparure" style="margin-left: 20px;">Arrival Date</label>
                                    <input type="date" name="dep_date" class="form-control" style="margin-left: 1em;" min=<?php $todays_date = date('Y-m-d');
                                                                                                                            echo $todays_date; ?> id="deparure" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="deparure" style="margin-left: 20px;">Departure Time </label>
                                <input type="time" name="dep_date" class="form-control" style="margin-left: 1em;" id="deparure" required="">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deparure" style="margin-left: 20px;">Arrival Time</label>
                                    <input type="time" name="dep_date" class="form-control" style="margin-left: 1em;" id="deparure" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="deparure" style="margin-left: 20px;">Number of Seats in Economy Class</label>
                                <input type="number" name="" class="form-control" style="margin-left: 1em;" id="deparure" required="">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deparure" style="margin-left: 20px;">Number of Seats in Business Class</label>
                                    <input type="number" name="" class="form-control" style="margin-left: 1em;" id="deparure" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="deparure" style="margin-left: 20px;">Ticket Price(Economy Class)</label>
                                <input type="number" name="dep_date" class="form-control" style="margin-left: 1em;" id="deparure" required="">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deparure" style="margin-left: 20px;">Ticket Price(Business Class)</label>
                                    <input type="number" name="dep_date" class="form-control" style="margin-left: 1em;" id="deparure" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-5">
                                <div class="position-relative form-group">
                                    <label>Jet ID</label>
                                    <input name="flight_no" id="exampleEmail11" placeholder="Ex: C01" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <button class="mt-2 btn btn-primary">ADD</button>
                    </form>
                </div>
            </div>

        </div>
        <script type="text/javascript" src="js/main1.js"></script>
</body>

</html>