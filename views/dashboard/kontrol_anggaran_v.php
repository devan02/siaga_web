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
    background: #ec1c24;
} 
.kuning { 
    background: #ffe600;
}
.orange { 
    background: #faa43d;
}
.ungu { 
    background: #8e44ad;
}
.putih { 
    background: #fff;
}
</style>

<script>
var ajax = "";
$(document).ready(function(){
    data_divisi();

    $('.view_th_ag_2').hide();
    $('.view_th_real_2').hide();

    var kriteria = $("input[name='kriteria']:checked").val();
    var kondisi = $("input[name='kondisi']:checked").val();
    var jenis = $("input[name='jenis']:checked").val();
    var periode = $("input[name='periode']:checked").val();
    
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
    
    if(kondisi == "semua_kondisi"){
        $('#view_koper').hide();
        $('#view_koang').hide();
        var periode = $("input[name='periode']:checked").val();
        var jenis = $("input[name='jenis']:checked").val();
        if(jenis == "rinci"){
            if(periode == "1"){
                get_data_anggaran_rinci_rkap();       
            }else{
                get_data_anggaran_rinci_revisi();        
            }
        }else{
            if(periode == "1"){
                get_grid_kontrol_tidak_rinci_rkap();
            }else{
                get_grid_kontrol_tidak_rinci_revisi();
            }
        }
    }else if(kondisi == "per_kode_perkiraan"){
        $('#view_koper').show();
        $('#view_koang').hide();
    }else{
        $('#view_koper').hide();
        $('#view_koang').show();
    }

    if(jenis == "rinci"){
        $('#view_rinci').show();
        $('#view_tidak_rinci').hide();
        if(periode == "1"){
            get_data_anggaran_rinci_rkap();
        }else{
            get_data_anggaran_rinci_revisi();
        }
    }else{
        $('#view_rinci').hide();
        $('#view_tidak_rinci').show();
        if(periode == "1"){
            get_grid_kontrol_tidak_rinci_rkap();
        }else{
            get_grid_kontrol_tidak_rinci_revisi();
        }
    }

    var periode = $("input[name='periode']:checked").val();
    if(periode == "1"){
        $('#ket_periode').html('PERIODE RKAP');
    }else{
        $('#ket_periode').html('PERIODE RKAP REVISI');
    }

    $("input[name='kriteria']").click(function(){
        var kriteria = $("input[name='kriteria']:checked").val();
        var periode = $("input[name='periode']:checked").val();
        var jenis = $("input[name='jenis']:checked").val();

        if(kriteria == "sub_bagian"){
            $('#view_bagian').show();
            $('#view_sub_bagian').show();
            if(jenis == "rinci"){
                if(periode == "1"){
                    get_data_anggaran_rinci_rkap();       
                }else{
                    get_data_anggaran_rinci_revisi();        
                }
            }else{
                if(periode == "1"){
                    get_grid_kontrol_tidak_rinci_rkap();
                }else{
                    get_grid_kontrol_tidak_rinci_revisi();
                }
            }
        }else if(kriteria == "bagian"){ 
            $('#view_bagian').show();
            $('#view_sub_bagian').hide();
            if(jenis == "rinci"){
                if(periode == "1"){
                    get_data_anggaran_rinci_rkap();       
                }else{
                    get_data_anggaran_rinci_revisi();        
                }
            }else{
                if(periode == "1"){
                    get_grid_kontrol_tidak_rinci_rkap();
                }else{
                    get_grid_kontrol_tidak_rinci_revisi();
                }
            }
        }else{
            $('#view_bagian').hide();
            $('#view_sub_bagian').hide();
            if(jenis == "rinci"){
                if(periode == "1"){
                    get_data_anggaran_rinci_rkap();       
                }else{
                    get_data_anggaran_rinci_revisi();        
                }
            }else{
                if(periode == "1"){
                    get_grid_kontrol_tidak_rinci_rkap();
                }else{
                    get_grid_kontrol_tidak_rinci_revisi();
                }
            }
        }
    });

    $("input[name='kondisi']").click(function(){
        var kondisi = $("input[name='kondisi']:checked").val();
        if(kondisi == "semua_kondisi"){
            $('#view_koper').hide();
            $('#view_koang').hide();
            $('#kode_perkiraan').val("");
            $('#kode_anggaran').val("");
            var periode = $("input[name='periode']:checked").val();
            var jenis = $("input[name='jenis']:checked").val();
            if(jenis == "rinci"){
                if(periode == "1"){
                    get_data_anggaran_rinci_rkap();       
                }else{
                    get_data_anggaran_rinci_revisi();        
                }
            }else{
                if(periode == "1"){
                    get_grid_kontrol_tidak_rinci_rkap();
                }else{
                    get_grid_kontrol_tidak_rinci_revisi();
                }
            }
        }else if(kondisi == "per_kode_perkiraan"){
            $('#view_koper').show();
            $('#view_koang').hide();
        }else{
            $('#view_koper').hide();
            $('#view_koang').show();
        }
    });

    $("input[name='jenis']").click(function(){
        var jenis = $("input[name='jenis']:checked").val();
        var periode = $("input[name='periode']:checked").val();
        if(jenis == "rinci"){
            $('#view_rinci').show();
            $('#view_tidak_rinci').hide();
            if(periode == "1"){
                get_data_anggaran_rinci_rkap();
            }else{
                get_data_anggaran_rinci_revisi();
            }
        }else{
            $('#view_rinci').hide();
            $('#view_tidak_rinci').show();
            if(periode == "1"){
                get_grid_kontrol_tidak_rinci_rkap();
            }else{
                get_grid_kontrol_tidak_rinci_revisi();
            }
        }
    });

    $("input[name='periode']").click(function(){
        var periode = $("input[name='periode']:checked").val();
        var jenis = $("input[name='jenis']:checked").val();
        if(periode == "1"){
            $('#ket_periode').html('PERIODE RKAP');
            if(jenis == "rinci"){
                get_data_anggaran_rinci_rkap();
            }else{
                get_grid_kontrol_tidak_rinci_rkap();
            }
        }else{
            $('#ket_periode').html('PERIODE RKAP REVISI');
            if(jenis == "rinci"){
                get_data_anggaran_rinci_revisi();
            }else{
                get_grid_kontrol_tidak_rinci_revisi();
            }
        }
    });

    $('#tahun2').change(function(){
        var jenis = $("input[name='jenis']:checked").val();
        var periode = $("input[name='periode']:checked").val();
        if(jenis == "rinci"){
            $('#view_rinci').show();
            $('#view_tidak_rinci').hide();
            if(periode == "1"){
                get_data_anggaran_rinci_rkap();
            }else{
                get_data_anggaran_rinci_revisi();
            }
        }else{
            $('#view_rinci').hide();
            $('#view_tidak_rinci').show();
            if(periode == "1"){
                get_data_anggaran_rinci_rkap();
            }else{
                get_data_anggaran_rinci_revisi();
            }
        }
    });

    $('#departemen2').change(function(){
        var jenis = $("input[name='jenis']:checked").val();
        var periode = $("input[name='periode']:checked").val();
        if(jenis == "rinci"){
            $('#view_rinci').show();
            $('#view_tidak_rinci').hide();
            if(periode == "1"){
                get_data_anggaran_rinci_rkap();
            }else{
                get_data_anggaran_rinci_revisi();
            }
        }else{
            $('#view_rinci').hide();
            $('#view_tidak_rinci').show();
            if(periode == "1"){
                get_data_anggaran_rinci_rkap();
            }else{
                get_data_anggaran_rinci_revisi();
            }
        }
    });

    $('#divisi2').change(function(){
        var jenis = $("input[name='jenis']:checked").val();
        var periode = $("input[name='periode']:checked").val();
        if(jenis == "rinci"){
            $('#view_rinci').show();
            $('#view_tidak_rinci').hide();
            if(periode == "1"){
                get_data_anggaran_rinci_rkap();
            }else{
                get_data_anggaran_rinci_revisi();
            }
        }else{
            $('#view_rinci').hide();
            $('#view_tidak_rinci').show();
            if(periode == "1"){
                get_data_anggaran_rinci_rkap();
            }else{
                get_data_anggaran_rinci_revisi();
            }
        }
    });

    $('#koper').click(function(){
        tabel_koper();
        get_data_koper();
    });

    $('#koang').click(function(){
        get_popup_anggaran();
        ajax_anggaran();
    });

});

