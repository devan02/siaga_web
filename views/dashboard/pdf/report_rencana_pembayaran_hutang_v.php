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
                        RENCANA PEMBAYARAN HUTANG <br>
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
                $totJAN = 0; $totJAN2 = 0; $totJAN3 = 0; $totJAN4 = 0;
                $totFEB = 0; $totFEB2 = 0; $totFEB3 = 0; $totFEB4 = 0;
                $totMAR = 0; $totMAR2 = 0; $totMAR3 = 0; $totMAR4 = 0;
                $totAPR = 0; $totAPR2 = 0; $totAPR3 = 0; $totAPR4 = 0;
                $totMEI = 0; $totMEI2 = 0; $totMEI3 = 0; $totMEI4 = 0;
                $totJUN = 0; $totJUN2 = 0; $totJUN3 = 0; $totJUN4 = 0;
                $totJUL = 0; $totJUL2 = 0; $totJUL3 = 0; $totJUL4 = 0;
                $totAGU = 0; $totAGU2 = 0; $totAGU3 = 0; $totAGU4 = 0;
                $totSEP = 0; $totSEP2 = 0; $totSEP3 = 0; $totSEP4 = 0;
                $totOKT = 0; $totOKT2 = 0; $totOKT3 = 0; $totOKT4 = 0;
                $totNOP = 0; $totNOP2 = 0; $totNOP3 = 0; $totNOP4 = 0;
                $totDES = 0; $totDES2 = 0; $totDES3 = 0; $totDES4 = 0;
                $totJML = 0; $totJML2 = 0; $totJML3 = 0; $totJML4 = 0;

                $last_key   = end(array_keys($dt));

                if( count($dt) > 0 ) {
                foreach ($dt as $key => $row) {                 

                $judul1 = TRIM($row->INDUK);

                if ($old_judul != $judul1 && $row->URUT == 4 ) {
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

                $totJAN += $JAN;  $totJAN4 += $JAN;
                $totFEB += $FEB;  $totFEB4 += $FEB;
                $totMAR += $MAR;  $totMAR4 += $MAR;
                $totAPR += $APR;  $totAPR4 += $APR;
                $totMEI += $MEI;  $totMEI4 += $MEI;
                $totJUN += $JUN;  $totJUN4 += $JUN;
                $totJUL += $JUL;  $totJUL4 += $JUL;
                $totAGU += $AGU;  $totAGU4 += $AGU;
                $totSEP += $SEP;  $totSEP4 += $SEP;
                $totOKT += $OKT;  $totOKT4 += $OKT;
                $totNOP += $NOP;  $totNOP4 += $NOP;
                $totDES += $DES;  $totDES4 += $DES;
                $totJML += $JML;  $totJML4 += $JML;

                $nama_perk = $row->INDUK;

                if($nama_perk == "Utang Jk. Panj. Jatuh Tempo - Dalam Negeri"){

                    $nama_perk = "Pembayaran Utang J. Panj. - Dlm Negeri";
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

                } else if ($nama_perk == "Utang Jk. Panj. Jatuh-Tempo - Luar Negeri"){

                    $nama_perk = "Pembayaran Utang J. Panj. - Luar Negeri";
                    $totJAN3 += $JAN;
                    $totFEB3 += $FEB;
                    $totMAR3 += $MAR;
                    $totAPR3 += $APR;
                    $totMEI3 += $MEI;
                    $totJUN3 += $JUN;
                    $totJUL3 += $JUL;
                    $totAGU3 += $AGU;
                    $totSEP3 += $SEP;
                    $totOKT3 += $OKT;
                    $totNOP3 += $NOP;
                    $totDES3 += $DES;
                    $totJML3 += $JML;

                } else if ($nama_perk == "UTANG JANGKA PENDEK"){

                    $nama_perk = "<b>Pembayaran Utang Jangka Pendek</b>";

                }

                if ($judul1 != $next_judul1 && $row->URUT != 1)  {
                    echo "<tr>";
                    echo "<td class='judul'><b></b></td>" ;
                    echo "<td text-align='right'>Jumlah ".ucwords(strtolower($nama_perk))."</td>" ;
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

                if ($judul1 != $next_judul1 && $row->URUT != 1 && $row->INDUK == "Utang Jk. Panj. Jatuh-Tempo - Luar Negeri")  {
                    echo "<tr>";
                    echo "<td class='judul'><b></b></td>" ;
                    echo "<td text-align='center'><b>Jumlah  Pembayaran  Utang  J. Panj. Jth. Temp</b></td>" ;
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJAN2 + $totJAN3))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totFEB2 + $totFEB3))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totMAR2 + $totMAR3))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totAPR2 + $totAPR3))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totMEI2 + $totMEI3))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJUN2 + $totJUN3))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJUL2 + $totJUL3))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totAGU2 + $totAGU3))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totSEP2 + $totSEP3))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totOKT2 + $totOKT3))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totNOP2 + $totNOP3))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totDES2 + $totDES3))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJML2 + $totJML3))."</b></td>";  
              
                    echo "</tr>";
              

                }

                if ($judul1 != $next_judul1 && $row->URUT != 1 && $row->INDUK == "UTANG JANGKA PENDEK")  {
                    echo "<tr>";
                    echo "<td class='judul'><b></b></td>" ;
                    echo "<td text-align='center'><b>Jumlah  Pembayaran  Utang</b></td>" ;
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJAN4))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totFEB4))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totMAR4))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totAPR4))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totMEI4))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJUN4))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJUL4))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totAGU4))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totSEP4))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totOKT4))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totNOP4))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totDES4))."</b></td>";
                    echo "<td text-align='right'><b>".str_replace(',', '.', number_format($totJML4))."</b></td>";  
              
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
    $html2pdf->pdf->SetTitle("Rencana Pembayaran Hutang Tahun $thn");
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('rencana_pembayaran_hutang.pdf');
?>

