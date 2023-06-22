<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<style>
.hijau { 
    background: #69c76c;
}
.biru { 
    background: #146eb4;
}
.merah{ 
    background: #f88c8c;
} 
.kuning { 
    background: #f8f48c;
}
.orange { 
    background: #faa43d;
}
.ungu { 
    background: #d0006f;
}
.putih { 
    background: #fff;
}
.pink { 
    background: #f8dfc2;
}
.data_notif{
    display: none;
}
</style>

<script>
var ajax = "";
$(document).ready(function(){
    <?php
        if($this->session->flashdata('sukses')){
    ?>
        pesan_sukses();
    <?php
        }
    ?>

    $('#view_bagian').hide();
    $('#view_sub_bagian').hide();
    $('#tidak_ada_data').hide();

    data_divisi();
    get_anggaran();

    $('#koper').click(function(){
        tabel_koper();
        get_data_koper();
    });

    $('#notif').click(function(){
        $('.data_notif').css('display','block');
        $('.data_notif').show();
        get_notif();
        $('.view_notif').hide();
    });

    $('#tutup').click(function(){
        $('.data_notif').css('display','none');
        $('.data_notif').hide();
        $('.view_notif').show();
    });

    var kriteria = $("input[name='kriteria']:checked").val();
    if(kriteria == "sub_bagian"){
        $('#view_bagian').show();
        $('#view_sub_bagian').show();
    }else if(kriteria == "bagian"){ 
        $('#view_bagian').show();
        $('#view_sub_bagian').hide();
    }else{
        $('#view_bagian').hide();
        $('#view_sub_bagian').hide();
    }

    $("input[name='kriteria']").click(function(){
        var kriteria = $("input[name='kriteria']:checked").val();
        if(kriteria == "sub_bagian"){
            $('#view_bagian').show();
            $('#view_sub_bagian').show();
        }else if(kriteria == "bagian"){ 
            $('#view_bagian').show();
            $('#view_sub_bagian').hide();
        }else{
            $('#view_bagian').hide();
            $('#view_sub_bagian').hide();
            get_anggaran();
        }
    });

    $('#departemen2').change(function(){
        get_anggaran();
    });

    $('#divisi2').change(function(){
        get_anggaran();
    });

    $('#tahun2').change(function(){
        get_anggaran();
    });

    $("#simpan_rapat").click( function() {
        var rapat = $('#rapat_ke').val();
        var rapat_txt = $('#rapat_ke_txt').val();
        if(rapat == ""){
            $('#form_rapat,html').animate({
                    scrollTop : 0 // Scroll to top of body
            }, 500);
            $('.pesan_rapat_ke').css('display','block');
            $('.pesan_rapat_ke').show();
            $('.pesan_rapat_ke').delay(3000).fadeOut('slow');
            $('.perhatian').html('Perhatian!');
            $('.belum_dipilih').html('Rapat Ke Belum Dipilih');
        }else if(rapat_txt == rapat){
            $('#form_rapat,html').animate({
                    scrollTop : 0 // Scroll to top of body
            }, 500);
            $('.pesan_rapat_ke').css('display','block');
            $('.pesan_rapat_ke').show();
            $('.pesan_rapat_ke').delay(3000).fadeOut('slow');
            $('.perhatian').html('Perhatian!');
            $('.belum_dipilih').html('Rapat Ke Belum Diganti');
        }else{
            $.ajax({
                url : '<?php echo base_url(); ?>dashboard/rapat_usulan_anggaran_c/simpan_usulan',
                data : $('#form_rapat').serialize(),
                type : "POST",
                dataType : "json",
                async : false,
                success : function(result){
                    $('#popup_rapat').css('display','none');
                    $('#popup_rapat').hide();
                    pesan_sukses();
                    get_anggaran();
                }
            });
        }
    });

    $('#batal_rapat').click(function(){
        $('#popup_rapat').css('display','none');
        $('#popup_rapat').fadeOut('slow');
        $("#rapat_ke option[value='0']").removeAttr('selected');
        $("#rapat_ke option[value='1']").removeAttr('selected');
        $("#rapat_ke option[value='2']").removeAttr('selected');
        $("#rapat_ke option[value='3']").removeAttr('selected');
        //$("#form_rapat input[type='text']").val("");
    });

    $('#close_rapat').click(function(){
        $('#popup_rapat').css('display','none');
        $('#popup_rapat').fadeOut('slow');
        $("#rapat_ke option[value='0']").removeAttr('selected');
        $("#rapat_ke option[value='1']").removeAttr('selected');
        $("#rapat_ke option[value='2']").removeAttr('selected');
        $("#rapat_ke option[value='3']").removeAttr('selected');
    });

});

