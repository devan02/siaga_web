<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script src="<?php echo base_url(); ?>js-devan/pagination.js" type="text/javascript"></script>
<style>
.hijau{
	background: #05cc47;
	color: #fff;
}
</style>
<script>
$(document).ready(function(){
	<?php
        if($this->session->flashdata('sukses')){
    ?>
        pesan_simpan_no_keu();
    <?php
        }
    ?>

	get_dpbm();
	paging_dpbm();
	preview_data_dpbm();
	paging_preview_dpbm();

	$('.view_rab').hide();
	$('.view_spm').hide();

	$.greenify({
        url : '<?php echo base_url(); ?>dashboard/kode_perkiraan_c/get_kode_perkiraan',
        result : '#kode_perkiraan',
    });

	$("input[name='nomor']").click(function(){
		$('#popup_load').show();
		var nomor = $("input[name='nomor']:checked").val();
		if(nomor == "dpbm"){
			get_dpbm();
			paging_dpbm();
			preview_data_dpbm();
			paging_preview_dpbm();
			$('.view_dpbm').show();
			$('.view_rab').hide();
			$('.view_spm').hide();
			$('#popup_load').delay(2000).fadeOut();
		}else if(nomor == "rab"){
			get_rab_spk();
			paging_rab();
			preview_data_rab_spk();
			paging_preview_rab();
			$('.view_dpbm').hide();
			$('.view_rab').show();
			$('.view_spm').hide();
			$('#popup_load').delay(2000).fadeOut();
		}else{
			get_spm();
			paging_spm();
			preview_data_spm();
			paging_preview_spm();
			$('.view_dpbm').hide();
			$('.view_rab').hide();
			$('.view_spm').show();
			$('#popup_load').delay(2000).fadeOut();
		}
	});

	$('#file_dpbm').click(function(){
		get_dpbm();
	});

	$('#preview_dpbm').click(function(){
		preview_data_dpbm();
		$('#total_nilai_dpbm').html('Total Nilai '+NumberToMoney(0));
	});

	$('#search_data_dpbm').off('keyup').keyup(function(){
		get_dpbm();
	});

	$('#search_preview_dpbm').off('keyup').keyup(function(){
		preview_data_dpbm();
	});

	$('#file_rab').click(function(){
		get_rab_spk();
	});

	$('#preview_rab').click(function(){
		preview_data_rab_spk();
	});

	$('#search_data_rab').off('keyup').keyup(function(){
		get_rab_spk();
	});

	$('#search_preview_rab').off('keyup').keyup(function(){
		preview_data_rab_spk();
	});

	$('#file_spm').click(function(){
		get_spm();
	});

	$('#preview_spm').click(function(){
		preview_data_spm();
	});

	$('#search_data_spm').off('keyup').keyup(function(){
		get_spm();
	});

	$('#search_preview_spm').off('keyup').keyup(function(){
		preview_data_spm();
	});

	$('#simpan_dpbm').click(function(){
		$.ajax({
			url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/no_keu',
			data : {id:1},
			type : "POST",
			dataType : "json",
			async : false,
			success : function(no){
				var no_urut = no;
				$("input[name='id_dpbm_hidden[]']").each(function(i,val){
					var id_dpbm = val.value;
					if(id_dpbm != ""){
						no_urut++;

						$.ajax({
							url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/no_keu_dpbm',
							data : {id_dpbm:id_dpbm,no_urut:no_urut},
							type : "POST",
							dataType : "json",
							async : false,
							success : function(result){
								get_dpbm();
								$('#total_nilai_dpbm').html('Total Nilai 0.00');
								pesan_simpan_no_keu();
							}
						});
					}
				});
			}
		});
	});

	$('#simpan_rab').click(function(){
		$.ajax({
			url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/no_keu',
			data : {id:1},
			type : "POST",
			dataType : "json",
			async : false,
			success : function(no){
				var no_urut = no;
				$("input[name='id_rab_spk_hidden[]']").each(function(i,val){
					var id_rab_spk = val.value;
					if(id_rab_spk != ""){
						no_urut++;

						$.ajax({
							url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/no_keu_rab',
							data : {id_rab_spk:id_rab_spk,no_urut:no_urut},
							type : "POST",
							dataType : "json",
							async : false,
							success : function(result){
								get_rab_spk();
								$('#total_nilai_rab').html('Total Nilai 0.00');
								pesan_simpan_no_keu();
							}
						});
					}
				});
			}
		});
	});

	$('#simpan_spm').click(function(){
		$.ajax({
			url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/no_keu',
			data : {id:1},
			type : "POST",
			dataType : "json",
			async : false,
			success : function(no){
				var no_urut = no;
				$("input[name='id_spm_hidden[]']").each(function(i,val){
					var id_spm = val.value;
					if(id_spm != ""){
						no_urut++;

						$.ajax({
							url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/no_keu_spm',
							data : {id_spm:id_spm,no_urut:no_urut},
							type : "POST",
							dataType : "json",
							async : false,
							success : function(result){
								get_spm();
								$('#total_nilai_spm').html('Total Nilai 0.00');
								pesan_simpan_no_keu();
							}
						});
					}
				});
			}
		});
	});

});

