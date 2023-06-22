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

    <?php
        if($msg == 3){
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

function get_data_dana(id){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/master_sumber_dana_c/get_data_dana',
        data : {id:id},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){
            $("#sumber_dana_ed").val(res.NAMA);
            $("#id_sumber_dana_ed").val(res.ID);
        }
    });
}

function cek_dana(){
    var hasil;
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/master_sumber_dana_c/cek_dana',
        data : {
            sumber_dana : $('#sumber_dana_ed').val(),
        },
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){   
            hasil = res;
        }
    });

    if(hasil == 1 || hasil == "1"){
        $('#notif_pakai_ed').show();
        $('#edit_btn').attr('disabled', true);
        return false;
    } else {
        $('#notif_pakai_ed').hide();
        $('#edit_btn').attr('disabled', false);
        return true;
    }

}

</script>

<?PHP if($err == 1){?>
<div class="alert alert-danger alert-dismissable" >
    <i class="fa fa-danger pr10"></i>
    <strong>Perhatian !</strong>
    <span id="keterangan_pesan"> <b> Nama sumber dana sudah tersedia, silahkan inputkan sumber dana yang lainnya </b> </span>
</div>
<?PHP } ?>

<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>    
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>">

            <div class="form-group">
                <label for="sumber" class="col-lg-3 control-label">Sumber Dana</label>
                <div class="col-lg-7">
                    <input type="text" required name="sumber" id="sumber" class="form-control" value="" />
                </div>
            </div>

            

            <hr style="margin-bottom: 10px;">
            <center>

                <input id="simpan" type="submit" name="simpan" value="SIMPAN" class="btn btn-primary btn-gradient dark" style="font-weight:bold;" />
                &nbsp;
                <input id="reset" type="reset" value="BATAL" class="btn btn-default btn-gradient dark" style="font-weight:bold;" />

            </center>
        </form> 
    </div>
</div>

<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body form-horizontal">

    <div class="col-md-12">
            <div class="panel panel-visible">
                <div class="panel-heading">
                    <div class="panel-title hidden-xs">
                        <span class="glyphicon glyphicon-tasks"></span>List Data Sumber Dana</div>
                </div>
                <div class="panel-body pn">
                    <table class="table table-bordered table-hover" id="datatable2" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle;">#</th>
                                <th style="vertical-align: middle;">SUMBER DANA</th>
                                <th style="vertical-align: middle; text-align: center;">UBAH</th>
                                <th style="vertical-align: middle; text-align: center;">HAPUS</th>
                        </thead>
                        <tbody>
                            <?PHP 
                                $no = 0;
                                foreach ($dt as $key => $row) {
                                $no++;
                            ?>
                            <tr style="cursor:pointer;">
                                <td><?=$no;?></td>
                                <td><?=$row->NAMA;?></td>

                                <td>
                                    <center> 
                                        <a href="#edit" onclick="get_data_dana('<?=$row->ID;?>');" style="height: 30px; width: 100px;"class="btn btn-sm btn-warning btn-block" type="button"><i class="fa fa-edit"></i> Ubah</a> 
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


<!-- EDIT MODAL -->

<div id="edit" class="modalDialogs" style="z-index: 9999;">
    <div>
        <div class="modals_head">
            <span>
                <h3>Ubah Bagian</h3>
            </span>

            <span>
                <!-- <a href="#close" title="Close" class="closeit">X</a> -->
                <a href="#close" id="closeit" style="float:right;" class="close-button" title="Tutup"><img src="<?=base_url();?>images/close.png" width="20px" height="20px" style="margin-top: -40px;"></a>
            </span>  
        </div>
            <div id="notif_pakai_ed" class="alert alert-danger alert-dismissable" style="display:none;">
                <center>
                    <i class="fa fa-danger pr10"></i>
                    <span id="keterangan_pesan"><b> Sumber Dana telah terpakai. Silahkan gunakan kode yang lainnya. </b></span>
                </center>
            </div>
            <form id="add_form" class="form-horizontal" role="form" method="post" action="#" onsubmit = "return cek_kode_ed();">

                <div class="form-group admin-form">
                    <label for="sumber_dana_ed" class="col-lg-4 control-label">SUMBER DANA</label>
                    <div class="col-lg-7">
                        <input onkeyup="cek_dana();" type="text" name="sumber_dana_ed" id="sumber_dana_ed" class="form-control"  value="" />
                        <input type="hidden" name="id_sumber_dana_ed" id="id_sumber_dana_ed" class="form-control"  value="" />
                    </div>
                </div>


                <hr style="margin-bottom: 10px;">

                <center>

                    <input type="submit" name="edit" id="edit_btn" value="SIMPAN PERUBAHAN" class="btn btn-primary btn-gradient dark" style="font-weight:bold;" />
                    &nbsp;
                    <input id="batalkan" type="button" onclick="window.location='#close';" value="BATAL" class="btn btn-default btn-gradient dark" style="font-weight:bold;" />
                </center>
                            
             </form>   

    </div>
</div>


<!-- END -->