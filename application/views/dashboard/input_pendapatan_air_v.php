<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script>
$(document).ready(function(){
    <?php
        if($this->session->flashdata('sukses')){
    ?>
        pesan_sukses();
    <?php
        }
    ?>
    $('#kp1').click(function(){
        $('#popup_load').css('display','block');
        $('#popup_load').show();
        $('.view_kp1').show();
        $('.view_kp2').hide();
        $('.view_kp3').hide();
        $('.view_kp4').hide();
        setTimeout(function () {
            $('#popup_load').fadeOut('slow');
        }, 1500);
    });

    $('#kp2').click(function(){
        $('#popup_load').css('display','block');
        $('#popup_load').show();
        $('.view_kp1').hide();
        $('.view_kp2').show();
        $('.view_kp3').hide();
        $('.view_kp4').hide();
        setTimeout(function () {
            $('#popup_load').fadeOut('slow');
        }, 1500);
    });

    $('#kp3').click(function(){
        $('#popup_load').css('display','block');
        $('#popup_load').show();
        $('.view_kp1').hide();
        $('.view_kp2').hide();
        $('.view_kp3').show();
        $('.view_kp4').hide();
        setTimeout(function () {
            $('#popup_load').fadeOut('slow');
        }, 1500);
    });

    $('#kp4').click(function(){
        $('#popup_load').css('display','block');
        $('#popup_load').show();
        $('.view_kp1').hide();
        $('.view_kp2').hide();
        $('.view_kp3').hide();
        $('.view_kp4').show();
        setTimeout(function () {
            $('#popup_load').fadeOut('slow');
        }, 1500);
    });

});

function loading(){
    $('#popup_load').css('display','block');
    $('#popup_load').show(); 
}

function tarif_untuk_kp1(){
    $('#show_tarif_blok').show();
    var jenis = $("input[name='jenis_kp1']:checked").val();
    var m3 = $('#m3_kp1').val().split(',').join('');
    if(m3 == ""){
        m3 = 0;
    }
    var ajax = "";
    if(ajax){
        ajax.abort();
    }
    ajax = $.ajax({
        url : '<?php echo base_url(); ?>dashboard/input_pendapatan_air_c/cek_tarif_blok_kp1',
        data : {jenis:jenis},
        type : "GET",
        dataType : "json",
        async : false,
        success : function(row){
            if(m3 > 0 && m3 <= 10){
                var blok1 = row.BLOK_1;
                var blok2 = row.BLOK_2;
                var jumlah_blok1_kp1 = parseFloat(m3);
                var total_blok1_kp1 = parseFloat(jumlah_blok1_kp1) * parseFloat(blok1);
                var jumlah_blok2_kp1 = 0;
                var total_blok2_kp1 = parseFloat(jumlah_blok2_kp1) * parseFloat(blok2);
            }else if(m3 > 10){
                var blok1 = row.BLOK_1;
                var blok2 = row.BLOK_2;
                var jumlah_blok1_kp1 = 10;
                var total_blok1_kp1 = parseFloat(jumlah_blok1_kp1) * parseFloat(blok1);
                var jumlah_blok2_kp1 = parseFloat(m3) - 10;
                var total_blok2_kp1 = parseFloat(jumlah_blok2_kp1) * parseFloat(blok2);
            }
            total_blok1_kp1  = total_blok1_kp1 == undefined? 0:total_blok1_kp1;
            total_blok2_kp1  = total_blok2_kp1 == undefined? 0:total_blok2_kp1;
            var total_tarif = total_blok1_kp1+total_blok2_kp1;
            //blok 1
            $('#jumlah_blok1_kp1').val(jumlah_blok1_kp1);
            $('#tarif_blok1_kp1').val(NumberToMoney(row.BLOK_1));
            $('#total_blok1_kp1').val(NumberToMoney(total_blok1_kp1));
            //blok 2
            $('#jumlah_blok2_kp1').val(jumlah_blok2_kp1);
            $('#tarif_blok2_kp1').val(NumberToMoney(row.BLOK_2));
            $('#total_blok2_kp1').val(NumberToMoney(total_blok2_kp1));
            //total
            $('#total_tarif_kp1').val(NumberToMoney(total_tarif));
        }
    });
}

