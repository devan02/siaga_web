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

    $.no_rab({
        url : '<?php echo base_url(); ?>dashboard/master_spk_c/get_norab',
        result : '#no_rab',
    });

    $("input[name='jenis_adendum']").click(function(){
        var jenis_adendum = $("input[name='jenis_adendum']:checked").val();
        if(jenis_adendum == "nilai"){
            $('#waktu_adendum_head').hide();
            $('#nilai_adendum_head').show(); 
            $('#nilai_adendum').val('');       
            $('#daterangepicker2').val('');       
        } else {
            $('#nilai_adendum_head').hide();
            $('#waktu_adendum_head').show();  
            $('#nilai_adendum').val('');       
            $('#daterangepicker2').val('');  
        }
    });

    var glower = $('#nomor_spk_adendum');
    window.setInterval(function() {  
        glower.toggleClass('active');
    }, 1000);

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

function get_selisih_tgl(){

    var biaya_kontrak_txt = $('#biaya_kontrak').val();
    var tgl = $('#daterangepicker1').val();

    if(biaya_kontrak_txt == "" || biaya_kontrak_txt == null){
        alert('Mohon isikan dulu nilai biaya Kontrak');
    } else if(tgl == "" || tgl == null){
        alert('Mohon isikan dulu jangka waktu SPK');
    } else {
        
        $.ajax({
            url : '<?php echo base_url(); ?>dashboard/master_spk_c/get_selisih_tgl',
            data : {tgl:tgl},
            type : "POST",
            dataType : "json",
            async : false,
            success : function(res){

              var biaya_kontrak = $('#biaya_kontrak').val().split(',').join('');
              var hitung_denda  = (biaya_kontrak * 1) / 1000 ;
              hitung_denda = hitung_denda * res;

              if(res <= 0){
                $('#notif_sanksi').hide();
                $('#notif_gak_sanksi').show();
              } else {
               $('#notif_gak_sanksi').hide();
               $('#notif_sanksi').show();

               var sanksi = document.getElementById('keterangan_pesan');
               sanksi.innerHTML = "<b>Terlambat "+res+" hari. Terkena denda sebesar Rp. "+NumberToMoney(hitung_denda)+"</b>";
              }

              $('body,html').animate({
                    scrollTop : 0 // Scroll to top of body
              }, 500);

            }
        });
    }
}

function cek_spk(){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/master_spk_c/cek_spk',
        data : {
            nomor_spk : $('#nomor_spk').val(),
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

function get_data_spk(id){

    reset_form();
    $('#reset').click();
    $('#reset_ubah').click();

    $('#simpan').hide();
    $('#reset').hide();

    $('#simpan_ubah').show();
    $('#reset_ubah').show();

     

    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/master_spk_c/get_data_spk',
        data : {
            id : id,
        },
        type : "POST",
        dataType : "json",
        async : false,
        success : function(result){

            res = result['data'];
            cek_rab = result['cek_rab'];

            if(cek_rab > 0){
                $('#no_rab').attr('readonly', true);
                $('#norab').hide();
                $('#notif_pakai').show();
            } else {
                $('#no_rab').attr('readonly', false); 
                $('#norab').show();
                $('#notif_pakai').hide();
            }

            $('#nomor_spk').attr('readonly', true);

            $("#id_spk").val(res.ID);
            $("#nomor_spk").val(res.NO_SPK);
            $("#no_rab").val(res.NO_RAB);
            $("#kepada").val(res.KEPADA);
            $("#uraian").val(res.URAIAN_PEKERJAAN);
            $("#dasar").val(res.DASAR_KERJA);
            $('#biaya_tawar').val(NumberToMoney(res.BIAYA_PENAWARAN).split('.00').join('') );
            $('#biaya_kontrak').val(NumberToMoney(res.BIAYA_KONTRAK).split('.00').join('') );
            $("#beban_biaya").val(res.BEBAN_BIAYA);
            $("#pembayaran").val(res.PEMBAYARAN);
            $("#daterangepicker1").val(res.TGL_AWAL+" sampai "+res.TGL_AKHIR);
            $("#sanksi2").val(res.SANKSI);
            $("#selisihan").val(res.SELISIH);

            $("#kepada_ad").val(res.KEPADA_AD);
            $("#uraian_ad").val(res.URAIAN_PEKERJAAN_AD);
            $("#dasar_ad").val(res.DASAR_KERJA_AD);
            $("#beban_biaya_ad").val(res.BEBAN_BIAYA_AD);
            $("#pembayaran_ad").val(res.PEMBAYARAN_AD);
            $("#sanksi2_ad").val(res.SANKSI_AD);
            $("#selisihan_ad").val(res.SELISIH_AD);

            if(res.ADENDUM == "" || res.ADENDUM == null){

               $('.adendum').show(); 

            } else {
                $('#nomor_spk_adendum').val(res.ADENDUM);

                if(res.JENIS_ADENDUM == "nilai"){
                    $('#nilai_adendum').val(NumberToMoney(res.NILAI_ADENDUM).split('.00').join('') );
                    document.getElementById("ad_nilai").checked = true;
                    document.getElementById("ad_waktu").checked = false;
                    $('#waktu_adendum_head').hide();
                    $('#nilai_adendum_head').show();                    
                } else if (res.JENIS_ADENDUM == "waktu") {
                    $('#daterangepicker2').val(res.TGL_ADENDUM);
                    document.getElementById("ad_waktu").checked = true;
                    document.getElementById("ad_nilai").checked = false;
                    $('#nilai_adendum_head').hide();
                    $('#waktu_adendum_head').show();
                }

                $('.adendum').show();
            }

            if(res.SELESAI == "1" || res.SELESAI == 1){
                document.getElementById("ad_selesai1").checked = true;
                document.getElementById("ad_selesai2").checked = false;  
            } else {
                document.getElementById("ad_selesai2").checked = true;
                document.getElementById("ad_selesai1").checked = false;
                get_selisih_tgl();   
            }

            

            $('body,html').animate({
                scrollTop : 0                       // Scroll to top of body
            }, 500);

        }
    });
}

