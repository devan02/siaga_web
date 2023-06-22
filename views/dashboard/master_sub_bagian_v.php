<script type="text/javascript" src="<?=base_url();?>material/vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(".num_only").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

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


function get_grup(id){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/setup_grup_kode_perkiraan_c/get_grup',
        data : {id:id},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){
            $("#kode_grup").val(res.KP_GRUP);
            $("#kode_sub").val(res.KP_SUB);
            $("#sub_grup1").val(res.SUB_GRUP1);
            $("#sub_grup2").val(res.SUB_GRUP2);
            $("#sub_grup3").val(res.SUB_GRUP3);
            $("#location").val(res.GRUP);

            $('body,html').animate({
                scrollTop : 0                       // Scroll to top of body
            }, 500);
        }
    });
}

function cek_kode(){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/master_sub_bagian_c/cek_kode',
        data : {
            kode_sub_bagian : $('#kode_sub_bagian').val(),
        },
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){
            if(res == 1 || res == "1"){
                $('#notif_pakai').show();
                $('#simpan').attr('disabled', true);
            } else {
                $('#notif_pakai').hide();
                $('#simpan').attr('disabled', false);
            }
        }
    });
}

function get_data_sub_bagian(id){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/master_sub_bagian_c/get_data_sub_bagian',
        data : {id:id},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){
            $("#kode_sub_bagian_ed").val(res.KODE);
            $("#nama_sub_bagian_ed").val(res.NAMA);
            $("#keterangan_ed").val(res.KETERANGAN);
            $("#id_sub_bagian_ed").val(res.ID);
        }
    });
}

