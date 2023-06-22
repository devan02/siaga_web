<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Proyeksi_neraca.xls");
?>

<style>

.grid th {
	background: #1793d1;
	vertical-align: middle;
	color : #FFF;
	width: 100px;
    text-align: center;
    height: 40px;
}
.grid td {
	background: #FFFFF0;
	vertical-align: middle;
	font: 11px/15px sans-serif;
    height: 30px;
    padding-left: 5px;
    padding-right: 5px;
}
.grid {
	background: #FAEBD7;
	border: 2px solid #C5C5C5;
	width: 800px;
    border-spacing: 0;
}

.judul{
    height: 50px;
}

.kolom_header {
    height        : 40px;
    background    : #dadada ;
    font-weight   : bold; 
    text-align    : center;
    border-style  : solid;
    border-width  : thin;
    font-size     : 12px; 
  }

.title_header {
font-weight   : bold; 
text-align    : left;
font-size     : 14px;
}

.isi_table  {
  font-size     : 11px;
  border-style  : solid;
  border-width  : thin;   
text-align    : left;
}
</style>

<img src="<?=base_url();?>files/pdam/kop_surat.png" width="600" alt="KOP PDAM">

<br><br><br><br><br><br>

<table align="left">
    <tr>
        <td style="text-align:left;" colspan="5">
            <h3 style="font-family:Arial; font-weight:normal; line-height:1.6;">
                 PROYEKSI NERACA <br>
                 TAHUN ANGGARAN : <?=$thn;?> (<?=$ket_periode;?>)
            </h3>
        </td>
    </tr>

</table>           


<br><br>