function reset_form(){
    $('body,html').animate({
                scrollTop : 0                       // Scroll to top of body
    }, 500);

    $('#waktu_adendum_head').hide();
    $('#nilai_adendum_head').hide();   
    
    $('#nomor_spk').attr('readonly', false);
    $('#simpan_ubah').hide();
    $('#reset_ubah').hide();
    $('#notif_sanksi').hide();
    $('#notif_gak_sanksi').hide();

    $('#adendum_head_show').hide();

    $('#simpan').show();
    $('#reset').show();
}

function add_adendum(){
    $('body,html').animate({
                scrollTop : 0                       // Scroll to top of body
    }, 500);

    $('.adendum').show();
    $('#nomor_spk_adendum').focus();
}

function add_adendum_show(){
    $('#adendum_head_show').show();
    $('#adendum_head_show_btn').click();
    $('body,html').animate({
                scrollTop : 0                       // Scroll to top of body
    }, 500);

    $('#nomor_spk_adendum').focus()
    
}

</script>

<div id="notif_pakai" class="alert alert-warning alert-dismissable" style="display:none;">
    <i class="fa fa-danger pr10"></i>
    <strong>Perhatian!
    <span> No. RAB dalam SPK ini telah terpakai untuk Realisasi Anggaran </span>
    </strong>
</div>


<div id="notif_sanksi" class="alert alert-danger alert-dismissable" style="display:none;">
    <i class="fa fa-danger pr10"></i>
    <strong>Perhatian!</strong>
    <span id="keterangan_pesan"></span>
</div>

<div id="notif_gak_sanksi" class="alert alert-success alert-dismissable" style="display:none;">
    <i class="fa fa-danger pr10"></i>
    <strong>Aman!</strong>
    <span id="keterangan_pesan_aman"> <b> Tidak terkena sanksi karena belum melewati batas waktu </b></span>
</div>

<?PHP if($msg == 5){ ?> 
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-danger pr10"></i>
    <strong>Perhatian!  Nomor SPK tidak dapat dihapus karena telah terpakai untuk realisasi anggaran</strong>
</div>
<?PHP } ?>