function pesan_kosong(psn){
    var pesan = '<div class="ui-pnotify-icon"><span class="glyphicon glyphicon-warning-sign"></span></div>'+
                '<h4 class="ui-pnotify-title">Kosong</h4>'+
                '<div class="ui-pnotify-text"><strong>'+psn+'</strong></div>';
    // $('#msg_tgl_kosong').show().delay(3000).fadeOut('slow');
    $.jGrowl(pesan, { header: '', life:3000 });
}

//RKAP
function get_grid_kontrol_tidak_rinci_rkap(){
    $('#popup_load').css('display','block');
    $('#popup_load').show();

    var kriteria = $("input[name='kriteria']:checked").val();
    var bagian = $('#departemen2').val();
    var sub_bagian = $('#divisi2').val();
    var tahun = $('#tahun2').val();
    var kode_perkiraan = $('#kode_perkiraan').val();
    var kode_anggaran = $('#kode_anggaran').val();
    var kondisi = $("input[name='kondisi']:checked").val();
    var tanggal = $('#daterangepicker1').val();
    var tgl_awal = tanggal.substr(0,10);
    var tgl_akhir = tanggal.substr(-10);

    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/kontrol_anggaran_c/get_data_anggaran_tidak_rinci_rkap',
        data : {
            kriteria:kriteria,
            bagian:bagian,
            sub_bagian:sub_bagian,
            tahun:tahun,
            kode_perkiraan:kode_perkiraan,
            kode_anggaran:kode_anggaran,
            kondisi:kondisi,
            tgl_awal:tgl_awal,
            tgl_akhir:tgl_akhir
        },
        type : "POST",
        dataType : "json",
        async : false,
        success : function(result){
            $isi = "";
            for(var i=0; i<result.length; i++){
                result[i].ANGGARAN = result[i].ANGGARAN == null? 0:result[i].ANGGARAN;
                result[i].NILAI_REALISASI = result[i].NILAI_REALISASI == null? 0:result[i].NILAI_REALISASI;
                var prosen = 0;
                if(result[i].NILAI_REALISASI > 0 && result[i].ANGGARAN > 0){
                    numb = ((result[i].NILAI_REALISASI/result[i].ANGGARAN)*100);
                    prosen = numb.toFixed(2);
                }

                $isi += "<tr>"+
                        "    <td>"+prosen+" %</td>"+
                        "    <td style='center'>"+result[i].KODE_PERKIRAAN+"</td>"+
                        "    <td>"+result[i].NAMA_PERKIRAAN+"</td>"+
                        "    <td align='right'>"+NumberToMoney(result[i].ANGGARAN)+"</td>"+
                        "    <td align='right'>"+NumberToMoney(result[i].NILAI_REALISASI)+"</td>"+
                        "</tr>";
            }
            $('#data tbody').html($isi);
            $('#popup_load').css('display','none');
            $('#popup_load').hide();
        }
    });
}