//DPBM
function get_dpbm(){
	var ajax = "";
	var keyword = $('#search_data_dpbm').val();

	if(ajax){
		ajax.abort();
	}

    ajax = $.ajax({
        url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/data_dpbm',
        data : {keyword:keyword},
        type : "GET",
        dataType : "json",
        async : false,
        success : function(result){
        	$isi = "";

        	if(result == null || result == ""){
        		$isi = "";
        		$('#msg_dpbm').show();
	            $('#msg_dpbm').css('display','block');
        	}else{
        		for(var i=0; i<result.length; i++){
	                result[i].NO_DPBM  = result[i].NO_DPBM == null? "-":result[i].NO_DPBM;
	                result[i].HARGA  = result[i].HARGA == null? "0":result[i].HARGA;
	                result[i].TANGGAL  = result[i].TANGGAL == null? "-":result[i].TANGGAL;
	                result[i].DIMINTA_OLEH  = result[i].DIMINTA_OLEH == null? "-":result[i].DIMINTA_OLEH;
	                result[i].KETERANGAN  = result[i].KETERANGAN == null? "-":result[i].KETERANGAN;

	                $isi += "<tr id='tr_"+result[i].ID+"'>"+
	                			"<td align='center'>"+
									"<input type='checkbox' name='id_dpbm[]' class='cek_dpbm_"+result[i].ID+"' style='cursor:pointer;' value='"+result[i].HARGA+"' onclick=total_nilai_dpbm("+result[i].ID+");>"+
	                				"<input type='hidden' name='id_dpbm_hidden[]' value='' id='id_dpbm_"+result[i].ID+"'>"+
	                			"</td>"+
	                            "<td>"+result[i].NO_DPBM+"</td>"+
	                            "<td align='right' style='white-space:nowrap;'>"+NumberToMoney(result[i].HARGA)+"</td>"+
	                            "<td align='center'>"+result[i].TANGGAL+"</td>"+
	                            "<td>"+result[i].DIMINTA_OLEH+"</td>"+
	                            "<td>"+result[i].KETERANGAN+"</td>"+
	                        "</tr>";
	            }
	            $('#msg_dpbm').hide();
	            $('#msg_dpbm').css('display','none');
        	}
            $('#data tbody').html($isi);
            paging_dpbm();
           	$('#search_data_dpbm').off('keyup').keyup(function(){
				get_dpbm();
			});
        }
    });
}

function preview_data_dpbm(){
	var ajax = "";
	var keyword = $('#search_preview_dpbm').val();
	if(ajax){
		ajax.abort();
	}

	ajax = $.ajax({
		url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/preview_data_dpbm',
		data : {keyword:keyword},
		type : "GET",
		dataType : "json",
		async : false,
		success : function(result){
			$isi = "";
			var no = 0;
			if(result == null){
				$('#data_preview tbody').html($isi);
				$('#msg_dpbm2').show();
			}else{
				for(var i=0; i<result.length; i++){
					no++;
					var id_det_dpbm = "";

					result[i].NO_KEU = (result[i].NO_KEU == null || result[i].NO_KEU == "")? "-":result[i].NO_KEU;
					result[i].HARGA = result[i].HARGA == null? "0":result[i].HARGA;
					result[i].KODE_ANGGARAN = result[i].KODE_ANGGARAN == null? "-":result[i].KODE_ANGGARAN;
					result[i].JENIS_RAPAT = result[i].JENIS_RAPAT == null? "-":result[i].JENIS_RAPAT;
					result[i].TANGGAL_CAIR = (result[i].TANGGAL_CAIR == null || result[i].TANGGAL_CAIR == "")? "-":result[i].TANGGAL_CAIR;
					
					if(result[i].ID_DET_DPBM == null){
						id_det_dpbm = "";
					}else{
						id_det_dpbm = "."+result[i].ID_DET_DPBM;
					}

					$isi += "<tr>"+
								"<td align='center'>"+no+"</td>"+
								"<td align='center'>"+result[i].NO_KEU+"</td>"+
								"<td>"+result[i].NO_DPBM+id_det_dpbm+"</td>"+
								"<td align='right' style='white-space:nowrap;'>"+NumberToMoney(result[i].HARGA)+"</td>"+
								"<td align='center'>"+result[i].TANGGAL+"</td>"+
								"<td>"+result[i].DIMINTA_OLEH+"</td>"+
								"<td>"+result[i].KETERANGAN+"</td>"+
								"<td align='center'>"+result[i].KODE_ANGGARAN+"</td>"+
								"<td align='center'>"+result[i].JENIS_RAPAT+"</td>"+
								"<td align='center'>"+result[i].TANGGAL_CAIR+"</td>"+
							"</tr>";
				}
				$('#data_preview tbody').html($isi);
				paging_preview_dpbm();
				$('#msg_dpbm2').hide();
			}
		}
	});
}

