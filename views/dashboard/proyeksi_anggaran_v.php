<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("input[name='output_laporan2']").click(function(){
        var kriteria = $("input[name='output_laporan2']:checked").val();
        if(kriteria == "1"){
            $('#head_jns_lap').hide();      
            $('#for_arus_kas').hide();
        } else if(kriteria == "2"){
            $('#head_jns_lap').show();
            $('#for_arus_kas').show();
        } 
    });

    $("input[name='jenis_laporan']").click(function(){
        var jenis = $("input[name='jenis_laporan']:checked").val();
        if(jenis == "arus"){
            $('#for_arus_kas').show();
        }else if(jenis == "laba"){
            $('#for_arus_kas').show();
        }else{
            $('#for_arus_kas').hide();
        }
    });
});
</script>

<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body">

        <form class="form-horizontal" role="form" method="post" target="_blank" action="<?=base_url().$post_url;?>">

            <div class="form-group">
                <label for="disabledInput" class="col-lg-3 control-label">Output Laporan</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample44" name="output_laporan2" value="1" checked="checked">
                        <label for="radioExample44" style="margin-right: 15px; padding-left: 25px;">Semua</label>

                        <input type="radio" id="radioExample55" name="output_laporan2" value="2">
                        <label for="radioExample55" style="margin-right: 15px; padding-left: 25px;">Per Laporan</label>
                    </div>
                </div>
            </div>

            <div class="form-group" id="head_jns_lap" style="display:none;">
                <label for="disabledInput" class="col-lg-3 control-label">Laporan</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample1" name="jenis_laporan" value="laba" checked="checked">
                        <label for="radioExample1" style="margin-right: 15px; padding-left: 25px;">Laba Rugi</label>

                        <input type="radio" id="radioExample2" name="jenis_laporan" value="arus">
                        <label for="radioExample2" style="margin-right: 15px; padding-left: 25px;">Arus Kas</label>

                        <input type="radio" id="radioExample3" name="jenis_laporan" value="neraca">
                        <label for="radioExample3" style="margin-right: 15px; padding-left: 25px;">Neraca</label>
                    </div>
                </div>
            </div>

            <div class="form-group" style="display:none;" id="for_arus_kas">
                <label for="disabledInput" class="col-lg-3 control-label">Jenis Laporan</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample4" name="output_laporan" value="rinci" checked="checked">
                        <label for="radioExample4" style="margin-right: 15px; padding-left: 25px;">Rinci</label>

                        <input type="radio" id="radioExample5" name="output_laporan" value="tidak_rinci">
                        <label for="radioExample5" style="margin-right: 15px; padding-left: 25px;">Tidak Rinci</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="divisi" class="col-lg-3 control-label" >Periode</label>
                <div class="col-lg-8">
                    <select class="multi-sel"  name="periode">
                        <option value="1">RKAP</option>
                        <option value="2">REVISI RKAP</option>
                    </select>
                </div>
            </div> 


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

            
                               
            
    </div>

    <div class="panel-footer">
        <center>

            <input name="excel" type="submit" value="Cetak Excel" class="btn btn-default btn-gradient dark" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/xls.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;" />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  

            <input name="pdf" type="submit" value="Cetak PDF" class="btn btn-default btn-gradient dark" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/pdf.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;" />
                
        </center>
    </div>

    </form>
</div>