function tabel_koper(){
    var base_url = "<?php echo base_url(); ?>";
    var $isi = '<div id="popup_koper">'+
                    '<div class="window_koper">'+
                    '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok"></a>'+
                    '    <div class="panel-body">'+
                    '    <input type="text" name="search_koper" id="search_koper" class="form-control" value="" placeholder="Cari perkiraan...">'+
                    '    <br/>'+
                    '    <div class="table-responsive table-bordered">'+
                    '       <div class="scroll-y">'+
                    '            <table class="table table-hover" id="tes">'+
                    '                <thead>'+
                    '                    <tr class="primary">'+
                    '                        <th>NO</th>'+
                    '                        <th style="white-space:nowrap; text-align:center;">KODE PERKIRAAN</th>'+
                    '                        <th>NAMA PERKIRAAN</th>'+
                    '                    </tr>'+
                    '                </thead>'+
                    '                <tbody>'+
                
                    '                </tbody>'+
                    '            </table>'+
                    '       </div>'+
                    '        </div>'+
                    '    </div>'+
                    '</div>'+
                '</div>';
        $('body').append($isi);

        $('#pojok').click(function(){
            $('#popup_koper').css('display','none');
            $('#popup_koper').hide();
            $('#search_koper').val("");
        });

       $('#popup_koper').css('display','block');
       $('#popup_koper').show();
}

function get_data_koper(){
    var koper = $('#search_koper').val();
    var tahun = $('#tahun2').val();

    if(ajax){
        ajax.abort();
    }

    ajax = $.ajax({
        url : '<?php echo base_url(); ?>dashboard/rapat_usulan_anggaran_c/get_kode_perkiraan',
        type : "GET",
        dataType : "json",
        data : {
            keyword : koper,
            tahun : tahun
        },
        success : function(result){
            var isine = '';
            var no = 0;
            $.each(result,function(i,res){
                no++;
                isine += '<tr style="cursor:pointer;" onclick="klik_koper('+res.ID+')">'+
                            '<td align="center">'+no+'</td>'+
                            '<td align="center">'+res.KODE_PERKIRAAN+'</td>'+
                            '<td>'+res.NAMA_PERKIRAAN+'</td>'+
                        '</tr>';
            });
            $('#tes tbody').html(isine); 
            $('#search_koper').off('keyup').keyup(function(){
                get_data_koper();
            });
        }
    });
}

function klik_koper(id_koper){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/kode_perkiraan_c/get_koper_id',
        data : {id_koper:id_koper},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#kode_perkiraan').val(row['KODE_PERKIRAAN']);
            $('#uraian_koper').val(row['NAMA_PERKIRAAN']);

            $('#popup_koper').css('display','none');
            $('#popup_koper').hide();

            get_anggaran();
        }
    });
}

function get_dep_div(){
    var id_departemen = $('#departemen2').val();
    var id_divisi = $('#divisi2').val();
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/departemen_divisi_c/get_dep_div',
        data : {id_departemen:id_departemen,id_divisi:id_divisi},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(dep_div){
            var sub_bagian = dep_div['NAMA'];
            $('#keterangan_divisi').html(' SUB BAGIAN '+sub_bagian);
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
                var bagian = divisi[i].NAMA_DEPARTEMEN;
                $('#keterangan_data').html('BAGIAN '+bagian);
            }
            $('#divisi2').html($div);
            get_dep_div();
        }
    });
}

