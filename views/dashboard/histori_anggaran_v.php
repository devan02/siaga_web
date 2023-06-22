<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script type="text/javascript">

$(document).ready(function(){

    data_divisi();

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

    $('#koang').click(function(){
        get_popup_anggaran();
        ajax_anggaran();
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

function loading(){
    $('#popup_load').css('display','block');
    $('#popup_load').show();
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
        url : '<?php echo base_url(); ?>dashboard/histori_anggaran_c/get_kd_anggaran',
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
        url : '<?php echo base_url(); ?>dashboard/histori_anggaran_c/get_anggaran_kode',
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

function get_history(){
    $('#popup_load_adit').show();
    var kode = $('#kode_anggaran').val();
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/histori_anggaran_c/get_history',
        data : {kode:kode},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(result){
            var isine = '';
            $.each(result,function(i,res){
                isine += '<tr>'+
                            '<td>'+res.RAPAT_KE+'</td>'+
                            '<td>'+res.JENIS_RAPAT+'</td>'+
                            '<td>'+res.JUMLAH_USULAN+'</td>'+
                            '<td>'+res.JUMLAH_REVISI+'</td>'+
                            '<td> Rp. '+NumberToMoney(res.TOTAL_USULAN2)+'</td>'+
                            '<td> Rp. '+NumberToMoney(res.TOTAL_REVISI)+'</td>'+
                            '<td> Rp. '+NumberToMoney(res.JANUARI)+'</td>'+
                            '<td> Rp. '+NumberToMoney(res.FEBRUARI)+'</td>'+
                            '<td> Rp. '+NumberToMoney(res.MARET)+'</td>'+
                            '<td> Rp. '+NumberToMoney(res.APRIL)+'</td>'+
                            '<td> Rp. '+NumberToMoney(res.MEI)+'</td>'+
                            '<td> Rp. '+NumberToMoney(res.JUNI)+'</td>'+
                            '<td> Rp. '+NumberToMoney(res.JULI)+'</td>'+
                            '<td> Rp. '+NumberToMoney(res.AGUSTUS)+'</td>'+
                            '<td> Rp. '+NumberToMoney(res.SEPTEMBER)+'</td>'+
                            '<td> Rp. '+NumberToMoney(res.OKTOBER)+'</td>'+
                            '<td> Rp. '+NumberToMoney(res.NOVEMBER)+'</td>'+
                            '<td> Rp. '+NumberToMoney(res.DESEMBER)+'</td>'+
                        '</tr>';
            });
            $('#tes3 tbody').html(isine); 
            $('#popup_load_adit').fadeOut('slow');
        }
    });
}

</script>

<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body">

        <div class="form-horizontal">
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
                        <input type="radio" id="radioExample1" name="kriteria" value="dep" checked>
                        <label for="radioExample1" style="margin-right: 15px; padding-left: 25px;">Bagian</label>

                        <input type="radio" id="radioExample2" name="kriteria" value="div">
                        <label for="radioExample2" style="margin-right: 15px; padding-left: 25px;">Sub Bagian</label>
                    </div>
                </div>
            </div>

            <div class="form-group admin-form" id="head_bagian" style="display:block;">
                <label for="inputPassword" class="col-lg-3 control-label" id="warna_bagian">Bagian</label>
                <div class="col-lg-4">
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

            <div class="form-group admin-form" id="head_sub_bagian" style="display:none;">
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

            <div class="form-group">
                <label for="inputPassword" class="col-lg-3 control-label"></label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <button onclick="get_history();" id="cari_ag" class="btn btn-info btn-gradient dark" style="font-weight:bold;"> Mulai Pencarian </button>    
                    </div>
                </div>
            </div> 

                

    </div>

    <div class="panel-footer">
        
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">
                    <span class="glyphicons glyphicons-table"></span>Histori Anggaran</span>
            </div>
            <div class="panel-body pn" style="max-width:100%; overflow-x: scroll; white-space: nowrap; ">
                <table class="table table-bordered" style="width:100%;" id="tes3">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle;">Rapat Ke</th>
                            <th style="vertical-align: middle;">Jenis Rapat</th>
                            <th style="vertical-align: middle;">Vol Usulan</th>
                            <th style="vertical-align: middle;">Vol Revisi</th>
                            <th style="vertical-align: middle;">Biaya Usulan</th>
                            <th style="vertical-align: middle;">Biaya Revisi</th>
                            <th style="vertical-align: middle;">Januari</th>
                            <th style="vertical-align: middle;">Februari</th>
                            <th style="vertical-align: middle;">Maret</th>
                            <th style="vertical-align: middle;">April</th>
                            <th style="vertical-align: middle;">Mei</th>
                            <th style="vertical-align: middle;">Juni</th>
                            <th style="vertical-align: middle;">Juli</th>
                            <th style="vertical-align: middle;">Agustus</th>
                            <th style="vertical-align: middle;">September</th>
                            <th style="vertical-align: middle;">Oktober</th>
                            <th style="vertical-align: middle;">November</th>
                            <th style="vertical-align: middle;">Desember</th>
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
