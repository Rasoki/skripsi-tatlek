<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->
        <title>Home</title>

        <!-- inject:css -->
        <link rel="stylesheet" href="<?= base_url('includes') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url('includes') ?>/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url('includes') ?>/bower_components/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="<?= base_url('includes') ?>/bower_components/weather-icons/css/weather-icons.min.css">
        <link rel="stylesheet" href="<?= base_url('includes') ?>/bower_components/themify-icons/css/themify-icons.css">
        <!-- endinject -->
        
         <!--highcharts-->
        <script src="<?= base_url('includes') ?>/bower_components/highcharts/highcharts.js"></script>
        <script src="<?= base_url('includes') ?>/bower_components/highcharts/highcharts-more.js"></script>
        <script src="<?= base_url('includes') ?>/bower_components/highcharts/modules/exporting.js"></script>
        <script src="<?= base_url('includes') ?>/assets/js/init-highcharts-inner.js"></script>
        
        <!-- Main Style  -->
        <link rel="stylesheet" href="<?= base_url('includes') ?>/dist/css/main.css">

        <!--C3 Charts Depencencies -->
        <link rel="stylesheet" href="<?= base_url('includes') ?>/bower_components/c3/c3.min.css">

        <link rel="stylesheet" href="<?= base_url('includes') ?>/dist/css/main.css">

        <script src="<?= base_url('includes') ?>/assets/js/modernizr-custom.js"></script>
        
        
        <!-- Rickshaw Chart Depencencies -->
        <link rel="stylesheet" href="<?= base_url('includes') ?>/bower_components/rickshaw/rickshaw.min.css">

        <!--easypiechart-->
        <link rel="stylesheet" href="<?= base_url('includes') ?>/assets/js/jquery-easy-pie-chart/easypiechart.css">

        <!--horizontal-timeline-->
        <link rel="stylesheet" href="<?= base_url('includes') ?>/assets/js/horizontal-timeline/css/style.css">


        <script src="<?= base_url('includes') ?>/assets/js/modernizr-custom.js"></script>

        <!--Data Table-->
        <link href="<?= base_url('includes') ?>/bower_components/datatables/media/css/jquery.dataTables.css" rel="stylesheet">
        <link href="<?= base_url('includes') ?>/bower_components/datatables-tabletools/css/dataTables.tableTools.css" rel="stylesheet">
        <link href="<?= base_url('includes') ?>/bower_components/datatables-colvis/css/dataTables.colVis.css" rel="stylesheet">
        <link href="<?= base_url('includes') ?>/bower_components/datatables-responsive/css/responsive.dataTables.scss" rel="stylesheet">
        <link href="<?= base_url('includes') ?>/bower_components/datatables-scroller/css/scroller.dataTables.scss" rel="stylesheet">
        <script src="<?= base_url('includes') ?>/assets/js/modernizr-custom.js"></script>


        <!--jQuery Nestable Dependencies  -->
        <link rel="stylesheet" href="<?= base_url('includes') ?>/assets/css/jquery.nestable.css">

        <!--Fuelux Tree Depencencies -->
        <link rel="stylesheet" type="text/css" href="<?= base_url('includes') ?>/assets/js/fuelux/css/tree-style.css" />
        
         <!--grafik-->
         <!-- Load plotly.js into the DOM -->
	<!--<script src='https://cdn.plot.ly/plotly-latest.min.js'></script>-->
         <script src='<?= base_url('includes') ?>/assets/plot.js'> </script>
        
    </head>
    <body>

        <div id="ui" class="ui">

            <!--header start-->
            <header id="header" class="ui-header">

                <div class="navbar-header">
                    <!--logo start-->
                    <a href="<?php echo site_url() . 'Dashboard'; ?>" class="navbar-brand">
                        <span class="logo"><img src="<?= base_url('includes') ?>/imgs/logo-dark.png" alt=""/></span>
                        <span class="logo-compact"><img src="<?= base_url('includes') ?>/imgs/logo-icon-dark.png" alt=""/></span>
                    </a>
                    <!--logo end-->
                </div>

                <!--                <div class="search-dropdown dropdown pull-right visible-xs">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-search"></i></button>
                                    <div class="dropdown-menu">
                                        <form >
                                            <input class="form-control" placeholder="Search here..." type="text">
                                        </form>
                                    </div>
                                </div>-->

                <div class="navbar-collapse nav-responsive-disabled">

                    <!--toggle buttons start-->
                    <ul class="nav navbar-nav">
                        <li>
                            <a class="toggle-btn" data-toggle="ui-nav" href="">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- toggle buttons end -->


                    <!--notification start-->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown dropdown-usermenu">
                            <a href="#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <div class="user-avatar"><img src="<?= base_url('includes') ?>/imgs/a0.jpg" alt="..."></div>
                                <span class="hidden-sm hidden-xs"><?php echo $this->session->userdata("jabatan") ?></span>
                                <!--<i class="fa fa-angle-down"></i>-->
                                <span class="caret hidden-sm hidden-xs"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">

                                <li><a href="<?= site_url('Template/logout') ?>"><i class="fa fa-sign-out"></i> Log Out</a></li>
                            </ul>
                        </li>

                    </ul>
                    <!--notification end-->

                </div>

            </header>
            <!--header end-->

            <!--sidebar start-->
            <aside id="aside" class="ui-aside">
                <ul class="nav" ui-nav>

                    <li class="active">
                        <a href="<?= site_url('dashboard') ?>"><i class="fa fa-home"></i><span>Dashboard</span></a>

                    </li>
                    <li>
                        <a href=""><i class="fa fa-table"></i><span>Data Tables</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="nav nav-sub">
                            <li class="nav-sub-header"><a href=""><span>Data Tables</span></a></li>
                            <li><a href="<?= site_url('kategori') ?>"><span>Data Kategori </span></a></li>
