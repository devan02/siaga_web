<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script>
var ajax = "";
$(document).ready(function(){
    <?php
        if($this->session->flashdata('sukses')){
    ?>
        pesan_sukses();
    <?php
        }else if($this->session->flashdata('hapus')){
    ?>
        pesan_hapus();
    <?php
        }
    ?>

    data_divisi();
    get_anggaran();

    $('#empty_koper').hide();
    $('#view_barang').hide();
    $('.view_non_barang').hide();
    $('#view_anggaran_tambahan').hide();
    $('#tabel_spm').hide();

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
    // $('#tidak_ada_data').hide();

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

    var jenis_anggaran = $("input[name='jenis_anggaran']:checked").val();
    if(jenis_anggaran == "Barang"){
        $('#view_barang').show();
        $('.view_non_barang').hide();
        $('#uraian').prop('readonly',true);
        $('#satuan').prop('readonly',true);
        $('#harga_satuan').prop('readonly',true);
        $('#ubah_harga').removeAttr('disabled');
        $('#ubah_harga').show();
    }else{ 
        $('#view_barang').hide();
        $('.view_non_barang').show();
        $('#uraian').removeAttr('readonly');
        $('#satuan').removeAttr('readonly');
        $('#harga_satuan').removeAttr('readonly');
        $('#ubah_harga').hide();
    }

    var cari_data = $("input[name='cari_data']:checked").val();
    if(cari_data == "semua_data"){
        $('.view_per_koper').hide();
    }else{
        $('.view_per_koper').show();
    }

    $("input[name='cari_data']").click(function(){
        var cari_data = $("input[name='cari_data']:checked").val();
        if(cari_data == "semua_data"){
            $('.view_per_koper').hide();
            $('#kode_perkiraan').val("");
            $('#uraian_perkiraan').val("");
            get_anggaran();
        }else{
            $('.view_per_koper').show();
        }   
    });
    
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
        }
    });

    $("input[name='jenis_realisasi']").click(function(){
        var jenis_realisasi = $("input[name='jenis_realisasi']:checked").val();
        if(jenis_realisasi == "DPBM"){
            $('#judul_tabel_dpbm').html('DPBM');
            //DPBM
            $('#view_dpbm').css('display','block');
            $('#view_dpbm').show();
            $('#tabel_dpbm').css('display','block');
            $('#tabel_dpbm').show();
            //RAB
            $('#view_rab').css('display','none');
            $('#view_rab').hide();
            $('#tabel_rab').css('display','none');
            $('#tabel_rab').hide();
            $('#id_rab').val("");
            $('#id_det_rab').val("");
            $('#no_rab').val("");
            $('#jenis_rab').val("");
            $('#harga_rab').val("");
            $('#jumlah_rab').val("");
            $('#no_keu_rab').val("");
            //---
            $('#id_spk').val("");
            $('#no_spk').val("");
            $('#biaya_kontrak_spk').val("");
            $('#spk_adendum').val("");
            $('#nilai_spk_adendum').val("");
            //SPM
            $('#view_spm').css('display','none');
            $('#view_spm').hide();
            $('#tabel_spm').css('display','none');
            $('#tabel_spm').hide();
        }else if(jenis_realisasi == "RAB"){
            $('#judul_tabel_rab').html('RAB');
            //DPBM
            $('#view_dpbm').css('display','none');
            $('#view_dpbm').hide();
            $('#tabel_dpbm').css('display','none');
            $('#tabel_dpbm').hide();
            $('#id_dpbm').val("");
            $('#id_det_dpbm').val("");
            $('#no_dpbm').val("");
            $('#harga_dpbm').val("");
            $('#harga_total_dpbm').val("");
            $('#jumlah_dpbm').val("");
            $('#no_keu_dpbm').val("");
            //RAB
            $('#view_rab').css('display','block');
            $('#view_rab').show();
            $('#tabel_rab').css('display','block');
            $('#tabel_rab').show();
            //SPM
            $('#view_spm').css('display','none');
            $('#view_spm').hide();
            $('#tabel_spm').css('display','none');
            $('#tabel_spm').hide();
        }else if(jenis_realisasi == "SPM"){
            $('#judul_tabel_spm').html('SPM');
            //SPM
            $('#view_spm').css('display','block');
            $('#view_spm').show();
            $('#tabel_spm').css('display','block');
            $('#tabel_spm').show();
            //DPBM
            $('#view_dpbm').css('display','none');
            $('#view_dpbm').hide();
            $('#tabel_dpbm').css('display','none');
            $('#tabel_dpbm').hide();
            //RAB
            $('#view_rab').css('display','none');
            $('#view_rab').hide();
            $('#tabel_rab').css('display','none');
            $('#tabel_rab').hide();
        }
    });

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

    $('#pencarian').off('keyup').keyup(function(){
        get_anggaran();
    });

    $("input[name='jenis_anggaran']").click(function(){
        var jenis_anggaran = $("input[name='jenis_anggaran']:checked").val();
        if(jenis_anggaran == "Barang"){
            $('#view_barang').show();
            $('.view_non_barang').hide();
            $('#uraian_tambahan').prop('readonly',true);
            $('#satuan').prop('readonly',true);
            $('#harga_satuan').prop('readonly',true);

            $('#id_jenis_anggaran').val("");
            $('#uraian_tambahan').val("");
            $('#satuan').val("");
            $('#harga_satuan').val("");
            $('#ubah_harga').removeAttr('disabled');
            $('#ubah_harga').show();
        }else{ 
            $('#view_barang').hide();
            $('.view_non_barang').show();
            $('#uraian_tambahan').removeAttr('readonly');
            $('#satuan').removeAttr('readonly');
            $('#harga_satuan').removeAttr('readonly');

            $('#id_jenis_anggaran').val("");
            $('#uraian_tambahan').val("");
            $('#satuan').val("");
            $('#harga_satuan').val("");
            $('#ubah_harga').hide();
        }
    });
    
    $('#tambah_baru').click(function(){
        if($('#kode_perkiraan').val() == ""){
            // $('.view_per_koper').show();
            // $('#empty_koper').show();
            // $('#empty_koper').delay(3000).fadeOut('slow');
            // $('body,html').animate({
            //         scrollTop : 0 // Scroll to top of body
            // }, 500);
            alert('Pilih Kode Perkiraan Dahulu!');
        }else{
            $('#datetimepicker2').datetimepicker();
            get_kode_anggaran();

            var bagian = $('#departemen2').val();
            var sub_bagian = $('#divisi2').val();
            var tahun = $('#tahun2').val();
            var koper = $('#kode_perkiraan').val();
            var uraian = $('#uraian_perkiraan').val();
            
            $('#id_bagian_tambahan').val(bagian);
            get_bagian_id(bagian);

            $('#id_sub_bagian_tambahan').val(sub_bagian);
            get_sub_bagian_id(sub_bagian);

            $('#tahun_tambahan').val(tahun);
            $('#koper_tambahan').val(koper);
            $('#uraian_koper_tambahan').val(uraian);
            $('#view_anggaran_tambahan').show();
            $('#view_realisasi').hide();

            $('#view_barang').show();
            $('.view_non_barang').hide();
            $('#uraian_tambahan').prop('readonly',true);
            $('#satuan').prop('readonly',true);
            $('#harga_satuan').prop('readonly',true);

            $('#id_jenis_anggaran').val("");
            $('#uraian_tambahan').val("");
            $('#satuan').val("");
            $('#harga_satuan').val("");
            $('#ubah_harga').prop('disabled',true);
        }
    });

    $('#batal_tambahan').click(function(){
        $('#form_tambah_baru').find("input").val("");
        $('#view_anggaran_tambahan').hide();
        $('#view_realisasi').show();
        var jenis_anggaran = $("input[name='jenis_anggaran']:checked").val();
        if(jenis_anggaran == "Barang"){
            $('#view_barang').show();
            $('.view_non_barang').hide();
            $('#uraian_tambahan').prop('readonly',true);
            $('#satuan').prop('readonly',true);
            $('#harga_satuan').prop('readonly',true);

            $('#id_jenis_anggaran').val("");
            $('#uraian_tambahan').val("");
            $('#satuan').val("");
            $('#harga_satuan').val("");
            $('#ubah_harga').removeAttr('disabled');
        }else{ 
            $('#view_barang').hide();
            $('.view_non_barang').show();
            $('#uraian_tambahan').removeAttr('readonly');
            $('#satuan').removeAttr('readonly');
            $('#harga_satuan').removeAttr('readonly');

            $('#id_jenis_anggaran').val("");
            $('#uraian_tambahan').val("");
            $('#satuan').val("");
            $('#harga_satuan').val("");
            $('#ubah_harga').prop('disabled',true);
        }
        $('#ubah_harga').css('display','block');
        $('#simpan_harga').css('display','none');
        $('#ubah_harga').val("Ubah Harga");
        $('#simpan_harga').val("Simpan Harga");
    });

    $('#tahun2').click(function(){
        get_anggaran();
    });

    $('#departemen2').click(function(){
        get_anggaran();
    });

    $('#divisi2').click(function(){
        get_anggaran();
    });

    $('#simpan').click(function(){
        // $('#popup_load').css('display','block');
        // $('#popup_load').show();
        $.ajax({
            url : '<?php echo base_url(); ?>dashboard/realisasi_anggaran_c/simpan_realisasi',
            data : $('#form_ag').serialize(),
            type : "POST",
            dataType : "json",
            async : false,
            success : function(result){
                setTimeout(function(){
                    $('#popup_load').css('display','none');
                    $('#popup_load').hide();
                    pesan_sukses();
                }, 2000);

                var id_anggaran = $('#id_anggaran').val();
                var jenis_realisasi = $("input[name='jenis_realisasi']:checked").val();

                if(jenis_realisasi == "DPBM"){
                    // console.log('DPBM');
                    $('#id_dpbm').val("");
                    $('#id_det_dpbm').val("");
                    $('#no_dpbm').val("");
                    $('#no_keu_dpbm').val("");
                    $('#harga_dpbm').val("");
                    $('#harga_total_dpbm').val("");
                    $('#jumlah_dpbm').val("");
                    get_realisasi_dpbm(id_anggaran);

                }else if(jenis_realisasi == "RAB"){
                    // console.log('RAB');
                    $('#no_rab').val("");
                    $('#no_keu_rab').val("");
                    $('#jenis_rab').val("");
                    $('#harga_rab').val("");
                    $('#jumlah_rab').val("");
                    $('#id_rab').val("");
                    $('#id_det_rab').val("");
                    $('#id_spk').val("");
                    $('#no_spk').val("");
                    $('#biaya_kontrak_spk').val("");
                    $('#spk_adendum').val("");
                    $('#nilai_spk_adendum').val("");
                    get_realisasi_rab(id_anggaran);

                }else if(jenis_realisasi == "SPM"){
                    // console.log('SPM');
                    $('#id_spm').val("");
                    $('#no_spm').val("");
                    $('#no_keu_spm').val("");
                    $('#ket_spm').val("");
                    $('#total_spm').val("");
                    get_realisasi_spm(id_anggaran);
                }
                get_anggaran();
            }
        });
    });

    $('#simpan_tambahan').click(function(){
        $('#popup_load').css('display','block');
        $('#popup_load').show();
        $.ajax({
            url : '<?php echo base_url(); ?>dashboard/realisasi_anggaran_c/simpan_anggaran_tambahan',
            data : $('#form_tambah_anggaran').serialize(),
            type : "POST",
            dataType : "json",
            async : false,
            success : function(result){
                setTimeout(function(){
                    $('#popup_load').css('display','none');
                    $('#popup_load').hide();
                    pesan_sukses();
                }, 2000);

                $('#no_surat').val("");
                $('#uraian_surat').val("");
                $('#radioExample6').prop('checked',true);
                $('#id_jenis_anggaran').val("");
                $('#uraian_tambahan').val("");
                $('#lokasi').val("");
                $('#volume').val("");
                $('#satuan').val("");
                $('#harga_satuan').val("");
                $('#total').val("");
                $('#datetimepicker2').val("");
                $('#lama_pelaksanaan').val("");

                $('#view_anggaran_tambahan').hide();
                $('#view_realisasi').show();
                get_anggaran();
            }
        });
    });
    
    $('#ubah_harga').click(function(){
        $('#harga_satuan').removeAttr('readonly');
        $('#ubah_harga').css('display','none');
        $('#simpan_harga').css('display','block');
        $('#ubah_harga').val("Ubah Harga");
        $('#simpan_harga').val("Simpan Harga");
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
                $('#ubah_harga').css('display','block');
                $('#simpan_harga').css('display','none');
                $('#ubah_harga').val("Ubah Harga");
                $('#simpan_harga').val("Simpan Harga");
            }
        });
    });

    $('#hapus').click(function(){
        var jenis_realisasi = $("input[name='jenis_realisasi']:checked").val();
        if(jenis_realisasi == "DPBM"){
            $('#dialog-btn').click();
            var no_dpbm = $('#no_dpbm').val();
            $('#ket_hapus').html('Apakah No <b>'+no_dpbm+'</b> ini ingin dihapus ?');
            $('#no_bukti_hapus').val(no_dpbm);
        }else if(jenis_realisasi == "RAB"){
            $('#dialog-btn').click();
            var no_rab = $('#no_rab').val();
            $('#ket_hapus').html('Apakah No <b>'+no_rab+'</b> ini ingin dihapus ?');
            $('#no_bukti_hapus').val(no_rab);
        }else{
            $('#dialog-btn').click();
            var no_spm = $('#no_spm').val();
            $('#ket_hapus').html('Apakah No <b>'+no_spm+'</b> ini ingin dihapus ?');
            $('#no_bukti_hapus').val(no_spm);
        }
    });

    $('#ya_hapus').click(function(){
        var id_hapus = $('#id_hapus').val();
        var id_realisasi = $('#id_realisasi').val();
        var ket_realisasi = $('#ket_realisasi').val();
        var no_bukti_hapus = $('#no_bukti_hapus').val();
        $('.cd-popup-close').click();
        $('#popup_load').css('display','block');
        $('#popup_load').show();
        $.ajax({
            url : '<?php echo base_url(); ?>dashboard/realisasi_anggaran_c/hapus_realisasi',
            data : {id_hapus:id_hapus,id_realisasi:id_realisasi,ket_realisasi:ket_realisasi,no_bukti_hapus:no_bukti_hapus},
            type : "POST",
            dataType : "json",
            async : false,
            success : function(result){
                setTimeout(function(){
                    $('#popup_load').css('display','none');
                    $('#popup_load').hide();
                    pesan_hapus();
                }, 2000);
                var jenis_realisasi = $("input[name='jenis_realisasi']:checked").val();
                var id_anggaran = $('#id_anggaran').val();
                if(jenis_realisasi == "DPBM"){
                    $('#no_dpbm').val("");
                    $('#no_keu_dpbm').val("");
                    $('#harga_dpbm').val("");
                    $('#harga_total_dpbm').val("");
                    $('#jumlah_dpbm').val("");
                    ajax_data_dpbm();
                    get_realisasi_dpbm(id_anggaran);
                }else if(jenis_realisasi == "RAB"){
                    $('#no_rab').val("");
                    $('#no_keu_rab').val("");
                    $('#jenis_rab').val("");
                    $('#harga_rab').val("");
                    $('#jumlah_rab').val("");
                    ajax_data_rab();
                    get_realisasi_rab(id_anggaran);
                }else{
                    $('#id_spm').val("");
                    $('#no_spm').val("");
                    $('#no_keu_spm').val("");
                    $('#ket_spm').val("");
                    $('#total_spm').val("");
                    ajax_no_spm();
                    get_realisasi_spm(id_anggaran);
                }
                get_anggaran();

                // $('#id_hapus').val("");
                // $('#id_realisasi').val("");
                // $('#ket_realisasi').val("");
            }
        });
    });

    $('#tidak_hapus').click(function(){
        $('.cd-popup-close').click();
        $('#id_hapus').val("");
        $('#id_realisasi').val("");
        $('#ket_realisasi').val("");
    });

});

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
            $('#kode_anggaran_tambahan').val(result);
        }
    });
}