function cek_kode_ed(){
    var hasil;
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/master_sub_bagian_c/cek_kode_ed',
        data : {
            kode_sub_bagian : $('#kode_sub_bagian_ed').val(),
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

<div id="notif_pakai" class="alert alert-danger alert-dismissable" style="display:none;">
    <i class="fa fa-danger pr10"></i>
    <strong>Perhatian!</strong>
    <span id="keterangan_pesan"><b> Kode Sub Bagian telah terpakai. Silahkan gunakan kode yang lainnya. </b></span>
</div>

<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body">

        <form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>">

            <div class="form-group data_baru">
                <label for="bagian" class="col-lg-3 control-label">Bagian</label>
                <div class="col-lg-5">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50" id='basic-modal'>
                                <label class="field">
                                    <input readonly type="text" name="bagian" id="bagian" class="gui-input" value="" required />
                                    <input type="hidden" name="id_bagian" id="id_bagian" value="" required />
                                </label>
                                  <a class="button basic">
                                      <i class="fa fa-search"></i>
                                  </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="kode_sub_bagian" class="col-lg-3 control-label">Kode Sub Bagian</label>
                <div class="col-lg-1">
                    <input onkeyup="cek_kode();" type="text" required name="kode_sub_bagian" id="kode_sub_bagian" class="form-control" value="" />
                </div>
            </div>

            <div class="form-group">
                <label for="nama_sub_bagian" class="col-lg-3 control-label">Nama Sub Bagian</label>
                <div class="col-lg-5">
                    <input type="text" required name="nama_sub_bagian" id="nama_sub_bagian" class="form-control" value="" />
                </div>
            </div>

            
            <div class="form-group">
                <label class="col-lg-3 control-label" for="keterangan">Keterangan</label>
                <div class="col-lg-8">
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                </div>
            </div>




            <center>

                <input id="simpan" type="submit" name="simpan" value="SIMPAN" class="btn btn-primary btn-gradient dark" style="font-weight:bold;" />
                &nbsp;
                <input type="reset" value="BATAL" class="btn btn-default btn-gradient dark" style="font-weight:bold;" />
            </center>
                        
         </form>   
    </div>

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
                        <span class="glyphicon glyphicon-tasks"></span>Data Bagian</div>
                </div>
                <div class="panel-body pn">
                    <table class="table table-bordered table-hover" id="datatable2" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle; text-align:center;">#</th>
                                <th style="vertical-align: middle;">BAGIAN</th>
                                <th style="vertical-align: middle;">KODE SUB BAGIAN</th>
                                <th style="vertical-align: middle;">NAMA SUB BAGIAN</th>
                                <th style="vertical-align: middle;">KETERANGAN</th>
                                <th style="vertical-align: middle;">STATUS</th>
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
                                <td style="text-align:center;"><?=$no;?></td>
                                <td><?=$row->BAGIAN;?></td>
                                <td><?=$row->KODE==""?"-":$row->KODE;?></td>
                                <td><?=$row->NAMA;?></td>
                                <td><?=$row->KETERANGAN==""?"-":$row->KETERANGAN;?></td>
                                <td><?=$row->AKTIF==1?"Aktif":"Tidak Aktif";?></td>

                                <td>
                                    <center> 
                                        <a href="#edit" onclick="get_data_sub_bagian('<?=$row->ID;?>');" style="height: 30px; width: 100px;"class="btn btn-sm btn-warning btn-block" type="button"><i class="fa fa-edit"></i> Ubah</a> 
                                    </center>
                                </td>

                                <td>
                                    <?PHP if($row->AKTIF == 1){ ?>
                                    <center> 
                                        <button onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID;?>');" style="height: 30px; width: 100px;"class="btn btn-sm btn-danger btn-block" type="button"><i class="fa fa-remove"></i> Hapus</button> 
                                    </center>
                                    <?PHP } else { echo " <center> - </center>"; } ?>
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


        
<!-- modal content -->
<div id="basic-modal-content">
    <table class="table table-bordered table-hover" id="datatable_popup" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th style="vertical-align: middle;">KODE BAGIAN</th>
                <th style="vertical-align: middle;">NAMA BAGIAN</th>
        </thead>

        <tbody>
            <?PHP 
                foreach ($get_bagian as $key => $bagian) {
            ?>
            <tr style="cursor:pointer;" onclick="$('.simplemodal-close').click(); $('#bagian').val('<?=$bagian->NAMA;?>'); $('#id_bagian').val('<?=$bagian->ID;?>');">
                <td><?=$bagian->KODE;?></td>
                <td><?=$bagian->NAMA;?></td>
            </tr>
            <?PHP } ?>
        </tbody>
    </table>
</div>

<!-- preload the images -->
<div style='display:none'>
    <img src='<?=base_url();?>material/modal/img/basic/x.png' alt='' />
</div>


<!-- TAMBAH MODAL -->

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
                    <span id="keterangan_pesan"><b> Kode Sub Bagian telah terpakai. Silahkan gunakan kode yang lainnya. </b></span>
                </center>
            </div>
            <form id="add_form" class="form-horizontal" role="form" method="post" action="#" onsubmit = "return cek_kode_ed();">


                <div class="form-group admin-form">
                    <label for="kode_sub_bagian_ed" class="col-lg-4 control-label">Kode Sub Bagian</label>
                    <div class="col-lg-3">
                        <input type="text" name="kode_sub_bagian_ed" id="kode_sub_bagian_ed" class="form-control" value="" onchange="cek_kode_ed();" />
                        <input type="hidden" name="id_sub_bagian_ed" id="id_sub_bagian_ed" class="form-control" readonly value="" />
                    </div>
                </div>

                <div class="form-group admin-form">
                    <label for="nama_sub_bagian_ed" class="col-lg-4 control-label">Nama Bagian</label>
                    <div class="col-lg-7">
                        <input type="text" name="nama_sub_bagian_ed" id="nama_sub_bagian_ed" class="form-control"  value="" />
                    </div>
                </div>

                <div class="form-group admin-form">
                    <label for="keterangan_ed" class="col-lg-4 control-label">Keterangan</label>
                    <div class="col-lg-7">
                        <textarea class="form-control" id="keterangan_ed" name="keterangan_ed" rows="3" style="resize:none;"></textarea>
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