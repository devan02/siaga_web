<script type="text/javascript" src="<?=base_url();?>material/vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script type="text/javascript">

    $(document).ready(function(){

        <?php
            if($msg == 1){
        ?>
            pesan_sukses();
        <?php
            }
        ?>

    });
</script>

<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body">

        <form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>">
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

            <div class="form-group">
                <label for="disabledInput" class="col-lg-3 control-label">Item Diproses</label>
                <div class="col-lg-8" style="margin-top: 10px;">
                    <div class="radio-custom radio-primary mb5">
                        Pembentukan Neraca Anggaran Otomatis
                    </div>
                </div>
            </div>            
                               
            
    </div>

    <div class="panel-footer">
        <center>

            <input name="generate" type="submit" value="Mulai Pembentukan" style="font-weight:bold;" class="btn btn-primary btn-gradient dark"  />
                
        </center>
    </div>

    </form>
</div>
