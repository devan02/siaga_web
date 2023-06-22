<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan-Rencana-Biaya-Tenaga-Kerja.xls");
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
                        RENCANA PENGELUARAN BIAYA TENAGA KERJA <?=$sts_lap;?><br>
                        TAHUN ANGGARAN : <?=$thn;?> (<?=$ket_periode;?>)
                    </h3>
                </td>
            </tr>

        </table>

        <br><br>

        <table class="grid" align="center">
            <thead>
                <tr>
                    <th class="kolom_header" rowspan="2" style="width:50px;"> NO </th>
                    <th class="kolom_header" rowspan="2"> URAIAN </th>
                    <th class="kolom_header" rowspan="2" style="width:100px;"> JUMLAH TENAGA KERJA </th>
                    <th class="kolom_header" colspan="12"> BULAN </th>
                    <th class="kolom_header" rowspan="2" style="width:100px;"> JUMLAH </th>
                    <th class="kolom_header" rowspan="2" style="width:100px;"> ESTIMASI TAHUN <?=$thn-1;?> </th>
                    <th class="kolom_header" colspan="2"> MENAIK / (MENURUN) </th>
                </tr>
                <tr>
                    <th class="kolom_header" style="width:100px;"> Januari </th>
                    <th class="kolom_header" style="width:100px;"> Pebruari </th>
                    <th class="kolom_header" style="width:100px;"> Maret </th>
                    <th class="kolom_header" style="width:100px;"> April </th>
                    <th class="kolom_header" style="width:100px;"> Mei </th>
                    <th class="kolom_header" style="width:100px;"> Juni </th>
                    <th class="kolom_header" style="width:100px;"> Juli </th>
                    <th class="kolom_header" style="width:100px;"> Agustus </th>
                    <th class="kolom_header" style="width:100px;"> September </th>
                    <th class="kolom_header" style="width:100px;"> Oktober </th>
                    <th class="kolom_header" style="width:100px;"> Nopember </th>
                    <th class="kolom_header" style="width:100px;"> Desember </th>
                    <th class="kolom_header" style="width:100px;">JUMLAH </th>
                    <th class="kolom_header" style="width:50px;">% </th>
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


                $totTOTAL      = 0;
                $totTOTAL_LALU = 0;

                $totTOTAL2      = 0;
                $totTOTAL_LALU2 = 0;

                $last_key   = end(array_keys($dt));

                if( count($dt) > 0 ) {
                foreach ($dt as $key => $row) {                 

                $judul1 = TRIM($row->INDUK);
                $sts_no = TRIM($row->STS_NO);
                $no_gol = $row->NO;

                if($sts_no == 1){
                    $no_gol = "";
                }

                if ($old_judul != $judul1) {
                    $old_judul  = $judul1 ;

                    echo "<tr>";
                    echo "<td class='isi_table' style='text-align:center;'><b>".$no_gol."</b></td>" ;
                    echo "<td class='isi_table'><b>".$row->INDUK."</b></td>" ;
                    echo "<td class='isi_table'> </td>";
                    echo "<td class='isi_table'> </td>";
                    echo "<td class='isi_table'> </td>";
                    echo "<td class='isi_table'> </td>";
                    echo "<td class='isi_table'> </td>";
                    echo "<td class='isi_table'> </td>";
                    echo "<td class='isi_table'> </td>";
                    echo "<td class='isi_table'> </td>";
                    echo "<td class='isi_table'> </td>";
                    echo "<td class='isi_table'> </td>";
                    echo "<td class='isi_table'> </td>";
                    echo "<td class='isi_table'> </td>";
                    echo "<td class='isi_table'> </td>";
                    echo "<td class='isi_table'> </td>";
                    echo "<td class='isi_table'> </td>";
                    echo "<td class='isi_table'> </td>";
                    echo "<td class='isi_table'> </td>";                
                    echo "</tr>";
                }

                $persen1 = 100;

                if($row->TOTAL_LALU > 0){
                    $persen1 = (($row->TOTAL - $row->TOTAL_LALU) / $row->TOTAL_LALU) * 100;
                } else if($row->TOTAL_LALU  == 0 && $row->TOTAL == 0){
                    $persen1 = 0;
                }

                ?>
                
                <tr>
                    <td class="isi_table" style="text-align:center;"></td>
                    <td class="isi_table"><?=$row->JUDUL;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->JML)) ;?></td>
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
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->TOTAL)) ;?></td>

                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->TOTAL_LALU)) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->TOTAL - $row->TOTAL_LALU))) ;?></td>
                    <td class="isi_table" text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format($persen1))) ;?></td>
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
                $TOTAL         = str_replace(',', '.', $row->TOTAL);
                $TOTAL_LALU   = str_replace(',', '.', $row->TOTAL_LALU);

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
                $totTOTAL_LALU += $TOTAL_LALU;
                $totTOTAL += $TOTAL;

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
                
                $totTOTAL_LALU2 += $TOTAL_LALU;
                $totTOTAL2 += $TOTAL;

                $nama_perk = $row->INDUK;

                $persen2 = 100;

                if($totTOTAL_LALU > 0){
                    $persen2 = (($totTOTAL - $totTOTAL_LALU) / $totTOTAL_LALU) * 100;
                } else if($totTOTAL_LALU  == 0 && $totTOTAL == 0){
                    $persen2 = 0;
                }

                if ($judul1 != $next_judul1) {
            echo "<tr>";
            echo "<td class='isi_table'><b></b></td>" ;
            echo "<td class='isi_table' text-align='right'><b>Jumlah ".ucwords(strtolower($nama_perk))."</b></td>" ;
            echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJML))."</b></td>";
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
            echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totTOTAL))."</b></td>";

            echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totTOTAL_LALU))."</b></td>";
            echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totTOTAL - $totTOTAL_LALU)))."</b></td>";
            echo "<td class='isi_table' text-align='center'><b>".format_akuntansi(str_replace(',', '.', number_format(0)))."</b></td>";                 
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
                    $totTOTAL = 0;
                    $totTOTAL_LALU = 0;
                

                }

                } 

                $persen3 = 100;

                if($totTOTAL_LALU2 > 0){
                    $persen3 = (($totTOTAL2 - $totTOTAL_LALU2) / $totTOTAL_LALU2) * 100;
                } else if($totTOTAL_LALU2  == 0 && $totTOTAL2 == 0){
                    $persen3 = 0;
                }

                echo "<tr>";
                echo "<td class='isi_table'><b></b></td>" ;
                echo "<td class='isi_table' text-align='left'><b>Jumlah Pengeluaran untuk Tenaga Kerja</b></td>" ;
                echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJML2))."</b></td>";
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
                echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totTOTAL2))."</b></td>";
                echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totTOTAL_LALU2))."</b></td>";
                echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totTOTAL2 - $totTOTAL_LALU2)))."</b></td>";
                echo "<td class='isi_table' text-align='center'><b>".format_akuntansi(str_replace(',', '.', number_format($persen3)))."</b></td>";                 
                echo "</tr>";  

            } else { ?>

            <tr>
                    <td class="isi_table" style="text-align:center;" colspan="19"> <b> Tidak ada data </b> </td>
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

