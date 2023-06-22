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
            //get_kode_anggaran();
        }
    });
}
</script>

<style type="text/css">
  .prf-left{
       background-color: #f7f7f7;
       border: 1px solid rgba(0, 0, 0, 0.15);
       border-radius: 2px;
       margin-bottom: 20px;
       margin-left: 0;
       min-height: 20px;
       padding-bottom: 18px;
       padding-left: 0;
       padding-top: 18px;
  }

  #demo1:hover{
        cursor: pointer;
  }

  #demo1{
      background-color: #FFF;
  }

  .profile-pic{
        width:100%;
        max-width:185px;
        height:auto;
        background: none repeat scroll 0 0 #fff;
        border: 1px solid #ddd;
        padding: 5px;
    }


</style>
<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body">

    
        <button onclick="window.location='<?=base_url();?>dashboard/data_pegawai_c';" class="btn btn-lg btn-default btn-block" type="button"><i class="fa fa-angle-double-left"></i> Kembali ke Data Pegawai</button>
     

        <div style="border-top: 1px dashed #ccc; margin-bottom: 14px; margin-top: 20px;"></div>

        <form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>" enctype="multipart/form-data">

            <div class="lalalala form-group">
                <label class="col-lg-3 control-label">
                    
                </label>
                <div class="col-lg-3">

                    <?PHP if($peg_edit->FOTO == ""){?>
                        <img class="profile-pic" src="<?=base_url();?>files/user/default.png" />
                    <?PHP } else {?>
                        <img class="profile-pic" src="<?=base_url();?>files/user/<?=$peg_edit->FOTO;?>" />
                    <?PHP } ?>
                    <br>

                    <a href="javascript:;" onclick ="javascript:document.getElementById('imagefile').click();" class="btn btn-dark btn-gradient dark upload-prf" style="width: 80%; margin-top: 10px; font-weight:bold;">Ganti Foto</a>
                    <input id = "imagefile" type="file" style='display:none;' onchange="encodeImageFileAsURL();" name="userfile[]"/>
                    <input type="hidden" id="temp_image" name="temp_image" class="span4" readonly value="">
                    <input type="hidden" name="id_peg2" id="id_peg2" value="<?=$peg_edit->ID;?>" required />
                </div>
                
            </div>


            <div class="form-group">
                <label for="nip" class="col-lg-3 control-label">NIP</label>
                <div class="col-lg-3">
                    <input type="text" required name="nip" id="nip" class="form-control" value="<?=$peg_edit->NIP;?>" />
                </div>
            </div>

            <div class="form-group">
                <label for="nama_pegawai" class="col-lg-3 control-label">Nama Pegawai</label>
                <div class="col-lg-5">
                    <input type="text" required name="nama_pegawai" id="nama_pegawai" class="form-control" value="<?=$peg_edit->NAMA;?>" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="alamat">Alamat</label>
                <div class="col-lg-5">
                    <textarea class="form-control" id="alamat" name="alamat" rows="2"><?=$peg_edit->ALAMAT;?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="kode_pos" class="col-lg-3 control-label">Kode Pos</label>
                <div class="col-lg-2">
                    <input type="text" required name="kode_pos" id="kode_pos" class="form-control" value="<?=$peg_edit->KODE_POS;?>" />
                </div>

                <label for="telpon" class="col-lg-1 control-label" style="text-align:right;">Telepon</label>
                <div class="col-lg-2">
                    <input type="text" required name="telpon" id="telpon" class="form-control" value="<?=$peg_edit->NO_TELP;?>" />
                </div>
            </div>

            <div class="form-group">
                <label for="tmp_lahir" class="col-lg-3 control-label">Tempat Lahir</label>
                <div class="col-lg-5">
                    <input type="text" required name="tmp_lahir" id="tmp_lahir" class="form-control" value="<?=$peg_edit->KOTA_LAHIR;?>" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="datetimepicker2">Tanggal Lahir</label>
                <div class="col-lg-3">
                    <div class="input-group date" id="datetimepicker2">
                        <span class="input-group-addon cursor"><i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" readonly class="form-control"  name="tgl_lahir" id="tgl_lahir" value="<?=$peg_edit->TGL_LAHIR;?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="disabledInput" class="col-lg-3 control-label">Jenis Kelamin</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">

                        <?PHP if($peg_edit->J_KEL == "pria"){ ?>

                        <input type="radio" id="jk1" name="jk" checked="" value="pria">
                        <label for="jk1" style="margin-right: 15px; padding-left: 25px;">Pria</label>

                        <input type="radio" id="jk2" name="jk" value="wanita">
                        <label for="jk2" style="margin-right: 15px; padding-left: 25px;">Wanita</label>

                        <?PHP } else { ?>

                        <input type="radio" id="jk1" name="jk" value="pria">
                        <label for="jk1" style="margin-right: 15px; padding-left: 25px;">Pria</label>

                        <input type="radio" id="jk2" name="jk" checked="" value="wanita">
                        <label for="jk2" style="margin-right: 15px; padding-left: 25px;">Wanita</label>

                        <?PHP } ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="divisi" class="col-lg-3 control-label">Agama</label>
                <div class="col-lg-8">
                    <select id="divisi" name="agama">
                        <option value="islam" <?php if($peg_edit->AGAMA == 'islam'){ echo "selected"; } ?> >Islam</option>
                        <option value="kristen" <?php if($peg_edit->AGAMA == 'kristen'){ echo "selected"; } ?>  >Kristen</option>
                        <option value="katholik" <?php if($peg_edit->AGAMA == 'katholik'){ echo "selected"; } ?> >Katholik</option>
                        <option value="hindu" <?php if($peg_edit->AGAMA == 'hindu'){ echo "selected"; } ?> >Hindu</option>
                        <option value="buddha" <?php if($peg_edit->AGAMA == 'buddha'){ echo "selected"; } ?> >Buddha</option>
                        <option value="konghucu" <?php if($peg_edit->AGAMA == 'konghucu'){ echo "selected"; } ?> >Konghucu</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="jabatan" class="col-lg-3 control-label">Jabatan</label>
                <div class="col-lg-5">
                    <input type="text" required name="jabatan" id="jabatan" class="form-control" value="<?=$peg_edit->JABATAN;?>" />
                </div>
            </div>

            <div class="form-group admin-form">
                <label for="inputPassword" class="col-lg-3 control-label">Bagian</label>
                <div class="col-lg-5">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="departemen2" name="departemen" style="cursor:pointer;" onchange="data_divisi();">
                                        <option value="0">** Pilih Bagian</option>
                                        <?php
                                            $sel = "";
                                            if($departemen != ""){
                                                foreach ($departemen as $value_dep) {                                                    
                                                if($value_dep->ID == $peg_edit->ID_DEPARTEMEN){
                                                    $sel = "selected";
                                                } else {
                                                    $sel = "";
                                                }
                                        ?>
                                        <option <?=$sel;?> value="<?php echo $value_dep->ID; ?>"><?php echo $value_dep->NAMA; ?></option>    
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
                <div class="col-lg-5">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="divisi2" name="divisi" style="cursor:pointer;">
                                    <?PHP 
                                        $sel2 = "";
                                        $get_divisi_peg = $this->model2->get_divisi_peg($peg_edit->ID_DEPARTEMEN); 
                                        foreach ($get_divisi_peg as $key => $div) { 
                                            if($div->ID == $peg_edit->ID_DIVISI){
                                                    $sel = "selected";
                                                } else {
                                                    $sel = "";
                                                }

                                    ?>
                                        <option <?=$sel;?> value="<?php echo $div->ID; ?>"><?php echo $div->NAMA; ?></option>                                                
                                    <?PHP } ?>
                                
                                    </select>
                                    <i style="z-index:99;" class="arrow"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="border-top: 1px dashed #ccc; margin-bottom: 14px; margin-top: 20px;"></div>
            
            <center>

                <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary btn-gradient dark" style="font-weight:bold;" />
                &nbsp;
                <input type="reset" value="BATAL" class="btn btn-default btn-gradient dark" style="font-weight:bold;" />
            </center>
                        
         </form>   
    </div>

<script type="text/javascript">
  function encodeImageFileAsURL(cb) {
    return function(){
        var file = this.files[0];
        var reader  = new FileReader();
        reader.onloadend = function () {
            cb(reader.result);
        }
        reader.readAsDataURL(file);
    }
  }

  $('#imagefile').change(encodeImageFileAsURL(function(base64Img){
    $("#temp_image").val(1);
    $('.lalalala')
      .find('img')
        .attr('src', base64Img);
  }));
</script>