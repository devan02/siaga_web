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
		
        
            
        <img src="<?=base_url();?>files/pdam/kop.png"  width="350" alt="KOP PDAM">

        <br><br><br>

        <table align="left">
            <tr>
                <td style="text-align:left;">
                    <h3>
                        PROYEKSI LABA RUGI TAHUN <?=$thn;?> (<?=$ket_periode;?>)
                    </h3>
                </td>
            </tr>

        </table>

        <table class="grid">
            <thead>
                <tr>
                    <th class="kolom_header"> NOMOR PERKIRAAN</th>
                    <th class="kolom_header"> URAIAN </th>
                    <th class="kolom_header"> JUMLAH </th>
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

                $total_jml = 0;

                $last_key   = end(array_keys($dt));
                foreach ($dt as $key => $row) {                 

                $judul1 = TRIM($row->INDUK);

                if ($old_judul != $judul1) {
                    $old_judul  = $judul1 ;
                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
                    echo "<td class='isi_table'><b>".$row->INDUK."</b></td>" ;
                    echo "<td class='isi_table'></td>" ;
                    echo "</tr>";
                }

                ?>

                <tr>
                    <td  class='isi_table' style="text-align:center;"><?=$row->KODE_PERKIRAAN;?></td>
                    <td class='isi_table' ><?=ucwords(strtolower($row->NAMA_PERKIRAAN));?></td>
                    <td  class='isi_table' text-align="right"><?=str_replace(',', '.', number_format($row->JML)) ;?></td>
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

                if ($judul1 != $next_judul1) {
                    echo "<tr>";
                    echo "<td class='isi_table'><b></b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>Jumlah ".ucwords(strtolower($row->INDUK))."</b></td>" ;
                    echo "<td class='isi_table' text-align='right'><b>".str_replace(',', '.', number_format($totJML))."</b></td>";                  
                    echo "</tr>";

                    $totJML = 0;

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
                

                }

                } ?>
            </tbody>
        </table>



<?php
exit()
?>
