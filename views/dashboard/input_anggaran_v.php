<!-- Copyright 2015
Reserved by CV JTECH MALANG
Devan E. P. -->
<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/tabel-devan.css">

<script>
var ajax = "";
$(document).keyup(function(e) {
    if (e.keyCode == 27){
        $('#popup_koper').fadeOut('slow');
        $('#search_koper').val("");
        $('#popup_barang').fadeOut('slow');
        $('#search_barang').val("");
        $('#popup_koang').fadeOut('slow');
        $('#search_koang').val("");
    }
});

$(document).ready(function(){
    data_divisi();
    get_kode_anggaran();

    $('#view_barang').hide();
    $('.view_non_barang').hide();
    $('#pesan_balance').hide();
    $('#ubah').hide();
    $('#hapus').hide();
    $('.ubah_data').hide();

    $('#empty_koper').hide();
    $('#empty_brg').hide();
    $('#empty_uraian').hide();
    $('#empty_tmt_plk').hide();
    $('#empty_lama_plk').hide();
    $('#empty_lokasi').hide();
    $('#empty_volume').hide();
    $('#empty_satuan').hide();
    $('#empty_harga_satuan').hide();
    $('#simpan_harga').hide();

    <?php
        if($this->session->flashdata('status')){
    ?>
        pesan_sukses();
    <?php
        }else if($this->session->flashdata('hapus')){
    ?>
        pesan_hapus();
    <?php
        }
    ?>

    $('#pojok').click(function(){
        $('#popup_koper').css('display','none');
        $('#popup_koper').hide();
        $('#search_koper').val("");
    });

    $('#search_koper').off('keyup').keyup(function(){
        var koper = $('#search_koper').val();

        if(ajax){
            ajax.abort();
        }

        ajax = $.ajax({
            url : '<?php echo base_url(); ?>dashboard/kode_perkiraan_c/get_kode_perkiraan',
            type : "GET",
            dataType : "json",
            data : {
                keyword : koper,
            },
            success : function(result){
                var isine = '';
                var no = 0;
                $.each(result,function(i,res){
                    no++;
                    isine += '<tr style="cursor:pointer;" onclick=get_koper_click('+res.ID+');>'+
                                '<td align="center">'+no+'</td>'+
                                '<td align="center">'+res.KODE_PERKIRAAN+'</td>'+
                                '<td>'+res.NAMA_PERKIRAAN+'</td>'+
                            '</tr>';
                });
                $('#tes_koper tbody').html(isine);
            }
        });
    });

    var kategori = $("input[name='kategori']:checked").val();
    var jenis_anggaran = $("input[name='jenis_anggaran']:checked").val();

    if(kategori == "baru"){
        $('#simpan').show();
        $('#ubah').hide();
        $('#hapus').hide();
        $('.ubah_data').hide();
        $('.data_baru').show();
        $('#simpan_harga').hide();
        $('#ubah_harga').show();
        if(jenis_anggaran == "Barang"){
            $('#ubah_harga').show();
        }else{
            $('#ubah_harga').hide();
        } 
    }else{
        $('#simpan').hide();
        $('#ubah').show();
        $('#hapus').show();
        $('.ubah_data').show();
        $('.data_baru').hide();
        $('#simpan_harga').hide();
        $('#ubah_harga').show();
        if(jenis_anggaran == "Barang"){
            $('#ubah_harga').show();
        }else{
            $('#ubah_harga').hide();
        }
    }

    if(jenis_anggaran == "Barang"){
        $('#view_barang').show();
        $('.view_non_barang').hide();
        $('#uraian').prop('readonly',true);
        $('#satuan').prop('readonly',true);
        $('#harga_satuan').prop('readonly',true);
        $('#simpan_harga').hide();
        $('#ubah_harga').show();
    }else{ 
        $('#view_barang').hide();
        $('.view_non_barang').show();
        $('#uraian').removeAttr('readonly');
        $('#satuan').removeAttr('readonly');
        $('#harga_satuan').removeAttr('readonly');
        $('#simpan_harga').show();
        $('#ubah_harga').hide();
    }

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

    $("input[name='kategori']").click(function(){
        $('#simpan_harga').hide();
        $('#ubah_harga').show();
        $('#harga_satuan').prop('readonly',true);
        var kategori = $("input[name='kategori']:checked").val();
        var jenis_anggaran = $("input[name='jenis_anggaran']:checked").val();
        if(kategori == "baru"){
            $('#simpan').show();
            $('#ubah').hide();
            $('#hapus').hide();
            $('.ubah_data').hide();
            $('.data_baru').show();

            $('#kelompok_perkiraan_ubah').val("");
            $('#kode_anggaran_ubah').val("");
            $('#id_jenis_anggaran').val("");
            $('#uraian').val("");
            $('#lokasi').val("");
            $('#volume').val("");
            $('#satuan').val("");
            $('#harga_satuan').val("");
            $('#total').val("");
            $('.nominal_bulan').val("");

            if(jenis_anggaran != "Barang"){
                $('#tmt_pelaksanaan').val("");
                $('#lama_pelaksanaan').val("");
                $('#ubah_harga').hide();
            }else{
                $('#ubah_harga').show();
            }
        }else{
            $('#simpan').hide();
            $('#ubah').show();
            $('#hapus').show();
            $('.ubah_data').show();
            $('.data_baru').hide();

            $('#kode_perkiraan').val("");
            $('#id_jenis_anggaran').val("");
            $('#uraian').val("");
            $('#lokasi').val("");
            $('#volume').val("");
            $('#satuan').val("");
            $('#harga_satuan').val("");
            $('#total').val("");
            $('.nominal_bulan').val("");

            if(jenis_anggaran != "Barang"){
                $('#tmt_pelaksanaan').val("");
                $('#lama_pelaksanaan').val("");
                $('#ubah_harga').hide();
            }else{
                $('#ubah_harga').show();
            }
        }
    });

    $("input[name='jenis_anggaran']").click(function(){
        var jenis_anggaran = $("input[name='jenis_anggaran']:checked").val();
        if(jenis_anggaran == "Barang"){
            $('#view_barang').show();
            $('.view_non_barang').hide();
            $('#uraian').prop('readonly',true);
            $('#satuan').prop('readonly',true);
            $('#harga_satuan').prop('readonly',true);

            $('#id_jenis_anggaran').val("");
            $('#uraian').val("");
            $('#satuan').val("");
            $('#harga_satuan').val("");
            $('#ubah_harga').show();
        }else{ 
            $('#view_barang').hide();
            $('.view_non_barang').show();
            $('#uraian').removeAttr('readonly');
            $('#satuan').removeAttr('readonly');
            $('#harga_satuan').removeAttr('readonly');

            $('#id_jenis_anggaran').val("");
            $('#uraian').val("");
            $('#satuan').val("");
            $('#harga_satuan').val("");
            $('#ubah_harga').hide();
        }
    });

    $('#simpan').click(function(){
        var jenis_anggaran = $("input[name='jenis_anggaran']:checked").val();
        var p_nominal = $('.nominal_bulan').length;
        var total = $('#total').val().split(',').join('');
        total = parseFloat(total);
        var total_bulan = 0;
        for(var i=0; i<p_nominal; i++){
            if($(".nominal_bulan").eq(i).val() == ""){
                $(".nominal_bulan").eq(i).val(0);
            }
            var tot_per_bulan = $(".nominal_bulan").eq(i).val().split(',').join('');
            total_bulan = total_bulan + parseFloat(tot_per_bulan);
        }
        if(total_bulan < total){
            var kurang = total - total_bulan;
            // alert('Nilai tidak balance, nilai KURANG '+NumberToMoney(kurang));
            $('#pesan_balance').css('display','block');
            $('#pesan_balance').show();
            $('#keterangan_pesan').html('<b>Nilai tidak balance, nilai KURANG '+NumberToMoney(kurang)+'</b>');
            return false;
        }else if(total_bulan > total){
            var lebih = total_bulan - total;
            // alert('Nilai tidak balance, nilai KELEBIHAN '+NumberToMoney(lebih));
            $('#pesan_balance').css('display','block');
            $('#pesan_balance').show();
            $('#keterangan_pesan').html('<b>Nilai tidak balance, nilai KELEBIHAN '+NumberToMoney(lebih)+'</b>');
            return false;
        }else if($('#kode_perkiraan').val() == ""){
                $('#empty_koper').show();
                $('#empty_koper').delay(4000).fadeOut('slow');
                return false;
        }else if($('#uraian').val() == ""){
                $('#empty_uraian').show();
                $('#empty_uraian').delay(4000).fadeOut('slow');
                return false;
        }else if($('#lokasi').val() == ""){
                $('#empty_lokasi').show();
                $('#empty_lokasi').delay(4000).fadeOut('slow');
                return false;
        }else if($('#volume').val() == ""){
                $('#empty_volume').show();
                $('#empty_volume').delay(4000).fadeOut('slow');
                return false;
        }else if(jenis_anggaran == "Barang"){
            if($('#id_jenis_anggaran').val() == ""){
                $('#empty_brg').show();
                $('#empty_brg').delay(4000).fadeOut('slow');
                return false;
            }
        }else if(jenis_anggaran != "Barang"){
            if($('#tmt_pelaksanaan').val() == ""){
                $('#empty_tmt_plk').show();
                $('#empty_tmt_plk').delay(4000).fadeOut('slow');
                return false;
            }else if($('#lama_pelaksanaan').val() == ""){
                $('#empty_lama_plk').show();
                $('#empty_lama_plk').delay(4000).fadeOut('slow');
                return false;
            }else if($('#satuan').val() == ""){
                $('#empty_satuan').show();
                $('#empty_satuan').delay(4000).fadeOut('slow');
                return false;
            }else if($('#harga_satuan').val() == ""){
                $('#empty_harga_satuan').show();
                $('#empty_harga_satuan').delay(4000).fadeOut('slow');
                return false;
            }
        }else if($('.nominal_bulan').val() == ""){
                $('#pesan_balance').css('display','block');
                $('#pesan_balance').show();
                $('#keterangan_pesan').html('<b>Nominal bulan harus diisi!</b>');
                $('#pesan_balance').delay(4000).fadeOut('slow');
                return false;
        }else{
            // alert('Data Tersimpan');
            return true;
        }
    });

    $('#batal').click(function(){
        var kategori = $("input[name='kategori']:checked").val();
        var jenis_anggaran = $("input[name='jenis_anggaran']:checked").val();
        if(kategori == "baru"){
            $('#kode_perkiraan').val("");
            $('#id_jenis_anggaran').val("");
            $('#uraian').val("");
            $('#lokasi').val("");
            $('#volume').val("");
            $('#satuan').val("");
            $('#harga_satuan').val("");
            $('#total').val("");
            $('.nominal_bulan').val("");

            if(jenis_anggaran != "Barang"){
                $('#tmt_pelaksanaan').val("");
                $('#lama_pelaksanaan').val("");
            }
        }else{
            $('#kelompok_perkiraan_ubah').val("");
            $('#kode_anggaran_ubah').val("");
            $('#id_jenis_anggaran').val("");
            $('#uraian').val("");
            $('#lokasi').val("");
            $('#volume').val("");
            $('#satuan').val("");
            $('#harga_satuan').val("");
            $('#total').val("");
            $('.nominal_bulan').val("");

            if(jenis_anggaran != "Barang"){
                $('#tmt_pelaksanaan').val("");
                $('#lama_pelaksanaan').val("");
            }
        }
    });

    $('#hapus').click(function(){
        $('#dialog-btn').click();
        var id_anggaran = $('#id_anggaran').val();
        var id_hapus = $('#id_hapus').val(id_anggaran);
    });

    $('#ubah_harga').click(function(){
        $('#harga_satuan').removeAttr('readonly');
        $('#ubah_harga').hide();
        $('#simpan_harga').show();
    });

    $('#simpan_harga').click(function(){
        var id_barang = $('#id_barang').val();
        var harga_satuan = $('#harga_satuan').val();
        $.ajax({
            url : '<?php echo base_url(); ?>dashboard/input_anggaran_c/update_harga_satuan',
            data : {id_barang:id_barang,harga_satuan:harga_satuan},
            type : "POST",
            dataType : "json",
            async : false,
            success : function(result){
                $('#harga_satuan').prop('readonly',true);
                $('#ubah_harga').show();
                $('#simpan_harga').hide();
            }
        });
    });

});