function get_anggaran(){
    $('#popup_load').css('display','block');
    $('#popup_load').show();

    var keyword = $('#pencarian').val();
    var tahun = $('#tahun2').val();
    var bagian = $('#departemen2').val();
    var sub_bagian = $('#divisi2').val();
    var kode_perkiraan = $('#kode_perkiraan').val();
    var kriteria = $("input[name='kriteria']:checked").val();

    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/realisasi_anggaran_c/data_anggaran',
        data : {tahun:tahun,bagian:bagian,sub_bagian:sub_bagian,kode_perkiraan:kode_perkiraan,keyword:keyword,kriteria:kriteria},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(result){
            $isi = "";
            var warna = "";
            if(result == ""){
                $('#data tbody').html($isi);
                $('#tidak_ada_data').show();
                $('#popup_load').hide();
            }else{
                for(var i=0; i<result.length; i++){
                    result[i].VOLUME  = result[i].VOLUME == null? 0:result[i].VOLUME;
                    result[i].REALISASI  = result[i].REALISASI == null? 0:result[i].REALISASI;
                    result[i].SISA  = result[i].SISA == null? 0:result[i].SISA;

                    var jumlah = 0;
                    var total = 0;
                    var sisa = 0;

                    if(result[i].JUMLAH_REV == null){
                        jumlah = result[i].JUMLAH;
                    }else{
                        jumlah = result[i].JUMLAH_REV;
                    }

                    total = parseFloat(jumlah) * parseFloat(result[i].HARGA);
                    sisa = parseFloat(total) - parseFloat(result[i].REALISASI);

                    if(result[i].WARNA == "kuning"){
                        warna = "background:#ffe600;";
                    }else if(result[i].WARNA == "merah"){
                        warna = "background:#ff2b00; color:#fff;";
                    }else if(result[i].WARNA == "orange"){
                        warna = "background:#FF7F00; color:#fff;";
                    }else{
                        warna = "background:#fff;";
                    }

                    $isi += "<tr style='cursor:pointer; "+warna+"' onclick=do_realisasi("+result[i].ID_ANGGARAN+");>"+
                                "<td width='150' align='center'>"+result[i].KODE_ANGGARAN+"</td>"+
                                "<td style='white-space:nowrap;'>"+result[i].URAIAN+"</td>"+
                                "<td width='120' align='center'>"+result[i].SATUAN+"</td>"+
                                "<td width='120' align='center'>"+jumlah+"</td>"+
                                "<td width='150' style='white-space:nowrap;'>Rp. "+NumberToMoney(result[i].HARGA)+"</td>"+
                                "<td width='120' align='center'>"+result[i].VOLUME+"</td>"+
                                "<td width='150' style='white-space:nowrap;'>Rp. "+NumberToMoney(total)+"</td>"+
                                "<td width='150' style='white-space:nowrap;'>Rp. "+NumberToMoney(result[i].REALISASI)+"</td>"+
                                "<td width='150' style='white-space:nowrap;'>"+isPositive(sisa)+"</td>"+
                            "</tr>";
                }
                $('#data tbody').html($isi);
                $('#tidak_ada_data').hide();
                $('#popup_load').hide();
            }
        }
    });
}

