<?php
require_once('libraCus.php');
$pnr = $_REQUEST["pnr"];
?>

<html>

<head>
  <title></title>
  <style>
    .button {
      background-color: rgb(255, 0, 0);
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

    .button1 {
      background-color: rgb(255, 153, 0);
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
      border: 2px solid rgb(255, 0, 0);
    }

    .button2:hover {
      background-color: rgb(255, 0, 0);
      color: white;
    }

    .button3 {
      background-color: white;
      color: black;
      border: 2px solid rgb(255, 153, 0);
    }

    .button3:hover {
      background-color: rgb(255, 153, 0);
      color: white;
    }
  </style>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="apple-touch-icon.html">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/fontAwesome.css">
  <link rel="stylesheet" href="css/hero-slider.css">
  <link rel="stylesheet" href="css/owl-carousel.css">
  <link rel="stylesheet" href="css/tooplate-style.css">

  <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
  <script type="text/javascript">
    function printpage() {
      var printButton = document.getElementById("print");
      printButton.style.visibility = 'hidden';
      window.print()
      printButton.style.visibility = 'visible';
    }
  </script>


</head>
<?php

$con = mysqli_connect("localhost", "root", "", "plane");
$q = mysqli_query($con, "select td.pnr,td.flight_no,td.journey_date, td.class,
td.booking_status, td.no_of_passengers, td.lounge_access, td.priority_checkin, td.insurance, 
td.payment_id, td.customer_id, td.date_of_reservation,fd.flight_no,fd.from_city, fd.to_city, 
fd.departure_date, fd.arrival_date, fd.departure_time, fd.arrival_time
  from ticket_details td,flight_details fd where pnr='" . $pnr . "' and td.flight_no = fd.flight_no");
$n =  mysqli_fetch_assoc($q);
$stname = $n['pnr'];
$flight_no = $n['flight_no'];
$journey_date = $n['journey_date'];
$class = $n['class'];
$booking_status = $n['booking_status'];
$no_of_passengers = $n['no_of_passengers'];
$lounge_access = $n['lounge_access'];
$priority_checkin = $n['priority_checkin'];
$insurance = $n['insurance'];
$payment_id = $n['payment_id'];
$customer_id = $n['customer_id'];
$date_of_reservation = $n['date_of_reservation'];
$from_city = $n['from_city'];
$to_city = $n['to_city'];
$departure_date = $n['departure_date'];
$arrival_date = $n['arrival_date'];
$departure_time = $n['departure_time'];
$arrival_time = $n['arrival_time'];


$result = mysqli_query($con, "SELECT * FROM passengers WHERE pnr='" . $stname . "'");
?>

<body>

  <?php
  while ($row = mysqli_fetch_array($result)) {

  ?>
    <hr style="border: 1px solid black;border-style: dashed;">
    <h3 style="text-align: center;">Airpot Authority of CatMeow</h3>
    <h2 style="text-align: center;">Boarding Pass - Flight Reservation Slip</h2>
    <table width="100%" cellspacing="2">
      <tr style="background-color: rgb(51, 51, 204); color: white;">
        <th colspan="8" style="text-align: left;">1.Reservation information</th>
      </tr>
      <tr>
        <td style="background-color: rgb(204, 153, 0); color: white;">PNR</td>
        <td width=""><?php echo $stname; ?> </td>
        <td style="background-color: rgb(204, 153, 0); color: white;">Flight No</td>
        <td width=""> <?php echo $flight_no; ?> </td>
        <td colspan="4" rowspan="4"> <img src="https://image.freepik.com/free-vector/cute-cartoon-cat-is-flying-plane_60438-424.jpg" width="80px" alt=""></td>
      </tr>
      <tr>
        <td style="background-color: rgb(204, 153, 0); color: white;">Payment ID</td>
        <td> <?php echo $payment_id; ?> </td>
        <td style="background-color: rgb(204, 153, 0); color: white;">Date of reservation</td>
        <td> <?php echo $date_of_reservation; ?> </td>
      </tr>
      <tr>
        <td style="background-color: rgb(204, 153, 0); color: white;">Orderer</td>
        <td> <?php echo $customer_id; ?> </td>
        <td style="background-color: rgb(204, 153, 0); color: white;">No. of Passengers</td>
        <td> <?php echo $no_of_passengers; ?> </td>
      </tr>
      <tr>
        <td style="background-color: rgb(204, 153, 0); color: white;"> Status:</td>
        <td> <?php echo $booking_status; ?> </td>
        <td style="background-color: rgb(204, 153, 0); color: white;">Class :</td>
        <td> <?php echo $class; ?> </td>
      </tr>
      <tr style="background-color: rgb(51, 51, 204); color: white;">
        <th colspan="8" style="text-align: left;">2.Services</th>
      </tr>
      <tr style="background-color: rgb(204, 153, 0); color: white;">
        <td>Lounge Access</td>
        <td>Priority Checkin</td>
        <td colspan="8">Insurance</td>
      </tr>
      <tr>
        <td> <?php echo $lounge_access; ?> </td>
        <td> <?php echo $priority_checkin; ?> </td>
        <td> <?php echo $insurance; ?> </td>
      </tr>

      <tr style="background-color: rgb(51, 51, 204); color: white;">
        <th colspan="8" style="text-align: left;">3.Flight information</th>
      </tr>

      <tr style="background-color: rgb(204, 153, 0); color: white;">
        <td>Passenger No</td>
        <td>Name</td>
        <td>Gender</td>
        <td>Age</td>
        <td>From - To</td>
        <td>Departure date</td>
        <td>Departure time-Arrival time</td>
        <td> Meail Choice</td>
      </tr>
      <tr>
        <td> <?php echo '' . $row[0] . '   ' ?></td>
        <td> <?php echo '' . $row[2] . '   ' ?></td>
        <td><?php echo $row[4] ?> </td>
        <td><?php echo '' . $row[3] ?></td>
        <td> <?php echo '' . $from_city . ' - ' . $to_city . '' ?></td>
        <td><?php echo $departure_date; ?></td>
        <td><?php echo $departure_time . '-' . $arrival_time; ?></td>
        <td> <?php echo $row[5] ?></td>
      </tr>
    </table>
  <?php
  }
  ?>
  <br>
  <h3 style="text-align: center;">
    <?php
    if ($booking_status == "CANCELED") {
    ?>
      <a href="checkticket.php"><button class="button1 button3">CHECK OTHER TICKKET</button></a>
    <?php
    } else {
    ?>
      <button type="submit" id="print" class="button button2" size="50" value="Print" onclick="printpage();">PRINT</button>
      <br><a href="checkticket.php"><button class="button1 button3">CHECK OTHER TICKKET</button></a>
    <?php
    }
    ?>
    <br>

  </h3>

  <style>
    @media print {
      .print_hide {
        display: none;

      }
    }
  </style>


</body>

</html>