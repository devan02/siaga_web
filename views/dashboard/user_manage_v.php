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

    <?php
        if($edit == 1 && $level == "ADMIN"){
    ?>
        var a = $('#level_akun2').val();
        $('#level_akun').val(a);
    <?php
        }
    ?>

    $('#btn_peg').click(function(){
        get_popup_barang();
        ajax_barang();
    });


});


function get_popup_barang(){
    var base_url = '<?php echo base_url(); ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input type="text" name="search_koang" id="search_koang" class="form-control" value="" placeholder="Cari Barang...">'+
                '    <div class="table-responsive">'+
                '            <table class="table table-hover" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>NO</th>'+
                '                        <th style="white-space:nowrap; text-align:center;">NIP</th>'+
                '                        <th>NAMA PEGAWAI</th>'+
                '                    </tr>'+
                '                </thead>'+
                '                <tbody>'+
            
                '                </tbody>'+
                '            </table>'+
                '        </div>'+
                '    </div>'+
                '</div>'+
            '</div>';
    $('body').append($isi);

    $('#pojok_koang').click(function(){
        $('#popup_koang').css('display','none');
        $('#popup_koang').hide();
    });

    $('#popup_koang').css('display','block');
    $('#popup_koang').show();
}

function ajax_barang(){
    var keyword = $('#search_koang').val();
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/user_manage_c/get_pegawai',
        type : "POST",
        dataType : "json",
        data : {
            keyword : keyword,
        },
        success : function(result){
            var isine = '';
            var no = 0;
            $.each(result,function(i,res){
                no++;
                isine += '<tr>'+
                            '<td align="center">'+no+'</td>'+
                            '<td align="center"><a href="javascript:void(0);" onclick=get_kode_barang('+res.ID+');>'+res.NIP+'</a></td>'+
                            '<td>'+res.NAMA+'</td>'+
                        '</tr>';
            });
            $('#tes5 tbody').html(isine); 
            $('#search_koang').off('keyup').keyup(function(){
                ajax_barang();
            });
        }
    });
}

function get_kode_barang(id){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/user_manage_c/get_pegawai_by_id',
        data : {id:id},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){
            $('#nama_pegawai_cari').val(res.NAMA);
            $('#id_peg').val(res.ID);
        }
    });

    $('#search_koang').val("");
    $('#popup_koang').css('display','none');
    $('#popup_koang').hide();
}


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

<?PHP if($err == 1){?>
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-warning pr10"></i>
    <strong>Maaf, Password yang anda masukkan tidak sama </strong>
</div>
<?PHP } ?>

