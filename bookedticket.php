<?php
require_once('libraCus.php');
?>
<!doctype html>
<html lang="en">

<head>
    <title>
        View Booked Tickets
    </title>
    <link href="css/main.css" rel="stylesheet">
    <link href="css/fontAwesome.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">

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
                    <a href="checkticket.php"><button class="mb-2 mr-2 btn-transition btn btn-outline-warning">CHECK TICKET</button></a>
                    <?php
                    if (isLoginedCus()) {
                    ?>
                        <a href="bookedticket.php"><button class="mb-2 mr-2 btn-transition btn btn-outline-warning">BOOKED TICKET</button></a>

                    <?php
                    }
                    ?>
                </ul>
            </div>
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
        </div>
    </div>
    <br>
    <h2 style="text-align: center;"> BOOKED FLIGHT TICKETS</h2>
    <div style="padding-left: 11%;">
        <div class="col-md-11">
            <?php
            $todays_date = date('Y-m-d');
            $thirty_days_before_date = date_create(date('Y-m-d'));
            date_sub($thirty_days_before_date, date_interval_create_from_date_string("30 days"));
            $thirty_days_before_date = date_format($thirty_days_before_date, "Y-m-d");

            $customer_id = $_SESSION['customer_id'];
            $query = "SELECT pnr,date_of_reservation,flight_no,journey_date,class,booking_status,no_of_passengers,payment_id FROM Ticket_Details where customer_id=? AND journey_date>=? ORDER BY  journey_date";
            $stmt = mysqli_prepare($dbc, $query);
            mysqli_stmt_bind_param($stmt, "ss", $customer_id, $todays_date);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $pnr, $date_of_reservation, $flight_no, $journey_date, $class, $booking_status, $no_of_passengers, $payment_id);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 0) {
                echo "<h3><center>No upcoming trips!</center></h3>";
            } else {
                echo "<table border=\"1\" cellpadding=\"10\"";
                echo "<tr><th>PNR</th>
				<th>Date of Reservation</th>
				<th>Flight No.</th>
				<th>Journey Date</th>
				<th>Class</th>
				<th>Booking Status</th>
				<th>No. of Passengers</th>
				<th>Payment ID</th>
				</tr>";
                while (mysqli_stmt_fetch($stmt)) {
                    echo "<tr>
        			<td>" . $pnr . "</td>
        			<td>" . $date_of_reservation . "</td>
					<td>" . $flight_no . "</td>
					<td>" . $journey_date . "</td>
					<td>" . $class . "</td>
					<td>" . $booking_status . "</td>
					<td>" . $no_of_passengers . "</td>
					<td>" . $payment_id . "</td>
        			</tr>";
                }
                echo "</table> <br>";
            }
            echo "<br><h3 class=\"set_nice_size\"><center><u>Completed Trips</u></center></h3>";

            $query = "SELECT pnr,date_of_reservation,flight_no,journey_date,class,booking_status,no_of_passengers,payment_id FROM Ticket_Details where customer_id=? and journey_date<? and journey_date>=? ORDER BY  journey_date";
            $stmt = mysqli_prepare($dbc, $query);
            mysqli_stmt_bind_param($stmt, "sss", $customer_id, $todays_date, $thirty_days_before_date);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $pnr, $date_of_reservation, $flight_no, $journey_date, $class, $booking_status, $no_of_passengers, $payment_id);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 0) {
                echo "<h3><center>No trips completed in the past 30 days!</center></h3>";
            } else {
                echo "<table cellpadding=\"10\"";
                echo "<tr><th>PNR</th>
				<th>Date of Reservation</th>
				<th>Flight No.</th>
				<th>Journey Date</th>
				<th>Class</th>
				<th>Booking Status</th>
				<th>No. of Passengers</th>
				<th>Payment ID</th>
				</tr>";
                while (mysqli_stmt_fetch($stmt)) {
                    echo "<tr>
        			<td>" . $pnr . "</td>
        			<td>" . $date_of_reservation . "</td>
					<td>" . $flight_no . "</td>
					<td>" . $journey_date . "</td>
					<td>" . $class . "</td>
					<td>" . $booking_status . "</td>
					<td>" . $no_of_passengers . "</td>
					<td>" . $payment_id . "</td>
        			</tr>";
                }
                echo "</table> <br>";
            }
            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
            ?>
        </div>
    </div>

    <script type="text/javascript" src="js/main1.js"></script>
</body>


</html>