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
        }
    ?>

	$('#koper').click(function(){
        tabel_koper();
        get_data_koper();
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

    if(ajax){
        ajax.abort();
    }

    ajax = $.ajax({
        url : '<?php echo base_url(); ?>dashboard/input_pendapatan_non_air_c/get_kode_perkiraan',
        type : "GET",
        dataType : "json",
        data : {
            keyword : koper
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
            $('#nama_perkiraan').val(row['NAMA_PERKIRAAN']);

            $('#popup_koper').css('display','none');
            $('#popup_koper').hide();
        }
    });
}

function loading(){
    $('#popup_load').css('display','block');
    $('#popup_load').show(); 
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
    <form class="form-horizontal" role="form" action="<?php echo $url; ?>" method="post">
    	<div class="panel-body">
           	<div class="form-group">
                <label for="tahun" class="col-lg-3 control-label">Tahun</label>
                <div class="col-lg-8">
                    <select id="tahun" name="tahun">
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
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword" class="col-lg-3 control-label">Periode</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="periode_rkap" name="periode" value="1" checked="checked">
                        <label for="periode_rkap" style="margin-right: 15px; padding-left: 25px;">RKAP</label>

                        <input type="radio" id="periode_revisi" name="periode" value="2">
                        <label for="periode_revisi" style="margin-right: 15px; padding-left: 25px;">REVISI RKAP</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword" class="col-lg-3 control-label">Jenis</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="non_air" name="jenis" value="PENDAPATAN NON AIR">
                        <label for="non_air" style="margin-right: 15px; padding-left: 25px;">Pendapatan Non Air</label>

                        <input type="radio" id="kemitraan" name="jenis" value="PENDAPATAN KEMITRAAN">
                        <label for="kemitraan" style="margin-right: 15px; padding-left: 25px;">Pendapatan Kemitraan</label>

                        <input type="radio" id="air_limbah" name="jenis" value="PENDAPATAN AIR LIMBAH">
                        <label for="air_limbah" style="margin-right: 15px; padding-left: 25px;">Pendapatan Air Limbah</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword" class="col-lg-3 control-label">Kode Perkiraan</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div id="basic-modal" class="smart-widget sm-right smr-50">
                                <label class="field">
                                    <input name="kode_perkiraan" id="kode_perkiraan" class="gui-input" type="text" required="" value="" readonly="">
                                </label>
                                <a class="button" id="koper">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword" class="col-lg-3 control-label">Nama Perkiraan</label>
                <div class="col-lg-6">
                    <div class="admin-form">
                        <div>
                            <div id="basic-modal" class="smart-widget sm-right smr-51">
                                <label class="field">
                                    <input name="nama_perkiraan" id="nama_perkiraan" class="gui-input" type="text" required="" value="">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr/>

            <div class="row">
            	<div class="col-sm-6">
                    <div class="form-group">
                        <label for="januari" class="col-lg-3 control-label">JANUARI</label>
                        <div class="col-lg-8">
                            <input type="text" name="januari" id="januari" class="form-control nominal_bulan" value="" style="text-align:right;" onkeyup="FormatCurrency(this);">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="februari" class="col-lg-3 control-label">FEBRUARI</label>
                        <div class="col-lg-8">
                            <input type="text" name="februari" id="februari" class="form-control nominal_bulan" value="" style="text-align:right;" onkeyup="FormatCurrency(this);">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="maret" class="col-lg-3 control-label">MARET</label>
                        <div class="col-lg-8">
                            <input type="text" name="maret" id="maret" class="form-control nominal_bulan" value="" style="text-align:right;" onkeyup="FormatCurrency(this);">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="april" class="col-lg-3 control-label">APRIL</label>
                        <div class="col-lg-8">
                            <input type="text" name="april" id="april" class="form-control nominal_bulan" value="" style="text-align:right;" onkeyup="FormatCurrency(this);">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mei" class="col-lg-3 control-label">MEI</label>
                        <div class="col-lg-8">
                            <input type="text" name="mei" id="mei" class="form-control nominal_bulan" value="" style="text-align:right;" onkeyup="FormatCurrency(this);">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="juni" class="col-lg-3 control-label">JUNI</label>
                        <div class="col-lg-8">
                            <input type="text" name="juni" id="juni" class="form-control nominal_bulan" value="" style="text-align:right;" onkeyup="FormatCurrency(this);">
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="juli" class="col-lg-3 control-label">JULI</label>
                        <div class="col-lg-8">
                            <input type="text" name="juli" id="juli" class="form-control nominal_bulan" value="" style="text-align:right;" onkeyup="FormatCurrency(this);">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="agustus" class="col-lg-3 control-label">AGUSTUS</label>
                        <div class="col-lg-8">
                            <input type="text" name="agustus" id="agustus" class="form-control nominal_bulan" value="" style="text-align:right;" onkeyup="FormatCurrency(this);">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="september" class="col-lg-3 control-label">SEPTEMBER</label>
                        <div class="col-lg-8">
                            <input type="text" name="september" id="september" class="form-control nominal_bulan" value="" style="text-align:right;" onkeyup="FormatCurrency(this);">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="oktober" class="col-lg-3 control-label">OKTOBER</label>
                        <div class="col-lg-8">
                            <input type="text" name="oktober" id="oktober" class="form-control nominal_bulan" value="" style="text-align:right;" onkeyup="FormatCurrency(this);">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="november" class="col-lg-3 control-label">NOVEMBER</label>
                        <div class="col-lg-8">
                            <input type="text" name="november" id="november" class="form-control nominal_bulan" value="" style="text-align:right;" onkeyup="FormatCurrency(this);">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="desember" class="col-lg-3 control-label">DESEMBER</label>
                        <div class="col-lg-8">
                            <input type="text" name="desember" id="desember" class="form-control nominal_bulan" value="" style="text-align:right;" onkeyup="FormatCurrency(this);">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer admin-form">
	           <center>
                    <input type="submit" class="button btn-primary" name="simpan" value="SIMPAN" onclick="loading();">
	                &nbsp;&nbsp;&nbsp;
                    <input type="reset" class="button btn-danger" name="bata" value="BATAL">
	           </center> 
	        </div>
        </div>
    </form>
</div>