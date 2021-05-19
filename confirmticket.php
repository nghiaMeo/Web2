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
    echo '<script>alert("Confirm success!"); window.location="qlDonHang.php";</script>';
} else {
    echo '<script>alert("CANNOT"); window.location="qlDonHang.php";</script>';
}