function get_data_anggaran_rinci_rkap(){
    $('#popup_load').css('display','block');
    $('#popup_load').show();

    var kriteria = $("input[name='kriteria']:checked").val();
    var bagian = $('#departemen2').val();
    var sub_bagian = $('#divisi2').val();
    var tahun = $('#tahun2').val();
    var kode_perkiraan = $('#kode_perkiraan').val();
    var kode_anggaran = $('#kode_anggaran').val();
    var kondisi = $("input[name='kondisi']:checked").val();
    var tanggal = $('#daterangepicker1').val();
    var tgl_awal = tanggal.substr(0,10);
    var tgl_akhir = tanggal.substr(-10);

    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/kontrol_anggaran_c/get_anggaran_rinci_rkap',
        data : {
            kriteria:kriteria,
            bagian:bagian,
            sub_bagian:sub_bagian,
            tahun:tahun,
            kode_perkiraan:kode_perkiraan,
            kode_anggaran:kode_anggaran,
            kondisi:kondisi,
            tgl_awal:tgl_awal,
            tgl_akhir:tgl_akhir
        },
        type : "POST",
        dataType : "json",
        async : false,
        success : function(result){
            $isi = "";
            if(result == ""){
                $('#data2 tbody').html($isi);
                $('#popup_load').css('display','none');
                $('#popup_load').hide();
                var psn = "Data Tidak Ada";
                pesan_kosong(psn);
            }else{
                for(var i=0; i<result.length; i++){
                    var anggaran = result[i].ANGGARAN = result[i].ANGGARAN == null? 0:result[i].ANGGARAN;
                    var realisasi = result[i].NILAI_REALISASI = result[i].NILAI_REALISASI == null? 0:result[i].NILAI_REALISASI;
                    var prosen = 0;
                    if(realisasi > 0 && anggaran > 0){
                        var numb = ((realisasi/anggaran)*100);
                        prosen = numb.toFixed(2);
                    }

                    $isi += "<tr>"+
                            "    <td style='white-space:nowrap;'><b>"+prosen+" %</b></td>"+
                            "    <td align='center'><b>"+result[i].KODE_PERKIRAAN+"</b></td>"+
                            "    <td></td>"+
                            "    <td style='white-space:nowrap;'><b>"+result[i].NAMA_PERKIRAAN+"</b></td>"+
                            "    <td>&nbsp;</td>"+
                            "    <td align='left' class='view_th_ag_1'><b>"+NumberToMoney(anggaran)+"</b></td>"+
                            "    <td align='left' colspan='12' class='view_th_ag_2'></td>"+
                            "    <td align='left' class='view_th_real_1'><b>"+NumberToMoney(realisasi)+"</b></td>"+
                            "    <td align='left' colspan='12' class='view_th_real_2'></td>"+
                            "</tr>";

                        $.ajax({
                            url : '<?php echo base_url(); ?>dashboard/kontrol_anggaran_c/get_kode_anggaran_rinci_rkap',
                            data : {
                                kriteria:kriteria,
                                kode_perkiraan:result[i].KODE_PERKIRAAN,
                                tahun:tahun,
                                bagian:bagian,
                                sub_bagian:sub_bagian,
                                kondisi:kondisi,
                                tgl_awal:tgl_awal,
                                tgl_akhir:tgl_akhir
                            },
                            type : "GET",
                            dataType : "json",
                            async : false,
                            success : function(res){
                                $.each(res,function(j,data_ag){
                                    if(data_ag.KODE_ANGGARAN != ""){
                                        data_ag.RKAP  = data_ag.RKAP == null? 0:data_ag.RKAP;
                                        data_ag.REALISASI  = data_ag.REALISASI == null? 0:data_ag.REALISASI;

                                        var jan_real = 0;
                                        var feb_real = 0;
                                        var mar_real = 0;
                                        var apr_real = 0;
                                        var mei_real = 0;
                                        var jun_real = 0;
                                        var jul_real = 0;
                                        var agt_real = 0;
                                        var sep_real = 0;
                                        var okt_real = 0;
                                        var nov_real = 0;
                                        var des_real = 0;

                                        var tanggal = $('#daterangepicker1').val();
                                        if(tanggal != ""){
                                            var tanggal_realisasi = data_ag.TANGGAL_REALISASI;
                                            if(parseInt(tanggal_realisasi) == 1){
                                                jan_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 2){
                                                feb_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 3){
                                                mar_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 4){
                                                apr_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 5){
                                                mei_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 6){
                                                jun_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 7){
                                                jul_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 8){
                                                agt_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 9){
                                                sep_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 10){
                                                okt_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 11){
                                                nov_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 12){
                                                des_real = data_ag.REALISASI;
                                            }
                                        }

                                        var warna = data_ag.WARNA;
                                        var warna_real = '';
                                        var color_text = '';

                                        if(warna == 'merah'){
                                            warna_real = 'merah';
                                            color_text = "style='color:#fff;'";
                                        }else if(warna == 'kuning'){
                                            warna_real = 'kuning';
                                            color_text = '';
                                        }else if(warna == 'orange'){
                                            warna_real = 'orange';
                                            color_text = '';
                                        }else{
                                            warna_real = 'putih';
                                            color_text = '';
                                        }

                                        $isi += "<tr class="+warna_real+" "+color_text+" >"+
                                                "    <td></td>"+
                                                "    <td></td>"+
                                                "    <td align='center'>"+data_ag.KODE_ANGGARAN+"</td>"+
                                                "    <td style='white-space:nowrap;'>"+data_ag.URAIAN+"</td>"+
                                                "    <td>&nbsp;</td>"+
                                                "    <td align='right' class='view_th_ag_1'>"+NumberToMoney(data_ag.RKAP)+"</td>"+
                                                "    <td align='right' class='view_1'>"+NumberToMoney(data_ag.JANUARI)+"</td>"+
                                                "    <td align='right' class='view_2'>"+NumberToMoney(data_ag.FEBRUARI)+"</td>"+
                                                "    <td align='right' class='view_3'>"+NumberToMoney(data_ag.MARET)+"</td>"+
                                                "    <td align='right' class='view_4'>"+NumberToMoney(data_ag.APRIL)+"</td>"+
                                                "    <td align='right' class='view_5'>"+NumberToMoney(data_ag.MEI)+"</td>"+
                                                "    <td align='right' class='view_6'>"+NumberToMoney(data_ag.JUNI)+"</td>"+
                                                "    <td align='right' class='view_7'>"+NumberToMoney(data_ag.JULI)+"</td>"+
                                                "    <td align='right' class='view_8'>"+NumberToMoney(data_ag.AGUSTUS)+"</td>"+
                                                "    <td align='right' class='view_9'>"+NumberToMoney(data_ag.SEPTEMBER)+"</td>"+
                                                "    <td align='right' class='view_10'>"+NumberToMoney(data_ag.OKTOBER)+"</td>"+
                                                "    <td align='right' class='view_11'>"+NumberToMoney(data_ag.NOVEMBER)+"</td>"+
                                                "    <td align='right' class='view_12'>"+NumberToMoney(data_ag.DESEMBER)+"</td>"+
                                                "    <td align='right' class='view_th_real_1'>"+NumberToMoney(data_ag.REALISASI)+"</td>"+
                                                "    <td align='right' class='view_real_1'>"+NumberToMoney(jan_real)+"</td>"+
                                                "    <td align='right' class='view_real_2'>"+NumberToMoney(feb_real)+"</td>"+
                                                "    <td align='right' class='view_real_3'>"+NumberToMoney(mar_real)+"</td>"+
                                                "    <td align='right' class='view_real_4'>"+NumberToMoney(apr_real)+"</td>"+
                                                "    <td align='right' class='view_real_5'>"+NumberToMoney(mei_real)+"</td>"+
                                                "    <td align='right' class='view_real_6'>"+NumberToMoney(jun_real)+"</td>"+
                                                "    <td align='right' class='view_real_7'>"+NumberToMoney(jul_real)+"</td>"+
                                                "    <td align='right' class='view_real_8'>"+NumberToMoney(agt_real)+"</td>"+
                                                "    <td align='right' class='view_real_9'>"+NumberToMoney(sep_real)+"</td>"+
                                                "    <td align='right' class='view_real_10'>"+NumberToMoney(okt_real)+"</td>"+
                                                "    <td align='right' class='view_real_11'>"+NumberToMoney(nov_real)+"</td>"+
                                                "    <td align='right' class='view_real_12'>"+NumberToMoney(des_real)+"</td>"+
                                                "</tr>";

                                            $.ajax({
                                                url : '<?php echo base_url(); ?>dashboard/kontrol_anggaran_c/get_no_bukti_rinci_rkap',
                                                data : {id_anggaran:data_ag.ID_ANGGARAN,tahun:tahun,tgl_awal:tgl_awal,tgl_akhir:tgl_akhir},
                                                type : "GET",
                                                dataType : "json",
                                                async : false,
                                                success : function(rest){
                                                    $.each(rest,function(k,data_no_bukti){
                                                        if(data_no_bukti.NO_BUKTI != null){
                                                            data_no_bukti.REALISASI  = data_no_bukti.REALISASI == null? 0:data_no_bukti.REALISASI;
                                                            $isi += "<tr>"+
                                                                        "<td></td>"+
                                                                        "<td></td>"+
                                                                        "<td style='white-space:nowrap;'>"+data_no_bukti.NO_BUKTI+"</td>"+
                                                                        "<td></td>"+
                                                                        "<td class='view_th_bukti_1' align='right'>"+NumberToMoney(data_no_bukti.REALISASI)+"</td>"+
                                                                        "<td class='view_th_bukti_2' align='right'>"+NumberToMoney(data_no_bukti.REALISASI)+"</td>"+
                                                                        "<td class='view_1'>&nbsp;</td>"+
                                                                        "<td class='view_2'>&nbsp;</td>"+
                                                                        "<td class='view_3'>&nbsp;</td>"+
                                                                        "<td class='view_4'>&nbsp;</td>"+
                                                                        "<td class='view_5'>&nbsp;</td>"+
                                                                        "<td class='view_6'>&nbsp;</td>"+
                                                                        "<td class='view_7'>&nbsp;</td>"+
                                                                        "<td class='view_8'>&nbsp;</td>"+
                                                                        "<td class='view_9'>&nbsp;</td>"+
                                                                        "<td class='view_10'>&nbsp;</td>"+
                                                                        "<td class='view_11'>&nbsp;</td>"+
                                                                        "<td class='view_12'>&nbsp;</td>"+
                                                                        "<td class='view_real_1'>&nbsp;</td>"+
                                                                        "<td class='view_real_2'>&nbsp;</td>"+
                                                                        "<td class='view_real_3'>&nbsp;</td>"+
                                                                        "<td class='view_real_4'>&nbsp;</td>"+
                                                                        "<td class='view_real_5'>&nbsp;</td>"+
                                                                        "<td class='view_real_6'>&nbsp;</td>"+
                                                                        "<td class='view_real_7'>&nbsp;</td>"+
                                                                        "<td class='view_real_8'>&nbsp;</td>"+
                                                                        "<td class='view_real_9'>&nbsp;</td>"+
                                                                        "<td class='view_real_10'>&nbsp;</td>"+
                                                                        "<td class='view_real_11'>&nbsp;</td>"+
                                                                        "<td class='view_real_12'>&nbsp;</td>"+
                                                                    "</tr>";
                                                        }
                                                    });
                                                }
                                            });
                                    }
                                });
                            }
                        });
                }
                $('#data2 tbody').html($isi);
                $('#popup_load').css('display','none');
                $('#popup_load').hide();

                $('.view_th_ag_2').hide();
                $('.view_1').hide();
                $('.view_2').hide();
                $('.view_3').hide();
                $('.view_4').hide();
                $('.view_5').hide();
                $('.view_6').hide();
                $('.view_7').hide();
                $('.view_8').hide();
                $('.view_9').hide();
                $('.view_10').hide();
                $('.view_11').hide();
                $('.view_12').hide();

                $('.view_th_real_2').hide();
                $('.view_real_1').hide();
                $('.view_real_2').hide();
                $('.view_real_3').hide();
                $('.view_real_4').hide();
                $('.view_real_5').hide();
                $('.view_real_6').hide();
                $('.view_real_7').hide();
                $('.view_real_8').hide();
                $('.view_real_9').hide();
                $('.view_real_10').hide();
                $('.view_real_11').hide();
                $('.view_real_12').hide();

                $('.view_th_bukti_2').hide();
            }
        }
    });
}

