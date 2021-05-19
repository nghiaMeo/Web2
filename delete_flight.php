<?php
require_once('libraAd.php');

if (isset($_REQUEST['flight_no']) && isset($_REQUEST['departure_date'])) {
    $conn = createDbConnection();

    $sql = sprintf("DELETE FROM flight_details WHERE flight_no='%s' 
    and departure_date='%s'" , $_REQUEST['flight_no'],$_REQUEST['departure_date']);
    if ($conn->query($sql) === TRUE) {
        echo "The record deleted successfully";
        header("Location:flight_management.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>