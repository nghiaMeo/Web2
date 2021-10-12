<?php
session_start();
DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', '');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'plane');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
    or die('Could not connect to MySQL:' .
        mysqli_connect_error());

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


/// USER
function loginCus($user, $pass)
{

    $conn = createDBConnection();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM customer WHERE customer_id='" . "$user" . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        if ($row = $result->fetch_assoc()) {
            if ($row['pwd'] == $pass) {
                // login thanh cong
                $_SESSION['customer_id'] = $user;
                return "Login success";
            } else {
                return "* Error password";
            }
        }
    } else {
        return "* This user was not found";
    }
    $conn->close();
}

function isLoginedCus()
{
    return isset($_SESSION['customer_id']);
}

function logoutCus()
{
    unset($_SESSION['customer_id']);
}
?>
