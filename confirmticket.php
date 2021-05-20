<?php 
require_once('libraAd.php');
$conn = createDBConnection();
$sql = sprintf(
    "UPDATE ticket_details 
    SET booking_status='CONFIRMED'
    WHERE pnr=%s",  
    $_REQUEST['pnr']
);

if ($conn->query($sql) == true) {
    header("Location: qlDonHang.php");
} else {
    echo '<script>alert("CANNOT"); window.location="qlDonHang.php";</script>';
}