function tabel_barang(){
    var base_url = '<?php echo base_url(); ?>';
    var $isi = '<div id="popup_barang">'+
                    '<div class="window_barang">'+
                    '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_barang"></a>'+
                    '    <div class="panel-body">'+
                    '       <input type="text" name="search_barang" id="search_barang" class="form-control" value="" placeholder="Cari barang...">'+
                    '       <br/>'+
                    '       <div class="table-responsive scroll_popup-y">'+
                    '            <table class="table table-hover table-bordered" id="tes">'+
                    '                <thead>'+
                    '                    <tr class="primary">'+
                    '                        <th style="white-space:nowrap; text-align:center;">NO</th>'+
                    '                        <th style="white-space:nowrap; text-align:center;">KODE BARANG</th>'+
                    '                        <th style="white-space:nowrap; text-align:center;">NAMA BARANG</th>'+
                    '                        <th style="white-space:nowrap; text-align:center;">SATUAN</th>'+
                    '                        <th style="white-space:nowrap; text-align:center;">HARGA</th>'+
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

        $('#pojok_barang').click(function(){
            $('#popup_barang').css('display','none');
            $('#popup_barang').hide();
            $('#search_barang').val("");
        });

        $('#popup_barang').css('display','block');
        $('#popup_barang').show();
}