function total_nilai_dpbm(id){
	var sum = 0;
	var ceklist = $("input[name='id_dpbm[]']:checked").length;
	var cek = $(".cek_dpbm_"+id+":checked").length;
	
	if(cek == 1){
		$('#tr_'+id).addClass('hijau');
		$("#id_dpbm_"+id).val(id);
	}else{
		$('#tr_'+id).removeClass('hijau');
		$("#id_dpbm_"+id).val("");
	}

    $("input[name='id_dpbm[]']:checked").each(function(idx, elm) {
    	if(ceklist != 0){
    		sum += parseInt(elm.value, 10);
    	}
    });
    $('#total_nilai_dpbm').html('Total Nilai '+NumberToMoney(sum));
}

function paging_dpbm($selector){

    if(typeof $selector == 'undefined')
    {
        $selector = $("#data tbody tr");
    }

    window.tp = new Pagination('#tablePaging_data_dpbm', {
        itemsCount:$selector.length,
        pageSize : 10,
        onPageSizeChange: function (ps) {
            console.log('changed to ' + ps);
        },
        onPageChange: function (paging) {
            //custom paging logic here
            //console.log(paging);
            var start = paging.pageSize * (paging.currentPage - 1),
                end = start + paging.pageSize,
                $rows = $selector;

            $rows.hide();

            for (var i = start; i < end; i++) {
                $rows.eq(i).show();
            }
        }
    });
}

function paging_preview_dpbm($selector){

    if(typeof $selector == 'undefined')
    {
        $selector = $("#data_preview tbody tr");
    }

    window.tp = new Pagination('#tablePaging_dpbm', {
        itemsCount:$selector.length,
        pageSize : 10,
        onPageSizeChange: function (ps) {
            console.log('changed to ' + ps);
        },
        onPageChange: function (paging) {
            //custom paging logic here
            //console.log(paging);
            var start = paging.pageSize * (paging.currentPage - 1),
                end = start + paging.pageSize,
                $rows = $selector;

            $rows.hide();

            for (var i = start; i < end; i++) {
                $rows.eq(i).show();
            }
        }
    });
}

//RAB
function get_rab_spk(){
	var ajax = "";
	var keyword = $('#search_data_rab').val();
	if(ajax){
		ajax.abort();
	}

    ajax = $.ajax({
        url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/get_rab_spk',
        data : {keyword:keyword},
        type : "GET",
        dataType : "json",
        async : false,
        success : function(result){
            $isi = "";

            if(result == null || result == ""){
            	$isi = "";
            	$('#msg_rab').show();
            	$('#msg_rab').css('display','block');
            }else{
	            for(var i=0; i<result.length; i++){
	                $isi += "<tr id='tr_rab_"+result[i].ID+"'>"+
	                			"<td align='center'>"+
									"<input type='checkbox' class='cek_rab_spk_"+result[i].ID+"' name='id_rab_spk[]' value='"+result[i].HARGA_SATUAN+"' style='cursor:pointer;' onclick=total_nilai_rab("+result[i].ID+");>"+
	                				"<input type='hidden' name='id_rab_spk_hidden[]' value='' id='id_rab_spk_"+result[i].ID+"'>"+
	                			"</td>"+
	                            "<td style='white-space:nowrap;'>"+result[i].NO_RAB+"</td>"+
	                            "<td align='right' style='white-space:nowrap;'>"+NumberToMoney(result[i].HARGA_SATUAN)+"</td>"+
	                            "<td align='center'>"+result[i].KOTA+"</td>"+
	                            "<td>"+result[i].KEGIATAN+"</td>"+
	                            "<td>"+result[i].PEKERJAAN+"</td>"+
	                            "<td align='center'>"+result[i].LOKASI+"</td>"+
	                        "</tr>";
	            }
	            $('#msg_rab').hide();
            	$('#msg_rab').css('display','none');
            }
            $('#data2 tbody').html($isi);
        	paging_rab();
        }
    });
}

