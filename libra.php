<?php
session_start();
function createDBConnection() {
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
function login($user, $pass)
{
    
    $conn = createDBConnection();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM admin WHERE tkAdmin='" . "$user" . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        if ($row = $result->fetch_assoc()) {
            if ($row['Matkhau'] == $pass) {
                // login thanh cong
                $_SESSION['tkAdmin'] = $user;
                return true;
            }
            else {
                return "* Error password";    
            }
        }
    } else {
        return "* This admin was not found";
    }
    $conn->close();
}

function isLogined()
{
    return isset($_SESSION['tkAdmin']);
}

function logout()
{
    unset($_SESSION['tkAdmin']);
}
