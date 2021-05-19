<?php
require_once('libraAd.php');

?>
<!doctype html>
<html lang="en">

<head>
    <title>Management Orders</title>
    <link href="css/main.css" rel="stylesheet">
    <link href="css/fontAwesome.css" rel="stylesheet">
    <style>
        .pager {
            padding-left: 0;
            margin: 20px 0;
            text-align: center;
            list-style: none
        }

        .pager li {
            display: inline
        }

        .pager li>a,
        .pager li>span {
            display: inline-block;
            padding: 5px 14px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 15px
        }

        .pager li>a:hover,
        .pager li>a:focus {
            text-decoration: none;
            background-color: #eee
        }

        .pager .next>a,
        .pager .next>span {
            float: right
        }

        .pager .previous>a,
        .pager .previous>span {
            float: left
        }

        .pager .disabled>a,
        .pager .disabled>a:hover,
        .pager .disabled>a:focus,
        .pager .disabled>span {
            color: #777;
            cursor: not-allowed;
            background-color: #fff
        }
    </style>

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
                    <a href="qlDonhang.php">
                        <button class="mr-2 btn-icon btn-icon-only btn btn-outline-success"><i class="nav-link-icon fa fa-list"> Management Orders</i></button>
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
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header">
                    <h4>Management Orders</h4>

                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">

                        <tbody>
                            <?php
                            $conn = createDBConnection();
                            $sql = "SELECT *
                              from passengers pass, ticket_details td,flight_details fd where pass.pnr='" . $_REQUEST['pnr'] . "' and td.flight_no = fd.flight_no and td.pnr=pass.pnr ";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                            ?><tr style="background-color: rgb(51, 51, 204); color: white;">
                                    <th colspan="8">Flight information</th>
                                </tr>

                                <tr>
                                    <td>Passenger No</td>
                                    <td>Name</td>
                                    <td>Gender</td>
                                    <td>Age</td>
                                    <td>From - To</td>
                                    <td>Departure date->Arrival date</td>
                                    <td>Departure time-Arrival time</td>
                                    <td> Meail Choice</td>
                                </tr>
                                <tr>
                                    <td> <?= $row['passenger_id'] ?></td>
                                    <td> <?= $row['name'] ?></td>
                                    <td><?= $row['age'] ?></td>
                                    <td><?= $row['gender'] ?></td>
                                    <td><?= $row['from_city'] ?> - <?= $row['to_city'] ?></td>
                                    <td><?= $row['departure_date'] ?> -> <?= $row['arrival_date'] ?></td>
                                    <td><?= $row['departure_time'] ?> - <?= $row['arrival_time'] ?></td>
                                    <td><?php if ($row['meal_choice'] == '')
                                            echo "No";
                                        else echo $row['meal_choice'];
                                        ?></td>
                                </tr>
                                <tr>
                                    <th colspan="8" style="text-align: left;">Services</th>
                                </tr>
                                <tr>
                                    <td>Lounge Access</td>
                                    <td>Priority Checkin</td>
                                    <td colspan="8">Insurance</td>
                                </tr>
                                <tr>
                                    <td> <?php echo $row['lounge_access']; ?> </td>
                                    <td> <?php echo $row['priority_checkin']; ?> </td>
                                    <td> <?php echo $row['insurance']; ?> </td>
                                </tr>
                            <?php
                            }

                            ?>
                        </tbody>
                    </table>
                    <h4 style="margin-left: 80%;">Total: $<?= $_REQUEST['payment_amount']?></h4>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/main1.js"></script>

</body>

</html>