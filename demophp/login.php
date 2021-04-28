<?php
require_once('lib.php');

$loginResult = "";
if (isset($_POST['txtName'])) {
    $loginResult = login($_POST['txtName'], $_POST['txtPass']);
}
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>User login</title>
</head>

<body>
    Da login: <?= isLogined()?'roi':'chua' ?>
    Test <?= $loginResult ?>
    <form action="login.php" method="post" name="frm1">

        <table width="40%" border="0">
            <tr>
                <th width="17%" scope="col">
                    <div align="left">Username:</div>
                </th>
                <th width="83%" scope="col">
                    <div align="left">
                        <input name="txtName" type="text" value="" />
                    </div>
                </th>
            </tr>
            <tr>
                <th scope="row">
                    <div align="left">Password:</div>
                </th>
                <td>
                    <div align="left">
                        <input name="txtPass" type="password" value="" />
                    </div>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <div align="left"></div>
                </th>
                <td>
                    <div align="left">
                        <input name="btnSubmit" type="submit" value="OK" />
                    </div>
                </td>
            </tr>
        </table>
        <?php
        if (isLogined())
            echo '<a href="logout.php">Logout</a>';
        ?>
    </form>
</body>

</html>