function do_realisasi(id_anggaran){
    $('#hapus').prop('disabled',true);
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/realisasi_anggaran_c/do_realisasi',
        data : {id_anggaran:id_anggaran},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#popup_load').css('display','block');
            $('#popup_load').show();

            $('#id_anggaran').val(id_anggaran);
            $('#kode_anggaran').val(row['data']['KODE_ANGGARAN']);
            $('#uraian').val(row['data']['URAIAN']);

            console.log(row['keterangan']);

            if(row['keterangan'] == "DPBM"){
                $('#radioExample4').prop('checked',true);
                $('#radioExample5').removeAttr('checked');
                $('#radioExample11').removeAttr('checked');
                $('#judul_tabel_dpbm').html('DPBM');
                
                $('#view_dpbm').css('display','block');
                $('#view_dpbm').show();
                $('#tabel_dpbm').css('display','block');
                $('#tabel_dpbm').show();

                $('#view_rab').css('display','none');
                $('#view_rab').hide();
                $('#tabel_rab').css('display','none');
                $('#tabel_rab').hide();

                $('#view_spm').css('display','none');
                $('#view_spm').hide();
                $('#tabel_spm').css('display','none');
                $('#tabel_spm').hide();
                get_realisasi_dpbm(id_anggaran);
                
                $('#no_rab').val("");
                $('#no_keu_rab').val("");
                $('#jenis_rab').val("");
                $('#harga_rab').val("");
                $('#jumlah_rab').val("");
                $('#tes_rab tbody').find('tr').remove();

                $('#id_spm').val("");
                $('#no_spm').val("");
                $('#no_keu_spm').val("");
                $('#ket_spm').val("");
                $('#total_spm').val("");
                $('#tes_spm tbody').find('tr').remove();

                $('#id_hapus').val("");
                $('#id_realisasi').val("");

            }else if(row['keterangan'] == "RAB"){

                $('#radioExample4').removeAttr('checked');
                $('#radioExample5').prop('checked',true);
                $('#radioExample11').removeAttr('checked');
                $('#judul_tabel_rab').html('RAB');

                $('#view_dpbm').css('display','none');
                $('#view_dpbm').hide();
                $('#tabel_dpbm').css('display','none');
                $('#tabel_dpbm').hide();

                $('#view_rab').css('display','block');
                $('#view_rab').show();
                $('#tabel_rab').css('display','block');
                $('#tabel_rab').show();
                
                $('#view_spm').css('display','none');
                $('#view_spm').hide();
                $('#tabel_spm').css('display','none');
                $('#tabel_spm').hide();
                get_realisasi_rab(id_anggaran);
                
                $('#no_dpbm').val("");
                $('#no_keu_dpbm').val("");
                $('#harga_dpbm').val("");
                $('#harga_total_dpbm').val("");
                $('#jumlah_dpbm').val("");
                $('#tes_dpbm tbody').find('tr').remove();

                $('#id_spm').val("");
                $('#no_spm').val("");
                $('#no_keu_spm').val("");
                $('#ket_spm').val("");
                $('#total_spm').val("");
                $('#tes_spm tbody').find('tr').remove();

                $('#id_hapus').val("");
                $('#id_realisasi').val("");

            }else if(row['keterangan'] == "SPM"){

                $('#radioExample4').removeAttr('checked');
                $('#radioExample5').removeAttr('checked');
                $('#radioExample11').prop('checked',true);
                $('#judul_tabel_spm').html('SPM');

                $('#view_dpbm').css('display','none');
                $('#view_dpbm').hide();
                $('#tabel_dpbm').css('display','none');
                $('#tabel_dpbm').hide();

                $('#view_rab').css('display','none');
                $('#view_rab').hide();
                $('#tabel_rab').css('display','none');
                $('#tabel_rab').hide();

                $('#view_spm').css('display','block');
                $('#view_spm').show();
                $('#tabel_spm').css('display','block');
                $('#tabel_spm').show();
                get_realisasi_spm(id_anggaran);

                $('#no_dpbm').val("");
                $('#no_keu_dpbm').val("");
                $('#harga_dpbm').val("");
                $('#harga_total_dpbm').val("");
                $('#jumlah_dpbm').val("");
                $('#tes_dpbm tbody').find('tr').remove();

                $('#no_rab').val("");
                $('#no_keu_rab').val("");
                $('#jenis_rab').val("");
                $('#harga_rab').val("");
                $('#jumlah_rab').val("");
                $('#tes_rab tbody').find('tr').remove();

                $('#id_hapus').val("");
                $('#id_realisasi').val("");

            }else{

                $('#radioExample4').prop('checked',true);
                $('#radioExample5').removeAttr('checked');
                $('#radioExample11').removeAttr('checked');
                $('#judul_tabel_dpbm').html('DPBM');
                
                $('#view_dpbm').css('display','block');
                $('#view_dpbm').show();
                $('#tabel_dpbm').css('display','block');
                $('#tabel_dpbm').show();

                $('#view_rab').css('display','none');
                $('#view_rab').hide();
                $('#tabel_rab').css('display','none');
                $('#tabel_rab').hide();

                $('#view_spm').css('display','none');
                $('#view_spm').hide();
                $('#tabel_spm').css('display','none');
                $('#tabel_spm').hide();

                get_realisasi_dpbm(id_anggaran);
                get_realisasi_rab(id_anggaran);
                get_realisasi_spm(id_anggaran);
            }
        }
    });
}