function preview_data_rab_spk(){
	var ajax = "";
	var keyword = $('#search_preview_rab').val();
	if(ajax){
		ajax.abort();
	}

	ajax = $.ajax({
		url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/preview_data_rab_spk',
		data : {keyword:keyword},
		type : "GET",
		dataType : "json",
		async : false,
		success : function(result){
			$isi = "";
			var no = 0;
			if(result == null){
				$('#data_preview_rab tbody').html($isi);
				$('#msg_rab2').show();
			}else{
				for(var i=0; i<result.length; i++){
					no++;
					
					result[i].NO_KEU = result[i].NO_KEU == null? "-":result[i].NO_KEU;
					result[i].KODE_ANGGARAN = result[i].KODE_ANGGARAN == null? "-":result[i].KODE_ANGGARAN;
					result[i].PERIODE = result[i].PERIODE == null? "-":result[i].PERIODE;
					result[i].TANGGAL_CAIR = (result[i].TANGGAL_CAIR == null || result[i].TANGGAL_CAIR == "")? "-":result[i].TANGGAL_CAIR;

					$isi += "<tr>"+
								"<td align='center'>"+no+"</td>"+
								"<td style='white-space:nowrap;'>"+result[i].NO_RAB+"</td>"+
								"<td align='right' style='white-space:nowrap;'>"+NumberToMoney(result[i].HARGA_SATUAN)+"</td>"+
								"<td style='white-space:nowrap;'>"+result[i].KEGIATAN+"</td>"+
								"<td style='white-space:nowrap;'>"+result[i].PEKERJAAN+"</td>"+
								"<td align='center' style='white-space:nowrap;'>"+result[i].LOKASI+"</td>"+
								"<td align='center'>"+result[i].NO_KEU+"</td>"+
								"<td align='center'>"+result[i].KODE_ANGGARAN+"</td>"+
								"<td align='center' style='white-space:nowrap;'>"+result[i].PERIODE+"</td>"+
								"<td align='center'>"+result[i].TANGGAL_CAIR+"</td>"+
							"</tr>";
				}
				$('#data_preview_rab tbody').html($isi);
				paging_preview_rab();
				$('#msg_rab2').hide();
			}
		}
	});
}

function total_nilai_rab(id){
	var sum = 0;
	var ceklist = $("input[name='id_rab_spk[]']:checked").length;
	var cek = $(".cek_rab_spk_"+id+":checked").length;
	
	if(cek == 1){
		$('#tr_rab_'+id).addClass('hijau');
		$("#id_rab_spk_"+id).val(id);
	}else{
		$('#tr_rab_'+id).removeClass('hijau');
		$("#id_rab_spk_"+id).val("");
	}

    $("input[name='id_rab_spk[]']:checked").each(function(idx, elm) {
    	if(ceklist != 0){
    		sum += parseInt(elm.value, 10);
    	}
    });
    $('#total_nilai_rab').html('Total Nilai '+NumberToMoney(sum));
}

function paging_rab($selector){ 

    if(typeof $selector == 'undefined')
    {
        $selector = $("#data2 tbody tr");
    }

    window.tp = new Pagination('#tablePaging_data_rab', {
        itemsCount:$selector.length,
        pageSize : 10,
        onPageSizeChange: function (ps) {
            console.log('changed to ' + ps);
        },
        onPageChange: function (paging) {
            //custom paging logic here
            //console.log(paging);
            var start = paging.pageSize * (paging.currentPage - 1),
                end = start + paging.pageSize,
                $rows = $selector;

            $rows.hide();

            for (var i = start; i < end; i++) {
                $rows.eq(i).show();
            }
        }
    });
}

function paging_preview_rab($selector){

    if(typeof $selector == 'undefined')
    {
        $selector = $("#data_preview_rab tbody tr");
    }

    window.tp = new Pagination('#tablePaging_rab', {
        itemsCount:$selector.length,
        pageSize : 10,
        onPageSizeChange: function (ps) {
            console.log('changed to ' + ps);
        },
        onPageChange: function (paging) {
            //custom paging logic here
            //console.log(paging);
            var start = paging.pageSize * (paging.currentPage - 1),
                end = start + paging.pageSize,
                $rows = $selector;

            $rows.hide();

            for (var i = start; i < end; i++) {
                $rows.eq(i).show();
            }
        }
    });
}

