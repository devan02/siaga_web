<?PHP  ob_start(); ?>

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
		<table align="center">
            <tr>
                <td>
                    <img src="<?=base_url();?>files/pdam/logo-pdamtp.png" width="110" height="100" alt="KOP PDAM">
                </td>
                <td><img src="<?=base_url();?>files/pdam/kosong.png" width="620" height="100" alt="KOP PDAM"></td>
                <td>
                    <img src="<?=base_url();?>files/pdam/KOP_tulisan.png" width="550" height="100" alt="KOP PDAM">
                </td>
                <td><img src="<?=base_url();?>files/pdam/kosong.png" width="620" height="100" alt="KOP PDAM"></td>
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
                        RENCANA BIAYA UMUM DAN ADMINISTRASI <br>
                         TAHUN ANGGARAN : <?=$thn;?> (<?=$ket_periode;?>)
                    </h2>
                </td>
            </tr>

        </table>

        <br><br>



        <table align="center" class="grid">
            <thead>
                <tr>
                    <th rowspan="2"> NOMOR PERKIRAAN</th>
                    <th rowspan="2"> URAIAN </th>
                    <th colspan="12"> BULAN </th>
                    <th rowspan="2"> JUMLAH </th>
                </tr>
                <tr>
                    <th> Januari </th>
                    <th> Pebruari </th>
                    <th> Maret </th>
                    <th> April </th>
                    <th> Mei </th>
                    <th> Juni </th>
                    <th> Juli </th>
                    <th> Agustus </th>
                    <th> September </th>
                    <th> Oktober </th>
                    <th> Nopember </th>
                    <th> Desember </th>
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

                $last_key   = end(array_keys($dt));

                if( count($dt) > 0 ) {
                foreach ($dt as $key => $row) {                 

                $judul1 = TRIM($row->INDUK);

                if ($old_judul != $judul1) {
                    $old_judul  = $judul1 ;
                    echo "<tr>";
                    echo "<td class='judul'><b></b></td>" ;
                    echo "<td><b>".$row->INDUK."</b></td>" ;
                    echo "<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>" ;
                    echo "</tr>";
                }

                ?>
                
                <tr>
                    <?PHP if($row->STS_KODE != ''){ ?> 
                    <td text-align="right"><?=str_replace($row->STS_KODE.'-', '', $row->KODE_PERKIRAAN);?></td>
                    <?PHP } else { ?>
                    <td style="text-align:center;"><?=$row->KODE_PERKIRAAN;?></td>
                    <?PHP } ?>
                    <td><?=$row->NAMA_PERKIRAAN;?></td>
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
                    <td text-align="right"><?=str_replace(',', '.', number_format($row->JML)) ;?></td>
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

                $nama_perk = $row->INDUK;

                if($nama_perk == "BIAYA PEGAWAI ( Dibawah ADM & Keu )"){
                    $nama_perk = "Biaya Pegawai";
                } else if($nama_perk == "BIAYA PEMELIHARAAN AKTIVA TETAP"){
                    $nama_perk = "Biaya Pemeliharaan";
                }

                if ($judul1 != $next_judul1) {
                    echo "<tr>";
                    echo "<td class='judul'><b></b></td>" ;
                    echo "<td text-align='right'><b>Jumlah ".ucwords(strtolower($nama_perk))."</b></td>" ;
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
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJML))."</b></td>";                
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


                if ($judul1 != $next_judul1 && $row->INDUK == "BIAYA LAIN - LAIN") {
                    echo "<tr>";
                    echo "<td class='judul'><b></b></td>" ;
                    echo "<td text-align='right'><b>Jumlah Biaya Administrasi & Umum</b></td>" ;
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
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJML2))."</b></td>";                
                    echo "</tr>";
                

                }

                } 
            } else { ?>

            <tr>
                    <td style="text-align:center;" colspan="15"> <b> Tidak ada data </b> </td>
            </tr>

            <?PHP }
            ?>
            </tbody>
        </table>



<?PHP
    $content = ob_get_clean();
    // require_once "localhost/siaga/material/fpdf/html2pdf.class.php";
    $html2pdf = new HTML2PDF('L','A2','fr');
    $html2pdf->pdf->SetTitle("Rencana Biaya Umum dan Administrasi $thn");
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('rencana_biaya_umum_dan_adminstrasi_rinci.pdf');
?>

