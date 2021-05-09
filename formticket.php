<?php
session_start();
?>
<html>

<head>
    <title>Tickets</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/fontAwesome.css">
    <link rel="stylesheet" href="css/hero-slider.css">
    <link rel="stylesheet" href="css/owl-carousel.css">
    <link rel="stylesheet" href="css/datepicker.css">
    <link rel="stylesheet" href="css/tooplate-style.css">
    <link rel="Shortcut Icon" href="img/logo-i.png" type="img/x-icon" />
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading" style="text-align: center;">
                    <h1>
                        Information ticket
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['Search'])) {
        $data_missing = array();
        if (empty($_POST['origin'])) {
            $data_missing[] = 'Origin';
        } else {
            $origin = $_POST['origin'];
        }
        if (empty($_POST['destination'])) {
            $data_missing[] = 'Destination';
        } else {
            $destination = $_POST['destination'];
        }

        if (empty($_POST['dep_date'])) {
            $data_missing[] = 'Departure Date';
        } else {
            $dep_date = trim($_POST['dep_date']);
        }
        if (empty($_POST['no_of_pass'])) {
            $data_missing[] = 'No. of Passengers';
        } else {
            $no_of_pass = trim($_POST['no_of_pass']);
        }

        if (empty($_POST['class'])) {
            $data_missing[] = 'Class';
        } else {
            $class = trim($_POST['class']);
        }

        if (empty($data_missing)) {
            $_SESSION['no_of_pass'] = $no_of_pass;
            $_SESSION['class'] = $class;
            $count = 1;
            $_SESSION['count'] = $count;
            $_SESSION['journey_date'] = $dep_date;
            require_once('connect.php');
            if ($class == "economy") {
                $query = "SELECT * FROM Flight_Details where from_city=? and to_city=? and departure_date=? and seats_economy>=? ORDER BY  departure_time";
                $stmt = mysqli_prepare($dbc, $query);
                mysqli_stmt_bind_param($stmt, "sssi", $origin, $destination, $dep_date, $no_of_pass);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $flight_no, $from_city, $to_city, $departure_date, $departure_time, $arrival_date, $arrival_time, $price_economy);
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 0) {
                    echo "<h3>No flights are available !</h3>";
                } else {
                    echo "<form action=\"bookticket.php\" method=\"post\">";
                    echo "<div class=\"table-responsive\">";
                    echo "<table class=\"align-middle mb-0 table table-borderless table-striped table-hover\">";
                    echo "<tr>
                            <th class=\"text-center\">Flight No.</th>
							<th class=\"text-center\">Origin</th>
							<th class=\"text-center\">Destination</th>
							<th class=\"text-center\">Departure Date</th>
							<th class=\"text-center\">Departure Time</th>
							<th class=\"text-center\">Arrival Date</th>
							<th class=\"text-center\">Arrival Time</th>
							<th class=\"text-center\">Price(Economy)</th>
							<th class=\"text-center\">Select</th>
                        </tr>";
                    while (mysqli_stmt_fetch($stmt)) {
                        echo "<tr>
        						<td class=\"text-center text-muted\">" . $flight_no . "</td>
        						<td class=\"text-center text-muted\">" . $from_city . "</td>
								<td class=\"text-center text-muted\">" . $to_city . "</td>
								<td class=\"text-center text-muted\">" . $departure_date . "</td>
								<td class=\"text-center text-muted\">" . $departure_time . "</td>
								<td class=\"text-center text-muted\">" . $arrival_date . "</td>
								<td class=\"text-center text-muted\">" . $arrival_time . "</td>
                                <td class=\"text-center text-muted\">" . $price_economy . "</td>
								<td class=\"text-center text-muted\"><input id=\"cmn\" type=\"radio\" name=\"select_flight\" value=\"" . $flight_no . "\"></td>
        						</tr>";
                    }
                    echo "</table> 
                    </div><br>";
                    echo "<input class=\"mr-2 btn-icon btn-icon-only btn btn-outline-info\" type=\"submit\" value=\"Select Flight\" onclick=\"return checkaa()\"  name=\"Select\">";
                    echo "</form>";
                }
            } else if ($class = "business") {
                $query = "SELECT flight_no,from_city,to_city,departure_date,departure_time,arrival_date,arrival_time,price_business FROM Flight_Details where from_city=? and to_city=? and departure_date=? and seats_business>=? ORDER BY  departure_time";
                $stmt = mysqli_prepare($dbc, $query);
                mysqli_stmt_bind_param($stmt, "sssi", $origin, $destination, $dep_date, $no_of_pass);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $flight_no, $from_city, $to_city, $departure_date, $departure_time, $arrival_date, $arrival_time, $price_business);
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 0) {
                    echo "<h3>No flights are available !</h3>";
                } else {
                    echo "<form action=\"bookticket.php\" method=\"post\">";
                    echo "<div class=\"table-responsive\">";
                    echo "<table class=\"align-middle mb-0 table table-borderless table-striped table-hover\">";
                    echo "<tr>
                            <th class=\"text-center\">Flight No.</th>
							<th class=\"text-center\">From</th>
							<th class=\"text-center\">To</th>
							<th class=\"text-center\">Departure Date</th>
							<th class=\"text-center\">Departure Time</th>
							<th class=\"text-center\">Arrival Date</th>
							<th class=\"text-center\">Arrival Time</th>
							<th class=\"text-center\">Price(Business)</th>
							<th class=\"text-center\">Select</th>
						</tr>";
                    while (mysqli_stmt_fetch($stmt)) {
                        echo "<tr>
        						<td class=\"text-center text-muted\">" . $flight_no . "</td>
        						<td class=\"text-center text-muted\">" . $from_city . "</td>
								<td class=\"text-center text-muted\">" . $to_city . "</td>
								<td class=\"text-center text-muted\">" . $departure_date . "</td>
								<td class=\"text-center text-muted\">" . $departure_time . "</td>
								<td class=\"text-center text-muted\">" . $arrival_date . "</td>
								<td class=\"text-center text-muted\">" . $arrival_time . "</td>
                                <td class=\"text-center text-muted\">" . $price_business . "</td>
								<td class=\"text-center text-muted\"><input id=\"cmn\" type=\"radio\" name=\"select_flight\" value=\"" . $flight_no . "\"></td>
                                </tr>";
                    }
                    echo "</table></div> <br>";
                    echo "<p style=\"text-align: center;\"><input class=\"btn\" type=\"submit\" value=\"Select Flight\" name=\"Select\" onclick=\"return checkaa()\"> </p>";
                    echo "</form>";
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
        } else {
            echo "The following data fields were empty! <br>";
            foreach ($data_missing as $missing) {
                echo $missing . "<br>";
            }
        }
    } else {
        echo "<h3 style=\"text-align: center;\"> Search request not received </h3>";
    }
    ?>

    <script>
        function checkaa() {
            var c= document.getElementById("cmn")
            if (!c.checked) {
                alert("please choose ticket !");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>