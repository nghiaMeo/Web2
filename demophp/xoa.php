<?php
require_once('lib.php');

if (isset($_REQUEST['user'])) {
    $conn = createDbConnection();

    $sql = sprintf("DELETE FROM user WHERE username='%s'", $_REQUEST['user']);
    var_dump($sql);
    if ($conn->query($sql) === TRUE) {
        echo "The record deleted successfully";
        header("Location:qluser.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>