<div class="panel">    
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body">

        <form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>">

            <div class="form-group data_baru">
                <label for="bagian" class="col-lg-3 control-label">Cari Pegawai</label>
                <div class="col-lg-5">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50" id='basic-modal'>
                                <label class="field">
                                    <input type="text" name="nama_pegawai_cari" id="nama_pegawai_cari" class="gui-input" value="<?=$nama_pegawai_cari;?>" required />
                                    <input type="hidden" name="id_peg" id="id_peg" value="<?=$id_peg;?>" required />
                                </label>
                                  <a id="btn_peg" class="button">
                                      <i class="fa fa-search"></i>
                                  </a>

                            </div>
                        </div>
                    </div>
                </div>

                <input type="submit" name="filter" value="CARI PEGAWAI" class="btn btn-default btn-gradient dark" style="font-weight: bold; height: 42px; margin-left: 10px;" />
            </div>

        </form>

        <?PHP if($edit != 1){ ?>
        <div style="border-top: 1px dashed #ccc; margin-bottom: 14px; margin-top: 20px;"></div>

        <form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>" enctype="multipart/form-data">

            <div class="form-group">
                <label class="col-lg-3 control-label">
                    
                </label>
                <div class="col-lg-3">
                   <img class="profile-pic" src="<?=base_url();?>files/user/default.png" />
                </div>
                
            </div>


            <div class="form-group">
                <label for="" class="col-lg-3 control-label">NIP</label>
                <div class="col-lg-3">
                    <input type="text" readonly name="nip_fake" id="nip_fake" class="form-control" value="" />
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-lg-3 control-label">Nama</label>
                <div class="col-lg-5">
                    <input type="text" readonly name="nama_pegawai_fake" id="nama_pegawai_fake" class="form-control" value="" />
                </div>
            </div>


            <div class="form-group">
                <label for="" class="col-lg-3 control-label">Username</label>
                <div class="col-lg-5">
                    <input type="text" readonly name="username_fake" id="username_fake" class="form-control" value="" />
                </div>
            </div>


            <div class="form-group">
                <label for="" class="col-lg-3 control-label">Password</label>
                <div class="col-lg-5">
                    <input type="text" readonly name="password_fake" id="password_fake" class="form-control" value="" />
                </div>
            </div>
           

            <div class="form-group">
                <label for="" class="col-lg-3 control-label">Status Akun</label>
                <div class="col-lg-5">
                    <input type="text" readonly name="sts_fake" id="sts_fake" class="form-control" value="" />
                </div>
            </div>
                        
         </form>

        <?PHP } ?>


        <?PHP if($edit == 1){?>

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
                    <input type="hidden" name="id_peg2" id="id_peg2" value="<?=$peg_edit->ID;?>" required />

                    <?PHP if($peg_edit->PASSWORD == ""){?>
                        <input type="hidden" name="edit_pass" id="edit_pass" value="1" />
                    <?PHP } else { ?>
                        <input type="hidden" name="edit_pass" id="edit_pass" value="" />
                    <?PHP } ?>
                </div>
                
            </div>


            <div class="form-group">
                <label for="nip" class="col-lg-3 control-label">NIP</label>
                <div class="col-lg-3">
                    <input type="text" readonly name="nip" id="nip" class="form-control" value="<?=$peg_edit->NIP;?>" />
                </div>
            </div>

            <div class="form-group">
                <label for="nama_pegawai" class="col-lg-3 control-label">Nama</label>
                <div class="col-lg-5">
                    <input type="text" readonly name="nama_pegawai" id="nama_pegawai" class="form-control" value="<?=$peg_edit->NAMA;?>" />
                </div>
            </div>


            <div class="form-group">
                <label for="username" class="col-lg-3 control-label">Username</label>
                <div class="col-lg-5">
                    <input type="text" required name="username" id="username" class="form-control" onchange="cek_username(this.value);" value="<?=$peg_edit->USERNAME;?>" />
                    <span id="warning-username" class="help-block mt5" style="color: red; display:none;"><i class="fa fa-warning"></i> Username telah dipakai pengguna lain</span>
                    <span id="sukses-username" class="help-block mt5" style="color: green; display:none;"><i class="fa fa-check"></i> Username dapat digunakan</span>
                </div>
            </div>

            <?PHP if($peg_edit->PASSWORD == ""){?>

            <div class="form-group">
                <label for="pass1" class="col-lg-3 control-label">Password</label>
                <div class="col-lg-5">
                    <input type="password" required name="pass1" id="pass1" class="form-control" value="" />
                </div>
            </div>

            <div class="form-group">
                <label for="pass2" class="col-lg-3 control-label">Verify Password</label>
                <div class="col-lg-5">
                    <input type="password" required name="pass2" id="pass2" class="form-control" value="" />
                </div>
            </div>

            <?PHP } else { ?>
            <div class="form-group" id="ganti">
                <label for="ganti" class="col-lg-3 control-label">Password</label>
                <div class="col-lg-5" style="margin-top: 9px;">
                    <a href="javascript:;" onclick="show_head_pass();"> Ganti Password</a>
                </div>
            </div>

            <div id="head_pass1" class="form-group" style="display:none;">
                <label for="pass1" class="col-lg-3 control-label">Password Baru</label>
                <div class="col-lg-5">
                    <input type="password" required name="pass1" id="pass1" class="form-control" value="-----------" />
                </div>
            </div>

            <div id="head_pass2" class="form-group" style="display:none;">
                <label for="pass2" class="col-lg-3 control-label">Verify Password</label>
                <div class="col-lg-5">
                    <input type="password" required name="pass2" id="pass2" class="form-control" value="-----------" />
                </div>
            </div>
            
            <?PHP } ?>

            <?PHP if($level == "ADMIN"){ ?>

            <input type="hidden" id="level_akun2" value="<?=$peg_edit->LEVEL;?>"/>
            <div class="form-group admin-form">
                <label for="inputPassword" class="col-lg-3 control-label" id="warna_bagian">Level Pengguna</label>
                <div class="col-lg-5">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="level_akun" name="level_akun" style="cursor:pointer;">
                                        <option value=""> User </option>
                                        <option value="KABAG"> Kabag </option>
                                        <option value="ADMIN"> Admin </option>
                                    </select>
                                    <i style="z-index:99;" class="arrow"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?PHP } else { 
                echo "<input type='hidden' name='level_akun' value='$peg_edit->LEVEL' />";
            }?>

            <div class="form-group">
                <label for="disabledInput" class="col-lg-3 control-label">Status Akun</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">

                        <?PHP if($peg_edit->STATUS == "1"){ ?>

                        <input type="radio" id="sts1" name="sts" checked="" value="1">
                        <label for="sts1" style="margin-right: 15px; padding-left: 25px;">Aktif</label>

                        <input type="radio" id="sts2" name="sts" value="0">
                        <label for="sts2" style="margin-right: 15px; padding-left: 25px;">Non Aktif</label>

                        <span class="help-block mt5"><i class="fa fa-bell"></i> Jika status non aktif, maka pengguna tidak dapat login</span>

                        <?PHP } else { ?>

                        <input type="radio" id="sts1" name="sts" value="1">
                        <label for="sts1" style="margin-right: 15px; padding-left: 25px;">Aktif</label>

                        <input type="radio" id="sts2" name="sts" checked=""  value="0">
                        <label for="sts2" style="margin-right: 15px; padding-left: 25px;">Non Aktif</label>

                        <span class="help-block mt5"><i class="fa fa-bell"></i> Jika status non aktif, maka pengguna tidak dapat login</span>

                        <?PHP } ?>
                    </div>
                </div>
            </div>


            

            <div style="border-top: 1px dashed #ccc; margin-bottom: 14px; margin-top: 20px;"></div>
            
            <center>

                <input type="submit" id="simpan" name="simpan" value="SIMPAN" class="btn btn-primary btn-gradient dark" style="font-weight:bold;" />
                &nbsp;
                <?PHP if($peg_edit->PASSWORD == ""){?>
                    <input type="reset" value="BATAL" class="btn btn-default btn-gradient dark" style="font-weight:bold;"/>
                <?PHP } else { ?>
                    <input type="reset" value="BATAL" class="btn btn-default btn-gradient dark" style="font-weight:bold;" onclick="hide_head_pass();"/>
                <?PHP } ?>
            </center>
                        
         </form>   

         <?PHP } ?>
    </div>


