<?= require_once('lib.php') ?>
<?= require_once('Sessionadmin.php') ?>

<?php

if (isLoginedCus()) {
    if (!isset($_REQUEST['Page']))
        $_REQUEST['Page'] = 0;
    require_once('header.php');
?>
    <!--product management-->
    <div id="PManagement" class="container_fullwidth">
        <div class="container" style="background-color: white;width: 100%;margin-top: 5%;">
            <br>
            <h3>Product Management</h3>
            <br>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <br>
                    <button onclick="location.href = 'add.php'" class="form-control" style="width: 100%;" data-toggle="modal" data-target="#addModal">Add</button>
                </div>
                <div class="col-md-10 ">
                    <form class="" action="index.php">
                        <div class="row pull-right">
                            <input type="hidden" name="search1" value="search">
                            <div class="col-md-3">
                                <label for="search">Name:</label>
                                <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                            </div>
                            <div class="col-md-3">
                                <label for="sel1">Select type :</label>
                                <select class="form-control" class="" name="type" id="sel1">
                                    <option id="none" value=""></option>
                                    <option id="men" value="MEN">MEN</option>
                                    <option id="women" value="WOMEN">WOMEN</option>
                                    <option id="uni" value="UNISEX">UNISEX</option>
                                    <option id="hot" value="HOTPRODUCT">HOT PRODUCT</option>
                                    <option id="feat" value="FEATUREDPRODUCT">FEATURED PRODUCT</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="sel1">Select price :</label>
                                <select class="form-control" class="" name="price" id="sel1">
                                    <option id="none" value=""></option>
                                    <option id="men" value="10-30">10$-30$</option>
                                    <option id="women" value="30-50">30$-50$</option>
                                    <option id="uni" value="50-60">50$-70$</option>
                                    <option id="hot" value="70-90">70$-90$</option>
                                    <option id="feat" value="90-1000">>=90$</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <br>
                                <button type="submit" class="btn btn-default">Search</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Pid</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Img</th>
                    <th>Brand</th>
                    <th>Detail</th>
                    <th>Edit product</th>
                </tr>
            </thead>
            <tbody>
                <?php
                function getSQL()
                {
                    if (!isset($_REQUEST['search1']))
                        return  "select* from product";
                    if ($_REQUEST['search'] != '' && $_REQUEST['type'] != '' && $_REQUEST['price'] != '') {
                        $a = explode('-', $_REQUEST['price']);
                        return sprintf(
                            "select* 
                        from product 
                        where name like '%%%s%%' and TYPE='%s' and price>=%s and price<%s",
                            $_REQUEST['search'],
                            $_REQUEST['type'],
                            $a[0],
                            $a[1]
                        );
                    }
                    if ($_REQUEST['search'] != '' && $_REQUEST['type'] != '')
                        return sprintf("select* from product where name like '%%%s%%' and TYPE='%s' ", $_REQUEST['search'], $_REQUEST['type']);
                    if ($_REQUEST['type'] != '' && $_REQUEST['price'] != '') {
                        $a = explode('-', $_REQUEST['price']);
                        return sprintf(
                            "select* from product where TYPE='%s' and price>=%s and price<%s ",
                            $_REQUEST['type'],
                            $a[0],
                            $a[1]
                        );
                    }
                    if ($_REQUEST['search'] != '' && $_REQUEST['price'] != '') {
                        $a = explode('-', $_REQUEST['price']);
                        return sprintf(
                            "select* from product where name like '%%%s%%' and price>=%s and price<%s ",
                            $_REQUEST['search'],
                            $a[0],
                            $a[1]
                        );
                    }
                    if ($_REQUEST['type'] != '')
                        return sprintf("select* from product where TYPE='%s'", $_REQUEST['type']);
                    if ($_REQUEST['search'] != '')
                        return sprintf("select* from product where name like '%%%s%%'", $_REQUEST['name']);
                    if ($_REQUEST['price'] != '') {
                        $a = explode('-', $_REQUEST['price']);
                        return sprintf(
                            "select* from product where price>=%s and price<%s",
                            $a[0],
                            $a[1]
                        );
                    }
                    if ($_REQUEST['search'] == '' && $_REQUEST['type'] == '' && $_REQUEST['price'] == '')
                        return  "select* from product";
                }
                $sql = getSQL();
                $sql = $sql . " Limit " . ($_REQUEST['Page'] * 4) . ",4";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $count = $row['PID'];
                ?>
                    <tr>
                        <td><?= $row['PID'] ?></td>
                        <td><?= $row['TYPE'] ?></td>
                        <td><?= $row['NAME'] ?></td>
                        <td><?= $row['PRICE'] ?></td>
                        <td><img src=" ../<?= $row['IMG'] ?>" width="10%" alt=""></td>
                        <td><?= $row['BRAND'] ?></td>
                        <td><?= $row['DETAIL'] ?></td>
                        <td>
                            <button data-toggle="modal" data-target="#updateModal" onclick="location.href = 'update.php?id=<?= $row['PID'] ?>'">Update</button>
                            <button onclick="wannadelete('<?= $row['PID'] ?>')">Delete</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <div class="row">
            <div class="pager col-md-6">
                <a href="#" class="prev-page">
                    <i class="fa fa-angle-left">
                    </i>
                </a>
                <?php
                $sql = getSQL();
                $result = $conn->query($sql);
                $row = $result->num_rows;
                $pages = $row % 4 == 0 ? intval($row / 4) : intval($row / 4) + 1;
                for ($i = 0; $i < $pages; $i++) {
                    $search = "Page=" . $i . (isset($_REQUEST['search1']) ? ("&type=" . $_REQUEST['type'] . "&" . "search=" . $_REQUEST['search'] . "&" . "price=" . $_REQUEST['price'] . "&" . "search1=search") : "");
                ?>
                    <a href="index.php?<?= $search ?>" class="active">
                        <?= ($i + 1) ?>
                    </a>
                <?php
                }
                ?>
                <a href="#" class="next-page">
                    <i class="fa fa-angle-right">
                    </i>
                </a>
            </div>
        </div>
    </div>
    </div>


    </html>
<?php
} else
    header('location: login.php');
?>