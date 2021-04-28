<?php
session_start();
function createDBConnection(){
    
}

function login($user, $pass)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dct19c2";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM user WHERE username='" . "$user" . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        if ($row = $result->fetch_assoc()) {
            if ($row['PASSWORD'] == $pass) {
                // login thanh cong
                $_SESSION['username'] = $user;
                return "login thanh cong";
            }
            else {
                return "sai password";    
            }
        }
    } else {
        return "khong co username nay";
    }
    $conn->close();
}

function isLogined()
{
    return isset($_SESSION['username']);
}

function logout()
{
    unset($_SESSION['username']);
}
