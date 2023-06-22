<script type="text/javascript" src="<?=base_url();?>material/vendor/jquery/jquery-1.11.1.min.js"></script>
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

function cek_grup_sub(){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/setup_grup_kode_perkiraan_c/cek_grup_sub',
        data : {
            kode_grup :$('#kode_grup').val(),
            kode_sub  :$('#kode_sub').val(),
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


</script>

<div class="panel">    

    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body">

        <div id="notif_pakai" class="alert alert-micro alert-danger light alert-dismissable" style="display:none;">
            <i class="fa fa-cubes pr10 hidden"></i> <strong><b>Perhatian !!</b> Kode Grup dan Kode Sub yang anda inputkan telah terpakai. </strong> 
        </div>

        <form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>">

            <div class="form-group">
                <label for="kode_grup" class="col-lg-3 control-label">Kode Perkiraan Grup</label>
                <div class="col-lg-1">
                    <input required type="text" onchange="cek_grup_sub();" name="kode_grup" id="kode_grup" class="form-control num_only" maxlength="2" value="" />
                </div>
            </div>

            <div class="form-group">
                <label for="kode_sub" class="col-lg-3 control-label">Kode Perkiraan Sub</label>
                <div class="col-lg-1">
                    <input required type="text" onchange="cek_grup_sub();" name="kode_sub" id="kode_sub" class="form-control num_only" maxlength="2" value="" />
                </div>
            </div>


            <div class="form-group admin-form">
                <label for="inputPassword" class="col-lg-3 control-label">Grup</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="location" name="nama_grup" style="cursor:pointer;">
                                        <option value="AKTIVA"> AKTIVA </option>
                                        <option value="KEWAJIBAN"> PASIVA (KEWAJIBAN) </option>
                                        <option value="MODAL"> PASIVA MODAL </option>
                                        <option value="PENDAPATAN"> PENDAPATAN </option>
                                        <option value="BEBAN"> BEBAN </option>
                                    </select>
                                    <i style="z-index:99;" class="arrow"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="sub_grup1" class="col-lg-3 control-label">Sub Grup 1</label>
                <div class="col-lg-5">
                    <input type="text" name="sub_grup1" id="sub_grup1" class="form-control" value="" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="sub_grup2" class="col-lg-3 control-label">Sub Grup 2</label>
                <div class="col-lg-5">
                    <input type="text" name="sub_grup2" id="sub_grup2" class="form-control" value="" />
                </div>
            </div>

            <div class="form-group">
                <label for="sub_grup3" class="col-lg-3 control-label">Sub Grup 3</label>
                <div class="col-lg-5">
                    <input type="text" name="sub_grup3" id="sub_grup3" class="form-control" value="" />
                </div>
            </div>

            <hr style="margin-bottom: 10px;">

            <center>

                <input id="simpan" type="submit" name="simpan" value="SIMPAN" class="btn btn-primary btn-gradient dark" style="font-weight:bold;" />
                &nbsp;
                <input type="reset" onclick="$('#kode_grup').val(''); cek_grup_sub();" value="BATAL" class="btn btn-default btn-gradient dark" style="font-weight:bold;" />
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
                    <table class="table table-striped table-bordered table-hover" id="datatable2" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle;">KODE GRUP</th>
                                <th style="vertical-align: middle;">KODE SUB</th>
                                <th style="vertical-align: middle;">GRUP</th>
                                <th style="vertical-align: middle;">SUB GRUP 1</th>
                                <th style="vertical-align: middle;">SUB GRUP 2</th>
                                <th style="vertical-align: middle;">SUB GRUP 3</th>
                                <th style="vertical-align: middle;">UBAH</th>
                                <th style="vertical-align: middle;">HAPUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?PHP 
                                foreach ($dt as $key => $row) {
                            ?>
                            <tr style="cursor:pointer;">
                                <td><?=$row->KP_GRUP;?></td>
                                <td><?=$row->KP_SUB;?></td>
                                <td><?=$row->GRUP;?></td>
                                <td><?=$row->SUB_GRUP1;?></td>
                                <td><?=$row->SUB_GRUP2;?></td>
                                <td><?=$row->SUB_GRUP3;?></td>
                                
                                <td>
                                    <center> 
                                        <a href="#openModal" onclick="get_grup(<?=$row->ID;?>);" style="height: 30px; width: 100px;" class="btn btn-sm btn-warning btn-block"><i class="fa fa-edit"></i> Ubah</a> 
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
            <button class="btn btn-default btn-gradient dark" style="visibility:hidden;">
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

<!-- EDIT MODAL -->

<div id="openModal" class="modalDialogs">
    <div>
        

        <div class="modals_head">
            <span>
                <h3>Edit Grup</h3>
            </span>

            <span>
                <!-- <a href="#close" title="Close" class="closeit">X</a> -->
                <a href="#close" id="closeit" style="float:right;" class="close-button" title="Tutup"><img src="<?=base_url();?>images/close.png" width="20px" height="20px" style="margin-top: -40px;"></a>
            </span>  
        </div>

            <form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>">

                <div class="form-group">
                    <label for="kode_grup_ed" class="col-lg-4 control-label">Kode Perkiraan Grup</label>
                    <div class="col-lg-2">
                        <input readonly type="text" name="kode_grup_ed" id="kode_grup_ed" class="form-control num_only" maxlength="2" value="" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="kode_sub_ed" class="col-lg-4 control-label">Kode Perkiraan Sub</label>
                    <div class="col-lg-2">
                        <input readonly type="text" name="kode_sub_ed" id="kode_sub_ed" class="form-control num_only" maxlength="2" value="" />                         
                    </div>
                </div>


                <div class="form-group admin-form">
                    <label for="nama_grup_ed" class="col-lg-4 control-label">Grup</label>
                    <div class="col-lg-6">
                        <div class="admin-form">
                            <div>
                                <div class="smart-widget sm-right smr-50">
                                    <label class="field select">
                                        <select id="nama_grup_ed" name="nama_grup_ed" style="cursor:pointer;">
                                            <option value="AKTIVA"> AKTIVA </option>
                                            <option value="KEWAJIBAN"> PASIVA (KEWAJIBAN) </option>
                                            <option value="MODAL"> PASIVA MODAL </option>
                                            <option value="PENDAPATAN"> PENDAPATAN </option>
                                            <option value="BEBAN"> BEBAN </option>
                                        </select>
                                        <i style="z-index:99;" class="arrow"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="sub_grup1_ed" class="col-lg-4 control-label">Sub Grup 1</label>
                    <div class="col-lg-7">
                        <input type="text" name="sub_grup1_ed" id="sub_grup1_ed" class="form-control" value="" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="sub_grup2_ed" class="col-lg-4 control-label">Sub Grup 2</label>
                    <div class="col-lg-7">
                        <input type="text" name="sub_grup2_ed" id="sub_grup2_ed" class="form-control" value="" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="sub_grup3_ed" class="col-lg-4 control-label">Sub Grup 3</label>
                    <div class="col-lg-7">
                        <input type="text" name="sub_grup3_ed" id="sub_grup3_ed" class="form-control" value="" />
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