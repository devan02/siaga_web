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

    $("input[name='kriteria']").click(function(){
        var kriteria = $("input[name='kriteria']:checked").val();
        if(kriteria == "dep"){
            $('#head_bagian').show();
            $('#head_sub_bagian').hide();        

        } else if(kriteria == "div"){
            $('#head_bagian').show();
            $('#head_sub_bagian').show();

        } 
    });

    $('#golongan_cari').click(function(){
        get_popup_golongan();
        ajax_golongan();
    });

});

function get_popup_golongan(){
    var base_url = '<?php echo base_url(); ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input type="text" name="search_koang" id="search_koang" class="form-control" value="" placeholder="Cari Golongan...">'+
                '    <div class="table-responsive">'+
                '            <table class="table table-hover" id="tes2">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>NO</th>'+
                '                        <th style="white-space:nowrap; text-align:center;">GOLONGAN</th>'+
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

function ajax_golongan(){
    var keyword = $('#search_koang').val();
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/input_biaya_tenaga_tkk_c/get_golongan',
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
                isine += "<tr>"+
                            "<td align='center'>"+res.NO+"</td>"+
                            "<td align='left'>"+
                            "<a href='javascript:void(0);' onclick=get_golongan_detail('"+res.NO+"');>"+res.INDUK+"</a>"+
                            "</td>"+
                        "</tr>";
            });
            $('#tes2 tbody').html(isine); 
            $('#search_koang').off('keyup').keyup(function(){
                ajax_golongan();
            });
        }
    });
}

function get_golongan_detail(no){

	$.ajax({
        url : '<?php echo base_url(); ?>dashboard/input_biaya_tenaga_tkk_c/get_golongan_by_no',
        type : "POST",
        dataType : "json",
        data : {
            no : no,
        },
        success : function(result){
	       	$('#golongan').val(result.INDUK);
			$('#no_gol').val(result.NO);

			$('#search_koang').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide();
        }
    });
	
}

</script>

