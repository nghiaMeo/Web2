<?php
require_once('libraAd.php');

?>
<!doctype html>
<html lang="en">

<head>
    <title>Management Orders</title>
    <link href="css/main.css" rel="stylesheet">
    <link href="css/fontAwesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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

                    <a href="qlUser.php">
                        <button class="mr-2 btn-icon btn-icon-only btn btn-outline-info"><i class="nav-link-icon fa fa-user"> Users</i></button>
                    </a>

                    <a href="Tickets.php">
                        <button class="mr-2 btn-icon btn-icon-only btn btn-outline-success"><i class="nav-link-icon fa fa-tickets"> Tickets</i></button>
                    </a>


                    <a href="Tickets.php">
                        <button class="mr-2 btn-icon btn-icon-only btn btn-outline-success"><i class="nav-link-icon fa fa-list"> Management Orders</i></button>
                    </a>

                </ul>
            </div>
            <div class="app-header-right">
                <div class="header-btn-lg pr-0">
                    <div class="widget-content p-0"></div>
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    <img width="42" class="rounded-circle" src="/Air/img/meo1.jpg" alt="">
                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                    <button type="button" tabindex="0" class="dropdown-item">Profile</button>
                                    <div tabindex="-1" class="dropdown-divider"></div>
                                    <button type="button" tabindex="0" class="dropdown-item">Log out</button>
                                </div>
                            </div>
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
                                <th class="text-center">Date of reservation</th>
                                <th class="text-center">Flight number</th>
                                <th class="text-center">Journey date</th>
                                <th class="text-center">class</th>
                                <th class="text-center">booking_status</th>
                                <th class="text-center">no_of_passengers</th>
                                <th class="text-center">payment mode</th>
                                <th class="text-center">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conn = createDBConnection();
                            $sql = "SELECT * FROM ticket_details td, payment_details pd, flight_details fd WHERE td.pnr = pd.pnr and fd.flight_no = td.flight_no ";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td class="text-center text-muted"><?= $row['pnr'] ?></td>
                                    <td class="text-center text-muted"><?= $row['date_of_reservation'] ?></td>
                                    <td class="text-center text-muted"><?= $row['flight_no'] ?></td>
                                    <td class="text-center text-muted"><?= $row['journey_date'] ?></td>
                                    <td class="text-center text-muted"><?= $row['class'] ?></td>
                                    <td class="text-center text-muted"><?= $row['booking_status'] ?></td>
                                    <td class="text-center text-muted"><?= $row['no_of_passengers'] ?></td>
                                    <td class="text-center text-muted"><?= $row['payment_mode'] ?></td>
                                    <td class="text-center text-muted"> <button type="button" class="mr-2 btn-icon btn-icon-only btn btn-outline-info" data-toggle="modal" data-target="#myModal">Details</button>

                                        <div style="margin-bottom: 40%;" class="modal fade" id="myModal" role="dialog">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    </div>
                                                    <div class="modal-body">
                                                        <table>
                                                            <?php
                                                            $query = sprintf("SELECT * FROM passengers WHERE pnr = %s", $row['pnr']);
                                                            $result1 = $conn->query($query);
                                                            
                                                            for ($i = 0; $i < $result1->num_rows; $i++) {
                                                                $rows = $result1->fetch_assoc();
                                                            ?>
                                                                
                                                                <tr style="background-color: rgb(51, 51, 204); color: white;">
                                                                    <th colspan="8" style="text-align: left;">2.Services</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Lounge Access</td>
                                                                    <td>Priority Checkin</td>
                                                                    <td>Insurance</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><?= $row['lounge_access'] ?></td>
                                                                    <td><?= $row['priority_checkin'] ?></td>
                                                                    <td><?= $row['insurance'] ?></td>
                                                                </tr>
                                                                <tr style="background-color: rgb(51, 51, 204); color: white;">
                                                                    <th colspan="8" style="text-align: left;">3.Informtaion Customer</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Passenger No</td>
                                                                    <td>Name</td>
                                                                    <td>Gender</td>
                                                                    <td>Age</td>
                                                                    <td>From - To</td>
                                                                    <td>departure_date-Arrival date</td>
                                                                    <td>Departure time-Arrival time</td>
                                                                    <td> Meail Choice</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><?= $rows['passenger_id'] ?></td>
                                                                    <td><?= $rows['name'] ?></td>
                                                                    <td><?= $rows['gender'] ?></td>
                                                                    <td><?= $rows['age'] ?></td>
                                                                    <td><?= $row['from_city'] . "-" . $row['to_city']  ?></td>
                                                                    <td><?= $row['departure_date'] . "-" . $row['arrival_date']  ?></td>
                                                                    <td><?= $row['departure_time'] . "-" . $row['arrival_time']  ?></td>
                                                                    <td><?= $rows['meal_choice'] ?> </td>
                                                                </tr>

                                                            <?php

                                                            } ?>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php

                            } ?>

                        </tbody>
                    </table>
                </div>
                <div class="d-block text-center card-footer">
                    <nav class="" aria-label="Page navigation example" style="padding-left: 520px;">
                        <ul class="pagination">
                            <li class="page-item "><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only"></span></a></li>

                            <li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only"></span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/main1.js"></script>
</body>

</html>