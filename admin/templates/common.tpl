<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--<link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">-->
<title>phd-ja admin</title>
<link href="lib/elaadmin/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
<link href="lib/elaadmin/css/helper.css" rel="stylesheet">
<link href="lib/elaadmin/css/style.css" rel="stylesheet">
<link href="css/common.css" rel="stylesheet">
</head>

<body class="fix-header fix-sidebar">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>

    <div id="main-wrapper">
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./">
                        <b><i id="logo" class="fas fa-file-powerpoint fa-fw fa-lg"></i></b>
                        <span>phd-ja admin</span>
                    </a>
                </div>

                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item"><a class="nav-link nav-toggler hidden-md-up text-muted" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a></li>
                        <li class="nav-item m-l-10"><a class="nav-link sidebartoggler hidden-sm-down text-muted" href="javascript:void(0)"><i class="ti-menu"></i></a></li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Menu</li>
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fas fa-code-branch fa-fw"></i><span class="hide-menu">Working Copy</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="diff.php">Diff</a></li>
                                <li><a href="revert.php">Revert</a></li>
                                <li><a href="update.php">Update</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fas fa-book fa-fw"></i><span class="hide-menu">Documentation</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="edit.php">Edit</a></li>
                                <li><a href="build.php">Build</a></li>
                                <li><a href="../phd-ja/" target="view">View</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-12 align-self-center">
                    <h3 class="text-primary"><?php show_title(); ?></h3>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="content" class="card-content">
                                    <?php show_content(); ?>
                                    <pre id="terminal"></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">Template designed by <a href="https://colorlib.com">Colorlib</a></footer>
        </div>
    </div>

    <script src="lib/elaadmin/js/lib/jquery/jquery.min.js"></script>
    <script src="lib/elaadmin/js/lib/bootstrap/js/popper.min.js"></script>
    <script src="lib/elaadmin/js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="lib/elaadmin/js/jquery.slimscroll.js"></script>
    <script src="lib/elaadmin/js/sidebarmenu.js"></script>
    <script src="lib/elaadmin/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="lib/elaadmin/js/custom.min.js"></script>
    <?php show_scripts(); ?>
</body>
</html>
