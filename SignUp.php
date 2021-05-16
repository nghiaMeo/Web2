<?php
require_once('libraCus.php');

if (isset($_REQUEST['Submit'])) {
    $conn = createDbConnection();

    $sql = sprintf(
        "INSERT INTO Customer 
                    VALUES ('%s', '%s', '%s', '%s','%s','%s')",
        $_REQUEST['username'],
        $_REQUEST['password'],
        $_REQUEST['email'],
        $_REQUEST['name'],
        $_REQUEST['phone_no'],
        $_REQUEST['address']
    );
    if ($conn->query($sql) === TRUE) {
        echo '<script language="javascript">alert("Sign Up Success!"); window.location="SginIn.php";</script>';
    } else {
        echo '<script language="javascript">alert("Username available!"); window.location="SignUp.php";</script>';
    }

    $conn->close();
}
?>
<html>

<head>
    <title>Registration</title>
    <link rel="stylesheet" href="./css/style3.css">

</head>

<body>
    <div class="hero">
        <div class="form-box1">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn">Register</button>
            </div>
            <form id="register" class="input-group" action="SignUp.php" method="POST">
                <input type="text" class="input-field" name="username" placeholder="Enter a valid username	" required>
                <input type="password" class="input-field" name="password" placeholder="Enter your password	" required>                <input type="email" class="input-field" name="email" placeholder="Enter your email ID" required>
                <input type="text" class="input-field" name="name" placeholder="Enter your name" required>
                <input type="text" class="input-field" name="phone_no" placeholder="Enter your phone no" required>
                <input type="text" class="input-field" name="address" placeholder="Enter your address" required>
                <button type="submit" class="submit-btn" name="Submit" onclick="checkpass()"> Register</button>
            </form>
        </div>
    </div>
</body>


</html>