<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script type="text/javascript">

$(document).ready(function(){

    get_nomor_spm();

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


});

function get_nomor_spm(){


    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/input_spm_c/get_nomor_spm',
        data : {},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){
            $('#no_spm').val(res);
        }
    });
}

function edit_spm(id){

    $('#batal').show();
    $('#save').hide();
    $('#save_ed').show();
    $('#no_spm').prop('readonly', true);

    $.ajax({
        url : '<?php echo base_url();?>dashboard/input_spm_c/get_spm_by_id',
        data : {id:id},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){
            $("#no_spm").val(res.NO_SPM);
            $("#datetimepicker2").val(res.TGL_SPM);
            $("#keterangan").val(res.KET);
            $("#nilai_spm").val(NumberToMoney(res.NILAI).split('.00').join(''));

            $('body,html').animate({
                scrollTop : 0                       // Scroll to top of body
            }, 500);
        }
    });
}

function batal(){
    $('#batal').hide();
    $("#no_spm").val('');
    $('#no_spm').prop('readonly', false);
    $("#datetimepicker2").val('');
    $("#keterangan").val('');
    $("#nilai_spm").val('');
}


</script>
<form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>">
<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body">

        <div class="form-group">
            <label for="no_spm" class="col-lg-3 control-label">No. SPM</label>
            <div class="col-lg-5">
                <input type="text" required name="no_spm" id="no_spm" class="form-control" value="" />
            </div>
        </div>

        <div class="form-group">
            <label for="datetimepicker2" class="col-lg-3 control-label">Tanggal SPM</label>
            <div class="col-lg-4">
                <input style="cursor:pointer;" readonly type="text" class="form-control pull-right" name="tgl_spm" id="datetimepicker2">
                <span class="help-block mt5"><i class="fa fa-bell"></i> Klik field diatas untuk menentukan tanggal SPM</span>
            </div>
        </div>

        <div class="form-group">
            <label for="keterangan" class="col-lg-3 control-label">Keterangan</label>
            <div class="col-lg-5">
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="nilai_spm" class="col-lg-3 control-label">Nilai SPM</label>
            <div class="col-lg-5">
                <input onkeyup="FormatCurrency(this);" type="text" required name="nilai_spm" id="nilai_spm" class="form-control" value="" />
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword" class="col-lg-3 control-label"></label>
            <div class="col-lg-5">
                <div class="admin-form">
                    <input type="submit" id="save" class="btn btn-info btn-gradient dark" style="font-weight:bold;" name="simpan" value="Simpan"/>  
                    <input type="submit" id="save_ed" class="btn btn-info btn-gradient dark" style="font-weight:bold; display:none;" name="edit" value="Simpan Perubahan"/>  
                    &nbsp;&nbsp;&nbsp;
                    <button onclick="batal();" id="batal" style="display:none;" class="btn btn-default btn-gradient dark">
                        Batal Ubah
                    </button> 

                </div>

                
            </div>
        </div> 

    </div>

    </form>

    <div class="panel-footer" style="background: #FFF;">

        <div class="col-md-12">
            <form method="post" target="_blank" action="<?=base_url().$post_url;?>">
                <input type="submit" value="Cetak Excel" name="excel" class="btn btn-primary btn-gradient dark" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/xls.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;" />        
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
                <input type="submit" value="Cetak PDF" name="pdf" class="btn btn-primary btn-gradient dark" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/pdf.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;" />  
            </form>
        </div>

        <br><br><br>

        <div class="col-md-12">
            <div class="panel panel-visible">
                <div class="panel-heading">
                    <div class="panel-title hidden-xs">
                        <span class="glyphicon glyphicon-tasks"></span>Data SPM</div>
                </div>
                <div class="panel-body pn">
                    <table class="table table-bordered table-hover" id="datatable2" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle;">NO SPM</th>
                                <th style="vertical-align: middle;">TANGGAL</th>
                                <th style="vertical-align: middle;">KETERANGAN</th>
                                <th style="vertical-align: middle;">NILAI SPM</th>
                                <th style="vertical-align: middle; text-align: center;">UBAH</th>
                                <th style="vertical-align: middle; text-align: center;">HAPUS</th>
                        </thead>
                        <tbody>
                            <?PHP 
                                foreach ($dt as $key => $row) {
                            ?>
                            <tr style="cursor:pointer;">
                                <td><?=$row->NO_SPM;?></td>
                                <td><?=$row->TGL_SPM;?></td>
                                <td><?=$row->KET;?></td>
                                <td>Rp. <?=str_replace(',', '.', number_format($row->NILAI));?></td>

                                <td>
                                    <center> 
                                        <a href="javascript:;" onclick="edit_spm('<?=$row->ID;?>');" style="height: 30px; width: 100px;"class="btn btn-sm btn-warning btn-block"><i class="fa fa-edit"></i> Ubah</a> 
                                    </center>
                                </td>

                                <td>
                                    <center> 
                                        <button onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID;?>');" style="height: 30px; width: 100px;"class="btn btn-sm btn-danger btn-block" type="button"><i class="fa fa-remove"></i> Hapus</button> 
                                    </center>
                                </td>
                            </tr>
                            <?PHP } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <center>
            <button style="visibility: hidden;" class="btn btn-default btn-gradient dark">
                Simpan
            </button> 
        </center>
    </div>


</div>


<a id="dialog-btn" href="javascript:;" class="cd-popup-trigger" style="display:none;">View Pop-up</a>

<div class="cd-popup" role="alert">
    <div class="cd-popup-container">

        <form id="delete" method="post" action="<?=base_url().$post_url;?>">
            <input type="hidden" name="id_hapus" id="id_hapus" value="" />
        </form>   
         
        <p>Apakah anda yakin ingin menghapus data ini?</p>
        <ul class="cd-buttons">            
            <li><a href="javascript:;" onclick="$('#delete').submit();">Ya</a></li>
            <li><a onclick="$('.cd-popup-close').click(); $('#id_hapus').val('');" href="javascript:;">Tidak</a></li>
        </ul>
        <a href="#0" onclick="$('#id_hapus').val('');" class="cd-popup-close img-replace">Close</a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->