//SPM
function get_spm(){
	var ajax = "";
	var keyword = $('#search_data_spm').val();
	if(ajax){
		ajax.abort();
	}

    ajax = $.ajax({
        url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/data_spm',
        data : {keyword:keyword},
        type : "GET",
        dataType : "json",
        async : false,
        success : function(result){
            $isi = "";

            if(result == null || result == ""){
            	$isi = "";
            	$('#msg_spm').show();
            	$('#msg_spm').css('display','block');
            }else{
	            for(var i=0; i<result.length; i++){
	                $isi += "<tr id='tr_spm_"+result[i].ID+"'>"+
	                			"<td align='center'>"+
									"<input type='checkbox' name='id_spm[]' class='cek_id_spm_"+result[i].ID+"' value='"+result[i].NILAI+"' style='cursor:pointer;' onclick=total_nilai_spm("+result[i].ID+");>"+
	                				"<input type='hidden' name='id_spm_hidden[]' value='' id='id_spm_"+result[i].ID+"'>"+
	                			"</td>"+
	                            "<td style='white-space:nowrap;'>"+result[i].NO_SPM+"</td>"+
	                            "<td align='right' style='white-space:nowrap;'>"+NumberToMoney(result[i].NILAI)+"</td>"+
	                            "<td align='center'>"+result[i].TGL_SPM+"</td>"+
	                            "<td>"+result[i].KET+"</td>"+
	                        "</tr>";
	            }
	            $('#msg_spm').hide();
            	$('#msg_spm').css('display','none');
            }
            $('#data_spm tbody').html($isi);
            paging_spm();
        }
    });
}

function preview_data_spm(){
	var ajax = "";
	var keyword = $('#search_preview_spm').val();
	if(ajax){
		ajax.abort();
	}

	ajax = $.ajax({
		url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/preview_data_spm',
		data : {keyword:keyword},
		type : "GET",
		dataType : "json",
		async : false,
		success : function(result){
			$isi = "";
			var no = 0;
			if(result == null){
				$('#data_preview_spm tbody').html($isi);
				$('#msg_spm2').show();
			}else{
				for(var i=0; i<result.length; i++){
					no++;
					result[i].NO_KEU = (result[i].NO_KEU == null || result[i].NO_KEU == "")? "-":result[i].NO_KEU;
					result[i].KODE_ANGGARAN = result[i].KODE_ANGGARAN == null? "-":result[i].KODE_ANGGARAN;
					result[i].PERIODE = result[i].PERIODE == null? "-":result[i].PERIODE;
					result[i].TANGGAL_CAIR = (result[i].TANGGAL_CAIR == null || result[i].TANGGAL_CAIR == "")? "-":result[i].TANGGAL_CAIR;
					
					$isi += "<tr>"+
								"<td align='center'>"+no+"</td>"+
								"<td style='white-space:nowrap;'>"+result[i].NO_SPM+"</td>"+
								"<td align='right' style='white-space:nowrap;'>"+NumberToMoney(result[i].NILAI)+"</td>"+
								"<td align='center'>"+result[i].TGL_SPM+"</td>"+
								"<td>"+result[i].KET+"</td>"+
								"<td align='center'>"+result[i].NO_KEU+"</td>"+
								"<td align='center'>"+result[i].KODE_ANGGARAN+"</td>"+
								"<td align='center'>"+result[i].PERIODE+"</td>"+
								"<td align='center'>"+result[i].TANGGAL_CAIR+"</td>"+
							"</tr>";
				}
				$('#data_preview_spm tbody').html($isi);
				paging_preview_spm();
				$('#msg_spm2').hide();
			}
		}
	});
}

function total_nilai_spm(id){
	var sum = 0;
	var ceklist = $("input[name='id_spm[]']:checked").length;
	var cek = $(".cek_id_spm_"+id+":checked").length;
	
	if(cek == 1){
		$('#tr_spm_'+id).addClass('hijau');
		$("#id_spm_"+id).val(id);
	}else{
		$('#tr_spm_'+id).removeClass('hijau');
		$("#id_spm_"+id).val("");
	}

    $("input[name='id_spm[]']:checked").each(function(idx, elm) {
    	if(ceklist != 0){
    		sum += parseInt(elm.value, 10);
    	}
    });
    $('#total_nilai_spm').html('Total Nilai '+NumberToMoney(sum));
}

