<?php
require_once('libraAd.php');
?>
<!doctype html>
<html lang="en">

<head>
    <title>ADMIN</title>
    <link href="css/main.css" rel="stylesheet">
    <link href="css/fontAwesome.css" rel="stylesheet">
</head>

<body>
    <div class="app-header header-shadow" style="background-color:rgb(54, 50, 50);">
        <div class="app-header__logo">
            <img src="img/logo.png" alt="">
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
                    <li class="nav-item">
                        <a href="admin.php">
                            <button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning"><i class="nav-link-icon fa fa-home"> Home</i></button>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="qlUser.php">
                            <button class="mr-2 btn-icon btn-icon-only btn btn-outline-info"><i class="nav-link-icon fa fa-user"> Users</i></button>
                        </a>
                    </li>
                    <li class="btn-group nav-item">
                        <a href="Tickets.php">
                            <button class="mr-2 btn-icon btn-icon-only btn btn-outline-success"><i class="nav-link-icon fa fa-tickets"> Flight Management</i></button>
                        </a>
                    </li>
                    <li class="btn-group nav-item">
                        <a href="Tickets.php">
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
                                    <img width="42" class="rounded-circle" src="/Air/img/meo1.jpg" alt="">
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

                <div class="card-header">Account
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Username to find">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Number ticket</th>
                                <th class="text-center">Full name</th>
                                <th class="text-center">Phone Number</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Detail</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conn = createDBConnection();
                            $sql = "SELECT * FROM ticket_details td , payment_details pd, passengers pag , flight_details fd
                             WHERE fd.flight_no=td.flight_no and pd.payment_id = td.payment_id and td.pnr = pag.pnr and td.booking_status="."";
                            ?>
                            <tr>
                                <td class="text-center text-muted">NghiaNguyen</td>
                                <td class="text-center text-muted">NghiaNguyen</td>
                                <td>
                                    <div class="text-center text-muted">nghiameow@gmail.com
                                    </div>
                                </td>
                                <td class="text-center"><img src="/Air/img/meo1.jpg" alt="" width="100px"></td>
                                <td class="text-center">
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-alternate">
                                        <div class="btn-group">
                                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">

                                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                                <p class="dropdown">Profile</p>
                                                <p class="dropdown">Log out</p>
                                            </div>
                                        </div>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="nav-link-icon fa fa-trash-o"></i></button>
                                </td>
                            </tr>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="d-block text-center card-footer">
                    <nav class="" aria-label="Page navigation example" style="padding-left: 520px;">
                        <ul class="pagination">
                            <li class="page-item "><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only"></span></a></li>

                            <li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only"></span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/main1.js"></script>
</body>

</html>