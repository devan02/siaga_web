<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Proyeksi_laba_rugi.xls");
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
                        PROYEKSI LABA RUGI <br>
                         TAHUN ANGGARAN : <?=$thn;?> (<?=$ket_periode;?>)
                    </h3>
                </td>
            </tr>

        </table>           
        

        <br><br>

        <table class="grid">
            <thead>
                <tr>
                    <th class="kolom_header" rowspan="2"> NOMOR PERKIRAAN</th>
                    <th class="kolom_header" rowspan="2"> URAIAN </th>
                    <th class="kolom_header" colspan="12"> BULAN </th>
                    <th class="kolom_header" rowspan="2"> JUMLAH </th>
                    <th class="kolom_header" rowspan="2"> ESTIMASI TAHUN <?=$thn-1;?> </th>
                    <th class="kolom_header" rowspan="2"> ESTIMASI TAHUN <?=$thn-2;?> </th>
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
                $totJAN = 0;
                $totFEB = 0;
                $totMAR = 0;
                $totAPR = 0;
                $totMEI = 0;
                $totJUN = 0;
                $totJUL = 0;
                $totAGU = 0;
                $totSEP = 0;
                $totOKT = 0;
                $totNOP = 0;
                $totDES = 0;
                $totJML = 0;
                $totJML_LALU1 = 0;
                $totJML_LALU2 = 0;

                $totJAN_pend = 0;
                $totFEB_pend = 0;
                $totMAR_pend = 0;
                $totAPR_pend = 0;
                $totMEI_pend = 0;
                $totJUN_pend = 0;
                $totJUL_pend = 0;
                $totAGU_pend = 0;
                $totSEP_pend = 0;
                $totOKT_pend = 0;
                $totNOP_pend = 0;
                $totDES_pend = 0;
                $totJML_pend = 0;
                $totJML_LALU1_pend = 0;
                $totJML_LALU2_pend = 0;

                $totJAN_biaya_lgs = 0 ;
                $totFEB_biaya_lgs = 0 ;
                $totMAR_biaya_lgs = 0 ;
                $totAPR_biaya_lgs = 0 ;
                $totMEI_biaya_lgs = 0 ;
                $totJUN_biaya_lgs = 0 ;
                $totJUL_biaya_lgs = 0 ;
                $totAGU_biaya_lgs = 0 ;
                $totSEP_biaya_lgs = 0 ;
                $totOKT_biaya_lgs = 0 ;
                $totNOP_biaya_lgs = 0 ;
                $totDES_biaya_lgs = 0 ;
                $totJML_biaya_lgs = 0 ;
                $totJML_LALU1_biaya_lgs = 0;
                $totJML_LALU2_biaya_lgs = 0;

                $totJAN_biaya_tdk_lgs = 0;
                $totFEB_biaya_tdk_lgs = 0;
                $totMAR_biaya_tdk_lgs = 0;
                $totAPR_biaya_tdk_lgs = 0;
                $totMEI_biaya_tdk_lgs = 0;
                $totJUN_biaya_tdk_lgs = 0;
                $totJUL_biaya_tdk_lgs = 0;
                $totAGU_biaya_tdk_lgs = 0;
                $totSEP_biaya_tdk_lgs = 0;
                $totOKT_biaya_tdk_lgs = 0;
                $totNOP_biaya_tdk_lgs = 0;
                $totDES_biaya_tdk_lgs = 0;
                $totJML_biaya_tdk_lgs = 0;
                $totJML_LALU1_biaya_biaya_tdk_lgs = 0;
                $totJML_LALU2_biaya_biaya_tdk_lgs = 0;

                $totJAN_pend_biaya_luar = 0;
                $totFEB_pend_biaya_luar = 0;
                $totMAR_pend_biaya_luar = 0;
                $totAPR_pend_biaya_luar = 0;
                $totMEI_pend_biaya_luar = 0;
                $totJUN_pend_biaya_luar = 0;
                $totJUL_pend_biaya_luar = 0;
                $totAGU_pend_biaya_luar = 0;
                $totSEP_pend_biaya_luar = 0;
                $totOKT_pend_biaya_luar = 0;
                $totNOP_pend_biaya_luar = 0;
                $totDES_pend_biaya_luar = 0;
                $totJML_pend_biaya_luar = 0;
                $totJML_LALU1_pend_biaya_luar= 0;
                $totJML_LALU2_pend_biaya_luar = 0;

                $laba_sblm_pajak = 0;
                $totpph29 = 0;
                $totpph29_lalu1 = 0;
                $totpph29_lalu2 = 0;

                $pph29_lalu1 = 0;
                $laba_sblm_pajak_lalu1 = 0;
                $pph29_lalu2 = 0;
                $laba_sblm_pajak_lalu2 = 0;

                $last_key   = end(array_keys($dt));

                if( count($dt) > 0 ) {
                foreach ($dt as $key => $row) { 

                $nama_perk = $row->NAMA_PERKIRAAN;                

                $judul1 = TRIM($row->INDUK);

                if ($old_judul != $judul1) {
                    $old_judul  = $judul1 ;
                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
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
                    echo "<td class='isi_table'></td>";
                    echo "</tr>";
                }

                if($row->INDUK == "KEUNTUNGAN ( KERUGIAN ) LUAR BIASA"){ 
                    if($row->KODE_PERKIRAAN == "98.00.00"){
                        $nama_perk = "Kerugian Luar Biasa";
                    }
                ?> 

                <tr>
                    <td class="isi_table" style="text-align:center;"><?=$row->KODE_PERKIRAAN;?></td>
                    <td class="isi_table"><?=ucwords(strtolower($nama_perk));?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>

                    <td class="isi_table" text-align="right"> 0 </td>
                    <td class="isi_table" text-align="right"> 0 </td>
                    <td class="isi_table" text-align="right"> 0 </td>
                    <td class="isi_table" text-align="center"> 0 </td>
                </tr>

                <?PHP } else { 

                    $persen = 100;

                    if($row->JML_LALU1 > 0){
                        $persen = (($row->JML - $row->JML_LALU1) / $row->JML_LALU1) * 100;
                    } else if($row->JML_LALU1 == 0 && $row->JML == 0){
                        $persen = 0;
                    }

                ?>
                <tr>
                    <td class="isi_table" style="text-align:center;"><?=$row->KODE_PERKIRAAN;?></td>
                    <td class="isi_table" ><?=ucwords(strtolower($row->NAMA_PERKIRAAN));?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->JAN))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->FEB))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->MAR))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->APR))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->MEI))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->JUN))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->JUL))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->AGU))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->SEP))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->OKT))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->NOP))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->DES))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->JML))) ;?></td>

                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->JML_LALU1))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->JML_LALU2))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->JML -  $row->JML_LALU1))) ;?></td>
                    <td class="isi_table" text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format($persen))) ;?></td>
                </tr>

                <?PHP if($row->KODE_PERKIRAAN == "96.00.00"){ 

                $persen_susut1 = 100;

                if($susut1->JML_LALU1 > 0){
                    $persen_susut1 = (($susut1->JML - $susut1->JML_LALU1) / $susut1->JML_LALU1) * 100;
                } else if($susut1->JML_LALU1 == 0 && $susut1->JML == 0){
                    $persen_susut1 = 0;
                }

                $persen_susut2 = 100;

                if($susut2->JML_LALU1 > 0){
                    $persen_susut2 = (($susut2->JML - $susut2->JML_LALU1) / $susut2->JML_LALU1) * 100;
                } else if($susut2->JML_LALU1 == 0 && $susut2->JML == 0){
                    $persen_susut2 = 0;
                }

                ?> 
                <tr>
                    <td class="isi_table" style="text-align:center;"></td>
                    <td class="isi_table">Biaya Penyusutan thn Berjalan X NP</td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut1->JAN))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut1->FEB))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut1->MAR))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut1->APR))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut1->MEI))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut1->JUN))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut1->JUL))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut1->AGU))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut1->SEP))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut1->OKT))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut1->NOP))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut1->DES))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut1->JML))) ;?></td>

                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut1->JML_LALU1))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut1->JML_LALU2))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut1->JML -  $susut1->JML_LALU1))) ;?></td>
                    <td class="isi_table" text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format($persen_susut1))) ;?></td>
                </tr>

                <tr>
                    <td class="isi_table" style="text-align:center;"></td>
                    <td class="isi_table">Biaya Penyusutan Thn Sebelumnya X NB</td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut2->JAN))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut2->FEB))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut2->MAR))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut2->APR))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut2->MEI))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut2->JUN))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut2->JUL))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut2->AGU))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut2->SEP))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut2->OKT))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut2->NOP))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut2->DES))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut2->JML))) ;?></td>

                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut2->JML_LALU1))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut2->JML_LALU2))) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut2->JML -  $susut2->JML_LALU1))) ;?></td>
                    <td class="isi_table" text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format($persen_susut2))) ;?></td>
                </tr>

                <?PHP } ?>

                <?PHP 
                }
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
                $JML_LALU2   = str_replace(',', '.', $row->JML_LALU2);

                if ($key < $last_key) {
                $k          = $key + 1;
                $next_judul1    = $dt[$k]->INDUK ;
                }
                else{
                    $next_judul1    = "" ;
                }

                if($row->INDUK == "PENDAPATAN / (BIAYA) DILUAR USAHA"){

                $totJAN -= $JAN;
                $totFEB -= $FEB;
                $totMAR -= $MAR;
                $totAPR -= $APR;
                $totMEI -= $MEI;
                $totJUN -= $JUN;
                $totJUL -= $JUL;
                $totAGU -= $AGU;
                $totSEP -= $SEP;
                $totOKT -= $OKT;
                $totNOP -= $NOP;
                $totDES -= $DES;
                $totJML -= $JML;
                $totJML_LALU1 -= $JML_LALU1;
                $totJML_LALU2 -= $JML_LALU2;

                } else {

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
                $totJML_LALU2 += $JML_LALU2;

                }

                if($row->INDUK == "PENDAPATAN USAHA"){
                    $totJAN_pend = $totJAN; 
                    $totFEB_pend = $totFEB;
                    $totMAR_pend = $totMAR;
                    $totAPR_pend = $totAPR;
                    $totMEI_pend = $totMEI;
                    $totJUN_pend = $totJUN;
                    $totJUL_pend = $totJUL;
                    $totAGU_pend = $totAGU;
                    $totSEP_pend = $totSEP;
                    $totOKT_pend = $totOKT;
                    $totNOP_pend = $totNOP;
                    $totDES_pend = $totDES;
                    $totJML_pend = $totJML;
                    $totJML_LALU1_pend = $totJML_LALU1;
                    $totJML_LALU2_pend = $totJML_LALU2;
                }

                if($row->INDUK == "BIAYA LANGSUNG USAHA"){
                    $totJAN_biaya_lgs = $totJAN; 
                    $totFEB_biaya_lgs = $totFEB;
                    $totMAR_biaya_lgs = $totMAR;
                    $totAPR_biaya_lgs = $totAPR;
                    $totMEI_biaya_lgs = $totMEI;
                    $totJUN_biaya_lgs = $totJUN;
                    $totJUL_biaya_lgs = $totJUL;
                    $totAGU_biaya_lgs = $totAGU;
                    $totSEP_biaya_lgs = $totSEP;
                    $totOKT_biaya_lgs = $totOKT;
                    $totNOP_biaya_lgs = $totNOP;
                    $totDES_biaya_lgs = $totDES;
                    $totJML_biaya_lgs = $totJML;
                    $totJML_LALU1_biaya_lgs = $totJML_LALU1;
                    $totJML_LALU2_biaya_lgs = $totJML_LALU2;
                }

                if($row->INDUK == "BIAYA TIDAK LANGSUNG USAHA"){
                    $totJAN_biaya_tdk_lgs = $totJAN + $susut1->JAN + $susut2->JAN; 
                    $totFEB_biaya_tdk_lgs = $totFEB + $susut1->FEB + $susut2->FEB;
                    $totMAR_biaya_tdk_lgs = $totMAR + $susut1->MAR + $susut2->MAR;
                    $totAPR_biaya_tdk_lgs = $totAPR + $susut1->APR + $susut2->APR;
                    $totMEI_biaya_tdk_lgs = $totMEI + $susut1->MEI + $susut2->MEI;
                    $totJUN_biaya_tdk_lgs = $totJUN + $susut1->JUN + $susut2->JUN;
                    $totJUL_biaya_tdk_lgs = $totJUL + $susut1->JUL + $susut2->JUL;
                    $totAGU_biaya_tdk_lgs = $totAGU + $susut1->AGU + $susut2->AGU;
                    $totSEP_biaya_tdk_lgs = $totSEP + $susut1->SEP + $susut2->SEP;
                    $totOKT_biaya_tdk_lgs = $totOKT + $susut1->OKT + $susut2->OKT;
                    $totNOP_biaya_tdk_lgs = $totNOP + $susut1->NOP + $susut2->NOP;
                    $totDES_biaya_tdk_lgs = $totDES + $susut1->DES + $susut2->DES;
                    $totJML_biaya_tdk_lgs = $totJML + $susut1->JML + $susut2->JML;
                    $totJML_LALU1_biaya_biaya_tdk_lgs = $totJML_LALU1 + $susut1->JML_LALU1 + $susut2->JML_LALU1;
                    $totJML_LALU2_biaya_biaya_tdk_lgs = $totJML_LALU2 + $susut1->JML_LALU2 + $susut2->JML_LALU2;
                }

                if($row->INDUK == "PENDAPATAN / (BIAYA) DILUAR USAHA"){
                    $totJAN_pend_biaya_luar = $totJAN; 
                    $totFEB_pend_biaya_luar = $totFEB;
                    $totMAR_pend_biaya_luar = $totMAR;
                    $totAPR_pend_biaya_luar = $totAPR;
                    $totMEI_pend_biaya_luar = $totMEI;
                    $totJUN_pend_biaya_luar = $totJUN;
                    $totJUL_pend_biaya_luar = $totJUL;
                    $totAGU_pend_biaya_luar = $totAGU;
                    $totSEP_pend_biaya_luar = $totSEP;
                    $totOKT_pend_biaya_luar = $totOKT;
                    $totNOP_pend_biaya_luar = $totNOP;
                    $totDES_pend_biaya_luar = $totDES;
                    $totJML_pend_biaya_luar = $totJML;
                    $totJML_LALU1_pend_biaya_luar = $totJML_LALU1;
                    $totJML_LALU2_pend_biaya_luar = $totJML_LALU2;
                }



                if ($judul1 != $next_judul1 && $row->INDUK != "KEUNTUNGAN ( KERUGIAN ) LUAR BIASA") {

                    $persen = 100;

                    if($totJML_LALU1 > 0){
                        $persen = (($totJML - $totJML_LALU1) / $totJML_LALU1) * 100;
                    } else if($totJML_LALU1  == 0 && $totJML == 0){
                        $persen = 0;
                    }

                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>Jumlah ".ucwords(strtolower($row->INDUK))."</b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJAN)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totFEB)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totMAR)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totAPR)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totMEI)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJUN)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJUL)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totAGU)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totSEP)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totOKT)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totNOP)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totDES)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML)))."</b></td>";

                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_LALU1)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_LALU2)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML - $totJML_LALU1)))."</b></td>";                  
                    echo "<td class='isi_table' text-align='center'><b>".format_akuntansi(str_replace(',', '.', number_format($persen)))."</b></td>";                  
                    echo "</tr>";

                    $totJAN = 0;
                    $totFEB = 0;
                    $totMAR = 0;
                    $totAPR = 0;
                    $totMEI = 0;
                    $totJUN = 0;
                    $totJUL = 0;
                    $totAGU = 0;
                    $totSEP = 0;
                    $totOKT = 0;
                    $totNOP = 0;
                    $totDES = 0;
                    $totJML = 0;
                    $totJML_LALU1 = 0;
                    $totJML_LALU2 = 0;
                

                }


                if($judul1 != $next_judul1 && $row->INDUK == "BIAYA LANGSUNG USAHA"){

                    $persen = 100;

                    if($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs > 0){
                        $persen = ( ( ($totJML_pend - $totJML_biaya_lgs) - ($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs) ) / ($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs) ) * 100;
                    } else if($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs == 0 && $totJML_pend - $totJML_biaya_lgs == 0){
                        $persen = 0;
                    }

                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
                    echo "<td class='isi_table' text-align='left'><b>Laba / ( Rugi ) Kotor Usaha</b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJAN_pend - $totJAN_biaya_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totFEB_pend - $totFEB_biaya_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totMAR_pend - $totMAR_biaya_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totAPR_pend - $totAPR_biaya_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totMEI_pend - $totMEI_biaya_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJUN_pend - $totJUN_biaya_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJUL_pend - $totJUL_biaya_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totAGU_pend - $totAGU_biaya_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totSEP_pend - $totSEP_biaya_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totOKT_pend - $totOKT_biaya_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totNOP_pend - $totNOP_biaya_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totDES_pend - $totDES_biaya_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_pend - $totJML_biaya_lgs)))."</b></td>";

                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_LALU2_pend - $totJML_LALU2_biaya_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format( ($totJML_pend - $totJML_biaya_lgs) - ($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs) )))."</b></td>";                  
                    echo "<td class='isi_table' text-align='center'><b>".format_akuntansi(str_replace(',', '.', number_format($persen)))."</b></td>";                       
                    echo "</tr>";
                }

                if($judul1 != $next_judul1 && $row->INDUK == "BIAYA TIDAK LANGSUNG USAHA"){

                    $persen = 100;

                    if( $totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs > 0){
                        $persen = ( ( ($totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs) - ($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs) ) / ($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs) ) * 100;
                    } else if($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs == 0 && $totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs == 0){
                        $persen = 0;
                    }

                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
                    echo "<td class='isi_table' text-align='left'><b>Laba / ( Rugi )  Usaha</b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJAN_pend - $totJAN_biaya_lgs - $totJAN_biaya_tdk_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totFEB_pend - $totFEB_biaya_lgs - $totFEB_biaya_tdk_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totMAR_pend - $totMAR_biaya_lgs - $totMAR_biaya_tdk_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totAPR_pend - $totAPR_biaya_lgs - $totAPR_biaya_tdk_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totMEI_pend - $totMEI_biaya_lgs - $totMEI_biaya_tdk_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJUN_pend - $totJUN_biaya_lgs - $totJUN_biaya_tdk_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJUL_pend - $totJUL_biaya_lgs - $totJUL_biaya_tdk_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totAGU_pend - $totAGU_biaya_lgs - $totAGU_biaya_tdk_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totSEP_pend - $totSEP_biaya_lgs - $totSEP_biaya_tdk_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totOKT_pend - $totOKT_biaya_lgs - $totOKT_biaya_tdk_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totNOP_pend - $totNOP_biaya_lgs - $totNOP_biaya_tdk_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totDES_pend - $totDES_biaya_lgs - $totDES_biaya_tdk_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs)))."</b></td>";

                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_LALU2_pend - $totJML_LALU2_biaya_lgs - $totJML_LALU2_biaya_biaya_tdk_lgs)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format( ($totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs) - ($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs) )))."</b></td>";                  
                    echo "<td class='isi_table' text-align='center'><b>".format_akuntansi(str_replace(',', '.', number_format($persen)))."</b></td>";                     
                    echo "</tr>";
                }

                if($judul1 != $next_judul1 && $row->INDUK == "PENDAPATAN / (BIAYA) DILUAR USAHA"){

                    $persen = 100;

                    if($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar > 0){

                        $persen = ( ( ($totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar) - ($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar) ) / ($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar) ) * 100;
                    
                    } else if($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar == 0 && $totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar == 0){
                       
                        $persen = 0;
                    }

                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
                    echo "<td class='isi_table' text-align='left'><b>Laba / ( Rugi ) Sebelum Pos Luar Biasa</b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJAN_pend - $totJAN_biaya_lgs - $totJAN_biaya_tdk_lgs + $totJAN_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totFEB_pend - $totFEB_biaya_lgs - $totFEB_biaya_tdk_lgs + $totFEB_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totMAR_pend - $totMAR_biaya_lgs - $totMAR_biaya_tdk_lgs + $totMAR_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totAPR_pend - $totAPR_biaya_lgs - $totAPR_biaya_tdk_lgs + $totAPR_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totMEI_pend - $totMEI_biaya_lgs - $totMEI_biaya_tdk_lgs + $totMEI_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJUN_pend - $totJUN_biaya_lgs - $totJUN_biaya_tdk_lgs + $totJUN_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJUL_pend - $totJUL_biaya_lgs - $totJUL_biaya_tdk_lgs + $totJUL_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totAGU_pend - $totAGU_biaya_lgs - $totAGU_biaya_tdk_lgs + $totAGU_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totSEP_pend - $totSEP_biaya_lgs - $totSEP_biaya_tdk_lgs + $totSEP_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totOKT_pend - $totOKT_biaya_lgs - $totOKT_biaya_tdk_lgs + $totOKT_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totNOP_pend - $totNOP_biaya_lgs - $totNOP_biaya_tdk_lgs + $totNOP_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totDES_pend - $totDES_biaya_lgs - $totDES_biaya_tdk_lgs + $totDES_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar)))."</b></td>";

                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_LALU2_pend - $totJML_LALU2_biaya_lgs - $totJML_LALU2_biaya_biaya_tdk_lgs + $totJML_LALU2_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format( ($totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar) - ($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar) )))."</b></td>";                  
                    echo "<td class='isi_table' text-align='center'><b>".format_akuntansi(str_replace(',', '.', number_format($persen)))."</b></td>";                      
                    echo "</tr>";
                }

                if($judul1 != $next_judul1 && $row->INDUK == "KEUNTUNGAN ( KERUGIAN ) LUAR BIASA"){

                    $persen = 100;

                    if($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar > 0){

                        $persen = ( ( ($totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar) - ($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar) ) / ($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar) ) * 100;
                    
                    } else if($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar == 0 && $totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar == 0){
                       
                        $persen = 0;
                    }

                    if($pph29 == null || $pph29 == ""){

                      $laba_sblm_pajak = $totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar;
                      $totpph29 = $laba_sblm_pajak;
                      $totpph29 = ($totpph29 * 25) / 100;  

                    } else {

                      $laba_sblm_pajak = $totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar;
                      $totpph29 = $laba_sblm_pajak + ($pph29->TOTAL1 - $pph29->TOTAL2);
                      $totpph29 = ($totpph29 * 25) / 100;  

                    }


                    if($pph29_lalu1 == null || $pph29_lalu1 == ""){

                      $laba_sblm_pajak_lalu1 = $totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar;
                      $totpph29_lalu1 = $laba_sblm_pajak_lalu1;
                      $totpph29_lalu1 = ($totpph29_lalu1 * 25) / 100;  

                    } else {

                      $laba_sblm_pajak_lalu1 = $totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar;
                      $totpph29_lalu1 = $laba_sblm_pajak_lalu1 + ($pph29_lalu1->TOTAL1 - $pph29_lalu1->TOTAL2);
                      $totpph29_lalu1 = ($totpph29_lalu1 * 25) / 100;  

                    }


                    if($pph29_lalu2 == null || $pph29_lalu2 == ""){

                      $laba_sblm_pajak_lalu2 = $totJML_LALU2_pend - $totJML_LALU2_biaya_lgs - $totJML_LALU2_biaya_biaya_tdk_lgs + $totJML_LALU2_pend_biaya_luar;
                      $totpph29_lalu2 = $laba_sblm_pajak_lalu2;
                      $totpph29_lalu2 = ($totpph29_lalu2 * 25) / 100;  

                    } else {

                      $laba_sblm_pajak_lalu2 = $totJML_LALU2_pend - $totJML_LALU2_biaya_lgs - $totJML_LALU2_biaya_biaya_tdk_lgs + $totJML_LALU2_pend_biaya_luar;
                      $totpph29_lalu2 = $laba_sblm_pajak_lalu2 + ($pph29_lalu2->TOTAL1 - $pph29_lalu2->TOTAL2);
                      $totpph29_lalu2 = ($totpph29_lalu2 * 25) / 100;  

                    }

                    

                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
                    echo "<td class='isi_table' text-align='left'><b>Laba / ( Rugi ) Sebelum Pajak</b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJAN_pend - $totJAN_biaya_lgs - $totJAN_biaya_tdk_lgs + $totJAN_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totFEB_pend - $totFEB_biaya_lgs - $totFEB_biaya_tdk_lgs + $totFEB_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totMAR_pend - $totMAR_biaya_lgs - $totMAR_biaya_tdk_lgs + $totMAR_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totAPR_pend - $totAPR_biaya_lgs - $totAPR_biaya_tdk_lgs + $totAPR_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totMEI_pend - $totMEI_biaya_lgs - $totMEI_biaya_tdk_lgs + $totMEI_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJUN_pend - $totJUN_biaya_lgs - $totJUN_biaya_tdk_lgs + $totJUN_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJUL_pend - $totJUL_biaya_lgs - $totJUL_biaya_tdk_lgs + $totJUL_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totAGU_pend - $totAGU_biaya_lgs - $totAGU_biaya_tdk_lgs + $totAGU_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totSEP_pend - $totSEP_biaya_lgs - $totSEP_biaya_tdk_lgs + $totSEP_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totOKT_pend - $totOKT_biaya_lgs - $totOKT_biaya_tdk_lgs + $totOKT_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totNOP_pend - $totNOP_biaya_lgs - $totNOP_biaya_tdk_lgs + $totNOP_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totDES_pend - $totDES_biaya_lgs - $totDES_biaya_tdk_lgs + $totDES_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar)))."</b></td>";

                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_LALU2_pend - $totJML_LALU2_biaya_lgs - $totJML_LALU2_biaya_biaya_tdk_lgs + $totJML_LALU2_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format( ($totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar) - ($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar) )))."</b></td>";                  
                    echo "<td class='isi_table' text-align='center'><b>".format_akuntansi(str_replace(',', '.', number_format($persen)))."</b></td>";                     
                    echo "</tr>";

                    $persen_pph = 100;

                    if($totpph29_lalu1 > 0){
                        $persen_pph = (($totpph29 - $totpph29_lalu1) / $totpph29_lalu1) * 100;
                    } else if($totpph29_lalu1 == 0 && $totpph29 == 0){
                        $persen_pph = 0;
                    }

                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
                    echo "<td class='isi_table' text-align='left'>Taksiran Pajak Badan (PPh 29)</td>" ;
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format(0))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format(0))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format(0))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format(0))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format(0))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format(0))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format(0))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format(0))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format(0))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format(0))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format(0))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format(0))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totpph29)))."</b></td>";

                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totpph29_lalu1)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totpph29_lalu2)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totpph29 - $totpph29_lalu1)))."</b></td>";
                    echo "<td class='isi_table' text-align='center'><b>".format_akuntansi(str_replace(',', '.', number_format($persen_pph)))."</b></td>";                    
                    echo "</tr>";

                    $persen2 = 100;

                    if($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar - $totpph29_lalu1 > 0){

                        $persen2 = ( ( ($totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar - $totpph29) - ($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar - $totpph29_lalu1) ) / ($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar - $totpph29_lalu1) ) * 100;
                    
                    } else if($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar - $totpph29_lalu1 == 0 && $totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar - $totpph29 == 0){
                       
                        $persen2 = 0;
                    }

                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
                    echo "<td class='isi_table' text-align='left'><b>Laba / ( Rugi ) Bersih</b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJAN_pend - $totJAN_biaya_lgs - $totJAN_biaya_tdk_lgs + $totJAN_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totFEB_pend - $totFEB_biaya_lgs - $totFEB_biaya_tdk_lgs + $totFEB_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totMAR_pend - $totMAR_biaya_lgs - $totMAR_biaya_tdk_lgs + $totMAR_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totAPR_pend - $totAPR_biaya_lgs - $totAPR_biaya_tdk_lgs + $totAPR_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totMEI_pend - $totMEI_biaya_lgs - $totMEI_biaya_tdk_lgs + $totMEI_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJUN_pend - $totJUN_biaya_lgs - $totJUN_biaya_tdk_lgs + $totJUN_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJUL_pend - $totJUL_biaya_lgs - $totJUL_biaya_tdk_lgs + $totJUL_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totAGU_pend - $totAGU_biaya_lgs - $totAGU_biaya_tdk_lgs + $totAGU_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totSEP_pend - $totSEP_biaya_lgs - $totSEP_biaya_tdk_lgs + $totSEP_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totOKT_pend - $totOKT_biaya_lgs - $totOKT_biaya_tdk_lgs + $totOKT_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totNOP_pend - $totNOP_biaya_lgs - $totNOP_biaya_tdk_lgs + $totNOP_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totDES_pend - $totDES_biaya_lgs - $totDES_biaya_tdk_lgs + $totDES_pend_biaya_luar)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar - $totpph29)))."</b></td>";

                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar - $totpph29_lalu1)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_LALU2_pend - $totJML_LALU2_biaya_lgs - $totJML_LALU2_biaya_biaya_tdk_lgs + $totJML_LALU2_pend_biaya_luar - $totpph29_lalu2)))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format( ($totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar - $totpph29) - ($totJML_LALU1_pend - $totJML_LALU1_biaya_lgs - $totJML_LALU1_biaya_biaya_tdk_lgs + $totJML_LALU1_pend_biaya_luar - $totpph29_lalu1) )))."</b></td>";                  
                    echo "<td class='isi_table' text-align='center'><b>".format_akuntansi(str_replace(',', '.', number_format($persen2)))."</b></td>";                     
                    echo "</tr>";
                }


                } 
            } else { ?>

            <tr>
                    <td class='isi_table' style="text-align:center;" colspan="19"> <b> Tidak ada data </b> </td>
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