function paging_spm($selector){

    if(typeof $selector == 'undefined')
    {
        $selector = $("#data_spm tbody tr");
    }

    window.tp = new Pagination('#tablePaging_data_spm', {
        itemsCount:$selector.length,
        pageSize : 10,
        onPageSizeChange: function (ps) {
            console.log('changed to ' + ps);
        },
        onPageChange: function (paging) {
            //custom paging logic here
            //console.log(paging);
            var start = paging.pageSize * (paging.currentPage - 1),
                end = start + paging.pageSize,
                $rows = $selector;

            $rows.hide();

            for (var i = start; i < end; i++) {
                $rows.eq(i).show();
            }
        }
    });
}

function paging_preview_spm($selector){

    if(typeof $selector == 'undefined')
    {
        $selector = $("#data_preview_spm tbody tr");
    }

    window.tp = new Pagination('#tablePaging_spm', {
        itemsCount:$selector.length,
        pageSize : 10,
        onPageSizeChange: function (ps) {
            console.log('changed to ' + ps);
        },
        onPageChange: function (paging) {
            //custom paging logic here
            //console.log(paging);
            var start = paging.pageSize * (paging.currentPage - 1),
                end = start + paging.pageSize,
                $rows = $selector;

            $rows.hide();

            for (var i = start; i < end; i++) {
                $rows.eq(i).show();
            }
        }
    });
}

function zeroPad(num, places) {
  var zero = places - num.toString().length + 1;
  return Array(+(zero > 0 && zero)).join("0") + num;
}

function no_urut_anggaran_spm(id_spm){
	var nomor = $("input[name='nomor']:checked").val();
	var id = 1;
	$.ajax({
		url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/get_no_urut_anggaran_spm',
		data : {id:id,id_spm:id_spm},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(result){
			$('#popup_load').show();
			$('#popup_load').css('display','block');
			get_spm();
			preview_data_spm();
			$('#popup_load').delay(2000).fadeOut('slow');
		}
	});
}
</script>
<style>
.tabel_dpbm{
	background: #fff;
	width: 1150px;
	z-index: 99;
}

#msg_dpbm{
	display: none;
}

#msg_rab{
	display: none;
}
</style>
<div id="popup_load">
    <div class="window_load">
        <img src="<?=base_url()?>/ico/loading.gif" height="100" width="100">
    </div>
</div>
<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <form class="form-horizontal" role="form" action="" method="post">
	    <div class="panel-body">
		    <div class="form-group">
		        <label for="disabledInput" class="col-lg-3 control-label">Nomor</label>
		        <div class="col-lg-8" style="margin-top: 8px;">
		            <div class="radio-custom radio-primary mb5">
		                <input type="radio" id="radioExample1" name="nomor" value="dpbm" checked="checked">
		                <label for="radioExample1" style="margin-right: 15px; padding-left: 25px;">DPBM</label>

		                <input type="radio" id="radioExample2" name="nomor" value="rab">
		                <label for="radioExample2" style="margin-right: 15px; padding-left: 25px;">RAB</label>

		                <input type="radio" id="radioExample3" name="nomor" value="spm">
		                <label for="radioExample3" style="margin-right: 15px; padding-left: 25px;">SPM</label>
		            </div>
		        </div>
		    </div>

	    </div>
    </form>
</div>