<table cellspacing="2" style="width: 100%;" class="grid">
	<tr>
	    <td style="vertical-align:top;">
	        <table cellspacing="2" class="grid" style="border-spacing: 0;">
	            <thead>
	                <tr>
	                    <th  class="kolom_header" rowspan="2"> URAIAN</th>
	                    <th  class="kolom_header" colspan="2"> PROYEKSI </th>
	                    <th  class="kolom_header" rowspan="2"> REALISASI TAHUN <?=$thn-2;?> </th>
	                    <th  class="kolom_header" colspan="2" style="padding-top:20px;"> Proyeksi Tahun <?=$thn;?> dibanding Proyeksi Tahun <?=$thn-1;?> </th>
	                    <th  class="kolom_header" colspan="2" style="padding-top:20px;"> Proyeksi Tahun <?=$thn-1;?> dibanding Proyeksi Tahun <?=$thn-2;?> </th>
	                </tr>
	                <tr>
	                    <th  class="kolom_header"> <?=$thn;?> </th>
	                    <th  class="kolom_header"> <?=$thn-1;?> </th>

	                    <th  class="kolom_header"> Jumlah </th>
	                    <th  class="kolom_header"> % </th>

	                    <th  class="kolom_header"> Jumlah </th>
	                    <th  class="kolom_header"> % </th>
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
	                $TOT_NILAI  = 0;     
	                $TOT_NILAI_LALU1 = 0;
	                $TOT_NILAI_LALU2 = 0;
	                $SUM_TOT_NILAI       = 0;
	                $SUM_TOT_NILAI_LALU1 = 0;
	                $SUM_TOT_NILAI_LALU2 = 0;

	                $TOT_NILAI_AKTIVA       = 0;
	                $TOT_NILAI_LALU1_AKTIVA = 0;
	                $TOT_NILAI_LALU2_AKTIVA = 0;

	                $penyesuaian = $get_penyesuaian->NILAI_KEWAJIBAN -  $get_penyesuaian->NILAI_AKTIVA;
	                $penyesuaian_lalu1 = $get_penyesuaian_LALU1->NILAI_KEWAJIBAN -  $get_penyesuaian_LALU1->NILAI_AKTIVA;
	                $penyesuaian_lalu2 = $get_penyesuaian_LALU2->NILAI_KEWAJIBAN -  $get_penyesuaian_LALU2->NILAI_AKTIVA;

	                $last_key   = end(array_keys($setup));
	                foreach ($setup as $key => $set) {
	                    if($set->STS == "AKTIVA"){
	                        $judul1 = TRIM($set->AKTIVA_INDUK1);
	                        $judul2 = TRIM($set->AKTIVA_INDUK2);

	                        if ($old_judul != $judul1) {
	                            $old_judul  = $judul1 ;
	                            echo "<tr><td class='isi_table' colspan='8'></td></tr>";
	                            echo "<tr>";
	                            echo "<td class='isi_table'><b>".$set->AKTIVA_INDUK1."</b></td>" ;
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "</tr>";
	                        }

	                        if ($old_sub_judul != $judul2 && $judul2 != "a") {
	                            $old_sub_judul  = $judul2 ;
	                            echo "<tr>";
	                            echo "<td class='isi_table'>&nbsp; <b>".$set->AKTIVA_INDUK2."</b></td>" ;
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "</tr>";
	                        }

	                        $persen = 100;

	                        if($set->NILAI_LALU1 > 0){
	                            $persen = (($set->NILAI - $set->NILAI_LALU1) / $set->NILAI_LALU1) * 100;
	                        } else if($set->NILAI_LALU1 == 0 && $set->NILAI == 0){
	                            $persen = 0;
	                        }

	                        $persen2 = 100;

	                        if($set->NILAI_LALU2 > 0){
	                            $persen2 = (($set->NILAI_LALU1 - $set->NILAI_LALU2) / $set->NILAI_LALU2) * 100;
	                        } else if($set->NILAI_LALU2 == 0 && $set->NILAI_LALU1 == 0){
	                            $persen2 = 0;
	                        }

	                        echo "<tr>";
	                        if($set->AKTIVA_JUDUL == "" || $set->AKTIVA_JUDUL == null){
	                        echo "<td class='isi_table'>&nbsp;&nbsp;".$set->AKTIVA_JUDUL."</td>" ;
	                        } else {
	                        echo "<td class='isi_table'>&nbsp;&nbsp; - ".$set->AKTIVA_JUDUL."</td>" ;    
	                        }
	                        echo "<td class='isi_table'style='text-align:right;'>".str_replace(',', '.', number_format($set->NILAI))."</td>";
	                        echo "<td class='isi_table'style='text-align:right;'>".str_replace(',', '.', number_format($set->NILAI_LALU1))."</td>";
	                        echo "<td class='isi_table'style='text-align:right;'>".str_replace(',', '.', number_format($set->NILAI_LALU2))."</td>";
	                        echo "<td class='isi_table'style='text-align:right;'>".str_replace(',', '.', number_format($set->NILAI - $set->NILAI_LALU1))."</td>";
	                        echo "<td class='isi_table'style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($persen)))."</td>";
	                        echo "<td class='isi_table'style='text-align:right;'>".str_replace(',', '.', number_format($set->NILAI_LALU1 - $set->NILAI_LALU2))."</td>";
	                        echo "<td class='isi_table'style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($persen2)))."</td>";
	                        echo "</tr>";

	                        $NILAI         = str_replace(',', '.', $set->NILAI);
	                        $NILAI_LALU1   = str_replace(',', '.', $set->NILAI_LALU1);
	                        $NILAI_LALU2   = str_replace(',', '.', $set->NILAI_LALU2);

	                        if ($key < $last_key) {
	                        $k          = $key + 1;
	                        $next_judul1    = $setup[$k]->AKTIVA_INDUK1;
	                        }
	                        else{
	                            $next_judul1    = "" ;
	                        }

	                        $TOT_NILAI         += $NILAI;
	                        $TOT_NILAI_LALU1   += $NILAI_LALU1;
	                        $TOT_NILAI_LALU2   += $NILAI_LALU2;

	                        $SUM_TOT_NILAI       += $NILAI;
	                        $SUM_TOT_NILAI_LALU1 += $NILAI_LALU1;
	                        $SUM_TOT_NILAI_LALU2 += $NILAI_LALU2;

	                        if($set->AKTIVA_INDUK1 == "AKTIVA TETAP"){
	                            $TOT_NILAI_AKTIVA         += $NILAI;
	                            $TOT_NILAI_LALU1_AKTIVA   += $NILAI_LALU1;
	                            $TOT_NILAI_LALU2_AKTIVA   += $NILAI_LALU2;
	                        }
	                        

	                        if ($judul1 != $next_judul1) {

	                            $persen_tot = 100;

	                            if($TOT_NILAI_LALU1 > 0){
	                                $persen_tot = (($TOT_NILAI - $TOT_NILAI_LALU1) / $TOT_NILAI_LALU1) * 100;
	                            } else if($TOT_NILAI_LALU1 == 0 && $TOT_NILAI == 0){
	                                $persen_tot = 0;
	                            }

	                            $persen_tot_2 = 100;

	                            if($TOT_NILAI_LALU2 > 0){
	                                $persen_tot_2 = (($TOT_NILAI_LALU1 - $TOT_NILAI_LALU2) / $TOT_NILAI_LALU2) * 100;
	                            } else if($TOT_NILAI_LALU2 == 0 && $TOT_NILAI_LALU1 == 0){
	                                $persen_tot_2 = 0;
	                            }

	                            echo "<tr>";
	                            echo "<td class='isi_table' style='text-align:right;'>Jumlah ".$set->AKTIVA_INDUK1."</td>" ;
	                            echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI))."</td>";
	                            echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI_LALU1))."</td>";
	                            echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI_LALU2))."</td>";
	                            echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI - $TOT_NILAI_LALU1))."</td>";
	                            echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($persen_tot)))."</td>";
	                            echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI_LALU1 - $TOT_NILAI_LALU2))."</td>";
	                            echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($persen_tot_2)))."</td>";
	                            echo "</tr>";

	                            $TOT_NILAI        = 0;
	                            $TOT_NILAI_LALU1  = 0;
	                            $TOT_NILAI_LALU2  = 0;
	                        }

	                        if ($judul1 != $next_judul1 && $set->AKTIVA_INDUK1 == "AKTIVA LANCAR") {
	                            echo "<tr><td class='isi_table' colspan='8'></td></tr>";
	                            echo "<tr>";
	                            echo "<td class='isi_table'><b>INVESTASI JANGKA PANJANG</b></td>" ;
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "</tr>";
	                        }

	                        if ($judul1 != $next_judul1 && $set->AKTIVA_INDUK1 == "AKTIVA TETAP") {

	                            $persen_akv_1 = 100;

	                            if($penyesuaian_lalu1 > 0){
	                                $persen_akv_1 = (($penyesuaian - $penyesuaian_lalu1) / $penyesuaian_lalu1) * 100;
	                            } else if($penyesuaian_lalu1 == 0 && $penyesuaian == 0){
	                                $persen_akv_1 = 0;
	                            }

	                            $persen_akv_2 = 100;

	                            if($penyesuaian_lalu2 > 0){
	                                $persen_akv_2 = (($penyesuaian_lalu1 - $penyesuaian_lalu2) / $penyesuaian_lalu2) * 100;
	                            } else if($penyesuaian_lalu2 == 0 && $penyesuaian_lalu1 == 0){
	                                $persen_akv_2 = 0;
	                            }


	                            echo "<tr><td class='isi_table' colspan='8'></td></tr>";
	                            echo "<tr>";
	                            echo "<td class='isi_table'> - Akumulasi Penyusutan</td>" ;
	                            echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($penyesuaian)))."</td>";
	                            echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($penyesuaian_lalu1)))."</td>";
	                            echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($penyesuaian_lalu2)))."</td>";
	                            echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($penyesuaian - $penyesuaian_lalu1)))."</td>";
	                            echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($persen_akv_1)))."</td>";
	                            echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($penyesuaian_lalu1 - $penyesuaian_lalu2)))."</td>";
	                            echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($persen_akv_2)))."</td>";
	                            echo "</tr>";

	                            $sum_persen_akv_1 = 100;

	                            if($penyesuaian_lalu1 + $TOT_NILAI_LALU1_AKTIVA > 0){
	                                $sum_persen_akv_1 = (($penyesuaian + $TOT_NILAI_AKTIVA - $penyesuaian_lalu1 + $TOT_NILAI_LALU1_AKTIVA) / $penyesuaian_lalu1 + $TOT_NILAI_LALU1_AKTIVA) * 100;
	                            } else if($penyesuaian_lalu1 + $TOT_NILAI_LALU1_AKTIVA == 0 && $penyesuaian + $TOT_NILAI_AKTIVA == 0){
	                                $sum_persen_akv_1 = 0;
	                            }

	                            $sum_persen_akv_2 = 100;

	                            if($penyesuaian_lalu2 + $TOT_NILAI_LALU2_AKTIVA > 0){
	                                $sum_persen_akv_2 = (($penyesuaian_lalu1 + $TOT_NILAI_LALU1_AKTIVA - $penyesuaian_lalu2 + $TOT_NILAI_LALU2_AKTIVA) / $penyesuaian_lalu2 + $TOT_NILAI_LALU2_AKTIVA) * 100;
	                            } else if($penyesuaian_lalu2 + $TOT_NILAI_LALU2_AKTIVA == 0 && $penyesuaian_lalu1 + $TOT_NILAI_LALU1_AKTIVA == 0){
	                                $sum_persen_akv_2 = 0;
	                            }


	                            echo "<tr>";
	                            echo "<td class='isi_table' style='text-align:right;'>Nilai Buku Aktiva Tetap</td>" ;
	                            echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($penyesuaian + $TOT_NILAI_AKTIVA)))."</td>";
	                            echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($penyesuaian_lalu1 + $TOT_NILAI_LALU1_AKTIVA)))."</td>";
	                            echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($penyesuaian_lalu2 + $TOT_NILAI_LALU2_AKTIVA)))."</td>";
	                            echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format( ($penyesuaian + $TOT_NILAI_AKTIVA) - ($penyesuaian_lalu1 + $TOT_NILAI_LALU1_AKTIVA) )))."</td>";
	                            echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($sum_persen_akv_1)))."</td>";
	                            echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format( ($penyesuaian_lalu1 + $TOT_NILAI_LALU1_AKTIVA) - ($penyesuaian_lalu2 + $TOT_NILAI_LALU2_AKTIVA) )))."</td>";
	                            echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($sum_persen_akv_2)))."</td>";
	                            echo "</tr>";

	                            echo "<tr><td class='isi_table' colspan='8'></td></tr>";
	                            echo "<tr>";
	                            echo "<td class='isi_table'><b>Aktiva Tetap Leasing</b></td>" ;
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "<td class='isi_table'></td>";
	                            echo "</tr>";
	                        }
	                    }                                

	                }

	                $sum_persen_tot = 100;

	                if($SUM_TOT_NILAI_LALU1 + $penyesuaian_lalu1 > 0){
	                    $sum_persen_tot = (( ($SUM_TOT_NILAI + $penyesuaian) - ($SUM_TOT_NILAI_LALU1 + $penyesuaian_lalu1) ) / ($SUM_TOT_NILAI_LALU1 + $penyesuaian_lalu1) ) * 100;
	                } else if($SUM_TOT_NILAI_LALU1 + $penyesuaian_lalu1 == 0 && $SUM_TOT_NILAI + $penyesuaian == 0){
	                    $sum_persen_tot = 0;
	                }

	                $sum_persen_tot_2 = 100;

	                if($SUM_TOT_NILAI_LALU2 + $penyesuaian_lalu2 > 0){
	                    $sum_persen_tot_2 = (( ($SUM_TOT_NILAI_LALU1 + $penyesuaian_lalu1) - ($SUM_TOT_NILAI_LALU2 + $penyesuaian_lalu2)) / ($SUM_TOT_NILAI_LALU2 + $penyesuaian_lalu2) ) * 100;
	                } else if($SUM_TOT_NILAI_LALU2 + $penyesuaian_lalu2 == 0 && $SUM_TOT_NILAI_LALU1 + $penyesuaian_lalu1 == 0){
	                    $sum_persen_tot_2 = 0;
	                }

	                echo "<tr>";
	                echo "<td class='isi_table' style='text-align:left;'><b>JUMLAH AKTIVA</b></td>" ;
	                echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($SUM_TOT_NILAI + $penyesuaian))."</td>";
	                echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($SUM_TOT_NILAI_LALU1 + $penyesuaian_lalu1))."</td>";
	                echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($SUM_TOT_NILAI_LALU2 + $penyesuaian_lalu2))."</td>";
	                echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format( ($SUM_TOT_NILAI + $penyesuaian) - ($SUM_TOT_NILAI_LALU1 + $penyesuaian_lalu1) ))."</td>";
	                echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($sum_persen_tot)))."</td>";
	                echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format( ($SUM_TOT_NILAI_LALU1 + $penyesuaian_lalu1) - ($SUM_TOT_NILAI_LALU2 + $penyesuaian_lalu2) ))."</td>";
	                echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($sum_persen_tot_2)))."</td>";
	                echo "</tr>";
	            ?>  
	            </tbody>
	        </table>
	    </td>

	    <td style="vertical-align:top;">
	        <table cellspacing="2" class="grid">
	            <thead>
	                <tr>
	                    <th class="kolom_header" rowspan="2"> URAIAN</th>
	                    <th class="kolom_header" colspan="2"> PROYEKSI </th>
	                    <th class="kolom_header" rowspan="2"> REALISASI TAHUN <?=$thn-2;?> </th>
	                    <th class="kolom_header" colspan="2" style="padding-top:20px;"> Proyeksi Tahun <?=$thn;?> dibanding Proyeksi Tahun <?=$thn-1;?> </th>
	                    <th class="kolom_header" colspan="2" style="padding-top:20px;"> Proyeksi Tahun <?=$thn-1;?> dibanding Proyeksi Tahun <?=$thn-2;?> </th>
	                </tr>
	                <tr>
	                    <th class="kolom_header" > <?=$thn;?> </th>
	                    <th class="kolom_header" > <?=$thn-1;?> </th>

	                    <th class="kolom_header"> Jumlah </th>
	                    <th class="kolom_header"> % </th>

	                    <th class="kolom_header"> Jumlah </th>
	                    <th class="kolom_header"> % </th>
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
	                    $TOT_NILAI  = 0;     
	                    $TOT_NILAI_LALU1 = 0;
	                    $TOT_NILAI_LALU2 = 0;
	                    $SUM_TOT_NILAI       = 0;
	                    $SUM_TOT_NILAI_LALU1 = 0;
	                    $SUM_TOT_NILAI_LALU2 = 0;

	                    $last_key   = end(array_keys($setup));
	                    foreach ($setup as $key => $set) {
	                        if($set->STS == "KEWAJIBAN"){
	                            $judul1 = TRIM($set->KEWAJIBAN_INDUK1);
	                            $judul2 = TRIM($set->KEWAJIBAN_INDUK2);

	                            if ($old_judul != $judul1) {
	                                $old_judul  = $judul1 ;
	                                echo "<tr><td class='isi_table' colspan='8'></td></tr>";
	                                echo "<tr>";
	                                echo "<td class='isi_table'><b>".$set->KEWAJIBAN_INDUK1."</b></td>" ;
	                                echo "<td class='isi_table'></td>";
	                                echo "<td class='isi_table'></td>";
	                                echo "<td class='isi_table'></td>";
	                                echo "<td class='isi_table'></td>";
	                                echo "<td class='isi_table'></td>";
	                                echo "<td class='isi_table'></td>";
	                                echo "<td class='isi_table'></td>";
	                                echo "</tr>";
	                            }

	                            if ($old_sub_judul != $judul2 && $judul2 != "a") {
	                                $old_sub_judul  = $judul2 ;
	                                echo "<tr>";
	                                echo "<td class='isi_table'>&nbsp; <b>".$set->KEWAJIBAN_INDUK2."</b></td>" ;
	                                echo "<td class='isi_table'></td>";
	                                echo "<td class='isi_table'></td>";
	                                echo "<td class='isi_table'></td>";
	                                echo "<td class='isi_table'></td>";
	                                echo "<td class='isi_table'></td>";
	                                echo "<td class='isi_table'></td>";
	                                echo "<td class='isi_table'></td>";
	                                echo "</tr>";
	                            }

	                            $persen = 100;

	                            if($set->NILAI_LALU1 > 0){
	                                $persen = (($set->NILAI - $set->NILAI_LALU1) / $set->NILAI_LALU1) * 100;
	                            } else if($set->NILAI_LALU1 == 0 && $set->NILAI == 0){
	                                $persen = 0;
	                            }

	                            $persen2 = 100;

	                            if($set->NILAI_LALU2 > 0){
	                                $persen2 = (($set->NILAI_LALU1 - $set->NILAI_LALU2) / $set->NILAI_LALU2) * 100;
	                            } else if($set->NILAI_LALU2 == 0 && $set->NILAI_LALU1 == 0){
	                                $persen2 = 0;
	                            }


	                            echo "<tr>";
	                            if($set->KEWAJIBAN_JUDUL == "" || $set->KEWAJIBAN_JUDUL == null){
	                            echo "<td class='isi_table'>&nbsp;&nbsp;".$set->KEWAJIBAN_JUDUL."</td>" ;
	                            } else {
	                            echo "<td class='isi_table'>&nbsp;&nbsp; - ".$set->KEWAJIBAN_JUDUL."</td>" ;    
	                            }
	                             echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($set->NILAI))."</td>";
	                             echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($set->NILAI_LALU1))."</td>";
	                             echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($set->NILAI_LALU2))."</td>";
	                             echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($set->NILAI - $set->NILAI_LALU1))."</td>";
	                             echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($persen)))."</td>";
	                             echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($set->NILAI_LALU1 - $set->NILAI_LALU2))."</td>";
	                             echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($persen2)))."</td>";
	                             echo "</tr>";

	                             $NILAI         = str_replace(',', '.', $set->NILAI);
	                            $NILAI_LALU1   = str_replace(',', '.', $set->NILAI_LALU1);
	                            $NILAI_LALU2   = str_replace(',', '.', $set->NILAI_LALU2);

	                            if ($key < $last_key) {
	                            $k          = $key + 1;
	                            $next_judul1    = $setup[$k]->KEWAJIBAN_INDUK1;
	                            }
	                            else{
	                                $next_judul1    = "" ;
	                            }

	                            if ($key < $last_key) {
	                            $k          = $key + 1;
	                            $next_judul2    = $setup[$k]->KEWAJIBAN_INDUK2;
	                            }
	                            else{
	                                $next_judul2    = "" ;
	                            }

	                            $TOT_NILAI         += $NILAI;
	                            $TOT_NILAI_LALU1   += $NILAI_LALU1;
	                            $TOT_NILAI_LALU2   += $NILAI_LALU2;

	                            $SUM_TOT_NILAI         += $NILAI;
	                            $SUM_TOT_NILAI_LALU1   += $NILAI_LALU1;
	                            $SUM_TOT_NILAI_LALU2   += $NILAI_LALU2;

	                            if ($judul2 != $next_judul2 && $judul2 != "a") {

	                                $persen_tot = 100;

	                                if($TOT_NILAI_LALU1 > 0){
	                                    $persen_tot = (($TOT_NILAI - $TOT_NILAI_LALU1) / $TOT_NILAI_LALU1) * 100;
	                                } else if($TOT_NILAI_LALU1 == 0 && $TOT_NILAI == 0){
	                                    $persen_tot = 0;
	                                }

	                                $persen_tot_2 = 100;

	                                if($TOT_NILAI_LALU2 > 0){
	                                    $persen_tot_2 = (($TOT_NILAI_LALU1 - $TOT_NILAI_LALU2) / $TOT_NILAI_LALU2) * 100;
	                                } else if($TOT_NILAI_LALU2 == 0 && $TOT_NILAI_LALU1 == 0){
	                                    $persen_tot_2 = 0;
	                                }

	                                echo "<tr>";
	                                echo "<td class='isi_table' style='text-align:right;'>Jumlah ".$set->KEWAJIBAN_INDUK2."</td>" ;
	                                echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI))."</td>";
	                                echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI_LALU1))."</td>";
	                                echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI_LALU2))."</td>";
	                                echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI - $TOT_NILAI_LALU1))."</td>";
	                                echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($persen_tot)))."</td>";
	                                echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI_LALU1 - $TOT_NILAI_LALU2))."</td>";
	                                echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($persen_tot_2)))."</td>";
	                                echo "</tr>";

	                                $TOT_NILAI        = 0;
	                                $TOT_NILAI_LALU1  = 0;
	                                $TOT_NILAI_LALU2  = 0;
	                            }


	                            if ($judul1 != $next_judul1) {

	                                $persen_tot = 100;

	                                if($TOT_NILAI_LALU1 > 0){
	                                    $persen_tot = (($TOT_NILAI - $TOT_NILAI_LALU1) / $TOT_NILAI_LALU1) * 100;
	                                } else if($TOT_NILAI_LALU1 == 0 && $TOT_NILAI == 0){
	                                    $persen_tot = 0;
	                                }

	                                $persen_tot_2 = 100;

	                                if($TOT_NILAI_LALU2 > 0){
	                                    $persen_tot_2 = (($TOT_NILAI_LALU1 - $TOT_NILAI_LALU2) / $TOT_NILAI_LALU2) * 100;
	                                } else if($TOT_NILAI_LALU2 == 0 && $TOT_NILAI_LALU1 == 0){
	                                    $persen_tot_2 = 0;
	                                }

	                                $nama_perk = $set->KEWAJIBAN_INDUK1;
	                                if($nama_perk == "KEWAJIBAN JK. PANJANG & LAIN - LAIN"){
	                                    $nama_perk = "KEWAJIBAN JK. PANJANG";
	                                }

	                                echo "<tr>";
	                                echo "<td class='isi_table' style='text-align:right;'>Jumlah ".$nama_perk."</td>" ;
	                                echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI))."</td>";
	                                echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI_LALU1))."</td>";
	                                echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI_LALU2))."</td>";
	                                echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI - $TOT_NILAI_LALU1))."</td>";
	                                echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($persen_tot)))."</td>";
	                                echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI_LALU1 - $TOT_NILAI_LALU2))."</td>";
	                                echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($persen_tot_2)))."</td>";
	                                echo "</tr>";

	                                $TOT_NILAI        = 0;
	                                $TOT_NILAI_LALU1  = 0;
	                                $TOT_NILAI_LALU2  = 0;
	                            }


	                        }

	                    }

	                    $sum_persen_tot = 100;

	                    if($SUM_TOT_NILAI_LALU1 > 0){
	                        $sum_persen_tot = (($SUM_TOT_NILAI - $SUM_TOT_NILAI_LALU1) / $SUM_TOT_NILAI_LALU1) * 100;
	                    } else if($SUM_TOT_NILAI_LALU1 == 0 && $SUM_TOT_NILAI == 0){
	                        $sum_persen_tot = 0;
	                    }

	                    $sum_persen_tot_2 = 100;

	                    if($SUM_TOT_NILAI_LALU2 > 0){
	                        $sum_persen_tot_2 = (($SUM_TOT_NILAI_LALU1 - $SUM_TOT_NILAI_LALU2) / $SUM_TOT_NILAI_LALU2) * 100;
	                    } else if($SUM_TOT_NILAI_LALU2 == 0 && $SUM_TOT_NILAI_LALU1 == 0){
	                        $sum_persen_tot_2 = 0;
	                    }

	                    echo "<tr><td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td></tr>";
	                    echo "<tr><td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td></tr>";
	                    echo "<tr><td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td></tr>";
	                    echo "<tr><td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td></tr>";
	                    echo "<tr><td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td></tr>";
	                    echo "<tr><td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td></tr>";
	                    echo "<tr><td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td></tr>";
	                    echo "<tr><td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td></tr>";
	                    echo "<tr><td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td> <td class='isi_table'></td></tr>";

	                    echo "<tr>";
	                    echo "<td class='isi_table' style='text-align:left;'><b>JUMLAH KEWAJIBAN DAN MODAL</b></td>" ;
	                    echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($SUM_TOT_NILAI))."</td>";
	                    echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($SUM_TOT_NILAI_LALU1))."</td>";
	                    echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($SUM_TOT_NILAI_LALU2))."</td>";
	                    echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($SUM_TOT_NILAI - $SUM_TOT_NILAI_LALU1))."</td>";
	                    echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($sum_persen_tot)))."</td>";
	                    echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($SUM_TOT_NILAI_LALU1 - $SUM_TOT_NILAI_LALU2))."</td>";
	                    echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($sum_persen_tot_2)))."</td>";
	                    echo "</tr>";
	                ?> 
	            </tbody>
	        </table>
	    </td>
	</tr>
	</table>


<?PHP 
    function format_akuntansi($val){

        $val = str_replace('.', '', $val);
        $val = floatval($val);

        if($val < 0){
            $val = $val * -1;
            $val = "(".str_replace(',', '.', number_format($val)).")";
        } else {
            $val = str_replace(',', '.', number_format($val));
        }

        return $val;
    }
    
?>





<?php
exit()
?>
