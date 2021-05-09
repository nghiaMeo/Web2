<?php
require_once('lib.php');
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Quan ly User</title>
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
        $sql = "SELECT * FROM user";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?= $row['USERNAME'] ?></td>
                <td><?= $row['NAME'] ?></td>
                <td><img width="170" src="<?= $row['IMAGE'] ?>" /></td>
                <?php if (isLogined()) {
                ?>
                    <td><a href="xoa.php?user=<?= $row['USERNAME'] ?>" onclick="return confirm('Are you sure?')" >Delete</a></td>
                    <td><a href="sua.php?user=<?= $row['USERNAME'] ?>">Update</a></td>
                <?php
                }
                ?>
            </tr>
        <?php
        }
        ?>
    </table>
    <a href="them.php">Them user</a>
</body>

</html>