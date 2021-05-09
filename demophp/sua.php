<?php
require_once('lib.php');

if (isset($_REQUEST['btnSubmit'])) {
    $conn = createDbConnection();

    $sql = sprintf(
        "UPDATE user 
            SET username = '%s', password='%s', name='%s', image='%s' 
            WHERE username = '%s'", 
        $_REQUEST['username'],
        $_REQUEST['pass'],
        $_REQUEST['name'],
        $_REQUEST['img'],
        $_REQUEST['oldUsername']
    );
    var_dump($sql);
    if ($conn->query($sql) === TRUE) {
        echo "The record updated successfully";
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
    <title>Sua User</title>
</head>

<body>
    <?php
    $conn = createDBConnection();

    $sql = sprintf("SELECT * FROM user WHERE username='%s'", $_REQUEST['user']);
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>
    <form name="frmSua" method="post" action="sua.php">
        <input type="hidden" name="oldUsername" value="<?= $row['USERNAME'] ?>"/>
        <table border="0">
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" value="<?= $row['USERNAME'] ?>"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="pass" value="<?= $row['PASSWORD'] ?>"></td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" value="<?= $row['NAME'] ?>"></td>
            </tr>
            <tr>
                <td>Image:</td>
                <td><input type="text" name="img" value="<?= $row['IMAGE'] ?>"></td>
            </tr>
        </table>
        <input type="submit" name="btnSubmit" value="Save" />
    </form>
</body>

</html>