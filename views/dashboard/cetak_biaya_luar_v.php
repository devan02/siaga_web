<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script>
var ajax = "";
$(document).ready(function(){
    $('#view_rab').hide();
    $("input[name='no_realisasi']").click(function(){
        var no_realisasi = $("input[name='no_realisasi']:checked").val();
        if(no_realisasi == "dpbm"){
            $('#view_rab').hide();
            $('#view_dpbm').show();

            $('#id_rab').val("");
            $('#no_rab').val("");
        }else{
            $('#view_rab').show();
            $('#view_dpbm').hide();

            $('#id_dpbm').val("");
            $('#no_dpbm').val("");
        }
    });

    $('#kode_surat').click(function(){
        $('#popup_no_surat').css('display','block');
        $('#popup_no_surat').show();
    });

    $('#pojok_surat').click(function(){
        $('#popup_no_surat').css('display','none');
        $('#popup_no_surat').hide();
    });

    $('#search_surat').off('keyup').keyup(function(){
        cari_surat();
    });

});

function get_surat_id(id_surat){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/cetak_biaya_luar_c/get_surat_id',
        data : {id_surat:id_surat},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#id_surat').val(row['ID']);
            $('#no_surat').val(row['NO_SURAT']);
            get_bagian_id(row['BAGIAN']);
            get_sub_bagian_id(row['SUB_BAGIAN']);

            if(row['ID_DPBM'] != 0){
                $('#radioExample1').prop('checked',true);
                $('#view_rab').hide();
                $('#view_dpbm').show();
                $('#no_dpbm').val(row['NO_BUKTI']);
            } else if(row['ID_RAB'] != 0){
                $('#radioExample2').prop('checked',true);
                $('#view_rab').show();
                $('#view_dpbm').hide();
                $('#no_rab').val(row['NO_BUKTI']);
            } else {
                $('#radioExample22').prop('checked',true);
                $('#view_rab').hide();
                $('#view_dpbm').hide();
                $('#no_rab').val('-');
            }

            $('#program_biaya').val(row['PROGRAM_BIAYA']);
            $('#alasan').val(row['ALASAN']);

            $('#popup_no_surat').css('display','none');
            $('#popup_no_surat').hide();
            $('#cetak').removeAttr('disabled');
        }
    });
}

function get_bagian_id(id_bagian){
    $.ajax({
        url : "<?php echo base_url(); ?>dashboard/departemen_divisi_c/get_bagian_id",
        data : {id_bagian:id_bagian},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#bagian').val(row.NAMA);
        }
    });
}

function get_sub_bagian_id(id_divisi){
    $.ajax({
        url : "<?php echo base_url(); ?>dashboard/departemen_divisi_c/get_dep_div",
        data : {id_divisi:id_divisi},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#sub_bagian').val(row.NAMA);
        }
    });
}

function cari_surat(){
    var keyword = $('#search_surat').val();
    if(ajax){
        ajax.abort();
    }

    ajax = $.ajax({
        url : "<?php echo base_url(); ?>dashboard/cetak_biaya_luar_c/cari_surat",
        data : {keyword:keyword},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(result){
            $isi = "";
            for(var i=0; i<result.length; i++){

                var no_bukti = result[i].NO_BUKTI;

                if(no_bukti == null || no_bukti == ""){
                    no_bukti = "-";
                }

                var nabar = result[i].NAMA_BARANG;

                if(nabar == null || nabar == ""){
                    nabar = "-";
                }

                $isi += "<tr style='cursor:pointer;' onclick=get_surat_id("+result[i].ID+");>"+
                            "<td align='center'>"+result[i].NO_SURAT+"</td>"+
                            "<td>"+no_bukti+"</td>"+
                            "<td>"+nabar+"</td>"+
                        "</tr>";
            }
            $('#data_surat tbody').html($isi);
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
    <form class="form-horizontal" role="form" action="<?php echo $url; ?>" method="post" target="_blank">
        <div class="panel-body">

            <div class="form-group">
                <label for="no_surat" class="col-lg-3 control-label">No Surat</label>
                <div class="col-lg-4">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field">
                                    <input type="hidden" name="id_surat" id="id_surat" value="">
                                    <input type="text" name="no_surat" id="no_surat" class="gui-input" value="" readonly />
                                </label>
                                <a class="button" id="kode_surat">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="bagian" class="col-lg-3 control-label">Bagian</label>
                <div class="col-lg-4">
                    <input type="text" name="bagian" id="bagian" class="form-control" value="" readonly />
                </div>
            </div>

            <div class="form-group">
                <label for="sub_bagian" class="col-lg-3 control-label">Sub Bagian</label>
                <div class="col-lg-4">
                    <input type="text" name="sub_bagian" id="sub_bagian" class="form-control" value="" readonly />
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
                    <input type="text" name="no_dpbm" id="no_dpbm" class="form-control" value="" readonly />
                </div>
            </div>

            <div class="form-group" id="view_rab">
                <label for="no_rab" class="col-lg-3 control-label">No RAB</label>
                <div class="col-lg-4">
                    <input type="text" name="no_rab" id="no_rab" class="form-control" value="" readonly />
                </div>
            </div>

            <div class="form-group">
                <label for="program_biaya" class="col-lg-3 control-label">Program / Biaya</label>
                <div class="col-lg-4">
                    <input type="text" name="program_biaya" id="program_biaya" class="form-control" value="" readonly />
                </div>
            </div>

            <div class="form-group">
                <label for="alasan" class="col-lg-3 control-label">Alasan Permintaan</label>
                <div class="col-lg-4">
                    <input type="text" name="alasan" id="alasan" class="form-control" value="" readonly />
                </div>
            </div>

        </div>

        <div class="panel-footer">
            <center>
                <input type="submit" name="cetak" id="cetak" class="btn btn-danger" value="CETAK" style="font-weight:bold;" disabled="disabled">
            </center>
        </div>

    </form>
</div>

<!-- NO SURAT -->
<div id="popup_no_surat">
   <div class="window_no_surat">
    <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>ico/cancel.gif" id="pojok_surat"></a>
        <div class="panel-body">
            <input type="text" name="search_surat" id="search_surat" class="form-control" value="" placeholder="Cari No Surat...">
            <br/>
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="data_surat">
                    <thead>
                        <tr class="primary">
                           <th style="white-space:nowrap; text-align:center;">NO SURAT</th>
                           <th style="white-space:nowrap; text-align:center;">NO DPBM / NO RAB</th>
                           <th style="white-space:nowrap; text-align:center;">NAMA BARANG</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($no_surat as $value_surat) {

                        $no_buk = $value_surat->NO_BUKTI;
                        if($no_buk == null || $no_buk == ""){
                            $no_buk = "-";
                        }

                        $nabar = $value_surat->NAMA_BARANG;
                        if($nabar == null || $nabar == ""){
                            $nabar = "-";
                        }
                    ?>
                        <tr style="cursor:pointer;" onclick="get_surat_id('<?php echo $value_surat->ID; ?>');">
                            <td align="center" style="white-space:nowrap;"><?php echo $value_surat->NO_SURAT; ?></td>
                            <td style="white-space:nowrap;"><?php echo $no_buk; ?></td>
                            <td><?php echo $nabar; ?></td>
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