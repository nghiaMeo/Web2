<?php
require_once('lib.php');

if (isset($_REQUEST['btnSubmit'])) {
    $conn = createDbConnection();

    $sql = sprintf("INSERT INTO user 
                    VALUES ('%s', '%s', '%s', '%s')",
                    $_REQUEST['username'], $_REQUEST['pass'],
                    $_REQUEST['name'], $_REQUEST['img']);
    var_dump($sql);
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location:qluser.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Them User</title>
</head>

<body>
    <form name="frmThem" method="post" action="them.php">
        <table border="0">
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="pass"></td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Image:</td>
                <td><input type="text" name="img"></td>
            </tr>
        </table>
        <input type="submit" name="btnSubmit" value="Save" />
    </form>
</body>

</html>