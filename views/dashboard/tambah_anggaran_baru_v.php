<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script>
$(document).ready(function(){
	data_divisi();
	get_kode_anggaran();

	$('#empty_koper').hide();
	
	$.greenify({
        url : '<?php echo base_url(); ?>dashboard/kode_perkiraan_c/get_kode_perkiraan',
        result : '#kode_perkiraan',
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
</script>
<!-- TAMBAH BARU -->
<div class="panel">
    <form class="form-horizontal" role="form" action="" method="post" id="form_tambah_baru">
        <div class="panel-body">
            <div class="form-group admin-form">
                <label for="inputPassword" class="col-lg-3 control-label" id="warna_bagian">Bagian</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="departemen2" name="departemen" style="cursor:pointer;" onchange="get_kode_anggaran(); data_divisi();">
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
                                    <select id="divisi2" name="divisi" style="cursor:pointer;">
                   
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

            <hr/>

            <div class="form-group">
                <label for="kode_anggaran" class="col-lg-3 control-label">Kode Anggaran</label>
                <div class="col-lg-3">
                    <input type="text" name="kode_anggaran" id="kode_anggaran" class="form-control" value="" readonly />
                </div>
            </div>

            <div class="form-group">
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

        </div>
    </form>
</div>