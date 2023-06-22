<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Rencana_pengeluaran_non_operasi.xls");
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
}

</style>

        <img src="<?=base_url();?>files/pdam/kop_surat.png" width="600" alt="KOP PDAM">

        <br><br><br><br><br><br>

        <table align="left">
            <tr>
                <td style="text-align:left;" colspan="5">
                    <h3 style="font-family:Arial; font-weight:normal; line-height:1.6;">
                       RENCANA PENGELUARAN NON OPERASI <?=$thn;?> (<?=$ket_periode;?>)
                    </h3>
                </td>
            </tr>

        </table>           
        

        <br><br>


        <table align="center" class="grid">
            <thead>
                <tr>
                    <th class="kolom_header" rowspan="2"> NO </th>
                    <th class="kolom_header" rowspan="2"> URAIAN </th>
                    <th class="kolom_header" colspan="12"> BULAN </th>
                    <th class="kolom_header" rowspan="2"> JUMLAH </th>
                    <th class="kolom_header" rowspan="2"> ESTIMASI TAHUN <?=$thn-1;?> </th>
                    <th class="kolom_header" colspan="2"> MENAIK / (MENURUN) </th>
                </tr>
                <tr>
                    <th class="kolom_header"> Januari </th>
                    <th class="kolom_header"> Pebruari </th>
                    <th class="kolom_header"> Maret </th>
                    <th class="kolom_header"> April </th>
                    <th class="kolom_header"> Mei </th>
                    <th class="kolom_header"> Juni </th>
                    <th class="kolom_header"> Juli </th>
                    <th class="kolom_header"> Agustus </th>
                    <th class="kolom_header"> September </th>
                    <th class="kolom_header"> Oktober </th>
                    <th class="kolom_header"> Nopember </th>
                    <th class="kolom_header"> Desember </th>
                    <th class="kolom_header">JUMLAH </th>
                    <th class="kolom_header">% </th>
                </tr>
            </thead>
            <tbody>
                <?PHP 
                $old_judul = "";
                $old_judul2 = "";
                $next_judul1 = "";
                $next_judul2 = "";
                $totJAN = 0; $totJAN_dana_proyek_pdam = 0; $totJAN_apbd = 1691666667;  $totJAN_dana_pdam = $dana_pdam->JAN;
                $totFEB = 0; $totFEB_dana_proyek_pdam = 0; $totFEB_apbd = 2181666667;  $totFEB_dana_pdam = $dana_pdam->FEB;
                $totMAR = 0; $totMAR_dana_proyek_pdam = 0; $totMAR_apbd = 2381666667;  $totMAR_dana_pdam = $dana_pdam->MAR;
                $totAPR = 0; $totAPR_dana_proyek_pdam = 0; $totAPR_apbd = 3010416667;  $totAPR_dana_pdam = $dana_pdam->APR;
                $totMEI = 0; $totMEI_dana_proyek_pdam = 0; $totMEI_apbd = 3310416667;  $totMEI_dana_pdam = $dana_pdam->MEI;
                $totJUN = 0; $totJUN_dana_proyek_pdam = 0; $totJUN_apbd = 3310416667;  $totJUN_dana_pdam = $dana_pdam->JUN;
                $totJUL = 0; $totJUL_dana_proyek_pdam = 0; $totJUL_apbd = 4953583333;  $totJUL_dana_pdam = $dana_pdam->JUL;
                $totAGU = 0; $totAGU_dana_proyek_pdam = 0; $totAGU_apbd = 4384833333;  $totAGU_dana_pdam = $dana_pdam->AGU;
                $totSEP = 0; $totSEP_dana_proyek_pdam = 0; $totSEP_apbd = 4184833333;  $totSEP_dana_pdam = $dana_pdam->SEP;
                $totOKT = 0; $totOKT_dana_proyek_pdam = 0; $totOKT_apbd = 3397166667;  $totOKT_dana_pdam = $dana_pdam->OKT;
                $totNOP = 0; $totNOP_dana_proyek_pdam = 0; $totNOP_apbd = 2941666667;  $totNOP_dana_pdam = $dana_pdam->NOP;
                $totDES = 0; $totDES_dana_proyek_pdam = 0; $totDES_apbd = 3191666667;  $totDES_dana_pdam = $dana_pdam->DES;
                $totJML = 0; $totJML_dana_proyek_pdam = 0; $totJML_apbd = 38940000000; $totJML_dana_pdam = $dana_pdam->JML;

                $totJAN_biaya_adm = 15000000;  $totJAN_bagi_laba = ($laba_rugi->JAN * 4) / 10;  $totJAN_csr = ($laba_rugi->JAN * 1) / 10;
                $totFEB_biaya_adm = 15000000;  $totFEB_bagi_laba = 0;                           $totFEB_csr = 0;
                $totMAR_biaya_adm = 15000000;  $totMAR_bagi_laba = 0;                           $totMAR_csr = 0;
                $totAPR_biaya_adm = 15000000;  $totAPR_bagi_laba = 0;                           $totAPR_csr = 0;
                $totMEI_biaya_adm = 15000000;  $totMEI_bagi_laba = 0;                           $totMEI_csr = 0;
                $totJUN_biaya_adm = 15000000;  $totJUN_bagi_laba = 0;                           $totJUN_csr = 0;
                $totJUL_biaya_adm = 15000000;  $totJUL_bagi_laba = 0;                           $totJUL_csr = 0;
                $totAGU_biaya_adm = 15000000;  $totAGU_bagi_laba = 0;                           $totAGU_csr = 0;
                $totSEP_biaya_adm = 15000000;  $totSEP_bagi_laba = 0;                           $totSEP_csr = 0;
                $totOKT_biaya_adm = 15000000;  $totOKT_bagi_laba = 0;                           $totOKT_csr = 0;
                $totNOP_biaya_adm = 15000000;  $totNOP_bagi_laba = 0;                           $totNOP_csr = 0;
                $totDES_biaya_adm = 15000000;  $totDES_bagi_laba = 0;                           $totDES_csr = 0;
                $totJML_biaya_adm = 180000000; $totJML_bagi_laba = ($laba_rugi->JAN * 4) / 10;  $totJML_csr = ($laba_rugi->JAN * 1) / 10;

                $totJML_LALU1 = 0;
                $totJML2_LALU1 = 0;

                $totJML_LALU1_dana_proyek_pdam = 0;

                $totJML_LALU1_apbd = 4879393660;

                $totJML_LALU1_dana_pdam = $dana_pdam->JML_LALU1;

                $totJML_LALU1_biaya_adm = 4879393660;

                $totJML_LALU1_bagi_laba = ($laba_rugi->JML_LALU1 * 4) /10;
                $totJML_LALU1_csr = ($laba_rugi->JML_LALU1 * 1) /10;


                $totJAN_all_2 = $totJAN_dana_proyek_pdam;
                $totFEB_all_2 = $totFEB_dana_proyek_pdam;
                $totMAR_all_2 = $totMAR_dana_proyek_pdam;
                $totAPR_all_2 = $totAPR_dana_proyek_pdam;
                $totMEI_all_2 = $totMEI_dana_proyek_pdam;
                $totJUN_all_2 = $totJUN_dana_proyek_pdam;
                $totJUL_all_2 = $totJUL_dana_proyek_pdam;
                $totAGU_all_2 = $totAGU_dana_proyek_pdam;
                $totSEP_all_2 = $totSEP_dana_proyek_pdam;
                $totOKT_all_2 = $totOKT_dana_proyek_pdam;
                $totNOP_all_2 = $totNOP_dana_proyek_pdam;
                $totDES_all_2 = $totDES_dana_proyek_pdam;
                $totJML_all_2 = $totJML_dana_proyek_pdam;
                $totJML_LALU1_all_2 = $totJML_LALU1_dana_proyek_pdam;

                $totJAN_all_3 = $totJAN_apbd + $totJAN_dana_pdam + $totJAN_biaya_adm + $totJAN_bagi_laba + $totJAN_csr;
                $totFEB_all_3 = $totFEB_apbd + $totFEB_dana_pdam + $totFEB_biaya_adm + $totFEB_bagi_laba + $totFEB_csr;
                $totMAR_all_3 = $totMAR_apbd + $totMAR_dana_pdam + $totMAR_biaya_adm + $totMAR_bagi_laba + $totMAR_csr;
                $totAPR_all_3 = $totAPR_apbd + $totAPR_dana_pdam + $totAPR_biaya_adm + $totAPR_bagi_laba + $totAPR_csr;
                $totMEI_all_3 = $totMEI_apbd + $totMEI_dana_pdam + $totMEI_biaya_adm + $totMEI_bagi_laba + $totMEI_csr;
                $totJUN_all_3 = $totJUN_apbd + $totJUN_dana_pdam + $totJUN_biaya_adm + $totJUN_bagi_laba + $totJUN_csr;
                $totJUL_all_3 = $totJUL_apbd + $totJUL_dana_pdam + $totJUL_biaya_adm + $totJUL_bagi_laba + $totJUL_csr;
                $totAGU_all_3 = $totAGU_apbd + $totAGU_dana_pdam + $totAGU_biaya_adm + $totAGU_bagi_laba + $totAGU_csr;
                $totSEP_all_3 = $totSEP_apbd + $totSEP_dana_pdam + $totSEP_biaya_adm + $totSEP_bagi_laba + $totSEP_csr;
                $totOKT_all_3 = $totOKT_apbd + $totOKT_dana_pdam + $totOKT_biaya_adm + $totOKT_bagi_laba + $totOKT_csr;
                $totNOP_all_3 = $totNOP_apbd + $totNOP_dana_pdam + $totNOP_biaya_adm + $totNOP_bagi_laba + $totNOP_csr;
                $totDES_all_3 = $totDES_apbd + $totDES_dana_pdam + $totDES_biaya_adm + $totDES_bagi_laba + $totDES_csr;
                $totJML_all_3 = $totJML_apbd + $totJML_dana_pdam + $totJML_biaya_adm + $totJML_bagi_laba + $totJML_csr;
                $totJML_LALU1_all_3 = $totJML_LALU1_apbd + $totJML_LALU1_dana_pdam + $totJML_LALU1_biaya_adm + $totJML_LALU1_bagi_laba + $totJML_LALU1_csr;

                $last_key   = end(array_keys($biaya_luar_ush));

                $nomor = 0;

                if( count($biaya_luar_ush) > 0 ) {
                foreach ($biaya_luar_ush as $key => $row) {    
                $nomor++;             

                $judul1 = TRIM($row->INDUK);

                if ($old_judul != $judul1) {
                    $old_judul  = $judul1 ;
                    echo "<tr>";
                    echo "<td class='isi_table' align='center'><b>I</b></td>" ;
                    echo "<td class='isi_table'><b>".$row->INDUK."</b></td>" ;
                    echo "<td class='isi_table'></td>";
                    echo "<td class='isi_table'></td>";
                    echo "<td class='isi_table'></td>";
                    echo "<td class='isi_table'></td>";
                    echo "<td class='isi_table'></td>";
                    echo "<td class='isi_table'></td>";
                    echo "<td class='isi_table'></td>";
                    echo "<td class='isi_table'></td>";
                    echo "<td class='isi_table'></td>";
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

                if($row->JML_LALU1 > 0){
                    $persen = (($row->JML - $row->JML_LALU1) / $row->JML_LALU1) * 100;
                } else if($row->JML_LALU1 == 0 && $row->JML == 0){
                    $persen = 0;
                }

                ?>
                
                <tr>
                    <td class="isi_table"></td>
                    <td class="isi_table"><?=$nomor.". ".$row->NAMA_PERKIRAAN;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->JAN)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->FEB)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->MAR)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->APR)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->MEI)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->JUN)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->JUL)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->AGU)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->SEP)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->OKT)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->NOP)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->DES)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->JML)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->JML_LALU1)) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->JML - $row->JML_LALU1))) ;?></td>
                    <td class="isi_table"text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format($persen))) ;?></td>
                </tr>


                <?PHP 

                $JAN   = str_replace(',', '.', $row->JAN);
                $FEB   = str_replace(',', '.', $row->FEB);
                $MAR   = str_replace(',', '.', $row->MAR);
                $APR   = str_replace(',', '.', $row->APR);
                $MEI   = str_replace(',', '.', $row->MEI);
                $JUN   = str_replace(',', '.', $row->JUN);
                $JUL   = str_replace(',', '.', $row->JUL);
                $AGU   = str_replace(',', '.', $row->AGU);
                $SEP   = str_replace(',', '.', $row->SEP);
                $OKT   = str_replace(',', '.', $row->OKT);
                $NOP   = str_replace(',', '.', $row->NOP);
                $DES   = str_replace(',', '.', $row->DES);
                $JML   = str_replace(',', '.', $row->JML);
                $JML_LALU1   = str_replace(',', '.', $row->JML_LALU1);

                if ($key < $last_key) {
                $k          = $key + 1;
                $next_judul1    = $biaya_luar_ush[$k]->INDUK ;
                }
                else{
                    $next_judul1    = "" ;
                }

                $totJAN += $JAN;
                $totFEB += $FEB;
                $totMAR += $MAR;
                $totAPR += $APR;
                $totMEI += $MEI;
                $totJUN += $JUN;
                $totJUL += $JUL;
                $totAGU += $AGU;
                $totSEP += $SEP;
                $totOKT += $OKT;
                $totNOP += $NOP;
                $totDES += $DES;
                $totJML += $JML;
                $totJML_LALU1 += $JML_LALU1;
                

                $persen2 = 100;

                if($totJML_LALU1 > 0){
                    $persen2 = (($totJML - $totJML_LALU1) / $totJML_LALU1) * 100;
                } else if($totJML_LALU1  == 0 && $totJML == 0){
                    $persen2 = 0;
                }

                if ($judul1 != $next_judul1) {
                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>Jumlah ".ucwords(strtolower($row->INDUK))."</b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJAN))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totFEB))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totMAR))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totAPR))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totMEI))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJUN))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJUL))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totAGU))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totSEP))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totOKT))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totNOP))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totDES))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJML))."</b></td>";  

                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJML_LALU1))."</b></td>"; 
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML - $totJML_LALU1)))."</b></td>"; 
                    echo "<td class='isi_table' text-align='center'><b>".format_akuntansi(str_replace(',', '.', number_format($persen2)))."</b></td>";               
                    echo "</tr>";

                }

                }
            ?>

            <tr>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
            </tr>

            <tr>
                <td class="isi_table" style="text-align:center;"> <b>II</b> </td>
                <td class="isi_table"><b>PENGELUARAN ADMINISTRASI DAN KONSULTAN</b></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
            </tr>

            <tr>
                <td class="isi_table"></td>
                <td class="isi_table">Proyek (Dana PDAM)</td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJAN_dana_proyek_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totFEB_dana_proyek_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totMAR_dana_proyek_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totAPR_dana_proyek_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totMEI_dana_proyek_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJUN_dana_proyek_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJUL_dana_proyek_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totAGU_dana_proyek_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totSEP_dana_proyek_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totOKT_dana_proyek_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totNOP_dana_proyek_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totDES_dana_proyek_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJML_dana_proyek_pdam)) ;?></td>

                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJML_LALU1_dana_proyek_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($totJML_dana_proyek_pdam - $totJML_LALU1_dana_proyek_pdam))) ;?></td>
                <td class="isi_table" text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format(0))) ;?></td>
            </tr>

            <tr>
                <td class="isi_table"></td>
                <td class="isi_table" align="right"><b>Jumlah Pengeluaran Adm & Konsultan</b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJAN_dana_proyek_pdam)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totFEB_dana_proyek_pdam)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totMAR_dana_proyek_pdam)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totAPR_dana_proyek_pdam)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totMEI_dana_proyek_pdam)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJUN_dana_proyek_pdam)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJUL_dana_proyek_pdam)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totAGU_dana_proyek_pdam)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totSEP_dana_proyek_pdam)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totOKT_dana_proyek_pdam)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totNOP_dana_proyek_pdam)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totDES_dana_proyek_pdam)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJML_dana_proyek_pdam)) ;?></b></td>

                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJML_LALU1_dana_proyek_pdam)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=format_akuntansi(str_replace(',', '.', number_format($totJML_dana_proyek_pdam - $totJML_LALU1_dana_proyek_pdam))) ;?></b></td>
                <td class="isi_table" text-align="center"><b><?=format_akuntansi(str_replace(',', '.', number_format(0))) ;?></b></td>
            </tr>

            <tr>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
            </tr>

            <tr>
                <td class="isi_table" style="text-align:center;"> <b>III</b> </td>
                <td class="isi_table"><b>PENGELUARAN NON OPERASI LAINNYA</b></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
            </tr>

            <tr>

                <?PHP 
                $persen_apbd = 100;

                if($totJML_LALU1_apbd > 0){
                    $persen_apbd = (($totJML_apbd - $totJML_LALU1_apbd) / $totJML_LALU1_apbd) * 100;
                } else if($totJML_LALU1_apbd  == 0 && $totJML_apbd == 0){
                    $persen_apbd = 0;
                }
                ?>
                <td class="isi_table"></td>
                <td class="isi_table">I. BANTUAN DARI DANA APBD (PENYERTAAN MODAL)</td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJAN_apbd)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totFEB_apbd)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totMAR_apbd)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totAPR_apbd)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totMEI_apbd)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJUN_apbd)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJUL_apbd)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totAGU_apbd)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totSEP_apbd)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totOKT_apbd)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totNOP_apbd)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totDES_apbd)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJML_apbd)) ;?></td>

                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJML_LALU1_apbd)) ;?></td>
                <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($totJML_apbd - $totJML_LALU1_apbd))) ;?></td>
                <td class="isi_table" text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format($persen_apbd))) ;?></td>
            </tr>

            <tr>
                <?PHP 
                $persen_dana_pdam = 100;

                if($totJML_LALU1_dana_pdam > 0){
                    $persen_dana_pdam = (($totJML_dana_pdam - $totJML_LALU1_dana_pdam) / $totJML_LALU1_dana_pdam) * 100;
                } else if($totJML_LALU1_dana_pdam  == 0 && $totJML_dana_pdam == 0){
                    $persen_dana_pdam = 0;
                }
                ?>
                <td class="isi_table"></td>
                <td class="isi_table">II. DANA PDAM</td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJAN_dana_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totFEB_dana_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totMAR_dana_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totAPR_dana_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totMEI_dana_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJUN_dana_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJUL_dana_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totAGU_dana_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totSEP_dana_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totOKT_dana_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totNOP_dana_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totDES_dana_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJML_dana_pdam)) ;?></td>

                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJML_LALU1_dana_pdam)) ;?></td>
                <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($totJML_dana_pdam - $totJML_LALU1_dana_pdam))) ;?></td>
                <td class="isi_table" text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format($persen_dana_pdam))) ;?></td>
            </tr>

            <tr>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
            </tr>

            <tr>
                <td class="isi_table"></td>
                <td class="isi_table">Dana PDAM Tirta Patriot</td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
            </tr>

            <tr>
                <?PHP 
                $persen_biaya_adm = 100;

                if($totJML_LALU1_biaya_adm > 0){
                    $persen_biaya_adm = (($totJML_biaya_adm - $totJML_LALU1_biaya_adm) / $totJML_LALU1_biaya_adm) * 100;
                } else if($totJML_LALU1_biaya_adm  == 0 && $totJML_biaya_adm == 0){
                    $persen_biaya_adm = 0;
                }
                ?>
                <td class="isi_table" align="center">1</td>
                <td class="isi_table">Biaya Administrasi Proyek</td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJAN_biaya_adm)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totFEB_biaya_adm)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totMAR_biaya_adm)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totAPR_biaya_adm)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totMEI_biaya_adm)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJUN_biaya_adm)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJUL_biaya_adm)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totAGU_biaya_adm)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totSEP_biaya_adm)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totOKT_biaya_adm)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totNOP_biaya_adm)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totDES_biaya_adm)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJML_biaya_adm)) ;?></td>

                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJML_LALU1_biaya_adm)) ;?></td>
                <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($totJML_biaya_adm - $totJML_LALU1_biaya_adm))) ;?></td>
                <td class="isi_table" text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format($persen_biaya_adm))) ;?></td>
            </tr>

            <tr>
                <?PHP 
                $persen_bagi_laba = 100;

                if($totJML_LALU1_bagi_laba > 0){
                    $persen_bagi_laba = (($totJAN_bagi_laba - $totJML_LALU1_bagi_laba) / $totJML_LALU1_bagi_laba) * 100;
                } else if($totJML_LALU1_bagi_laba  == 0 && $totJAN_bagi_laba == 0){
                    $persen_bagi_laba = 0;
                }
                ?>
                <td class="isi_table" align="center">2</td>
                <td class="isi_table">Pembagian Laba</td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJAN_bagi_laba)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totFEB_bagi_laba)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totMAR_bagi_laba)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totAPR_bagi_laba)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totMEI_bagi_laba)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJUN_bagi_laba)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJUL_bagi_laba)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totAGU_bagi_laba)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totSEP_bagi_laba)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totOKT_bagi_laba)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totNOP_bagi_laba)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totDES_bagi_laba)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJAN_bagi_laba)) ;?></td>

                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJML_LALU1_bagi_laba)) ;?></td>
                <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($totJAN_bagi_laba - $totJML_LALU1_bagi_laba))) ;?></td>
                <td class="isi_table" text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format($persen_bagi_laba))) ;?></td>
            </tr>

            <tr>
                <?PHP 
                $persen_csr = 100;

                if($totJML_LALU1_csr > 0){
                    $persen_csr = (($totJAN_csr - $totJML_LALU1_csr) / $totJML_LALU1_csr) * 100;
                } else if($totJML_LALU1_csr  == 0 && $totJAN_csr == 0){
                    $persen_csr = 0;
                }
                ?>
                <td class="isi_table" align="center">3</td>
                <td class="isi_table">CSR</td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJAN_csr)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totFEB_csr)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totMAR_csr)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totAPR_csr)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totMEI_csr)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJUN_csr)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJUL_csr)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totAGU_csr)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totSEP_csr)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totOKT_csr)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totNOP_csr)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totDES_csr)) ;?></td>
                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJAN_csr)) ;?></td>

                <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($totJML_LALU1_csr)) ;?></td>
                <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($totJAN_csr - $totJML_LALU1_csr))) ;?></td>
                <td class="isi_table" text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format($persen_csr))) ;?></td>
            </tr>

            <tr>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
            </tr>


            <tr>
                <?PHP 
                $persen_3 = 100;

                if($totJML_LALU1_all_3 > 0){
                    $persen_3 = (($totJML_all_3 - $totJML_LALU1_all_3) / $totJML_LALU1_all_3) * 100;
                } else if($totJML_LALU1_all_3  == 0 && $totJML_all_3 == 0){
                    $persen_3 = 0;
                }
                ?>
                <td class="isi_table"></td>
                <td class="isi_table" align="right"><b>Jumlah Pengeluaran Non Operasi Lainnya</b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJAN_all_3)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totFEB_all_3)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totMAR_all_3)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totAPR_all_3)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totMEI_all_3)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJUN_all_3)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJUL_all_3)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totAGU_all_3)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totSEP_all_3)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totOKT_all_3)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totNOP_all_3)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totDES_all_3)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJML_all_3)) ;?></b></td>

                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJML_LALU1_all_3)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=format_akuntansi(str_replace(',', '.', number_format($totJML_all_3 - $totJML_LALU1_all_3))) ;?></b></td>
                <td class="isi_table" text-align="center"><b><?=format_akuntansi(str_replace(',', '.', number_format($persen_3))) ;?></b></td>
            </tr>

            <tr>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
                <td class="isi_table"></td>
            </tr>


            <?PHP 
            $totJAN_all = $totJAN_all_2 + $totJAN_all_3 + $totJAN;
            $totFEB_all = $totFEB_all_2 + $totFEB_all_3 + $totFEB;
            $totMAR_all = $totMAR_all_2 + $totMAR_all_3 + $totMAR;
            $totAPR_all = $totAPR_all_2 + $totAPR_all_3 + $totAPR;
            $totMEI_all = $totMEI_all_2 + $totMEI_all_3 + $totMEI;
            $totJUN_all = $totJUN_all_2 + $totJUN_all_3 + $totJUN;
            $totJUL_all = $totJUL_all_2 + $totJUL_all_3 + $totJUL;
            $totAGU_all = $totAGU_all_2 + $totAGU_all_3 + $totAGU;
            $totSEP_all = $totSEP_all_2 + $totSEP_all_3 + $totSEP;
            $totOKT_all = $totOKT_all_2 + $totOKT_all_3 + $totOKT;
            $totNOP_all = $totNOP_all_2 + $totNOP_all_3 + $totNOP;
            $totDES_all = $totDES_all_2 + $totDES_all_3 + $totDES;
            $totJML_all = $totJML_all_2 + $totJML_all_3 + $totJML;
            $totJML_LALU1_all = $totJML_LALU1_all_2 + $totJML_LALU1_all_3 +  $totJML_LALU1;


            $persen_all = 100;

            if($totJML_LALU1_all > 0){
                $persen_all = (($totJML_all - $totJML_LALU1_all) / $totJML_LALU1_all) * 100;
            } else if($totJML_LALU1_all  == 0 && $totJML_all == 0){
                $persen_all = 0;
            }
                

            ?>


            <tr>
                <td class="isi_table"></td>
                <td class="isi_table" align="center"><b>Jumlah Pengeluaran Non Operasi</b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJAN_all)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totFEB_all)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totMAR_all)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totAPR_all)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totMEI_all)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJUN_all)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJUL_all)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totAGU_all)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totSEP_all)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totOKT_all)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totNOP_all)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totDES_all)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJML_all)) ;?></b></td>

                <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJML_LALU1_all)) ;?></b></td>
                <td class="isi_table" text-align="right"><b><?=format_akuntansi(str_replace(',', '.', number_format($totJML_all - $totJML_LALU1_all))) ;?></b></td>
                <td class="isi_table" text-align="center"><b><?=format_akuntansi(str_replace(',', '.', number_format($persen_all))) ;?></b></td>
            </tr>




            <?PHP 
            } else { ?>

            <tr>
                    <td class="isi_table" style="text-align:center;" colspan="18"> <b> Tidak ada data </b> </td>
            </tr>

            <?PHP }
            ?>
            </tbody>
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

