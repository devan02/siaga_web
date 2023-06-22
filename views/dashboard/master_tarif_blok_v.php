<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script>
$(document).ready(function(){
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

    $('#batal').click(function(){
        $('#popup_tarif').css('display','none');
        $('#popup_tarif').hide();
    });

    $('#close_tarif').click(function(){
        $('#popup_tarif').css('display','none');
        $('#popup_tarif').hide();
    });
});

function loading(){
    $('#popup_load').css('display','block');
    $('#popup_load').show(); 
}

function cari_data(){
    var keyword = $('#cari_data').val();
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/master_tarif_blok_c/cari_data',
        data : {keyword:keyword},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(result){
            $isi = "";
            var no = 0;
            for(var i=0; i<result.length; i++){
                no++;
                $isi += "<tr>"+
                            "<td align='center'>"+no+"</td>"+
                            "<td>"+result[i].KELOMPOK_PELANGGAN+"</td>"+
                            "<td align='center'>"+numberWithCommas(result[i].BLOK_1)+"</td>"+
                            "<td align='center'>"+numberWithCommas(result[i].BLOK_2)+"</td>"+
                            "<td align='center'>"+numberWithCommas(result[i].TARIF_NAIK_BLOK_1)+"</td>"+
                            "<td align='center'>"+numberWithCommas(result[i].TARIF_NAIK_BLOK_2)+"</td>"+
                            "<td align='center'>"+
                                "<a href='javascript:void(0);' class='btn btn-primary'>Ubah</a>&nbsp;"+
                                "<a href='javascript:void(0);' class='btn btn-danger'>Hapus</a>"+
                            "</td>"+
                        "</tr>";
            }
            $('#data tbody').html($isi);
        }
    });
}

function ubah_tarif(id_tarif){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/master_tarif_blok_c/get_tarif_id',
        data : {id_tarif:id_tarif},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#popup_tarif').css('display','block');
            $('#popup_tarif').show();
            $('#id_tarif').val(id_tarif);
            $('#ubah_kelompok_pelanggan').val(row['KELOMPOK_PELANGGAN']);
            $('#blok_1_kurang_dr_sepuluh').val(numberWithCommas(row['BLOK_1']));
            $('#blok_2_lebih_dr_sepuluh').val(numberWithCommas(row['BLOK_2']));
            $('#blok_1_kurang_dr_sepuluh2').val(numberWithCommas(row['TARIF_NAIK_BLOK_1']));
            $('#blok_2_lebih_dr_sepuluh2').val(numberWithCommas(row['TARIF_NAIK_BLOK_2']));

            if(row['STATUS'] == 1){
                $('#radioExample77').prop('checked',true);
            } else {
                $('#radioExample777').prop('checked',true);
            }

        }
    });
}

function hapus_tarif(id_tarif){
    $('#dialog-btn').click();
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/master_tarif_blok_c/get_tarif_id',
        data : {id_tarif:id_tarif},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#id_hapus').val(id_tarif);
            $('#ket_hapus').html('Apakah data <b>'+row['KELOMPOK_PELANGGAN']+'</b> ini ingin dihapus ?');
        }
    });
}
</script>
<div id="popup_load">
    <div class="window_load">
        <img src="<?=base_url()?>/ico/loading.gif" height="100" width="100">
    </div>
</div>


