<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script type="text/javascript">

$(document).ready(function(){

    data_divisi();
    data_divisi2();

    <?php
        if($msg == 1){
    ?>
        pesan_sukses();
    <?php
        }
    ?>

	$('#cek_all').click(function(){
		var tombol = $(this).is(':checked');
		if(tombol){
			$('.cek').prop('checked',true);
		}else{
			$('.cek').prop('checked',false);
		}
	});

	$('#cek_batal_all').click(function(){
		var tombol = $(this).is(':checked');
		if(tombol){
			$('.cek_batal').prop('checked',true);
		}else{
			$('.cek_batal').prop('checked',false);
		}
	});

	$('#koang').click(function(){
        get_popup_anggaran();
        ajax_anggaran();
    });

    $.greenify({
        url : '<?php echo base_url(); ?>dashboard/kode_perkiraan_c/get_kode_perkiraan',
        result : '#kode_perkiraan',
    });

    $("input[name='kriteria']").click(function(){
        var kriteria = $("input[name='kriteria']:checked").val();
        if(kriteria == "dep"){
            $('#pilih_subbag').hide();
            $('#pilih_bagian').show();    

        } else if(kriteria == "div"){
            $('#pilih_bagian').show();
            $('#pilih_subbag').show(); 
        } else {
            $('#pilih_subbag').hide();
            $('#pilih_bagian').hide();   
        }
    });

    $("input[name='jenis_lap']").click(function(){
        var jenis_lap = $("input[name='jenis_lap']:checked").val();
        if(jenis_lap == "koper"){
            $('#kode_perkiraan').val("");
            $('#kode_anggaran').val("");
            $('#head_koang').hide()
            $('#head_koper').show();  
        }  else {
            $('#kode_perkiraan').val("");
            $('#kode_anggaran').val("");
            $('#head_koper').hide();  
            $('#head_koang').show();  
        }
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

function data_divisi2(){
    var id_departemen = $('#departemen3').val();
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
            $('#divisi3').html($div);

        }
    });
}

function get_popup_anggaran(){
    var base_url = '<?php echo base_url(); ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input type="text" name="search_koang" id="search_koang" class="form-control" value="" placeholder="Cari Anggaran...">'+
                '    <div class="table-responsive">'+
                '            <table class="table table-hover" id="tes2">'+
                '                <thead>'+
                '                    <tr>'+
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
    var tahun = $('#tahun').val();
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/mutasi_kode_c/get_kd_anggaran',
        type : "POST",
        dataType : "json",
        data : {
            keyword : keyword,
            bagian : bagian,
            sub_bagian : sub_bagian,
            tahun : tahun,
        },
        success : function(result){
            var isine = '';
            var no = 0;
            $.each(result,function(i,res){
                no++;
                isine += '<tr>'+
                            '<td align="center">'+no+'</td>'+
                            '<td align="center"><a href="javascript:void(0);" onclick=get_anggaran_kode('+res.ID_ANGGARAN+');>'+res.KODE_ANGGARAN+'</a></td>'+
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

function get_anggaran_kode(id){

    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/mutasi_kode_c/get_anggaran_kode',
        data : {id:id},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){
            $('#kode_anggaran').val(res.KODE_ANGGARAN);
        }
    });


    $('#search_koang').val("");
    $('#popup_koang').css('display','none');
    $('#popup_koang').hide();
}

function batal_multiple(){
	var cek = $('.cek_batal').is(':checked');
	if(cek == true){
		$('#cek_batal_all').attr('checked',false);
		$('.cek_batal:checked').each(function(i){
			index = $(this).index('.cek_batal');
			$(this).attr('class','cek');
			$(this).attr('checked',false);
			$("#koper_all tbody tr").eq(index).detach().appendTo('#koper_ag tbody').find('td').eq(-1).remove();
		});
	}else{
		alert('Belum Dicentang');
	}
}

function hapus_multiple(){
	$('.cek:checked').each(function(i){
		index = $(this).index('.cek');
		$("#koper_ag tbody tr").eq(index).remove();
		$('#cek_all').attr('checked',false);
	});
}

function pindah_semua(){
	var cek = $('.cek').is(':checked');
	if(cek == true){
		$('#cek_all').attr('checked',false);
		$('.cek:checked').each(function(i){
			index = $(this).index('.cek');
			$(this).attr('class','cek_batal');
			$(this).attr('checked',false);
			$("#koper_ag tbody tr").eq(index).detach().appendTo('#koper_all tbody').append('<td class="td_jns_ag"><input type="hidden" name="hd_jns_ag" value="" id="hd_jns_ag" class="jns_ag"></td>');
		});
	}else{
		alert('Belum Dicentang');
	}
}

function add_to_tbl(){

	var kode_perkiraan = $('#kode_perkiraan').val();
	var kode_anggaran  = $('#kode_anggaran').val();

    if( (kode_anggaran == null || kode_anggaran == "") &&  (kode_perkiraan == null || kode_perkiraan == "") ){
        alert("Kode Anggaran atau Kode Perkiraan Tidak Boleh Kosong !");
    } else {

	$.ajax({
        url : '<?php echo base_url(); ?>dashboard/mutasi_kode_c/get_data',
        data : {
        	kode_perkiraan : kode_perkiraan,
        	kode_anggaran : kode_anggaran,
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
                    var vol_real = 0;
                    var sisa = 0;

                    if(data[x].JENIS_ANGGARAN == "Barang"){
                        total = data[x].TOTAL;  
                    } else {
                        total = data[x].TOTAL_PELAKSANAAN;  
                    }

                    if(data[x].JML_SPK > 0){
                       total_real = data[x].JML_SPK;  
                       vol_real = 1; 
                    } else {
                       total_real = parseFloat(data[x].JML_RAB + data[x].JML_DPBM);
                       vol_real   = parseFloat(data[x].VOLUME_DPBM + data[x].VOLUME_RAB);
                    }

                    sisa = parseFloat(total - total_real);

                    $isi+= "<tr>"+
                    		   "<td><input type='checkbox' name='cek[]' class='cek' value='"+data[x].ID_ANGGARAN+"'></td>"+
                               "<td> <input type='hidden' name='id_dep2[]' value='"+data[x].DEPARTEMEN+"'> "+data[x].KODE_ANGGARAN+"</td>"+
							   "<td> <input type='hidden' name='id_div2[]' value='"+data[x].DIVISI+"'>"+data[x].URAIAN+"</td>"+
							   "<td>"+data[x].SATUAN+"</td>"+
							   "<td> <input type='hidden' name='jenis_ag_ed[]' value='"+data[x].JENIS_ANGGARAN+"'> "+data[x].JENIS_ANGGARAN+"</td>"+
							   "<td>"+data[x].JUMLAH+"</td>"+
							   "<td>"+NumberToMoney(data[x].HARGA)+"</td>"+
							   "<td>"+vol_real+"</td>"+
							   "<td>"+NumberToMoney(total)+"</td>"+
							   "<td>"+NumberToMoney(total_real)+"</td>"+
							   "<td>"+NumberToMoney(sisa)+"</td>"+
                           "</tr>";
                }
            } else {
                $isi+= "<tr>"+
                               "<td colspan='11'> Tidak ada data </td>"+
                           "</tr>"; 
            }
            $('#isi_koper_ag').append($isi);
        }
    });

    }

}

