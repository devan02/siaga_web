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
    height: 50px;
    padding-left: 5px;
    padding-right: 5px;
    padding-top: 5px;
    padding-bottom: 5px;
}
.grid {
	background: #FAEBD7;
	border: 2px solid #C5C5C5;
    border-spacing: 0;
    line-height: 1.5;
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
		
        <table align="center">
            <tr>
                <td>
                    <img src="<?=base_url();?>files/pdam/logo-pdamtp.png" width="110" height="100" alt="KOP PDAM">
                </td>
                <td><img src="<?=base_url();?>files/pdam/kosong.png" width="620" height="100" alt="KOP PDAM"></td>
                <td>
                    <img src="<?=base_url();?>files/pdam/KOP_tulisan.png" width="550" height="100" alt="KOP PDAM">
                </td>
                <td><img src="<?=base_url();?>files/pdam/kosong.png" width="780" height="100" alt="KOP PDAM"></td>
            </tr>
        </table>

        <hr>

        <table align="center">
            <tr>
                <td style="text-align:center;">
                    <h2 style="font-family:Arial; font-weight:normal; line-height:1.6;">
                        <?=$ket;?> <br>
                         TAHUN ANGGARAN : <?=$thn;?>
                    </h2>
                </td>
            </tr>

        </table>
            
        

        <br><br>

        <table align="center" class="grid">
            <thead>
                <tr>
                    <th rowspan="2" style="width:100px;"> NO <br> PERKIRAAN</th>
                    <th style="width:80px;"> URAIAN </th>
                    <th rowspan="2"> SUB BAGIAN </th>
                    <th rowspan="2"> TMT </th>
                    <th rowspan="2" style="width:60px;"> LAMA <br>(Hari) </th>                    
                    <th rowspan="2" style="width:60px;"> VOL </th>
                    <th rowspan="2" style="width:90px;"> SATUAN </th>
                    <th rowspan="2" style="width:90px;"> HARGA </th>
                    <th rowspan="2" style="width:90px;"> BIAYA </th>
                    <th colspan="12"> JADWAL PELAKSANAAN </th>
                </tr>
                <tr>
                    <th style="width:80px; padding-top:10px;"> KODE ANGGARAN</th>
                    <th style="width:90px;"> Januari </th>
                    <th style="width:90px;"> Pebruari </th>
                    <th style="width:90px;"> Maret </th>
                    <th style="width:90px;"> April </th>
                    <th style="width:90px;"> Mei </th>
                    <th style="width:90px;"> Juni </th>
                    <th style="width:90px;"> Juli </th>
                    <th style="width:90px;"> Agustus </th>
                    <th style="width:90px;"> September </th>
                    <th style="width:90px;"> Oktober </th>
                    <th style="width:90px;"> Nopember </th>
                    <th style="width:90px;"> Desember </th>
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

                $last_key   = end(array_keys($dt));

                if( count($dt) > 0 ) {
                $ii = 0;
                foreach ($dt as $key => $row) {                 
                $ii++;
                //$judul1 = TRIM($row->INDUK);

                // if ($old_judul != $judul1) {
                //     $old_judul  = $judul1 ;
                //     echo "<tr>";
                //     echo "<td class='judul'><b></b></td>" ;
                //     echo "<td><b>".$row->INDUK."</b></td>" ;
                //     echo "<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>" ;
                //     echo "</tr>";
                // }

                ?>
                
                <tr>
                    <td text-align="center"><?=$row->KODE_PERKIRAAN;?></td>
                    <td  style="width:150px;"><?=$row->NAMA_PERKIRAAN;?> <br> <?=$row->KODE_ANGGARAN;?> </td>
                    <td text-align="center"><?=$row->NAMA_DIVISI;?></td>
                    <td text-align="center"><?=$row->TMT_PELAKSANAAN;?></td>
                    <td text-align="center"><?=$row->LAMA_PELAKSANAAN;?></td>
                    <td text-align="center"><?=$row->JUMLAH;?></td>
                    <td text-align="center"><?=$row->SATUAN;?></td>                    
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->HARGA, 2, ",", "."));?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->TOTAL + $row->TOTAL_PELAKSANAAN, 2, ",", ".")) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->JANUARI, 2, ",", ".")) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->FEBRUARI, 2, ",", ".")) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->MARET, 2, ",", ".")) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->APRIL, 2, ",", ".")) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->MEI, 2, ",", ".")) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->JUNI, 2, ",", ".")) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->JULI, 2, ",", ".")) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->AGUSTUS, 2, ",", ".")) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->SEPTEMBER, 2, ",", ".")) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->OKTOBER, 2, ",", ".")) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->NOVEMBER, 2, ",", ".")) ;?></td>
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->DESEMBER, 2, ",", ".")) ;?></td>
                    
                </tr>


                <?PHP 



                $JAN   = str_replace(',', '.', $row->JANUARI);
                $FEB   = str_replace(',', '.', $row->FEBRUARI);
                $MAR   = str_replace(',', '.', $row->MARET);
                $APR   = str_replace(',', '.', $row->APRIL);
                $MEI   = str_replace(',', '.', $row->MEI);
                $JUN   = str_replace(',', '.', $row->JUNI);
                $JUL   = str_replace(',', '.', $row->JULI);
                $AGU   = str_replace(',', '.', $row->AGUSTUS);
                $SEP   = str_replace(',', '.', $row->SEPTEMBER);
                $OKT   = str_replace(',', '.', $row->OKTOBER);
                $NOP   = str_replace(',', '.', $row->NOVEMBER);
                $DES   = str_replace(',', '.', $row->DESEMBER);
                $JML   = str_replace(',', '.', $row->TOTAL + $row->TOTAL_PELAKSANAAN);

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

                // if ($judul1 != $next_judul1) {
                //     echo "<tr>";
                //     echo "<td class='judul'><b></b></td>" ;
                //     echo "<td text-align='right'><b>Jumlah ".ucwords(strtolower($row->INDUK))."</b></td>" ;
                //     echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJAN))."</b></td>";
                //     echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totFEB))."</b></td>";
                //     echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totMAR))."</b></td>";
                //     echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totAPR))."</b></td>";
                //     echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totMEI))."</b></td>";
                //     echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJUN))."</b></td>";
                //     echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJUL))."</b></td>";
                //     echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totAGU))."</b></td>";
                //     echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totSEP))."</b></td>";
                //     echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totOKT))."</b></td>";
                //     echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totNOP))."</b></td>";
                //     echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totDES))."</b></td>";
                //     echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJML))."</b></td>";                
                //     echo "</tr>";

                //     $totJAN = 0;
                //     $totFEB = 0;
                //     $totMAR = 0;
                //     $totAPR = 0;
                //     $totMEI = 0;
                //     $totJUN = 0;
                //     $totJUL = 0;
                //     $totAGU = 0;
                //     $totSEP = 0;
                //     $totOKT = 0;
                //     $totNOP = 0;
                //     $totDES = 0;
                //     $totJML = 0;
                

                // }

                } 
            ?> 

            <tr>
                    <td style="text-align:center;" colspan="8"> <b> TOTAL </b> </td>
                    <td style="text-align:right;"><b><?=str_replace(',', '.', number_format($totJML, 2));?></b></td>
                    <td style="text-align:right;"><b><?=str_replace(',', '.', number_format($totJAN, 2));?></b></td>
                    <td style="text-align:right;"><b><?=str_replace(',', '.', number_format($totFEB, 2));?></b></td>
                    <td style="text-align:right;"><b><?=str_replace(',', '.', number_format($totMAR, 2));?></b></td>
                    <td style="text-align:right;"><b><?=str_replace(',', '.', number_format($totAPR, 2));?></b></td>
                    <td style="text-align:right;"><b><?=str_replace(',', '.', number_format($totMEI, 2));?></b></td>
                    <td style="text-align:right;"><b><?=str_replace(',', '.', number_format($totJUN, 2));?></b></td>
                    <td style="text-align:right;"><b><?=str_replace(',', '.', number_format($totJUL, 2));?></b></td>
                    <td style="text-align:right;"><b><?=str_replace(',', '.', number_format($totAGU, 2));?></b></td>
                    <td style="text-align:right;"><b><?=str_replace(',', '.', number_format($totSEP, 2));?></b></td>
                    <td style="text-align:right;"><b><?=str_replace(',', '.', number_format($totOKT, 2));?></b></td>
                    <td style="text-align:right;"><b><?=str_replace(',', '.', number_format($totNOP, 2));?></b></td>
                    <td style="text-align:right;"><b><?=str_replace(',', '.', number_format($totDES, 2));?></b></td>
            </tr>


            <?PHP
            } else { ?>

            <tr>
                    <td style="text-align:center;" colspan="21"> <b> Tidak ada data </b> </td>
            </tr>

            <?PHP }
            ?>
            </tbody>
        </table>

        <!-- TTD -->
        <?PHP 
        if(count($ttd) > 0){
        echo " <br><br><br> <table> <tr>";
        foreach ($ttd as $key => $ttd_val) {

        echo "
            <td style='text-align:center; width:100px;'> &nbsp; </td>
            <td style='text-align:center; width:200px;'> 
                $ttd_val->JABATAN  <br><br><br><br><br><br><br><br>  <b><u>$ttd_val->NAMA</u></b>
            </td>";

        }
        echo "</tr></table>";
        }
        ?>



<?PHP
    $content = ob_get_clean();
    // require_once "localhost/siaga/material/fpdf/html2pdf.class.php";
    $html2pdf = new HTML2PDF('L','A2','fr');
    $html2pdf->pdf->SetTitle("Laporan Usulan Anggaran Tahun $thn");
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('report_usulan_anggaran.pdf');
?>