<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body">

        <form id="form_spk" class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>">
            <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="nomor_spk" class="col-lg-3 control-label">Nomor SPK</label>
                    <div class="col-lg-6">
                        <input onchange="cek_spk();" onpaste="cek_spk();" type="text" required name="nomor_spk" id="nomor_spk" class="form-control" value="" />
                        <input type="hidden" required name="id_spk" id="id_spk" class="form-control" value="" />
                        <span id="notif_pakai" class="help-block mt5" style="color:red; display:none;"><i class="fa fa-bell"></i> Nomor SPK diatas telah terpakai !</span>
                    </div>
                </div>

                <div class="form-group data_baru">
                    <label for="no_rab" class="col-lg-3 control-label">NO. RAB</label>
                    <div class="col-lg-6">
                        <div class="admin-form">
                            <div>
                                <div class="smart-widget sm-right smr-50">
                                    <label class="field">
                                        <input type="text" name="no_rab" id="no_rab" class="gui-input" value="" />
                                    </label>
                                    <a class="button" id="norab">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="disabledInput" class="col-lg-3 control-label">Pekerjaan Selesai ?</label>
                    <div class="col-lg-8" style="margin-top: 8px;">
                        <div class="radio-custom radio-primary mb5">
                            <input type="radio" id="ad_selesai1" name="selesai" value="1">
                            <label for="ad_selesai1" style="margin-right: 15px; padding-left: 25px;">Ya</label>

                            <input type="radio" id="ad_selesai2" name="selesai" value="0" checked>
                            <label for="ad_selesai2" style="margin-right: 15px; padding-left: 25px;">Belum</label>
                        </div>
                    </div>
                </div>

            </div>
            </div>

            <hr style="margin-bottom: 25px; margin-top: 5px;">

            <div class="col-md-12">
                <div class="tab-block mb25">
                    <ul class="nav nav-tabs nav-tabs-left">
                        <li class="active">
                            <a href="#tab1" data-toggle="tab">SPK</a>
                        </li>
                        <li style="display:none;" id="adendum_head_show">
                            <a href="#tab2" id="adendum_head_show_btn" data-toggle="tab">SPK Adendum</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane active">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kepada" class="col-lg-3 control-label">Kepada</label>
                                    <div class="col-lg-8">
                                        <input type="text" required name="kepada" id="kepada" class="form-control" value="" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="uraian" class="col-lg-3 control-label">Uraian Pekerjaan</label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" id="uraian" name="uraian" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="dasar" class="col-lg-3 control-label">Dasar Kerja</label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" id="dasar" name="dasar" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="biaya_tawar" class="col-lg-3 control-label">Biaya Penawaran</label>
                                    <div class="col-lg-8">
                                        <input onkeyup="FormatCurrency(this);" type="text" required name="biaya_tawar" id="biaya_tawar" class="form-control num_only" value="" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="biaya_kontrak" class="col-lg-3 control-label">Biaya Kontrak</label>
                                    <div class="col-lg-8">
                                        <input onkeyup="FormatCurrency(this);" type="text" required name="biaya_kontrak" id="biaya_kontrak" class="form-control num_only" value="" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="beban_biaya" class="col-lg-3 control-label">Beban Biaya</label>
                                    <div class="col-lg-8">
                                        <input type="text" required name="beban_biaya" id="beban_biaya" class="form-control" value="" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pembayaran" class="col-lg-3 control-label">Pembayaran</label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" id="pembayaran" name="pembayaran" rows="7">Akan dilaksanakan melalui : Kas Perusahaan Daerah Air Minum Tirta Patriot setelah pengiriman selesai dilaksanakan seluruhnya yang dinyatakan dengan Berita Acara Serah Terima Pemeriksaan dan Penerimaan Barang dengan cara pembayaran tunai.</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">                    

                                <div class="form-group">
                                    <label for="daterangepicker1" class="col-lg-3 control-label">Jangka Pekerjaan</label>
                                    <div class="col-lg-8">
                                        <input style="cursor:pointer;" readonly type="text" class="form-control pull-right" name="jangka" id="daterangepicker1">
                                        <span class="help-block mt5"><i class="fa fa-bell"></i> Klik field diatas untuk mengatur jarak tanggal</span>
                                        <a href="javascript:;" onclick="get_selisih_tgl();" class="btn btn-danger btn-gradient dark" style="font-weight:bold;"> CEK SANKSI </a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="sanksi" class="col-lg-3 control-label">Sanksi - sanksi</label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" id="sanksi2" name="sanksi2" rows="7">Apabila pelaksanaan pekerjaan tersebut di atas tidak diselesaikan pada waktunya, maka pihak penyedia jasa akan dikenakan denda 1% (satu permil) dari jumlah harga borongan untuk setiap hari keterlambatan dan maksimum 5% (lima persen).</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="selisihan" class="col-lg-3 control-label">Perselisihan</label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" id="selisihan" name="selisihan" rows="3">Jika perselisihan yang bersifat umum / hukum akan diselesaikan melalui Pengadilan Negeri Bekasi.</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div id="tab2" class="tab-pane">
                        <div class="form-group adendum">
                            <label for="nomor_spk" class="col-lg-3 control-label">Nomor SPK Adendum</label>
                            <div class="col-lg-6">
                                <input  type="text" name="nomor_spk_adendum" id="nomor_spk_adendum" class="form-control " value="" />
                                <span class="help-block mt5"><i class="fa fa-bell"></i> Tambahkan nomor SPK Adendum pada field diatas</span>
                                <span id="notif_pakai_adendum" class="help-block mt5" style="color:red; display:none;"><i class="fa fa-bell"></i> Nomor SPK Adendum diatas telah terpakai !</span>
                            </div>
                        </div>

                        <div class="form-group adendum">
                            <label for="disabledInput" class="col-lg-3 control-label">Jenis Adendum</label>
                            <div class="col-lg-8" style="margin-top: 8px;">
                                <div class="radio-custom radio-primary mb5">
                                    <input type="radio" id="ad_nilai" name="jenis_adendum" value="nilai">
                                    <label for="ad_nilai" style="margin-right: 15px; padding-left: 25px;">Nilai / Biaya Kontrak</label>

                                    <input type="radio" id="ad_waktu" name="jenis_adendum" value="waktu">
                                    <label for="ad_waktu" style="margin-right: 15px; padding-left: 25px;">Waktu</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group adendum2" id="nilai_adendum_head" style="display:none;">
                            <label for="nilai_adendum" class="col-lg-3 control-label">Nilai Adendum</label>
                            <div class="col-lg-5">
                                <input onkeyup="FormatCurrency(this);" type="text"  name="nilai_adendum" id="nilai_adendum" class="form-control num_only" value="0" />
                            </div>
                        </div>

                        <div class="form-group adendum2" id="waktu_adendum_head" style="display:none;">
                            <label for="daterangepicker2" class="col-lg-3 control-label">Waktu Adendum</label>
                            <div class="col-lg-5">
                                <input style="cursor:pointer;" readonly type="text" class="form-control pull-right" name="waktu_adendum" id="daterangepicker2">
                                <span class="help-block mt5"><i class="fa fa-bell"></i> Klik field diatas untuk mengatur jarak tanggal</span>
                            </div>
                        </div>

                        <hr>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kepada_ad" class="col-lg-3 control-label">Kepada</label>
                                <div class="col-lg-8">
                                    <input type="text" name="kepada_ad" id="kepada_ad" class="form-control" value="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="uraian_ad" class="col-lg-3 control-label">Uraian Pekerjaan</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" id="uraian_ad" name="uraian_ad" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="dasar_ad" class="col-lg-3 control-label">Dasar Kerja</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" id="dasar_ad" name="dasar_ad" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="beban_biaya_ad" class="col-lg-3 control-label">Beban Biaya</label>
                                <div class="col-lg-8">
                                    <input type="text" name="beban_biaya_ad" id="beban_biaya_ad" class="form-control" value="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pembayaran_ad" class="col-lg-3 control-label">Pembayaran</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" id="pembayaran_ad" name="pembayaran_ad" rows="7">Akan dilaksanakan melalui : Kas Perusahaan Daerah Air Minum Tirta Patriot setelah pengiriman selesai dilaksanakan seluruhnya yang dinyatakan dengan Berita Acara Serah Terima Pemeriksaan dan Penerimaan Barang dengan cara pembayaran tunai.</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">                           

                            <div class="form-group">
                                <label for="sanksi2_ad" class="col-lg-3 control-label">Sanksi - sanksi</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" id="sanksi2_ad" name="sanksi2_ad" rows="7">Apabila pelaksanaan pekerjaan tersebut di atas tidak diselesaikan pada waktunya, maka pihak penyedia jasa akan dikenakan denda 1% (satu permil) dari jumlah harga borongan untuk setiap hari keterlambatan dan maksimum 5% (lima persen).</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="selisihan_ad" class="col-lg-3 control-label">Perselisihan</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" id="selisihan_ad" name="selisihan_ad" rows="3">Jika perselisihan yang bersifat umum / hukum akan diselesaikan melalui Pengadilan Negeri Bekasi.</textarea>
                                </div>
                            </div>
                        </div>
                        

                        </div>
                    </div>
                </div>
            </div>
            

            <hr style="margin-bottom: 10px;">
            <center>

                <input id="simpan" type="submit" name="simpan" value="SIMPAN" class="btn btn-primary btn-gradient dark" style="font-weight:bold;" />
                <input id="simpan_ubah" type="submit" name="ubah" value="SIMPAN PERUBAHAN" class="btn btn-primary btn-gradient dark" style="font-weight:bold; display:none;" />
                &nbsp;
                <input onclick="reset_form();" id="reset" type="reset" value="BATAL" class="btn btn-default btn-gradient dark" style="font-weight:bold;" />
                <input onclick="reset_form();" id="reset_ubah" type="reset" value="BATAL UBAH" class="btn btn-default btn-gradient dark" style="font-weight:bold; display:none;" />
                &nbsp;
                <a href="javascript:;" onclick="add_adendum_show();" class="btn btn-info btn-gradient dark" style="font-weight:bold;"><i class="fa fa-plus"></i> Adendum</a>
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
                        <span class="glyphicon glyphicon-tasks"></span>List Data SPK</div>
                </div>
                <div class="panel-body pn">
                    <table class="table table-bordered" id="datatable2" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle; text-align: center;">#</th>
                                <th style="vertical-align: middle; text-align: center;">NO SPK</th>
                                <th style="vertical-align: middle; text-align: center;">NO RAB</th>
                                <th style="vertical-align: middle; text-align: center;">KEPADA</th>
                                <th style="vertical-align: middle; text-align: center;">BIAYA KONTRAK</th>
                                <th style="vertical-align: middle; text-align: center;">ADENDUM</th>
                                <th style="vertical-align: middle; text-align: center;">UBAH</th>
                                <th style="vertical-align: middle; text-align: center;">HAPUS</th>
                        </thead>
                        <tbody>
                            <?PHP 
                                $no = 0;
                                foreach ($dt as $key => $row) {
                                $no++;

                                $tgl_akhir      = date('Y-m-d', strtotime($row->TGL_AKHIR));

                                if($row->TGL_ADENDUM != "" || $row->TGL_ADENDUM != null){
                                   $tgl_akhir      = date('Y-m-d', strtotime($row->TGL_ADENDUM)); 
                                }

                                $tgl_akhir_now  = date('Y-m-d');

                                $pecah1 = explode("-", $tgl_akhir);
                                $date1 = $pecah1[2];
                                $month1 = $pecah1[1];
                                $year1 = $pecah1[0];

                                // memecah string tanggal akhir untuk mendapatkan
                                // tanggal, bulan, tahun
                                $pecah2 = explode("-", $tgl_akhir_now);
                                $date2 = $pecah2[2];
                                $month2 = $pecah2[1];
                                $year2 =  $pecah2[0];

                                // mencari total selisih hari dari tanggal awal dan akhir
                                $jd1 = GregorianToJD($month1, $date1, $year1);
                                $jd2 = GregorianToJD($month2, $date2, $year2);

                                $selisih = $jd2 - $jd1;
                                $warna = "";
                                $warna_txt = "";
                                $ket_denda = "";

                                $biaya = $row->BIAYA_KONTRAK;

                                if($row->ADENDUM != ""){
                                    $biaya = $row->NILAI_ADENDUM;
                                }

                                $nilai_sanksi = ($biaya  * 1) / 1000 ;
                                $nilai_sanksi = $nilai_sanksi * $selisih;

                                
                                if($selisih > 0){
                                    $warna = "#fd5c63";
                                    $warna_txt = "#FFF";
                                    $ket_denda = "Terlambat $selisih hari. Terkena denda sebesar Rp ".number_format($nilai_sanksi);
                                } else {
                                    $warna = "#FFF";
                                    $warna_txt = "";
                                    $ket_denda = "Belum jatuh tempo, bebas sanksi";
                                }

                                if($row->SELESAI == 1){
                                    $warna = "#8CD481";
                                    $warna_txt = "#FFF";
                                    $ket_denda = "Pekerjaan telah selesai";
                                }


                            ?>
                            <tr data-placement="top" data-toggle="popover" data-trigger="hover" data-content="<?=$ket_denda;?>" style="font-weight: bold; cursor:pointer; background:<?=$warna;?>; color:<?=$warna_txt;?>;">
                                <td><?=$no;?></td>
                                <td><?=$row->NO_SPK;?></td>
                                <td><?=$row->NO_RAB;?></td>
                                <td><?=$row->KEPADA;?></td>
                                <td>Rp <?=str_replace(',', '.', number_format($row->BIAYA_KONTRAK)) ;?></td>
                                <td>
                                    <?PHP 
                                        if($row->ADENDUM == ""){
                                            echo "-";
                                        } else {
                                            if($row->JENIS_ADENDUM == "nilai"){
                                                echo "Nilai <br> <b> Rp ".str_replace(',', '.', number_format($row->NILAI_ADENDUM))."</b>";
                                            } else {
                                                echo "Waktu <br><b>".$row->TGL_ADENDUM."</b>";
                                            }
                                        }
                                    ?>
                                </td>

                                <td>
                                    <center> 
                                        <button onclick="get_data_spk('<?=$row->ID;?>');" style="height: 30px; width: 60px; font-weight: bold;" class="btn btn-sm btn-warning btn-block" type="button"> Ubah </button> 
                                    </center>
                                </td>

                                <td>
                                    <center> 
                                        <button onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID;?>');" style="height: 30px; width: 60px; font-weight: bold;" class="btn btn-sm btn-danger btn-block" type="button"> Hapus</button> 
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