<!--                            <li><a href="<?= site_url('rak') ?>"><span>Data Rak</span></a></li>-->
                            <li><a href="<?= site_url('barang') ?>"><span>Data Barang</span></a></li>
                            <li><a href="<?= site_url('transaksi') ?>"><span>Data Transaksi</span></a></li>
                            <li><a href="<?= site_url('akun') ?>"><span>Data Akun</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-list-alt"></i><span>Form</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="nav nav-sub">
                            <li class="nav-sub-header"><a href=""><span>Form</span></a></li>
                            <li><a href="<?= site_url('kategori/form') ?>"><span>Form Kategori </span></a></li>
<!--                            <li><a href="<?= site_url('rak/form') ?>"><span>Form Rak</span></a></li>-->
                            <li><a href="<?= site_url('barang/form') ?>"><span>Form Barang</span></a></li>
                            <li><a href="<?= site_url('transaksi/form') ?>"><span>Form Transaksi</span></a></li>
                            <li><a href="<?= site_url('akun/form') ?>"><span>Form Akun</span></a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="<?= site_url('tatlek') ?>"><i class="fa fa-bullseye"></i><span>Tata Letak</span></a> 
                    </li>
                </ul>
            </aside>
            <!--sidebar end-->

            <!--main content start-->
            <div id="content" class="ui-content ui-content-aside-overlay">
                <div class="ui-content-body">

                    <?php
                    $this->load->view($konten);
                    ?>
                </div>
            </div>
            <!--main content end-->


            <!--footer start-->
            <div id="footer" class="ui-footer">
                2017 &copy; MegaDin by ThemeBucket.
            </div>
            <!--footer end-->

        </div>

        <!-- inject:js -->
        <script src="<?= base_url('includes') ?>/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?= base_url('includes') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?= base_url('includes') ?>/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
        <script src="<?= base_url('includes') ?>/bower_components/autosize/dist/autosize.min.js"></script>
        <!-- endinject -->

        <!--highcharts-->
        <script src="<?= base_url('includes') ?>/bower_components/highcharts/highcharts.js"></script>
        <script src="<?= base_url('includes') ?>/bower_components/highcharts/highcharts-more.js"></script>
        <script src="<?= base_url('includes') ?>/bower_components/highcharts/modules/exporting.js"></script>

        <!--horizontal-timeline-->
        <script src="<?= base_url('includes') ?>/assets/js/horizontal-timeline/js/jquery.mobile.custom.min.js"></script>
        <script src="<?= base_url('includes') ?>/assets/js/horizontal-timeline/js/main.js"></script>

        <!-- Common Script   -->
        <script src="<?= base_url('includes') ?>/dist/js/main.js"></script>

        <!-- Data Table-->
        <script src="<?= base_url('includes') ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('includes') ?>/bower_components/datatables-tabletools/js/dataTables.tableTools.js"></script>
        <script src="<?= base_url('includes') ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="<?= base_url('includes') ?>/bower_components/datatables-colvis/js/dataTables.colVis.js"></script>
        <script src="<?= base_url('includes') ?>/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>
        <script src="<?= base_url('includes') ?>/bower_components/datatables-scroller/js/dataTables.scroller.js"></script>

        <!--init data tables-->
        <script src="<?= base_url('includes') ?>/assets/js/init-datatables.js"></script>

        <!--Fuelux Tree Depencencies -->
        <script src="<?= base_url('includes') ?>/assets/js/fuelux/js/tree.min.js"></script>
        <script src="<?= base_url('includes') ?>/assets/js/fuelux/js/init-tree.js"></script>
        <!--jQuery Nestable Dependencies  -->
        <script src="<?= base_url('includes') ?>/bower_components/Nestable/jquery.nestable.js"></script>
        <script src="<?= base_url('includes') ?>/assets/js/init-nestable.js"></script>
        
         <!--grafik-->
         <!-- Load plotly.js into the DOM -->
	<script src='https://cdn.plot.ly/plotly-latest.min.js'></script>
        
    </body>
</html>
