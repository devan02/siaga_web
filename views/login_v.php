<!DOCTYPE html>
<html>

<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <title>Login - SIAGA PDAM TIRTA PATRIOT</title>
    <meta name="keywords" content="HTML5 Bootstrap 3 Admin Template UI Theme" />
    <meta name="description" content="AdminDesigns - A Responsive HTML5 Admin UI Framework">
    <meta name="author" content="AdminDesigns">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font CSS (Via CDN) -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800'>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,500,700,300">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>material/assets/skin/default_skin/css/theme.css">

    <!-- Admin Forms CSS -->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>material/assets/admin-tools/admin-forms/css/admin-forms.css">

    <link rel="stylesheet" href="<?=base_url();?>jgrowl/jquery.jgrowl_login.css" type="text/css"/>
    <link rel="stylesheet" href="<?=base_url();?>css/alert_jgrowl.css" type="text/css"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=base_url();?>ico/water-droplets-hi.ico">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
   <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
   <![endif]-->
   <style type="text/css">
    #dp_swf_engine {
        display: none;
    }
   </style>
</head>

<body class="external-page sb-l-c sb-r-c">

    <!-- Start: Settings Scripts -->
    <script>
        var boxtest = localStorage.getItem('boxed');

        if (boxtest === 'true') {
            document.body.className += ' boxed-layout';
        }
    </script>
    <!-- End: Settings Scripts -->

    <!-- Start: Main -->
    <div id="main" class="animated fadeIn">

        <!-- Start: Content -->
        <section id="content_wrapper">

            <!-- begin canvas animation bg -->
            <div id="canvas-wrapper">
                <canvas id="demo-canvas"></canvas>
            </div>

            <!-- Begin: Content -->
            <section id="content">

                <div class="admin-form theme-info" id="login1" style="margin-top:40px;">

                    <div class="panel panel-info mt10 br-n">

                        <div class="panel-heading heading-border bg-white" style="padding-left: 27px;">
                           <div class="section row mn" style="line-height: 1.5;">

                            <span style="float: left;">
                                <img src="<?php echo base_url(); ?>images/logo-pdamtp.png" height="60" width="50"/>
                            </span>

                            <span style="float: left; margin-left: 15px; margin-top: 5px;">
                                <font style="color: #3bafda; font-size: 17px;">
                                    <b>SISTEM INFORMASI ANGGARAN</b> <br>
                                    PDAM TIRTA PATRIOT KOTA BEKASI
                                </font>   
                            </span>  
                            </div>
                        </div>

                        <!-- end .form-header section -->
                        <form method="post" action="<?php echo $url; ?>">
                            <div class="panel-body bg-light p30">
                                <div class="row">
                                    <div class="col-sm-7 pr30">

                                        <div class="section">
                                            <label for="username" class="field-label text-muted fs18 mb10">Username</label>
                                            <label for="username" class="field prepend-icon">
                                                <input type="text" name="username" id="username" class="gui-input" placeholder="Isikan Username anda">
                                                <label for="username" class="field-icon"><i class="fa fa-user"></i>
                                                </label>
                                            </label>
                                        </div>
                                        <!-- end section -->

                                        <div class="section">
                                            <label for="username" class="field-label text-muted fs18 mb10">Password</label>
                                            <label for="password" class="field prepend-icon">
                                                <input type="password" name="password" id="password" class="gui-input" placeholder="Isikan Password Anda">
                                                <label for="password" class="field-icon"><i class="fa fa-lock"></i>
                                                </label>
                                            </label>
                                        </div>
                                        <!-- end section -->

                                    </div>
                                    <div class="col-sm-5 br-l br-grey pl30">
                                        <h3 class="mb25"> Selamat Datang di SIAGA PDAM </h3>
                                        <p class="mb15">
                                            <span class="fa fa-check text-success pr5"></span> Input Anggaran </p>
                                        <p class="mb15">
                                            <span class="fa fa-check text-success pr5"></span> Laporan Anggaran Terinci dan Efektif</p>
                                        <p class="mb15">
                                            <span class="fa fa-check text-success pr5"></span> Proyeksi Anggaran Tahunan</p>
                                        <p class="mb15">
                                            <span class="fa fa-check text-success pr5"></span> dan Fitur Tambahan Lainnya</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end .form-body section -->
                            <div class="panel-footer clearfix p10 ph15">
                                <input type="submit" class="button btn-primary mr10 pull-right" value="Masuk">
                                <label class="switch block switch-primary pull-left input-align mt10">
                                    <input type="checkbox" name="remember" id="remember" checked>
                                    <label for="remember" data-on="YES" data-off="NO"></label>
                                    <span>Tetap masuk</span>
                                </label>
                            </div>
                            <!-- end .form-footer section -->
                        </form>
                    </div>
                </div>

            </section>
            <!-- End: Content -->

        </section>
        <!-- End: Content-Wrapper -->

    </div>
    <!-- End: Main -->

    <!-- BEGIN: PAGE SCRIPTS -->

    <!-- Google Map API -->


    <!-- jQuery -->
    <script type="text/javascript" src="<?=base_url();?>material/vendor/jquery/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/vendor/jquery/jquery_ui/jquery-ui.min.js"></script>

    <!-- Bootstrap -->
    <script type="text/javascript" src="<?=base_url();?>material/assets/js/bootstrap/bootstrap.min.js"></script>

    <!-- Page Plugins -->
    <script type="text/javascript" src="<?=base_url();?>material/assets/js/pages/login/EasePack.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/assets/js/pages/login/rAF.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/assets/js/pages/login/TweenLite.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/assets/js/pages/login/login.js"></script>

    <!-- Theme Javascript -->
    <script type="text/javascript" src="<?=base_url();?>material/assets/js/utility/utility.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/assets/js/main.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/assets/js/demo.js"></script>

    <script type="text/javascript" src="<?=base_url();?>jgrowl/jquery.jgrowl.js"></script>
    <!-- Page Javascript -->
    <script type="text/javascript">
        jQuery(document).ready(function() {

            "use strict";

            // Init Theme Core      
            Core.init();

            // Init Demo JS
            Demo.init();

            // Init CanvasBG and pass target starting location
            CanvasBG.init({
                Loc: {
                    x: window.innerWidth / 2,
                    y: window.innerHeight / 3.3
                },
            });

            <?php if($this->session->flashdata('gagal')){ ?>
                pesan_sukses();
            <?php } ?>
        });

        function pesan_sukses(){
            var pesan = '<div class="ui-pnotify-icon"><span class="glyphicons glyphicons-circle_remove"></span></div>'+
                        '<h4 class="ui-pnotify-title">Gagal</h4>'+
                        '<div class="ui-pnotify-text"><strong>Login gagal!</strong></div>';

            $.jGrowl(pesan, { header: '', life:3000 });
        }
    </script>

    <!-- END: PAGE SCRIPTS -->

</body>

</html>
