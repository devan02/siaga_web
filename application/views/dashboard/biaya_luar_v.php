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

    get_no_surat();
    data_divisi();

    $('#view_rab').hide();

    $("input[name='no_realisasi']").click(function(){
        var no_realisasi = $("input[name='no_realisasi']:checked").val();
        if(no_realisasi == "dpbm"){
            $('#view_rab').hide();
            $('#view_dpbm').show();

            $('#id_rab').val("");
            $('#no_rab').val("");
        } else if(no_realisasi == "lain"){
            $('#view_rab').hide();
            $('#view_dpbm').hide();

            $('#id_dpbm').val("");
            $('#no_dpbm').val("");
        } else {
            $('#view_rab').show();
            $('#view_dpbm').hide();

            $('#id_dpbm').val("");
            $('#no_dpbm').val("");
        }
    });

    $('#kode_dpbm').click(function(){
        $('#popup_dpbm').css('display','block');
        $('#popup_dpbm').show();
    });

    $('#kode_rab').click(function(){
        $('#popup_rab').css('display','block');
        $('#popup_rab').show();
    });

    $('#pojok_dpbm').click(function(){
        $('#popup_dpbm').css('display','none');
        $('#popup_dpbm').hide();
    });

    $('#pojok_rab').click(function(){
        $('#popup_rab').css('display','none');
        $('#popup_rab').hide();
    });

    $('#batal').click(function(){
        var no_realisasi = $("input[name='no_realisasi']:checked").val();
        if(no_realisasi == "dpbm"){
            $('#id_dpbm').val("");
            $('#no_dpbm').val("");
        }else{
            $('#id_rab').val("");
            $('#no_rab').val("");
        }
        $('#program_biaya').val("");
        $('#alasan').val("");
    });

});

function get_no_surat(){
    $.ajax({
        url : "<?php echo base_url(); ?>dashboard/biaya_luar_c/cek_no_surat",
        type : "GET",
        dataType : "json",
        async : false,
        success : function(no_surat){
            $('#no_surat').val(no_surat);
        }
    });
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

function get_dpbm_id(id_dpbm){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/biaya_luar_c/get_dpbm_id',
        data : {id_dpbm:id_dpbm},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#id_dpbm').val(row['ID']);
            $('#no_dpbm').val(row['NO_DPBM']);

            $('#popup_dpbm').css('display','none');
            $('#popup_dpbm').hide();
        }
    });
}

function get_rab_id(id_rab){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/realisasi_anggaran_c/get_rab_by_id',
        data : {id_rab:id_rab},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#id_rab').val(row['ID_DET_RAB']);
            $('#no_rab').val(row['NO_RAB']);

            $('#popup_rab').css('display','none');
            $('#popup_rab').hide();
        }
    });
}
</script>
<style>
#view_rab{
    display: none;
}
</style>
<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <form class="form-horizontal" role="form" action="<?php echo $url; ?>" method="post">
        <div class="panel-body">

            <div class="form-group">
                <label class="col-lg-3 control-label" for="datetimepicker2">Tanggal</label>
                <div class="col-lg-4">
                    <div class="input-group date" id="datetimepicker2">
                        <span class="input-group-addon cursor"><i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo date("d-m-Y"); ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword" class="col-lg-3 control-label">No Surat</label>
                <div class="col-lg-4">
                    <input type="text" name="no_surat" id="no_surat" class="form-control" value="" readonly />
                </div>
            </div>

            <div class="form-group admin-form">
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

            <div class="form-group admin-form">
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
                <label for="no_realisasi" class="col-lg-3 control-label">&nbsp;</label>
                <div class="col-lg-4">
                    <div class="radio-custom radio-primary mb5" style="margin-top: 10px;">
                        <input type="radio" id="radioExample1" name="no_realisasi" checked="" value="dpbm">
                        <label for="radioExample1" style="margin-right: 15px; padding-left: 25px;">DPBM</label>

                        <input type="radio" id="radioExample2" name="no_realisasi" value="rab">
                        <label for="radioExample2" style="margin-right: 15px; padding-left: 25px;">RAB</label>

                        <input type="radio" id="radioExample22" name="no_realisasi" value="lain">
                        <label for="radioExample22" style="margin-right: 15px; padding-left: 25px;">Lain - Lain</label>
                    </div>
                </div>
            </div>

            <div class="form-group" id="view_dpbm">
                <label for="no_dpbm" class="col-lg-3 control-label">No DPBM</label>
                <div class="col-lg-4">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field">
                                    <input type="hidden" name="id_dpbm" id="id_dpbm" value="">
                                    <input type="text" name="no_dpbm" id="no_dpbm" class="gui-input" value="">
                                </label>
                                <a class="button" id="kode_dpbm">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group" id="view_rab">
                <label for="no_rab" class="col-lg-3 control-label">No RAB</label>
                <div class="col-lg-4">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field">
                                    <input type="hidden" name="id_rab" id="id_rab" value="">
                                    <input type="text" name="no_rab" id="no_rab" class="gui-input" value="">
                                </label>
                                <a class="button" id="kode_rab">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="program_biaya" class="col-lg-3 control-label">Program / Biaya</label>
                <div class="col-lg-4">
                    <input type="text" name="program_biaya" id="program_biaya" class="form-control" value="" />
                </div>
            </div>

            <div class="form-group">
                <label for="alasan" class="col-lg-3 control-label">Alasan Permintaan</label>
                <div class="col-lg-4">
                    <input type="text" name="alasan" id="alasan" class="form-control" value="" />
                </div>
            </div>

        </div>

        <div class="panel-footer">
            <center>
                <input type="submit" name="simpan" id="simpan" class="btn btn-primary" value="SIMPAN" style="font-weight:bold;">
                &nbsp;&nbsp;&nbsp;
                <input type="button" name="batal" id="batal" class="btn btn-danger" value="BATAL" style="font-weight:bold;">
            </center>
        </div>

    </form>