<!-- DPBM -->
<div class="panel view_dpbm">
    <div class="panel-heading">
        <span class="panel-title">
            <span class="glyphicon glyphicon-hand-down"></span>&nbsp;</span>
    </div>
    <div class="panel-body">
        <ul class="nav nav-pills mb20 pull-right">
            <li class="active">
                <a data-toggle="tab" href="#tab2" aria-expanded="true" id="file_dpbm">Data DPBM</a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#tab1" aria-expanded="false" id="preview_dpbm">Preview Data DPBM</a>
            </li>
        </ul>
        <div class="clearfix"></div>
        <div class="tab-content br-n pn">
            <div class="tab-pane" id="tab1">
                <div class="row">
                	<div class="col-lg-3">
	                    <input type="text" placeholder="Cari..." value="" class="form-control" name="search_preview_dpbm" id="search_preview_dpbm">
	                </div>
                    <div class="col-md-12" style="margin-top:10px;">
                     	<div class="panel-heading">
					        <span class="panel-title text-info fw700">
					            <span class="glyphicons glyphicons-table"></span>Preview Data DPBM
					        </span>
					    </div>
					    <div>
						    <table class="table table-bordered" id="data_preview">
						        <thead>
						            <tr>
						            	<th style="vertical-align: middle; text-align:center; white-space:nowrap;">No</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">No KEU</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">No DPBM</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Nilai</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Tanggal</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Diminta Oleh</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Keterangan</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Kode Anggaran</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Periode</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Tanggal Cair</th>
						            </tr>
						        </thead>
						        <tbody>
						            
						        </tbody>
						    </table>
						    <div class="dt-panelfooter clearfix">
						    	<div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
						    		<div id="tablePaging_dpbm"> </div>
						    	</div>
						    </div>
					    </div>
					    <div class="panel-heading" style="text-align:center;" id="msg_dpbm2">
					        <span class="panel-title">
					            Tidak Ada Data
					        </span>
					    </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane active" id="tab2">
                <div class="row">
                	<form action=""  method="post">
		                <div class="col-lg-3">
		                    <input type="text" placeholder="Cari..." value="" class="form-control" name="search_data_dpbm" id="search_data_dpbm">
		                </div>
	                    <div class="col-md-12" style="margin-top:10px;">
	                        <div class="panel-heading">
						        <span class="panel-title text-info fw700">
						            <span class="glyphicons glyphicons-table"></span>Data DPBM
						        </span>
						    </div>
						    <div>
							    <table class="table table-bordered" id="data">
							        <thead>
							            <tr>
							            	<th style="vertical-align: middle; text-align:center; white-space:nowrap;">&nbsp;</th>
							                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">No DPBM</th>
							                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Nilai</th>
							                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Tanggal</th>
							                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Diminta Oleh</th>
							                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Keterangan</th>
							            </tr>
							        </thead>
							        <tbody>
							            
							        </tbody>
							    </table>
							    <div class="panel-heading" style="text-align:center;" id="msg_dpbm">
							        <span class="panel-title">
							            Tidak Ada Data
							        </span>
							    </div>
						        <div class="alert alert-system alert-dismissable">
		                            <strong id="total_nilai_dpbm">Total Nilai 0.00</strong>
		                        </div>
							    <div class="dt-panelfooter clearfix">
							    	<div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
							    		<div id="tablePaging_data_dpbm"> </div>
							    	</div>
							    </div>
							    <div class="panel-footer">
							    	<center>
							        	<input type="button" style="font-weight: bold;" class="btn btn-success btn-gradient dark" value="Proses No. KEU" id="simpan_dpbm" name="simpan_dpbm">
							    	</center>
							    </div>
						    </div>
	                    </div>
                	</form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- RAB -->
<div class="panel view_rab">
    <div class="panel-heading">
        <span class="panel-title">
            <span class="glyphicon glyphicon-hand-down"></span></span>
    </div>
    <div class="panel-body">
        <ul class="nav nav-pills mb20 pull-right">
            <li class="active">
                <a data-toggle="tab" href="#tab4" id="file_rab">Data RAB</a>
            </li>
            <li>
                <a data-toggle="tab" href="#tab3" id="preview_rab">Preview Data RAB</a>
            </li>
        </ul>
        <div class="clearfix"></div>
        <div class="tab-content br-n pn">
            <div class="tab-pane" id="tab3">
                <div class="row">
                	<div class="col-lg-3">
	                    <input type="text" placeholder="Cari..." value="" class="form-control" name="search_preview_rab" id="search_preview_rab">
	                </div>
                    <div class="col-md-12" style="margin-top:10px;">
                        <div class="panel-heading">
					        <span class="panel-title text-info fw700">
					            <span class="glyphicons glyphicons-table"></span>Preview Data RAB
					        </span>
					    </div>
					    <div class="panel-body pn">
					    	<div class="scroll-xy">
							    <table class="table table-bordered" id="data_preview_rab">
							        <thead>
							            <tr>
							            	<th style="vertical-align: middle; text-align:center; white-space:nowrap;">No</th>
							                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">No RAB</th>
							                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Nilai</th>
							                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Kegiatan</th>
							                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Pekerjaan</th>
							                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Lokasi</th>
							                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">No KEU</th>
							                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Kode Anggaran</th>
							                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Periode</th>
							                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Tanggal Cair</th>
							            </tr>
							        </thead>
							        <tbody>
							            
							        </tbody>
							    </table>
					    	</div>
						    <div class="panel-heading" style="text-align:center;" id="msg_rab2">
						        <span class="panel-title">
						            Tidak Ada Data
						        </span>
						    </div>
						    <div class="dt-panelfooter clearfix">
						    	<div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
						    		<div id="tablePaging_rab"> </div>
						    	</div>
						    </div>
					    </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane active" id="tab4">
                <div class="row">
                	<div class="col-lg-3">
	                    <input type="text" placeholder="Cari..." value="" class="form-control" name="search_data_rab" id="search_data_rab">
	                </div>
                    <div class="col-md-12" style="margin-top:10px;">
                        <div class="panel-heading">
					        <span class="panel-title text-info fw700">
					            <span class="glyphicons glyphicons-table"></span>Data RAB
					        </span>
					    </div>
					    <div class="panel-body pn">
						    <table class="table table-bordered" id="data2">
						        <thead>
						            <tr>
						            	<th style="vertical-align: middle; text-align:center; white-space:nowrap;">&nbsp;</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">No RAB</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Nilai</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Kota</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Kegiatan</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Pekerjaan</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Lokasi</th>
						            </tr>
						        </thead>
						        <tbody>
						            
						        </tbody>
						    </table>
						    <div class="panel-heading" style="text-align:center;" id="msg_rab">
						        <span class="panel-title">
						            Tidak Ada Data
						        </span>
						    </div>
						    <div class="alert alert-system alert-dismissable">
	                            <strong id="total_nilai_rab">Total Nilai 0.00</strong>
	                        </div>
						    <div class="dt-panelfooter clearfix">
						    	<div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
						    		<div id="tablePaging_data_rab"> </div>
						    	</div>
						    </div>
						    <div class="panel-footer">
						    	<center>
						        	<input type="button" style="font-weight: bold;" class="btn btn-success btn-gradient dark" value="Proses No. KEU" id="simpan_rab" name="simpan_rab">
						    	</center>
						    </div>
					    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SPM -->
