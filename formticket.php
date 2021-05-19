<?php
require_once('libraCus.php');
isLoginedCus();
$conn = createDBConnection();
if (!isset($_REQUEST['Page']))
    $_REQUEST['Page'] = 0;
require_once('formticket.php');
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
    function getSql()
    {
        if ($_REQUEST['class'] == "economy") {
            if ($_REQUEST['from'] != '' && $_REQUEST['to'] != '' && $_REQUEST['dep_date'] != '') {
                return sprintf(
                    "SELECT * FROM Flight_Details WHERE from_city='%s' and to_city='%s' and departure_date= '%s' and seats_economy >= %s ORDER BY  departure_time",
                    $_REQUEST['from'],
                    $_REQUEST['to'],
                    $_REQUEST['dep_date'],
                    $_REQUEST['no_of_pass']
                );
            }
        } else if ($_REQUEST['class'] == "business") {
            if ($_REQUEST['from'] != '' && $_REQUEST['to'] != '' && $_REQUEST['dep_date'] != '') {
                return sprintf(
                    "SELECT * FROM Flight_Details WHERE from_city='%s' and to_city='%s' and departure_date= '%s' and seats_business >= %s ORDER BY  departure_time",
                    $_REQUEST['from'],
                    $_REQUEST['to'],
                    $_REQUEST['dep_date'],
                    $_REQUEST['no_of_pass']
                );
            }
        }
    }

    $sql =  getSql();
    $sql = $sql . " LIMIT " . ($_REQUEST['Page'] * 3) . ",3";
    $result = $conn->query($sql);
    if (isset($_REQUEST['Search'])) {
        $data_missing = array();
        if (empty($_REQUEST['from'])) {
            $data_missing[] = 'from';
        } else {
            $origin = $_REQUEST['from'];
        }
        if (empty($_REQUEST['destination'])) {
            $data_missing[] = 'Destination';
        } else {
            $destination = $_REQUEST['destination'];
        }

        if (empty($_REQUEST['dep_date'])) {
            $data_missing[] = 'Departure Date';
        } else {
            $dep_date = trim($_REQUEST['dep_date']);
        }
        if (empty($_REQUEST['no_of_pass'])) {
            $data_missing[] = 'No. of Passengers';
        } else {
            $no_of_pass = trim($_REQUEST['no_of_pass']);
        }

        if (empty($_REQUEST['class'])) {
            $data_missing[] = 'Class';
        } else {
            $class = trim($_REQUEST['class']);
        }

        if (!empty($data_missing)) {
            $_SESSION['no_of_pass'] = $no_of_pass;
            $_SESSION['class'] = $class;
            $count = 1;
            $_SESSION['count'] = $count;
            $_SESSION['journey_date'] = $dep_date;
        }
        if ($class == "economy") {
            if ($result->num_rows == 0) {
                echo "<h3 style=\"text-align: center;\">No flights are available !</h3>";
                if (isLoginedCus()) {
                    echo "<a href=\"user.php\"><button style=\"margin-left: 45%;\" class=\"mb-2 mr-2 btn-transition btn btn-outline-warning\">Back homepage</button></a>";
                } else
                    echo "<a href=\"index.php\"><button style=\"margin-left: 45%;\" class=\"mb-2 mr-2 btn-transition btn btn-outline-warning\">Back homepage</button></a>";
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
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                <td class=\"text-center text-muted\">" . $row['flight_no'] . "</td>
                <td class=\"text-center text-muted\">" . $row['from_city'] . "</td>
                <td class=\"text-center text-muted\">" . $row['to_city'] . "</td>
                <td class=\"text-center text-muted\">" . $row['departure_date'] . "</td>
                <td class=\"text-center text-muted\">" . $row['departure_time'] . "</td>
                <td class=\"text-center text-muted\">" . $row['arrival_date'] . "</td>
                <td class=\"text-center text-muted\">" . $row['arrival_time'] . "</td>
                <td class=\"text-center text-muted\">" . $row['price_economy'] . "</td>
                <td class=\"text-center text-muted\"><input id=\"cmn\" type=\"radio\" name=\"select_flight\" required value=\"" . $row['flight_no'] . "\"></td>
                </tr>";
                }
                echo "</table> 
            </div><br>
            <div class=\"col-md-15 \" style=\"text-align: center;\">";
    ?>
                <a href="#" class="prev-page">
                    <i class="fa fa-angle-left">
                    </i>
                </a>
                <?php
                $sql = getSql();
                $result = $conn->query($sql);
                $row = $result->num_rows;
                $pages = $row % 3 == 0 ? intval($row / 3) : intval($row / 3) + 1;
                for ($i = 0; $i < $pages; $i++) {
                    $search = sprintf(
                        "Page=%s&from=%s&to=%s&dep_date=%s&no_of_pass=%s&class=%s&Search=",
                        $i,
                        $_REQUEST['from'],
                        $_REQUEST['to'],
                        $_REQUEST['dep_date'],
                        $_REQUEST['no_of_pass'],
                        $class
                    );
                ?>
                    <a href="formticket.php?<?= $search ?>" class="active">
                        <?= ($i + 1) ?>
                    </a>
                <?php
                }
                ?>
                <a href="#" class="next-page">
                    <i class="fa fa-angle-right">
                    </i>
                </a>

            <?php
                echo "<p style=\"text-align: center;\"><input class=\"mr-2 btn-icon btn-icon-only btn btn-outline-info\" type=\"submit\" value=\"Select Flight\"   name=\"Select\"></p>";
                echo "</form>
            </div>";
            }
        } else if ($class = "business") {
            if ($result->num_rows == 0) {
                echo "<h3 style=\"text-align: center;\">No flights are available !</h3>";
                if (isLoginedCus()) {
                    echo "<a href=\"user.php\"><button style=\"margin-left: 45%;\" class=\"mb-2 mr-2 btn-transition btn btn-outline-warning\">Back homepage</button></a>";
                } else
                    echo "<a href=\"index.php\"><button style=\"margin-left: 45%;\" class=\"mb-2 mr-2 btn-transition btn btn-outline-warning\">Back homepage</button></a>";
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
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                <td class=\"text-center text-muted\">" . $row['flight_no'] . "</td>
                <td class=\"text-center text-muted\">" . $row['from_city'] . "</td>
                <td class=\"text-center text-muted\">" . $row['to_city'] . "</td>
                <td class=\"text-center text-muted\">" . $row['departure_date'] . "</td>
                <td class=\"text-center text-muted\">" . $row['departure_time'] . "</td>
                <td class=\"text-center text-muted\">" . $row['arrival_date'] . "</td>
                <td class=\"text-center text-muted\">" . $row['arrival_time'] . "</td>
                <td class=\"text-center text-muted\">" . $row['price_business']  . "</td>
				<td class=\"text-center text-muted\"><input id=\"cmn\" type=\"radio\" name=\"select_flight\" value=\"" . $row['flight_no'] . "\" required ></td>
                </tr>";
                }

                echo "</table></div> <br>
                <div class=\"col-md-15 \" style=\"text-align: center;\">
                ";
            ?>
                <a href="#" class="prev-page">
                    <i class="fa fa-angle-left">
                    </i>
                </a>
                <?php
                $sql = getSql();
                $result = $conn->query($sql);
                $row = $result->num_rows;
                $pages = $row % 3 == 0 ? intval($row / 3) : intval($row / 3) + 1;
                for ($i = 0; $i < $pages; $i++) {
                    $search = sprintf(
                        "Page=%s&from=%s&to=%s&dep_date=%s&no_of_pass=%s&class=%s&Search=",
                        $i,
                        $_REQUEST['from'],
                        $_REQUEST['to'],
                        $_REQUEST['dep_date'],
                        $_REQUEST['no_of_pass'],
                        $class
                    );
                ?>
                    <a href="formticket.php?<?= $search ?>" class="active">
                        <?= ($i + 1) ?>
                    </a>
                <?php
                }
                ?>
                <a href="#" class="next-page">
                    <i class="fa fa-angle-right">
                    </i>
                </a>

    <?php
                echo "<p style=\"text-align: center;\"><input class=\"mr-2 btn-icon btn-icon-only btn btn-outline-info\" type=\"submit\" value=\"Select Flight\" name=\"Select\"> </p>";
                echo "</form>
                </div> ";
            }
        }
    } else {
        echo "<h3 style=\"text-align: center;\"> Search request not received </h3>";
        if (isLoginedCus()) {
            echo "<a href=\"user.php\"><button style=\"margin-left: 45%;\" class=\"mb-2 mr-2 btn-transition btn btn-outline-warning\">Back homepage</button></a>";
        } else
            echo "<a href=\"index.php\"><button style=\"margin-left: 45%;\" class=\"mb-2 mr-2 btn-transition btn btn-outline-warning\">Back homepage</button></a>";
    }
    ?>
    <div class="col-md-10" style="margin-left: 44%;">
        <?php
        if (isLoginedCus()) {
            echo "<a href=\"user.php\"><button class=\"mb-2 mr-2 btn-transition btn btn-outline-warning\">Back homepage</button></a>";
        } else
            echo "<a href=\"index.php\"><button class=\"mb-2 mr-2 btn-transition btn btn-outline-warning\">Back homepage</button></a>";
        ?>
    </div>
    <script>
        function checkaa() {
            var radios = document.getElementsByName('select_flight');
            console.log(radios.length)
            for (i = 0; i < radios.length; i++) {
                if (radios[i].checked) {
                    return true;
                }
            }
            alert("please choose your ticket!!");
            return false;
        }
    </script>
</body>

</html>