<script type="text/javascript" src="<?=base_url();?>js-devan/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script>

</script>
<div id="content" class="view_kp1">
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <form class="form-horizontal" role="form" action="<?php echo $url; ?>" method="post" target="_blank">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-3 control-label">Periode</label>
                            <div class="col-lg-8" style="margin-top: 8px;">
                                <div class="radio-custom radio-primary mb5">
                                    <input type="radio" id="periode1" name="periode" value="1" checked="checked">
                                    <label for="periode1" style="margin-right: 15px; padding-left: 25px;">RKAP</label>

                                    <input type="radio" id="periode2" name="periode" value="2">
                                    <label for="periode2" style="margin-right: 15px; padding-left: 25px;">REVISI RKAP</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group"> 
			                <label for="tahun" class="col-lg-3 control-label">Tahun</label>
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
                    <div class="panel-footer admin-form">
                       <center>
                            <input type="submit" name="pdf" id="pdf" class="btn btn-default btn-gradient dark" value="PDF" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/pdf.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;">
                            <!-- <input type="submit" name="excel" id="excel" class="btn btn-default btn-gradient dark" value="Excel" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/xls.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;"> -->
                       </center> 
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>