//REVISI
function get_grid_kontrol_tidak_rinci_revisi(){
    $('#popup_load').css('display','block');
    $('#popup_load').show();

    var kriteria = $("input[name='kriteria']:checked").val();
    var bagian = $('#departemen2').val();
    var sub_bagian = $('#divisi2').val();
    var tahun = $('#tahun2').val();
    var kode_perkiraan = $('#kode_perkiraan').val();
    var kode_anggaran = $('#kode_anggaran').val();
    var kondisi = $("input[name='kondisi']:checked").val();
    var tanggal = $('#daterangepicker1').val();
    var tgl_awal = tanggal.substr(0,10);
    var tgl_akhir = tanggal.substr(-10);

    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/kontrol_anggaran_c/get_data_anggaran_tidak_rinci_revisi',
        data : {
            kriteria:kriteria,
            bagian:bagian,
            sub_bagian:sub_bagian,
            tahun:tahun,
            kode_perkiraan:kode_perkiraan,
            kode_anggaran:kode_anggaran,
            kondisi:kondisi,
            tgl_awal:tgl_awal,
            tgl_akhir:tgl_akhir
        },
        type : "POST",
        dataType : "json",
        async : false,
        success : function(result){
            $isi = "";
            for(var i=0; i<result.length; i++){
                result[i].ANGGARAN = result[i].ANGGARAN == null? 0:result[i].ANGGARAN;
                result[i].NILAI_REALISASI = result[i].NILAI_REALISASI == null? 0:result[i].NILAI_REALISASI;
                var prosen = 0;
                if(result[i].NILAI_REALISASI > 0 && result[i].ANGGARAN > 0){
                    numb = ((result[i].NILAI_REALISASI/result[i].ANGGARAN)*100);
                    prosen = numb.toFixed(2);
                }

                $isi += "<tr>"+
                        "    <td>"+prosen+" %</td>"+
                        "    <td style='center'>"+result[i].KODE_PERKIRAAN+"</td>"+
                        "    <td>"+result[i].NAMA_PERKIRAAN+"</td>"+
                        "    <td align='right'>"+NumberToMoney(result[i].ANGGARAN)+"</td>"+
                        "    <td align='right'>"+NumberToMoney(result[i].NILAI_REALISASI)+"</td>"+
                        "</tr>";
            }
            $('#data tbody').html($isi);
            $('#popup_load').css('display','none');
            $('#popup_load').hide();
        }
    });
}