<form class="form-horizontal" role="form" method="post" action="<?php echo $post_url; ?>">
<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <label for="kel_pel" class="col-lg-3 control-label">Kelompok Pelanggan</label>
            <div class="col-lg-5">
                <input type="text" required name="kel_pel" id="kel_pel" class="form-control" value="" />
            </div>
        </div>

        <div class="form-group admin-form">
            <label for="inputPassword" class="col-lg-3 control-label">Jenis Kelompok Pelanggan</label>
            <div class="col-lg-6">
                <div class="admin-form">
                    <div>
                        <div class="smart-widget sm-right smr-50">
                            <label class="field select">
                                <select id="tahun2" name="jkp" style="cursor:pointer;">
                                    <?php
                                       foreach ($jkp as $key => $row_jk) {
                                          echo"<option value=".$row_jk->JENIS_KELOMPOK_PELANGGAN."> ".$row_jk->JENIS_KELOMPOK_PELANGGAN." </option>";
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
            <label class="col-lg-3 control-label"></label>
            <div class="col-lg-5">
                <span class="help-block mt5" style="color:#0000FF;"><i class="glyphicons glyphicons-coins"></i> Tarif Lama</span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label" for="blok_1_kurang_dr_sepuluh_new">0 - 10</label>
            <div class="col-lg-3">
                <input type="text" onkeyup="FormatCurrency(this);" name="blok_1_kurang_dr_sepuluh_new" id="blok_1_kurang_dr_sepuluh_new" class="form-control" value="">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label" for="blok_2_lebih_dr_sepuluh_new">> 10</label>
            <div class="col-lg-3">
                <input type="text" onkeyup="FormatCurrency(this);" name="blok_2_lebih_dr_sepuluh_new" id="blok_2_lebih_dr_sepuluh_new" class="form-control" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="disabledInput" class="col-lg-3 control-label"></label>
            <div class="col-lg-5" style="margin-top: 8px;">
                <div class="radio-custom radio-primary mb5">
                    <input type="radio" id="radioExample77_new" name="sts_new" value="1" checked>
                    <label for="radioExample77_new" style="margin-right: 15px; padding-left: 25px;">Aktifkan Tarif Ini</label>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label class="col-lg-3 control-label"></label>
            <div class="col-lg-5">
                <span class="help-block mt5" style="color:#0000FF;"><i class="glyphicons glyphicons-coins"></i> Tarif Berlaku</span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label" for="blok_1_kurang_dr_sepuluh2_new">0 - 10</label>
            <div class="col-lg-3">
                <input type="text" onkeyup="FormatCurrency(this);" name="blok_1_kurang_dr_sepuluh2_new" id="blok_1_kurang_dr_sepuluh2_new" class="form-control" value="">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label" for="blok_2_lebih_dr_sepuluh2_new">> 10</label>
            <div class="col-lg-3">
                <input type="text" onkeyup="FormatCurrency(this);" name="blok_2_lebih_dr_sepuluh2_new" id="blok_2_lebih_dr_sepuluh2_new" class="form-control" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="disabledInput" class="col-lg-3 control-label"></label>
            <div class="col-lg-5" style="margin-top: 8px;">
                <div class="radio-custom radio-primary mb5">
                    <input type="radio" id="radioExample777_new" name="sts_new" value="2">
                    <label for="radioExample777_new" style="margin-right: 15px; padding-left: 25px;">Aktifkan Tarif Ini</label>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-footer">
        <center>
            <input type="submit" name="simpan2" class="btn btn-primary btn-gradient dark" style="font-weight:bold;" value="Simpan">
        </center>
    </div>
</div>
</form>


<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">
            <span class="glyphicons glyphicons-table"></span>Data Tarif Blok
        </span>
    </div>
    <div class="panel-body pn">
        <br/>
        <input type="text" name="cari_data" id="cari_data" class="form-control" value="" style="width:275px; margin-left:10px;" placeholder="Cari..." onkeyup="cari_data();">
        <br/>
        <table class="table table-bordered" id="data">
            <thead>
                <tr>
                    <th style="vertical-align: middle; text-align:center;" rowspan="2">No</th>
                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" rowspan="2">Kelompok Pelanggan</th>
                    <th style="vertical-align: middle; text-align:center;" colspan="2">Tarif Lama</th>
                    <th style="vertical-align: middle; text-align:center;" colspan="2">Tarif Berlaku</th>
                    <th style="vertical-align: middle; text-align:center;" rowspan="2">Aksi</th>
                </tr>
                <tr>
                    <th style="vertical-align: middle; text-align:center;">0 - 10</th>
                    <th style="vertical-align: middle; text-align:center;">> 10</th>
                    <th style="vertical-align: middle; text-align:center;">0 - 10</th>
                    <th style="vertical-align: middle; text-align:center;">> 10</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $no = 0;
                foreach ($tarif_blok as $value_blok) {
                    $no++; 
            ?>
                <tr>
                    <td align="center"><?php echo $no; ?></td>
                    <td><?php echo $value_blok->KELOMPOK_PELANGGAN; ?></td>
                    <td align="center"><?php echo number_format($value_blok->BLOK_1,0,'.',','); ?></td>
                    <td align="center"><?php echo number_format($value_blok->BLOK_2,0,'.',','); ?></td>
                    <td align="center"><?php echo number_format($value_blok->TARIF_NAIK_BLOK_1,0,',','.'); ?></td>
                    <td align="center"><?php echo number_format($value_blok->TARIF_NAIK_BLOK_2,0,',','.'); ?></td>
                    <td align="center">
                        <a href="javascript:void(0);" class="btn btn-primary" onclick="ubah_tarif(<?php echo $value_blok->ID; ?>);">Ubah</a>
                        <a href="javascript:void(0);" class="btn btn-danger" onclick="hapus_tarif(<?php echo $value_blok->ID; ?>);">Hapus</a>
                    </td>
                </tr>
            <?php       
                }
            ?>
            </tbody>
        </table>
    </div>
</div>

<div id="popup_tarif">
    <div class="window_tarif">
        <div class="modals_head">
            <span>
                <h3>Ubah Tarif</h3>
            </span>
            <span>
                <a href="javascript:void(0);" id="close_tarif" style="float:right;" class="close-button"><img src="<?=base_url();?>images/close.png" width="20px" height="20px" style="margin-top: -40px;"></a>
            </span>  
        </div>
        <form class="form-horizontal" role="form" action="<?php echo $url_ubah; ?>" method="post">
            <input type="hidden" name="id_tarif" id="id_tarif" value="">
            <div class="form-group">
                <label class="col-lg-3 control-label" for="rapat_tahun">Kelompok Pelanggan</label>
                <div class="col-lg-8">
                    <input type="text" name="ubah_kelompok_pelanggan" id="ubah_kelompok_pelanggan" class="form-control" value="">
                </div>
            </div>



            <div class="form-group">
                <label class="col-lg-3 control-label"></label>
                <div class="col-lg-8">
                    <span class="help-block mt5" style="color:#0000FF;"><i class="glyphicons glyphicons-coins"></i> Tarif Lama</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="blok_1_kurang_dr_sepuluh">0 - 10</label>
                <div class="col-lg-8">
                    <input type="text" name="blok_1_kurang_dr_sepuluh" id="blok_1_kurang_dr_sepuluh" class="form-control" value="">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="blok_2_lebih_dr_sepuluh">> 10</label>
                <div class="col-lg-8">
                    <input type="text" name="blok_2_lebih_dr_sepuluh" id="blok_2_lebih_dr_sepuluh" class="form-control" value="">
                </div>
            </div>

            <div class="form-group">
                <label for="disabledInput" class="col-lg-3 control-label"></label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample77" name="sts" value="1">
                        <label for="radioExample77" style="margin-right: 15px; padding-left: 25px;">Aktifkan Tarif Ini</label>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label class="col-lg-3 control-label"></label>
                <div class="col-lg-8">
                    <span class="help-block mt5" style="color:#0000FF;"><i class="glyphicons glyphicons-coins"></i> Tarif Berlaku</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="blok_1_kurang_dr_sepuluh2">0 - 10</label>
                <div class="col-lg-8">
                    <input type="text" name="blok_1_kurang_dr_sepuluh2" id="blok_1_kurang_dr_sepuluh2" class="form-control" value="">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="blok_2_lebih_dr_sepuluh2">> 10</label>
                <div class="col-lg-8">
                    <input type="text" name="blok_2_lebih_dr_sepuluh2" id="blok_2_lebih_dr_sepuluh2" class="form-control" value="">
                </div>
            </div>

            <div class="form-group">
                <label for="disabledInput" class="col-lg-3 control-label"></label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample777" name="sts" value="2">
                        <label for="radioExample777" style="margin-right: 15px; padding-left: 25px;">Aktifkan Tarif Ini</label>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <center>
                    <input type="submit" name="simpan" id="simpan" value="SIMPAN" class="btn btn-primary">
                    <input type="button" name="batal" id="batal" value="BATAL" class="btn btn-danger">
                </center>
            </div>
        </form>
    </div>
</div>

<a id="dialog-btn" href="javascript:;" class="cd-popup-trigger" style="display:none;">View Pop-up</a>
<div class="cd-popup" role="alert">
    <div class="cd-popup-container">

        <form id="delete" method="post" action="<?php echo $url_del; ?>">
            <input type="hidden" name="id_hapus" id="id_hapus" value="" />
        </form>   
         
        <p id="ket_hapus"></p>
        <ul class="cd-buttons">            
            <li><a href="javascript:;" onclick="$('#delete').submit();">Ya</a></li>
            <li><a onclick="$('.cd-popup-close').click(); $('#id_hapus').val('');" href="javascript:;">Tidak</a></li>
        </ul>
        <a href="#0" onclick="$('#id_hapus').val('');" class="cd-popup-close img-replace">Close</a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->
<!-- Copyright 2015
Reserved by CV JTECH MALANG
Devan E. P. -->