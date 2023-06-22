<script type="text/javascript" src="<?=base_url();?>material/vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script type="text/javascript">

    $(document).ready(function(){

        <?php
            if($msg == 1){
        ?>
            pesan_sukses();
        <?php
            }
        ?>

    $('#btn_peg').click(function(){
        get_popup_barang();
        ajax_barang();
    });

    });

    function pesan_sukses(){
        var pesan = '<div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div>'+
                    '<h4 class="ui-pnotify-title">Berhasil</h4>'+
                    '<div class="ui-pnotify-text"><strong>Data berhasil disimpan!</strong></div>';

        $.jGrowl(pesan, { header: '', life:3000 });
    }


    function cek_all(id) {

        if($('#cek_all_'+id).is(':checked')){
            $('.cek_menu_'+id).prop('checked',true);
        }else{
            $('.cek_menu_'+id).prop('checked',false);   
        }
    }

    function cek_all_chkbox(){
      if($('#head_chkbox').is(':checked')){
            $('.chkbox').prop('checked',true);
      }else{
            $('.chkbox').prop('checked',false);   
      }  
    }

    function get_popup_barang(){
        var base_url = '<?php echo base_url(); ?>';
        var $isi = '<div id="popup_koang">'+
                    '<div class="window_koang">'+
                    '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                    '    <div class="panel-body">'+
                    '    <input type="text" name="search_koang" id="search_koang" class="form-control" value="" placeholder="Cari Barang...">'+
                    '    <div class="table-responsive">'+
                    '            <table class="table table-hover" id="tes5">'+
                    '                <thead>'+
                    '                    <tr>'+
                    '                        <th>NO</th>'+
                    '                        <th style="white-space:nowrap; text-align:center;">NIP</th>'+
                    '                        <th>NAMA PEGAWAI</th>'+
                    '                    </tr>'+
                    '                </thead>'+
                    '                <tbody>'+
                
                    '                </tbody>'+
                    '            </table>'+
                    '        </div>'+
                    '    </div>'+
                    '</div>'+
                '</div>';
        $('body').append($isi);

        $('#pojok_koang').click(function(){
            $('#popup_koang').css('display','none');
            $('#popup_koang').hide();
        });

        $('#popup_koang').css('display','block');
        $('#popup_koang').show();
    }

    function ajax_barang(){
        var keyword = $('#search_koang').val();
        $.ajax({
            url : '<?php echo base_url(); ?>dashboard/user_manage_c/get_pegawai',
            type : "POST",
            dataType : "json",
            data : {
                keyword : keyword,
            },
            success : function(result){
                var isine = '';
                var no = 0;
                $.each(result,function(i,res){
                    no++;
                    isine += '<tr>'+
                                '<td align="center">'+no+'</td>'+
                                '<td align="center"><a href="javascript:void(0);" onclick=get_kode_barang('+res.ID+');>'+res.NIP+'</a></td>'+
                                '<td>'+res.NAMA+'</td>'+
                            '</tr>';
                });
                $('#tes5 tbody').html(isine); 
                $('#search_koang').off('keyup').keyup(function(){
                    ajax_barang();
                });
            }
        });
    }

    function get_kode_barang(id){
        $.ajax({
            url : '<?php echo base_url(); ?>dashboard/user_manage_c/get_pegawai_by_id',
            data : {id:id},
            type : "POST",
            dataType : "json",
            async : false,
            success : function(res){
                $('#nama_pegawai_cari').val(res.NAMA);
                $('#id_peg').val(res.ID);
            }
        });

        $('#search_koang').val("");
        $('#popup_koang').css('display','none');
        $('#popup_koang').hide();
    }