function get_realisasi_dpbm(id_anggaran){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/realisasi_anggaran_c/get_realisasi_by_dpbm',
        data : {id_anggaran:id_anggaran},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(result){
            $isi = "";
            for(var i=0; i<result.length; i++){
                
                result[i].NO_KEU  = result[i].NO_KEU == null? "-":result[i].NO_KEU;

                $isi += "<tr style='cursor:pointer;' onclick=get_dpbm_click("+result[i].ID_DPBM+");>"+
                            "<td align='center'>"+result[i].NO_DPBM+"."+result[i].ID_DET_DPBM+"</td>"+
                            "<td align='center'>"+result[i].TANGGAL+"</td>"+
                            "<td align='center'>"+result[i].VOLUME+"</td>"+
                            "<td align='center'>"+result[i].NO_KEU+"</td>"+
                            "<td align='center'>"+result[i].KODE_BARANG+"</td>"+
                            "<td align='center'>"+NumberToMoney(result[i].HARGA)+"</td>"+
                        "</tr>";
            }
            $('#tes_dpbm tbody').html($isi);
            $('#popup_load').delay(1000).fadeOut('slow');
        }
    });
}

function get_realisasi_rab(id_anggaran){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/realisasi_anggaran_c/get_realisasi_rab',
        data : {id_anggaran:id_anggaran},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(result){
            $isi = "";
            for(var i=0; i<result.length; i++){
                
                result[i].NO_KEU  = result[i].NO_KEU == null? "-":result[i].NO_KEU;
                result[i].NO_SPK  = result[i].NO_SPK == null? "-":result[i].NO_SPK;
                result[i].BIAYA_KONTRAK  = result[i].BIAYA_KONTRAK == null? 0:result[i].BIAYA_KONTRAK;

                $isi += "<tr style='cursor:pointer;' onclick=get_rab_click("+result[i].ID+"); >"+
                            "<td style='white-space:nowrap;' align='center'>"+result[i].NO_BUKTI+"</td>"+
                            "<td align='center'>"+result[i].TANGGAL+"</td>"+
                            "<td style='white-space:nowrap;'>"+result[i].KEGIATAN+"</td>"+
                            "<td align='center'>"+result[i].VOLUME+"</td>"+
                            "<td>"+NumberToMoney(result[i].HARGA_SATUAN)+"</td>"+
                            "<td align='center'>"+result[i].NO_KEU+"</td>"+
                            "<td style='white-space:nowrap;' align='center'>"+result[i].NO_SPK+"</td>"+
                            "<td align='center'>"+NumberToMoney(result[i].BIAYA_KONTRAK)+"</td>"+
                        "</tr>";
            }
            $('#tes_rab tbody').html($isi);
            $('#popup_load').delay(1000).fadeOut('slow');
        }
    });
}

function get_realisasi_spm(id_anggaran){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/realisasi_anggaran_c/get_realisasi_spm',
        data : {id_anggaran:id_anggaran},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(result){
            $isi = "";
            for(var i=0; i<result.length; i++){
                
                result[i].NO_KEU  = result[i].NO_KEU == null? "-":result[i].NO_KEU;
                result[i].NO_SPM  = result[i].NO_SPM == null? "-":result[i].NO_SPM;
                result[i].NILAI  = result[i].NILAI == null? 0:result[i].NILAI;

                $isi += "<tr style='cursor:pointer;' onclick=get_spm_id_click("+result[i].ID_SPM+"); >"+
                            "<td style='white-space:nowrap;' align='center'>"+result[i].NO_SPM+"</td>"+
                            "<td align='center'>"+result[i].TANGGAL+"</td>"+
                            "<td style='white-space:nowrap;'>"+result[i].KET+"</td>"+
                            "<td>"+NumberToMoney(result[i].NILAI)+"</td>"+
                            "<td align='center'>"+result[i].NO_KEU+"</td>"+
                        "</tr>";
            }
            $('#tes_spm tbody').html($isi);
            $('#popup_load').delay(1000).fadeOut('slow');
        }
    });
}

function get_spm_id_click(id_spm){
    $.ajax({
        url : '<?php echo  base_url(); ?>dashboard/realisasi_anggaran_c/get_spm_id',
        data : {id_spm:id_spm},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#id_hapus').val(row['ID_REALISASI']);
            $('#id_realisasi').val(id_spm);
            $('#ket_realisasi').val('SPM');
            $('#hapus').removeAttr('disabled');

            $('#id_spm').val(id_spm);
            $('#no_spm').val(row['NO_SPM']);
            $('#no_keu_spm').val(row['NO_KEU']);
            $('#ket_spm').val(row['KET']);
            $('#total_spm').val(NumberToMoney(row['NILAI']));
        }
    });
}

function get_dpbm_click(id_dpbm){
    $('#popup_load').css('display','block');
    $('#popup_load').show();
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/realisasi_anggaran_c/get_realisasi_by_id_dpbm',
        data : {id_dpbm:id_dpbm},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#id_hapus').val(id_dpbm);
            $('#id_realisasi').val(row['ID']);
            $('#no_dpbm').val(row['NO_DPBM']+'.'+id_dpbm);
            $('#no_keu_dpbm').val(row['NO_KEU']);
            $('#harga_dpbm').val(NumberToMoney(row['HARGA']));
            $('#harga_total_dpbm').val(NumberToMoney(row['HARGA']));
            $('#jumlah_dpbm').val(row['VOLUME_DPBM']);
            $('#ket_realisasi').val("DPBM");

            $('#hapus').removeAttr('disabled');
            $('#popup_load').delay(1000).fadeOut('slow');
        }
    });
}

function get_rab_click(id_rab){
    $('#popup_load').css('display','block');
    $('#popup_load').show();
    $.ajax({
        url : "<?php echo base_url(); ?>dashboard/realisasi_anggaran_c/get_rab_click",
        data : {id_rab:id_rab},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#no_rab').val(row['NO_BUKTI']);
            $('#no_keu_rab').val(row['NO_KEU']);
            $('#jenis_rab').val(row['JENIS']);
            $('#harga_rab').val(NumberToMoney(row['HARGA_SATUAN']));
            $('#jumlah_rab').val(row['VOLUME']);

            $('#id_hapus').val(id_rab);
            $('#id_realisasi').val(row['ID_RAB']);
            $('#ket_realisasi').val("RAB");

            $('#hapus').removeAttr('disabled');
            $('#popup_load').delay(1000).fadeOut('slow');
        }
    });
}

function get_spm_click(id_spm){
    $.ajax({
        url : '<?php echo  base_url(); ?>dashboard/realisasi_anggaran_c/get_spm_click',
        data : {id_spm:id_spm},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#id_hapus').val(id_spm);
            $('#ket_realisasi').val('SPM');

            $('#id_spm').val(id_spm);
            $('#no_spm').val(row['NO_SPM']);
            $('#no_keu_spm').val(row['NO_KEU']);
            $('#ket_spm').val(row['KET']);
            $('#total_spm').val(NumberToMoney(row['NILAI']));
            $('#popup_no_spm').css('display','none');
            $('#popup_no_spm').hide();
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
            $('#id_anggaran').val("");
            $('#kode_anggaran').val("");
            $('#uraian').val("");
            $('#popup_koper').css('display','none');
            $('#popup_koper').hide();
            var id_anggaran = "";
            get_anggaran();
            // get_realisasi_dpbm(id_anggaran);
            // get_realisasi_rab(id_anggaran);
        }
    });
}

function get_bagian_id(id_bagian){
    $.ajax({
        url : "<?php echo base_url(); ?>dashboard/departemen_divisi_c/get_bagian_id",
        data : {id_bagian:id_bagian},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#bagian_tambahan').val(row.NAMA);
        }
    });
}

function get_sub_bagian_id(id_divisi){
    $.ajax({
        url : "<?php echo base_url(); ?>dashboard/departemen_divisi_c/get_dep_div",
        data : {id_divisi:id_divisi},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#sub_bagian_tambahan').val(row.NAMA);
        }
    });
}

