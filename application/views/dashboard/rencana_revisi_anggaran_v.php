<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script src="<?php echo base_url(); ?>js-devan/paging.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js-devan/paging_rab.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js-devan/pagination.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
	get_dpbm();
	preview_data_dpbm();
	paging();

	$('.view_rab').hide();

	$.greenify({
        url : '<?php echo base_url(); ?>dashboard/kode_perkiraan_c/get_kode_perkiraan',
        result : '#kode_perkiraan',
    });

	$("input[name='nomor']").click(function(){
		$('#popup_load').show();
		var nomor = $("input[name='nomor']:checked").val();
		if(nomor == "dpbm"){
			get_dpbm();
			preview_data_dpbm();
			paging();
			$('.view_dpbm').show();
			$('.view_rab').hide();
			$('#popup_load').delay(2000).fadeOut();
		}else{
			get_rab_spk();
			preview_data_rab_spk();
			paging_preview_rab();
			$('.view_dpbm').hide();
			$('.view_rab').show();
			$('#popup_load').delay(2000).fadeOut();
		}
	});
});

function get_dpbm(){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/data_dpbm',
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
	                result[i].TANGGAL  = result[i].TANGGAL == null? "-":result[i].TANGGAL;
	                result[i].DIMINTA_OLEH  = result[i].DIMINTA_OLEH == null? "-":result[i].DIMINTA_OLEH;
	                result[i].KETERANGAN  = result[i].KETERANGAN == null? "-":result[i].KETERANGAN;

	                $isi += "<tr>"+
	                			"<td align='center'>"+
									"<input type='checkbox' name='id_dpbm' style='cursor:pointer;' value='"+result[i].ID+"' onclick=no_urut_anggaran("+result[i].ID+");>"+
	                			"</td>"+
	                            "<td align='center'>"+result[i].NO_DPBM+"</td>"+
	                            "<td align='center'>"+result[i].TANGGAL+"</td>"+
	                            "<td align='center'>"+result[i].DIMINTA_OLEH+"</td>"+
	                            "<td align='center'>"+result[i].KETERANGAN+"</td>"+
	                        "</tr>";
	            }
	            $('#msg_dpbm').hide();
	            $('#msg_dpbm').css('display','none');
        	}
            $('#data tbody').html($isi);
           
        }
    });
}

function preview_data_dpbm(){
	$.ajax({
		url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/preview_data_dpbm',
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
					$isi += "<tr>"+
								"<td align='center'>"+no+"</td>"+
								"<td align='center'>"+result[i].NO_DPBM+"</td>"+
								"<td align='center'>"+result[i].TANGGAL+"</td>"+
								"<td align='center'>"+result[i].DIMINTA_OLEH+"</td>"+
								"<td align='center'>"+result[i].KETERANGAN+"</td>"+
								"<td align='center'>"+result[i].NO_KEU+"</td>"+
								"<td align='center'>"+result[i].KODE_ANGGARAN+"</td>"+
								"<td align='center'>"+result[i].JENIS_RAPAT+"</td>"+
							"</tr>";
				}
				$('#data_preview tbody').html($isi);
				$('#msg_dpbm2').hide();
			}
		}
	});
}

function get_rab_spk(){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/get_rab_spk',
        type : "POST",
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
	                $isi += "<tr>"+
	                			"<td align='center'>"+
									"<input type='checkbox' name='id_rab_spk' value='"+result[i].ID+"' style='cursor:pointer;' onclick=no_urut_anggaran_rab("+result[i].ID+");>"+
	                			"</td>"+
	                            "<td>"+result[i].NO_RAB+"</td>"+
	                            "<td>"+result[i].KOTA+"</td>"+
	                            "<td>"+result[i].KEGIATAN+"</td>"+
	                            "<td>"+result[i].PEKERJAAN+"</td>"+
	                            "<td>"+result[i].LOKASI+"</td>"+
	                        "</tr>";
	            }
	            $('#msg_rab').hide();
            	$('#msg_rab').css('display','none');
            }
            $('#data2 tbody').html($isi);
        }
    });
}

function preview_data_rab_spk(){
	$.ajax({
		url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/preview_data_rab_spk',
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
					$isi += "<tr>"+
								"<td align='center'>"+no+"</td>"+
								"<td align='center' style='white-space:nowrap;'>"+result[i].NO_RAB+"</td>"+
								"<td align='center'>"+result[i].KOTA+"</td>"+
								"<td>"+result[i].KEGIATAN+"</td>"+
								"<td>"+result[i].PEKERJAAN+"</td>"+
								"<td align='center'>"+result[i].LOKASI+"</td>"+
								"<td align='center'>"+result[i].NO_KEU+"</td>"+
								"<td align='center'>"+result[i].KODE_ANGGARAN+"</td>"+
								"<td align='center'>"+result[i].JENIS_RAPAT+"</td>"+
							"</tr>";
				}
				$('#data_preview_rab tbody').html($isi);
				$('#msg_rab2').hide();
			}
		}
	});
}