function get_data_barang(){
    var kode_barang = $('#search_barang').val();
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/input_anggaran_c/get_barang',
        type : "GET",
        dataType : "json",
        data : {
            keyword : kode_barang,
        },
        success : function(result){
            var isine = '';
            var no = 0;
            $.each(result,function(i,res){
                no++;
                isine += '<tr style="cursor:pointer;" onclick=get_barang_id('+res.ID+');>'+
                            '<td align="center">'+no+'</td>'+
                            '<td align="center">'+res.KODE_BARANG+'</td>'+
                            '<td>'+res.NAMA_BARANG+'</td>'+
                            '<td align="center">'+res.SATUAN+'</td>'+
                            '<td>'+NumberToMoney(res.HARGA_BARANG)+'</td>'+
                        '</tr>';
            });
            $('#tes tbody').html(isine);
            $('#search_barang').off('keyup').keyup(function(){
                get_data_barang();
            });
        }
    });
}

function get_barang_id(id_barang){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/input_anggaran_c/get_barang_id',
        data : {id_barang:id_barang},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#id_barang').val(id_barang);
            $('#id_jenis_anggaran').val(row['KODE_BARANG']);
            $('#uraian').val(row['NAMA_BARANG']);
            $('#satuan').val(row['SATUAN']);
            $('#harga_satuan').val(NumberToMoney(row['HARGA_BARANG']));

            $('#ubah_harga').removeAttr('disabled');
            
            // var harga_satuan = row['HARGA_BARANG'];
            // if(harga_satuan == 0){
            // }else{
            //     $('#ubah_harga').prop('disabled',true);
            // }

            $('#popup_barang').css('display','none');
            $('#popup_barang').hide();
            $('#search_barang').val("");
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
            get_kode_anggaran();
        }
    });
}

