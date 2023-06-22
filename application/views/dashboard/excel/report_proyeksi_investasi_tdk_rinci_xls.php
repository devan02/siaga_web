<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Report_proyeksi_investasi_tidak_rinci.xls");
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
                        PROYEKSI INVESTASI TAHUN ANGGARAN : <?=$thn;?> (<?=$ket_periode;?>)
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
                $totJAN = 0; $totJAN2 = 0;
                $totFEB = 0; $totFEB2 = 0;
                $totMAR = 0; $totMAR2 = 0;
                $totAPR = 0; $totAPR2 = 0;
                $totMEI = 0; $totMEI2 = 0;
                $totJUN = 0; $totJUN2 = 0;
                $totJUL = 0; $totJUL2 = 0;
                $totAGU = 0; $totAGU2 = 0;
                $totSEP = 0; $totSEP2 = 0;
                $totOKT = 0; $totOKT2 = 0;
                $totNOP = 0; $totNOP2 = 0;
                $totDES = 0; $totDES2 = 0;
                $totJML = 0; $totJML2 = 0;

                $totJML_LALU1 = 0;
                $totJML2_LALU1 = 0;

                $last_key   = end(array_keys($dt));

                if( count($dt) > 0 ) {
                foreach ($dt as $key => $row) {                 

                $judul1 = TRIM($row->INDUK);

                $judul_head = $row->INDUK;

                if($row->INDUK == "PERKIRAAN PENYUSUTAN INVESTASI"){
                    $judul_head = "";
                }

                if ($old_judul != $judul1) {
                    $old_judul  = $judul1 ;
                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
                    echo "<td class='isi_table'><b>".$judul_head."</b></td>" ;
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

                $nama_perk2 = $row->NAMA_PERKIRAAN;

                if($row->INDUK == "PERKIRAAN PENYUSUTAN INVESTASI"){
                    $nama_perk2 = "<b>PERKIRAAN PENYUSUTAN INVESTASI TAHUN $thn</b>";
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
                    <td class="isi_table"><?=$nama_perk2;?></td>
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

                $totJAN += $JAN; $totJAN2 += $JAN;
                $totFEB += $FEB; $totFEB2 += $FEB;
                $totMAR += $MAR; $totMAR2 += $MAR;
                $totAPR += $APR; $totAPR2 += $APR;
                $totMEI += $MEI; $totMEI2 += $MEI;
                $totJUN += $JUN; $totJUN2 += $JUN;
                $totJUL += $JUL; $totJUL2 += $JUL;
                $totAGU += $AGU; $totAGU2 += $AGU;
                $totSEP += $SEP; $totSEP2 += $SEP;
                $totOKT += $OKT; $totOKT2 += $OKT;
                $totNOP += $NOP; $totNOP2 += $NOP;
                $totDES += $DES; $totDES2 += $DES;
                $totJML += $JML; $totJML2 += $JML;
                $totJML_LALU1 += $JML_LALU1; $totJML2_LALU1 += $JML_LALU1;

                $nama_perk = $row->INDUK;

                if($nama_perk == "TANAH DAN PENYEMPURNAAN TANAH"){
                    $nama_perk = "Investasi dalam Tanah";
                } else if($nama_perk == "INSTALASI SUMBER AIR"){
                    $nama_perk = " Investasi dalam Inst.Sumber";
                } else if($nama_perk == "INSTALASI POMPA"){
                    $nama_perk = "Investasi dalam Inst.Pompa";
                } else if($nama_perk == "INSTALASI PENGOLAHAN AIR"){
                    $nama_perk = "Investasi dalam Inst.Pengolahan Air";
                } else if($nama_perk == "INSTALASI TRANSMISI & DISTRIBUSI"){
                    $nama_perk = "Investasi dalam Inst.Transmisi & Dist";
                } else if($nama_perk == "BANGUNAN / GEDUNG"){
                    $nama_perk = "Investasi dalam Bangunan / Gedung";
                } else if($nama_perk == "PERALATAN DAN PERLENGKAPAN"){
                    $nama_perk = "Investasi dalam Peralatan & Perleng.";
                } else if($nama_perk == "KENDARAAN / ALAT PENGANGKUTAN"){
                    $nama_perk = "Investasi dalam Kendaraan";
                } else if($nama_perk == "INVENTARIS / PERABOT KANTOR"){
                    $nama_perk = "Investasi dalam Inventaris";
                } else if($nama_perk == "PERKIRAAN PENYUSUTAN INVESTASI"){
                    $nama_perk = "Akumulasi Penyusutan";
                }

                if ($judul1 != $next_judul1 && $row->INDUK == "PERKIRAAN PENYUSUTAN INVESTASI") {

                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
                    echo "<td class='isi_table' text-align='left'><b>AKUMULASI PENYUSUTAN TAHUN LALU</b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b></b></td>";
                    echo "<td class='isi_table' text-align='right'><b></b></td>";
                    echo "<td class='isi_table' text-align='right'><b></b></td>";
                    echo "<td class='isi_table' text-align='right'><b></b></td>";
                    echo "<td class='isi_table' text-align='right'><b></b></td>";
                    echo "<td class='isi_table' text-align='right'><b></b></td>";
                    echo "<td class='isi_table' text-align='right'><b></b></td>";
                    echo "<td class='isi_table' text-align='right'><b></b></td>";
                    echo "<td class='isi_table' text-align='right'><b></b></td>";
                    echo "<td class='isi_table' text-align='right'><b></b></td>";
                    echo "<td class='isi_table' text-align='right'><b></b></td>";
                    echo "<td class='isi_table' text-align='right'><b></b></td>";
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($susut->JML))."</b></td>";

                    echo "<td class='isi_table'></td>";
                    echo "<td class='isi_table'></td>";
                    echo "<td class='isi_table'></td>";                  
                    echo "</tr>"; 
                }

                if ($judul1 != $next_judul1) {

                    $persen2 = 100;

                    if($totJML_LALU1 > 0){
                        $persen2 = (($totJML - $totJML_LALU1) / $totJML_LALU1) * 100;
                    } else if($totJML_LALU1 == 0 && $totJML == 0){
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
                

                }

                if ($judul1 != $next_judul1 && $row->INDUK == "PERKIRAAN PENYUSUTAN INVESTASI") {

                    $persen3 = 100;

                    if($totJML2_LALU1 > 0){
                        $persen3 = (($totJML2 - $totJML2_LALU1) / $totJML2_LALU1) * 100;
                    } else if($totJML2_LALU1 == 0 && $totJML2 == 0){
                        $persen3 = 0;
                    }

                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
                    echo "<td class='isi_table' text-align='center'><b>Jumlah Investasi Sebelum Penyusutan</b></td>" ;
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
                    echo "<td class='isi_table' text-align='center'><b>".format_akuntansi(str_replace(',', '.', number_format($persen3)))."</b></td>";                 
                    echo "</tr>";    


                }

                } 
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