function get_surat_id(id_surat){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/cetak_biaya_luar_c/get_surat_id',
        data : {id_surat:id_surat},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#no_surat').val(row['NO_SURAT']);
            $('#uraian_surat').val(row['PROGRAM_BIAYA']);

            $('#popup_no_surat').css('display','none');
            $('#popup_no_surat').hide();
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
    $('#total').val(NumberToMoney(total));
}

//BARANG
function tabel_barang(){
    var base_url = '<?php echo base_url(); ?>';
    var $isi = '<div id="popup_barang">'+
                    '<div class="window_barang">'+
                    '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_barang"></a>'+
                    '    <div class="panel-body">'+
                    '    <input type="text" name="search_barang" id="search_barang" class="form-control" value="" placeholder="Cari barang...">'+
                    '    <br/>'+
                    '    <div class="table-responsive scroll_popup-y">'+
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
            $('#uraian_tambahan').val(row['NAMA_BARANG']);
            $('#satuan').val(row['SATUAN']);
            $('#harga_satuan').val(NumberToMoney(row['HARGA_BARANG']));

            $('#popup_barang').css('display','none');
            $('#popup_barang').hide();
            $('#search_barang').val("");
            $('#ubah_harga').removeAttr('disabled');
        }
    });
}

//POPUP DPBM
function popup_dpbm_view(){
    $isi =  '<div id="popup_dpbm">'+
            '   <div class="window_dpbm">'+
            '       <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>ico/cancel.gif" id="pojok_dpbm"></a>'+
            '       <div class="panel-body">'+
            '       <input type="text" name="search_dpbm" id="search_dpbm" class="form-control" value="" placeholder="Cari DPBM...">'+
            '       <br/>'+
            '       <div class="table-responsive">'+
            '           <div class="scroll_popup-y">'+
            '               <table class="table table-hover table-bordered" id="tes_popup_dpbm">'+
            '                   <thead>'+
            '                       <tr class="primary">'+
            '                           <th style="white-space:nowrap; text-align:center;">NO DPBM</th>'+
            '                           <th style="white-space:nowrap; text-align:center;">KODE BARANG</th>'+
            '                           <th style="white-space:nowrap; text-align:center;">NAMA BARANG</th>'+
            '                           <th style="white-space:nowrap; text-align:center;">VOLUME</th>'+
            '                           <th style="white-space:nowrap; text-align:center;">SATUAN</th>'+
            '                           <th style="white-space:nowrap; text-align:center;">HARGA</th>'+
            '                       </tr>'+
            '                   </thead>'+
            '                   <tbody>'+
            '                           '+
            '                    </tbody>'+
            '                </table>'+
            '            </div>'+
            '        </div>'+
            '    </div>'+
            '</div>';
    $('body').append($isi);

    $('#pojok_dpbm').click(function(){
        $('#popup_dpbm').css('display','none');
        $('#popup_dpbm').hide();
        $('#search_dpbm').val("");
    });

    $('#popup_dpbm').css('display','block');
    $('#popup_dpbm').show();
}

function ajax_data_dpbm(){
    var keyword = $('#search_dpbm').val();
    var ajaxe = "";

    if(ajaxe){
        ajaxe.abort();
    }

    ajaxe = $.ajax({
        url : '<?php echo base_url(); ?>dashboard/realisasi_anggaran_c/popup_data_dpbm',
        type : "GET",
        dataType : "json",
        data : {
            keyword : keyword,
        },
        async : false,
        success : function(result){
            var isine = '';
            var no = 0;
            $.each(result,function(i,res){
                no++;
                isine += '<tr style="cursor:pointer;" onclick="get_dpbm_id('+res.ID_DET_DPBM+');">'+
                        '    <td width="120" align="center">'+res.NO_DPBM+'.'+res.ID_DET_DPBM+'</td>'+
                        '    <td width="120" align="center">'+res.KODE_BARANG+'</td>'+
                        '    <td width="150">'+res.NAMA_BARANG+'</td>'+
                        '    <td width="100" align="center">'+res.VOLUME+'</td>'+
                        '    <td width="100" align="center">'+res.SATUAN+'</td>'+
                        '    <td width="150">'+NumberToMoney(res.HARGA)+'</td>'+
                        '</tr>';
            });
            $('#tes_popup_dpbm tbody').html(isine);
            $('#search_dpbm').off('keyup').keyup(function(){
                ajax_data_dpbm();
            });
        }
    });
}

function get_dpbm_id(id_dpbm){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/realisasi_anggaran_c/get_dpbm_id',
        data : {id_dpbm:id_dpbm},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            var no_dpbm = row['NO_DPBM'];
            $('#id_dpbm').val(row['ID']);
            $('#id_det_dpbm').val(row['ID_DET_DPBM']);
            $('#no_dpbm').val(no_dpbm+'.'+id_dpbm);
            $('#harga_dpbm').val(NumberToMoney(row['HARGA']));
            $('#harga_total_dpbm').val(NumberToMoney(row['HARGA']));
            $('#jumlah_dpbm').val(row['VOLUME']);
            $('#no_keu_dpbm').val(row['NO_KEU']);

            $('#popup_dpbm').css('display','none');
            $('#popup_dpbm').hide();
        }
    });
}

//RAB
function popup_rab_view(){
    $isi = '<div id="popup_rab">'+
            '   <div class="window_rab">'+
            '       <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>ico/cancel.gif" id="pojok_rab"></a>'+
            '       <div class="panel-body">'+
            '            <input type="text" name="search_rab" id="search_rab" class="form-control" value="" placeholder="Cari RAB...">'+
            '            <br/>'+
            '            <div class="table-responsive">'+
            '               <div class="scroll_popup-y">'+
            '                  <table class="table table-hover table-bordered" id="tes_popup_rab">'+
            '                      <thead>'+
            '                          <tr class="primary">'+
            '                              <th style="white-space:nowrap; text-align:center;">NO RAB</th>'+
            '                              <th style="white-space:nowrap; text-align:center;">JENIS</th>'+
            '                              <th style="white-space:nowrap; text-align:center;">URAIAN</th>'+
            '                              <th style="white-space:nowrap; text-align:center;">VOLUME</th>'+
            '                              <th style="white-space:nowrap; text-align:center;">SATUAN</th>'+
            '                              <th style="white-space:nowrap; text-align:center;">HARGA</th>'+
            '                          </tr>'+
            '                      </thead>'+
            '                      <tbody>'+
            '                              '+
            '                       </tbody>'+
            '                   </table>'+
            '               </div>'+
            '            </div>'+
            '        </div>'+
            '    </div>'+
            '</div>';
    $('body').append($isi);

    $('#pojok_rab').click(function(){
        $('#popup_rab').css('display','none');
        $('#popup_rab').hide();
        $('#search_rab').val("");
    });

    $('#popup_rab').css('display','block');
    $('#popup_rab').show();
}

function ajax_data_rab(){
    var keyword = $('#search_rab').val();
    var ajaxe = "";

    if(ajaxe){
        ajaxe.abort();
    }

    ajaxe = $.ajax({
        url : '<?php echo base_url(); ?>dashboard/realisasi_anggaran_c/popup_data_rab',
        type : "GET",
        dataType : "json",
        data : {
            keyword : keyword,
        },
        async : false,
        success : function(result){
            var isine = '';
            var no = 0;
            $.each(result,function(i,res){
                no++;
                isine += '<tr style="cursor:pointer;" onclick="get_rab_id('+res.ID_DET_RAB+');">'+
                        '    <td width="190" align="center">'+res.NO_RAB+'</td>'+
                        '    <td width="120" align="center">'+res.JENIS+'</td>'+
                        '    <td width="190">'+res.KEGIATAN+'</td>'+
                        '    <td width="100" align="center">'+res.VOLUME+'</td>'+
                        '    <td width="100" align="center">'+res.SATUAN+'</td>'+
                        '    <td width="150">'+NumberToMoney(res.HARGA_SATUAN)+'</td>'+
                        '</tr>';
            });
            $('#tes_popup_rab tbody').html(isine);
            $('#search_rab').off('keyup').keyup(function(){
                ajax_data_rab();
            });
        }
    });
}