<!-- modal content -->
<div id="basic-modal-content">
    <table class="table table-bordered table-hover" id="datatable_popup" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th style="vertical-align: middle;">NIP</th>
                <th style="vertical-align: middle;">NAMA PEGAWAI</th>
        </thead>

        <tbody>
            <?PHP 
                foreach ($pegawai as $key => $row) {
            ?>
            <tr style="cursor:pointer;" onclick="$('.simplemodal-close').click(); $('#nama_pegawai_cari').val('<?=$row->NAMA;?>'); $('#id_peg').val('<?=$row->ID;?>');">
                <td><?=$row->NIP;?></td>
                <td><?=$row->NAMA;?></td>
            </tr>
            <?PHP } ?>
        </tbody>
    </table>
</div>

<!-- preload the images -->
<div style='display:none'>
    <img src='<?=base_url();?>material/modal/img/basic/x.png' alt='' />
</div>

<script type="text/javascript">

  function cek_username (val) {

    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/user_manage_c/cek_username',
        data : {val:val},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){
            if(res == 1 || res == "1"){
                $("#sukses-username").hide();
                $("#warning-username").show();    
                document.getElementById("simpan").disabled = true;             
            } else {
                $("#warning-username").hide();  
                $("#sukses-username").show(); 
                document.getElementById("simpan").disabled = false;                   
            }
        }
    });

  }

  function show_head_pass () {

      $("#ganti").hide();
      $("#head_pass1").fadeIn('slow');
      $("#head_pass2").fadeIn('slow');
      $("#edit_pass").val(1);
      
  }

  function hide_head_pass () {   
      
      $("#head_pass1").hide();      
      $("#head_pass2").hide();
      $("#ganti").show();   
      $("#edit_pass").val('');   
  }

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