function tarif_untuk_kp2(){
    $('#show_tarif_blok_kp2').show();
    var jenis = $('#jenis_kp2').val();
    var m3 = $('#m3_kp2').val().split(',').join('');
    if(m3 == ""){
        m3 = 0;
    }
    var ajax = "";
    if(ajax){
        ajax.abort();
    }
    ajax = $.ajax({
        url : '<?php echo base_url(); ?>dashboard/input_pendapatan_air_c/cek_tarif_blok_kp1',
        data : {jenis:jenis},
        type : "GET",
        dataType : "json",
        async : false,
        success : function(row){
            if(m3 > 0 && m3 <= 10){
                var blok1 = row.BLOK_1;
                var blok2 = row.BLOK_2;
                var jumlah_blok1_kp1 = parseFloat(m3);
                var total_blok1_kp1 = parseFloat(jumlah_blok1_kp1) * parseFloat(blok1);
                var jumlah_blok2_kp1 = 0;
                var total_blok2_kp1 = parseFloat(jumlah_blok2_kp1) * parseFloat(blok2);
            }else if(m3 > 10){
                var blok1 = row.BLOK_1;
                var blok2 = row.BLOK_2;
                var jumlah_blok1_kp1 = 10;
                var total_blok1_kp1 = parseFloat(jumlah_blok1_kp1) * parseFloat(blok1);
                var jumlah_blok2_kp1 = parseFloat(m3) - 10;
                var total_blok2_kp1 = parseFloat(jumlah_blok2_kp1) * parseFloat(blok2);
            }
            total_blok1_kp1  = total_blok1_kp1 == undefined? 0:total_blok1_kp1;
            total_blok2_kp1  = total_blok2_kp1 == undefined? 0:total_blok2_kp1;
            var total_tarif = total_blok1_kp1+total_blok2_kp1;
            //blok 1
            $('#jumlah_blok1_kp2').val(jumlah_blok1_kp1);
            $('#tarif_blok1_kp2').val(NumberToMoney(row.BLOK_1));
            $('#total_blok1_kp2').val(NumberToMoney(total_blok1_kp1));
            //blok 2
            $('#jumlah_blok2_kp2').val(jumlah_blok2_kp1);
            $('#tarif_blok2_kp2').val(NumberToMoney(row.BLOK_2));
            $('#total_blok2_kp2').val(NumberToMoney(total_blok2_kp1));
            //total
            $('#total_tarif_kp2').val(NumberToMoney(total_tarif));
        }
    });
}

function tarif_untuk_kp3(){
    $('#show_tarif_blok_kp3').show();
    var jenis = $('#jenis_kp3').val();
    var m3 = $('#m3_kp3').val().split(',').join('');
    if(m3 == ""){
        m3 = 0;
    }
    var ajax = "";
    if(ajax){
        ajax.abort();
    }
    ajax = $.ajax({
        url : '<?php echo base_url(); ?>dashboard/input_pendapatan_air_c/cek_tarif_blok_kp1',
        data : {jenis:jenis},
        type : "GET",
        dataType : "json",
        async : false,
        success : function(row){
            if(m3 > 0 && m3 <= 10){
                var blok1 = row.BLOK_1;
                var blok2 = row.BLOK_2;
                var jumlah_blok1_kp1 = parseFloat(m3);
                var total_blok1_kp1 = parseFloat(jumlah_blok1_kp1) * parseFloat(blok1);
                var jumlah_blok2_kp1 = 0;
                var total_blok2_kp1 = parseFloat(jumlah_blok2_kp1) * parseFloat(blok2);
            }else if(m3 > 10){
                var blok1 = row.BLOK_1;
                var blok2 = row.BLOK_2;
                var jumlah_blok1_kp1 = 10;
                var total_blok1_kp1 = parseFloat(jumlah_blok1_kp1) * parseFloat(blok1);
                var jumlah_blok2_kp1 = parseFloat(m3) - 10;
                var total_blok2_kp1 = parseFloat(jumlah_blok2_kp1) * parseFloat(blok2);
            }
            total_blok1_kp1  = total_blok1_kp1 == undefined? 0:total_blok1_kp1;
            total_blok2_kp1  = total_blok2_kp1 == undefined? 0:total_blok2_kp1;
            var total_tarif = total_blok1_kp1+total_blok2_kp1;
            //blok 1
            $('#jumlah_blok1_kp3').val(jumlah_blok1_kp1);
            $('#tarif_blok1_kp3').val(NumberToMoney(row.BLOK_1));
            $('#total_blok1_kp3').val(NumberToMoney(total_blok1_kp1));
            //blok 2
            $('#jumlah_blok2_kp3').val(jumlah_blok2_kp1);
            $('#tarif_blok2_kp3').val(NumberToMoney(row.BLOK_2));
            $('#total_blok2_kp3').val(NumberToMoney(total_blok2_kp1));
            //total
            $('#total_tarif_kp3').val(NumberToMoney(total_tarif));
        }
    });
}

