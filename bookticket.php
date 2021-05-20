<?php
require_once('libraCus.php');
$loginResult = "";
if (isset($_POST['username'])) {
    $loginResult = loginCus($_POST['username'], $_POST['password']);
}
if (isLoginedCus()) {
?>
    <html>

    <head>
        <style>
            td {
                padding-left: 20px;
                padding-right: 7.5px;
            }

            td:first-child {
                padding-left: 0;
            }

            td:last-child {
                padding-right: 0;
            }
        </style>
        <title>
            Enter Travel/Ticket Details
        </title>
        <link href="css/main.css" rel="stylesheet">

        <link href="css/main1.css" rel="stylesheet">
    </head>

    <body>
        <h2 style="text-align: center;">ADD PASSENGERS DETAILS</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="table-responsive">
                        <?php
                        $no_of_pass = $_SESSION['no_of_pass'];
                        $class = $_SESSION['class'];
                        $count = $_SESSION['count'];
                        $flight_no = $_POST['select_flight'];
                        $_SESSION['flight_no'] = $flight_no;
                        ?>
                        <form action="addticket.php" method="post">
                            <?php
                            while ($count <= $no_of_pass) {
                                echo "<p><strong>PASSENGER " . $count . "<strong></p>";
                                echo "<table cellpadding=\"5px\" cellspacing=\"20px\" >";
                                echo "<tr>";
                                echo "<td >Passenger's Name</td>";
                                echo "<td >Passenger's Age</td>";
                                echo "<td >Passenger's Gender</td>";
                                echo "<td >Passenger's Inflight Meal</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td ><input class=\"form-control\" type=\"text\" name=\"pass_name[]\" required></td>";
                                echo "<td ><input class=\"form-control\" type=\"number\" name=\"pass_age[]\" required></td>";
                                echo "<td >";
                                echo "<select class=\"form-control\" name=\"pass_gender[]\">";
                                echo "<option value=\"male\">Male</option>";
                                echo "<option value=\"female\">Female</option>";
                                echo "<option value=\"other\">Other</option>";
                                echo "</select>";
                                echo "</td>";
                                echo "<td >";
                                echo "<select class=\"form-control\" name=\"pass_meal[]\">";
                                echo "<option value=\"yes\">Yes</option>";
                                echo "<option value=\"no\">No</option>";
                                echo "</select>";
                                echo "</td>";
                                echo "</tr>";
                                echo "</table>";
                                echo "<br><hr>";
                                $count = $count + 1;
                            }
                            echo "<br><h2 style=\"text-align: center;\">ENTER TRAVEL DETAILS</h2>";
                            echo "<table cellpadding=\"5px\">";
                            echo "<tr>";
                            echo "<td >Do you want access to our Premium Lounge?</td>";
                            echo "<td >Do you want to opt for Priority Checkin?</td>";
                            echo "<td >Do you want to purchase Travel Insurance?</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td >";
                            echo "Yes <input type='radio' name='lounge_access' value='yes' checked/> No <input type='radio' name='lounge_access' value='no'/>";
                            echo "</td>";
                            echo "<td >";
                            echo "Yes <input type='radio' name='priority_checkin' value='yes' checked/> No <input type='radio' name='priority_checkin' value='no'/>";
                            echo "</td>";
                            echo "<td >";
                            echo "Yes <input type='radio' name='insurance' value='yes' checked/> No <input type='radio' name='insurance' value='no'/>";
                            echo "</td>";
                            echo "</tr>";
                            echo "</table>";
                            echo "<br><br>";
                            echo " <p style=\"text-align: center;\"><input type=\"submit\" class=\"btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav\" value=\"Submit Travel/Ticket Details\" name=\"Submit\"></p>";
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="js/main1.js"></script>
    </body>

    </html>
<?php
} else
    header("Location: index.php");
?>