function show_dep_div(obj){
    if($(obj).is(":checked")) {
        $('#head_dep_div').show();
        // $('.cek_batal').show();
    }else{
        $('#head_dep_div').hide();
        // $('.cek_batal').hide();
    }
}


function show_jenis_ag(obj){
    if($(obj).is(":checked")) {
        $('#head_jns_ag').show();
        // $('.cek_batal').show();
    }else{
        $('#head_jns_ag').hide();
        // $('.cek_batal').hide();
    }
}

function cek_validasi(){

    var a = false;
    if( $('#show_chkbox_jns').prop('checked') || $('#show_dep_div_chk').prop('checked') ) {
        a = true;
    } else {
        alert("Pindah Jenis Anggaran atau Pindah Departemen & Divisi harus Dicentang");
        a = false;
    }

    return a;
}

</script>

<style>
.hijau{ 
	background: #69c76c
}
.biru{ 
	background: #6982c7
}
.merah{ 
	background: #fa6588
}
.kuning{ 
	background: #f6f319
}
.orange{ 
	background: #fbce87
}
.putih{
	background: #fff;
}

.inner {
    border: 1px solid #A1D3EE;
    float: left;
    margin-right: 5px;
    padding: 5px;
    width: 42%;
}
.inner_b {
    float: left;
    width: 10%;
	padding-bottom: 5px;
}
.inner_b input{
	margin-bottom: 10px;
}
.scroll-1 {
    height: 228px;
    margin-top: 5px;
    overflow: auto;
    width: 100%;
}

