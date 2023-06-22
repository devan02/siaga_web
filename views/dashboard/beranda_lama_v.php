<!DOCTYPE html>
<html>

<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <title>Sistem Informasi Anggaran PDAM - Tirta Patriot Kota Bekasi</title>
    <meta name="keywords" content="SIAGA - Sistem Informasi Anggaran PDAM" />
    <meta name="description" content="SIAGA - Sistem Informasi Anggaran PDAM">
    <meta name="author" content="SIAGA">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font CSS (Via CDN) -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700'>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700">

    <!-- Required Plugin CSS -->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>material/assets/js/utility/highlight/styles/googlecode.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>material/vendor/plugins/magnific/magnific-popup.css">

    <!-- Required Plugin CSS -->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>material/vendor/plugins/datepicker/css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>material/vendor/plugins/daterange/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>material/vendor/plugins/colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>material/vendor/plugins/tagmanager/tagmanager.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>material/vendor/plugins/datatables/media/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.0/css/buttons.dataTables.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>material/assets/skin/default_skin/css/theme.css">

    <!-- Admin Panels CSS -->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>material/assets/admin-tools/admin-plugins/admin-panels/adminpanels.css">

    <!-- Admin Forms CSS -->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>material/assets/admin-tools/admin-forms/css/admin-forms.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>material/assets/admin-tools/admin-plugins/admin-modal/adminmodal.css">
    <link rel="stylesheet" href="<?=base_url();?>jgrowl/jquery.jgrowl.css" type="text/css"/>
    <link rel="stylesheet" href="<?=base_url();?>css/alert_jgrowl.css" type="text/css"/>
    <link type='text/css'  href='<?=base_url();?>material/modal/css/basic.css' rel='stylesheet' media='screen' />
    <link type='text/css'  href='<?=base_url();?>material/custom-css/modal.css' rel='stylesheet' media='screen' />

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=base_url();?>ico/water-droplets-hi.ico">

    <link rel="stylesheet" href="<?=base_url();?>material/dialog/css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="<?=base_url();?>material/dialog/css/style.css"> <!-- Resource style -->
    <link rel="stylesheet" href="<?=base_url();?>css/style-devan.css">

    <script src="<?=base_url();?>material/dialog/js/modernizr.js"></script> <!-- Modernizr -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
   <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
   <![endif]-->

   <style type="text/css">
    .sidebar-menu > li:hover > a:after,
    .sidebar-menu > li:focus > a:after {
      background: #4a89dc;
      color : #4a89dc;
    }

    .sidebar-menu li{
        padding-left: 0.3px;
    }

    .mfp-close{
        opacity: 1;
    }

    #simplemodal-container{
        height: 420px;
    }

    .dt-buttons{
        margin:8px;
    }

    #datatable2_filter{
       margin-right: 15px;
       margin-top: 10px;
    }

    #datatable2_info{
       margin-left: 10px;
    }

    #datatable2_paginate .pagination{
       margin-right: 10px;
    }

    #popup_load_adit {
    width: 100%;
    height: 100%;
    position: fixed;
    background: #fff;
    z-index: 9999;
    opacity:0.8;
    filter:alpha(opacity=80); /* For IE8 and earlier */
    visibility:visible;
    top: 0;
    left: 0;
    }

    .profile-pic_edit{
        width:100%;
        max-width:185px;
        height:auto;
        background: none repeat scroll 0 0 #fff;
        border: 1px solid #ddd;
        padding: 5px;
    }

   </style>
</head>



<body class="dashboard-page sb-l-o sb-r-c profile-page">

<?PHP 
    $sess_user = $this->session->userdata('masuk_bos');
    $id_user = $sess_user['id'];

    $user_detail = $this->master_model_m->get_user_detail($id_user);

    if($id_user == "" || $id_user == null){
        redirect('login');
    }
    
