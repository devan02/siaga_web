<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script> 
$(document).ready(function(){
    data_divisi();

    <?php
        if($msg == 1){
    ?>
        pesan_sukses();
    <?php
        }
    ?>

    <?php
        if($msg == 3){
    ?>
        pesan_hapus();
    <?php
        }
    ?>

    <?php
        if($this->session->flashdata('status')){
    ?>
        pesan_sukses();
    <?php
        }else if($this->session->flashdata('hapus')){
    ?>
        pesan_hapus();
    <?php
        }
    ?>

    var kriteria = $("input[name='kriteria']:checked").val();
    if(kriteria == "departemen"){
        $('#show_dep').show();
        $('#show_div').hide();
    }else{
        $('#show_dep').show();
        $('#show_div').show();
    }

    var setting_kunci = $("input[name='setting_kunci']:checked").val();
    if(setting_kunci == "all_dep"){
        $('#show_dep').hide();
        $('#show_div').hide();
        $('#show_kriteria').hide();
    }else{
        $('#show_dep').show();
        $('#show_div').hide();
        $('#show_kriteria').show();
    }

    $('#semua_menu').click(function(){
        if($('#semua_menu').is(':checked')){
            $('.menu_kunci').prop('checked',true);
            input_anggaran_chk();
            input_revisi_rkap_chk();
            laporan_rkap_chk();
            laporan_revisi_rkap_chk();
        }else{
            $('.menu_kunci').prop('checked',false);  
            input_anggaran_chk();
            input_revisi_rkap_chk();
            laporan_rkap_chk();
            laporan_revisi_rkap_chk(); 
        }
    });

    $('#cek_all').click(function(){
        var tombol = $(this).is(':checked');
        if(tombol){
            $('.cek').prop('checked',true);
        }else{
            $('.cek').prop('checked',false);
        }
    });

});


function input_anggaran_chk(){

    var tombol = $('#input_anggaran').is(':checked');
    if(tombol){
        $('#input_anggaran_txt').val("input_anggaran_c");
    }else{
        $('#input_anggaran_txt').val("");
    }

}

function input_revisi_rkap_chk(){

    var tombol = $('#input_revisi_rkap').is(':checked');
    if(tombol){
        $('#input_revisi_rkap_txt').val("input_revisi_rkap_c");
    }else{
        $('#input_revisi_rkap_txt').val("");
    }

}

function laporan_rkap_chk(){

    var tombol = $('#laporan_rkap').is(':checked');
    if(tombol){
        $('#laporan_rkap_txt').val("laporan_rkap_c");
    }else{
        $('#laporan_rkap_txt').val("");
    }

}

function laporan_revisi_rkap_chk(){

    var tombol = $('#laporan_revisi_rkap').is(':checked');
    if(tombol){
        $('#laporan_revisi_rkap_txt').val("laporan_revisi_rkap_c");
    }else{
        $('#laporan_revisi_rkap_txt').val("");
    }

}




function data_divisi(){
    var id_departemen = $('#departemen2').val();
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/departemen_divisi_c/divisi',
        data : {id_departemen:id_departemen},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(divisi){
            $div = "";
            for(var i=0; i<divisi.length; i++){
                $div += "<option value='"+divisi[i].ID+"'>"+divisi[i].NAMA+"</option>";
            }
            $('#divisi2').html($div);
        }
    });
}

function pilih_kriteria(){
    var kriteria = $("input[name='kriteria']:checked").val();
    if(kriteria == "departemen"){
        $('#show_dep').show();
        $('#show_div').hide();
    }else{
        $('#show_dep').show();
        $('#show_div').show();
    }  
}

