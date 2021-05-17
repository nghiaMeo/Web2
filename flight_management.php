<?php
require_once('libraAd.php');
if (!isset($_REQUEST['Page']))
    $_REQUEST['Page'] = 0;
?>
<html lang="en">

<head>
    <title>Flights Management</title>
    <link href="css/main.css" rel="stylesheet">
    <link href="css/fontAwesome.css" rel="stylesheet">
    <style>
        .pager {
            padding-left: 0;
            margin: 20px 0;
            text-align: center;
            list-style: none
        }

        .pager li {
            display: inline
        }

        .pager li>a,
        .pager li>span {
            display: inline-block;
            padding: 5px 14px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 15px
        }

        .pager li>a:hover,
        .pager li>a:focus {
            text-decoration: none;
            background-color: #eee
        }

        .pager .next>a,
        .pager .next>span {
            float: right
        }

        .pager .previous>a,
        .pager .previous>span {
            float: left
        }

        .pager .disabled>a,
        .pager .disabled>a:hover,
        .pager .disabled>a:focus,
        .pager .disabled>span {
            color: #777;
            cursor: not-allowed;
            background-color: #fff
        }
    </style>
</head>

<body>
    <div class="app-header header-shadow" style="background-color:rgb(54, 50, 50);">
        <div class="app-header__logo">
            <img src="/img/logo.png" alt="">
        </div>
        <div class="app-header__menu">
            <span>
                <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
                </button>
            </span>
        </div>
        <div class="app-header__content">
            <div class="app-header-left">
                <ul class="header-menu nav">
                    <li class="btn-group nav-item">
                        <a href="admin.php">
                            <button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning"><i class="nav-link-icon fa fa-home"> Home</i></button>
                        </a>
                    </li>
                    <li class="btn-group nav-item">
                        <a href="flight_management.php">
                            <button class="mr-2 btn-icon btn-icon-only btn btn-outline-success"><i class="nav-link-icon fa fa-tickets"> Tickets</i></button>
                        </a>
                    </li>
                    <li class="btn-group nav-item">
                        <a href="qlDonHang.php">
                            <button class="mr-2 btn-icon btn-icon-only btn btn-outline-success"><i class="nav-link-icon fa fa-list"> Order management</i></button>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="app-header-right">
                <div class="header-btn-lg pr-0">
                    <div class="widget-content p-0"></div>
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    <img width="42" class="rounded-circle" src="img/meo1.jpg" alt="">
                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                    <button type="button" tabindex="0" class="dropdown-item">Profile</button>
                                    <div tabindex="-1" class="dropdown-divider"></div>
                                    <button type="button" tabindex="0" class="dropdown-item">Log out</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="row center-block" style="margin-top: 2em;">
                    <div class="col-md-3">
                        <h3>Flights Management</h3>
                    </div>
                    <div class="col-md-9">
                        <form action="flight_management.php" class="form-inline" method="get">
                            <div class="form-group">
                                <label for="deparure">Depature date:</label>
                                <input type="date" name="dep_date" class="form-control" style="margin-left: 1em;" id="deparure" required="">
                            </div>
                            <div class="form-group" style="margin-left: 1em;">
                                <label for="deparure">Flight From:</label>
                                <select required name='from' style="margin-left: 1em;" class="form-control">
                                    <option value="">Select a location...</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="India">India</option>
                                    <option value="Korea">Korea</option>
                                    <option value="Laos">Laos</option>
                                    <option value="Myanmar">Myanmar</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Vietnam">Viet Nam</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-left: 1em;">
                                <label for="deparure">Flight to:</label>
                                <select required name='to' style="margin-left: 1em;" class="form-control">
                                    <option value="">Select a location...</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="India">India</option>
                                    <option value="Korea">Korea</option>
                                    <option value="Laos">Laos</option>
                                    <option value="Myanmar">Myanmar</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Vietnam">Viet Nam</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-left: 1em;">
                                <button type="submit" name="Search" id="form-submit" class="form-control">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Flight NO</th>
                                <th>Flight</th>
                                <th>Depature date</th>
                                <th>Arrival date</th>
                                <th>Depature time</th>
                                <th>Arrival time</th>
                                <th>Seat economy</th>
                                <th>Seat bussiness</th>
                                <th>Price economy</th>
                                <th>Price bussiness</th>
                                <th>Jet id</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_REQUEST['from']))
                                $sql = sprintf("SELECT * FROM flight_details WHERE from_city='%s' and to_city='%s' and departure_date='%s'", $_REQUEST['from'], $_REQUEST['to'], $_REQUEST['dep_date']);
                            else
                                $sql = "SELECT * FROM flight_details";
                            $sql = sprintf($sql . " LIMIT %s,%s", $_REQUEST['Page'] * 5, 5);
                            $conn = createDBConnection();
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?= $row['flight_no'] ?></td>
                                    <td><?= $row['from_city'] ?>-<?= $row['to_city'] ?></td>
                                    <td><?= $row['departure_date'] ?></td>
                                    <td><?= $row['arrival_date'] ?></td>
                                    <td><?= $row['departure_time'] ?></td>
                                    <td><?= $row['arrival_time'] ?></td>
                                    <td><?= $row['seats_economy'] ?></td>
                                    <td><?= $row['seats_business'] ?></td>
                                    <td><?= $row["price_economy"] ?></td>
                                    <td><?= $row["price_business"] ?></td>
                                    <td><?= $row['jet_id'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="">
                    <ul class="pager">
                        <?php
                        $search = isset($_REQUEST['from']) ? sprintf(
                            "?Page=%s&dep_date=%s&from=%s&to=%s&Search=",
                            ($_REQUEST['Page'] > 0) ? $_REQUEST['Page'] - 1 : $_REQUEST['Page'],
                            $_REQUEST['dep_date'],
                            $_REQUEST['from'],
                            $_REQUEST['to']
                        ) : '?Page=' . (($_REQUEST['Page'] > 0) ? $_REQUEST['Page'] - 1 : $_REQUEST['Page']);
                        ?>
                        <li><a href="flight_management.php<?= $search ?>">Previous</a></li>
                        <?php
                        if (isset($_REQUEST['from']))
                            $sql = sprintf("SELECT * FROM flight_details WHERE from_city='%s' and to_city='%s' and departure_date='%s'", $_REQUEST['from'], $_REQUEST['to'], $_REQUEST['dep_date']);
                        else
                            $sql = "SELECT * FROM flight_details";
                        $result = $conn->query($sql);
                        $all = $result->num_rows;
                        $page = ($all % 5 == 0) ? intval($all / 4) : intval($all / 4) + 1;
                        for ($i = 0; $i < $page; $i++) {
                            $search = isset($_REQUEST['from']) ? sprintf(
                                "?Page=%s&dep_date=%s&from=%s&to=%s&Search=",
                                $i,
                                $_REQUEST['dep_date'],
                                $_REQUEST['from'],
                                $_REQUEST['to']
                            ) : '?Page=' . $i;
                        ?>
                            <li><a href="flight_management.php<?= $search ?>"><?= $i + 1 ?></a></li>
                        <?php
                        }
                        $search = isset($_REQUEST['from']) ? sprintf(
                            "?Page=%s&dep_date=%s&from=%s&to=%s&Search=",
                            ($_REQUEST['Page'] < $page-1) ? $_REQUEST['Page'] + 1 : $_REQUEST['Page'],
                            $_REQUEST['dep_date'],
                            $_REQUEST['from'],
                            $_REQUEST['to']
                        ) : '?Page=' . (($_REQUEST['Page'] < $page-1) ? $_REQUEST['Page'] + 1 : $_REQUEST['Page']);
                        ?>
                        <li><a href="flight_management.php<?= $search ?>">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/main1.js"></script>
</body>

</html>