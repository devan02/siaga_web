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
        url : '<?php echo base_url(); ?>dashboard/setup_kode_perkiraan_c/cek_kode',
        data : {
            kode_perkiraan : $('#kode_perkiraan').val(),
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

function get_kode_perkiraan(id){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/setup_kode_perkiraan_c/get_kode_perkiraan',
        data : {
            id:id,
        },
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){
            $("#kode_perkiraan_ed").val(res.KODE_PERKIRAAN);
            $("#nama_perkiraan_ed").val(res.NAMA_PERKIRAAN);
            $("#id_edit").val(res.ID);
        }
    });
}


function set_kode(grup, sub, nama){
    $("#grup").val(nama);
    $("#kode1").val(grup);
    $("#kode2").val(sub);

    var kode = $("#kode3").val();   
    var kp = grup+ "." + sub+ "." + kode  
    $("#kode_perkiraan").val(kp) ;    

    $('.simplemodal-close').click(); 
}

function input_kode(){
    var kode = $("#kode3").val();   
    var kp = $("#kode1").val() + "." + $("#kode2").val() + "." + kode  
    $("#kode_perkiraan").val(kp) ;  
}


</script>
<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body">

        <form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>">

            <div class="form-group data_baru">
                <label for="grup" class="col-lg-3 control-label">Grup</label>
                <div class="col-lg-5">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50" id='basic-modal'>
                                <label class="field">
                                    <input readonly type="text" name="grup" id="grup" class="gui-input" value="" required />
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
                <label for="kode1" class="col-lg-3 control-label">Kode Perkiraan</label>
                <div class="col-lg-1">
                    <input type="text" readonly name="kode1" id="kode1" class="form-control" value="" />
                </div>
                <div class="col-lg-1">
                    <input type="text" readonly name="kode2" id="kode2" class="form-control" value="" />
                </div>
                <div class="col-lg-3">
                    <input onchange="cek_kode();" type="text" required name="kode3" id="kode3" class="form-control num_only" maxlength="4" value="" onkeyup="input_kode();" />
                </div>
            </div>

            <div class="form-group">
                <label for="kode_perkiraan" class="col-lg-3 control-label"></label>
                <div class="col-lg-5">
                    <input type="text" readonly required name="kode_perkiraan" id="kode_perkiraan" class="form-control" value="" />
                    <span id="notif_pakai" class="help-block mt5" style="width: 150%; color: red; font-weight: bold; display:none;"><i class="fa fa-bell"></i> 
                        Kode Perkiraan diatas telah terpakai !!
                    </span>
                </div>
            </div>

            
            <div class="form-group">
                <label for="nama_perkiraan" class="col-lg-3 control-label">Nama Perkiraan</label>
                <div class="col-lg-5">
                    <input type="text" required name="nama_perkiraan" id="nama_perkiraan" class="form-control" value="" />
                </div>
            </div>


            <hr style="margin-bottom: 10px;">

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
                        <span class="glyphicon glyphicon-tasks"></span>Data Grup Kode Perkiraan</div>
                </div>
                <div class="panel-body pn">
                    <table class="table table-bordered table-hover" id="datatable2" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle;">KODE PERKIRAAN</th>
                                <th style="vertical-align: middle;">GRUP</th>
                                <th style="vertical-align: middle;">SUB</th>
                                <th style="vertical-align: middle;">NAMA PERKIRAAN</th>
                                <th style="vertical-align: middle; text-align: center;">UBAH</th>
                                <th style="vertical-align: middle; text-align: center;">HAPUS</th>
                        </thead>
                        <tbody>
                            <?PHP 
                                foreach ($dt as $key => $row) {
                            ?>
                            <tr style="cursor:pointer;">
                                <td><?=$row->KODE_PERKIRAAN;?></td>
                                <td><?=$row->KP_GRUP;?></td>
                                <td><?=$row->KP_SUB?></td>
                                <td><?=$row->NAMA_PERKIRAAN;?></td>

                                <td>
                                    <center> 
                                        <a href="#Edit_kode" onclick="get_kode_perkiraan('<?=$row->ID;?>');" style="height: 30px; width: 100px;"class="btn btn-sm btn-warning btn-block"><i class="fa fa-edit"></i> Ubah</a> 
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


<div id="basic-modal-content">
    <table class="table table-bordered table-hover" id="datatable_popup" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th style="vertical-align: middle;">KODE GRUP & SUB</th>
                <th style="vertical-align: middle;">KODE GRUP</th>
                <th style="vertical-align: middle;">KODE SUB</th>
                <th style="vertical-align: middle;">NAMA SUB</th>
        </thead>

        <tbody>
            <?PHP 
                foreach ($get_grup as $key => $grup) {
            ?>
            <tr style="cursor:pointer;" onclick="set_kode('<?=$grup->KP_GRUP;?>','<?=$grup->KP_SUB;?>', '<?=$grup->SUB_GRUP3;?>'); $('.mfp-close').click();">
                <td><?=$grup->KP_GRUP.".".$grup->KP_SUB;?></td>
                <td><?=$grup->KP_GRUP;?></td>
                <td><?=$grup->KP_SUB;?></td>
                <td><?=$grup->SUB_GRUP3;?></td>
            </tr>
            <?PHP } ?>
        </tbody>
    </table>
</div>
<!-- preload the images -->
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

<!-- EDIT MODAL -->

<div id="Edit_kode" class="modalDialogs">
    <div>
        

        <div class="modals_head">
            <span>
                <h3>Edit Kode Perkiraan</h3>
            </span>

            <span>
                <!-- <a href="#close" title="Close" class="closeit">X</a> -->
                <a href="#close" id="closeit" style="float:right;" class="close-button" title="Tutup"><img src="<?=base_url();?>images/close.png" width="20px" height="20px" style="margin-top: -40px;"></a>
            </span>  
        </div>

            <form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>">

                <div class="form-group">
                    <label for="kode_perkiraan_ed" class="col-lg-4 control-label">Kode Perkiraan</label>
                    <div class="col-lg-7">
                        <input readonly type="text" name="kode_perkiraan_ed" id="kode_perkiraan_ed" class="form-control num_only"  value="" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="nama_perkiraan_ed" class="col-lg-4 control-label">Nama Perkiraan</label>
                    <div class="col-lg-7">
                        <input type="text" name="nama_perkiraan_ed" id="nama_perkiraan_ed" class="form-control" value="" />
                        <input type="hidden" name="id_edit" id="id_edit" class="form-control" value="" />
                    </div>
                </div>

                <hr style="margin-bottom: 10px;">

                <center>

                    <input type="submit" name="edit" value="SIMPAN" class="btn btn-primary btn-gradient dark" style="font-weight:bold;" />
                    &nbsp;
                    <input type="button" onclick="window.location='#close';" value="BATAL" class="btn btn-default btn-gradient dark" style="font-weight:bold;" />
                </center>
                            
             </form>   

    </div>
</div>


<!-- END -->