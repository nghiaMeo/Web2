<?php
require_once('lib.php');
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ket qua tim User</title>
</head>

<body>
    <table border="1">
    <tr>
        <th>Username</th>
        <th>Name</th>
        <th>Image</th>
    </tr>
    <?php
        $conn = createDBConnection();
        $sql = sprintf("SELECT * FROM user WHERE username LIKE '%%%s%%'", $_REQUEST['keyword']);
        var_dump($sql);
        $result = $conn->query($sql); 
        if ($result !== false && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
    ?>
    <tr>
        <td><?= $row['USERNAME'] ?></td>
        <td><?= $row['NAME'] ?></td>
        <td><img width="170" src="<?= $row['IMAGE'] ?>" /></td>
        <td><a href="xoa.php?user=<?= $row['USERNAME'] ?>" onclick="return confirm('Are you sure?')"/>Delete</a></td>
        <td><a href="sua.php?user=<?= $row['USERNAME'] ?>" >Update</a></td>
    </tr>
    <?php
            }  
        }
    ?>
    </table>
</body>

</html>