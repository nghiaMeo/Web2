<?php
session_start();
function createDBConnection()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "plane";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
function loginAdmin($user, $pass)
{

    $conn = createDBConnection();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM admin WHERE admin_id='" . "$user" . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        if ($row = $result->fetch_assoc()) {
            if ($row['pwd'] == $pass) {
                // login thanh cong
                $_SESSION['admin_id'] = $user;
                return true;
            } else {
                return "* Error password";
            }
        }
    } else {
        return "* This admin was not found";
    }
    $conn->close();
}

function isLoginAd()
{
    return isset($_SESSION['admin_id']);
}

function logoutAd()
{
    unset($_SESSION['admin_id']);
}