function tarif_untuk_kp4(){
    $('#show_tarif_blok_kp4').show();
    var jenis = $('#jenis_kp4').val();
    var m3 = $('#m3_kp4').val().split(',').join('');
    if(m3 == ""){
        m3 = 0;
    }
    var ajax = "";
    if(ajax){
        ajax.abort();
    }
    ajax = $.ajax({
        url : '<?php echo base_url(); ?>dashboard/input_pendapatan_air_c/cek_tarif_blok_kp1',
        data : {jenis:jenis},
        type : "GET",
        dataType : "json",
        async : false,
        success : function(row){
            if(m3 > 0 && m3 <= 10){
                var blok1 = row.BLOK_1;
                var blok2 = row.BLOK_2;
                var jumlah_blok1_kp1 = parseFloat(m3);
                var total_blok1_kp1 = parseFloat(jumlah_blok1_kp1) * parseFloat(blok1);
                var jumlah_blok2_kp1 = 0;
                var total_blok2_kp1 = parseFloat(jumlah_blok2_kp1) * parseFloat(blok2);
            }else if(m3 > 10){
                var blok1 = row.BLOK_1;
                var blok2 = row.BLOK_2;
                var jumlah_blok1_kp1 = 10;
                var total_blok1_kp1 = parseFloat(jumlah_blok1_kp1) * parseFloat(blok1);
                var jumlah_blok2_kp1 = parseFloat(m3) - 10;
                var total_blok2_kp1 = parseFloat(jumlah_blok2_kp1) * parseFloat(blok2);
            }
            total_blok1_kp1  = total_blok1_kp1 == undefined? 0:total_blok1_kp1;
            total_blok2_kp1  = total_blok2_kp1 == undefined? 0:total_blok2_kp1;
            var total_tarif = total_blok1_kp1+total_blok2_kp1;
            //blok 1
            $('#jumlah_blok1_kp4').val(jumlah_blok1_kp1);
            $('#tarif_blok1_kp4').val(NumberToMoney(row.BLOK_1));
            $('#total_blok1_kp4').val(NumberToMoney(total_blok1_kp1));
            //blok 2
            $('#jumlah_blok2_kp4').val(jumlah_blok2_kp1);
            $('#tarif_blok2_kp4').val(NumberToMoney(row.BLOK_2));
            $('#total_blok2_kp4').val(NumberToMoney(total_blok2_kp1));
            //total
            $('#total_tarif_kp4').val(NumberToMoney(total_tarif));
        }
    });
}

function tarif_untuk_jasa_admin(){
    m3 = $('#m3_jasa_admin').val().split(',').join('');

}
</script>

<div id="popup_load">
    <div class="window_load">
        <img src="<?=base_url()?>/ico/loading.gif" height="100" width="100">
    </div>
</div>

