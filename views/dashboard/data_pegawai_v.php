<script type="text/javascript" src="<?=base_url();?>material/vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

    <?php
        if($msg == 1){
    ?>
        pesan_sukses();
    <?php
        }
    ?>

    <?php
        if($msg == 2){
    ?>
        pesan_hapus();
    <?php
        }
    ?>

});

function pesan_sukses(){
    var pesan = '<div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div>'+
                '<h4 class="ui-pnotify-title">Berhasil</h4>'+
                '<div class="ui-pnotify-text"><strong>Data berhasil disimpan!</strong></div>';

    $.jGrowl(pesan, { header: '', life:3000 });
}

function pesan_hapus(){
    var pesan = '<div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div>'+
                '<h4 class="ui-pnotify-title">Berhasil</h4>'+
                '<div class="ui-pnotify-text"><strong>Data berhasil dihapus!</strong></div>';

    $.jGrowl(pesan, { header: '', life:3000 });
}

function get_grup(id){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/setup_grup_kode_perkiraan_c/get_grup',
        data : {id:id},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){
            $("#kode_grup_ed").val(res.KP_GRUP);
            $("#kode_sub_ed").val(res.KP_SUB);
            $("#sub_grup1_ed").val(res.SUB_GRUP1);
            $("#sub_grup2_ed").val(res.SUB_GRUP2);
            $("#sub_grup3_ed").val(res.SUB_GRUP3);
            $("#nama_grup_ed").val(res.GRUP);
            $("#id_edit").val(res.ID);

            // $('body,html').animate({
            //     scrollTop : 0                       // Scroll to top of body
            // }, 500);
        }
    });
}

</script>


<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>

    <div class="panel-body" style="background: #FFF;">
        <div class="col-md-12">
            <form method="post" target="_blank" action="<?=base_url().$post_url;?>">
                <input type="submit" value="Cetak Excel" name="excel" class="btn btn-primary btn-gradient dark" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/xls.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;" />        
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
                <input type="submit" value="Cetak PDF" name="pdf" class="btn btn-primary btn-gradient dark" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/pdf.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;" />  
            </form>
        </div>
    </div>

    <div class="panel-body" style="background: #FFF;">
        <div class="col-md-12">
            <div class="panel panel-visible">
                <div class="panel-heading">
                    <div class="panel-title hidden-xs">
                        <span class="glyphicon glyphicon-tasks"></span>Data Pegawai</div>
                </div>
                <div class="panel-body pn">
                    <table class="table table-bordered table-hover" id="datatable2" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle;">NIP</th>
                                <th style="vertical-align: middle;">NAMA PEGAWAI</th>
                                <th style="vertical-align: middle;">BAGIAN</th>
                                <th style="vertical-align: middle;">SUB BAGIAN</th>
                                <th style="vertical-align: middle;">JABATAN</th>
                                <th style="vertical-align: middle;">ALAMAT</th>
                                <th style="vertical-align: middle;">UBAH</th>
                                <th style="vertical-align: middle;">HAPUS</th>
                        </thead>
                        <tbody>
                            <?PHP 
                                foreach ($pegawai as $key => $row) {
                            ?>
                            <tr style="cursor:pointer;">
                                <td><?=$row->NIP;?></td>
                                <td><?=$row->NAMA;?></td>
                                <td><?=$row->BAGIAN;?></td>
                                <td><?=$row->SUB_BAGIAN;?></td>
                                <td><?=$row->JABATAN;?></td>
                                <td><?=$row->ALAMAT;?></td>

                                <td>
                                    <center> 
                                        <a href="javascript:;" onclick="window.location='<?=base_url();?>dashboard/data_pegawai_c/edit_pegawai/<?=$row->ID;?>';" style="height: 30px; width: 100px;" class="btn btn-sm btn-warning btn-block"><i class="fa fa-edit"></i> Ubah</a> 
                                    </center>
                                </td>

                                <td>
                                    <center> 
                                        <button onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID;?>');" style="height: 30px; width: 100px;"class="btn btn-sm btn-danger btn-block" type="button"><i class="fa fa-remove"></i> Hapus</button> 
                                    </center>
                                </td>

                            </tr>
                            </tr>
                            <?PHP } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <center>
            <button class="btn btn-default btn-gradient dark" style="visibility: hidden;">
                Simpan
            </button> 
        </center>
    </div>
</div>

<div style='display:none'>
    <img src='<?=base_url();?>material/modal/img/basic/x.png' alt='' />
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