function pilih_setting_kunci(){
    var setting_kunci = $("input[name='setting_kunci']:checked").val();
    if(setting_kunci == "all_dep"){
        $('#show_dep').hide();
        $('#show_div').hide();
        $('#show_kriteria').hide();
    }else{
        $('#show_dep').show();
        $('#show_div').hide();
        $('#show_kriteria').show();
    }
}
</script>
<div class="panel">
    <form class="form-horizontal" role="form" action="<?php echo $url; ?>" method="post">
        <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
            <span class="panel-title"></span>
        </div>
        <div class="panel-body">
            <div class="form-group admin-form">
                <label for="inputPassword" class="col-lg-3 control-label">Tahun</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="tahun2" name="tahun" style="cursor:pointer;" onchange="get_kode_anggaran();">
                                        <?php
                                            $thn = date('Y');
                                            for($i=$thn-5; $i<=$thn+2; $i++) {
                                                if ($i==$thn){
                                                    echo"<option selected='selected' value=".$i."> ".$i." </option>";
                                                }else{
                                                    echo"<option value=".$i."> ".$i." </option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                    <i style="z-index:99;" class="arrow"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="disabledInput" class="col-lg-3 control-label">Setting Kunci</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample1" name="setting_kunci" value="all_dep" onclick="pilih_setting_kunci();">
                        <label for="radioExample1" style="margin-right: 15px; padding-left: 25px;">Semua Bagian</label>

                        <input type="radio" id="radioExample2" name="setting_kunci" checked="checked" value="per_dep" onclick="pilih_setting_kunci();">
                        <label for="radioExample2" style="margin-right: 15px; padding-left: 25px;">Per Bagian</label>
                    </div>
                </div>
            </div>

            <div class="form-group" id="show_kriteria">
                <label for="disabledInput" class="col-lg-3 control-label">Kriteria</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample3" name="kriteria" checked="checked" value="departemen" onclick="pilih_kriteria();">
                        <label for="radioExample3" style="margin-right: 15px; padding-left: 25px;">Bagian</label>

                        <input type="radio" id="radioExample4" name="kriteria" value="divisi" onclick="pilih_kriteria();">
                        <label for="radioExample4" style="margin-right: 15px; padding-left: 25px;">Sub Bagian</label>

                    </div>
                </div>
            </div>

            <div class="form-group admin-form" id="show_dep">
                <label for="inputPassword" class="col-lg-3 control-label">Bagian</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="departemen2" name="departemen" style="cursor:pointer;" onchange="data_divisi();">
                                        <?php
                                            if($departemen != ""){
                                                foreach ($departemen as $value_dep) {
                                        ?>
                                        <option value="<?php echo $value_dep->ID; ?>"><?php echo $value_dep->NAMA; ?></option>    
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                    <i style="z-index:99;" class="arrow"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group admin-form" id="show_div">
                <label for="inputPassword" class="col-lg-3 control-label">Sub Bagian</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="divisi2" name="divisi" style="cursor:pointer;">
                   
                                    </select>
                                    <i style="z-index:99;" class="arrow"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="daterangepicker1">Batas Buka</label>
                <div class="col-md-4">
                    <input style="cursor:pointer;" type="text" readonly class="form-control pull-right" name="daterange" id="daterangepicker1">
                    <span class="help-block mt5"><i class="fa fa-bell"></i> Klik field diatas untuk mengatur jarak tanggal</span> 
                    <?php
                        // $set_tgl = "12-11-2015 sampai 13-11-2015";
                        // $tgl_awal = substr($set_tgl, 0,10);
                        // echo $tgl_awal;
                        // $tgl_akhir = substr($set_tgl, 18);
                        // echo $tgl_akhir;
                    ?>
                </div>
            </div>                   
            
            <hr>

            <div class="form-group">
                <label for="disabledInput" class="col-lg-12 control-label">
                	<center>
                	<div class="checkbox-custom checkbox-primary mb5">
                        <input type="checkbox" id="semua_menu" value="semua">
                        <label for="semua_menu">Semua Menu</label>
                    </div>
                    </center>
                </label>
            </div>

            <div class="form-group">
                <label for="disabledInput" class="col-lg-12 control-label">
                	<center>
                	<div class="checkbox-custom checkbox-primary mb5">
                        <input type="checkbox" name="menu_kunci1" id="input_anggaran" onclick="input_anggaran_chk();" value="input_anggaran_c" class="menu_kunci">
                        <label for="input_anggaran">Input Anggaran</label>

                        <input type="checkbox" name="menu_kunci2" id="input_revisi_rkap" onclick="input_revisi_rkap_chk();" value="input_revisi_rkap_c" class="menu_kunci">
                        <label for="input_revisi_rkap">Input Revisi RKAP</label>

                        <input type="checkbox" name="menu_kunci3" id="laporan_rkap" onclick="laporan_rkap_chk();" value="laporan_rkap_c" class="menu_kunci">
                        <label for="laporan_rkap">Laporan RKAP</label>

                        <input type="checkbox" name="menu_kunci4" id="laporan_revisi_rkap" onclick="laporan_revisi_rkap_chk();" value="laporan_revisi_rkap_c" class="menu_kunci">
                        <label for="laporan_revisi_rkap">Laporan Revisi RKAP</label>
                    </div>
                    </center>
                </label>
            </div>

            <input type="hidden" name="menu_kunci[]" id="input_anggaran_txt" value="">
            <input type="hidden" name="menu_kunci[]" id="input_revisi_rkap_txt" value="">
            <input type="hidden" name="menu_kunci[]" id="laporan_rkap_txt" value="">
            <input type="hidden" name="menu_kunci[]" id="laporan_revisi_rkap_txt" value="">

        </div>

        <div class="panel-footer">
            <center>
                <input type="submit" name="buka" class="btn btn-primary btn-gradient dark" style="font-weight:bold;" value="Buka">

            </center>
        </div>

    </form>
</div>

<form method="post" action="<?=base_url().$post_url;?>">
<div class="panel-footer" style="background: #FFF;">

        <div class="col-md-12">
            <div class="panel panel-visible">
                <div class="panel-heading">
                    <div class="panel-title hidden-xs">
                        <span class="glyphicon glyphicon-tasks"></span>Lihat Menu Terbuka</div>
                </div>
                <div class="panel-body pn">
                    <table class="table table-bordered" style="width:100%;" id="tes3">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle; text-align:center;">
                                    <input type="checkbox" name="cek_all" id="cek_all">
                                </th>
                                <th style="vertical-align: middle;">Bagian</th>
                                <th style="vertical-align: middle;">Sub Bagian</th>
                                <th style="vertical-align: middle;">Nama Menu</th>
                                <th style="vertical-align: middle;">Batas Waktu</th>
                                <th style="vertical-align: middle; text-align: center;">Aksi</th>
                        </thead>
                        <tbody>
                            <?PHP 
                                if(count($dt) > 0){
                                    foreach ($dt as $key => $row) {
                                    $nama_menu = $row->NAMA_MENU_KUNCI;
                                    if($nama_menu == "input_anggaran_c"){
                                        $nama_menu = "Input Anggaran";
                                    } else if($nama_menu == "input_revisi_rkap_c"){
                                        $nama_menu = "Input Revisi RKAP";
                                    } else if($nama_menu == "laporan_rkap_c"){
                                        $nama_menu = "Laporan RKAP";
                                    } else if($nama_menu == "laporan_revisi_rkap_c"){
                                        $nama_menu = "Laporan Revisi RKAP";
                                    }
                            ?>
                            <tr style="cursor:pointer;">
                                <td style="vertical-align: middle; text-align:center;">
                                    <input type="checkbox" name="cek[]" class="cek" value="<?=$row->ID;?>">
                                </td>
                                <td><?=$row->NAMA_DEP;?></td>
                                <td><?=$row->NAMA_DIV;?></td>
                                <td><?=$nama_menu;?></td>
                                <td><?=$row->TGL_AWAL." Sampai ".$row->TGL_AKHIR;?></td>

                                <td>
                                    <center> 
                                        <button onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID;?>');" style="height: 30px; width: 100px;"class="btn btn-sm btn-danger btn-block" type="button"><i class="fa fa-remove"></i> Tutup Menu </button> 
                                    </center>
                                </td>
                            </tr>
                                <?PHP } 
                            } else { echo "<tr><td colpan='6'>Tidak ada menu yang terbuka</td></tr>"; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <center>
            <input type="submit" value="Tutup Menu" name="hapus_multiple" class="btn btn-danger btn-gradient dark" style="font-weight:bold;" />
        </center>
    </div>
</form>

<div style='display:none'>
    <img src='<?=base_url();?>material/modal/img/basic/x.png' alt='' />
</div>

<a id="dialog-btn" href="javascript:;" class="cd-popup-trigger" style="display:none;">View Pop-up</a>

<div class="cd-popup" role="alert">
    <div class="cd-popup-container">

        <form id="delete" method="post" action="<?=base_url().$post_url;?>">
            <input type="hidden" name="id_hapus" id="id_hapus" value="" />
        </form>   
         
        <p>Apakah anda yakin untuk menutup menu ini?</p>
        <ul class="cd-buttons">            
            <li><a href="javascript:;" onclick="$('#delete').submit();">Ya</a></li>
            <li><a onclick="$('.cd-popup-close').click(); $('#id_hapus').val('');" href="javascript:;">Tidak</a></li>
        </ul>
        <a href="#0" onclick="$('#id_hapus').val('');" class="cd-popup-close img-replace">Close</a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->