<div class="panel view_spm">
    <div class="panel-heading">
        <span class="panel-title">
            <span class="glyphicon glyphicon-hand-down"></span>&nbsp;</span>
    </div>
    <div class="panel-body">
        <ul class="nav nav-pills mb20 pull-right">
            <li class="active">
                <a data-toggle="tab" href="#tab6" aria-expanded="true" id="file_spm">Data SPM</a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#tab5" aria-expanded="false" id="preview_spm">Preview Data SPM</a>
            </li>
        </ul>
        <div class="clearfix"></div>
        <div class="tab-content br-n pn">
            <div class="tab-pane" id="tab5">
                <div class="row">
                	<div class="col-lg-3">
	                    <input type="text" placeholder="Cari..." value="" class="form-control" name="search_preview_spm" id="search_preview_spm">
	                </div>
                    <div class="col-md-12" style="margin-top:10px;">
                     	<div class="panel-heading">
					        <span class="panel-title text-info fw700">
					            <span class="glyphicons glyphicons-table"></span>Preview Data SPM
					        </span>
					    </div>
					    <div>
						    <table class="table table-bordered" id="data_preview_spm">
						        <thead>
						            <tr>
						            	<th style="vertical-align: middle; text-align:center; white-space:nowrap;">No</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">No SPM</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Nilai</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Tanggal</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Keterangan</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">No KEU</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Kode Anggaran</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Periode</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Tanggal Cair</th>
						            </tr>
						        </thead>
						        <tbody>
						            
						        </tbody>
						    </table>
						    <div class="dt-panelfooter clearfix">
						    	<div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
						    		<div id="tablePaging_spm"> </div>
						    	</div>
						    </div>
					    </div>
					    <div class="panel-heading" style="text-align:center;" id="msg_spm2">
					        <span class="panel-title">
					            Tidak Ada Data
					        </span>
					    </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane active" id="tab6">
                <div class="row">
	                <div class="col-lg-3">
	                    <input type="text" placeholder="Cari..." value="" class="form-control" name="search_data_spm" id="search_data_spm">
	                </div>
                    <div class="col-md-12" style="margin-top:10px;">
                        <div class="panel-heading">
					        <span class="panel-title text-info fw700">
					            <span class="glyphicons glyphicons-table"></span>Data SPM
					        </span>
					    </div>
					    <div>
						    <table class="table table-bordered" id="data_spm">
						        <thead>
						            <tr>
						            	<th style="vertical-align: middle; text-align:center; white-space:nowrap;">&nbsp;</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">No SPM</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Nilai</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Tanggal</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Keterangan</th>
						            </tr>
						        </thead>
						        <tbody>
						            
						        </tbody>
						    </table>
						    <div class="panel-heading" style="text-align:center;" id="msg_spm">
						        <span class="panel-title">
						            Tidak Ada Data
						        </span>
						    </div>
						    <div class="alert alert-system alert-dismissable">
	                            <strong id="total_nilai_spm">Total Nilai 0.00</strong>
	                        </div>
						    <div class="dt-panelfooter clearfix">
						    	<div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
						    		<div id="tablePaging_data_spm"> </div>
						    	</div>
						    </div>
						    <div class="panel-footer">
						    	<center>
						        	<input type="button" style="font-weight: bold;" class="btn btn-success btn-gradient dark" value="Proses No. KEU" id="simpan_spm" name="simpan_spm">
						    	</center>
						    </div>
					    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>