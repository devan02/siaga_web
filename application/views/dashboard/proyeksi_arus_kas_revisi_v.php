<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script>
$(document).ready(function(){
    
});
</script>
<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <form class="form-horizontal" role="form" method="post" target="_blank" action="<?php echo $url; ?>">
        <div class="panel-body">
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
            <div class="form-group">
                <label for="disabledInput" class="col-lg-3 control-label">Kriteria</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample1" name="kriteria" value="rinci" checked="checked">
                        <label for="radioExample1" style="margin-right: 15px; padding-left: 25px;">Rinci</label>

                        <input type="radio" id="radioExample2" name="kriteria" value="tidak_rinci">
                        <label for="radioExample2" style="margin-right: 15px; padding-left: 25px;">Tidak Rinci</label>
                    </div>
                </div>
            </div> 
        </div>

        <div class="panel-footer">
            <center>
                <input name="excel" type="submit" id="excel" value="Cetak Excel" class="btn btn-default btn-gradient dark" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/xls.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;" />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="pdf" type="submit" id="pdf" value="Cetak PDF" class="btn btn-default btn-gradient dark" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/pdf.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;" />
            </center>
        </div>
    </form>
</div>
