<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    data_divisi();
    grid_seleksi_cari2();

    $("input[name='kriteria']").click(function(){
        var kriteria = $("input[name='kriteria']:checked").val();
        if(kriteria == "dep"){
            $('#head_bagian').show();
            $('#head_sub_bagian').hide();        

        } else if(kriteria == "div"){
            $('#head_bagian').show();
            $('#head_sub_bagian').show();

        } else {
           $('#head_bagian').hide();
           $('#head_sub_bagian').hide(); 
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

function grid_seleksi_cari(){

        var id_departemen = $('#departemen2').val();
        var id_divisi = $('#divisi2').val();
        var tahun = $('#tahun').val();
        var jenis = $('input[name="jenis_rkap"]:checked').val();
        var sumber = $('input[name="sumber"]:checked').val();


        var kriteria = $("input[name='kriteria']:checked").val();
        if(kriteria == "dep"){
           id_departemen = $('#departemen2').val();
           id_divisi     = '';       

        } else if(kriteria == "div"){
            id_departemen = $('#departemen2').val();
            id_divisi     = $('#divisi2').val(); 

        } else {
           id_departemen = '';
           id_divisi     = '';   
        }


        $.ajax({
            url : "<?=base_url()?>dashboard/preview_rkap_c/grid_seleksi_cari",
            data: {
                id_departemen:id_departemen,
                id_divisi:id_divisi,
                tahun:tahun,
                jenis : jenis,
                sumber : sumber,
            },
            type: "POST",
            dataType: "json",
            success:function(data){
                $isi = "";
                var i = 0;
                if(data.length > 0) {
                    for(var x=0;x<data.length;x++){
                        i++;
                        var total = 0;
                        var vol = 0;
                        var harga = 0;
                        var sts_rev = data[x].STS_REVISI;

                        if(sts_rev == 5){

                            vol = data[x].JUMLAH_2;
                            harga = data[x].HARGA_2;
                            if(data[x].JENIS_ANGGARAN == "Barang"){
                                total = data[x].TOTAL_2;  
                            } else {
                                total = data[x].TOTAL_PELAKSANAAN_2;  
                            }

                        } else {

                           vol = data[x].JUMLAH;
                           harga = data[x].HARGA;
                           if(data[x].JENIS_ANGGARAN == "Barang"){
                                total = data[x].TOTAL;  
                            } else {
                                total = data[x].TOTAL_PELAKSANAAN;  
                            } 

                        }
                        
                        $isi+= "<tr>"+
                                   "<td>"+data[x].KODE_ANGGARAN+"</td>"+
                                   "<td>"+data[x].URAIAN+"</td>"+
                                   "<td align='center'>"+data[x].SD_1+"</td>"+
                                   "<td>"+data[x].NAMA_DIVISI+"</td>"+
                                   "<td align='center'>"+data[x].KODE_PERKIRAAN+"</td>"+
                                   "<td>Rp. "+NumberToMoney(harga)+"</td>"+
                                   "<td align='center'>"+vol+"</td>"+
                                   "<td>Rp. "+NumberToMoney(total)+"</td>"+
                               "</tr>";
                        //text += '<tr><td> # '+data[x].JENIS+' - '+data[x].NAMA+' - '+data[x].TANGGAL+' - '+data[x].JAM+' - '+data[x].MODUL+' - '+data[x].LINK+' - '+data[x].OBJECT+'</td></tr>';              
                    }
                } else {
                    $isi+= "<tr>"+
                                   "<td colspan='7'> Tidak ada data </td>"+
                               "</tr>"; 
                }
                $('#tes tbody').html($isi);
            }
        });

}

function grid_seleksi_cari2(){
        $('#popup_load_adit').show();
        var id_departemen = $('#departemen2').val();
        var id_divisi = $('#divisi2').val();
        var tahun = $('#tahun').val();
        var jenis = $('input[name="jenis_rkap"]:checked').val();
        var sumber = $('input[name="sumber"]:checked').val();

        var kriteria = $("input[name='kriteria']:checked").val();
        if(kriteria == "dep"){
           id_departemen = $('#departemen2').val();
           id_divisi     = '';       

        } else if(kriteria == "div"){
            id_departemen = $('#departemen2').val();
            id_divisi     = $('#divisi2').val(); 

        } else {
           id_departemen = '';
           id_divisi     = '';   
        }

        $.ajax({
                url : "<?=base_url()?>dashboard/preview_rkap_c/grid_seleksi_cari",
                data: {
                    id_departemen:id_departemen,
                    id_divisi:id_divisi,
                    tahun:tahun,
                    jenis : jenis,
                    sumber : sumber,
                },
                type: "POST",
                dataType: "json",
                success:function(data){
                    $warna = "";
                    $warna_txt = "";
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
                            

                            if( (data[x].ID_REAL == null || data[x].ID_REAL == "") && data[x].STS_TAMBAHAN != 2 ){

                                $warna = "#FFF";

                            } else if(data[x].STS_TAMBAHAN == 2){

                                $warna = "#ffc907";


                            } else if(data[x].ID_REAL != null || data[x].ID_REAL != "" ){

                                if(data[x].JML_SPK > 0){

                                    if(total > data[x].JML_SPK){
                                        $warna = "#fff200"; 
                                        
                                    } else {                                        
                                        $warna = "#fd5c63"; 
                                        $warna_txt = "#FFF";
                                    }

                                } else {
                                    if(total > (data[x].JML_RAB + data[x].JML_DPBM) ){
                                        $warna = "#fff200";
                                        
                                    } else {
                                        $warna = "#fd5c63";  
                                        $warna_txt = "#FFF";                                      
                                    }
                                }
                            }

                            $isi+= "<tr style='background:"+$warna+"; color:"+$warna_txt+";'>"+
                                       "<td>"+data[x].KODE_ANGGARAN+"</td>"+
                                       "<td>"+data[x].URAIAN+"</td>"+
                                       "<td align='center'>"+data[x].SD_1+"</td>"+
                                       "<td>"+data[x].NAMA_DIVISI+"</td>"+
                                       "<td align='center'>"+data[x].KODE_PERKIRAAN+"</td>"+
                                       "<td>Rp. "+NumberToMoney(data[x].HARGA)+"</td>"+
                                       "<td align='center'>"+data[x].JUMLAH+"</td>"+
                                       "<td>Rp. "+NumberToMoney(total)+"</td>"+
                                   "</tr>";

                            $warna = "";
                            $warna_txt = "";
                        }
                    } else {
                        $isi+= "<tr>"+
                                       "<td colspan='7'> Tidak ada data </td>"+
                                   "</tr>"; 
                    }
                    $('#tes tbody').html($isi);
                }


        });

$('#popup_load_adit').fadeOut('slow');

}

</script>
<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body">

        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label for="tahun" class="col-lg-3 control-label">Tahun Anggaran</label>
                <div class="col-lg-8">
                    <select id="tahun" onchange="grid_seleksi_cari();" >
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
                        <input onclick="grid_seleksi_cari2();" type="radio" id="radioExample1" name="kriteria" checked="" value="">
                        <label for="radioExample1" style="margin-right: 15px; padding-left: 25px;">Semua Bagian</label>

                        <input onclick="grid_seleksi_cari2();" type="radio" id="radioExample2" name="kriteria" value="dep">
                        <label for="radioExample2" style="margin-right: 15px; padding-left: 25px;">Bagian</label>

                        <input onclick="grid_seleksi_cari2();" type="radio" id="radioExample3" name="kriteria" value="div">
                        <label for="radioExample3" style="margin-right: 15px; padding-left: 25px;">Sub Bagian</label>
                    </div>
                </div>
            </div>
            

            <div id="head_bagian" class="form-group admin-form" style="display:none;">
                <label for="inputPassword" class="col-lg-3 control-label" id="warna_bagian">Bagian</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="departemen2" name="departemen" style="cursor:pointer;" onchange="data_divisi(); grid_seleksi_cari2();" <?php echo $disable; ?> >
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

            <div id="head_sub_bagian" class="form-group admin-form" style="display:none;">
                <label for="inputPassword" class="col-lg-3 control-label">Sub Bagian</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="divisi2" name="divisi" style="cursor:pointer;" onchange = "grid_seleksi_cari2();" <?php echo $disable2; ?> >
                   
                                    </select>
                                    <i style="z-index:99;" class="arrow"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>          

            <div class="form-group">
                <label for="disabledInput" class="col-lg-3 control-label">Sumber dana</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input onclick="grid_seleksi_cari2();" type="radio" id="radioExample77" name="sumber" checked="" value="">
                        <label for="radioExample77" style="margin-right: 15px; padding-left: 25px;">Semua</label>

                        <input onclick="grid_seleksi_cari2();" type="radio" id="radioExample88" name="sumber" value="PDAM">
                        <label for="radioExample88" style="margin-right: 15px; padding-left: 25px;">PAM</label>

                        <input onclick="grid_seleksi_cari2();" type="radio" id="radioExample99" name="sumber" value="PEMERINTAH">
                        <label for="radioExample99" style="margin-right: 15px; padding-left: 25px;">MPP</label>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-group">
                <center>
                <div class="col-lg-12" style="margin-top: 8px;">
                    <center>
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample5" name="jenis_rkap" value="Barang" onclick = "grid_seleksi_cari2();">
                        <label for="radioExample5" style="margin-right: 35px; padding-left: 25px;">Barang</label>

                        <input type="radio" id="radioExample6" name="jenis_rkap" value="Pekerjaan" onclick = "grid_seleksi_cari2();">
                        <label for="radioExample6" style="margin-right: 35px; padding-left: 25px;">Pekerjaan</label>

                        <input type="radio" id="radioExample7" name="jenis_rkap" value="Pelatihan" onclick = "grid_seleksi_cari2();">
                        <label for="radioExample7" style="margin-right: 35px; padding-left: 25px;">Pelatihan</label>

                        <input type="radio" id="radioExample8" name="jenis_rkap" value=""  checked="" onclick = "grid_seleksi_cari2();">
                        <label for="radioExample8" style="margin-right: 35px; padding-left: 25px;">Semua</label>
                    </div>
                    </center>
                </div>
                </center>
            </div>
            
    </div>

    <div class="panel-footer">
        
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">
                    <span class="glyphicons glyphicons-table"></span>List Data</span>
            </div>
            <div class="panel-body pn">
                <table class="table table-bordered" id="tes">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle;">Kode Anggaran</th>
                            <th style="vertical-align: middle;">Uraian</th>
                            <th style="vertical-align: middle; text-align: center;">Sumber Dana</th>
                            <th style="vertical-align: middle;">Sub Bagian</th>
                            <th style="vertical-align: middle; text-align: center;">Nomor Perkiraan</th>
                            <th style="vertical-align: middle;">Harga</th>
                            <th style="vertical-align: middle; text-align: center;">Jumlah</th>
                            <th style="vertical-align: middle;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    </form>
</div>