?>

    <div id="popup_load_adit">
        <div class="window_load">
            <img src="<?=base_url()?>/ico/loading.gif" height="100" width="100">
        </div>
    </div>

    <!-- Start: Theme Preview Pane -->
    <div id="skin-toolbox" style="margin-top: -115px;">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-icon"><i class="fa fa-cog fa-spin text-primary"></i>
                </span>
                <span class="panel-title"> Pengaturan Tema</span>
            </div>
            <div class="panel-body pn">

                <ul class="nav nav-list nav-list-sm pl15 pt10" role="tablist">
                    <li class="active">
                        <a href="#toolbox-header" role="tab" data-toggle="tab">Header</a>
                    </li>
                    <li>
                        <a href="#toolbox-sidebar" role="tab" data-toggle="tab">Sidebar</a>
                    </li>
                    <li>
                        <a href="#toolbox-settings" role="tab" data-toggle="tab">Lainnya</a>
                    </li>
                </ul>

                <div class="tab-content p20 ptn pb15">
                    <div role="tabpanel" class="tab-pane active" id="toolbox-header">
                        <form id="toolbox-header-skin">
                            <h4 class="mv20">Warna Header</h4>

                            <div class="skin-toolbox-swatches">
                                <div class="checkbox-custom checkbox-disabled fill mb5">
                                    <input type="radio" name="headerSkin" id="headerSkin8" checked  value="bg-light">
                                    <label for="headerSkin8">Cerah</label>
                                </div>
                                <div class="checkbox-custom fill checkbox-primary mb5">
                                    <input type="radio" name="headerSkin"  id="headerSkin1" value="bg-primary">
                                    <label for="headerSkin1">Biru</label>
                                </div>
                                <div class="checkbox-custom fill checkbox-info mb5">
                                    <input type="radio" name="headerSkin" id="headerSkin3" value="bg-info">
                                    <label for="headerSkin3">Biru Muda</label>
                                </div>
                                <div class="checkbox-custom fill checkbox-warning mb5">
                                    <input type="radio" name="headerSkin" id="headerSkin4" value="bg-warning">
                                    <label for="headerSkin4">Orange</label>
                                </div>
                                <div class="checkbox-custom fill checkbox-danger mb5">
                                    <input type="radio" name="headerSkin" id="headerSkin5" value="bg-danger">
                                    <label for="headerSkin5">Merah</label>
                                </div>
                                <div class="checkbox-custom fill checkbox-alert mb5">
                                    <input type="radio" name="headerSkin" id="headerSkin6" value="bg-alert">
                                    <label for="headerSkin6">Ungu</label>
                                </div>
                                <div class="checkbox-custom fill checkbox-system mb5">
                                    <input type="radio" name="headerSkin" id="headerSkin7" value="bg-system">
                                    <label for="headerSkin7">Hijau</label>
                                </div>
                                <div class="checkbox-custom fill checkbox-success mb5">
                                    <input type="radio" name="headerSkin" id="headerSkin2" value="bg-success">
                                    <label for="headerSkin2">Hijau Muda</label>
                                </div>
                                <div class="checkbox-custom fill mb5">
                                    <input type="radio" name="headerSkin" id="headerSkin9" value="bg-dark">
                                    <label for="headerSkin9">Gelap</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="toolbox-sidebar">
                        <form id="toolbox-sidebar-skin">

                            <h4 class="mv20">Warna Sidebar</h4>
                            <div class="skin-toolbox-swatches">
                                <div class="checkbox-custom fill mb5">
                                    <input type="radio" name="sidebarSkin" checked id="sidebarSkin3" value="">
                                    <label for="sidebarSkin3">Dark</label>
                                </div>
                                <div class="checkbox-custom fill checkbox-disabled mb5">
                                    <input type="radio" name="sidebarSkin" id="sidebarSkin1" value="sidebar-light">
                                    <label for="sidebarSkin1">Light</label>
                                </div>
                                <div class="checkbox-custom fill checkbox-light mb5">
                                    <input type="radio" name="sidebarSkin"  id="sidebarSkin2" value="sidebar-light light">
                                    <label for="sidebarSkin2">Lighter</label>
                                </div>

                            </div>

                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="toolbox-settings">
                        <form id="toolbox-settings-misc">
                            <h4 class="mv20 mtn">Layout</h4>
                            <div class="form-group">
                                <div class="checkbox-custom fill mb5">
                                    <input type="checkbox" checked="" id="header-option">
                                    <label for="header-option">Fixed Header</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox-custom fill mb5">
                                    <input type="checkbox" id="sidebar-option">
                                    <label for="sidebar-option">Fixed Sidebar</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox-custom fill mb5">
                                    <input type="checkbox" id="breadcrumb-option">
                                    <label for="breadcrumb-option">Fixed Breadcrumbs</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox-custom fill mb5">
                                    <input type="checkbox" id="breadcrumb-hidden">
                                    <label for="breadcrumb-hidden">Hide Breadcrumbs</label>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="form-group mn br-t p15">
                    <a href="#" id="clearLocalStorage" class="btn btn-primary btn-block pb10 pt10">Reset Tema</a>
                </div>

            </div>
        </div>
    </div>
    <!-- End: Theme Preview Pane -->

    <!-- Start: Main -->
    <div id="main">

        <!-- Start: Header -->
        <header class="navbar navbar-fixed-top bg-light">
            <div class="navbar-branding">

                <a class="navbar-brand" href="dashboard.html"> <b>SIAGA</b> App
                </a>
                <span id="toggle_sidemenu_l" class="glyphicons glyphicons-show_lines"></span>
                <ul class="nav navbar-nav pull-right hidden">
                    <li>
                        <a href="#" class="sidebar-menu-toggle">
                            <span class="octicon octicon-ruby fs20 mr10 pull-right "></span>
                        </a>
                    </li>
                </ul>
            </div>
            <ul class="nav navbar-nav navbar-left">

                <li>
                    <span id="toggle_sidemenu_l2" class="glyphicon glyphicon-log-in fa-flip-horizontal hidden"></span>
                </li>
                <li class="dropdown hidden">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="glyphicons glyphicons-settings fs14"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="javascript:void(0);">
                                <span class="fa fa-times-circle-o pr5 text-primary"></span> Reset LocalStorage </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <span class="fa fa-slideshare pr5 text-info"></span> Force Global Logout </a>
                        </li>
                        <li class="divider mv5"></li>
                        <li>
                            <a href="javascript:void(0);">
                                <span class="fa fa-tasks pr5 text-danger"></span> Run Cron Job </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <span class="fa fa-wrench pr5 text-warning"></span> Maintenance Mode </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="request-fullscreen toggle-active" href="#">
                        <span class="octicon octicon-screen-full fs18"></span>
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown dropdown-item-slide">
                    <a class="dropdown-toggle pl10 pr10" data-toggle="dropdown" href="#">
                        <span class="octicon octicon-radio-tower fs18"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-hover dropdown-persist pn w350 bg-white animated animated-shorter fadeIn" role="menu">
                        <li class="bg-light p8">
                            <span class="fw600 pl5 lh30"> Notifications</span>
                            <span class="label label-warning label-sm pull-right lh20 h-20 mt5 mr5">12</span>
                        </li>
                        <li class="p10 br-t item-1">
                            <div class="media">
                                <a class="media-left" href="#"> <img src="<?=base_url();?>material/assets/img/avatars/7.jpg" class="mw40" alt="holder-img"> </a>
                                <div class="media-body va-m">
                                    <h5 class="media-heading mv5">Article <small class="text-muted">- 08/16/22</small> </h5> Last Updated 36 days ago by
                                    <a class="text-system" href="#"> Max </a>
                                </div>
                            </div>
                        </li>
                        <li class="p10 br-t item-2">
                            <div class="media">
                                <a class="media-left" href="#"> <img src="<?=base_url();?>material/assets/img/avatars/7.jpg" class="mw40" alt="holder-img"> </a>
                                <div class="media-body va-m">
                                    <h5 class="media-heading mv5">Article <small class="text-muted">- 08/16/22</small> </h5> Last Updated 36 days ago by
                                    <a class="text-system" href="#"> Max </a>
                                </div>
                            </div>
                        </li>
                        <li class="p10 br-t item-3">
                            <div class="media">
                                <a class="media-left" href="#"> <img src="<?=base_url();?>material/assets/img/avatars/7.jpg" class="mw40" alt="holder-img"> </a>
                                <div class="media-body va-m">
                                    <h5 class="media-heading mv5">Article <small class="text-muted">- 08/16/22</small> </h5> Last Updated 36 days ago by
                                    <a class="text-system" href="#"> Max </a>
                                </div>
                            </div>
                        </li>
                        <li class="p10 br-t item-4">
                            <div class="media">
                                <a class="media-left" href="#"> <img src="<?=base_url();?>material/assets/img/avatars/7.jpg" class="mw40" alt="holder-img"> </a>
                                <div class="media-body va-m">
                                    <h5 class="media-heading mv5">Article <small class="text-muted">- 08/16/22</small> </h5> Last Updated 36 days ago by
                                    <a class="text-system" href="#"> Max </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>

                <li class="ph10 pv20"> <i class="fa fa-circle text-tp fs8"></i>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle fw600 p15" data-toggle="dropdown"> 
                        <?PHP if($user_detail->FOTO == ""){?>
                            <img width="35" height="35" src="<?=base_url();?>files/user/default.png" alt="avatar" class="mw30 br64 mr15">
                        <?PHP } else { ?>
                            <img width="35" height="35" src="<?=base_url();?>files/user/<?=$user_detail->FOTO;?>" alt="avatar" class="mw30 br64 mr15">
                        <?PHP } ?>

                        <span><?=$user_detail->NAMA;?></span>
                        <span class="caret caret-tp"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-persist pn w250 bg-white" role="menu">
                        <li class="br-t of-h">
                            <a href="<?php echo base_url(); ?>login/sign_out" class="fw600 p12 animated animated-short fadeInDown">
                                <span class="fa fa-power-off pr5"></span> Logout </a>
                        </li>
                    </ul>
                </li>
            </ul>

        </header>
        <!-- End: Header -->

        <!-- Start: Sidebar -->
        <aside id="sidebar_left" class="nano nano-primary">
            <div class="nano-content">

                <!-- Start: Sidebar Header -->
                <header class="sidebar-header">
                    <div class="user-menu">
                        <div class="row text-center mbn">
                            <div class="col-xs-4">
                                <a href="dashboard.html" class="text-primary" data-toggle="tooltip" data-placement="top" title="Dashboard">
                                    <span class="glyphicons glyphicons-home"></span>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a href="pages_messages.html" class="text-info" data-toggle="tooltip" data-placement="top" title="Messages">
                                    <span class="glyphicons glyphicons-inbox"></span>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a href="pages_profile.html" class="text-alert" data-toggle="tooltip" data-placement="top" title="Tasks">
                                    <span class="glyphicons glyphicons-bell"></span>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a href="pages_timeline.html" class="text-system" data-toggle="tooltip" data-placement="top" title="Activity">
                                    <span class="glyphicons glyphicons-imac"></span>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a href="pages_profile.html" class="text-danger" data-toggle="tooltip" data-placement="top" title="Settings">
                                    <span class="glyphicons glyphicons-settings"></span>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a href="pages_gallery.html" class="text-warning" data-toggle="tooltip" data-placement="top" title="Cron Jobs">
                                    <span class="glyphicons glyphicons-restart"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- End: Sidebar Header -->

                <!-- sidebar menu -->
                <ul class="nav sidebar-menu">
                    <li class="sidebar-label pt20">Menu Anggaran</li>

                    <li <?PHP if($menu == ""){ echo "class='active '"; } ?> >
                        <a href="<?=base_url();?>dashboard/beranda" class="on-menu-hover">
                            <span class="glyphicons glyphicons-home on-menu-hover"></span>
                            <span class="sidebar-title on-menu-hover">Dashboard</span>
                        </a>
                    </li>

                    <li <?PHP if($induk_menu == "setup_data"){  echo "class='active '"; } ?>>
                        <a class="accordion-toggle <?PHP if($induk_menu == "setup_data"){ echo "menu-open"; } ?>" href="#">
                            <span class="glyphicons glyphicons-edit"></span>
                            <span class="sidebar-title">Master Data</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li <?PHP if($menu == "master_bagian"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/master_bagian_c"> Master Bagian </a>
                            </li>

                            <li <?PHP if($menu == "master_sub_bagian"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/master_sub_bagian_c"> Master Sub Bagian </a>
                            </li>

                            <li <?PHP if($menu == "set_grup_kode_perkiraan"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/setup_grup_kode_perkiraan_c"> Master Grup Kode Perkiraan </a>
                            </li>

                            <li <?PHP if($menu == "set_kode_perkiraan"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/setup_kode_perkiraan_c"> Master Kode Perkiraan </a>
                            </li>

                            <li <?PHP if($menu == "set_barang"){ echo "class='active '"; } ?>>
                               <a href="<?=base_url();?>dashboard/master_barang_c"> Master Barang </a>
                            </li>

                            <li <?PHP if($menu == "set_dppb"){ echo "class='active '"; } ?>>
                               <a href="<?=base_url();?>dashboard/master_dpbm_c"> Master DPBM </a>
                            </li>

                            <li <?PHP if($menu == "set_rab"){ echo "class='active '"; } ?>>
                               <a href="<?=base_url();?>dashboard/master_rab_c"> Master RAB </a>
                            </li>

                            <li <?PHP if($menu == "set_spk"){ echo "class='active '"; } ?>>
                               <a href="<?=base_url();?>dashboard/master_spk_c"> Master SPK </a>
                            </li>

                            <li <?PHP if($menu == "setup_ttd_panitia"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/setup_ttd_panitia_c"> Master TTD Panitia Anggaran</a>
                            </li>

                            <li <?PHP if($menu == "master_dana"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/master_sumber_dana_c"> Master Sumber Dana</a>
                            </li>

                            <li <?PHP if($menu == "master_tarif_blok"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/master_tarif_blok_c"> Master Tarif Blok</a>
                            </li>
                        </ul>
                    </li>

                    <li <?PHP if($induk_menu == "pegawai"){  echo "class='active '"; } ?>>
                        <a class="accordion-toggle <?PHP if($induk_menu == "pegawai"){ echo "menu-open"; } ?>" href="#">
                            <span class="glyphicons glyphicons-group"></span>
                            <span class="sidebar-title">Pegawai</span>
                            <span class="caret"></span>
                        </a>

                        <ul class="nav sub-nav">
                            <li <?PHP if($menu == "tambah_pegawai"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/tambah_pegawai_c"> Tambah Pegawai </a>
                            </li>

                            <li <?PHP if($menu == "data_pegawai"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/data_pegawai_c"> Data Pegawai </a>
                            </li>
                        </ul>

                    </li>

                    <li <?PHP if($induk_menu == "rencana_anggaran"){  echo "class='active '"; } ?> >
                        <a class="accordion-toggle <?PHP if($induk_menu == "rencana_anggaran"){ echo "menu-open"; } ?>" href="#">
                            <span class="glyphicons glyphicons-fire"></span>
                            <span class="sidebar-title">Rencana Anggaran</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li <?PHP if($menu == "input_anggaran"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/input_anggaran_c"> Input Anggaran </a>
                            </li>

                            <li <?PHP if($menu == "preview_rkap"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/preview_rkap_c"> Preview Usulan Anggaran </a>
                            </li>

                            <li <?PHP if($menu == "lap_usulan_anggaran"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/lap_usulan_anggaran_c"> Laporan Usulan Anggaran </a>
                            </li>

                            <li <?PHP if($menu == "rapat_usulan_anggaran"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/rapat_usulan_anggaran_c"> Rapat Usulan Anggaran </a>
                            </li>

                            <li <?PHP if($menu == "laporan_rkap"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/laporan_rkap_c"> Laporan RKAP </a>
                            </li>
                        </ul>
                    </li>

                    <li <?PHP if($induk_menu == "realisasi_anggaran"){  echo "class='active '"; } ?>>
                        <a class="accordion-toggle <?PHP if($induk_menu == "realisasi_anggaran"){ echo "menu-open"; } ?>" href="#">
                            <span class="glyphicons glyphicons-snowflake"></span>
                            <span class="sidebar-title">Realisasi Anggaran</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li <?PHP if($menu == "rencana_anggaran"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/rencana_realisasi_anggaran_c"> Rencana Anggaran </a>
                            </li>

                            <li <?PHP if($menu == "realisasi_anggaran"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/realisasi_anggaran_c"> Realisasi Anggaran </a>
                            </li>

                            <li <?PHP if($menu == "lap_realisasi_anggaran_c"){ echo "class='active '"; } ?>>
                                 <a href="<?=base_url();?>dashboard/lap_realisasi_anggaran_c"> Laporan Realisasi RKAP</a>
                            </li>
                        </ul>
                    </li>

                    <li <?PHP if($induk_menu == "revisi_anggaran"){  echo "class='active '"; } ?>>
                        <a class="accordion-toggle <?PHP if($induk_menu == "revisi_anggaran"){ echo "menu-open"; } ?>" href="#">
                            <span class="glyphicons glyphicons-table"></span>
                            <span class="sidebar-title">Revisi Anggaran</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li <?PHP if($menu == "input_rkap"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/input_revisi_rkap_c"> Input Revisi RKAP </a>
                            </li>

                            <li <?PHP if($menu == "preview_revisi"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/preview_revisi_c"> Preview Revisi RKAP</a>
                            </li>

                            <li <?PHP if($menu == "rapat_revisi_anggaran"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/rapat_revisi_rkap_c">  Rapat RKAP</a>
                            </li>

                            <li <?PHP if($menu == "laporan_revisi_rkap"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/laporan_revisi_rkap_c"> Laporan Revisi RKAP</a>
                            </li>
                        </ul>
                    </li>

                    <li <?PHP if($induk_menu == "realisasi_revisi_anggaran"){  echo "class='active '"; } ?>>
                        <a class="accordion-toggle <?PHP if($induk_menu == "realisasi_revisi_anggaran"){ echo "menu-open"; } ?>" href="#">
                            <span class="glyphicons glyphicons-stats"></span>
                            <span class="sidebar-title">Realisasi Revisi Anggaran</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li <?PHP if($menu == "realisasi_revisi_anggaran"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/realisasi_revisi_anggaran_c"> Realisasi Revisi RKAP </a>
                            </li>

                            <li <?PHP if($menu == "laporan_realisasi_revisi_rkap"){ echo "class='active '"; } ?>>
                               <a href="<?=base_url();?>dashboard/laporan_realisasi_revisi_rkap_c"> Laporan Realisasi Revisi RKAP</a>
                            </li>
                        </ul>
                    </li>


                    <li <?PHP if($induk_menu == "input_biaya"){  echo "class='active '"; } ?>>
                        <a class="accordion-toggle <?PHP if($induk_menu == "input_biaya"){ echo "menu-open"; } ?>" href="#">
                            <span class="glyphicons glyphicons-paperclip"></span>
                            <span class="sidebar-title">Input Biaya</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li <?PHP if($menu == "input_biaya"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/kunci_anggaran_c"> Input Anggaran Biaya </a>
                            </li>

                            <li <?PHP if($menu == "biaya_luar"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/biaya_luar_c"> Izin Penggunaan Biaya Diluar Anggaran</a>
                            </li>

                            <li <?PHP if($menu == "cetak_biaya_luar"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/cetak_biaya_luar_c"> Cetak Penggunaan Biaya Diluar Anggaran</a>
                            </li> 
                        </ul>
                    </li>

                    <li <?PHP if($induk_menu == "input_pendapatan"){  echo "class='active '"; } ?>>
                        <a class="accordion-toggle <?PHP if($induk_menu == "input_pendapatan"){ echo "menu-open"; } ?>" href="#">
                            <span class="glyphicons glyphicons-stats"></span>
                            <span class="sidebar-title">Input Pendapatan</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li <?PHP if($menu == "input_pendapatan_air"){ echo "class='active '"; } ?>>
                                <a href="<?=base_url();?>dashboard/input_pendapatan_air_c"> Input Pendaptan Air </a>
                            </li>

                            <li <?PHP if($menu == "input_pendapatan_non_air"){ echo "class='active '"; } ?>>
                               <a href="<?=base_url();?>dashboard/input_pendapatan_non_air_c"> Non Air</a>
                            </li>
                        </ul>
                    </li>

                    <li <?PHP if($induk_menu == "menu_laporan"){  echo "class='active '"; } ?>>
                        <a class="accordion-toggle <?PHP if($induk_menu == "menu_laporan"){ echo "menu-open"; } ?>" href="#">
                            <span class="glyphicon glyphicon-book"></span>
                            <span class="sidebar-title">Laporan</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li <?PHP if($menu == "proyeksi_anggaran"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/proyeksi_anggaran_c">
                                    Proyeksi Anggaran
                                </a>
                            </li>

                            <li <?PHP if($menu == "proyeksi_anggaran"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/proyeksi_anggaran_c">
                                    Rencana Pendapatan Usaha Lainnya
                                </a>
                            </li>

                            <li <?PHP if($menu == "proyeksi_anggaran"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/proyeksi_anggaran_c">
                                    Rencana Pendapatan Di Luar Usaha
                                </a>
                            </li>

                            <li <?PHP if($menu == "rbo"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/rencana_biaya_operasi_c">
                                    Rencana Biaya Operasi
                                </a>
                            </li>

                            <li <?PHP if($menu == "rbua_adm"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/rencana_biaya_umum_adm_c">
                                    Rencana Biaya Umum dan Administrasi
                                </a>
                            </li>

                            <li <?PHP if($menu == "rb_luar_usaha"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/rencana_biaya_diluar_usaha_c">
                                    Rencana Biaya Di Luar Usaha
                                </a>
                            </li>

                            <li <?PHP if($menu == "proyeksi_investasi"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/proyeksi_investasi_c">
                                    Proyeksi Investasi
                                </a>
                            </li>

                            <li <?PHP if($menu == "rencana_beli"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/rencana_pembelian_c">
                                    Rencana Pembelian
                                </a>
                            </li>

                            <li <?PHP if($menu == "rencana_opr_lain"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/rencana_pengeluaran_opr_c">
                                    Rencana Pengeluaran Operasi Lainnya
                                </a>
                            </li>

                            <li <?PHP if($menu == "rencana_non_opr"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/rencana_pengeluaran_non_operasi_c">
                                    Rencana Pengeluaran Non Operasi
                                </a>
                            </li>

                            <li <?PHP if($menu == "rencana_bayar_hutang"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/rencana_pembayaran_hutang_c">
                                    Rencana Pembayaran Hutang
                                </a>
                            </li>

                            <li <?PHP if($menu == "lap_banding"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/lap_banding_c"> Laporan Perbandingan</a>
                            </li>

                            <li <?PHP if($menu == "sambungan_pelanggan"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/sambungan_pelanggan_c"> Rencana Perkembangan Sambungan Pelanggan</a>
                            </li>

                            <li <?PHP if($menu == "produksi_distribusi"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/produksi_distribusi_c"> Rencana Produksi, Distribusi dan Penjualan Air</a>
                            </li>
                        </ul>
                    </li>

                    <li <?PHP if($menu == "kunci"){ echo "class='active'"; } ?> >
                        <a href="<?=base_url();?>dashboard/kunci_anggaran_c">
                            <span class="glyphicons glyphicons-keys"></span>
                            <span class="sidebar-title">Kunci Anggaran</span>
                        </a>
                    </li>

                    <li <?PHP if($menu == "mutasi_kode"){ echo "class='active'"; } ?> >
                        <a href="<?=base_url();?>dashboard/kontrol_anggaran_c">
                            <span class="glyphicons glyphicons-iphone_exchange"></span>
                            <span class="sidebar-title">Mutasi Kode Anggaran</span>
                        </a>
                    </li>

                    <li <?PHP if($menu == "kontrol_anggaran"){ echo "class='active'"; } ?> >
                        <a href="<?=base_url();?>dashboard/kontrol_anggaran_c">
                            <span class="glyphicons glyphicons-random"></span>
                            <span class="sidebar-title">Kontrol Anggaran</span>
                        </a>
                    </li>

                    <li <?PHP if($menu == "histori"){ echo "class='active'"; } ?> >
                        <a href="<?=base_url();?>dashboard/histori_anggaran_c">
                            <span class="glyphicons glyphicons-history"></span>
                            <span class="sidebar-title">History Anggaran</span>
                        </a>
                    </li> 
                    

                    <li <?PHP if($induk_menu == "fitur_tambahan"){  echo "class='active '"; } ?>>
                        <a class="accordion-toggle <?PHP if($induk_menu == "fitur_tambahan"){ echo "menu-open"; } ?>" href="#">
                            <span class="glyphicons glyphicons-star"></span>
                            <span class="sidebar-title">Fitur Pendukung</span>
                            <span class="caret"></span>
                        </a>

                        <ul class="nav sub-nav">

                            <li <?PHP if($menu == "kelompok"){ echo "class='active'"; } ?> >
                                <a href="<?=base_url();?>dashboard/pengelompokan_kode_c"> Pengelompokan Kode Perkiraan</a>
                            </li>             

                        </ul>
                    </li>

                <li <?PHP if($induk_menu == "user_manage"){  echo "class='active '"; } ?>>
                    <a class="accordion-toggle <?PHP if($induk_menu == "user_manage"){ echo "menu-open"; } ?>" href="#">
                        <span class="glyphicons glyphicons-user"></span>
                        <span class="sidebar-title">Management User</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li <?PHP if($menu == "login_user"){ echo "class='active '"; } ?>>
                            <a href="<?=base_url();?>dashboard/user_manage_c"> Login Pengguna </a>
                        </li>

                        <li <?PHP if($menu == "hak_akses"){ echo "class='active '"; } ?>>
                           <a href="<?=base_url();?>dashboard/hak_akses_c"> Hak Akses</a>
                        </li>
                    </ul>
                </li>

                <li <?PHP if($menu == "log_user"){ echo "class='active'"; } ?> >
                        <a href="<?=base_url();?>dashboard/log_aktifitas_c">
                        <span class="glyphicons glyphicons-clock"></span>
                        <span class="sidebar-title">Log Aktifitas</span>
                    </a>
                </li>                

                <li>
                    <a href="<?php echo base_url(); ?>login/sign_out">
                        <span class="glyphicon glyphicon-log-out"></span>
                        <span class="sidebar-title">Keluar</span>
                    </a>
                </li>
                    
                </ul>
                <div class="sidebar-toggle-mini">
                    <a href="#">
                        <span class="fa fa-sign-out"></span>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Start: Content -->
        <section id="content_wrapper">

            <!-- Start: Topbar-Dropdown -->
            <div id="topbar-dropmenu">
                <div class="topbar-menu row">
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="metro-tile bg-success">
                            <span class="metro-icon glyphicons glyphicons-inbox"></span>
                            <p class="metro-title">Messages</p>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="metro-tile bg-info">
                            <span class="metro-icon glyphicons glyphicons-parents"></span>
                            <p class="metro-title">Users</p>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="metro-tile bg-alert">
                            <span class="metro-icon glyphicons glyphicons-headset"></span>
                            <p class="metro-title">Support</p>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="metro-tile bg-primary">
                            <span class="metro-icon glyphicons glyphicons-cogwheels"></span>
                            <p class="metro-title">Settings</p>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="metro-tile bg-warning">
                            <span class="metro-icon glyphicons glyphicons-facetime_video"></span>
                            <p class="metro-title">Videos</p>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="metro-tile bg-system">
                            <span class="metro-icon glyphicons glyphicons-picture"></span>
                            <p class="metro-title">Pictures</p>
                        </a>
                    </div>
                </div>
            </div>
            <!-- End: Topbar-Dropdown -->

            <!-- Start: Topbar -->
            <header id="topbar" style="z-index:100;">
                <div class="topbar-left">
                    <ol class="breadcrumb">
                        <li class="crumb-active">
                            <span style="float: left;">
                                <img src="<?php echo base_url(); ?>images/logo-pdamtp.png" height="40" width="35"/>
                            </span>

                            <span style="float: left; margin-top: 2px; margin-left: 10px; vertical-align:middle;">
                                <font style="font-weight: bold; color: #666; font-size: 18px;"><?=$title;?></font>           
                            </span>                 
                        </li>
                    </ol>
                </div>
            </header>
            <!-- End: Topbar -->

            <!-- Begin: Content -->
            <section id="content" >
                <?PHP if($page == ""){ ?>

                <div class="pv30 ph40 bg-light dark br-b br-grey posr" style="margin-bottom: 20px;">
                    <div class="table-layout">
                        <div class="w200 text-center pr30">
                            <?PHP if($user_detail->FOTO == ""){?>
                                <img width="180" height="180" src="<?=base_url();?>files/user/default.png"alt="avatar"class="responsive">
                            <?PHP } else { ?>
                                <img width="180" height="180" src="<?=base_url();?>files/user/<?=$user_detail->FOTO;?>" alt="avatar"class="responsive">
                            <?PHP } ?>
                        </div>
                        <div class="va-t m30">

                            <h2 class=""> <?=$user_detail->NAMA;?> </h2>
                            <h2 class=""><small> Administrator Sistem </small> </h2>
                            <br>

                            <ul class="list-inline list-unstyled">
                                <li>
                                    <h4 style="color: rgb(233, 87, 63);" class="text-muted fs14">Bagian</h4>
                                    <h4><?=$user_detail->DEPARTEMEN_USER;?></h4>
                                </li> 
                            </ul>
                            <br>
                            <ul class="list-inline list-unstyled">
                                <li>
                                    <h4 style="color: rgb(74, 137, 220);" class="text-muted fs14">Sub Bagian</h4>
                                    <h4>
                                        <?PHP  
                                        if($user_detail->DIVISI_USER != "" || $user_detail->DIVISI_USER != null){
                                            echo $user_detail->DIVISI_USER;    
                                        } else {
                                            echo "-";
                                        } ?>
                                    </h4>
                                </li>                                
                            </ul>


                        </div>
                    </div>
                </div>


                <!-- Admin-panels -->
                <div class="admin-panels sb-l-o-full">

                    <!-- full width widgets -->
                    <div class="row">
                        <div class="col-md-12">

                            <div class="tab-block psor">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab1" data-toggle="tab">Log Aktifitas</a>
                                    </li>

                                    <li>
                                        <a id="link_tab2" href="#tab2" data-toggle="tab">Edit Profil</a>
                                    </li>

                                    <li>
                                        <a id="link_tab3" href="#tab3" data-toggle="tab">Ganti Password</a>
                                    </li>

                                    <li>
                                        <a href="#tab4" data-toggle="tab">Login Terakhir</a>
                                    </li>
                                    <li class="pull-right hidden">
                                        <a href="#tab4" class="ph15" data-toggle="tab">
                                            <span class="fa fa-gear fs14"></span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content" style="height: 835px;">
                                    <div id="tab1" class="tab-pane active p15">                                        
                                        <div class="col-md-12">
                                            <div class="panel panel-visible">
                                                <div class="panel-heading">
                                                    <div class="panel-title hidden-xs">
                                                        <span class="glyphicon glyphicon-tasks"></span>Aktifitas Terakhir Anda</div>
                                                </div>
                                                <div class="panel-body pn">
                                                    <table class="table table-bordered table-hover" id="datatable2" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th style="vertical-align: middle;">#</th>
                                                                <th style="vertical-align: middle;">WAKTU</th>
                                                                <th style="vertical-align: middle; width: 550px;">KEGIATAN</th>
                                                                <th style="vertical-align: middle;">IP ADDRESS</th>
                                                        </thead>
                                                        <tbody>
                                                            <?PHP 
                                                            $nom = 0;
                                                            $dt_log = $this->master_model_m->get_log_user($id_user);
                                                                foreach ($dt_log as $key => $log) {
                                                                $nom++;
                                                            ?>
                                                            <tr style="cursor:pointer;">
                                                                <td><?=$nom;?></td>

                                                                <td>
                                                                    <?PHP echo datetostr($log->TANGGAL); ?> <br>
                                                                    <i><?PHP echo $log->JAM; ?> WIB  </i>
                                                                </td>

                                                                <td>
                                                                    <?=$log->KEGIATAN;?> 
                                                                    <b><?=$log->MODUL;?></b> 
                                                                    <?=$log->KEGIATAN2;?>  
                                                                    <b><?=$log->OBJEK;?></b>
                                                                </td>

                                                                <td><?=$log->IP_ADDR;?></td>
                                                            </tr>
                                                            <?PHP } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- EDIT PROFIL -->
                                    <div id="tab2" class="tab-pane">
                                        <form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>" enctype="multipart/form-data">

                                            <div class="lalalala form-group">
                                                <label class="col-lg-3 control-label">
                                                    
                                                </label>
                                                <div class="col-lg-3">

                                                    <?PHP if($user_detail->FOTO == ""){?>
                                                        <img class="profile-pic_edit" src="<?=base_url();?>files/user/default.png" />
                                                    <?PHP } else {?>
                                                        <img class="profile-pic_edit" src="<?=base_url();?>files/user/<?=$user_detail->FOTO;?>" />
                                                    <?PHP } ?>
                                                    <br>

                                                    <a href="javascript:;" onclick ="javascript:document.getElementById('imagefile').click();" class="btn btn-dark btn-gradient dark upload-prf" style="width: 80%; margin-top: 10px; font-weight:bold;">Ganti Foto</a>
                                                    <input id = "imagefile" type="file" style='display:none;' onchange="encodeImageFileAsURL();" name="userfile[]"/>
                                                    <input type="hidden" id="temp_image" name="temp_image" class="span4" readonly value="">
                                                    <input type="hidden" name="id_peg2" id="id_peg2" value="<?=$user_detail->ID;?>" required />
                                                </div>
                                                
                                            </div>

                                            <div class="form-group">
                                                <label for="nama_pegawai" class="col-lg-3 control-label">Nama Pegawai</label>
                                                <div class="col-lg-5">
                                                    <input type="text" required name="nama_pegawai" id="nama_pegawai" class="form-control" value="<?=$user_detail->NAMA;?>" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label" for="alamat">Alamat</label>
                                                <div class="col-lg-5">
                                                    <textarea class="form-control" id="alamat" name="alamat" rows="2"><?=$user_detail->ALAMAT;?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="kode_pos" class="col-lg-3 control-label">Kode Pos</label>
                                                <div class="col-lg-2">
                                                    <input type="text" required name="kode_pos" id="kode_pos" class="form-control" value="<?=$user_detail->KODE_POS;?>" />
                                                </div>

                                                <label for="telpon" class="col-lg-1 control-label" style="text-align:right;">Telepon</label>
                                                <div class="col-lg-2">
                                                    <input type="text" required name="telpon" id="telpon" class="form-control" value="<?=$user_detail->NO_TELP;?>" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="tmp_lahir" class="col-lg-3 control-label">Tempat Lahir</label>
                                                <div class="col-lg-5">
                                                    <input type="text" required name="tmp_lahir" id="tmp_lahir" class="form-control" value="<?=$user_detail->KOTA_LAHIR;?>" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label" for="datetimepicker2">Tanggal Lahir</label>
                                                <div class="col-lg-3">
                                                    <div class="input-group date" id="datetimepicker2">
                                                        <span class="input-group-addon cursor"><i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" readonly class="form-control"  name="tgl_lahir" id="tgl_lahir" value="<?=$user_detail->TGL_LAHIR;?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Jenis Kelamin</label>
                                                <div class="col-lg-8" style="margin-top: 8px;">
                                                    <div class="radio-custom radio-primary mb5">

                                                        <?PHP if($user_detail->J_KEL == "pria"){ ?>

                                                        <input type="radio" id="jk1" name="jk" checked="" value="pria">
                                                        <label for="jk1" style="margin-right: 15px; padding-left: 25px;">Pria</label>

                                                        <input type="radio" id="jk2" name="jk" value="wanita">
                                                        <label for="jk2" style="margin-right: 15px; padding-left: 25px;">Wanita</label>

                                                        <?PHP } else { ?>

                                                        <input type="radio" id="jk1" name="jk" value="pria">
                                                        <label for="jk1" style="margin-right: 15px; padding-left: 25px;">Pria</label>

                                                        <input type="radio" id="jk2" name="jk" checked="" value="wanita">
                                                        <label for="jk2" style="margin-right: 15px; padding-left: 25px;">Wanita</label>

                                                        <?PHP } ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="divisi" class="col-lg-3 control-label">Agama</label>
                                                <div class="col-lg-8">
                                                    <select id="divisi" name="agama">
                                                        <option value="islam" <?php if($user_detail->AGAMA == 'islam'){ echo "selected"; } ?> >Islam</option>
                                                        <option value="kristen" <?php if($user_detail->AGAMA == 'kristen'){ echo "selected"; } ?>  >Kristen</option>
                                                        <option value="katholik" <?php if($user_detail->AGAMA == 'katholik'){ echo "selected"; } ?> >Katholik</option>
                                                        <option value="hindu" <?php if($user_detail->AGAMA == 'hindu'){ echo "selected"; } ?> >Hindu</option>
                                                        <option value="buddha" <?php if($user_detail->AGAMA == 'buddha'){ echo "selected"; } ?> >Buddha</option>
                                                        <option value="konghucu" <?php if($user_detail->AGAMA == 'konghucu'){ echo "selected"; } ?> >Konghucu</option>
                                                    </select>
                                                </div>
                                            </div>                                            

                                            <div style="border-top: 1px dashed #ccc; margin-bottom: 14px; margin-top: 20px;"></div>
                                            
                                            <center>

                                                <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary btn-gradient dark" style="font-weight:bold;" />
                                                &nbsp;
                                                <input type="reset" value="BATAL" class="btn btn-default btn-gradient dark" style="font-weight:bold;" />
                                            </center>
                                                        
                                         </form> 
                                    </div>
                                    <!-- END OF EDIT PROFIL -->

                                    <!-- GANTI PASSWORD -->
                                    <div id="tab3" class="tab-pane">
                                        <br>

                                        <?PHP if($error_pass == 1){?>
                                        <div class="alert alert-danger alert-dismissable">
                                            <i class="fa fa-warning pr10"></i>
                                            <strong>Maaf, Password anda salah, silahkan masukkan password anda saat ini dengan benar </strong>
                                        </div>
                                        <?PHP } else if($error_pass == 2){ ?>
                                        <div class="alert alert-danger alert-dismissable">
                                            <i class="fa fa-warning pr10"></i>
                                            <strong>Maaf, Password yang anda masukkan tidak sama </strong>
                                        </div>
                                        <?PHP } ?>

                                         <form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>">

                                            <div class="form-group">
                                                <label for="pass_lama" class="col-lg-3 control-label">Password anda saat ini </label>
                                                <div class="col-lg-5">
                                                    <input type="password" required name="pass_lama" id="pass_lama" class="form-control" value="" placeholder="Masukkan password anda saat ini" />
                                                    <input type="hidden"  name="pass_tmp" id="pass_tmp" class="form-control" value="<?=$user_detail->PASSWORD;?>"  />
                                                    <input type="hidden"  name="id_peg_pass" id="id_peg_pass" class="form-control" value="<?=$user_detail->ID;?>"  />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="pass_baru1" class="col-lg-3 control-label">Password Baru</label>
                                                <div class="col-lg-5">
                                                    <input pattern=".{6,}"  type="password" required name="pass_baru1" id="pass_baru1" class="form-control" value="" placeholder="Masukkan password baru anda" />
                                                    <span class="help-block mt5" style="width: 150%;"><i class="fa fa-bell"></i> Password harus minimal 6 karakter </span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="pass_baru2" class="col-lg-3 control-label">Verifkasi Password Baru</label>
                                                <div class="col-lg-5">
                                                    <input type="password" required name="pass_baru2" id="pass_baru2" class="form-control" value="" placeholder="Masukkan kembali password baru anda" />
                                                </div>
                                            </div>

                                            <div style="border-top: 1px dashed #ccc; margin-bottom: 14px; margin-top: 20px;"></div>
                                            
                                            <center>

                                                <input type="submit" name="ganti_password" value="SIMPAN" class="btn btn-primary btn-gradient dark" style="font-weight:bold;" />
                                                &nbsp;
                                                <input type="reset" value="BATAL" class="btn btn-default btn-gradient dark" style="font-weight:bold;" />
                                            </center>

                                         </form>
                                    </div>
                                    <!-- END OF GANTI PASSWORD -->
                                    <div id="tab4" class="tab-pane">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <span class="panel-icon"><i class="glyphicon glyphicon-list-alt"></i>
                                                </span>
                                                <span class="panel-title">Detail Informasi Login Terakhir</span>
                                            </div>
                                            <div class="panel-body">
                                                <p>
                                                    Dibawah ini adalah detail informasi saat terakhir kali anda login
                                                </p>
                                                <br>
                                                <?PHP 
                                                $last_log_all = $this->master_model_m->get_last_login_all($id_user);                                                
                                                ?>
                                                <dl class="dl-horizontal">
                                                    <?PHP 
                                                    if(count($last_log_all) > 0){
                                                        $last_log = $this->master_model_m->get_last_login($id_user);
                                                    ?>

                                                    <dt>Browser Agent</dt>
                                                    <dd><?=$last_log->AGENT;?></dd>

                                                    <dt style="margin-top: 5px;">IP Address</dt>
                                                    <dd style="margin-top: 5px;"><?=$last_log->IP_ADDR;?></dd>

                                                    <dt style="margin-top: 5px;">Nama Komputer</dt>
                                                    <dd style="margin-top: 5px;"><?=$last_log->PC_NAME;?></dd>

                                                    <dt style="margin-top: 5px;">Tanggal</dt>
                                                    <dd style="margin-top: 5px;"><?=datetostr($last_log->TANGGAL);?></dd>                                                    

                                                    <dt style="margin-top: 5px;">Jam</dt>
                                                    <dd style="margin-top: 5px;"> <?=$last_log->JAM;?> WIB</dd>

                                                    <?PHP } else { ?> 
                                                    <dt>Maaf, Tidak Ada Data Untuk Saat Ini</dt>
                                                    <?PHP } ?>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end: .row -->

                    <!-- partial width widgets -->
                    

                </div>

                <?PHP } else { $this->load->view($page); }?>

            </section>
            <!-- End: Content -->

        </section>
        <!-- End: Content-Wrapper -->


    </div>
    <!-- End: Main -->

    <!-- BEGIN: PAGE SCRIPTS -->


    <!-- jQuery -->
    <script type="text/javascript" src="<?=base_url();?>material/vendor/jquery/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/vendor/jquery/jquery_ui/jquery-ui.min.js"></script>

    <script src="<?=base_url();?>material/dialog/js/main.js"></script> <!-- Resource jQuery -->

    <!-- Bootstrap -->
    <script type="text/javascript" src="<?=base_url();?>material/assets/js/bootstrap/bootstrap.min.js"></script>

    <!-- Sparklines CDN -->
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>

    <!-- Holder js  -->
    <script type="text/javascript" src="<?=base_url();?>material/assets/js/bootstrap/holder.min.js"></script>

     <!-- Form Plugins -->
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/globalize/0.1.1/globalize.min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.3/moment.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/vendor/plugins/daterange/daterangepicker.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/vendor/plugins/datepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/vendor/plugins/colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/vendor/plugins/jquerymask/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/vendor/plugins/tagmanager/tagmanager.js"></script>

    <!-- Datatables -->
    <!-- <script type="text/javascript" src="<?=base_url();?>material/vendor/plugins/datatables/media/js/jquery.dataTables.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/vendor/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/vendor/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/vendor/editors/xeditable/js/bootstrap-editable.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.1.0/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.print.min.js"></script>

    <!-- Popup Script -->
    <script type="text/javascript" src="<?=base_url();?>material/vendor/plugins/magnific/jquery.magnific-popup.js"></script>

    <!-- Theme Javascript -->
    <script type="text/javascript" src="<?=base_url();?>material/assets/js/utility/utility.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/assets/js/main.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/assets/js/demo.js"></script>

    <!-- Admin Panels  -->
    <script type="text/javascript" src="<?=base_url();?>material/assets/admin-tools/admin-plugins/admin-panels/json2.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/assets/admin-tools/admin-plugins/admin-panels/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/assets/admin-tools/admin-plugins/admin-panels/adminpanels.js"></script>

    <!-- Page Javascript -->
    <script type="text/javascript" src="<?=base_url();?>material/assets/js/pages/widgets.js"></script>
    <script type="text/javascript">
        var base_url = '<?=base_url()?>';
    </script>
    <script type="text/javascript" src="<?=base_url();?>js-devan/js-form.js"></script>
    <script type="text/javascript" src="<?=base_url();?>js-devan/plugin_barang.js"></script>
    <script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
    <script type="text/javascript" src="<?=base_url();?>jgrowl/jquery.jgrowl.js"></script>

    <script type='text/javascript' src='<?=base_url();?>material/modal/js/jquery.simplemodal.js'></script>
    <script type='text/javascript' src='<?=base_url();?>material/modal/js/basic.js'></script>

    <script type="text/javascript">
        jQuery(document).ready(function() {

        $('#popup_load_adit').fadeOut('slow');

        <?PHP if($page == ""){ ?>

        <?php if($msg_beranda == 1){ ?>
            pesan_sukses();
        <?php } ?>

        <?PHP if($tab == 2){ ?>
            $('#link_tab2').click();
        <?php } ?>

        <?PHP if($tab == 3){ ?>
            $('#link_tab3').click();
        <?php } ?>

        <?PHP } ?>

            "use strict";

            // Init Theme Core      
            Core.init({
                sbm: "sb-l-c",
            });

            // Init Demo JS
            Demo.init();

            // This value can be true, false or a function to be used as a callback when the closer is clciked
            $.jGrowl.defaults.closer = function() {
                console.log("Closing everything!", this);
            };
            // A callback for logging notifications.
            $.jGrowl.defaults.log = function(e,m,o) {
                $('#logs').append("<div><strong>#" + $(e).attr('id') + "</strong> <em>" + (new Date()).getTime() + "</em>: " + m + " (" + o.theme + ")</div>")
            } 
    
            $('#departemen').multiselect();
            $('#divisi').multiselect();
            $('#rapat').multiselect();
            $('.multi-sel').multiselect();

            $('#tahun').multiselect({
                buttonClass: 'multiselect dropdown-toggle btn btn-default btn-primary'
            });

            $('#datetimepicker2').datetimepicker();
            $('#daterangepicker1').daterangepicker();
            $('#daterangepicker2').daterangepicker();
            
            $('#datatable2').dataTable({
                "aoColumnDefs": [{
                    'bSortable': false,
                }],
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": "",
                        "sNext": ""
                    }
                },
                "iDisplayLength": 10,
                "aLengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "SEMUA"]
                ],
                "dom": 'Bfrtip',
                "buttons": [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                ],

            });

            $('#datatable3').dataTable({
                "aoColumnDefs": [{
                    'bSortable': false,
                }],
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": "",
                        "sNext": ""
                    }
                },
                "iDisplayLength": 20,
                "aLengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "SEMUA"]
                ],
                "dom": 'Bfrtip',
                "buttons": [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                ],

            });


            $('#datatable_depan').dataTable({
                "aoColumnDefs": [{
                    'bSortable': false,
                }],
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": "",
                        "sNext": ""
                    }
                },
                "iDisplayLength": 10,
                "aLengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "SEMUA"]
                ],
                "dom": 'Bfrtip',
                "buttons": [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                ],
            });

                     


        });
    </script>

    <script type="text/javascript">
  function encodeImageFileAsURL(cb) {
    return function(){
        var file = this.files[0];
        var reader  = new FileReader();
        reader.onloadend = function () {
            cb(reader.result);
        }
        reader.readAsDataURL(file);
    }
  }

  $('#imagefile').change(encodeImageFileAsURL(function(base64Img){
    $("#temp_image").val(1);
    $('.lalalala')
      .find('img')
        .attr('src', base64Img);
  }));
</script>

    <!-- END: PAGE SCRIPTS -->

</body>

</html>


<?PHP 
function datetostr($str){   
        
    $exp  = explode('-', $str);
    $hari = $exp[0];
    $bln  = $exp[1];
    $thn  = $exp[2];

    if($bln == "01"){
        $bln = "Januari";
    } else if($bln == "02"){
        $bln = "Februari";
    } else if($bln == "03"){
        $bln = "Maret";
    } else if($bln == "04"){
        $bln = "April";
    } else if($bln == "05"){
        $bln = "Mei";
    } else if($bln == "06"){
        $bln = "Juni";
    } else if($bln == "07"){
        $bln = "Juli";
    } else if($bln == "08"){
        $bln = "Agustus";
    } else if($bln == "09"){
        $bln = "September";
    } else if($bln == "10"){
        $bln = "Oktober";
    } else if($bln == "11"){
        $bln = "November";
    } else if($bln == "12"){
        $bln = "Desember";
    } 

    return $hari." ".$bln." ".$thn;
    }
?>