</div>

<!-- DPBM -->
<div id="popup_dpbm">
   <div class="window_dpbm">
       <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>ico/cancel.gif" id="pojok_dpbm"></a>
       <div class="panel-body">
       <input type="text" name="search_dpbm" id="search_dpbm" class="form-control" value="" placeholder="Cari DPBM...">
       <br/>
       <div class="table-responsive">
               <table class="table table-hover table-bordered">
                   <thead>
                       <tr class="primary">
                           <th style="white-space:nowrap; text-align:center;">NO DPBM</th>
                           <th style="white-space:nowrap; text-align:center;">KODE BARANG</th>
                           <th style="white-space:nowrap; text-align:center;">NAMA BARANG</th>
                           <th style="white-space:nowrap; text-align:center;">VOLUME</th>
                           <th style="white-space:nowrap; text-align:center;">SATUAN</th>
                           <th style="white-space:nowrap; text-align:center;">HARGA</th>
                       </tr>
                   </thead>
                   <tbody>
                    <?php
                        foreach ($dpbm as $value_dpbm) {
                    ?>
                        <tr style="cursor:pointer;" onclick="get_dpbm_id('<?php echo $value_dpbm->ID; ?>');">
                            <td align="center"><?php echo $value_dpbm->NO_DPBM; ?></td>
                            <td align="center"><?php echo $value_dpbm->KODE_BARANG; ?></td>
                            <td><?php echo $value_dpbm->NAMA_BARANG; ?></td>
                            <td align="center"><?php echo $value_dpbm->VOLUME; ?></td>
                            <td align="center"><?php echo $value_dpbm->SATUAN; ?></td>
                            <td><?php echo number_format($value_dpbm->HARGA,2,',','.'); ?></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- RAB -->
<div id="popup_rab">
   <div class="window_rab">
       <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>ico/cancel.gif" id="pojok_rab"></a>
       <div class="panel-body">
            <input type="text" name="search_dpbm" id="search_dpbm" class="form-control" value="" placeholder="Cari RAB...">
            <br/>
            <div class="table-responsive">
               <table class="table table-hover table-bordered">
                   <thead>
                       <tr class="primary">
                           <th style="white-space:nowrap; text-align:center;">NO RAB</th>
                           <th style="white-space:nowrap; text-align:center;">JENIS</th>
                           <th style="white-space:nowrap; text-align:center;">URAIAN</th>
                           <th style="white-space:nowrap; text-align:center;">VOLUME</th>
                           <th style="white-space:nowrap; text-align:center;">SATUAN</th>
                           <th style="white-space:nowrap; text-align:center;">HARGA</th>
                       </tr>
                   </thead>
                   <tbody>
                    <?php
                        foreach ($rab as $value_rab) {
                    ?>
                        <tr style="cursor:pointer;" onclick="get_rab_id('<?php echo $value_rab->ID_DET_RAB; ?>');">
                            <td align="center"><?php echo $value_rab->NO_RAB; ?></td>
                            <td align="center"><?php echo $value_rab->JENIS; ?></td>
                            <td><?php echo $value_rab->KEGIATAN; ?></td>
                            <td align="center"><?php echo $value_rab->VOLUME; ?></td>
                            <td align="center"><?php echo $value_rab->SATUAN; ?></td>
                            <td><?php echo number_format($value_rab->HARGA_SATUAN,2,',','.'); ?></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>