function get_kode_anggaran(){
    var departemen = $('#departemen2').val();
    var divisi = $('#divisi2').val();
    var tahun = $('#tahun2').val();
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/input_anggaran_c/get_kode_anggaran',
        data : {departemen:departemen,divisi:divisi,tahun:tahun},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(result){
            $('#kode_anggaran').val(result);
        }
    });
}

function hitung_total(){
    var volume = $('#volume').val();
    var harga_satuan = $('#harga_satuan').val().split(',').join('');

    if(harga_satuan == ""){
        harga_satuan = 0;
    }

    if(volume == ""){
        volume = 0;
    }

    var total = parseFloat(volume)*parseFloat(harga_satuan);
    $('#total').val(NumbToMonDot(total));
    // console.log(total);
}

function balance(){
    var p_nominal = $('.nominal_bulan').length;
    var total = $('#total').val().split(',').join('');
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
        $('#sum_bulan').val(NumbToMonDot(total_bulan));
        //console.log(parseFloat(total_bulan));
    }
    if(total_bulan < total){
        var kurang = total - total_bulan;
        // alert('Nilai tidak balance, nilai KURANG '+NumberToMoney(kurang));
        $('#pesan_balance').css('display','block');
        $('#pesan_balance').show();
        $('#keterangan_pesan').html('<b>Nilai tidak balance, nilai KURANG '+NumberToMoney(kurang)+'</b>');
    }else if(total_bulan > total){
        var lebih = total_bulan - total;
        // alert('Nilai tidak balance, nilai KELEBIHAN '+NumberToMoney(lebih));
        $('#pesan_balance').css('display','block');
        $('#pesan_balance').show();
        $('#keterangan_pesan').html('<b>Nilai tidak balance, nilai KELEBIHAN '+NumberToMoney(lebih)+'</b>');
    }else{
        $('#pesan_balance').css('display','none');
        $('#pesan_balance').hide();
    }
}

function loading(){
    $('#popup_load').css('display','block');
    $('#popup_load').show();
}

function get_popup_anggaran(){
    var base_url = '<?php echo base_url(); ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '       <input type="text" name="search_koang" id="search_koang" class="form-control" value="" placeholder="Cari...">'+
                '       <br/>'+
                '       <div class="table-responsive scroll_popup-y">'+
                '            <table class="table table-hover table-bordered" id="tes2">'+
                '                <thead>'+
                '                    <tr class="primary">'+
                '                        <th>NO</th>'+
                '                        <th style="white-space:nowrap; text-align:center;">KODE ANGGARAN</th>'+
                '                        <th>URAIAN</th>'+
                '                    </tr>'+
                '                </thead>'+
                '                <tbody>'+
                
                '                </tbody>'+
                '            </table>'+
                '       </div>'+
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

function ajax_anggaran(){
    var keyword = $('#search_koang').val();
    var bagian = $('#departemen2').val();
    var sub_bagian = $('#divisi2').val();
    var tahun = $('#tahun2').val();
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/kode_anggaran_c/get_kd_anggaran',
        type : "POST",
        dataType : "json",
        data : {
            keyword : keyword,
            bagian : bagian,
            sub_bagian : sub_bagian,
            tahun : tahun
        },
        success : function(result){
            var isine = '';
            var no = 0;
            $.each(result,function(i,res){
                no++;
                isine += '<tr style="cursor:pointer;" onclick=get_anggaran_id('+res.ID_ANGGARAN+');>'+
                            '<td align="center">'+no+'</td>'+
                            '<td align="center">'+res.KODE_ANGGARAN+'</td>'+
                            '<td>'+res.URAIAN+'</td>'+
                        '</tr>';
            });
            $('#tes2 tbody').html(isine); 
            $('#search_koang').off('keyup').keyup(function(){
                ajax_anggaran();
            });
        }
    });
}