<div class="col-md-12">
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">
                <span class="glyphicon glyphicon-hand-down"></span></span>
        </div>
        <div class="panel-body">
            <ul class="nav nav-pills mb20">
                <li class="active">
                    <a data-toggle="tab" href="#tab1">Kelompok Pelanggan I</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#tab2">Kelompok Pelanggan II</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#tab3">Kelompok Pelanggan III</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#tab4">Kelompok Pelanggan IV</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#tab5">Jasa Administrasi</a>
                </li>
            </ul>
            <div class="clearfix"></div>
            <div class="tab-content br-n pn">
                <div class="tab-pane active" id="tab1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <span class="panel-title">Kelompok Pelanggan I</span>
                                </div>
                                <form class="form-horizontal" role="form" action="<?php echo $url_kp1; ?>" method="post">
                                    <div class="panel-body">
                                        <div class="form-group admin-form">
                                            <label for="inputPassword" class="col-lg-3 control-label">Tahun</label>
                                            <div class="col-lg-3">
                                                <div class="admin-form">
                                                    <div>
                                                        <div class="smart-widget sm-right smr-50">
                                                            <label class="field select">
                                                                <select id="tahun2" name="tahun_kp1" style="cursor:pointer;">
                                                                    <?php
                                                                        $thn = date('Y');
                                                                        for($i=$thn-1; $i<=$thn+2; $i++) {
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
                                            <label for="inputPassword" class="col-lg-3 control-label">Periode</label>
                                            <div class="col-lg-8" style="margin-top: 8px;">
                                                <?php //echo $kunci."-".$ket; ?>
                                                <div class="radio-custom radio-primary mb5">
                                                    <input type="radio" id="periode1_kp1" name="periode_kp1" value="1" checked="checked">
                                                    <label for="periode1_kp1" style="margin-right: 15px; padding-left: 25px;">RKAP</label>

                                                    <input type="radio" id="periode2_kp1" name="periode_kp1" value="2">
                                                    <label for="periode2_kp1" style="margin-right: 15px; padding-left: 25px;">REVISI RKAP</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword" class="col-lg-3 control-label">Kelompok Pelanggan</label>
                                            <div class="col-lg-8" style="margin-top: 8px;">
                                                <?php //echo $kunci."-".$ket; ?>
                                                <div class="radio-custom radio-primary mb5">
                                                    <input type="radio" id="radioExample4" name="jenis_kp1" value="Sosial Umum" checked="checked">
                                                    <label for="radioExample4" style="margin-right: 15px; padding-left: 25px;">Sosial Umum</label>

                                                    <input type="radio" id="radioExample5" name="jenis_kp1" value="Sosial Khusus">
                                                    <label for="radioExample5" style="margin-right: 15px; padding-left: 25px;">Sosial Khusus</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword" class="col-lg-3 control-label">Uraian</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="" name="uraian_kp1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="m3_kp1" class="col-lg-3 control-label">m<sup>3</sup></label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="" name="m3_kp1" id="m3_kp1" onkeyup="FormatCurrency(this); tarif_untuk_kp1();">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="m3_kp1" class="col-lg-3 control-label">Total Tarif</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="" name="total_tarif_kp1" id="total_tarif_kp1" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <span class="panel-title">
                                                    <span class="glyphicons glyphicons-table"></span>Tarif Blok
                                                </span>
                                            </div>
                                            <div style="max-width:100%; white-space: nowrap; " class="panel-body pn">
                                                <table id="tes3" style="width:100%;" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="vertical-align: middle; text-align:center;">m<sup>3</sup> Blok 1</th>
                                                            <th style="vertical-align: middle; text-align:center;">Tarif Blok 1</th>
                                                            <th style="vertical-align: middle; text-align:center;">Total Blok 1</th>
                                                            <th style="vertical-align: middle; text-align:center;">m<sup>3</sup> Blok 2</th>
                                                            <th style="vertical-align: middle; text-align:center;">Tarif Blok 2</th>
                                                            <th style="vertical-align: middle; text-align:center;">Total Blok 2</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="jumlah_blok1_kp1" id="jumlah_blok1_kp1" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="tarif_blok1_kp1" id="tarif_blok1_kp1" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="total_blok1_kp1" id="total_blok1_kp1" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="jumlah_blok2_kp1" id="jumlah_blok2_kp1" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="tarif_blok2_kp1" id="tarif_blok2_kp1" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="total_blok2_kp1" id="total_blok2_kp1" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <hr>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Januari</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="januari_kp1" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Februari</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="februari_kp1" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Maret</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="maret_kp1" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">April</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="april_kp1" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Mei</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="mei_kp1" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Juni</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="juni_kp1" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Juli</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="juli_kp1" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Agustus</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="agustus_kp1" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">September</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="september_kp1" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Oktober</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="oktober_kp1" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">November</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="november_kp1" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Desember</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="desember_kp1" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer admin-form">
                                       <center>
                                            <input type="submit" name="simpan_kp1" id="simpan_kp1" class="btn btn-primary" value="Simpan" onclick="loading();">
                                            <input type="reset" name="batal_kp1" id="batal_kp1" class="btn btn-danger" value="Batal">
                                       </center> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="tab2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <span class="panel-title">Kelompok Pelanggan II</span>
                                </div>
                                <form class="form-horizontal" role="form" action="<?php echo $url_kp2; ?>" method="post">
                                    <div class="panel-body">
                                        <div class="form-group admin-form">
                                            <label for="inputPassword" class="col-lg-3 control-label">Tahun</label>
                                            <div class="col-lg-3">
                                                <div class="admin-form">
                                                    <div>
                                                        <div class="smart-widget sm-right smr-50">
                                                            <label class="field select">
                                                                <select id="tahun2" name="tahun_kp2" style="cursor:pointer;">
                                                                    <?php
                                                                        $thn = date('Y');
                                                                        for($i=$thn-1; $i<=$thn+2; $i++) {
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
                                            <label for="inputPassword" class="col-lg-3 control-label">Periode</label>
                                            <div class="col-lg-8" style="margin-top: 8px;">
                                                <?php //echo $kunci."-".$ket; ?>
                                                <div class="radio-custom radio-primary mb5">
                                                    <input type="radio" id="radioExample6" name="periode_kp2" value="1" checked="checked">
                                                    <label for="radioExample6" style="margin-right: 15px; padding-left: 25px;">RKAP</label>

                                                    <input type="radio" id="radioExample7" name="periode_kp2" value="2">
                                                    <label for="radioExample7" style="margin-right: 15px; padding-left: 25px;">REVISI RKAP</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group admin-form">
                                            <label class="col-lg-3 control-label">Kelompok Pelanggan</label>
                                            <div class="col-lg-3">
                                                <div class="admin-form">
                                                    <div>
                                                        <div class="smart-widget sm-right smr-51">
                                                            <label class="field select">
                                                                <select id="jenis_kp2" name="jenis_kp2" style="cursor:pointer; white-space:nowrap;">
                                                                    <option value="Rumah Tangga 1 (R1)">Rumah Tangga 1 (R1)</option>   
                                                                    <option value="Rumah Tangga 2 (R2)">Rumah Tangga 2 (R2)</option>   
                                                                    <option value="Rumah Tangga 3 (R3)">Rumah Tangga 3 (R3)</option>   
                                                                    <option value="Rumah Tangga 4 (R4)">Rumah Tangga 4 (R4)</option>
                                                                    <option value="Instalasi / Kantor Pemerintah">Instalasi / Kantor Pemerintah</option>
                                                                    <option value="Sekolah Negeri / Universitas Negeri">Sekolah Negeri / Universitas Negeri</option>
                                                                    <option value="RS Pemerintah / Poliklinik / Puskesmas">RS Pemerintah / Poliklinik / Puskesmas</option>
                                                                    <option value="Kedutaan / Konsulat">Kedutaan / Konsulat</option>
                                                                </select>
                                                                <i style="z-index:99;" class="arrow"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Uraian</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="" name="uraian_kp2">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="m3_kp2" class="col-lg-3 control-label">m<sup>3</sup></label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="" name="m3_kp2" id="m3_kp2" onkeyup="FormatCurrency(this); tarif_untuk_kp2();">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="m3_kp1" class="col-lg-3 control-label">Total Tarif</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="" name="total_tarif_kp2" id="total_tarif_kp2" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <span class="panel-title">
                                                    <span class="glyphicons glyphicons-table"></span>Tarif Blok
                                                </span>
                                            </div>
                                            <div style="max-width:100%; white-space: nowrap; " class="panel-body pn">
                                                <table id="tes3" style="width:100%;" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="vertical-align: middle; text-align:center;">m<sup>3</sup> Blok 1</th>
                                                            <th style="vertical-align: middle; text-align:center;">Tarif Blok 1</th>
                                                            <th style="vertical-align: middle; text-align:center;">Total Blok 1</th>
                                                            <th style="vertical-align: middle; text-align:center;">m<sup>3</sup> Blok 2</th>
                                                            <th style="vertical-align: middle; text-align:center;">Tarif Blok 2</th>
                                                            <th style="vertical-align: middle; text-align:center;">Total Blok 2</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="jumlah_blok1_kp2" id="jumlah_blok1_kp2" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="tarif_blok1_kp2" id="tarif_blok1_kp2" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="total_blok1_kp2" id="total_blok1_kp2" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="jumlah_blok2_kp2" id="jumlah_blok2_kp2" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="tarif_blok2_kp2" id="tarif_blok2_kp2" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="total_blok2_kp2" id="total_blok2_kp2" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <hr>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Januari</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="januari_kp2" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Februari</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="februari_kp2" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Maret</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="maret_kp2" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">April</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="april_kp2" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Mei</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="mei_kp2" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Juni</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="juni_kp2" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Juli</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="juli_kp2" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Agustus</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="agustus_kp2" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">September</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="september_kp2" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Oktober</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="oktober_kp2" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">November</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="november_kp2" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Desember</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="desember_kp2" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer admin-form">
                                       <center>
                                            <input type="submit" name="simpan_kp2" id="simpan_kp2" class="btn btn-primary" value="Simpan" onclick="loading();">
                                            <input type="reset" name="batal_kp2" id="batal_kp2" class="btn btn-danger" value="Batal">
                                       </center> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="tab3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <span class="panel-title">Kelompok Pelanggan III</span>
                                </div>
                                <form class="form-horizontal" role="form" action="<?php echo $url_kp3; ?>" method="post">
                                    <div class="panel-body">
                                        <div class="form-group admin-form">
                                            <label for="inputPassword" class="col-lg-3 control-label">Tahun</label>
                                            <div class="col-lg-3">
                                                <div class="admin-form">
                                                    <div>
                                                        <div class="smart-widget sm-right smr-50">
                                                            <label class="field select">
                                                                <select id="tahun2" name="tahun_kp3" style="cursor:pointer;">
                                                                    <?php
                                                                        $thn = date('Y');
                                                                        for($i=$thn-1; $i<=$thn+2; $i++) {
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
                                            <label for="inputPassword" class="col-lg-3 control-label">Periode</label>
                                            <div class="col-lg-8" style="margin-top: 8px;">
                                                <?php //echo $kunci."-".$ket; ?>
                                                <div class="radio-custom radio-primary mb5">
                                                    <input type="radio" id="radioExample8" name="periode_kp3" value="1" checked="checked">
                                                    <label for="radioExample8" style="margin-right: 15px; padding-left: 25px;">RKAP</label>

                                                    <input type="radio" id="radioExample9" name="periode_kp3" value="2">
                                                    <label for="radioExample9" style="margin-right: 15px; padding-left: 25px;">REVISI RKAP</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group admin-form">
                                            <label class="col-lg-3 control-label">Kelompok Pelanggan</label>
                                            <div class="col-lg-3">
                                                <div class="admin-form">
                                                    <div>
                                                        <div class="smart-widget sm-right smr-51">
                                                            <label class="field select">
                                                                <select id="jenis_kp3" name="jenis_kp3" style="cursor:pointer; white-space:nowrap;">
                                                                    <option value="Niaga Kecil / RS Ananda">Niaga Kecil / RS Ananda</option>   
                                                                    <option value="Niaga Menengah / VIP">Niaga Menengah / VIP</option>   
                                                                    <option value="Niaga Besar">Niaga Besar</option>   
                                                                    <option value="Industri Kecil">Industri Kecil</option>
                                                                    <option value="Industri Sedang">Industri Sedang</option>
                                                                    <option value="Industri Besar">Industri Besar</option>
                                                                </select>
                                                                <i style="z-index:99;" class="arrow"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Uraian</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="" name="uraian_kp3">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="m3_kp3" class="col-lg-3 control-label">m<sup>3</sup></label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="" name="m3_kp3" id="m3_kp3" onkeyup="FormatCurrency(this); tarif_untuk_kp3();">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="m3_kp1" class="col-lg-3 control-label">Total Tarif</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="" name="total_tarif_kp3" id="total_tarif_kp3" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <span class="panel-title">
                                                    <span class="glyphicons glyphicons-table"></span>Tarif Blok
                                                </span>
                                            </div>
                                            <div style="max-width:100%; white-space: nowrap; " class="panel-body pn">
                                                <table id="tes3" style="width:100%;" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="vertical-align: middle; text-align:center;">m<sup>3</sup> Blok 1</th>
                                                            <th style="vertical-align: middle; text-align:center;">Tarif Blok 1</th>
                                                            <th style="vertical-align: middle; text-align:center;">Total Blok 1</th>
                                                            <th style="vertical-align: middle; text-align:center;">m<sup>3</sup> Blok 2</th>
                                                            <th style="vertical-align: middle; text-align:center;">Tarif Blok 2</th>
                                                            <th style="vertical-align: middle; text-align:center;">Total Blok 2</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="jumlah_blok1_kp3" id="jumlah_blok1_kp3" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="tarif_blok1_kp3" id="tarif_blok1_kp3" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="total_blok1_kp3" id="total_blok1_kp3" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="jumlah_blok2_kp3" id="jumlah_blok2_kp3" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="tarif_blok2_kp3" id="tarif_blok2_kp3" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="total_blok2_kp3" id="total_blok2_kp3" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <hr>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Januari</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="januari_kp3" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Februari</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="februari_kp3" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Maret</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="maret_kp3" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">April</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="april_kp3" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Mei</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="mei_kp3" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Juni</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="juni_kp3" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Juli</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="juli_kp3" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Agustus</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="agustus_kp3" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">September</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="september_kp3" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Oktober</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="oktober_kp3" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">November</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="november_kp3" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Desember</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="desember_kp3" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer admin-form">
                                       <center>
                                            <input type="submit" name="simpan_kp3" id="simpan_kp3" class="btn btn-primary" value="Simpan" onclick="loading();">
                                            <input type="reset" name="batal_k3" id="batal_k3" class="btn btn-danger" value="Batal">
                                       </center> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="tab4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <span class="panel-title">Kelompok Pelanggan IV</span>
                                </div>
                                <form class="form-horizontal" role="form" action="<?php echo $url_kp4; ?>" method="post">
                                    <div class="panel-body">
                                        <div class="form-group admin-form">
                                            <label for="inputPassword" class="col-lg-3 control-label">Tahun</label>
                                            <div class="col-lg-3">
                                                <div class="admin-form">
                                                    <div>
                                                        <div class="smart-widget sm-right smr-50">
                                                            <label class="field select">
                                                                <select id="tahun2" name="tahun_kp4" style="cursor:pointer;">
                                                                    <?php
                                                                        $thn = date('Y');
                                                                        for($i=$thn-1; $i<=$thn+2; $i++) {
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
                                            <label for="inputPassword" class="col-lg-3 control-label">Periode</label>
                                            <div class="col-lg-8" style="margin-top: 8px;">
                                                <?php //echo $kunci."-".$ket; ?>
                                                <div class="radio-custom radio-primary mb5">
                                                    <input type="radio" id="radioExample10" name="periode_kp4" value="1" checked="checked">
                                                    <label for="radioExample10" style="margin-right: 15px; padding-left: 25px;">RKAP</label>

                                                    <input type="radio" id="radioExample11" name="periode_kp4" value="2">
                                                    <label for="radioExample11" style="margin-right: 15px; padding-left: 25px;">REVISI RKAP</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group admin-form">
                                            <label class="col-lg-3 control-label">Kelompok Pelanggan</label>
                                            <div class="col-lg-3">
                                                <div class="admin-form">
                                                    <div>
                                                        <div class="smart-widget sm-right smr-51">
                                                            <label class="field select">
                                                                <select id="jenis_kp4" name="jenis_kp4" style="cursor:pointer; white-space:nowrap;">
                                                                    <option value="Curah PDAM Bekasi">Curah PDAM Bekasi</option>   
                                                                    <option value="Mobil Tangki / Angkutan Lainnya">Mobil Tangki / Angkutan Lainnya</option>   
                                                                    <option value="Curah PT SUMMARECON">Curah PT SUMMARECON</option>   
                                                                    <option value="PT General Motors">PT General Motors</option>
                                                                </select>
                                                                <i style="z-index:99;" class="arrow"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Uraian</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="" name="uraian_kp4">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="m3_kp4" class="col-lg-3 control-label">m<sup>3</sup></label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="" name="m3_kp4" id="m3_kp4" onkeyup="FormatCurrency(this); tarif_untuk_kp4();">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="m3_kp1" class="col-lg-3 control-label">Total Tarif</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="" name="total_tarif_kp4" id="total_tarif_kp4" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <span class="panel-title">
                                                    <span class="glyphicons glyphicons-table"></span>Tarif Blok
                                                </span>
                                            </div>
                                            <div style="max-width:100%; white-space: nowrap; " class="panel-body pn">
                                                <table id="tes3" style="width:100%;" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="vertical-align: middle; text-align:center;">m<sup>3</sup> Blok 1</th>
                                                            <th style="vertical-align: middle; text-align:center;">Tarif Blok 1</th>
                                                            <th style="vertical-align: middle; text-align:center;">Total Blok 1</th>
                                                            <th style="vertical-align: middle; text-align:center;">m<sup>3</sup> Blok 2</th>
                                                            <th style="vertical-align: middle; text-align:center;">Tarif Blok 2</th>
                                                            <th style="vertical-align: middle; text-align:center;">Total Blok 2</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="jumlah_blok1_kp4" id="jumlah_blok1_kp4" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="tarif_blok1_kp4" id="tarif_blok1_kp4" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="total_blok1_kp4" id="total_blok1_kp4" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="jumlah_blok2_kp4" id="jumlah_blok2_kp4" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="tarif_blok2_kp4" id="tarif_blok2_kp4" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="total_blok2_kp4" id="total_blok2_kp4" value="" style="width:125px;" readonly="readonly">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <hr>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Januari</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="januari_kp4" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Februari</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="februari_kp4" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Maret</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="maret_kp4" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">April</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="april_kp4" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Mei</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="mei_kp4" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Juni</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="juni_kp4" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Juli</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="juli_kp4" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Agustus</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="agustus_kp4" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">September</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="september_kp4" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Oktober</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="oktober_kp4" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">November</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="november_kp4" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Desember</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="desember_kp4" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer admin-form">
                                       <center>
                                            <input type="submit" name="simpan_kp4" id="simpan_kp4" class="btn btn-primary" value="Simpan" onclick="loading();">
                                            <input type="reset" name="batal_k4" id="batal_k4" class="btn btn-danger" value="Batal">
                                       </center> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="tab5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <span class="panel-title">Jasa Administrasi</span>
                                </div>
                                <form class="form-horizontal" role="form" action="<?php echo $url_jasa_admin; ?>" method="post">
                                    <div class="panel-body">
                                        <div class="form-group admin-form">
                                            <label for="inputPassword" class="col-lg-3 control-label">Tahun</label>
                                            <div class="col-lg-3">
                                                <div class="admin-form">
                                                    <div>
                                                        <div class="smart-widget sm-right smr-50">
                                                            <label class="field select">
                                                                <select id="tahun2" name="tahun_jasa_admin" style="cursor:pointer;">
                                                                    <?php
                                                                        $thn = date('Y');
                                                                        for($i=$thn-1; $i<=$thn+2; $i++) {
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
                                            <label for="inputPassword" class="col-lg-3 control-label">Periode</label>
                                            <div class="col-lg-8" style="margin-top: 8px;">
                                                <?php //echo $kunci."-".$ket; ?>
                                                <div class="radio-custom radio-primary mb5">
                                                    <input type="radio" id="radioExample10" name="periode_jasa_admin" value="1" checked="checked">
                                                    <label for="radioExample10" style="margin-right: 15px; padding-left: 25px;">RKAP</label>

                                                    <input type="radio" id="radioExample11" name="periode_jasa_admin" value="2">
                                                    <label for="radioExample11" style="margin-right: 15px; padding-left: 25px;">REVISI RKAP</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Uraian</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="" name="uraian_jasa_admin">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="m3_jasa_admin" class="col-lg-3 control-label">m<sup>3</sup></label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" value="" name="m3_jasa_admin" id="m3_jasa_admin" onkeyup="FormatCurrency(this);">
                                            </div>
                                        </div>

                                        <hr>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Januari</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="januari_jasa_admin" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Februari</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="februari_jasa_admin" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Maret</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="maret_jasa_admin" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">April</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="april_jasa_admin" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Mei</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="mei_jasa_admin" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Juni</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="juni_jasa_admin" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Juli</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="juli_jasa_admin" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Agustus</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="agustus_jasa_admin" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">September</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="september_jasa_admin" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Oktober</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="oktober_jasa_admin" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">November</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="november_jasa_admin" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledInput" class="col-lg-3 control-label">Desember</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" value="" name="desember_jasa_admin" onkeyup="FormatCurrency(this);">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer admin-form">
                                       <center>
                                            <input type="submit" name="simpan_jasa_admin" id="simpan_jasa_admin" class="btn btn-primary" value="Simpan" onclick="loading();">
                                            <input type="reset" name="batal_jasa_admin" id="batal_jasa_admin" class="btn btn-danger" value="Batal">
                                       </center> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>