function zeroPad(num, places) {
  var zero = places - num.toString().length + 1;
  return Array(+(zero > 0 && zero)).join("0") + num;
}

function no_urut_anggaran(id_dpbm){
	var nomor = $("input[name='nomor']:checked").val();
	var id = 1;
	$.ajax({
		url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/get_no_urut_anggaran',
		data : {id:id,id_dpbm:id_dpbm},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(result){
			$('#popup_load').show();
			$('#popup_load').css('display','block');
			get_dpbm();
			$('#popup_load').delay(2000).fadeOut('slow');
		}
	});
}

function no_urut_anggaran_rab(id_rab){
	var nomor = $("input[name='nomor']:checked").val();
	var id = 1;
	$.ajax({
		url : '<?php echo base_url(); ?>dashboard/rencana_realisasi_anggaran_c/get_no_urut_anggaran_rab_spk',
		data : {id:id,id_rab:id_rab},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(result){
			$('#popup_load').show();
			$('#popup_load').css('display','block');
			get_rab_spk();
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
		            </div>
		        </div>
		    </div>

	    </div>
    </form>
</div>

<div class="panel view_dpbm">
    <div class="panel-heading">
        <span class="panel-title">
            <span class="glyphicon glyphicon-hand-down"></span>&nbsp;</span>
    </div>
    <div class="panel-body">
        <ul class="nav nav-pills mb20 pull-right">
            <li class="active">
                <a data-toggle="tab" href="#tab2" aria-expanded="true">Data DPBM</a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#tab1" aria-expanded="false">Preview Data DPBM</a>
            </li>
        </ul>
        <div class="clearfix"></div>
        <div class="tab-content br-n pn">
            <div class="tab-pane" id="tab1">
                <div class="row">
                    <div class="col-md-12">
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
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">No DPBM</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Tanggal</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Diminta Oleh</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Keterangan</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">No KEU</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Kode Anggaran</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Periode</th>
						            </tr>
						        </thead>
						        <tbody>
						            
						        </tbody>
						    </table>
						    <div class="dt-panelfooter clearfix">
						    	<div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
						    		<div id="tablePaging"> </div>
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
                    <div class="col-md-12">
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
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Tanggal</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Diminta Oleh</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Keterangan</th>
						            </tr>
						        </thead>
						        <tbody>
						            
						        </tbody>
						    </table>
					    </div>
					    <div class="panel-heading" style="text-align:center;" id="msg_dpbm">
					        <span class="panel-title">
					            Tidak Ada Data
					        </span>
					    </div>
                    </div>
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
                <a data-toggle="tab" href="#tab4">Data RAB</a>
            </li>
            <li>
                <a data-toggle="tab" href="#tab3">Preview Data RAB</a>
            </li>
        </ul>
        <div class="clearfix"></div>
        <div class="tab-content br-n pn">
            <div class="tab-pane" id="tab3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-heading">
					        <span class="panel-title text-info fw700">
					            <span class="glyphicons glyphicons-table"></span>Preview Data RAB
					        </span>
					    </div>
					    <div class="panel-body pn">
						    <table class="table table-bordered" id="data_preview_rab">
						        <thead>
						            <tr>
						            	<th style="vertical-align: middle; text-align:center; white-space:nowrap;">No</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">No RAB</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Kota</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Kegiatan</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Pekerjaan</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Lokasi</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">No KEU</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Kode Anggaran</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Periode</th>
						            </tr>
						        </thead>
						        <tbody>
						            
						        </tbody>
						    </table>
						    <div class="dt-panelfooter clearfix">
						    	<div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
						    		<div id="tablePagingRAB"> </div>
						    	</div>
						    </div>
					    </div>
					    <div class="panel-heading" style="text-align:center;" id="msg_rab2">
					        <span class="panel-title">
					            Tidak Ada Data
					        </span>
					    </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane active" id="tab4">
                <div class="row">
                    <div class="col-md-12">
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
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Kota</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Kegiatan</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Pekerjaan</th>
						                <th style="vertical-align: middle; text-align:center; white-space:nowrap;">Lokasi</th>
						            </tr>
						        </thead>
						        <tbody>
						            
						        </tbody>
						    </table>
					    </div>
					    <div class="panel-heading" style="text-align:center;" id="msg_rab">
					        <span class="panel-title">
					            Tidak Ada Data
					        </span>
					    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>