function get_anggaran_id(kode_anggaran){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/input_anggaran_c/get_anggaran_by_id',
        data : {kode_anggaran:kode_anggaran},
        type : "POST",
        dataType : "json",
        async : false,
        success :  function(row){
            $('#id_anggaran').val(row['ID_ANGGARAN']);
            $('#kode_anggaran_ubah').val(row['KODE_ANGGARAN']);
            $('#kelompok_perkiraan_ubah').val(row['KODE_PERKIRAAN']);
            $('#id_jenis_anggaran').val(row['ID_JENIS_ANGGARAN']);
            $('#uraian').val(row['URAIAN']);

            if(row['SUMBER_DANA'] == "PDAM"){
                $("#sumber_dana option[value='PDAM']").attr('selected','selected');
            }else{
                $("#sumber_dana option[value='PEMERINTAH KOTA']").attr('selected','selected');
            }

            $('#lokasi').val(row['LOKASI']);
            $('#volume').val(row['JUMLAH']);
            $('#satuan').val(row['SATUAN']);
            $('#harga_satuan').val(NumberToMoney(row['HARGA']));

            if(row['JENIS_ANGGARAN'] == "Barang"){
                $('#id_barang').val(row['ID_BARANG']);
                $('#satuan').prop('readonly',true);
                $('#harga_satuan').prop('readonly',true);
                $('#total').val(NumberToMoney(row['TOTAL']));
                $('#radioExample1').prop('checked',true);
                $('#radioExample2').removeAttr('checked');
                $('#radioExample3').removeAttr('checked');
                $('#view_barang').show();
                $('.view_non_barang').hide();
                $('#ubah_harga').show();
                $('#ubah_harga').removeAttr('disabled');
            }else if(row['JENIS_ANGGARAN'] == "Pekerjaan"){
                $('#id_barang').val("");
                $('#satuan').removeAttr('readonly');
                $('#harga_satuan').removeAttr('readonly');
                $('#total').val(NumberToMoney(row['TOTAL_PELAKSANAAN']));
                $('#tmt_pelaksanaan').val(row['TMT_PELAKSANAAN']);
                $('#lama_pelaksanaan').val(row['LAMA_PELAKSANAAN']);
                $('#radioExample1').removeAttr('checked');
                $('#radioExample2').prop('checked',true);
                $('#radioExample3').removeAttr('checked');
                $('#view_barang').hide();
                $('.view_non_barang').show();
                $('#ubah_harga').hide();
                $('#ubah_harga').prop('disabled',true);
            }else{
                $('#id_barang').val("");
                $('#satuan').removeAttr('readonly');
                $('#harga_satuan').removeAttr('readonly');
                $('#total').val(NumberToMoney(row['TOTAL_PELAKSANAAN']));
                $('#tmt_pelaksanaan').val(row['TMT_PELAKSANAAN']);
                $('#lama_pelaksanaan').val(row['LAMA_PELAKSANAAN']);
                $('#radioExample1').removeAttr('checked');
                $('#radioExample2').removeAttr('checked');
                $('#radioExample3').prop('checked',true);
                $('#view_barang').hide();
                $('.view_non_barang').show();
                $('#ubah_harga').hide();
                $('#ubah_harga').prop('disabled',true);
            }

            $('#januari').val(NumberToMoney(row['JANUARI']));
            $('#februari').val(NumberToMoney(row['FEBRUARI']));
            $('#maret').val(NumberToMoney(row['MARET']));
            $('#april').val(NumberToMoney(row['APRIL']));
            $('#mei').val(NumberToMoney(row['MEI']));
            $('#juni').val(NumberToMoney(row['JUNI']));
            $('#juli').val(NumberToMoney(row['JULI']));
            $('#agustus').val(NumberToMoney(row['AGUSTUS']));
            $('#september').val(NumberToMoney(row['SEPTEMBER']));
            $('#oktober').val(NumberToMoney(row['OKTOBER']));
            $('#november').val(NumberToMoney(row['NOVEMBER']));
            $('#desember').val(NumberToMoney(row['DESEMBER']));

            $('#search_koang').val("")
            $('#popup_koang').css('display','none');
            $('#popup_koang').hide();
        }
    });
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
            $('#uraian_perkiraan').val(row.NAMA_PERKIRAAN);
            $('#search_koper').val("");

            $('#popup_koper').css('display','none');
            $('#popup_koper').hide();
        }
    });
}
</script>

