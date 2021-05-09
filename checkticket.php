<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <title>Check Tickets</title>
    <link href="css/main.css" rel="stylesheet">
    <link href="css/fontAwesome.css" rel="stylesheet">
</head>

<body>
    <div class="app-header header-shadow" style="background-color:rgb(245, 235, 235);">
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
                <div class="search-wrapper">
                    <div class="input-holder">
                        <input type="text" class="search-input" placeholder="Type to search">
                        <button class="search-icon"><span></span></button>
                    </div>
                    <button class="close"></button>
                </div>
                <ul class="header-menu nav">
                    <li class="nav-item">
                        <button class="mb-2 mr-2 btn-transition btn btn-outline-warning">FLIGHT INFORMATION</button>
                    </li>
                    <li class="btn-group nav-item">
                        <button class="mb-2 mr-2 btn-transition btn btn-outline-warning">SERVICE</button>
                    </li>
                    <li class="dropdown nav-item">
                        <button class="mb-2 mr-2 btn-transition btn btn-outline-warning">RESERVATION
                            INFORMATION</button>
                    </li>
                    <li class="dropdown nav-item">
                        <button class="mb-2 mr-2 btn-transition btn btn-outline-warning">CHECK TICKET</button>
                    </li>
                </ul>
            </div>
            <div class="app-header-right">
                <div class="header-btn-lg pr-0">
                    <div class="widget-content p-0"></div>
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a href="LoARe.html"><button
                                        class="mb-2 mr-2 btn-transition btn btn-outline-warning">LOG IN
                                    </button></a>
                                <a href="LoARe.html"><button
                                        class="mb-2 mr-2 btn-transition btn btn-outline-warning">SIGN UP
                                    </button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="card-title">Check Tickets</div>
                    <form action="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="title">Booking Code</label>
                                    <input id="title" type="text" class="form-control"
                                        placeholder="EX: TR0984" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div id="toastTypeGroup">
                                    <div class="form-group">
                                        <label class="form-label" for="title">Full Name</label>
                                        <input id="title" type="text" class="form-control"
                                            placeholder="Nguyen Huu Nghia" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="title">Code pPlane</label>
                                    <input id="title" type="text" class="form-control"
                                        placeholder="EX: VN0934" />
                                </div>
                                <input class="mb-2 mr-2 btn-transition btn btn-outline-warning" name="btnSubmit"
                                    type="submit" value="CHECK" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/main1.js"></script>
</body>

</html>