function get_anggaran(){
    $('#popup_load').css('display','block');
    $('#popup_load').show();

    var keyword = $('#cari_data').val();
    var tahun = $('#tahun2').val();
    var bagian = $('#departemen2').val();
    var sub_bagian = $('#divisi2').val();
    var kriteria = $("input[name='kriteria']:checked").val();
    var kode_perkiraan = $('#kode_perkiraan').val();
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/rapat_usulan_anggaran_c/get_data_anggaran',
        data : {
            bagian:bagian,
            sub_bagian:sub_bagian,
            tahun:tahun,
            kriteria:kriteria,
            kode_perkiraan:kode_perkiraan,
            keyword:keyword
        },
        type : "POST",
        dataType : "json",
        async : false,
        success : function(result){
            $isi = "";
            if(result == ""){
                $('#data tbody').html($isi);
                $('#tidak_ada_data').show();
                $('#popup_load').css('display','none');
                $('#popup_load').hide();
            }else{
                for(var i=0; i<result.length; i++){
                    var jenis_anggaran = result[i].JENIS_ANGGARAN;
                    var total = 0;
                    var checked = "";
                    var rapat_ke = "";
                    var disable = "";
                    var keterangan = "";
                    var warna = "";

                    if(result[i].SETUJU == "DISETUJUI"){
                        checked = "checked='checked'";
                    }

                    if(result[i].RAPAT_KE == "1"){
                        rapat_ke = "SATU";
                    }else if(result[i].RAPAT_KE == "2"){
                        rapat_ke = "DUA";
                    }else if(result[i].RAPAT_KE == "3"){
                        rapat_ke = "TIGA";
                    }else{
                        rapat_ke = "BELUM RAPAT";
                    }

                    if(result[i].STS_REVISI == "5"){
                        keterangan = "Data tidak dapat diubah, data sudah masuk diperiode revisi";
                        disable = "disabled='disabled'";
                        warna = "pink";
                    }

                    var jumlah = 0;
                    var total = 0;

                    if(result[i].JUMLAH_REV == null){
                        jumlah = result[i].JUMLAH;
                    }else{
                        jumlah = result[i].JUMLAH_REV;
                    }

                    total = parseFloat(jumlah) * parseFloat(result[i].HARGA);

                    $isi += "<tr data-placement='top' data-toggle='popover' data-trigger='hover' data-content='"+keterangan+"' class='"+warna+"'>"+
                                "<td align='center'>"+
                                "<input type='checkbox' id='rapat_setuju_"+result[i].ID_ANGGARAN+"' name='rapat_setuju' value='"+result[i].ID_ANGGARAN+"' "+checked+" onclick=klik_setuju("+result[i].ID_ANGGARAN+"); style='cursor:pointer;' "+disable+">"+
                                "<input type='hidden' name='rapat_id_anggaran' id='rapat_id_anggaran' value='"+result[i].ID_ANGGARAN+"'></td>"+
                                "<td align='center'><a href=javascript:void(0); class='btn btn-primary' onclick=get_anggaran_by_id("+result[i].ID_ANGGARAN+"); "+disable+">Edit</a></td>"+
                                "<td align='center'>"+rapat_ke+"</td>"+
                                "<td align='center'>"+result[i].DIVISI+"</td>"+
                                "<td align='center'>"+result[i].KODE_PERKIRAAN+"</td>"+
                                "<td align='center'>"+result[i].KODE_ANGGARAN+"</td>"+
                                "<td style='white-space:nowrap;'>"+result[i].URAIAN+"</td>"+
                                "<td align='center'>"+result[i].SATUAN+"</td>"+
                                "<td align='center'>"+NumberToMoney(result[i].HARGA)+"</td>"+
                                "<td align='center'>"+jumlah+"</td>"+
                                "<td align='center'>"+NumberToMoney(total)+"</td>"+
                            "</tr>";
                }
                $('#data tbody').html($isi);
                $('#tidak_ada_data').hide();
                $('#popup_load').css('display','none');
                $('#popup_load').hide();
            }

            $('#cari_data').off('keyup').keyup(function(){
                get_anggaran();
            });
        }
    });
}

function get_notif(){
    $('#popup_load').css('display','block');
    $('#popup_load').show();

    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/rapat_usulan_anggaran_c/get_data_notif',
        type : "GET",
        dataType : "json",
        async : false,
        success : function(result){
            $isi = "";
            var no = 0;
            if(result == ""){
                $('#data_notif tbody').html($isi);
                $('#tidak_ada_data_notif').show();
            }else{
                $('#tidak_ada_data_notif').hide();
                $('#popup_load').css('display','none');
                $('#popup_load').hide();
            }
        }
    });
}

