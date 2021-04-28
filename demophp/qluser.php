<html>
    <head><title></title></head>
    <body>
        <table>
            <tr>
                <th>Username</th>
                <th>Name</th>
                <th>image</th>
            </tr>
            <?php
                $conn = createDBConnection();
                $sql = "SELECT * FROM USER";
                while($row = $result ->fetch_assoc()){
            ?>
            <tr>
                <td> chen UserName</td>
                <td>chen Name</td>
                <td><img src="" alt=""> chen img</td>
            </tr>
            <?php
                }
            ?>
        </table>
    </body>
</html>