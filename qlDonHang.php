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
                        <thead>
                            <tr>
                                <th class="text-center">PNR number</th>
                                <th class="text-center">Payment ID </th>
                                <th class="text-center">Date of reservation</th>
                                <th class="text-center">Flight number</th>
                                <th class="text-center">Journey date</th>
                                <th class="text-center">class</th>
                                <th class="text-center">booking status</th>
                                <th class="text-center">no_of_passengers</th>
                                <th class="text-center">payment mode</th>
                                <th class="text-center">Details</th>
                                <th class="text-center">Confirm</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conn = createDBConnection();
                            $sql = "SELECT * FROM  ticket_details td, payment_details pd WHERE td.pnr = pd.pnr";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td class="text-center text-muted"><?= $row['pnr'] ?></td>
                                    <td class="text-center text-muted"><?= $row['payment_id'] ?></td>
                                    <td class="text-center text-muted"><?= $row['date_of_reservation'] ?></td>
                                    <td class="text-center text-muted"><?= $row['flight_no'] ?></td>
                                    <td class="text-center text-muted"><?= $row['journey_date'] ?></td>
                                    <td class="text-center text-muted"><?= $row['class'] ?></td>
                                    <td class="text-center text-muted"><?= $row['booking_status'] ?></td>
                                    <td class="text-center text-muted"><?= $row['no_of_passengers'] ?></td>
                                    <td class="text-center text-muted"><?= $row['payment_mode'] ?></td>
                                    <td class="text-center text-muted">
                                        <a href="detailCus.php?pnr=<?= $row['pnr'] ?>&&payment_amount=<?= $row['payment_amount'] ?>"><button type="button" class="mr-2 btn-icon btn-icon-only btn btn-outline-info">Details</button></a>
                                    </td>
                                    </td>
                                    <td class="text-center text-muted"><?php
                                                                        if ($row['booking_status'] == "PENDING") {
                                                                        ?>
                                            <a href="confirmticket.php?pnr=<?= $row['pnr'] ?>"><button type="button" class="mr-2 btn-icon btn-icon-only btn btn-outline-info">CONFIRM</button></a>
                                        <?php
                                                                        } else { ?>
                                            <a href="confirmticket.php?pnr=<?= $row['pnr'] ?>"><button type="button" class="mr-2 btn-icon btn-icon-only btn" disabled>CONFIRM</button></a>
                                        <?php
                                                                        }

                                        ?>
                                    </td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-block text-center card-footer">
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/main1.js"></script>

</body>

</html>