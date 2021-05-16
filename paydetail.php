<?php
require_once('libraCus.php');
$loginResult = "";
if (isset($_POST['username'])) {
	$loginResult = loginCus($_POST['username'], $_POST['password']);
}
?>
<html>

<head>
	<title>
		Enter Payment Details
	</title>
	<style>
		.button {
			background-color: #4CAF50;
			/* Green */
			border: none;
			color: white;
			padding: 12px 40px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 12px;
			margin: 4px 2px;
			transition-duration: 0.4s;
			cursor: pointer;
		}

		.button2 {
			background-color: white;
			color: black;
			border: 2px solid #008CBA;
		}
		.button2:hover {
			background-color: #008CBA;
			color: white;
		}
	</style>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/fontAwesome.css">
	<link rel="stylesheet" href="css/hero-slider.css">
	<link rel="stylesheet" href="css/owl-carousel.css">
	<link rel="stylesheet" href="css/datepicker.css">
	<link rel="stylesheet" href="css/tooplate-style.css">
	<link rel="stylesheet" href="css/my.css">
	<link rel="Shortcut Icon" href="img/logo-i.png" type="img/x-icon" />
</head>

<body>
	<div style="margin-left: 25%;" class="container">
		<form action="ticketsuc.php" method="post">
			<h2 style="margin-left: 130px">THE PAYMENT DETAILS</h2>
			<h3 style="margin-left: 190px"><u>Payment Summary</u></h3>
			<br>
			<?php
			$flight_no = $_SESSION['flight_no'];
			$journey_date = $_SESSION['journey_date'];
			$no_of_pass = $_SESSION['no_of_pass'];
			$total_no_of_meals = $_SESSION['total_no_of_meals'];
			$payment_id = rand(100000000, 999999999);
			$pnr = $_SESSION['pnr'];
			$_SESSION['payment_id'] = $payment_id;
			$payment_date = date('Y-m-d');
			$_SESSION['payment_date'] = $payment_date;
			if ($_SESSION['class'] == 'economy') {
				$query = "SELECT price_economy FROM Flight_Details where flight_no=? and departure_date=?";
				$stmt = mysqli_prepare($dbc, $query);
				mysqli_stmt_bind_param($stmt, "ss", $flight_no, $journey_date);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $ticket_price);
				mysqli_stmt_fetch($stmt);
			} else if ($_SESSION['class'] == 'business') {
				$query = "SELECT price_business FROM Flight_Details where flight_no=? and departure_date=?";
				$stmt = mysqli_prepare($dbc, $query);
				mysqli_stmt_bind_param($stmt, "ss", $flight_no, $journey_date);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $ticket_price);
				mysqli_stmt_fetch($stmt);
			}
			mysqli_close($dbc);
			$total_ticket_price = $no_of_pass * $ticket_price;
			$total_meal_price = 250 * $total_no_of_meals;
			if ($_SESSION['insurance'] == 'yes') {
				$total_insurance_fee = 100 * $no_of_pass;
			} else {
				$total_insurance_fee = 0;
			}
			if ($_SESSION['priority_checkin'] == 'yes') {
				$total_priority_checkin_fee = 200 * $no_of_pass;
			} else {
				$total_priority_checkin_fee = 0;
			}
			if ($_SESSION['lounge_access'] == 'yes') {
				$total_lounge_access_fee = 300 * $no_of_pass;
			} else {
				$total_lounge_access_fee = 0;
			}
			$total_discount = 0;
			$total_amount = $total_ticket_price + $total_meal_price + $total_insurance_fee + $total_priority_checkin_fee + $total_lounge_access_fee + $total_discount;
			$_SESSION['total_amount'] = $total_amount;

			echo "<table cellpadding=\"5\"	style='margin-left: 50px'>";
			echo "<tr>";
			echo "<td class=\"fix_table\">Base Fare, Fuel and Transaction Charges (Fees & Taxes included): </td>";
			echo "<td class=\"fix_table\"> $ " . $total_ticket_price . "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td class=\"fix_table\">Meal Combo Charges: </td>";
			echo "<td class=\"fix_table\"> $ " . $total_meal_price . "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td class=\"fix_table\">Priority Checkin Fees: </td>";
			echo "<td class=\"fix_table\"> $ " . $total_priority_checkin_fee . "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td class=\"fix_table\">Lounge Access Fees: </td>";
			echo "<td class=\"fix_table\"> $ " . $total_lounge_access_fee . "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td class=\"fix_table\">Insurance Fees: </td>";
			echo "<td class=\"fix_table\"> $ " . $total_insurance_fee . "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td class=\"fix_table\">Discount: </td>";
			echo "<td class=\"fix_table\"> $ " . $total_discount . "</td>";
			echo "</tr>";
			echo "</table>";

			echo "<hr style='margin-right:500px; margin-left: 50px'>";
			echo "<table cellpadding=\"5\" style='margin-left: 50px'>";
			echo "<tr>";
			echo "<td class=\"fix_table\"><strong>Total: </strong></td>";
			echo "<td style=\"padding-left: 436px;\" class=\"fix_table\"> $ " . $total_amount . "</td>";
			echo "</tr>";
			echo "</table>";
			echo "<hr style='margin-right:500px; margin-left: 50px'>";
			echo "<p style=\"margin-left:50px; color: red;\";>Your Payment/Transaction ID is <strong>" . $payment_id . ".</strong> Please note it down for future reference.</p>";
			?>
			<table cellpadding="5" width="50%" height="10%" style='margin-left: 50px'>
				<tr>
					<td class="fix_table"><strong>The Payment Mode:</strong></td>
				</tr>
				<tr>
					<td width="26.67%" class=""><i class="fa fa-credit-card" aria-hidden="true"></i> Credit Card <input type="radio" name="payment_mode" value="credit card" checked></td>
					<td width="26.67%" class=""><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Debit Card <input type="radio" name="payment_mode" value="debit card"></td>
					<td width="26.67%" class=""><i class="fa fa-desktop" aria-hidden="true"></i> Net Banking <input type="radio" name="payment_mode" value="net banking"></td>
				</tr>
			</table>
			<br>

			<button style="margin-left: 20%;" type="submit" class="button button2" value="Pay Now" name="Pay_Now">Pay Now</button>
		</form>
	</div>

</body>

</html>