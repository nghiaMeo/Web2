<?php
require_once('libraAd.php');
$loginResult = "";
if (isset($_POST['admin'])) {
    $loginResult = loginAdmin($_POST['admin'], $_POST['Passwd']);
    
}
?>
<html>

<head>
    <script>
        
    </script>
    <title>Login</title>
    <link rel="stylesheet" href="./css/style3.css">

</head>

<body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <p class="toggle-btn">Admin</p>
            </div>
            <form id="register" class="input-group" action="LoginAd.php" method="post">
                <p style="color:RED;"><?= $loginResult ?></p>
                <input type="text" class="input-field" placeholder="User ID" required name="admin" >
                <input type="password" class="input-field" placeholder="Enter Password" required name="Passwd" value="">
                <input type="submit" class="submit-btn" name="btnSubmit" value="Login"></input>
                <?php
                    if(isLoginAd()){

                    }
                    if($loginResult == 1){
                        header('Location: admin.php');
                    }
                ?>
            </form>
        </div>

    </div>

</body>

</html>