function get_anggaran_by_id(id_anggaran){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/rapat_usulan_anggaran_c/get_data_anggaran_id',
        data : {id_anggaran:id_anggaran},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#popup_rapat').css('display','block');
            $('#popup_rapat').show();

            $('#rapat_ke_txt').val(row['data'].RAPAT_KE);
            $('#id_anggaran').val(id_anggaran);
            $('#id_usulan').val(row['data'].ID_USULAN);
            $('#rapat_tahun').val(row['data'].TAHUN);
            $('#rapat_id_bagian').val(row['data'].ID_DEPARTEMEN);
            $('#rapat_bagian').val(row['data'].DEPARTEMEN);
            $('#rapat_id_sub_bagian').val(row['data'].ID_DIVISI);
            $('#rapat_sub_bagian').val(row['data'].DIVISI);
            $('#rapat_koper').val(row['data'].KODE_PERKIRAAN);
            $('#rapat_kode_perkiraan2').val(row['data'].KODE_PERKIRAAN2);
            $('#rapat_koang').val(row['data'].KODE_ANGGARAN);
            $('#rapat_uraian').val(row['data'].URAIAN);
            $('#rapat_satuan').val(row['data'].SATUAN);
            $('#rapat_volume').val(row['data'].JUMLAH);
            $('#rapat_harga').val(NumberToMoney(row['data'].HARGA));
            $('#rapat_jenis_anggaran').val(row['data'].JENIS_ANGGARAN);
            $('#rapat_id_jenis_anggaran').val(row['data'].ID_JENIS_ANGGARAN);
            $('#rapat_total_txt').val(row['data'].TOTAL);
            $('#rapat_tmt_pelaksanaan').val(row['data'].TMT_PELAKSANAAN);
            $('#rapat_lama_pelaksanaan').val(row['data'].LAMA_PELAKSANAAN);
            $('#rapat_total_pelaksanaan').val(row['data'].TOTAL_PELAKSANAAN);
            $('#rapat_jenis_rapat').val(row['data'].JENIS_RAPAT);

            if(row['data']['JENIS_ANGGARAN'] == "Barang"){
                $('#rapat_total').val(NumberToMoney(row['data'].TOTAL));
            }else{
                $('#rapat_total').val(NumberToMoney(row['data'].TOTAL_PELAKSANAAN));
            }

            if(row['data']['RAPAT_KE'] == "1"){
                $("#rapat_ke option[value='1']").attr('selected','selected');
            }else if(row['data']['RAPAT_KE'] == "2"){
                $("#rapat_ke option[value='2']").attr('selected','selected');
            }else if(row['data']['RAPAT_KE'] == "3"){
                $("#rapat_ke option[value='3']").attr('selected','selected');
            }else if(row['data']['RAPAT_KE'] == "" || row['data']['RAPAT_KE'] == null){
                $("#rapat_ke option[value='0']").attr('selected','selected');
            }

            console.log(row['data']['RAPAT_KE']);

            var jumlah_usulan = 0;
            var harga_usulan = 0;
            if(row['data'].ID_USULAN == null){
                jumlah_usulan = row['data'].JUMLAH;
                harga_usulan = row['data'].HARGA;
            }else{
                if(row['data'].AKTIF == "1"){
                    jumlah_usulan = row['data'].JUMLAH_USULAN;
                    harga_usulan = row['data'].HARGA_USULAN;
                }else{
                    jumlah_usulan = row['data'].JUMLAH;
                    harga_usulan = row['data'].HARGA;
                }
            }
            var biaya_usulan = parseFloat(jumlah_usulan) * parseFloat(harga_usulan);
            $('#rapat_vol_usulan').val(jumlah_usulan);
            $('#rapat_harga_usulan').val(NumberToMoney(harga_usulan));
            $('#rapat_biaya_usulan').val(NumberToMoney(biaya_usulan));

            var jumlah_rkap = row['data'].JUMLAH;
            var harga_rkap = row['data'].HARGA;
            var biaya_rkap = parseFloat(row['data'].JUMLAH) * parseFloat(row['data'].HARGA);
            $('#rapat_vol_rkap').val(jumlah_rkap);
            $('#rapat_harga_rkap').val(NumberToMoney(harga_rkap));
            $('#rapat_biaya_rkap').val(NumberToMoney(biaya_rkap));

            $('#rapat_januari').val(NumberToMoney(row['data'].JANUARI));
            $('#rapat_februari').val(NumberToMoney(row['data'].FEBRUARI));
            $('#rapat_maret').val(NumberToMoney(row['data'].MARET));
            $('#rapat_april').val(NumberToMoney(row['data'].APRIL));
            $('#rapat_mei').val(NumberToMoney(row['data'].MEI));
            $('#rapat_juni').val(NumberToMoney(row['data'].JUNI));
            $('#rapat_juli').val(NumberToMoney(row['data'].JULI));
            $('#rapat_agustus').val(NumberToMoney(row['data'].AGUSTUS));
            $('#rapat_september').val(NumberToMoney(row['data'].SEPTEMBER));
            $('#rapat_oktober').val(NumberToMoney(row['data'].OKTOBER));
            $('#rapat_november').val(NumberToMoney(row['data'].NOVEMBER));
            $('#rapat_desember').val(NumberToMoney(row['data'].DESEMBER));

            $('#januari_lama').val(NumberToMoney(row['data'].JANUARI));
            $('#februari_lama').val(NumberToMoney(row['data'].FEBRUARI));
            $('#maret_lama').val(NumberToMoney(row['data'].MARET));
            $('#april_lama').val(NumberToMoney(row['data'].APRIL));
            $('#mei_lama').val(NumberToMoney(row['data'].MEI));
            $('#juni_lama').val(NumberToMoney(row['data'].JUNI));
            $('#juli_lama').val(NumberToMoney(row['data'].JULI));
            $('#agustus_lama').val(NumberToMoney(row['data'].AGUSTUS));
            $('#september_lama').val(NumberToMoney(row['data'].SEPTEMBER));
            $('#oktober_lama').val(NumberToMoney(row['data'].OKTOBER));
            $('#november_lama').val(NumberToMoney(row['data'].NOVEMBER));
            $('#desember_lama').val(NumberToMoney(row['data'].DESEMBER));

            $('#jumlah_lama').val(row['data'].JUMLAH_USULAN);
            $('#harga_lama').val(row['data'].HARGA_USULAN);
        }
    });
}

function hitung_rkap(){
    var vol_rkap = $('#rapat_vol_rkap').val();
    var harga_rkap = $('#rapat_harga_rkap').val().split(',').join('');
    //console.log(harga_rkap);
    if(vol_rkap == ""){
        vol_rkap = 0;
    }

    if(harga_rkap == ""){
        harga_rkap = 0;
    }
    var biaya_rkap = parseFloat(vol_rkap) * parseFloat(harga_rkap);
    $('#rapat_biaya_rkap').val(NumberToMoney(biaya_rkap));
}

