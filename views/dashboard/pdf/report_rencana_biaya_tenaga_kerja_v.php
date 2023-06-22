<?PHP  ob_start(); ?>

<style>

.grid th {
	background: #1793d1;
	vertical-align: middle;
	color : #FFF;
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



</style>
		
        <table align="center">
            <tr>
                <td>
                    <img src="<?=base_url();?>files/pdam/logo-pdamtp.png" width="110" height="100" alt="KOP PDAM">
                </td>
                <td><img src="<?=base_url();?>files/pdam/kosong.png" width="640" height="100" alt="KOP PDAM"></td>
                <td>
                    <img src="<?=base_url();?>files/pdam/KOP_tulisan.png" width="550" height="100" alt="KOP PDAM">
                </td>
                <td><img src="<?=base_url();?>files/pdam/kosong.png" width="640" height="100" alt="KOP PDAM"></td>
                <td>
                    <img src="<?=base_url();?>files/pdam/logo_perpamsi_glossy.png" width="160" height="100" alt="KOP PDAM">
                </td>
            </tr>
        </table>

        <hr>

        <table align="center">
            <tr>
                <td style="text-align:center;">
                    <h2 style="font-family:Arial; font-weight:normal; line-height:1.6;">
                        RENCANA PENGELUARAN BIAYA TENAGA KERJA <?=$sts_lap;?><br>
                         TAHUN ANGGARAN : <?=$thn;?> (<?=$ket_periode;?>)
                    </h2>
                </td>
            </tr>

        </table>

        <br><br>

        <table class="grid" align="center">
            <thead>
                <tr>
                    <th rowspan="2" style="width:50px;"> NO </th>
                    <th rowspan="2"> URAIAN </th>
                    <th rowspan="2" style="width:100px;"> JUMLAH TENAGA KERJA </th>
                    <th colspan="12"> BULAN </th>
                    <th rowspan="2" style="width:100px;"> JUMLAH </th>
                    <th rowspan="2" style="width:100px;"> ESTIMASI TAHUN <?=$thn-1;?> </th>
                    <th colspan="2"> MENAIK / (MENURUN) </th>
                </tr>
                <tr>
                    <th style="width:100px;"> Januari </th>
                    <th style="width:100px;"> Pebruari </th>
                    <th style="width:100px;"> Maret </th>
                    <th style="width:100px;"> April </th>
                    <th style="width:100px;"> Mei </th>
                    <th style="width:100px;"> Juni </th>
                    <th style="width:100px;"> Juli </th>
                    <th style="width:100px;"> Agustus </th>
                    <th style="width:100px;"> September </th>
                    <th style="width:100px;"> Oktober </th>
                    <th style="width:100px;"> Nopember </th>
                    <th style="width:100px;"> Desember </th>
                    <th style="width:100px;">JUMLAH </th>
                    <th style="width:50px;">% </th>
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
                    echo "<td class='judul' style='text-align:center;'><b>".$no_gol."</b></td>" ;
                    echo "<td><b>".$row->INDUK."</b></td>" ;
                    echo "<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>" ;
                    echo "<td></td><td></td><td></td><td></td>";
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
                    <td style="text-align:center;"></td>
                    <td><?=$row->JUDUL;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->JML)) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->JAN)) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->FEB)) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->MAR)) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->APR)) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->MEI)) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->JUN)) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->JUL)) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->AGU)) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->SEP)) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->OKT)) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->NOP)) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->DES)) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->TOTAL)) ;?></td>

                    <td text-align="right"><?=str_replace(',', '.', number_format($row->TOTAL_LALU)) ;?></td>
                    <td text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->TOTAL - $row->TOTAL_LALU))) ;?></td>
                    <td text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format($persen1))) ;?></td>
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
                    echo "<td class='judul'><b></b></td>" ;
                    echo "<td text-align='right'><b>Jumlah ".ucwords(strtolower($nama_perk))."</b></td>" ;
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJML))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJAN))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totFEB))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totMAR))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totAPR))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totMEI))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJUN))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJUL))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totAGU))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totSEP))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totOKT))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totNOP))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totDES))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totTOTAL))."</b></td>";

                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totTOTAL_LALU))."</b></td>";
                    echo "<td text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totTOTAL - $totTOTAL_LALU)))."</b></td>";
                    echo "<td text-align='center'><b>".format_akuntansi(str_replace(',', '.', number_format(0)))."</b></td>";                 
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
                echo "<td class='judul'><b></b></td>" ;
                echo "<td text-align='left'><b>Jumlah Pengeluaran untuk Tenaga Kerja</b></td>" ;
                echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJML2))."</b></td>";
                echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJAN2))."</b></td>";
                echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totFEB2))."</b></td>";
                echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totMAR2))."</b></td>";
                echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totAPR2))."</b></td>";
                echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totMEI2))."</b></td>";
                echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJUN2))."</b></td>";
                echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJUL2))."</b></td>";
                echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totAGU2))."</b></td>";
                echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totSEP2))."</b></td>";
                echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totOKT2))."</b></td>";
                echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totNOP2))."</b></td>";
                echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totDES2))."</b></td>";
                echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totTOTAL2))."</b></td>";
                echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totTOTAL_LALU2))."</b></td>";
                echo "<td text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totTOTAL2 - $totTOTAL_LALU2)))."</b></td>";
                echo "<td text-align='center'><b>".format_akuntansi(str_replace(',', '.', number_format($persen3)))."</b></td>";                 
                echo "</tr>";  

            } else { ?>

            <tr>
                    <td style="text-align:center;" colspan="19"> <b> Tidak ada data </b> </td>
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

<?PHP
    $content = ob_get_clean();
    // require_once "localhost/siaga/material/fpdf/html2pdf.class.php";
    $html2pdf = new HTML2PDF('L','A2','fr');
    $html2pdf->pdf->SetTitle("Rencana Pengeluaran Biaya Tenaga Kerja $thn");
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('rencana_pengeluaran_biaya_tenaga_kerja.pdf');
?>

