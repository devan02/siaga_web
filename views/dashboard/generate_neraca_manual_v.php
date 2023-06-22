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
                        Pembentukan Neraca Anggaran Manual
                    </div>
                </div>
            </div>            
                               
            
    </div>

    <div class="panel-footer">
        <center>

            <input name="generate" type="submit" value="Tampilkan Form Neraca" style="font-weight:bold;" class="btn btn-primary btn-gradient dark"  />
                
        </center>
    </div>

    </form>
</div>

<?PHP if($edit == 1){ ?>
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
                            <a href="#tab1" data-toggle="tab">AKTIVA</a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab">KEWAJIBAN</a>
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
                                            <th style="vertical-align: middle; text-align:center; width:200px;">Judul</th>
                                            <th style="vertical-align: middle; text-align:center;">Proyeksi <?=$tahun;?></th>
                                            <th style="vertical-align: middle; text-align:center;">Proyeksi <?=$tahun - 1;?></th>
                                            <th style="vertical-align: middle; text-align:center;">Proyeksi <?=$tahun - 2;?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?PHP
                                        $old_judul = "";
                                        $old_sub_judul = "";
                                        $old_judul2 = "";
                                        $old_sub_judul2 = "";
                                        $next_judul1 = "";
                                        $next_judul2 = "";

                                        foreach ($dt as $key => $set) {
                                            if($set->STS == "AKTIVA"){
                                                $judul1 = TRIM($set->AKTIVA_INDUK1);
                                                $judul2 = TRIM($set->AKTIVA_INDUK2);

                                                if ($old_judul != $judul1) {
                                                    $old_judul  = $judul1 ;
                                                    echo "<tr>";
                                                    echo "<td colspan='4'><b>".$set->AKTIVA_INDUK1."</b></td>" ;
                                                    echo "</tr>";
                                                }

                                                if ($old_sub_judul != $judul2 && $judul2 != "a") {
                                                    $old_sub_judul  = $judul2 ;
                                                    echo "<tr>";
                                                    echo "<td colspan='4' class='judul'>&nbsp; <b>".$set->AKTIVA_INDUK2."</b></td>" ;
                                                    echo "</tr>";
                                                }

                                                echo "<tr>";
                                                if($set->AKTIVA_JUDUL == "" || $set->AKTIVA_JUDUL == null){
                                                echo "<td>&nbsp;&nbsp;".$set->AKTIVA_JUDUL."</td>" ;
                                                } else {
                                                echo "<td> <input type='hidden' name='sts[]' value='AKTIVA' /> <input type='hidden' name='id_neraca[]'' value='".$set->ID."' /> &nbsp;&nbsp; - ".$set->AKTIVA_JUDUL."</td>" ;    
                                                }

                                                echo "<td style='text-align:center;'> <input onkeyup='FormatCurrency(this);' style='text-align:center; width:150px;'  type='text' name='NILAI[]' value='".number_format($set->NILAI)."' /> </td>";
                                                echo "<td style='text-align:center;'> <input onkeyup='FormatCurrency(this);' style='text-align:center; width:150px;'  type='text' name='NILAI_LALU1[]' value='".number_format($set->NILAI_LALU1)."' /> </td>";
                                                echo "<td style='text-align:center;'> <input onkeyup='FormatCurrency(this);' style='text-align:center; width:150px;'  type='text' name='NILAI_LALU2[]' value='".number_format($set->NILAI_LALU2)."' /> </td>";
                                                echo "</tr>";


                                            }

                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>


                            </div>
                        </div>

                        <div id="tab2" class="tab-pane">
                            <div class="row">
                                <div style="max-width:100%; overflow-x: scroll; white-space: nowrap; ">
                                <table class="table table-bordered" style="width:100%;" id="tes3">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle; text-align:center; width:200px;">Judul</th>
                                            <th style="vertical-align: middle; text-align:center;">Proyeksi <?=$tahun;?></th>
                                            <th style="vertical-align: middle; text-align:center;">Proyeksi <?=$tahun - 1;?></th>
                                            <th style="vertical-align: middle; text-align:center;">Proyeksi <?=$tahun - 2;?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?PHP
                                        $old_judul = "";
                                        $old_sub_judul = "";
                                        $old_judul2 = "";
                                        $old_sub_judul2 = "";
                                        $next_judul1 = "";
                                        $next_judul2 = "";

                                        foreach ($dt as $key => $set) {
                                            if($set->STS == "KEWAJIBAN"){
                                                $judul1 = TRIM($set->KEWAJIBAN_INDUK1);
                                                $judul2 = TRIM($set->KEWAJIBAN_INDUK2);

                                                if ($old_judul != $judul1) {
                                                    $old_judul  = $judul1 ;
                                                    echo "<tr>";
                                                    echo "<td colspan='4'><b>".$set->KEWAJIBAN_INDUK1."</b></td>" ;
                                                    echo "</tr>";
                                                }

                                                if ($old_sub_judul != $judul2 && $judul2 != "a") {
                                                    $old_sub_judul  = $judul2 ;
                                                    echo "<tr>";
                                                    echo "<td colspan='4' class='judul'>&nbsp; <b>".$set->KEWAJIBAN_INDUK2."</b></td>" ;
                                                    echo "</tr>";
                                                }

                                                echo "<tr>";
                                                if($set->KEWAJIBAN_JUDUL == "" || $set->KEWAJIBAN_JUDUL == null){
                                                echo "<td>&nbsp;&nbsp;".$set->KEWAJIBAN_JUDUL."</td>" ;
                                                } else {
                                                echo "<td> <input type='hidden' name='sts_wajib[]' value='KEWAJIBAN' /> <input type='hidden' name='id_neraca_wajib[]'' value='".$set->ID."' /> &nbsp;&nbsp; - ".$set->KEWAJIBAN_JUDUL."</td>" ;    
                                                }

                                                echo "<td style='text-align:center;'> <input onkeyup='FormatCurrency(this);' style='text-align:center; width:150px;'  type='text' name='WAJIB_NILAI[]' value='".number_format($set->NILAI)."' /> </td>";
                                                echo "<td style='text-align:center;'> <input onkeyup='FormatCurrency(this);' style='text-align:center; width:150px;'  type='text' name='WAJIB_NILAI_LALU1[]' value='".number_format($set->NILAI_LALU1)."' /> </td>";
                                                echo "<td style='text-align:center;'> <input onkeyup='FormatCurrency(this);' style='text-align:center; width:150px;'  type='text' name='WAJIB_NILAI_LALU2[]' value='".number_format($set->NILAI_LALU2)."' /> </td>";
                                                echo "</tr>";


                                            }

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

            <input name="simpan" type="submit" value="SIMPAN NERACA" style="font-weight:bold;" class="btn btn-primary btn-gradient dark"  />
                
        </center>
    </div>

    
</div>
</form>
<?PHP } ?>