<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan-Rencana-Biaya-Operasi.xls");
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
                        RENCANA BIAYA OPERASI TAHUN ANGGARAN <?=$thn;?> (<?=$ket_periode;?>)
                    </h3>
                </td>
            </tr>

        </table>           
        

        <br><br>

        <table class="grid" align="center">
            <thead>
                <tr>
                    <th class="kolom_header" rowspan="2"> NOMOR PERKIRAAN</th>
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
                $totJAN = 0; $totJAN2 = 0; $totJAN_biaya_sa = 0; $totJAN_biaya_psa = 0; $totJAN_biaya_olah_air = 0; $totJAN_biaya_pe_olah_air = 0; $totJAN_biaya_trans_dis = 0; $totJAN_biaya_pe_trans_dis = 0;
                $totFEB = 0; $totFEB2 = 0; $totFEB_biaya_sa = 0; $totFEB_biaya_psa = 0; $totFEB_biaya_olah_air = 0; $totFEB_biaya_pe_olah_air = 0; $totFEB_biaya_trans_dis = 0; $totFEB_biaya_pe_trans_dis = 0;
                $totMAR = 0; $totMAR2 = 0; $totMAR_biaya_sa = 0; $totMAR_biaya_psa = 0; $totMAR_biaya_olah_air = 0; $totMAR_biaya_pe_olah_air = 0; $totMAR_biaya_trans_dis = 0; $totMAR_biaya_pe_trans_dis = 0;
                $totAPR = 0; $totAPR2 = 0; $totAPR_biaya_sa = 0; $totAPR_biaya_psa = 0; $totAPR_biaya_olah_air = 0; $totAPR_biaya_pe_olah_air = 0; $totAPR_biaya_trans_dis = 0; $totAPR_biaya_pe_trans_dis = 0;
                $totMEI = 0; $totMEI2 = 0; $totMEI_biaya_sa = 0; $totMEI_biaya_psa = 0; $totMEI_biaya_olah_air = 0; $totMEI_biaya_pe_olah_air = 0; $totMEI_biaya_trans_dis = 0; $totMEI_biaya_pe_trans_dis = 0;
                $totJUN = 0; $totJUN2 = 0; $totJUN_biaya_sa = 0; $totJUN_biaya_psa = 0; $totJUN_biaya_olah_air = 0; $totJUN_biaya_pe_olah_air = 0; $totJUN_biaya_trans_dis = 0; $totJUN_biaya_pe_trans_dis = 0;
                $totJUL = 0; $totJUL2 = 0; $totJUL_biaya_sa = 0; $totJUL_biaya_psa = 0; $totJUL_biaya_olah_air = 0; $totJUL_biaya_pe_olah_air = 0; $totJUL_biaya_trans_dis = 0; $totJUL_biaya_pe_trans_dis = 0;
                $totAGU = 0; $totAGU2 = 0; $totAGU_biaya_sa = 0; $totAGU_biaya_psa = 0; $totAGU_biaya_olah_air = 0; $totAGU_biaya_pe_olah_air = 0; $totAGU_biaya_trans_dis = 0; $totAGU_biaya_pe_trans_dis = 0;
                $totSEP = 0; $totSEP2 = 0; $totSEP_biaya_sa = 0; $totSEP_biaya_psa = 0; $totSEP_biaya_olah_air = 0; $totSEP_biaya_pe_olah_air = 0; $totSEP_biaya_trans_dis = 0; $totSEP_biaya_pe_trans_dis = 0;
                $totOKT = 0; $totOKT2 = 0; $totOKT_biaya_sa = 0; $totOKT_biaya_psa = 0; $totOKT_biaya_olah_air = 0; $totOKT_biaya_pe_olah_air = 0; $totOKT_biaya_trans_dis = 0; $totOKT_biaya_pe_trans_dis = 0;
                $totNOP = 0; $totNOP2 = 0; $totNOP_biaya_sa = 0; $totNOP_biaya_psa = 0; $totNOP_biaya_olah_air = 0; $totNOP_biaya_pe_olah_air = 0; $totNOP_biaya_trans_dis = 0; $totNOP_biaya_pe_trans_dis = 0;
                $totDES = 0; $totDES2 = 0; $totDES_biaya_sa = 0; $totDES_biaya_psa = 0; $totDES_biaya_olah_air = 0; $totDES_biaya_pe_olah_air = 0; $totDES_biaya_trans_dis = 0; $totDES_biaya_pe_trans_dis = 0;
                $totJML = 0; $totJML2 = 0; $totJML_biaya_sa = 0; $totJML_biaya_psa = 0; $totJML_biaya_olah_air = 0; $totJML_biaya_pe_olah_air = 0; $totJML_biaya_trans_dis = 0; $totJML_biaya_pe_trans_dis = 0;
                
                $totJML_LALU1 = 0;
                $totJML2_LALU1 = 0;
                $totJML_LALU1_biaya_sa = 0;
                $totJML_LALU1_biaya_psa = 0;
                $totJML_LALU1_biaya_olah_air = 0;
                $totJML_LALU1_biaya_pe_olah_air = 0;
                $totJML_LALU1_biaya_trans_dis = 0;
                $totJML_LALU1_biaya_pe_trans_dis = 0;

                $last_key   = end(array_keys($dt));

                if( count($dt) > 0 ) {
                foreach ($dt as $key => $row) {                 

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
                    <td class="isi_table" style="text-align:center;"><?=$row->KODE_PERKIRAAN;?></td>
                    <td class="isi_table"><?=$row->NAMA_PERKIRAAN;?></td>
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
                    <td class="isi_table" text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format($persen))) ;?></td>
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
                $next_judul1    = $dt[$k]->INDUK ;
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

                $totJAN2 += $JAN;
                $totFEB2 += $FEB;
                $totMAR2 += $MAR;
                $totAPR2 += $APR;
                $totMEI2 += $MEI;
                $totJUN2 += $JUN;
                $totJUL2 += $JUL;
                $totAGU2 += $AGU;
                $totSEP2 += $SEP;
                $totOKT2 += $OKT;
                $totNOP2 += $NOP;
                $totDES2 += $DES;
                $totJML2 += $JML;
                $totJML2_LALU1 += $JML_LALU1;

                if($row->INDUK == "BIAYA SUMBER AIR"){    
                    $totJAN_biaya_sa = $totJAN; 
                    $totFEB_biaya_sa = $totFEB;
                    $totMAR_biaya_sa = $totMAR;
                    $totAPR_biaya_sa = $totAPR;
                    $totMEI_biaya_sa = $totMEI;
                    $totJUN_biaya_sa = $totJUN;
                    $totJUL_biaya_sa = $totJUL;
                    $totAGU_biaya_sa = $totAGU;
                    $totSEP_biaya_sa = $totSEP;
                    $totOKT_biaya_sa = $totOKT;
                    $totNOP_biaya_sa = $totNOP;
                    $totDES_biaya_sa = $totDES;
                    $totJML_biaya_sa = $totJML;
                    $totJML_LALU1_biaya_sa = $totJML_LALU1;
                }

                if($row->INDUK == "BIAYA PEMELIHARAAN SUMBER AIR"){
                    $totJAN_biaya_psa = $totJAN; 
                    $totFEB_biaya_psa = $totFEB;
                    $totMAR_biaya_psa = $totMAR;
                    $totAPR_biaya_psa = $totAPR;
                    $totMEI_biaya_psa = $totMEI;
                    $totJUN_biaya_psa = $totJUN;
                    $totJUL_biaya_psa = $totJUL;
                    $totAGU_biaya_psa = $totAGU;
                    $totSEP_biaya_psa = $totSEP;
                    $totOKT_biaya_psa = $totOKT;
                    $totNOP_biaya_psa = $totNOP;
                    $totDES_biaya_psa = $totDES;
                    $totJML_biaya_psa = $totJML;
                    $totJML_LALU1_biaya_psa = $totJML_LALU1;
                }

                if($row->INDUK == "BIAYA PENGOLAHAN AIR"){
                    $totJAN_biaya_olah_air = $totJAN; 
                    $totFEB_biaya_olah_air = $totFEB;
                    $totMAR_biaya_olah_air = $totMAR;
                    $totAPR_biaya_olah_air = $totAPR;
                    $totMEI_biaya_olah_air = $totMEI;
                    $totJUN_biaya_olah_air = $totJUN;
                    $totJUL_biaya_olah_air = $totJUL;
                    $totAGU_biaya_olah_air = $totAGU;
                    $totSEP_biaya_olah_air = $totSEP;
                    $totOKT_biaya_olah_air = $totOKT;
                    $totNOP_biaya_olah_air = $totNOP;
                    $totDES_biaya_olah_air = $totDES;
                    $totJML_biaya_olah_air = $totJML;
                    $totJML_LALU1_biaya_olah_air = $totJML_LALU1;
                }

                if($row->INDUK == "BIAYA PEMELIHARAAN PENGOLAHAN AIR"){
                    $totJAN_biaya_pe_olah_air = $totJAN; 
                    $totFEB_biaya_pe_olah_air = $totFEB;
                    $totMAR_biaya_pe_olah_air = $totMAR;
                    $totAPR_biaya_pe_olah_air = $totAPR;
                    $totMEI_biaya_pe_olah_air = $totMEI;
                    $totJUN_biaya_pe_olah_air = $totJUN;
                    $totJUL_biaya_pe_olah_air = $totJUL;
                    $totAGU_biaya_pe_olah_air = $totAGU;
                    $totSEP_biaya_pe_olah_air = $totSEP;
                    $totOKT_biaya_pe_olah_air = $totOKT;
                    $totNOP_biaya_pe_olah_air = $totNOP;
                    $totDES_biaya_pe_olah_air = $totDES;
                    $totJML_biaya_pe_olah_air = $totJML;
                    $totJML_LALU1_biaya_pe_olah_air = $totJML_LALU1;
                }

                if($row->INDUK == "BIAYA TRANSMISI DAN DISTRIBUSI"){
                    $totJAN_biaya_trans_dis = $totJAN; 
                    $totFEB_biaya_trans_dis = $totFEB;
                    $totMAR_biaya_trans_dis = $totMAR;
                    $totAPR_biaya_trans_dis = $totAPR;
                    $totMEI_biaya_trans_dis = $totMEI;
                    $totJUN_biaya_trans_dis = $totJUN;
                    $totJUL_biaya_trans_dis = $totJUL;
                    $totAGU_biaya_trans_dis = $totAGU;
                    $totSEP_biaya_trans_dis = $totSEP;
                    $totOKT_biaya_trans_dis = $totOKT;
                    $totNOP_biaya_trans_dis = $totNOP;
                    $totDES_biaya_trans_dis = $totDES;
                    $totJML_biaya_trans_dis = $totJML;
                    $totJML_LALU1_biaya_trans_dis = $totJML_LALU1;
                }

                if($row->INDUK == "BIAYA PEMELIHARAAN TRANS & DIST"){
                    $totJAN_biaya_pe_trans_dis = $totJAN; 
                    $totFEB_biaya_pe_trans_dis = $totFEB;
                    $totMAR_biaya_pe_trans_dis = $totMAR;
                    $totAPR_biaya_pe_trans_dis = $totAPR;
                    $totMEI_biaya_pe_trans_dis = $totMEI;
                    $totJUN_biaya_pe_trans_dis = $totJUN;
                    $totJUL_biaya_pe_trans_dis = $totJUL;
                    $totAGU_biaya_pe_trans_dis = $totAGU;
                    $totSEP_biaya_pe_trans_dis = $totSEP;
                    $totOKT_biaya_pe_trans_dis = $totOKT;
                    $totNOP_biaya_pe_trans_dis = $totNOP;
                    $totDES_biaya_pe_trans_dis = $totDES;
                    $totJML_biaya_pe_trans_dis = $totJML;
                    $totJML_LALU1_biaya_pe_trans_dis = $totJML_LALU1;
                }

                $nama_perk = $row->INDUK;
                if($row->INDUK == "BIAYA SUMBER AIR"){
                    $nama_perk = "Biaya Operasi Sumber Air";
                } else if($row->INDUK == "BIAYA PENGOLAHAN AIR"){
                    $nama_perk = "Biaya Operasi Pengolahan Air";
                } else if($row->INDUK == "BIAYA TRANSMISI DAN DISTRIBUSI"){
                    $nama_perk = "Biaya Operasi Transmisi & Distribusi";
                }


                if ($judul1 != $next_judul1) {

                    $persen2 = 100;

                    if($totJML_LALU1 > 0){
                        $persen2 = (($totJML - $totJML_LALU1) / $totJML_LALU1) * 100;
                    } else if($totJML_LALU1  == 0 && $totJML  == 0){
                        $persen2 = 0;
                    }

                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>Jumlah ".ucwords(strtolower($nama_perk))."</b></td>" ;
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
                

                }

                if ($judul1 != $next_judul1 && $row->INDUK == "BIAYA PEMELIHARAAN SUMBER AIR") {

                    $persen3 = 100;

                    if($totJML_LALU1_biaya_sa + $totJML_LALU1_biaya_psa > 0){
                        $persen3 = (( ($totJML_biaya_sa + $totJML_biaya_psa) - ($totJML_LALU1_biaya_sa + $totJML_LALU1_biaya_psa)) / $totJML_LALU1_biaya_sa + $totJML_LALU1_biaya_psa) * 100;
                    } else if($totJML_LALU1_biaya_sa + $totJML_LALU1_biaya_psa  == 0 && $totJML_biaya_sa + $totJML_biaya_psa  == 0){
                        $persen3 = 0;
                    }

                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>Jumlah Biaya Sumber Air</b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJAN_biaya_sa + $totJAN_biaya_psa))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totFEB_biaya_sa + $totFEB_biaya_psa))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totMAR_biaya_sa + $totMAR_biaya_psa))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totAPR_biaya_sa + $totAPR_biaya_psa))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totMEI_biaya_sa + $totMEI_biaya_psa))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJUN_biaya_sa + $totJUN_biaya_psa))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJUL_biaya_sa + $totJUL_biaya_psa))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totAGU_biaya_sa + $totAGU_biaya_psa))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totSEP_biaya_sa + $totSEP_biaya_psa))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totOKT_biaya_sa + $totOKT_biaya_psa))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totNOP_biaya_sa + $totNOP_biaya_psa))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totDES_biaya_sa + $totDES_biaya_psa))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJML_biaya_sa + $totJML_biaya_psa))."</b></td>";   

                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJML_LALU1_biaya_sa + $totJML_LALU1_biaya_psa))."</b></td>";                                
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format( ($totJML_LALU1_biaya_trans_dis + $totJML_LALU1_biaya_pe_trans_dis) - ($totJML_biaya_sa + $totJML_biaya_psa) )))."</b></td>";                               
                    echo "<td class='isi_table' text-align='center'><b>".format_akuntansi(str_replace(',', '.', number_format($persen3)))."</b></td>"; 

                    echo "</tr>";
                

                }

                if ($judul1 != $next_judul1 && $row->INDUK == "BIAYA PEMELIHARAAN PENGOLAHAN AIR") {

                    $persen4 = 100;

                    if($totJML_LALU1_biaya_olah_air + $totJML_LALU1_biaya_pe_olah_air > 0){
                        $persen4 = (( ($totJML_biaya_olah_air + $totJML_biaya_pe_olah_air) - ($totJML_LALU1_biaya_olah_air + $totJML_LALU1_biaya_pe_olah_air)) / $totJML_LALU1_biaya_olah_air + $totJML_LALU1_biaya_pe_olah_air) * 100;
                    } else if($totJML_LALU1_biaya_olah_air + $totJML_LALU1_biaya_pe_olah_air  == 0 && $totJML_biaya_olah_air + $totJML_biaya_pe_olah_air  == 0){
                        $persen4 = 0;
                    }

                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>Jumlah Biaya Pengolahan Air</b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJAN_biaya_olah_air + $totJAN_biaya_pe_olah_air))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totFEB_biaya_olah_air + $totFEB_biaya_pe_olah_air))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totMAR_biaya_olah_air + $totMAR_biaya_pe_olah_air))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totAPR_biaya_olah_air + $totAPR_biaya_pe_olah_air))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totMEI_biaya_olah_air + $totMEI_biaya_pe_olah_air))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJUN_biaya_olah_air + $totJUN_biaya_pe_olah_air))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJUL_biaya_olah_air + $totJUL_biaya_pe_olah_air))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totAGU_biaya_olah_air + $totAGU_biaya_pe_olah_air))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totSEP_biaya_olah_air + $totSEP_biaya_pe_olah_air))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totOKT_biaya_olah_air + $totOKT_biaya_pe_olah_air))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totNOP_biaya_olah_air + $totNOP_biaya_pe_olah_air))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totDES_biaya_olah_air + $totDES_biaya_pe_olah_air))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJML_biaya_olah_air + $totJML_biaya_pe_olah_air))."</b></td>"; 

                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJML_LALU1_biaya_olah_air + $totJML_LALU1_biaya_pe_olah_air))."</b></td>";                                
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format( ($totJML_LALU1_biaya_olah_air + $totJML_LALU1_biaya_pe_olah_air) - ($totJML_biaya_olah_air + $totJML_biaya_pe_olah_air) )))."</b></td>";                               
                    echo "<td class='isi_table' text-align='center'><b>".format_akuntansi(str_replace(',', '.', number_format($persen4)))."</b></td>";                
                    echo "</tr>";
                

                }

                if ($judul1 != $next_judul1 && $row->INDUK == "BIAYA PEMELIHARAAN TRANS & DIST") {

                    $persen5 = 100;

                    if($totJML_LALU1_biaya_trans_dis + $totJML_LALU1_biaya_pe_trans_dis > 0){
                        $persen5 = (( ($totJML_biaya_trans_dis + $totJML_biaya_pe_trans_dis) - ($totJML_LALU1_biaya_trans_dis + $totJML_LALU1_biaya_pe_trans_dis)) / $totJML_LALU1_biaya_trans_dis + $totJML_LALU1_biaya_pe_trans_dis) * 100;
                    } else if($totJML_LALU1_biaya_trans_dis + $totJML_LALU1_biaya_pe_trans_dis  == 0 && $totJML_biaya_trans_dis + $totJML_biaya_pe_trans_dis  == 0){
                        $persen5 = 0;
                    }

                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>Jumlah Biaya Transmisi dan Distribusi</b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJAN_biaya_trans_dis + $totJAN_biaya_pe_trans_dis))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totFEB_biaya_trans_dis + $totFEB_biaya_pe_trans_dis))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totMAR_biaya_trans_dis + $totMAR_biaya_pe_trans_dis))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totAPR_biaya_trans_dis + $totAPR_biaya_pe_trans_dis))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totMEI_biaya_trans_dis + $totMEI_biaya_pe_trans_dis))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJUN_biaya_trans_dis + $totJUN_biaya_pe_trans_dis))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJUL_biaya_trans_dis + $totJUL_biaya_pe_trans_dis))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totAGU_biaya_trans_dis + $totAGU_biaya_pe_trans_dis))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totSEP_biaya_trans_dis + $totSEP_biaya_pe_trans_dis))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totOKT_biaya_trans_dis + $totOKT_biaya_pe_trans_dis))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totNOP_biaya_trans_dis + $totNOP_biaya_pe_trans_dis))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totDES_biaya_trans_dis + $totDES_biaya_pe_trans_dis))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJML_biaya_trans_dis + $totJML_biaya_pe_trans_dis))."</b></td>"; 

                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJML_LALU1_biaya_trans_dis + $totJML_LALU1_biaya_pe_trans_dis))."</b></td>";                                
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format( ($totJML_LALU1_biaya_trans_dis + $totJML_LALU1_biaya_pe_trans_dis) - ($totJML_biaya_trans_dis + $totJML_biaya_pe_trans_dis) )))."</b></td>";                               
                    echo "<td class='isi_table' text-align='center'><b>".format_akuntansi(str_replace(',', '.', number_format($persen5)))."</b></td>"; 
                    echo "</tr>";
                

                }

                if ($judul1 != $next_judul1 && $row->INDUK == "BIAYA AIR LIMBAH") {

                    $persen_total = 100;

                    if($totJML2_LALU1 > 0){
                        $persen_total = (($totJML2 - $totJML2_LALU1) / $totJML2_LALU1) * 100;
                    } else if($totJML2_LALU1 == 0 && $totJML2 == 0){
                        $persen_total = 0;
                    }

                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
                    echo "<td class='isi_table' text-align='left'><b>Jumlah Biaya Operasi</b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJAN2))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totFEB2))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totMAR2))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totAPR2))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totMEI2))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJUN2))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJUL2))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totAGU2))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totSEP2))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totOKT2))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totNOP2))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totDES2))."</b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJML2))."</b></td>"; 

                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJML2_LALU1))."</b></td>";                
                    echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML2 - $totJML2_LALU1)))."</b></td>";                
                    echo "<td class='isi_table' text-align='center'><b>".format_akuntansi(str_replace(',', '.', number_format($persen_total)))."</b></td>";                
                    echo "</tr>";                

                }


                } 
            } else { ?>

            <tr>
                    <td class='isi_table' style="text-align:center;" colspan="18"> <b> Tidak ada data </b> </td>
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