<style>
.select-data {
    display: inline-block;
    position: relative;
    vertical-align: middle;

    margin-left: 0;
    position: relative;

    background-color: #f0f0f0;
    border-color: rgba(0, 0, 0, 0.1);
    color: #666666;

    background-image: none;
    border: 1px solid rgba(0, 0, 0, 0);
    border-radius: 0;
    cursor: pointer;
    display: inline-block;
    font-size: 13px;
    font-weight: normal;
    line-height: 1.5;
    margin-bottom: 0;
    padding: 9px 12px;
    vertical-align: middle;
    white-space: nowrap;

    width: auto;
}

#pesan_balance{
    display: none;
}

</style>

<div id="popup_load">
    <div class="window_load">
        <img src="<?=base_url()?>/ico/loading.gif" height="100" width="100">
    </div>
</div>

<?php if($kunci == "terkunci"){ ?>
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-warning pr10"></i>
    <strong>Maaf, Input Anggaran telah tertutup</strong>
</div>
<?php } ?>

<div class="panel">
    <form class="form-horizontal" role="form" action="<?php echo $url; ?>" method="post" id="form_input">
        <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
            <span class="panel-title"></span>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="col-lg-12" style="margin-top: 8px;">
                    <center>
                        <?php //echo $kunci."-".$ket; ?>
                        <div class="radio-custom radio-primary mb5">
                            <input type="radio" id="radioExample4" name="kategori" value="baru" checked="checked">
                            <label for="radioExample4" style="margin-right: 15px; padding-left: 25px;">Baru</label>

                            <input type="radio" id="radioExample5" name="kategori" value="ubah">
                            <label for="radioExample5" style="margin-right: 15px; padding-left: 25px;">Ubah</label>
                        </div>
                    </center>
                </div>
            </div>

            <hr>

            <div class="form-group admin-form">
                <label for="inputPassword" class="col-lg-3 control-label" id="warna_bagian">Bagian</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="departemen2" name="departemen" style="cursor:pointer;" onchange="get_kode_anggaran(); data_divisi();" <?php echo $disable; ?> >
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

            <div class="form-group admin-form">
                <label for="inputPassword" class="col-lg-3 control-label">Sub Bagian</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="divisi2" name="divisi" style="cursor:pointer;" <?php echo $disable2; ?> >
                   
                                    </select>
                                    <i style="z-index:99;" class="arrow"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group admin-form">
                <label for="inputPassword" class="col-lg-3 control-label">Tahun</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="tahun2" name="tahun" style="cursor:pointer;" onchange="get_kode_anggaran();">
                                        <?php
                                            $thn = date('Y');
                                            for($i=$thn-5; $i<=$thn+2; $i++) {
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

            <hr>

            <div class="form-group data_baru">
                <label for="kode_anggaran" class="col-lg-3 control-label">Kode Anggaran</label>
                <div class="col-lg-3">
                    <input type="text" name="kode_anggaran" id="kode_anggaran" class="form-control" value="" readonly />
                </div>
            </div>

            <div class="form-group ubah_data">
                <label for="kode_anggaran_ubah" class="col-lg-3 control-label">Kode Anggaran</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field">
                                    <input type="hidden" name="id_anggaran" id="id_anggaran" value="">
                                    <input type="text" name="kode_anggaran_ubah" id="kode_anggaran_ubah" class="gui-input" value="" readonly />
                                </label>
                                <a class="button" id="koang">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group data_baru">
                <label for="kelompok_perkiraan" class="col-lg-3 control-label">Kelompok Perkiraan</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field">
                                    <input type="text" name="kelompok_perkiraan" id="kode_perkiraan" class="gui-input" value="" />
                                </label>
                                <a class="button" id="koper">
                                    <i class="fa fa-search"></i>
                                </a>
                                <span class="help-block mt5" style="color:#FF0000;" id="empty_koper"><i class="fa fa-warning"></i> Kode Perkiraan Kosong</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group ubah_data">
                <label for="kelompok_perkiraan_ubah" class="col-lg-3 control-label">Kelompok Perkiraan</label>
                <div class="col-lg-3">
                    <input type="text" name="kelompok_perkiraan_ubah" id="kelompok_perkiraan_ubah" class="form-control" value="" readonly="readonly" />
                </div>
            </div>

            <div class="form-group">
                <label for="disabledInput" class="col-lg-3 control-label">Kategori</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample1" name="jenis_anggaran" value="Barang" checked="checked">
                        <label for="radioExample1" style="margin-right: 15px; padding-left: 25px;">Barang</label>

                        <input type="radio" id="radioExample2" name="jenis_anggaran" value="Pekerjaan">
                        <label for="radioExample2" style="margin-right: 15px; padding-left: 25px;">Pekerjaan</label>

                        <input type="radio" id="radioExample3" name="jenis_anggaran" value="Pelatihan">
                        <label for="radioExample3" style="margin-right: 15px; padding-left: 25px;">Pelatihan</label>
                    </div>
                </div>
            </div>

            <div class="form-group" id="view_barang">
                <label for="inputPassword" class="col-lg-3 control-label">&nbsp;</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field">
                                    <input type="hidden" name="id_barang" id="id_barang" value="">
                                    <input type="text" name="id_jenis_anggaran" id="id_jenis_anggaran" class="gui-input" value="" readonly="readonly" title="Kode Barang">
                                </label>
                                <a class="button" id="kobar">
                                    <i class="fa fa-search"></i>
                                </a>
                                <span class="help-block mt5" style="color:#FF0000;" id="empty_brg"><i class="fa fa-warning"></i> Kode Barang Kosong</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="uraian">Uraian</label>
                <div class="col-lg-8">
                    <textarea class="form-control" name="uraian" id="uraian" rows="3"></textarea>
                    <span class="help-block mt5" style="color:#FF0000;" id="empty_uraian"><i class="fa fa-warning"></i> Uraian Kosong</span>
                </div>
            </div>

            <div class="form-group view_non_barang">
                <label class="col-lg-3 control-label" for="datetimepicker2">TMT Pelaksanaan</label>
                <div class="col-lg-3">
                    <div class="input-group date" id="datetimepicker2">
                        <span class="input-group-addon cursor"><i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" class="form-control" name="tmt_pelaksanaan" id="tmt_pelaksanaan" value="">
                    </div>
                    <span class="help-block mt5" style="color:#FF0000;" id="empty_tmt_plk"><i class="fa fa-warning"></i> TMT Pelaksanaan Kosong</span>
                </div>
            </div>

            <div class="form-group view_non_barang">
                <label class="col-lg-3 control-label" for="datetimepicker2">Lama Pelaksanaan</label>
                <div class="col-lg-3">
                    <div class="input-group">
                        <input type="text" class="form-control num_only" name="lama_pelaksanaan" id="lama_pelaksanaan" value="">
                        <span class="input-group-addon">Hari</span>
                    </div>
                    <span class="help-block mt5" style="color:#FF0000;" id="empty_lama_plk"><i class="fa fa-warning"></i> Lama Pelaksanaan Kosong</span>
                </div>
            </div>

            <div class="form-group admin-form">
                <label for="inputPassword" class="col-lg-3 control-label">Sumber Dana</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-51">
                                <label class="field select">
                                    <select id="sumber_dana" name="sumber_dana" style="cursor:pointer;">
                                    <?php
                                        foreach ($sumber_dana as $value) {
                                    ?>
                                        <option value="<?php echo $value->NAMA; ?>"><?php echo $value->NAMA; ?></option>
                                    <?php
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
                <label for="lokasi" class="col-lg-3 control-label">Lokasi</label>
                <div class="col-lg-3">
                    <input type="text" name="lokasi" id="lokasi" class="form-control" value="">
                    <span class="help-block mt5" style="color:#FF0000;" id="empty_lokasi"><i class="fa fa-warning"></i> Lokasi Kosong</span>
                </div>
            </div>

            <div class="form-group">
                <label for="volume" class="col-lg-3 control-label">Volume</label>
                <div class="col-lg-3">
                    <input type="text" name="volume" id="volume" class="form-control num_only" value="" onkeyup="hitung_total(); balance();" onchange="hitung_total(); balance();">
                    <span class="help-block mt5" style="color:#FF0000;" id="empty_volume"><i class="fa fa-warning"></i> Volume Kosong</span>
                </div>
            </div>

            <div class="form-group">
                <label for="satuan" class="col-lg-3 control-label">Satuan</label>
                <div class="col-lg-3">
                    <input type="text" name="satuan" id="satuan" class="form-control" value="">
                    <span class="help-block mt5" style="color:#FF0000;" id="empty_satuan"><i class="fa fa-warning"></i> Satuan Kosong</span>
                </div>
            </div>

            <div class="form-group">
                <label for="harga_satuan" class="col-lg-3 control-label">Harga Satuan</label>
                <div class="col-lg-3">
                    <input type="text" name="harga_satuan" id="harga_satuan" class="form-control" value="" onkeyup="FormatCurrency(this); hitung_total(); balance();" onchange="hitung_total(); balance();">
                    <span class="help-block mt5" style="color:#FF0000;" id="empty_harga_satuan"><i class="fa fa-warning"></i> Harga Satuan Kosong</span>
                </div>
                <input type="button" name="ubah_harga" id="ubah_harga" value="Ubah Harga" class="btn btn-success" style="font-weight: bold;" disabled="disabled">
                <input type="button" name="simpan_harga" id="simpan_harga" value="Simpan Harga" class="btn btn-primary" style="font-weight: bold;">
            </div>

            <div class="form-group">
                <label for="total" class="col-lg-3 control-label">Total</label>
                <div class="col-lg-3">
                    <input type="text" name="total" id="total" class="form-control" value="" readonly>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="alert alert-warning alert-dismissable" id="pesan_balance">
                    <i class="fa fa-warning pr10"></i>
                    <strong>Perhatian!</strong>
                    <span id="keterangan_pesan"></span>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="januari" class="col-lg-3 control-label">JANUARI</label>
                        <div class="col-lg-8">
                            <input type="text" name="januari" id="januari" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="februari" class="col-lg-3 control-label">FEBRUARI</label>
                        <div class="col-lg-8">
                            <input type="text" name="februari" id="februari" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="maret" class="col-lg-3 control-label">MARET</label>
                        <div class="col-lg-8">
                            <input type="text" name="maret" id="maret" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="april" class="col-lg-3 control-label">APRIL</label>
                        <div class="col-lg-8">
                            <input type="text" name="april" id="april" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mei" class="col-lg-3 control-label">MEI</label>
                        <div class="col-lg-8">
                            <input type="text" name="mei" id="mei" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="juni" class="col-lg-3 control-label">JUNI</label>
                        <div class="col-lg-8">
                            <input type="text" name="juni" id="juni" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="juli" class="col-lg-3 control-label">JULI</label>
                        <div class="col-lg-8">
                            <input type="text" name="juli" id="juli" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="agustus" class="col-lg-3 control-label">AGUSTUS</label>
                        <div class="col-lg-8">
                            <input type="text" name="agustus" id="agustus" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="september" class="col-lg-3 control-label">SEPTEMBER</label>
                        <div class="col-lg-8">
                            <input type="text" name="september" id="september" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="oktober" class="col-lg-3 control-label">OKTOBER</label>
                        <div class="col-lg-8">
                            <input type="text" name="oktober" id="oktober" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="november" class="col-lg-3 control-label">NOVEMBER</label>
                        <div class="col-lg-8">
                            <input type="text" name="november" id="november" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="desember" class="col-lg-3 control-label">DESEMBER</label>
                        <div class="col-lg-8">
                            <input type="text" name="desember" id="desember" class="form-control nominal_bulan" value="" onkeyup="FormatCurrency(this); balance();" onchange="balance();" style="text-align:right;">
                        </div>
                    </div>
                </div>
            </div>  
        </div>

        <div class="panel-footer">
           <center>
                <?php if($kunci == "terbuka"){?>
                <input type="submit" name="simpan" id="simpan" class="btn btn-primary" value="SIMPAN">
                <input type="submit" name="ubah" id="ubah" class="btn btn-primary" value="UBAH" onclick="loading();">
                
                &nbsp;&nbsp;&nbsp;
                <input type="button" name="hapus" id="hapus" class="btn btn-danger" value="HAPUS">
                &nbsp;&nbsp;&nbsp;
                <input type="button" name="batal" id="batal" class="btn btn-danger" value="BATAL">
                <?php } ?>
           </center> 
        </div>

    </form>
</div>

<a id="dialog-btn" href="javascript:;" class="cd-popup-trigger" style="display:none;">View Pop-up</a>
<div class="cd-popup" role="alert">
    <div class="cd-popup-container">

        <form id="delete" method="post" action="<?php echo $url_del; ?>">
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

<!-- KOPER -->
<div id="popup_koper">
    <div class="window_koper">
        <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>ico/cancel.gif" id="pojok"></a>
        <div class="panel-body">
            <input type="text" name="search_koper" id="search_koper" class="form-control" value="" placeholder="Cari perkiraan...">
            <br/>
            <div class="table-responsive">
                <div class="scroll_popup-y">
                    <table class="table table-hover table-bordered" id="tes_koper">
                        <thead>
                            <tr class="primary">
                                <th style="white-space:nowrap; text-align:center;">NO</th>
                                <th style="white-space:nowrap; text-align:center;">KODE PERKIRAAN</th>
                                <th style="white-space:nowrap; text-align:center;">NAMA PERKIRAAN</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $no = 0;
                            foreach ($koper as $value_koper) {
                                $no++;
                        ?>
                            <tr onclick="get_koper_click(<?php echo $value_koper->ID; ?>);" style="cursor:pointer;">
                                <td align="center"><?php echo $no; ?></td>
                                <td align="center"><?php echo $value_koper->KODE_PERKIRAAN; ?></td>
                                <td><?php echo $value_koper->NAMA_PERKIRAAN; ?></td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#koper').click(function(){
        $('#popup_koper').css('display','block');
        $('#popup_koper').show();
    });

    $('#koang').click(function(){
        get_popup_anggaran();
        ajax_anggaran();
    });

    $('#kobar').click(function(){
        tabel_barang();
        get_data_barang();
    });
});
</script>