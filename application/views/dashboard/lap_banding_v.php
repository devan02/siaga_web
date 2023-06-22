<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <form class="form-horizontal" role="form" action="<?php echo $url; ?>" method="post" target="_blank">
        <div class="panel-body">
            <div class="form-group admin-form">
                <label class="col-lg-3 control-label" for="inputPassword">Tahun Anggaran</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select style="cursor:pointer;" name="tahun" id="tahun2">
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
                                    <i class="arrow" style="z-index:99;"></i>
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
                        <input type="radio" id="radioExample1" name="jenis_laporan" value="perbandingan_rkap_revisi">
                        <label for="radioExample1" style="margin-right: 15px; padding-left: 25px;">Perbandingan RKAP dan Revisi</label>
                    </div>

                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample2" name="jenis_laporan" value="perbandingan_uraian_rkap_revisi">
                        <label for="radioExample2" style="margin-right: 15px; padding-left: 25px;">Perbandingan RKAP dan Revisi per Uraian</label>
                    </div>

                    <!-- <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample3" name="jenis_laporan">
                        <label for="radioExample3" style="margin-right: 15px; padding-left: 25px;">Perbandingan Pendapatan dan Penerimaan Rencana Anggaran </label>
                    </div>

                    <div class="radio-custom radio-primary mb5">
                        <input type="radio" id="radioExample4" name="jenis_laporan">
                        <label for="radioExample4" style="margin-right: 15px; padding-left: 25px;">Perbandingan Pendapatan dan Penerimaan Revisi Anggaran  </label>
                    </div> -->
                </div>
            </div>
         
        </div>

        <div class="panel-footer">
            <center>
	            <input type="submit" name="excel" class="btn btn-default btn-gradient dark" value="Cetak Excel" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/xls.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;"> 
	            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
	            <input type="submit" name="pdf" class="btn btn-default btn-gradient dark" value="Cetak PDF" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/pdf.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;"> 
            </center>
        </div>

    </form>
</div>
