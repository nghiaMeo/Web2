<?php
require_once('libraCus.php');
$loginResult = "";
if (isset($_POST['username'])) {
    $loginResult = loginCus($_POST['username'], $_POST['password']);
}
?>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="./css/style3.css">

</head>

<body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <p class="toggle-btn">Login</p>
            </div>
            <form id="register" class="input-group" action="SginIn.php" method="POST">
                <input class="input-field" type="text" name="username" placeholder="Enter your username" required>
                <input class="input-field" type="password" name="password" placeholder="Enter your password" required>
                <p style="color:RED;"><?= $loginResult ?></p>
                <button type="submit" class="submit-btn" name="Login" value="Login"> Login</button>
                <br>
                <?php
                if (isLoginedCus()) {
                    header('Location: user.php');
                }
                ?>
                <p>
                    <a href="SignUp.php"><i aria-hidden="true"></i> Create New User Account?</a>
                </p>
            </form>
        </div>

    </div>

</body>

</html>