<?php
session_start();
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
            <form id="register" class="input-group" action="login.php" method="POST">
                <input class="input-field" type="text" name="username" placeholder="Enter your username" required>
                <input class="input-field" type="password" name="password" placeholder="Enter your password" required>
                <p> <strong>User Type:</strong></p>
                <p><input type='radio' name='user_type' value='Customer' checked /> Customer</p>
                <p><input type='radio' name='user_type' value='Administrator' /> Administrator</p>
                <?php
                if (isset($_GET['msg']) && $_GET['msg'] == 'failed') {
                    echo "<br>
						<strong style='color:red'>Invalid Username/Password</strong>
						<br><br>";
                }
                ?>
                <button type="submit" class="submit-btn" name="Login" value="Login"> Login</button>
                <br>
                <p>
                    <a href="SignUp.php"><i aria-hidden="true"></i> Create New User Account?</a>
                </p>
            </form>
        </div>

    </div>

</body>

</html>