function get_data_anggaran_rinci_revisi(){
    $('#popup_load').css('display','block');
    $('#popup_load').show();

    var kriteria = $("input[name='kriteria']:checked").val();
    var bagian = $('#departemen2').val();
    var sub_bagian = $('#divisi2').val();
    var tahun = $('#tahun2').val();
    var kode_perkiraan = $('#kode_perkiraan').val();
    var kode_anggaran = $('#kode_anggaran').val();
    var kondisi = $("input[name='kondisi']:checked").val();
    var tanggal = $('#daterangepicker1').val();
    var tgl_awal = tanggal.substr(0,10);
    var tgl_akhir = tanggal.substr(-10);

    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/kontrol_anggaran_c/get_anggaran_rinci_revisi',
        data : {
            kriteria:kriteria,
            bagian:bagian,
            sub_bagian:sub_bagian,
            tahun:tahun,
            kode_perkiraan:kode_perkiraan,
            kode_anggaran:kode_anggaran,
            kondisi:kondisi,
            tgl_awal:tgl_awal,
            tgl_akhir:tgl_akhir
        },
        type : "POST",
        dataType : "json",
        async : false,
        success : function(result){
            $isi = "";
            if(result == ""){
                $('#data2 tbody').html($isi);
                $('#popup_load').css('display','none');
                $('#popup_load').hide();
                var psn = "Data Tidak Ada";
                pesan_kosong(psn);
            }else{
                for(var i=0; i<result.length; i++){
                    result[i].ANGGARAN = result[i].ANGGARAN == null? 0:result[i].ANGGARAN;
                    result[i].NILAI_REALISASI = result[i].NILAI_REALISASI == null? 0:result[i].NILAI_REALISASI;
                    var prosen = 0;
                    if(result[i].NILAI_REALISASI > 0 && result[i].ANGGARAN > 0){
                        numb = ((result[i].NILAI_REALISASI/result[i].ANGGARAN)*100);
                        prosen = numb.toFixed(2);
                    }

                    $isi += "<tr>"+
                            "    <td style='white-space:nowrap;'><b>"+prosen+" %</b></td>"+
                            "    <td align='center'><b>"+result[i].KODE_PERKIRAAN+"</b></td>"+
                            "    <td></td>"+
                            "    <td style='white-space:nowrap;'><b>"+result[i].NAMA_PERKIRAAN+"</b></td>"+
                            "    <td>&nbsp;</td>"+
                            "    <td align='left' class='view_th_ag_1'><b>"+NumberToMoney(result[i].ANGGARAN)+"</b></td>"+
                            "    <td align='left' colspan='12' class='view_th_ag_2'></td>"+
                            "    <td align='left' class='view_th_real_1'><b>"+NumberToMoney(result[i].NILAI_REALISASI)+"</b></td>"+
                            "    <td align='left' colspan='12' class='view_th_real_2'></td>"+
                            "</tr>";

                        $.ajax({
                            url : '<?php echo base_url(); ?>dashboard/kontrol_anggaran_c/get_kode_anggaran_rinci_revisi',
                            data : {
                                kriteria:kriteria,
                                kode_perkiraan:result[i].KODE_PERKIRAAN,
                                tahun:tahun,
                                bagian:bagian,
                                sub_bagian:sub_bagian,
                                kondisi:kondisi,
                                tgl_awal:tgl_awal,
                                tgl_akhir:tgl_akhir
                            },
                            type : "GET",
                            dataType : "json",
                            async : false,
                            success : function(res){
                                $.each(res,function(j,data_ag){
                                    if(data_ag.KODE_ANGGARAN != ""){
                                        data_ag.RKAP  = data_ag.RKAP == null? 0:data_ag.RKAP;
                                        data_ag.REALISASI  = data_ag.REALISASI == null? 0:data_ag.REALISASI;

                                        var jan_real = 0;
                                        var feb_real = 0;
                                        var mar_real = 0;
                                        var apr_real = 0;
                                        var mei_real = 0;
                                        var jun_real = 0;
                                        var jul_real = 0;
                                        var agt_real = 0;
                                        var sep_real = 0;
                                        var okt_real = 0;
                                        var nov_real = 0;
                                        var des_real = 0;

                                        var tanggal = $('#daterangepicker1').val();
                                        if(tanggal != ""){
                                            var tanggal_realisasi = data_ag.TANGGAL_REALISASI;
                                            if(parseInt(tanggal_realisasi) == 1){
                                                jan_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 2){
                                                feb_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 3){
                                                mar_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 4){
                                                apr_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 5){
                                                mei_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 6){
                                                jun_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 7){
                                                jul_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 8){
                                                agt_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 9){
                                                sep_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 10){
                                                okt_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 11){
                                                nov_real = data_ag.REALISASI;
                                            }else if(parseInt(tanggal_realisasi) == 12){
                                                des_real = data_ag.REALISASI;
                                            }
                                        }

                                        var warna = data_ag.WARNA;
                                        var warna_real = '';
                                        var color_text = '';

                                        if(warna == 'merah'){
                                            warna_real = 'merah';
                                            color_text = "style='color:#fff;'";
                                        }else if(warna == 'kuning'){
                                            warna_real = 'kuning';
                                            color_text = '';
                                        }else if(warna == 'orange'){
                                            warna_real = 'orange';
                                            color_text = '';
                                        }else{
                                            warna_real = 'putih';
                                            color_text = '';
                                        }

                                        $isi += "<tr class="+warna_real+" "+color_text+" >"+
                                                "    <td></td>"+
                                                "    <td></td>"+
                                                "    <td align='center'>"+data_ag.KODE_ANGGARAN+"</td>"+
                                                "    <td style='white-space:nowrap;'>"+data_ag.URAIAN+"</td>"+
                                                "    <td>&nbsp;</td>"+
                                                "    <td align='right' class='view_th_ag_1'>"+NumberToMoney(data_ag.RKAP)+"</td>"+
                                                "    <td align='right' class='view_1'>"+NumberToMoney(data_ag.JANUARI)+"</td>"+
                                                "    <td align='right' class='view_2'>"+NumberToMoney(data_ag.FEBRUARI)+"</td>"+
                                                "    <td align='right' class='view_3'>"+NumberToMoney(data_ag.MARET)+"</td>"+
                                                "    <td align='right' class='view_4'>"+NumberToMoney(data_ag.APRIL)+"</td>"+
                                                "    <td align='right' class='view_5'>"+NumberToMoney(data_ag.MEI)+"</td>"+
                                                "    <td align='right' class='view_6'>"+NumberToMoney(data_ag.JUNI)+"</td>"+
                                                "    <td align='right' class='view_7'>"+NumberToMoney(data_ag.JULI)+"</td>"+
                                                "    <td align='right' class='view_8'>"+NumberToMoney(data_ag.AGUSTUS)+"</td>"+
                                                "    <td align='right' class='view_9'>"+NumberToMoney(data_ag.SEPTEMBER)+"</td>"+
                                                "    <td align='right' class='view_10'>"+NumberToMoney(data_ag.OKTOBER)+"</td>"+
                                                "    <td align='right' class='view_11'>"+NumberToMoney(data_ag.NOVEMBER)+"</td>"+
                                                "    <td align='right' class='view_12'>"+NumberToMoney(data_ag.DESEMBER)+"</td>"+
                                                "    <td align='right' class='view_th_real_1'>"+NumberToMoney(data_ag.REALISASI)+"</td>"+
                                                "    <td align='right' class='view_real_1'>"+NumberToMoney(jan_real)+"</td>"+
                                                "    <td align='right' class='view_real_2'>"+NumberToMoney(feb_real)+"</td>"+
                                                "    <td align='right' class='view_real_3'>"+NumberToMoney(mar_real)+"</td>"+
                                                "    <td align='right' class='view_real_4'>"+NumberToMoney(apr_real)+"</td>"+
                                                "    <td align='right' class='view_real_5'>"+NumberToMoney(mei_real)+"</td>"+
                                                "    <td align='right' class='view_real_6'>"+NumberToMoney(jun_real)+"</td>"+
                                                "    <td align='right' class='view_real_7'>"+NumberToMoney(jul_real)+"</td>"+
                                                "    <td align='right' class='view_real_8'>"+NumberToMoney(agt_real)+"</td>"+
                                                "    <td align='right' class='view_real_9'>"+NumberToMoney(sep_real)+"</td>"+
                                                "    <td align='right' class='view_real_10'>"+NumberToMoney(okt_real)+"</td>"+
                                                "    <td align='right' class='view_real_11'>"+NumberToMoney(nov_real)+"</td>"+
                                                "    <td align='right' class='view_real_12'>"+NumberToMoney(des_real)+"</td>"+
                                                "</tr>";

                                            $.ajax({
                                                url : '<?php echo base_url(); ?>dashboard/kontrol_anggaran_c/get_no_bukti_rinci_revisi',
                                                data : {id_anggaran:data_ag.ID_ANGGARAN,tahun:tahun,tgl_awal:tgl_awal,tgl_akhir:tgl_akhir},
                                                type : "GET",
                                                dataType : "json",
                                                async : false,
                                                success : function(rest){
                                                    $.each(rest,function(k,data_no_bukti){
                                                        if(data_no_bukti.NO_BUKTI != null){
                                                            data_no_bukti.REALISASI  = data_no_bukti.REALISASI == null? 0:data_no_bukti.REALISASI;
                                                            $isi += "<tr>"+
                                                                        "<td></td>"+
                                                                        "<td></td>"+
                                                                        "<td style='white-space:nowrap;'>"+data_no_bukti.NO_BUKTI+"</td>"+
                                                                        "<td></td>"+
                                                                        "<td class='view_th_bukti_1' align='right'>"+NumberToMoney(data_no_bukti.REALISASI)+"</td>"+
                                                                        "<td class='view_th_bukti_2' align='right'>"+NumberToMoney(data_no_bukti.REALISASI)+"</td>"+
                                                                        "<td class='view_1'>&nbsp;</td>"+
                                                                        "<td class='view_2'>&nbsp;</td>"+
                                                                        "<td class='view_3'>&nbsp;</td>"+
                                                                        "<td class='view_4'>&nbsp;</td>"+
                                                                        "<td class='view_5'>&nbsp;</td>"+
                                                                        "<td class='view_6'>&nbsp;</td>"+
                                                                        "<td class='view_7'>&nbsp;</td>"+
                                                                        "<td class='view_8'>&nbsp;</td>"+
                                                                        "<td class='view_9'>&nbsp;</td>"+
                                                                        "<td class='view_10'>&nbsp;</td>"+
                                                                        "<td class='view_11'>&nbsp;</td>"+
                                                                        "<td class='view_12'>&nbsp;</td>"+
                                                                        "<td class='view_real_1'>&nbsp;</td>"+
                                                                        "<td class='view_real_2'>&nbsp;</td>"+
                                                                        "<td class='view_real_3'>&nbsp;</td>"+
                                                                        "<td class='view_real_4'>&nbsp;</td>"+
                                                                        "<td class='view_real_5'>&nbsp;</td>"+
                                                                        "<td class='view_real_6'>&nbsp;</td>"+
                                                                        "<td class='view_real_7'>&nbsp;</td>"+
                                                                        "<td class='view_real_8'>&nbsp;</td>"+
                                                                        "<td class='view_real_9'>&nbsp;</td>"+
                                                                        "<td class='view_real_10'>&nbsp;</td>"+
                                                                        "<td class='view_real_11'>&nbsp;</td>"+
                                                                        "<td class='view_real_12'>&nbsp;</td>"+
                                                                    "</tr>";
                                                        }
                                                    });
                                                }
                                            });
                                    }
                                });
                            }
                        });
                }
                $('#data2 tbody').html($isi);
                $('#popup_load').css('display','none');
                $('#popup_load').hide();

                $('.view_th_ag_2').hide();
                $('.view_1').hide();
                $('.view_2').hide();
                $('.view_3').hide();
                $('.view_4').hide();
                $('.view_5').hide();
                $('.view_6').hide();
                $('.view_7').hide();
                $('.view_8').hide();
                $('.view_9').hide();
                $('.view_10').hide();
                $('.view_11').hide();
                $('.view_12').hide();

                $('.view_th_real_2').hide();
                $('.view_real_1').hide();
                $('.view_real_2').hide();
                $('.view_real_3').hide();
                $('.view_real_4').hide();
                $('.view_real_5').hide();
                $('.view_real_6').hide();
                $('.view_real_7').hide();
                $('.view_real_8').hide();
                $('.view_real_9').hide();
                $('.view_real_10').hide();
                $('.view_real_11').hide();
                $('.view_real_12').hide();

                $('.view_th_bukti_2').hide();
            }
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
        }
    });
}

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
        url : '<?php echo base_url(); ?>dashboard/kode_perkiraan_c/get_kode_perkiraan',
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

            $('#popup_koper').css('display','none');
            $('#popup_koper').hide();

            var jenis = $("input[name='jenis']:checked").val();
            if(jenis == "rinci"){
                get_data_anggaran_rinci_rkap();
            }else{
                get_grid_kontrol_tidak_rinci_rkap();
            }
        }
    });
}

