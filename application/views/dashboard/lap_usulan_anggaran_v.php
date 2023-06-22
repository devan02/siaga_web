<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script type="text/javascript">
var ajax = "";
$(document).ready(function(){
    data_divisi();

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
            $('#head_koper').show();  
        }  else {
            $('#kode_perkiraan').val("");
            $('#head_koper').hide();  
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

function get_koper_click(id_koper){
    $.ajax({
        url : "<?php echo base_url(); ?>dashboard/kode_perkiraan_c/get_koper_id",
        data : {id_koper:id_koper},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(row){
            $('#kode_perkiraan').val(row.KODE_PERKIRAAN);

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
    <div class="panel-body">

        <form class="form-horizontal" role="form" method="post" target="_blank" action="<?=base_url().$post_url;?>">
            <div class="form-group">
                <label for="tahun" class="col-lg-3 control-label">Tahun Anggaran</label>
                <div class="col-lg-8">
                    <select id="tahun" name="tahun">
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
                        <input type="radio" id="radioExample1" name="kriteria" value="">
                        <label for="radioExample1" style="margin-right: 15px; padding-left: 25px;">Semua Bagian</label>

                        <input type="radio" id="radioExample2" name="kriteria" value="dep">
                        <label for="radioExample2" style="margin-right: 15px; padding-left: 25px;">Bagian</label>

                        <input type="radio" id="radioExample3" name="kriteria" value="div" checked="checked">
                        <label for="radioExample3" style="margin-right: 15px; padding-left: 25px;">Sub Bagian</label>
                    </div>
                </div>
            </div>

            <div id="pilih_bagian" class="form-group admin-form" style="display:none;">
                <label for="inputPassword" class="col-lg-3 control-label" id="warna_bagian">Bagian</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="departemen2" name="departemen" style="cursor:pointer;" onchange="data_divisi(); grid_seleksi_cari();" <?php echo $disable; ?> >
                                        <!-- <option value="0"> -- Pilih Bagian --</option> -->
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
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="divisi2" name="divisi" style="cursor:pointer;" onchange = "grid_seleksi_cari();" <?php echo $disable2; ?> >
                   
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
                        <input type="radio" id="radioExample55" name="jenis_lap" checked="" value="">
                        <label for="radioExample55" style="margin-right: 15px; padding-left: 25px;">Semua</label>

                        <input type="radio" id="radioExample66" name="jenis_lap" value="koper">
                        <label for="radioExample66" style="margin-right: 15px; padding-left: 25px;">Per Kode Perkiraan</label>
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
            
    </div>

    <div class="panel-footer">
        <center>
            <input type="submit" value="Cetak Excel" name="excel" class="btn btn-default btn-gradient dark" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/xls.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;" />        
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
            <input type="submit" value="Cetak PDF" name="pdf" class="btn btn-default btn-gradient dark" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/pdf.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;" />                
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
                <table class="table table-hover table-bordered" id="tes_koper">
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

<script>
$(document).ready(function(){
    $('#koper').click(function(){
        $('#popup_koper').css('display','block');
        $('#popup_koper').show();
    });
});
</script>