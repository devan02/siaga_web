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

        <?php
            if($edit == 1){
        ?>
            var thn = $('#thn').val();
            var prd = $('#prd').val();

            $('#tahun').val(thn);
            $('#periode_sel').val(prd);
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
                    <select class="multi-sel"  name="periode" id="periode_sel">
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
                        Menampilkan Realisasi Anggaran DRD
                    </div>
                </div>
            </div>   
        </div>

        <div class="panel-footer">
            <center>

                <input name="generate" type="submit" value="Tampilkan Form Realisasi DRD" style="font-weight:bold;" class="btn btn-primary btn-gradient dark"  />
                    
            </center>
        </div>

        </form>
</div>

<?PHP if($edit == 1){ 

$ket_periode = "RKAP";
if($periode == 2){
    $ket_periode = "REVISI RKAP";
}

?>
<form role="form" method="post" action="<?=base_url().$post_url;?>">
<input type="hidden" name="thn" id="thn" value="<?=$tahun;?>"/>
<input type="hidden" name="prd" id="prd" value="<?=$periode;?>"/>
<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body">         
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <ul class="nav panel-tabs panel-tabs-left">
                        <li class="active">
                            <a href="#tab1" data-toggle="tab"><?=$ket_periode." - ".$tahun;?></a>
                        </li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content pn br-n">

                        <div id="tab1" class="tab-pane active">
                            <div class="row">
                            <div style="max-width:100%; overflow-x: scroll; white-space: nowrap; ">
                                <table class="table table-bordered" style="width:100%;" id="tes3">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle; text-align:center; width:200px;">NO</th>
                                            <th style="vertical-align: middle; text-align:center;">KELOMPOK PELANGGAN</th>
                                            <th style="vertical-align: middle; text-align:center;">JANUARI</th>
                                            <th style="vertical-align: middle; text-align:center;">FEBRUARI</th>
                                            <th style="vertical-align: middle; text-align:center;">MARET</th>
                                            <th style="vertical-align: middle; text-align:center;">APRIL</th>
                                            <th style="vertical-align: middle; text-align:center;">MEI</th>
                                            <th style="vertical-align: middle; text-align:center;">JUNI</th>
                                            <th style="vertical-align: middle; text-align:center;">JULI</th>
                                            <th style="vertical-align: middle; text-align:center;">AGUSTUS</th>
                                            <th style="vertical-align: middle; text-align:center;">SEPTEMBER</th>
                                            <th style="vertical-align: middle; text-align:center;">OKTOBER</th>
                                            <th style="vertical-align: middle; text-align:center;">NOVEMBER</th>
                                            <th style="vertical-align: middle; text-align:center;">DESEMBER</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?PHP
                                        $no = 0;
                                        foreach ($dt as $key => $set) {
                                        $no++;
                                        echo "<tr>";
                                        echo "<td style='text-align:center;'> <input type='hidden' name='ID_BLOK[]' value='".$set->ID."'> $no </td>";
                                        echo "<td style='text-align:left;'> $set->KELOMPOK_PELANGGAN </td>";
                                        echo "<td style='text-align:center;'> <input onkeyup='FormatCurrency(this);' style='text-align:center; width:150px;'  type='text' name='JAN[]' value='".number_format($set->JAN)."' /> </td>";
                                        echo "<td style='text-align:center;'> <input onkeyup='FormatCurrency(this);' style='text-align:center; width:150px;'  type='text' name='FEB[]' value='".number_format($set->FEB)."' /> </td>";
                                        echo "<td style='text-align:center;'> <input onkeyup='FormatCurrency(this);' style='text-align:center; width:150px;'  type='text' name='MAR[]' value='".number_format($set->MAR)."' /> </td>";
                                        echo "<td style='text-align:center;'> <input onkeyup='FormatCurrency(this);' style='text-align:center; width:150px;'  type='text' name='APR[]' value='".number_format($set->APR)."' /> </td>";
                                        echo "<td style='text-align:center;'> <input onkeyup='FormatCurrency(this);' style='text-align:center; width:150px;'  type='text' name='MEI[]' value='".number_format($set->MEI)."' /> </td>";
                                        echo "<td style='text-align:center;'> <input onkeyup='FormatCurrency(this);' style='text-align:center; width:150px;'  type='text' name='JUN[]' value='".number_format($set->JUN)."' /> </td>";
                                        echo "<td style='text-align:center;'> <input onkeyup='FormatCurrency(this);' style='text-align:center; width:150px;'  type='text' name='JUL[]' value='".number_format($set->JUL)."' /> </td>";
                                        echo "<td style='text-align:center;'> <input onkeyup='FormatCurrency(this);' style='text-align:center; width:150px;'  type='text' name='AGU[]' value='".number_format($set->AGU)."' /> </td>";
                                        echo "<td style='text-align:center;'> <input onkeyup='FormatCurrency(this);' style='text-align:center; width:150px;'  type='text' name='SEP[]' value='".number_format($set->SEP)."' /> </td>";
                                        echo "<td style='text-align:center;'> <input onkeyup='FormatCurrency(this);' style='text-align:center; width:150px;'  type='text' name='OKT[]' value='".number_format($set->OKT)."' /> </td>";
                                        echo "<td style='text-align:center;'> <input onkeyup='FormatCurrency(this);' style='text-align:center; width:150px;'  type='text' name='NOP[]' value='".number_format($set->NOP)."' /> </td>";
                                        echo "<td style='text-align:center;'> <input onkeyup='FormatCurrency(this);' style='text-align:center; width:150px;'  type='text' name='DES[]' value='".number_format($set->DES)."' /> </td>";
                                        echo "</tr>";

                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="panel-footer">
        <center>

            <input name="simpan" type="submit" value="SIMPAN REALISASI DRD" style="font-weight:bold;" class="btn btn-primary btn-gradient dark"  />
                
        </center>
    </div>

    
</div>
</form>
<?PHP } ?>