function get_rab_id(id_rab){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/realisasi_anggaran_c/get_rab_by_id',
        data : {id_rab:id_rab},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#id_rab').val(row['ID']);
            $('#id_det_rab').val(row['ID_DET_RAB']);
            $('#no_rab').val(row['NO_RAB']);
            $('#jenis_rab').val(row['JENIS']);
            $('#harga_rab').val(NumberToMoney(row['HARGA_SATUAN']));
            $('#jumlah_rab').val(row['VOLUME']);
            $('#no_keu_rab').val(row['NO_KEU']);

            $('#id_spk').val(row['ID_SPK']);
            $('#no_spk').val(row['NO_SPK']);
            $('#biaya_kontrak_spk').val(row['BIAYA_KONTRAK']);
            $('#spk_adendum').val(row['ADENDUM']);
            $('#nilai_spk_adendum').val(row['NILAI_ADENDUM']);

            $('#popup_rab').css('display','none');
            $('#popup_rab').hide();
        }
    });
}

//NO SURAT
function popup_no_surat(){
    $isi = '<div id="popup_no_surat">'+
            '   <div class="window_no_surat">'+
            '    <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>ico/cancel.gif" id="pojok_surat"></a>'+
            '        <div class="panel-body">'+
            '            <input type="text" name="search_surat" id="search_surat" class="form-control" value="" placeholder="Cari No Surat...">'+
            '            <br/>'+
            '            <div class="table-responsive scroll_popup-y">'+
            '                <table class="table table-hover table-bordered" id="data_surat">'+
            '                    <thead>'+
            '                        <tr class="primary">'+
            '                           <th style="white-space:nowrap; text-align:center;">NO SURAT</th>'+
            '                           <th style="white-space:nowrap; text-align:center;">NO BUKTI</th>'+
            '                           <th style="white-space:nowrap; text-align:center;">PROGRAM</th>'+
            '                        </tr>'+
            '                    </thead>'+
            '                    <tbody>'+
            '                           '+
            '                    </tbody>'+
            '                </table>'+
            '            </div>'+
            '        </div>'+
            '    </div>'+
            '</div>';
    $('body').append($isi);

    $('#pojok_surat').click(function(){
        $('#popup_no_surat').css('display','none');
        $('#popup_no_surat').hide();
        $('#search_surat').val("");
    });

    $('#popup_no_surat').css('display','block');
    $('#popup_no_surat').show();
}

function ajax_data_surat(){
    var keyword = $('#search_surat').val();
    var ajaxe = "";

    if(ajaxe){
        ajaxe.abort();
    }

    ajaxe = $.ajax({
        url : '<?php echo base_url(); ?>dashboard/realisasi_anggaran_c/popup_data_surat',
        type : "GET",
        dataType : "json",
        data : {
            keyword : keyword,
        },
        async : false,
        success : function(result){
            var isine = '';
            var no = 0;
            $.each(result,function(i,res){
                no++;
                isine += "<tr style='cursor:pointer;' onclick=get_surat_id("+res.ID+");>"+
                            "<td style='white-space:nowrap;' align='center'>"+res.NO_SURAT+"</td>"+
                            "<td style='white-space:nowrap;' align='center'>"+res.NO_BUKTI+"</td>"+
                            "<td>"+res.NAMA_BARANG+"</td>"+
                        "</tr>";
            });
            $('#data_surat tbody').html(isine);
            $('#search_surat').off('keyup').keyup(function(){
                ajax_data_surat();
            });
        }
    });
}

//SPM
function popup_no_spm(){
    $isi = '<div id="popup_no_spm">'+
            '   <div class="window_no_spm">'+
            '    <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>ico/cancel.gif" id="pojok_spm"></a>'+
            '        <div class="panel-body">'+
            '            <input type="text" name="search_spm" id="search_spm" class="form-control" value="" placeholder="Cari No SPM...">'+
            '            <br/>'+
            '            <div class="table-responsive scroll_popup-y">'+
            '                <table class="table table-hover table-bordered" id="data_spm">'+
            '                    <thead>'+
            '                        <tr class="primary">'+
            '                           <th style="white-space:nowrap; text-align:center;">NO SPM</th>'+
            '                           <th style="white-space:nowrap; text-align:center;">URAIAN</th>'+
            '                           <th style="white-space:nowrap; text-align:center;">NILAI</th>'+
            '                        </tr>'+
            '                    </thead>'+
            '                    <tbody>'+
            '                           '+
            '                    </tbody>'+
            '                </table>'+
            '            </div>'+
            '        </div>'+
            '    </div>'+
            '</div>';
    $('body').append($isi);

    $('#pojok_spm').click(function(){
        $('#popup_no_spm').css('display','none');
        $('#popup_no_spm').hide();
        $('#search_spm').val("");
    });

    $('#popup_no_spm').css('display','block');
    $('#popup_no_spm').show();
}

function ajax_no_spm(){
    var keyword = $('#search_spm').val();
    var ajaxe = "";

    if(ajaxe){
        ajaxe.abort();
    }

    ajaxe = $.ajax({
        url : '<?php echo base_url(); ?>dashboard/realisasi_anggaran_c/popup_data_spm',
        type : "GET",
        dataType : "json",
        data : {
            keyword : keyword,
        },
        async : false,
        success : function(result){
            var isine = '';
            var no = 0;
            $.each(result,function(i,res){
                no++;
                isine += "<tr style='cursor:pointer;' onclick=get_spm_id("+res.ID+");>"+
                            "<td style='white-space:nowrap;' align='center'>"+res.NO_SPM+"</td>"+
                            "<td>"+res.KET+"</td>"+
                            "<td style='white-space:nowrap;' align='center'>"+NumberToMoney(res.NILAI)+"</td>"+
                        "</tr>";
            });
            $('#data_spm tbody').html(isine);
            $('#search_spm').off('keyup').keyup(function(){
                ajax_no_spm();
            });
        }
    });
}

function get_spm_id(id_spm){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/realisasi_anggaran_c/get_spm_id',
        data : {id_spm:id_spm},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#id_spm').val(id_spm);
            $('#no_spm').val(row['NO_SPM']);
            $('#no_keu_spm').val(row['NO_KEU']);
            $('#ket_spm').val(row['KET']);
            $('#total_spm').val(NumberToMoney(row['NILAI']));
            $('#popup_no_spm').css('display','none');
            $('#popup_no_spm').hide();
            $('#search_spm').val("");
        }
    });
}
</script>

<style>
#view_dpbm{
    display: none;
}
#view_rab{
    display: none;
}
#tabel_rab{
    display: none;
}
</style>

<div id="popup_load">
    <div class="window_load">
        <img src="<?=base_url()?>/ico/loading.gif" height="100" width="100">
    </div>
</div>

