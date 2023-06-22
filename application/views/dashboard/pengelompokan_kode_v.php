<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script type="text/javascript">

$(document).ready(function(){

    
    data_divisi();
    get_koper_lama();

	$.greenify({
        url : '<?php echo base_url(); ?>dashboard/kode_perkiraan_c/get_kode_perkiraan',
        result : '#kode_perkiraan',
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

function get_koper_lama(){
	$.ajax({
        url : '<?php echo base_url(); ?>dashboard/pengelompokan_kode_c/get_koper_lama',
        data : {
        	id_divisi:$('#divisi2').val(),
        	tahun:$('#tahun').val(),
        },
        type : "POST",
        dataType : "json",
        async : false,
        success : function(koper_lama){
            $div = "<option value=''> -- Pilih Kode Perkiraan </option>";
            for(var i=0; i<koper_lama.length; i++){
                $div += "<option value='"+koper_lama[i].KODE_PERKIRAAN+"'>"+koper_lama[i].KODE_PERKIRAAN+"</option>";
            }

            $('#koper_lama').html($div);

        }
    });
}

function get_anggaran_by_koper_lama(){
	$.ajax({
        url : '<?php echo base_url(); ?>dashboard/pengelompokan_kode_c/get_anggaran_by_koper_lama',
        data : {
        	id_divisi:$('#divisi2').val(),
        	tahun:$('#tahun').val(),
        	koper_lama:$('#koper_lama').val(),
        },
        type : "POST",
        dataType : "json",
        async : false,
        success : function(data){
            
                    $isi = "";
                    var i = 0;
                    if(data.length > 0) {
                        for(var x=0;x<data.length;x++){
                            i++;
                            var total = 0;

                            if(data[x].JENIS_ANGGARAN == "Barang"){
                                total = data[x].TOTAL;  
                            } else {
                                total = data[x].TOTAL_PELAKSANAAN;  
                            }
                            $isi+= "<tr class='tr_lama' id='tr_lama_"+i+"' onclick='get_checked_lama("+i+");' style='cursor:pointer;'>"+
                                       "<td>  <input type='hidden' name='kode_ag_baru[]' value='"+data[x].KODE_ANGGARAN+"' /> <input style='display:none;' id='checkbox_lama_"+i+"' type='checkbox' value='"+data[x].KODE_ANGGARAN+"' name='check_lama[]' class='check_lama'/>"+data[x].KODE_ANGGARAN+"</td>"+
                                       "<td>"+data[x].URAIAN+"</td>"+
                                       "<td>"+NumberToMoney(total)+"</td>"+
                                   "</tr>";
                            //text += '<tr><td> # '+data[x].JENIS+' - '+data[x].NAMA+' - '+data[x].TANGGAL+' - '+data[x].JAM+' - '+data[x].MODUL+' - '+data[x].LINK+' - '+data[x].OBJECT+'</td></tr>';              
                        }
                    } else {
                        $isi+= "<tr>"+
                                       "<td colspan='3'> Tidak ada data </td>"+
                                   "</tr>"; 
                    }
                    $('#tbl_koper_lama tbody').html($isi);

        }
    });
}

function get_checked_lama(i){
	if ( $("#checkbox_lama_"+i).is(':checked') == true ) {
            document.getElementById("checkbox_lama_"+i).checked = false;
            document.getElementById("tr_lama_"+i).style.background = "#FFF";
            document.getElementById("tr_lama_"+i).style.color = "#666";
        }
        else {
            document.getElementById("checkbox_lama_"+i).checked = true;
            document.getElementById("tr_lama_"+i).style.background = "#4A89DC";
            document.getElementById("tr_lama_"+i).style.color = "#FFF";
        }

	
}

function pindah(){
	var cek = $('.check_lama').is(':checked');
	if(cek == true){
		$('#cek_all').attr('checked',false);
		$('.check_lama:checked').each(function(i){
			index = $(this).index('.check_lama');
			$(this).attr('class','cek_batal');
			$(this).attr('checked',false);
			$("#tbl_koper_lama tbody tr").eq(index).detach().appendTo('#tbl_koper_baru tbody').append('');

            $(".tr_lama").css("background-color", "white");
            $(".tr_lama").css("color", "#666");
		});
	}else{
		alert('Pilih dahulu Kode Anggaran yang akan di pindahkan');
	}
}

function batal_multiple(){
	var cek = $('.cek_batal').is(':checked');
	if(cek == true){
		//$('#cek_batal_all').attr('checked',false);
		$('.cek_batal:checked').each(function(i){
			index = $(this).index('.cek_batal');
			$(this).attr('class','check_lama');
			$(this).attr('checked',false);
			$("#tbl_koper_baru tbody tr").eq(index).detach().appendTo('#tbl_koper_lama tbody').append('');
			$(".tr_lama").css("background-color", "white");
			$(".tr_lama").css("color", "#666");
		});
	}else{
		alert('Pilih dahulu Kode Anggaran yang akan di pindahkan');
	}
}

</script>

<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body form-horizontal">

        
            <div class="form-group">
                <label for="tahun" class="col-lg-3 control-label">Tahun Anggaran</label>
                <div class="col-lg-8">
                    <select id="tahun" name="tahun" onchange="get_koper_lama();">
                        <?php
                            $thn = date('Y');
                            for($i=2015; $i<=$thn+2; $i++) {
                                if ($i==$thn){
                                    echo"<option selected='selected' value=".$i."> ".$i." </option>";
                                }else{
                                    echo"<option value=".$i."> ".$i." </option>";
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group admin-form">
                <label for="inputPassword" class="col-lg-3 control-label" id="warna_bagian">Bagian</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="departemen2" name="departemen" style="cursor:pointer;" onchange="data_divisi(); get_koper_lama();" <?php echo $disable; ?>>
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
                                    <select id="divisi2" name="divisi" style="cursor:pointer;" onchange = "get_koper_lama();" <?php echo $disable2; ?>>
                   
                                    </select>
                                    <i style="z-index:99;" class="arrow"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

            <hr>

            <div class="container">     
			  <div class="row">
			    <div class="col-md-5 col-lg-5">
				    
			    	<div class="form-group admin-form">
		                <label for="inputPassword" class="col-lg-3 control-label">Kode Perkiraan</label>
		                <div class="col-lg-9">
		                    <div class="admin-form">
		                        <div>
		                            <div class="smart-widget sm-right smr-50">
		                                <label class="field select">
		                                    <select id="koper_lama" name="koper_lama" style="cursor:pointer;" onchange="get_anggaran_by_koper_lama();">
		                                        <option value="">-- Pilih Kode Perkiraan</option>
		                                    </select>
		                                    <i style="z-index:99;" class="arrow"></i>
		                                </label>
		                            </div>
		                        </div>
		                    </div>
		                </div>
	            	</div>

			    	<div class="panel">	
			            <div class="panel-body pn">
			                <table class="table table-bordered" id="tbl_koper_lama">
			                    <thead>
			                        <tr>
			                            <th style="vertical-align: middle;">Kode Anggaran</th>
			                            <th style="vertical-align: middle;">Uraian</th>
			                            <th style="vertical-align: middle;">Total Biaya</th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                       
			                    </tbody>
			                </table>
			            </div>
			        </div>

				</div>

				<div class="col-md-2 col-lg-1" style="text-align: center;">	
					<a href="javascript:;" onclick="pindah();" class="btn btn-info btn-gradient dark" style="font-weight:bold;"> <i class="fa fa-arrow-right"></i> </a>
					<br>
					<a href="javascript:;" onclick="batal_multiple();" class="btn btn-info btn-gradient dark" style="font-weight:bold; margin-top: 10px;"> <i class="fa fa-arrow-left"></i> </a>
				</div>

                <form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>">

				<div class="col-md-5 col-lg-5">	

					<div class="form-group admin-form ">
		                <label for="kode_perkiraan" class="col-lg-3 control-label">Kode Perkiraan</label>
		                <div class="col-lg-9">
		                    <div class="admin-form">
		                        <div>
		                            <div class="smart-widget sm-right smr-50">
		                                <label class="field">
		                                    <input type="text" name="kode_perkiraan" id="kode_perkiraan" class="gui-input" value="" />
		                                </label>
		                                <a class="button" id="koper">
		                                    <i class="fa fa-search"></i>
		                                </a>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>	

					<div class="panel">
			            <div class="panel-body pn">
			                <table class="table table-bordered" id="tbl_koper_baru">
			                    <thead>
			                        <tr>
			                            <th style="vertical-align: middle;">Kode Anggaran</th>
			                            <th style="vertical-align: middle;">Uraian</th>
			                            <th style="vertical-align: middle;">Total Biaya</th>
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

                <input id="simpan" type="submit" name="simpan" value="SIMPAN" class="btn btn-primary btn-gradient dark" style="font-weight:bold;" />
                &nbsp;
                <input id="reset" type="reset" value="BATAL" class="btn btn-default btn-gradient dark" style="font-weight:bold;" />
            </center>
    </div>

    </form>
</div>
