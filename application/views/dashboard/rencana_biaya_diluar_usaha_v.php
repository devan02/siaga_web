<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body">

        <form class="form-horizontal" role="form" method="post" target="_blank" action="<?=base_url().$post_url;?>">
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