<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body">
    <form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>">
        
        <div class="form-group">
            <label for="divisi" class="col-lg-3 control-label" >Periode</label>
            <div class="col-lg-8">
                <?PHP if($periode == 2){ ?> 
                <select class="multi-sel"  name="periode">
                    <option value="1">RKAP</option>
                    <option selected value="2">REVISI RKAP</option>
                </select>
                <?PHP } else { ?>
                <select class="multi-sel"  name="periode">
                    <option selected value="1">RKAP</option>
                    <option value="2">REVISI RKAP</option>
                </select>
                <?PHP } ?>
                
            </div>
        </div> 

        <div class="form-group"> 
            <label for="tahun" class="col-lg-3 control-label">Tahun Anggaran</label>
            <div class="col-lg-8">
                <select id="tahun" name="tahun">
                    <?php
                        $thn = date('Y');
                        if($tahun != ""){
                        $thn = $tahun;
                        }

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
            <label for="inputPassword" class="col-lg-3 control-label">Golongan</label>
            <div class="col-lg-5">
                <div class="admin-form">
                    <div>
                        <div class="smart-widget sm-right smr-50">
                            <label class="field">
                                <input required type="text" name="golongan" id="golongan" class="gui-input" value="<?=$gol;?>">
                                <input type="hidden" name="no_gol" id="no_gol" class="gui-input" value="<?=$no_gol;?>">
                            </label>
                            <a class="button" id="golongan_cari">
                                <i class="fa fa-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <div class="form-group">
	        <label for="inputPassword" class="col-lg-3 control-label"></label>
	        <div class="col-lg-3">
	            <div class="admin-form">
	                <input type="submit" id="cari_ag" class="btn btn-info btn-gradient dark" style="font-weight:bold;" value="Mulai Pencarian" name="cari" />     
	            </div>
	        </div>
	    </div> 

	    <?PHP if($dt != "" || $dt != null){?>
	    <div style="border-top: 1px dashed #ccc; margin-bottom: 14px; margin-top: 20px;"></div>

        <input type="hidden" name="no_gol_ed" value="<?=$no_gol;?>"/>

	    <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">
                    <span class="glyphicons glyphicons-table"></span><?=$no_gol.". ".$gol;?></span>
            </div>
            <div class="panel-body pn" style="max-width:100%; overflow-x: scroll; white-space: nowrap; ">
                <table class="table table-bordered" style="width:100%;" id="tes3">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle; text-align:center;">Judul</th>
                            <th style="vertical-align: middle; text-align:center;">Jumlah <br> Tenaga</th>
                            <th style="vertical-align: middle; text-align:center;">Januari</th>
                            <th style="vertical-align: middle; text-align:center;">Februari</th>
                            <th style="vertical-align: middle; text-align:center;">Maret</th>
                            <th style="vertical-align: middle; text-align:center;">April</th>
                            <th style="vertical-align: middle; text-align:center;">Mei</th>
                            <th style="vertical-align: middle; text-align:center;">Juni</th>
                            <th style="vertical-align: middle; text-align:center;">Juli</th>
                            <th style="vertical-align: middle; text-align:center;">Agustus</th>
                            <th style="vertical-align: middle; text-align:center;">September</th>
                            <th style="vertical-align: middle; text-align:center;">Oktober</th>
                            <th style="vertical-align: middle; text-align:center;">November</th>
                            <th style="vertical-align: middle; text-align:center;">Desember</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?PHP 
                    $old_judul = "";
                    $i = 0;
                    foreach ($dt as $key => $row) {
                    	$i++;
                    	$judul1 = TRIM($row->INDUK);

                    	if ($old_judul != $judul1) {
		                    $old_judul  = $judul1 ;
		                    echo "<tr>";
		                    echo "<td colspan='14' class='isi_table'><b>".$row->INDUK."</b></td>" ;
		                    echo "</tr>";
	                	}
	                ?>

	                <tr>
	                    <td style="text-align:left;"><?=$i.". ".$row->JUDUL;?> <input type="hidden" name="id_gol[]" value="<?=$row->ID;?>" /> </td>
	                    <td style="text-align:center;"> <input onkeyup="FormatCurrency(this);" style="text-align:center; width:60px;"  type="text" name="JML[]" value="<?=number_format($row->JML);?>" /> </td>
	                    <td style="text-align:center;"> <input onkeyup="FormatCurrency(this);" style="text-align:center; width:100px;" type="text" name="JAN[]" value="<?=number_format($row->JAN);?>" /> </td>
	                    <td style="text-align:center;"> <input onkeyup="FormatCurrency(this);" style="text-align:center; width:100px;" type="text" name="FEB[]" value="<?=number_format($row->FEB);?>" /> </td>
	                    <td style="text-align:center;"> <input onkeyup="FormatCurrency(this);" style="text-align:center; width:100px;" type="text" name="MAR[]" value="<?=number_format($row->MAR);?>" /> </td>
	                    <td style="text-align:center;"> <input onkeyup="FormatCurrency(this);" style="text-align:center; width:100px;" type="text" name="APR[]" value="<?=number_format($row->APR);?>" /> </td>
	                    <td style="text-align:center;"> <input onkeyup="FormatCurrency(this);" style="text-align:center; width:100px;" type="text" name="MEI[]" value="<?=number_format($row->MEI);?>" /> </td>
	                    <td style="text-align:center;"> <input onkeyup="FormatCurrency(this);" style="text-align:center; width:100px;" type="text" name="JUN[]" value="<?=number_format($row->JUN);?>" /> </td>
	                    <td style="text-align:center;"> <input onkeyup="FormatCurrency(this);" style="text-align:center; width:100px;" type="text" name="JUL[]" value="<?=number_format($row->JUL);?>" /> </td>
	                    <td style="text-align:center;"> <input onkeyup="FormatCurrency(this);" style="text-align:center; width:100px;" type="text" name="AGU[]" value="<?=number_format($row->AGU);?>" /> </td>
	                    <td style="text-align:center;"> <input onkeyup="FormatCurrency(this);" style="text-align:center; width:100px;" type="text" name="SEP[]" value="<?=number_format($row->SEP);?>" /> </td>
	                    <td style="text-align:center;"> <input onkeyup="FormatCurrency(this);" style="text-align:center; width:100px;" type="text" name="OKT[]" value="<?=number_format($row->OKT);?>" /> </td>
	                    <td style="text-align:center;"> <input onkeyup="FormatCurrency(this);" style="text-align:center; width:100px;" type="text" name="NOP[]" value="<?=number_format($row->NOP);?>" /> </td>
	                    <td style="text-align:center;"> <input onkeyup="FormatCurrency(this);" style="text-align:center; width:100px;" type="text" name="DES[]" value="<?=number_format($row->DES);?>" /> </td>
	                </tr>

	                <?PHP } ?>
                    </tbody>
                </table>
            </div>
        </div>

	    <?PHP } ?>

    
    </div>

    <?PHP if($dt != "" || $dt != null){?>
    <div class="panel-footer">
        <center>
            <input type="submit" name="simpan" class="btn btn-primary btn-gradient dark" style="font-weight:bold;" value="Simpan">
            &nbsp;&nbsp;&nbsp;
            <button onclick="window.location = '<?=base_url();?>dashboard/input_biaya_tenaga_c'; " class="btn btn-default btn-gradient dark" >
                Batal
            </button> 
        </center>
    </div>
    <?PHP } ?>
    </form>
</div>