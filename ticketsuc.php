<?php
require_once('libraCus.php');
isLoginedCus();
?>

<html>

<head>
	<title>
		Ticket Booking Successful
	</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" href="font-awesome-4.7.0\css\font-awesome.min.css">
	<link rel="stylesheet" href="css/main.css">
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
	<h2>BOOKING SUCCESSFUL</h2>

	<h3>Your payment of $<?php echo $_SESSION['total_amount']; ?> has been received.<br><br> Your PNR is <strong><?php echo $_SESSION['pnr']; ?>
		</strong> hold your PNR to check tickets. Your tickets have been booked successfully.</h3>
	<?php
	if (isLoginedCus()) {
		echo "<a href=\"user.php\"><button class=\"mb-2 mr-2 btn-transition btn btn-outline-warning\">Back homepage</button></a>";
	} else
		echo "<a href=\"index.php\"><button class=\"mb-2 mr-2 btn-transition btn btn-outline-warning\">Back homepage</button></a>";
	?>
</body>
<script>

</script>

</html>