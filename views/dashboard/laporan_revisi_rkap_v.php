<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script>
var ajax = "";
$(document).ready(function(){
    data_divisi();
    $('.view_koper').hide();
    $('#view_bagian').hide();
    $('#view_sub_bagian').hide();

    var jenis_laporan = $("input[name='jenis_laporan']:checked").val();
    if(jenis_laporan == "rinci"){
        $('.view_koper').hide();        
    }else{
        $('.view_koper').show();
    }

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

    $("input[name='jenis_laporan']").click(function(){
        var jenis_laporan = $("input[name='jenis_laporan']:checked").val();
        if(jenis_laporan == "rinci"){
            $('.view_koper').hide();        
        }else{
            $('.view_koper').show();
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

function tabel_koper(){
    var base_url = "<?php echo base_url(); ?>";
    var $isi = '<div id="popup_koper">'+
                    '<div class="window_koper">'+
                    '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok"></a>'+
                    '    <div class="panel-body">'+
                    '    <input type="text" name="search_koper" id="search_koper" class="form-control" value="" placeholder="Cari perkiraan...">'+
                    '    <br/>'+
                    '    <div class="table-responsive">'+
                    '       <div class="scroll_popup-y">'+
                    '            <table class="table table-hover table-bordered" id="tes">'+
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
            $('#nama_perkiraan').val(row['NAMA_PERKIRAAN']);

            $('#popup_koper').css('display','none');
            $('#popup_koper').hide();
        }
    });
}
</script>
<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <form class="form-horizontal" role="form" action="<?php echo $url; ?>" method="post" target="_blank">
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
                                    <select id="departemen2" name="departemen" style="cursor:pointer;" onchange="data_divisi();" onclick="data_divisi();" <?php echo $disable; ?> >
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
                <label for="disabledInput" class="col-lg-3 control-label">Jenis Laporan</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample4" name="jenis_laporan" checked="checked" value="rinci">
                        <label for="radioExample4" style="margin-right: 15px; padding-left: 25px;">Per Rinci Uraian</label>

                        <input type="radio" id="radioExample5" name="jenis_laporan" value="per_koper">
                        <label for="radioExample5" style="margin-right: 15px; padding-left: 25px;">Kode Perkiraan</label>
                    </div>
                </div>
            </div>

            <div class="form-group view_koper">
                <label class="col-lg-3 control-label">Kode Perkiraan</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field">
                                    <input type="text" readonly required name="kode_perkiraan" id="kode_perkiraan" class="gui-input">
                                </label>
                                <a class="button" id="koper">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            
            <div class="form-group view_koper">
                <label for="inputPassword" class="col-lg-3 control-label">&nbsp;</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" value="" name="nama_perkiraan" id="nama_perkiraan" readonly="readonly">
                </div>
            </div>

        </div>

        <div class="panel-footer">
            <center>
                <input type="submit" name="pdf" id="pdf" value="Cetak PDF" class="btn btn-default btn-gradient dark" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/pdf.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;">
                &nbsp;&nbsp;
                <input type="submit" name="excel" id="excel" value="Cetak Excel" class="btn btn-default btn-gradient dark" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/xls.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;">
                &nbsp;&nbsp;
                <input type="submit" name="pdf_terjadwal" id="pdf_terjadwal" value="Cetak Terjadwal PDF" class="btn btn-default btn-gradient dark" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/pdf.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;">
                &nbsp;&nbsp;
                <input type="submit" name="excel_terjadwal" id="excel_terjadwal" value="Cetak Terjadwal Excel" class="btn btn-default btn-gradient dark" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/xls.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;">
            </center>
        </div>

    </form>
</div>

<script>
$(document).ready(function(){
    $('#koper').click(function(){
        tabel_koper();
        get_data_koper();
    });
});
</script>