</script>
<style type="text/css">
.profile-pic{
    width:100%;
    max-width:185px;
    height:auto;
    background: none repeat scroll 0 0 #fff;
    border: 1px solid #ddd;
    padding: 5px;
}
</style>
<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body">

    	<form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>">

            <div class="form-group data_baru">
                <label for="bagian" class="col-lg-3 control-label">Cari Pegawai</label>
                <div class="col-lg-5">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50" id='basic-modal'>
                                <label class="field">
                                    <?PHP if($id_peg != ""){ ?>
                                    <input type="text" name="nama_pegawai_cari" id="nama_pegawai_cari" class="gui-input" value="<?=$pegawai_filter->NAMA;?>" required />
                                    <?PHP } else { ?> 
                                    <input type="text" name="nama_pegawai_cari" id="nama_pegawai_cari" class="gui-input" value="" required />
                                    <?PHP } ?>
                                    <input type="hidden" name="id_peg" id="id_peg" value="<?=$id_peg;?>" required />
                                </label>
                                <a id="btn_peg" class="button">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="submit" name="filter" value="CARI PEGAWAI" class="btn btn-default btn-gradient dark" style="font-weight: bold; height: 42px; margin-left: 10px;" />
            </div>

        </form>

        <form method="post" action="<?=base_url().$post_url;?>">

        <div style="border-top: 1px dashed #ccc; margin-bottom: 14px; margin-top: 20px;"></div>
        <input type="hidden" name="id_peg2" value="<?=$id_peg;?>"/> 
        

        <?PHP if($id_peg != ""){ ?>
        <div class="row">
        <center>
            <div style="float:left; margin-bottom: 20px; margin-left: 10px;">
            <?PHP if($pegawai_filter->FOTO == ""){?>
                <img class="profile-pic" src="<?=base_url();?>files/user/default.png" />
            <?PHP } else {?>
                <img class="profile-pic" src="<?=base_url();?>files/user/<?=$pegawai_filter->FOTO;?>" />
            <?PHP } ?>
            </div>

            <div style="float:left; margin-left: 10px;">
               <b style="font-size: 18px;"><?=$pegawai_filter->NAMA;?></b> <br>
               <font style="float:left;"> NIP : <?=$pegawai_filter->NIP;?> </font> <br><br>

               <b style="float:left;">Bagian : </b> <br>
               <font style="float:left;"> <?=$pegawai_filter->DEPARTEMEN_NAMA;?> </font>

               <br><br>

               <b style="float:left;">Sub Bagian : </b> <br>
               <font style="float:left;"> <?=$pegawai_filter->DIVISI_NAMA;?> </font>
            </div>
        </center>
        </div>

        <div style="border-top: 1px dashed #ccc; margin-bottom: -15px; margin-top: -5px;"></div>
        <?PHP } ?>

        <div class="row">

        </div>

        <div class="row" style="margin-bottom: 15px; margin-top: 15px; margin-left: 0;">
            <div class="checkbox-custom fill checkbox-success mb5">
                <input onclick="cek_all_chkbox();" type="checkbox" id="head_chkbox" value="">
                <label for="head_chkbox"> Beri Akses Ke Semua Menu </label>
            </div>
        </div>

        <?PHP if($id_peg == ""){ ?>
        <!-- NO PEGAWAI -->
    	<div class="row">
            <div class="col-md-12">
                <div class="tab-block mb25">
                    <ul class="nav nav-tabs nav-tabs-center">
                        <?PHP 
                        $i = 0;
                        $ket = "active";
                        foreach ($menu_lev1 as $key => $menu1) { 
                        $i++;
                        if($i > 1){
                            $ket = "";
                        }
                        ?>
                        <li class="<?=$ket;?>">
                            <a href="#tab_<?=$menu1->ID;?>" data-toggle="tab"><?=$menu1->NAMA;?></a>
                        </li>
                        <?PHP } ?>
                    </ul>
                    
                    <div class="tab-content">

                        <?PHP 
                        $i = 0;
                        $ket2 = "active";
                        foreach ($menu_lev1 as $key => $menu1) { 
                        $i++;
                        if($i > 1){
                            $ket2 = "";
                        }
                        ?>
                        <div id="tab_<?=$menu1->ID;?>" class="tab-pane <?=$ket2;?>">
                            <?PHP if($menu1->KET_MENU1 == "" || $menu1->KET_MENU1 == null){?>
                            <div class="checkbox-custom fill checkbox-primary mb5">
                                <input type="checkbox" id="cek2_<?=$menu1->ID;?>" name="menu2[]" value="<?=$menu1->ID;?>" class="chkbox">
                                <label for="cek2_<?=$menu1->ID;?>"> Menu <?=$menu1->NAMA;?> </label>
                            </div>
                            <?PHP } else { ?> 
                            <div class="checkbox-custom fill checkbox-primary mb5">
                                <input type="checkbox" id="cek_all_<?=$menu1->ID;?>" onclick="cek_all('<?=$menu1->ID;?>');" class="chkbox">
                                <label for="cek_all_<?=$menu1->ID;?>"> Semua Menu <?=$menu1->NAMA;?> </label>
                            </div>
                            <?PHP } ?>

                            <br>
                            
                                <?PHP 
                                $get_menu_lev2 = $this->model->get_menu_lev2($menu1->ID);
                                foreach ($get_menu_lev2 as $key => $menu2) { ?>

                                <div class="checkbox-custom checkbox-primary mb5" style="margin-left: 30px;">
                                    <input type="checkbox" name="menu[]" id="cek_<?=$menu2->ID;?>" value="<?=$menu2->ID;?>" class="cek_menu_<?=$menu1->ID;?> chkbox">
                                    <label for="cek_<?=$menu2->ID;?>"><?=$menu2->MENU;?></label>
                                </div>

                                <?PHP } ?>
                        </div>
                        <?PHP } ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- END OF NO PEGAWAI -->
        <?PHP } else { ?>
        <!-- PAKE PEGAWAI -->
        <div class="row">
            <div class="col-md-12">
                <div class="tab-block mb25">
                    <ul class="nav nav-tabs nav-tabs-center">
                        <?PHP 
                        $i = 0;
                        $ket = "active";
                        foreach ($menu_lev1 as $key => $menu1) { 
                        $i++;
                        if($i > 1){
                            $ket = "";
                        }
                        ?>
                        <li class="<?=$ket;?>">
                            <a href="#tab_<?=$menu1->ID;?>" data-toggle="tab"><?=$menu1->NAMA;?></a>
                        </li>
                        <?PHP } ?>
                    </ul>
                    
                    <div class="tab-content">

                        <?PHP 
                        $i = 0;
                        $ket2 = "active";
                        $menu_lev1_peg = $this->model->get_menu_lev1_with_peg($id_peg);
                        $cek = "";
                        foreach ($menu_lev1_peg as $key => $menu1) { 
                        $i++;
                        if($i > 1){
                            $ket2 = "";
                        }

                        if($menu1->STS != "" || $menu1->STS != null ){
                            $cek = "checked";
                        } else {
                            $cek = "";
                        }
                        ?>

                        <div id="tab_<?=$menu1->ID;?>" class="tab-pane <?=$ket2;?>">
                            <?PHP if($menu1->KET_MENU1 == "" || $menu1->KET_MENU1 == null){?>
                            <div class="checkbox-custom fill checkbox-primary mb5">
                                <input <?=$cek;?> type="checkbox" id="cek2_<?=$menu1->ID;?>" name="menu2[]" value="<?=$menu1->ID;?>" class="chkbox">
                                <label for="cek2_<?=$menu1->ID;?>"> Menu <?=$menu1->NAMA;?> </label>
                            </div>
                            <?PHP } else { ?> 
                            <div class="checkbox-custom fill checkbox-primary mb5">
                                <input type="checkbox" id="cek_all_<?=$menu1->ID;?>" onclick="cek_all('<?=$menu1->ID;?>');" class="chkbox">
                                <label for="cek_all_<?=$menu1->ID;?>"> Semua Menu <?=$menu1->NAMA;?> </label>
                            </div>
                            <?PHP } ?>

                            <br>
                            
                                <?PHP 
                                $cek2 = "";
                                $get_menu_lev2_peg = $this->model->get_menu_lev2_peg($menu1->ID, $id_peg);
                                foreach ($get_menu_lev2_peg as $key => $menu2) { 
                                if($menu2->STS != "" || $menu2->STS != null ){
                                    $cek2 = "checked";
                                } else {
                                    $cek2 = "";
                                }
                                ?>

                                <div class="checkbox-custom checkbox-primary mb5" style="margin-left: 30px;">
                                    <input <?=$cek2;?> type="checkbox" name="menu[]" id="cek_<?=$menu2->ID;?>" value="<?=$menu2->ID;?>" class="cek_menu_<?=$menu1->ID;?> chkbox">
                                    <label for="cek_<?=$menu2->ID;?>"><?=$menu2->MENU;?></label>
                                </div>

                                <?PHP } ?>
                        </div>
                        <?PHP } ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- END OF PAKE PEGAWAI -->
        <?PHP } ?>
    </div>

    <?PHP if($id_peg != ""){ ?>
    <div class="panel-footer">
        <center>
            <input type="submit" name="simpan" class="btn btn-primary btn-gradient dark" style="font-weight:bold;" value="Simpan Hak Akses">
            &nbsp;&nbsp;&nbsp;
            <button onclick="window.location = '<?=base_url();?>dashboard/hak_akses_c'; " class="btn btn-default btn-gradient dark" >
                Batal
            </button> 
        </center>
    </div>
    <?PHP } ?>
    </form>
</div>


<!-- modal content -->
<div id="basic-modal-content">
    <table class="table table-bordered table-hover" id="datatable_popup" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th style="vertical-align: middle;">NIP</th>
                <th style="vertical-align: middle;">NAMA PEGAWAI</th>
        </thead>

        <tbody>
            <?PHP 
                foreach ($pegawai as $key => $row) {
            ?>
            <tr style="cursor:pointer;" onclick="$('.simplemodal-close').click(); $('#nama_pegawai_cari').val('<?=$row->NAMA;?>'); $('#id_peg').val('<?=$row->ID;?>');">
                <td><?=$row->NIP;?></td>
                <td><?=$row->NAMA;?></td>
            </tr>
            <?PHP } ?>
        </tbody>
    </table>
</div>

<!-- preload the images -->
<div style='display:none'>
    <img src='<?=base_url();?>material/modal/img/basic/x.png' alt='' />
</div>