<div class="panel" id="view_realisasi">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <form class="form-horizontal" role="form" action="" method="post" id="form_ag">
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
                                    <select id="departemen2" name="departemen" style="cursor:pointer;" onchange="data_divisi();" <?php echo $disable; ?> >
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
                                    <select id="divisi2" name="divisi" style="cursor:pointer;" <?php echo $disable2; ?> >
                   
                                    </select>
                                    <i style="z-index:99;" class="arrow"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="disabledInput" class="col-lg-3 control-label">Cari Data</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample9" name="cari_data" value="semua_data" checked="checked">
                        <label for="radioExample9" style="margin-right: 15px; padding-left: 25px;">Semua</label>

                        <input type="radio" id="radioExample10" name="cari_data" value="per_koper">
                        <label for="radioExample10" style="margin-right: 15px; padding-left: 25px;">Per Kode Perkiraan</label>
                    </div>
                </div>
            </div>

            <div class="form-group view_per_koper">
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
                                <span class="help-block mt5" style="color:#FF0000;" id="empty_koper"><i class="fa fa-warning"></i> Kode Perkiraan Kosong</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group view_per_koper">
                <label for="uraian_perkiraan" class="col-lg-3 control-label">&nbsp;</label>
                <div class="col-lg-6">
                    <input type="text" id="uraian_perkiraan" name="uraian_perkiraan" class="form-control" value="" readonly style="width:400px;" />
                </div>
            </div>

            <hr>   

            <div class="form-group">
                <label for="pencarian" class="col-lg-2 control-label">Kode Anggaran / Uraian</label>
                <div class="col-lg-3">
                    <input type="text" id="pencarian" name="pencarian" class="form-control" value="" placeholder="Cari...">
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title fw700 text-info">
                        <span class="glyphicons glyphicons-table"></span>Data </span>
                </div>
                <div class="panel-body pn">
                    <div class="scroll-xy">
                        <table class="table table-bordered" id="data">
                            <thead>
                                <tr class="primary">
                                    <th style="white-space:nowrap; vertical-align: middle; text-align:center; white-space:nowrap;">Kode Anggaran</th>
                                    <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Uraian</th>
                                    <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Satuan</th>
                                    <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Anggaran (Vol)</th>
                                    <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Harga Satuan (Rp)</th>
                                    <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Realisasi (Vol)</th>
                                    <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Total RKAP</th>
                                    <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Realisasi (Rp)</th>
                                    <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Sisa RKAP (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                        <div class="panel-heading" style="text-align:center;" id="tidak_ada_data">
                            <span class="panel-title">
                                Tidak Ada Data
                            </span>
                        </div>
                    </div>
                </div>
            </div>   

            <hr>

            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="kode_anggaran" class="col-lg-3 control-label">Kode Anggaran</label>
                        <div class="col-lg-8">
                            <input type="hidden" name="id_anggaran" id="id_anggaran" value="">
                            <input type="text" readonly id="kode_anggaran" name="kode_anggaran" class="form-control" value="" readonly="readonly">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="uraian" class="col-lg-3 control-label">Uraian</label>
                        <div class="col-lg-8">
                            <input type="text" id="uraian" name="uraian" class="form-control" value="" readonly="readonly">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="disabledInput" class="col-lg-3 control-label">&nbsp;</label>
                        <div class="col-lg-8" style="margin-top: 8px;">
                            <div class="radio-custom radio-primary mb5">
                                <input type="radio" id="radioExample4" name="jenis_realisasi" value="DPBM">
                                <label for="radioExample4" style="margin-right: 15px; padding-left: 25px;">DPBM</label>

                                <input type="radio" id="radioExample5" name="jenis_realisasi" value="RAB">
                                <label for="radioExample5" style="margin-right: 15px; padding-left: 25px;">RAB</label>

                                <input type="radio" id="radioExample11" name="jenis_realisasi" value="SPM">
                                <label for="radioExample11" style="margin-right: 15px; padding-left: 25px;">SPM</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="tgl">Tanggal</label>
                        <div class="col-lg-8">
                            <div class="input-group date" id="tgl">
                                <span class="input-group-addon cursor"><i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" name="tanggal" class="form-control" value="<?php echo date('d-m-Y'); ?>">
                            </div>
                        </div>
                    </div>

                    <div id="view_dpbm">
                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-3 control-label">No DPBM</label>
                            <div class="col-lg-8">
                                <div class="admin-form">
                                    <div>
                                        <div class="smart-widget sm-right smr-50">
                                            <label class="field">
                                                <input type="hidden" name="id_dpbm" id="id_dpbm" value="">
                                                <input type="hidden" name="id_det_dpbm" id="id_det_dpbm" value="">
                                                <input type="text" name="no_dpbm" id="no_dpbm" class="gui-input" readonly>
                                            </label>
                                            <a class="button" id="kode_dpbm">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </div>
                                        <!-- end .smart-widget section -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="maret" class="col-lg-3 control-label">No Keu</label>
                            <div class="col-lg-8">
                                <input type="text" name="no_keu_dpbm" id="no_keu_dpbm" class="form-control" value="" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="april" class="col-lg-3 control-label">Harga</label>
                            <div class="col-lg-8">
                                <input type="text" name="harga_dpbm" id="harga_dpbm" class="form-control" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mei" class="col-lg-3 control-label">Harga Total</label>
                            <div class="col-lg-8">
                                <input type="text" name="harga_total_dpbm" id="harga_total_dpbm" class="form-control" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="juni" class="col-lg-3 control-label">Jumlah</label>
                            <div class="col-lg-8">
                                <input type="text" name="jumlah_dpbm" id="jumlah_dpbm" class="form-control" value="">
                            </div>
                        </div>
                    </div>

                    <div id="view_rab">
                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-3 control-label">No RAB</label>
                            <div class="col-lg-8">
                                <div class="admin-form">
                                    <div>
                                        <div class="smart-widget sm-right smr-50">
                                            <label class="field">
                                                <input type="hidden" name="id_rab" id="id_rab" value="">
                                                <input type="hidden" name="id_det_rab" id="id_det_rab" value="">
                                                <input type="hidden" name="id_spk" id="id_spk" value="">
                                                <input type="hidden" name="no_spk" id="no_spk" value="">
                                                <input type="hidden" name="biaya_kontrak_spk" id="biaya_kontrak_spk" value="">
                                                <input type="hidden" name="spk_adendum" id="spk_adendum" value="">
                                                <input type="hidden" name="nilai_spk_adendum" id="nilai_spk_adendum" value="">
                                                <input type="text" name="no_rab" id="no_rab" class="gui-input" value="" readonly />
                                            </label>
                                            <a class="button" id="kode_rab">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </div>
                                        <!-- end .smart-widget section -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="juni" class="col-lg-3 control-label">No KEU</label>
                            <div class="col-lg-8">
                                <input type="text" name="no_keu_rab" id="no_keu_rab" class="form-control" value="" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="juni" class="col-lg-3 control-label">Jenis</label>
                            <div class="col-lg-8">
                                <input type="text" name="jenis_rab" id="jenis_rab" class="form-control" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="juni" class="col-lg-3 control-label">Harga</label>
                            <div class="col-lg-8">
                                <input type="text" name="harga_rab" id="harga_rab" class="form-control" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="juni" class="col-lg-3 control-label">Volume</label>
                            <div class="col-lg-8">
                                <input type="text" name="jumlah_rab" id="jumlah_rab" class="form-control" value="">
                            </div>
                        </div>
                    </div>

                    <div id="view_spm">
                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-3 control-label">No SPM</label>
                            <div class="col-lg-8">
                                <div class="admin-form">
                                    <div>
                                        <div class="smart-widget sm-right smr-50">
                                            <label class="field">
                                                <input type="hidden" name="id_spm" id="id_spm" value="">
                                                <input type="text" name="no_spm" id="no_spm" class="gui-input" value="" readonly />
                                            </label>
                                            <a class="button" id="kode_spm">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </div>
                                        <!-- end .smart-widget section -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="juni" class="col-lg-3 control-label">No KEU</label>
                            <div class="col-lg-8">
                                <input type="text" name="no_keu_spm" id="no_keu_spm" class="form-control" value="" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="juni" class="col-lg-3 control-label">Keterangan</label>
                            <div class="col-lg-8">
                                <input type="text" name="ket_spm" id="ket_spm" class="form-control" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="juni" class="col-lg-3 control-label">Total</label>
                            <div class="col-lg-8">
                                <input type="text" name="total_spm" id="total_spm" class="form-control" value="">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-sm-7" id="tabel_dpbm">
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title">
                                <span class="glyphicons glyphicons-table"></span><span id="judul_tabel_dpbm">DPBM</span>
                            </span>
                        </div>
                        <div class="panel-body pn">
                            <div class="scroll-x">
                                <table class="table table-bordered" id="tes_dpbm">
                                    <thead>
                                        <tr>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">No DPBM</th>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Tanggal</th>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Jumlah</th>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">No KEU</th>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Kode Barang</th>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Harga Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-7" id="tabel_rab">
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title">
                                <span class="glyphicons glyphicons-table"></span><span id="judul_tabel_rab"></span>
                            </span>
                        </div>
                        <div class="panel-body pn">
                            <div class="scroll-x">
                                <table class="table table-bordered" id="tes_rab">
                                    <thead>
                                        <tr>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">No RAB</th>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Tanggal</th>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Uraian</th>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Jumlah</th>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Harga</th>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">No KEU</th>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">No SPK</th>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Biaya Kontrak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-7" id="tabel_spm">
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title">
                                <span class="glyphicons glyphicons-table"></span><span id="judul_tabel_spm"></span>
                            </span>
                        </div>
                        <div class="panel-body pn">
                            <div class="scroll-x">
                                <table class="table table-bordered" id="tes_spm">
                                    <thead>
                                        <tr>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">No SPM</th>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Tanggal</th>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Uraian</th>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">Nilai</th>
                                            <th style="white-space:nowrap; vertical-align: middle; text-align:center;">No KEU</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>         
            
        </div>

        <div class="panel-footer">
            <center>
                <input type="button" name="simpan" id="simpan" value="Simpan" class="btn btn-success btn-gradient dark" style="font-weight: bold;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" name="hapus" id="hapus" value="Hapus" class="btn btn-danger btn-gradient dark" style="font-weight: bold;" disabled />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" name="tambah_baru" id="tambah_baru" value="Tambah Baru" class="btn btn-primary btn-gradient dark" style="font-weight: bold;">
            </center>
        </div>

    </form>
</div>

<!-- KOPER -->
<div id="popup_koper">
    <div class="window_koper">
        <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>ico/cancel.gif" id="pojok"></a>
        <div class="panel-body">
            <input type="text" name="search_koper" id="search_koper" class="form-control" value="" placeholder="Cari perkiraan...">
            <br/>
            <div class="table-responsive scroll_popup-y">
                <table class="table table-hover" id="tes_koper">
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

<!-- HAPUS -->
<a id="dialog-btn" href="javascript:;" class="cd-popup-trigger" style="display:none;">View Pop-up</a>
<div class="cd-popup" role="alert">
    <div class="cd-popup-container">

        <form id="delete" method="post" action="">
            <input type="hidden" name="id_hapus" id="id_hapus" value="" />
            <input type="hidden" name="id_realisasi" id="id_realisasi" value="" />
            <input type="hidden" name="ket_realisasi" id="ket_realisasi" value="" />
            <input type="hidden" name="no_bukti_hapus" id="no_bukti_hapus" value="">
        </form>   
         
        <p id="ket_hapus"></p>
        <ul class="cd-buttons">
            <li><a href="javascript:;" id="ya_hapus">Ya</a></li>
            <li><a href="javascript:;" id="tidak_hapus">Tidak</a></li>
        </ul>
        <a href="#0" onclick="$('#id_hapus').val(''); $('#id_realisasi').val('');" class="cd-popup-close img-replace">Close</a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->

<!-- TAMBAH BARU -->
<div class="panel" id="view_anggaran_tambahan">
    <div class="panel-heading">
        <span class="panel-title">Input Anggaran Tambahan</span>
    </div>
    <form class="form-horizontal" role="form" action="" method="post" id="form_tambah_anggaran">
        <div class="panel-body" id="form_tambah_baru">
            <div class="form-group">
                <label for="kode_anggaran" class="col-lg-3 control-label">Kode Anggaran</label>
                <div class="col-lg-3">
                    <input type="text" name="kode_anggaran_tambahan" id="kode_anggaran_tambahan" class="form-control" value="" readonly />
                </div>
            </div>

            <div class="form-group">
                <label for="kode_anggaran" class="col-lg-3 control-label">Tahun Anggaran</label>
                <div class="col-lg-3">
                    <input type="text" name="tahun_tambahan" id="tahun_tambahan" class="form-control" value="" readonly />
                </div>
            </div>

            <div class="form-group">
                <label for="kode_anggaran" class="col-lg-3 control-label">Bagian</label>
                <div class="col-lg-3">
                    <input type="hidden" name="id_bagian_tambahan" id="id_bagian_tambahan" value="">
                    <input type="text" name="bagian_tambahan" id="bagian_tambahan" class="form-control" value="" readonly />
                </div>
            </div>

            <div class="form-group">
                <label for="kode_anggaran" class="col-lg-3 control-label">Sub Bagian</label>
                <div class="col-lg-3">
                    <input type="hidden" name="id_sub_bagian_tambahan" id="id_sub_bagian_tambahan" value="">
                    <input type="text" name="sub_bagian_tambahan" id="sub_bagian_tambahan" class="form-control" value="" readonly />
                </div>
            </div>

            <div class="form-group">
                <label for="kode_anggaran" class="col-lg-3 control-label">Kode Perkiraan</label>
                <div class="col-lg-2">
                    <input type="text" name="koper_tambahan" id="koper_tambahan" class="form-control" value="" style="width:150px;" readonly />
                </div>
                <input type="text" name="uraian_koper_tambahan" id="uraian_koper_tambahan" class="form-control" value="" style="width:350px;" readonly />
            </div>

            <div class="form-group">
                <label for="no_surat" class="col-lg-3 control-label">No Surat</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field">
                                    <input type="text" name="no_surat" id="no_surat" class="gui-input" value="" readonly />
                                </label>
                                <a class="button" id="kode_surat">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="uraian_surat" class="col-lg-3 control-label">&nbsp;</label>
                <div class="col-lg-6">
                    <input type="text" name="uraian_surat" id="uraian_surat" class="form-control" value="" readonly />
                </div>
            </div>

            <div class="form-group">
                <label for="disabledInput" class="col-lg-3 control-label">Kategori</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample6" name="jenis_anggaran" value="Barang" checked="checked">
                        <label for="radioExample6" style="margin-right: 15px; padding-left: 25px;">Barang</label>

                        <input type="radio" id="radioExample7" name="jenis_anggaran" value="Pekerjaan">
                        <label for="radioExample7" style="margin-right: 15px; padding-left: 25px;">Pekerjaan</label>

                        <input type="radio" id="radioExample8" name="jenis_anggaran" value="Pelatihan">
                        <label for="radioExample8" style="margin-right: 15px; padding-left: 25px;">Pelatihan</label>
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
                    <textarea class="form-control" name="uraian_tambahan" id="uraian_tambahan" rows="3"></textarea>
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
                <label class="col-lg-3 control-label" for="lama_pelaksanaan">Lama Pelaksanaan</label>
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
                            <div class="smart-widget sm-right smr-50">
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
                    <input type="text" name="volume" id="volume" class="form-control num_only" value="" onkeyup="hitung_total();" onchange="hitung_total();">
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
                    <input type="text" name="harga_satuan" id="harga_satuan" class="form-control" value="" onkeyup="FormatCurrency(this); hitung_total();" onchange="hitung_total();">
                    <span class="help-block mt5" style="color:#FF0000;" id="empty_harga_satuan"><i class="fa fa-warning"></i> Harga Satuan Kosong</span>
                </div>
                <input type="button" style="font-weight: bold;" class="btn btn-success" value="Ubah Harga" id="ubah_harga" name="ubah_harga">
                <input type="button" style="font-weight: bold;" class="btn btn-primary" value="Simpan Harga" id="simpan_harga" name="simpan_harga">
            </div>

            <div class="form-group">
                <label for="total" class="col-lg-3 control-label">Total</label>
                <div class="col-lg-3">
                    <input type="text" name="total" id="total" class="form-control" value="" readonly>
                </div>
            </div>

        </div>

        <div class="panel-footer">
           <center>
                <input type="button" style="font-weight: bold;" name="simpan_tambahan" id="simpan_tambahan" class="btn btn-primary" value="SIMPAN">
                &nbsp;&nbsp;&nbsp;
                <input type="button" style="font-weight: bold;" name="batal_tambahan" id="batal_tambahan" class="btn btn-danger" value="BATAL">
           </center>
        </div>

    </form>
</div>

<script>
$(document).ready(function(){
    $('#kode_dpbm').click(function(){
        popup_dpbm_view();
        ajax_data_dpbm();
    });

    $('#kode_rab').click(function(){
        popup_rab_view();
        ajax_data_rab();
    });

    $('#kode_spm').click(function(){
        popup_no_spm();
        ajax_no_spm();
    });

    $('#koper').click(function(){
        $('#popup_koper').css('display','block');
        $('#popup_koper').show();
    });

    $('#kobar').click(function(){
        tabel_barang();
        get_data_barang();
    });

    //NO SURAT
    $('#kode_surat').click(function(){
        popup_no_surat();
        ajax_data_surat();
    });
});
</script>