.message{
	background-color:#00FF00;
	border-radius:3px; 
	padding:5px; 
	opacity:0.7;
	height: 20px;
	width: auto;
	text-align: center;
}
.msg-text{
	color: #191970;
}
#alert{
	/*position:fixed;
	top:20%; 
	left:92%; */
	z-index:9999;
	border-radius:3px;
	height: auto;
	width: auto;
	padding-top: 3px;
	padding-left: 5px;
	padding-bottom: 5px;
	padding-right: 5px;
	border: 1px solid #4a89dc;
}
#alert-txt{
	color:#000; 
	font-weight:bold;
}
#bungkus_kotak_anggaran{
	/*position:fixed;
	top:20%; 
	left:92%; */
	border-radius:3px;
	border: 1px solid #f9d05e;
	height: auto;
	width: auto;
	padding-top: 5px;
	padding-left: 5px;
	padding-bottom: 5px;
	padding-right: 5px;
}
.aktif{
	background: #146eb4;
	color :#FFF;
	padding: 8px 8px 8px 8px;
}

.tbl_link:hover{
	cursor: pointer;
}
</style>



<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body">
	    <!-- <div id="alert">
			<span id="alert-txt">
				<u>Cara Memutasi Kode Anggaran</u> :<br/>
				1. Pilih Bagian dan Sub Bagian<br/>
				2. Pilih Kode Anggaran yang ingin dimutasi, lalu klik "+Tambah"<br/>
				3. Data muncul di Tabel Anggaran<br/>
				4. Centang Kode Anggaran yang ingin di mutasi, lalu klik "Pindahkan"<br/>
				5. Data akan muncul di Tabel Mutasi<br/>
				6. Pilih Bagian dan Sub Bagian untuk Kode Anggaran yang akan dimutasi<br/>
				7. Centang Kode Anggaran yang ada pada Tabel Mutasi<br/> 
				8. Jika ingin memindahkan Jenis Anggaran atau Bagian & Sub Bagian, centang salah satu<br/>
				9. Jika ingin memindahkan Jenis Anggaran dan Bagian & Sub Bagian, centang semua<br/>
				10. Jika sudah tinggal klik tombol "Simpan"
			</span>
		</div>

		<div style="border-top: 1px dashed #ccc; margin-bottom: 14px; margin-top: 20px;"></div> -->

		<form class="form-horizontal" role="form">
            <div class="form-group">
                <label for="tahun" class="col-lg-3 control-label">Tahun Anggaran</label>
                <div class="col-lg-8">
                    <select id="tahun">
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

            <div class="form-group">
                <label for="disabledInput" class="col-lg-3 control-label">Kriteria</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample1" name="kriteria" checked="" value="">
                        <label for="radioExample1" style="margin-right: 15px; padding-left: 25px;">Semua Bagian</label>

                        <input type="radio" id="radioExample2" name="kriteria" value="dep">
                        <label for="radioExample2" style="margin-right: 15px; padding-left: 25px;">Bagian</label>

                        <input type="radio" id="radioExample3" name="kriteria" value="div">
                        <label for="radioExample3" style="margin-right: 15px; padding-left: 25px;">Sub Bagian</label>
                    </div>
                </div>
            </div>

            <div id="pilih_bagian" class="form-group admin-form" style="display:none;">
                <label for="inputPassword" class="col-lg-3 control-label" id="warna_bagian">Bagian</label>
                <div class="col-lg-4">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="departemen2" name="departemen" style="cursor:pointer;" onchange="data_divisi();" <?php echo $disable; ?>>
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

            <div id="pilih_subbag" class="form-group admin-form" style="display:none;">
                <label for="inputPassword" class="col-lg-3 control-label">Sub Bagian</label>
                <div class="col-lg-4">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="divisi2" name="divisi" style="cursor:pointer;" <?php echo $disable2; ?>>
                   
                                    </select>
                                    <i style="z-index:99;" class="arrow"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="disabledInput" class="col-lg-3 control-label">Jenis</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample55" name="jenis_lap" checked="" value="">
                        <label for="radioExample55" style="margin-right: 15px; padding-left: 25px;">Per Kode Anggaran</label>

                        <input type="radio" id="radioExample66" name="jenis_lap" value="koper">
                        <label for="radioExample66" style="margin-right: 15px; padding-left: 25px;">Per Kode Perkiraan</label>
                    </div>
                </div>
            </div>

            <div class="form-group" id="head_koang">
                <label for="inputPassword" class="col-lg-3 control-label">Kode Anggaran</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field">
                                    <input type="text" name="kode_anggaran" id="kode_anggaran" class="gui-input" value="">
                                </label>
                                <a class="button" id="koang">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group" id="head_koper" style="display:none;">
                <label for="inputPassword" class="col-lg-3 control-label">Kode Perkiraan</label>
                <div class="col-lg-4">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field">
                                    <input type="text" readonly required name="koper" id="kode_perkiraan" class="gui-input">
                                </label>
                                <a class="button" id="koper"> <i class="fa fa-search"></i></a>
                                <span class="help-block mt5" style="width: 150%;"><i class="fa fa-bell"></i> Kosongi field di atas untuk mencetak semua kode perkiraan</span>
                            </div>
                            <!-- end .smart-widget section -->
                        </div>
                    </div>
                </div>
            </div>

            </form>

            <br>
            <center>

	            <button onclick="add_to_tbl();" class="btn btn-primary btn-gradient dark" style="font-weight:bold;">
	                + Tambah
	            </button> 
	        </center>
	        <br>


	        <div class="panel">
	            <div class="panel-heading">
	                <span class="panel-title">
	                    <span class="glyphicons glyphicons-table"></span>Tabel Anggaran</span>
	            </div>
	            <div class="panel-body pn" style="max-width:100%; overflow-x: scroll; white-space: nowrap; ">
	                <table class="table table-bordered" style="width:100%;" id="koper_ag">
	                    <thead>
	                        <tr>
	                            <th>
									<input type="checkbox" name="cek_all" id="cek_all">
								</th>
								<th>Kode</th>
								<th>Uraian</th>
								<th>Satuan</th>
								<th>Jenis Anggaran</th>
								<th>Angg (Vol)</th>
								<th>Harga Satuan (Rp.)</th>
								<th>Real (Vol)</th>	
								<th>Tot RKAP (Rp.)</th>	
								<th>Realisasi (Rp.)</th>
								<th>Sisa RKAP (Rp.)</th>
			                </tr>
	                    </thead>
	                    <tbody id="isi_koper_ag">

	                    </tbody>
	                </table>
	            </div>
	        </div>

            <center>

	            <a  onclick="pindah_semua();" class="btn btn-primary btn-gradient dark" style="font-weight:bold;">
	               Pindahkan
	            </a > 
	            &nbsp;&nbsp;&nbsp;
	            <a  onclick="hapus_multiple();" class="btn btn-primary btn-gradient dark" style="font-weight:bold;">
	               Hapus
	            </a > 
	        </center>
	        <br>

            <form method="post" action="<?=base_url().$post_url;?>" onsubmit="return cek_validasi();">

	        <div class="panel">
	            <div class="panel-heading">
	                <span class="panel-title">
	                    <span class="glyphicons glyphicons-table"></span>Tabel Mutasi</span>
	            </div>
	            <div class="panel-body pn" style="max-width:100%; overflow-x: scroll; white-space: nowrap; ">
	                <table class="table table-bordered" style="width:100%;" id="koper_all">
	                    <thead>
	                        <tr>
								<th>
									<input type="checkbox" name="cek_batal_all" id="cek_batal_all">
								</th>
								<th>Kode</th>
								<th>Uraian</th>
								<th>Satuan</th>
								<th>Jenis Anggaran</th>
								<th>Angg (Vol)</th>
								<th>Harga Satuan (Rp.)</th>
								<th>Real (Vol)</th>	
								<th>Tot RKAP (Rp.)</th>	
								<th>Realisasi (Rp.)</th>
								<th>Sisa RKAP (Rp.)</th>
								<th>Pindah Jenis Anggaran</th>
							</tr>
	                    </thead>
	                    <tbody id="isi_koper_all">

	                    </tbody>
	                </table>
	            </div>
	        </div>

	        <center>
	            <a onclick="batal_multiple();" id="add_kode" class="btn btn-primary btn-gradient dark" style="font-weight:bold;">
	               Batal
	            </a> 
	        </center>

            <br/>

            <div style="border-top: 1px dashed #ccc; margin-bottom: 14px; margin-top: 20px;"></div>

            <br>

            <div class="checkbox-custom fill checkbox-primary mb5">
                <input onclick="show_jenis_ag(this);" type="checkbox" id="show_chkbox_jns" name="show_chkbox_jns" value="yes">
                <label for="show_chkbox_jns"> Pindah Jenis Anggaran </label>
            </div>

            <div class="radio-custom radio-primary mb5" style="margin-top: 15px; display:none;" id="head_jns_ag">
                <input type="radio" id="radio_pindah_jenis1" name="jns_ag_ed" checked="" value="Barang">
                <label for="radio_pindah_jenis1" style="margin-right: 15px; padding-left: 25px;">Barang</label>

                <input type="radio" id="radio_pindah_jenis2" name="jns_ag_ed" value="Pekerjaan">
                <label for="radio_pindah_jenis2" style="margin-right: 15px; padding-left: 25px;">Pekerjaan</label>

                <input type="radio" id="radio_pindah_jenis3" name="jns_ag_ed" value="Pelatihan">
                <label for="radio_pindah_jenis3" style="margin-right: 15px; padding-left: 25px;">Pelatihan</label>
            </div>

            <br/>

            <div class="checkbox-custom fill checkbox-primary mb5">
                <input onclick="show_dep_div(this);" type="checkbox" id="show_dep_div_chk" name="show_dep_div_chk" value="yes">
                <label for="show_dep_div_chk"> Pindah Departemen & Divisi </label>
            </div>

            <br>

            <div id="head_dep_div" style="display:none;">

            <label for="inputPassword" class="col-lg-2 control-label">Bagian</label>
            <div class="col-lg-4" style="margin-top: -8px;">
                <div class="admin-form">
                    <div>
                        <div class="smart-widget sm-right smr-50">
                            <label class="field select">
                                <select id="departemen3" name="departemen_ed" style="cursor:pointer;" onchange="data_divisi2();">
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

            <br> <br> <br>            

            <label for="inputPassword" class="col-lg-2 control-label">Sub Bagian</label>
            <div class="col-lg-4" style="margin-top: -8px;">
                <div class="admin-form">
                    <div>
                        <div class="smart-widget sm-right smr-50">
                            <label class="field select">
                                <select id="divisi3" name="divisi_ed" style="cursor:pointer;">
               
                                </select>
                                <i style="z-index:99;" class="arrow"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            </div>

            <div style="border-top: 1px dashed #ccc; margin-bottom: 14px; margin-top: 45px;"></div>
            
            <center>
                <input type="submit" name="simpan_mutasi" id="simpan_mutasi" value="SIMPAN" class="btn btn-primary btn-gradient dark" style="font-weight:bold;" />
            </center>

    </div>
</div>

</form>