//LOAD KODE ANGGARAN
function get_popup_anggaran(){
    var base_url = '<?php echo base_url(); ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input type="text" name="search_koang" id="search_koang" class="form-control" value="" placeholder="Cari perkiraan...">'+
                '    <br/>'+
                '    <div class="table-responsive">'+
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

function ajax_anggaran(){
    var keyword = $('#search_koang').val();
    var bagian = $('#departemen2').val();
    var sub_bagian = $('#divisi2').val();
    var tahun = $('#tahun2').val();
    
    if(ajax){
        ajax.abort();
    }

    ajax = $.ajax({
        url : '<?php echo base_url(); ?>dashboard/kode_anggaran_c/get_kd_anggaran_revisi',
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
                isine += '<tr style="cursor:pointer;" onclick=get_anggaran_id("'+res.KODE_ANGGARAN+'");>'+
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
        url : '<?php echo base_url(); ?>dashboard/input_revisi_rkap_c/get_anggaran_by_id',
        data : {kode_anggaran:kode_anggaran},
        type : "POST",
        dataType : "json",
        async : false,
        success :  function(row){
            $('#kode_anggaran').val(row['KODE_ANGGARAN']);
            $('#search_koang').val("")
            $('#popup_koang').css('display','none');
            $('#popup_koang').hide();
            
            var jenis = $("input[name='jenis']:checked").val();
            if(jenis == "rinci"){
                get_data_anggaran_rinci_rkap();
            }else{
                get_grid_kontrol_tidak_rinci_rkap();
            }
        }
    });
}
</script>
<div id="popup_load">
    <div class="window_load">
        <img src="<?=base_url()?>/ico/loading.gif" height="100" width="100">
    </div>
</div>

<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <form class="form-horizontal" role="form" id="form_kontrol">
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
                <label for="disabledInput" class="col-lg-3 control-label">Periode</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample9" name="periode" value="1" checked="checked">
                        <label for="radioExample9" style="margin-right: 15px; padding-left: 25px;">RKAP</label>

                        <input type="radio" id="radioExample10" name="periode" value="2">
                        <label for="radioExample10" style="margin-right: 15px; padding-left: 25px;">RKAP REVISI</label>
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

            <div class="form-group">
                <label for="disabledInput" class="col-lg-3 control-label">Kondisi</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample4" name="kondisi" value="semua_kondisi" checked="">
                        <label for="radioExample4" style="margin-right: 15px; padding-left: 25px;">Semua</label>

                        <input type="radio" id="radioExample5" name="kondisi" value="per_kode_perkiraan">
                        <label for="radioExample5" style="margin-right: 15px; padding-left: 25px;">Per Kode Perkiraan</label>

                        <input type="radio" id="radioExample6" name="kondisi" value="per_kode_anggaran">
                        <label for="radioExample6" style="margin-right: 15px; padding-left: 25px;">Per Kode Anggaran</label>

                    </div>
                </div>
            </div>

            <div class="form-group" id="view_koper">
                <label for="kode_perkiraan" class="col-lg-3 control-label">Kode Perkiraan</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field">
                                    <input type="text" name="kode_perkiraan" id="kode_perkiraan" class="gui-input" value="" readonly />
                                </label>
                                <a class="button" id="koper">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group" id="view_koang">
                <label for="kode_perkiraan" class="col-lg-3 control-label">Kode Anggaran</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field">
                                    <input type="text" name="kode_anggaran" id="kode_anggaran" class="gui-input" value="" readonly />
                                </label>
                                <a class="button" id="koang">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
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
                                    <select id="departemen2" name="departemen" style="cursor:pointer;" onchange="data_divisi();">
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
                                    <select id="divisi2" name="divisi" style="cursor:pointer;">
                   
                                    </select>
                                    <i style="z-index:99;" class="arrow"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="disabledInput" class="col-lg-3 control-label">&nbsp;</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample7" name="jenis" value="rinci" checked="">
                        <label for="radioExample7" style="margin-right: 15px; padding-left: 25px;">Rinci</label>

                        <input type="radio" id="radioExample8" name="jenis" value="tidak_rinci">
                        <label for="radioExample8" style="margin-right: 15px; padding-left: 25px;">Tidak Rinci</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Tanggal</label>
                <div class="col-lg-4">
                    <div class="admin-form">
                        <div class="smart-widget sm-right smr-50">
                            <label class="field">
                                <input type="text" class="gui-input" name="daterange" id="daterangepicker1" readonly >
                            </label>
                            <a class="button" id="cari_tanggal">
                                <i class="fa fa-check"></i>
                            </a>
                        </div>
                        <span class="help-block mt5"><i class="fa fa-bell"></i> Isi tanggal diatas dengan cara diklik</span>
                    </div>
                </div>
            </div>

        </div>

        <br/>

        <div id="pt0" class="panel panel-transparent">
            <h5 class="text-muted mb20 text-center" id="ket_periode"></h5>
        </div>

        <!-- TIDAK RINCI -->
        <div class="panel-body" id="view_tidak_rinci">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">
                        <span class="glyphicons glyphicons-table"></span>KONTROL ANGGARAN TIDAK RINCI
                    </span>
                </div>
                <div class="panel-body pn">
                    <table class="table table-bordered" id="data">
                        <thead>
                            <tr class="primary">
                                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">%</th>
                                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Kode Perkiraan</th>
                                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Nama</th>
                                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Anggaran</th>
                                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Realisasi</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- RINCI -->
        <div class="panel-body" id="view_rinci">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">
                        <span class="glyphicons glyphicons-table"></span>KONTROL ANGGARAN RINCI
                    </span>
                </div>
                <div class="panel-body pn">
                    <div class="scroll-xy">
                        <table class="table table-bordered" id="data2">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="primary" rowspan="2">%</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="primary" rowspan="2">Kode Perkiraan</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="primary" rowspan="2">Kode Anggaran</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="primary" rowspan="2">Uraian</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="primary" rowspan="2">Nilai No. Bukti</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="success view_th_ag_2">Anggaran</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="success view_th_ag_1" rowspan="2">Anggaran</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="warning view_th_real_2">Realisasi</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="warning view_th_real_1" rowspan="2">Realisasi</th>
                                </tr>
                                <tr id="tr_bulan">
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="success view_1">Januari</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="success view_2">Februari</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="success view_3">Maret</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="success view_4">April</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="success view_5">Mei</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="success view_6">Juni</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="success view_7">Juli</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="success view_8">Agustus</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="success view_9">September</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="success view_10">Oktober</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="success view_11">November</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="success view_12">Desember</th>

                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="warning view_real_1">Januari</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="warning view_real_2">Februari</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="warning view_real_3">Maret</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="warning view_real_4">April</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="warning view_real_5">Mei</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="warning view_real_6">Juni</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="warning view_real_7">Juli</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="warning view_real_8">Agustus</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="warning view_real_9">September</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="warning view_real_10">Oktober</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="warning view_real_11">November</th>
                                    <th style="vertical-align: middle; text-align:center; white-space:nowrap;" class="warning view_real_12">Desember</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
$(document).ready(function(){
    // $('.view_1').hide();
    // $('.view_2').hide();
    // $('.view_3').hide();
    // $('.view_4').hide();
    // $('.view_5').hide();
    // $('.view_6').hide();
    // $('.view_7').hide();
    // $('.view_8').hide();
    // $('.view_9').hide();
    // $('.view_10').hide();
    // $('.view_11').hide();
    // $('.view_12').hide();

    $('#cari_tanggal').click(function(){
        var tanggal = $('#daterangepicker1').val();
        var tgl_awal = tanggal.substr(3,2);
        var tgl_akhir = tanggal.substr(-7,2);
        tgl_awal = parseInt(tgl_awal);
        tgl_akhir = parseInt(tgl_akhir);

        // for(var i=tgl_awal; i<=tgl_akhir; i++){
        //     $('.view_'+i).removeClass('view_th_bulan');
        //     $('.view_real_'+i).removeClass('view_real_th_bulan');
        // }

        if(tanggal != ""){
            var periode = $("input[name='periode']:checked").val();
            var jenis = $("input[name='jenis']:checked").val();
            if(periode == "1"){
                $('#ket_periode').html('PERIODE RKAP');
                if(jenis == "rinci"){
                    get_data_anggaran_rinci_rkap();
                }else{
                    get_grid_kontrol_tidak_rinci_rkap();
                }
            }else{
                $('#ket_periode').html('PERIODE RKAP REVISI');
                if(jenis == "rinci"){
                    get_data_anggaran_rinci_revisi();
                }else{
                    get_grid_kontrol_tidak_rinci_revisi();
                }
            }

            var hasil_tanggal = tgl_akhir - tgl_awal;

            if(hasil_tanggal == 0){
                for(var i=tgl_awal; i<=tgl_akhir; i++){
                    $('.view_'+i).addClass('view_th_bulan');
                    $('.view_real_'+i).addClass('view_real_th_bulan');
                    $('.view_'+i).show();
                    $('.view_real_'+i).show();
                }
                $('.view_th_ag_2').attr('colspan','1');
                $('.view_th_real_2').attr('colspan','1');
            }else{
                for(var i=tgl_awal; i<=tgl_akhir; i++){
                    $('.view_'+i).addClass('view_th_bulan');
                    $('.view_real_'+i).addClass('view_real_th_bulan');
                    $('.view_'+i).show();
                    $('.view_real_'+i).show();
                }
                x = $('.view_th_bulan').length;
                z = $('.view_real_th_bulan').length;
                $('.view_th_ag_2').attr('colspan',x);
                $('.view_th_real_2').attr('colspan',z);
            }

            $('.view_th_ag_1').hide();
            $('.view_th_ag_2').show();

            $('.view_th_real_1').hide();
            $('.view_th_real_2').show();
            
            $('.view_th_bukti_1').show();
            $('.view_th_bukti_2').hide();
        }else{
            var psn = "Tanggal Harus Diisi!";
            pesan_kosong(psn);
        }

    });
});
</script>