function balance(){
    var p_nominal = $('.nominal_bulan').length;
    var total = $('#rapat_biaya_rkap').val().split(',').join('');
    total = parseFloat(total);
    var total_bulan = 0;
    var sum_bulan = 0;
    for(var i=0; i<p_nominal; i++){
        var tot_per_bulan = 0;
        if($(".nominal_bulan").eq(i).val() == ""){
            tot_per_bulan = 0;
        }else{
            tot_per_bulan = $(".nominal_bulan").eq(i).val().split(',').join('');
        }
        total_bulan = total_bulan + parseFloat(tot_per_bulan);
        //console.log(parseFloat(total_bulan));
    }
    if(total_bulan < total){
        var kurang = total - total_bulan;
        // alert('Nilai tidak balance, nilai KURANG '+NumberToMoney(kurang));
        $('#pesan_balance').css('display','block');
        $('#pesan_balance').show();
        $('#keterangan_pesan').html('<b>Nilai tidak balance, nilai KURANG '+NumberToMoney(kurang)+'</b>');
        $('#simpan_rapat').prop('disabled',true);
    }else if(total_bulan > total){
        var lebih = total_bulan - total;
        // alert('Nilai tidak balance, nilai KELEBIHAN '+NumberToMoney(lebih));
        $('#pesan_balance').css('display','block');
        $('#pesan_balance').show();
        $('#keterangan_pesan').html('<b>Nilai tidak balance, nilai KELEBIHAN '+NumberToMoney(lebih)+'</b>');
        $('#simpan_rapat').prop('disabled',true);
    }else{
        $('#pesan_balance').css('display','none');
        $('#pesan_balance').hide();
        $('#simpan_rapat').removeAttr('disabled');
    }
}

function get_koper_click(id_koper){
    $.ajax({
        url : "<?php echo base_url(); ?>dashboard/kode_perkiraan_c/get_koper_id",
        data : {id_koper:id_koper},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#kode_perkiraan').val(row.KODE_PERKIRAAN);
            $('#search_koper').val("");
            get_anggaran();
            $('#popup_koper').css('display','none');
            $('#popup_koper').hide();
        }
    });
}

function klik_setuju(id_anggaran){
    var setuju = "";
    var cek = $("#rapat_setuju_"+id_anggaran).is(':checked');
    if(cek == true){
        setuju = "DISETUJUI";
    }else{
        setuju = "TIDAK DISETUJUI";
    }
    
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/rapat_usulan_anggaran_c/update_setuju',
        data : {id_anggaran:id_anggaran,setuju:setuju},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(result){
            pesan_sukses();
            get_anggaran();
            // get_anggaran_by_id(id_anggaran);
        }
    });
}
</script>

<style>
#pesan_balance{
    display: none;
}
.pesan_rapat_ke{
    display: none;
}
</style>

<div id="popup_load">
    <div class="window_load">
        <img src="<?=base_url()?>/ico/loading.gif" height="100" width="100">
    </div>
</div>

