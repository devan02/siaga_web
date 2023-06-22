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
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>material/custom/css/buttons.dataTables.min.css">

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

    .profile_pic_depan{
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
    $user_detail = "";
    

    if($id_user == "" || $id_user == null){
        redirect('login');
    }  else {
        $user_detail = $this->master_model_m->get_user_detail($id_user);
    }



    $link_siaga = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $link_siaga = str_replace(base_url(), '', $link_siaga);

    if($page != ""){ 

        $cek_akses1 = $this->master_model_m->get_menu_akses_peg1($id_user, $link_siaga);
        $cek_akses2 = $this->master_model_m->get_menu_akses_peg2($id_user, $link_siaga);

        if( count($cek_akses1) == 0  && count($cek_akses2) == 0 && stripos($link_siaga, 'edit_pegawai') === FALSE){
            redirect(base_url()."dashboard/beranda");
        }
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

                <a class="navbar-brand" href="<?php echo base_url(); ?>dashboard/beranda"> <b>SIAGA</b> App
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
                <!-- <li class="dropdown dropdown-item-slide">
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
                </li> -->

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

                    <?PHP 
                    $get_menu1 = $this->master_model_m->get_menu_lev1($id_user);
                    foreach ($get_menu1 as $key => $menu1) {
                        if($menu1->KET_MENU1 != "" || $menu1->KET_MENU1 != null ){ 

                        $cek_menu_akses = $this->master_model_m->cek_menu_akses($menu1->ID, $id_user);
                        if(count($cek_menu_akses) > 0){
                    ?>

                    <li <?PHP if($induk_menu == $menu1->KET_MENU1){  echo "class='active '"; } ?>>
                        <a class="accordion-toggle <?PHP if($induk_menu == $menu1->KET_MENU1){ echo "menu-open"; } ?>" href="#">
                            <span class="<?=$menu1->ICON;?>"></span>
                            <span class="sidebar-title"><?=$menu1->NAMA;?></span>
                            <span class="caret"></span>
                        </a>

                        <ul class="nav sub-nav">
                            <?PHP 
                            $get_menu2 = $this->master_model_m->get_menu_lev2($menu1->ID, $id_user);
                            foreach ($get_menu2 as $key => $menu2) { 
                            if($menu2->STS != "" || $menu2->STS != null ){
                            ?>

                                <li <?PHP if($menu == $menu2->KET_MENU){ echo "class='active '"; } ?>>
                                    <a href="<?=base_url().$menu2->LINK;?>"> <?=$menu2->MENU;?> </a>
                                </li>                       
                            
                            <?PHP } }  ?>
                        </ul>

                    </li>

                    <?PHP
                       } 
                    } else { 
                            if($menu1->STS != "" || $menu1->STS != null ){
                    ?>
                    <li <?PHP if($menu == $menu1->KET_MENU2){ echo "class='active'"; } ?> >
                        <a href="<?=base_url().$menu1->LINK;?>">
                            <span class="<?=$menu1->ICON;?>"></span>
                            <span class="sidebar-title"><?=$menu1->NAMA;?></span>
                        </a>
                    </li>
                    <?PHP
                         }
                        }
                    }
                    ?>
                                    

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
                                <img src="<?=base_url();?>files/user/default.png" alt="avatar" class="profile_pic_depan">
                            <?PHP } else { ?>
                                <img src="<?=base_url();?>files/user/<?=$user_detail->FOTO;?>" alt="avatar" class="profile_pic_depan">
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
                                <div class="tab-content" style="height: 855px;">
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
                                                    <select id="tahun" name="agama">
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
                                            <br><br>
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
    <script type="text/javascript" src="<?=base_url();?>material/custom/js/jquery.sparkline.min.js"></script>

    <!-- Holder js  -->
    <script type="text/javascript" src="<?=base_url();?>material/assets/js/bootstrap/holder.min.js"></script>

     <!-- Form Plugins -->
    <script type="text/javascript" src="<?=base_url();?>material/custom/js/globalize.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/custom/js/moment.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/vendor/plugins/daterange/daterangepicker.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/vendor/plugins/datepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/vendor/plugins/colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/vendor/plugins/jquerymask/jquery.maskedinput.min.js"></script> 
    <script type="text/javascript" src="<?=base_url();?>material/vendor/plugins/tagmanager/tagmanager.js"></script> 

    <!-- Datatables -->
    <!-- <script type="text/javascript" src="<?=base_url();?>material/vendor/plugins/datatables/media/js/jquery.dataTables.min.js"></script> -->
    <script type="text/javascript" src="<?=base_url();?>material/custom/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/vendor/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/vendor/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/vendor/editors/xeditable/js/bootstrap-editable.js"></script>

    <script type="text/javascript" src="<?=base_url();?>material/custom/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/custom/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/custom/js/jszip.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/custom/js/pdfmake.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/custom/js/vfs_fonts.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/custom/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>material/custom/js/buttons.print.min.js"></script>

    <!-- Popup Script -->
    <script type="text/javascript" src="<?=base_url();?>material/vendor/plugins/magnific/jquery.magnific-popup.js"></script>
    <script type="text/javascript" src="<?=base_url();?>assets/admin-tools/admin-forms/js/jquery-ui-timepicker.min.js"></script>

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
                "iDisplayLength": 20,
                "aLengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "SEMUA"]
                ],
                "aaSorting": [],
                "dom": 'Bfrtip',
                "buttons": [
                    'copyHtml5',
                ],

            });

            $('#datatable_old_adit').dataTable({
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
                "aaSorting": [],
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
                     
            /* @date picker
            ------------------------------------------------------------------ */
            $("#datepicker1").datepicker({
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                showButtonPanel: false
            });

            $("#datepicker2").datepicker({
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                showButtonPanel: false
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