<div class="panel" id="view_data">
    <form class="form-horizontal" role="form">
        <div class="panel-body">
            <div class="form-group admin-form">
                <label for="inputPassword" class="col-lg-3 control-label">Tahun</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="tahun2" name="tahun" style="cursor:pointer;">
                                        <?php
                                            $thn = date('Y');
                                            for($i=$thn-1; $i<=$thn+2; $i++) {
                                                if ($i==$thn){
                                                    echo"<option selected='selected' value=".$i."> ".$i." </option>";
                                                }else{
                                                    echo"<option value=".$i."> ".$i." </option>";
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

            <div class="form-group">
                <label for="disabledInput" class="col-lg-3 control-label">Kriteria</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample1" name="kriteria" value="semua_bagian">
                        <label for="radioExample1" style="margin-right: 15px; padding-left: 25px;">Semua Bagian</label>

                        <input type="radio" id="radioExample2" name="kriteria" value="bagian">
                        <label for="radioExample2" style="margin-right: 15px; padding-left: 25px;">Bagian</label>

                        <input type="radio" id="radioExample3" name="kriteria" value="sub_bagian" checked="checked">
                        <label for="radioExample3" style="margin-right: 15px; padding-left: 25px;">Sub Bagian</label>
                    </div>
                </div>
            </div>

            <div class="form-group admin-form" id="view_bagian">
                <label for="inputPassword" class="col-lg-3 control-label">Bagian</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="departemen2" name="departemen" style="cursor:pointer;" onchange="data_divisi();" onclick="data_divisi();" <?php echo $disable; ?> >
                                        <?php
                                            if($departemen != ""){
                                                foreach ($departemen as $value_dep) {
                                        ?>
                                        <option value="<?php echo $value_dep->ID; ?>"><?php echo $value_dep->NAMA; ?></option>    
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

            <div class="form-group admin-form" id="view_sub_bagian">
                <label for="inputPassword" class="col-lg-3 control-label">Sub Bagian</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="divisi2" name="divisi" style="cursor:pointer;" onchange="get_dep_div();" onclick="get_dep_div();" <?php echo $disable2; ?> >
                   
                                    </select>
                                    <i style="z-index:99;" class="arrow"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group data_baru">
                <label for="kode_perkiraan" class="col-lg-3 control-label">Kode Perkiraan</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field">
                                    <input type="text" name="kode_perkiraan" id="kode_perkiraan" class="gui-input" value="" required />
                                </label>
                                <a class="button" id="koper">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-footer">
            <input type="text" name="cari_data" id="cari_data" class="form-control" value="" placeholder="Cari..." style="width:275px;">
            <br/>
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title fw700 text-info">
                        <span class="glyphicons glyphicons-table"></span>
                        <span id="keterangan_data"></span><span id="keterangan_divisi"></span>
                    </span>
                </div>
                <div class="panel-body pn">
                    <div class="scroll-xy">
                        <table class="table table-bordered" id="data">
                            <thead>
                                <tr class="primary">
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Disetujui</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Edit Rapat</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Rapat Ke</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Sub Bagian</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Perkiraan</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Kode Anggaran</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Uraian</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Satuan</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Harga</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Volume</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                        <div class="panel-heading" style="text-align:center;" id="tidak_ada_data">
                            <span class="panel-title">
                                <span>Tidak Ada Data</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer view_notif">
                <input type="button" class="btn btn-success" value="Informasi" id="notif" name="notif" style="font-weight:bold;">
            </div>
        </div>

    </form>
</div>

<div class="panel-footer data_notif">
    <div class="panel-heading">
        <span class="panel-title">
            <span class="glyphicons glyphicons-table"></span>
            <span>Data Anggaran yang telah terubah</span>
        </span>
    </div>
    <table class="table table-bordered" id="data_notif2" style="border-collapse:separate; table-layout: fixed;">
            <tr class="success">
                <th style="width:50px;" align="center">No</th>
                <th align="center">Jumlah Data</th>
                <th align="center">Bagian</th>
                <th align="center">Sub Bagian</th>
                <th align="center">Aksi</th>
            </tr>

            <?PHP 
            $nomer = 0;
            foreach ($get_data_notif as $key => $notip) { 
            $nomer++;
            ?>
            <tr>
                <td style="width:50px;" align='center'><?=$nomer;?></td>
                <td><?=$notip->JUMLAH;?></td>
                <td><?=$notip->NAMA_DEP;?></td>
                <td><?=$notip->NAMA_DIVISI;?></td>
                <td style="width:100px;" align="center"> 
                    <a href="javascript:;" id="show_btn_notip_<?=$nomer;?>" onclick="$('#no_<?=$nomer;?>').show(); $('#hide_btn_notip_<?=$nomer;?>').show(); $('#show_btn_notip_<?=$nomer;?>').hide();" class="btn btn-info" style="font-weight:bold;"> Tampilkan </a> 
                    <a href="javascript:;" id="hide_btn_notip_<?=$nomer;?>" onclick="$('#no_<?=$nomer;?>').hide(); $('#hide_btn_notip_<?=$nomer;?>').hide(); $('#show_btn_notip_<?=$nomer;?>').show();" class="btn btn-danger" style="font-weight:bold; display:none;"> Sembunyikan </a> 
                </td>
            </tr>

            <tr id="no_<?=$nomer;?>" style="display:none;">
                <td colspan="5" align="left" style="width:100%;">
                <div style="max-width:100%; overflow-x: scroll;">
                <table class="table table-bordered" style="width:100%;">
                        <tr class="primary">
                            <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Rapat Ke</th>
                            <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Sub Bagian</th>
                            <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Perkiraan</th>
                            <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Kode Anggaran</th>
                            <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Uraian</th>
                            <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Satuan</th>
                            <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Harga</th>
                            <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Volume</th>
                            <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Total</th>
                        </tr>
                        <?PHP 
                            $dt_notif = $this->model->get_detail_notif($notip->DIVISI); 
                            foreach ($dt_notif as $key => $notip2) {
                            $rapat_ke = "";
                            if($notip2->RAPAT_KE == "1"){
                                $rapat_ke = "SATU";
                            }else if($notip2->RAPAT_KE == "2"){
                                $rapat_ke = "DUA";
                            }else if($notip2->RAPAT_KE == "3"){
                                $rapat_ke = "TIGA";
                            }else{
                                $rapat_ke = "BELUM RAPAT";
                            }
                        ?>
                            <tr>
                                <td align='center'><?=$rapat_ke;?></td>
                                <td align='center'><?=$notip2->DIVISI;?></td>
                                <td align='center'><?=$notip2->KODE_PERKIRAAN;?></td>
                                <td align='center'><?=$notip2->KODE_ANGGARAN;?></td>
                                <td style="white-space:nowrap;"><?=$notip2->URAIAN;?></td>
                                <td align='center'><?=$notip2->SATUAN;?></td>
                                <td align='center'>Rp <?=str_replace(',', '.', number_format($notip2->HARGA)) ;?></td>
                                <td align='center'><?=$notip2->JUMLAH;?></td>
                                <td align='center'>Rp <?=str_replace(',', '.', number_format($notip2->TOTAL + $notip2->TOTAL_PELAKSANAAN)) ;?></td>
                            </tr>

                        <?PHP 
                            }
                        ?>
                </table>
                </div>
                </td>
            </tr>
            <?PHP }  ?>
    </table>
    <div class="panel-footer">
        <input type="button" class="btn btn-danger" value="Tutup" id="tutup" name="tutup" style="font-weight:bold;">
    </div>
</div>

<div id="popup_rapat">
    <div class="window_rapat">
        <div class="modals_head">
            <span>
                <h3>Rapat Usulan Anggaran</h3>
            </span>
            <span>
                <a href="javascript:void(0);" id="close_rapat" style="float:right;" class="close-button"><img src="<?=base_url();?>images/close.png" width="20px" height="20px" style="margin-top: -40px;"></a>
            </span>  
        </div>
        <form class="form-horizontal" role="form" action="" method="post" id="form_rapat">
            <div class="scroll_popup-y">
                <input type="hidden" name="id_usulan" id="id_usulan" value="">
                <input type="hidden" name="id_anggaran" id="id_anggaran" value="">
                <input type="hidden" name="rapat_jenis_anggaran" id="rapat_jenis_anggaran" value="">
                <input type="hidden" name="rapat_id_jenis_anggaran" id="rapat_id_jenis_anggaran" value="">
                <input type="hidden" name="rapat_total_txt" id="rapat_total_txt" value="">
                <input type="hidden" name="rapat_tmt_pelaksanaan" id="rapat_tmt_pelaksanaan" value="">
                <input type="hidden" name="rapat_lama_pelaksanaan" id="rapat_lama_pelaksanaan" value="">
                <input type="hidden" name="rapat_total_pelaksanaan" id="rapat_total_pelaksanaan" value="">
                <input type="hidden" name="rapat_jenis_rapat" id="rapat_jenis_rapat" value="">
                <input type="hidden" name="jumlah_lama" id="jumlah_lama" value="">
                <input type="hidden" name="harga_lama" id="harga_lama" value="">

                <div class="alert alert-danger alert-dismissable pesan_rapat_ke">
                    <i class="fa fa-danger pr10"></i>
                    <strong class="perhatian"></strong>
                    <span class="belum_dipilih"></span>
                </div>

                <div class="form-group admin-form">
                    <label for="inputPassword" class="col-lg-3 control-label">Rapat Ke</label>
                    <div class="col-lg-3">
                        <div class="admin-form">
                            <div>
                                <div class="smart-widget sm-right smr-50">
                                    <label class="field select">
                                        <input type="hidden" name="rapat_ke_txt" id="rapat_ke_txt" value="">
                                        <select id="rapat_ke" name="rapat_ke" style="cursor:pointer;" required="required">
                                            <option value="0">Belum Rapat</option>
                                            <option value="1">Pertama</option>
                                            <option value="2">Kedua</option>
                                            <option value="3">Ketiga</option>
                                        </select>
                                        <i style="z-index:99;" class="arrow"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label" for="rapat_tahun">Tahun</label>
                    <div class="col-lg-8">
                        <input type="text" name="rapat_tahun" id="rapat_tahun" class="form-control" value="" readonly="readonly">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label" for="rapat_bagian">Bagian</label>
                    <div class="col-lg-8">
                        <input type="hidden" name="rapat_id_bagian" id="rapat_id_bagian" value="">
                        <input type="text" name="rapat_bagian" id="rapat_bagian" class="form-control" value="" readonly="readonly">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label" for="rapat_sub_bagian">Sub Bagian</label>
                    <div class="col-lg-8">
                        <input type="hidden" name="rapat_id_sub_bagian" id="rapat_id_sub_bagian" value="">
                        <input type="text" name="rapat_sub_bagian" id="rapat_sub_bagian" class="form-control" value="" readonly="readonly">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label" for="rapat_koper">Kode Perkiraan</label>
                    <div class="col-lg-8">
                        <input type="text" name="rapat_koper" id="rapat_koper" class="form-control" value="" readonly="readonly">
                        <input type="hidden" name="rapat_kode_perkiraan2" id="rapat_kode_perkiraan2" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label" for="rapat_koang">Kode Anggaran</label>
                    <div class="col-lg-8">
                        <input type="text" name="rapat_koang" id="rapat_koang" class="form-control" value="" readonly="readonly">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label" for="rapat_uraian">Uraian</label>
                    <div class="col-lg-8">
                        <textarea class="form-control" name="rapat_uraian" id="rapat_uraian" rows="3" readonly="readonly"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label" for="rapat_satuan">Satuan</label>
                    <div class="col-lg-8">
                        <input type="text" name="rapat_satuan" id="rapat_satuan" class="form-control" value="" readonly="readonly">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-lg-3 control-label" for="rapat_vol_usulan">Volume Usulan</label>
                    <div class="col-lg-8">
                        <input type="text" name="rapat_vol_usulan" id="rapat_vol_usulan" class="form-control" value="" readonly="readonly">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label" for="rapat_harga_usulan">Harga Satuan Usulan</label>
                    <div class="col-lg-8">
                        <input type="text" name="rapat_harga_usulan" id="rapat_harga_usulan" class="form-control" value="" readonly="readonly">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label" for="rapat_biaya_usulan">Biaya Usulan</label>
                    <div class="col-lg-8">
                        <input type="text" name="rapat_biaya_usulan" id="rapat_biaya_usulan" class="form-control" value="" readonly="readonly">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label" for="rapat_vol_rkap">Volume RKAP</label>
                    <div class="col-lg-8">
                        <input type="text" name="rapat_vol_rkap" id="rapat_vol_rkap" class="form-control" value="" onkeyup="hitung_rkap(); balance();" onchange="hitung_rkap(); balance();">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label" for="rapat_harga_rkap">Harga Satuan RKAP</label>
                    <div class="col-lg-8">
                        <input type="text" name="rapat_harga_rkap" id="rapat_harga_rkap" class="form-control" value="" onkeyup="FormatCurrency(this); hitung_rkap(); balance();" onchange="hitung_rkap(); balance();">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label" for="rapat_biaya_rkap">Biaya RKAP</label>
                    <div class="col-lg-8">
                        <input type="text" name="rapat_biaya_rkap" id="rapat_biaya_rkap" class="form-control" value="" readonly="readonly">
                    </div>
                </div>
                
                <hr/>

                <input type="hidden" name="januari_lama" id="januari_lama" value="">
                <input type="hidden" name="februari_lama" id="februari_lama" value="">
                <input type="hidden" name="maret_lama" id="maret_lama" value="">
                <input type="hidden" name="april_lama" id="april_lama" value="">
                <input type="hidden" name="mei_lama" id="mei_lama" value="">
                <input type="hidden" name="juni_lama" id="juni_lama" value="">
                <input type="hidden" name="juli_lama" id="juli_lama" value="">
                <input type="hidden" name="agustus_lama" id="agustus_lama" value="">
                <input type="hidden" name="september_lama" id="september_lama" value="">
                <input type="hidden" name="oktober_lama" id="oktober_lama" value="">
                <input type="hidden" name="november_lama" id="november_lama" value="">
                <input type="hidden" name="desember_lama" id="desember_lama" value="">

                <div class="alert alert-warning alert-dismissable" id="pesan_balance">
                    <i class="fa fa-warning pr10"></i>
                    <strong>Perhatian!</strong>
                    <span id="keterangan_pesan"></span>
                </div>

                <div class="alert alert-danger alert-dismissable pesan_rapat_ke">
                    <i class="fa fa-danger pr10"></i>
                    <strong class="perhatian"></strong>
                    <span class="belum_dipilih"></span>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="rapat_januari">Januari</label>
                        <div class="col-lg-8">
                            <input type="text" name="rapat_januari" id="rapat_januari" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="rapat_februari">Februari</label>
                        <div class="col-lg-8">
                            <input type="text" name="rapat_februari" id="rapat_februari" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="rapat_maret">Maret</label>
                        <div class="col-lg-8">
                            <input type="text" name="rapat_maret" id="rapat_maret" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="rapat_april">April</label>
                        <div class="col-lg-8">
                            <input type="text" name="rapat_april" id="rapat_april" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="rapat_mei">Mei</label>
                        <div class="col-lg-8">
                            <input type="text" name="rapat_mei" id="rapat_mei" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="rapat_juni">Juni</label>
                        <div class="col-lg-8">
                            <input type="text" name="rapat_juni" id="rapat_juni" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="rapat_juli">Juli</label>
                        <div class="col-lg-8">
                            <input type="text" name="rapat_juli" id="rapat_juli" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="rapat_agustus">Agustus</label>
                        <div class="col-lg-8">
                            <input type="text" name="rapat_agustus" id="rapat_agustus" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="rapat_september">September</label>
                        <div class="col-lg-8">
                            <input type="text" name="rapat_september" id="rapat_september" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="rapat_oktober">Oktober</label>
                        <div class="col-lg-8">
                            <input type="text" name="rapat_oktober" id="rapat_oktober" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="rapat_november">November</label>
                        <div class="col-lg-8">
                            <input type="text" name="rapat_november" id="rapat_november" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="rapat_desember">Desember</label>
                        <div class="col-lg-8">
                            <input type="text" name="rapat_desember" id="rapat_desember" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <center>
                    <input type="button" name="simpan_rapat" id="simpan_rapat" value="SIMPAN" class="btn btn-primary">
                    <input type="button" name="batal_rapat" id="batal_rapat" value="BATAL" class="btn btn-danger">
                </center>
            </div>
        </form>
    </div>
</div>