<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_usulan_anggaran.xls");
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
                        <?=$ket;?> <br>
                         TAHUN ANGGARAN : <?=$thn;?>
                    </h3>
                </td>
            </tr>

        </table>           
        

        <br><br>

        <table align="center" class="grid">
            <thead>
                <tr>
                    <th class="kolom_header" rowspan="2" style="width:100px;"> NO <br> PERKIRAAN</th>
                    <th class="kolom_header" style=""> URAIAN </th>
                    <th class="kolom_header" rowspan="2"> SUB BAGIAN </th>
                    <th class="kolom_header" rowspan="2"> TMT </th>
                    <th class="kolom_header" rowspan="2" style="width:60px;"> LAMA <br>(Hari) </th>                    
                    <th class="kolom_header" rowspan="2" style="width:60px;"> VOL </th>
                    <th class="kolom_header" rowspan="2" style="width:90px;"> SATUAN </th>
                    <th class="kolom_header" rowspan="2" style="width:90px;"> HARGA </th>
                    <th class="kolom_header" rowspan="2" style="width:90px;"> BIAYA </th>
                    <th class="kolom_header" colspan="12"> JADWAL PELAKSANAAN </th>
                </tr>
                <tr>
                    <th class="kolom_header" style="width:90px; padding-top:10px;"> KODE ANGGARAN</th>
                    <th class="kolom_header" style="width:90px;"> Januari </th>
                    <th class="kolom_header" style="width:90px;"> Pebruari </th>
                    <th class="kolom_header" style="width:90px;"> Maret </th>
                    <th class="kolom_header" style="width:90px;"> April </th>
                    <th class="kolom_header" style="width:90px;"> Mei </th>
                    <th class="kolom_header" style="width:90px;"> Juni </th>
                    <th class="kolom_header" style="width:90px;"> Juli </th>
                    <th class="kolom_header" style="width:90px;"> Agustus </th>
                    <th class="kolom_header" style="width:90px;"> September </th>
                    <th class="kolom_header" style="width:90px;"> Oktober </th>
                    <th class="kolom_header" style="width:90px;"> Nopember </th>
                    <th class="kolom_header" style="width:90px;"> Desember </th>
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
                    <td class="isi_table" text-align="center"><?=$row->KODE_PERKIRAAN;?></td>
                    <td class="isi_table"><?=$row->NAMA_PERKIRAAN;?> <br> <?=$row->KODE_ANGGARAN;?> </td>
                    <td class="isi_table" text-align="center"><?=$row->NAMA_DIVISI;?></td>
                    <td class="isi_table" text-align="center"><?=$row->TMT_PELAKSANAAN;?></td>
                    <td class="isi_table" text-align="center"><?=$row->LAMA_PELAKSANAAN;?></td>
                    <td class="isi_table" text-align="center"><?=$row->JUMLAH;?></td>
                    <td class="isi_table" text-align="center"><?=$row->SATUAN;?></td>                    
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->HARGA, 2, ",", "."));?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->TOTAL + $row->TOTAL_PELAKSANAAN, 2, ",", ".")) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->JANUARI, 2, ",", ".")) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->FEBRUARI, 2, ",", ".")) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->MARET, 2, ",", ".")) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->APRIL, 2, ",", ".")) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->MEI, 2, ",", ".")) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->JUNI, 2, ",", ".")) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->JULI, 2, ",", ".")) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->AGUSTUS, 2, ",", ".")) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->SEPTEMBER, 2, ",", ".")) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->OKTOBER, 2, ",", ".")) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->NOVEMBER, 2, ",", ".")) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($row->DESEMBER, 2, ",", ".")) ;?></td>
                    
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
                    <td class="isi_table" style="text-align:center;" colspan="8"> <b> TOTAL </b> </td>
                    <td class="isi_table" style="text-align:right;"><b><?=str_replace(',', '.', number_format($totJML, 2));?></b></td>
                    <td class="isi_table" style="text-align:right;"><b><?=str_replace(',', '.', number_format($totJAN, 2));?></b></td>
                    <td class="isi_table" style="text-align:right;"><b><?=str_replace(',', '.', number_format($totFEB, 2));?></b></td>
                    <td class="isi_table" style="text-align:right;"><b><?=str_replace(',', '.', number_format($totMAR, 2));?></b></td>
                    <td class="isi_table" style="text-align:right;"><b><?=str_replace(',', '.', number_format($totAPR, 2));?></b></td>
                    <td class="isi_table" style="text-align:right;"><b><?=str_replace(',', '.', number_format($totMEI, 2));?></b></td>
                    <td class="isi_table" style="text-align:right;"><b><?=str_replace(',', '.', number_format($totJUN, 2));?></b></td>
                    <td class="isi_table" style="text-align:right;"><b><?=str_replace(',', '.', number_format($totJUL, 2));?></b></td>
                    <td class="isi_table" style="text-align:right;"><b><?=str_replace(',', '.', number_format($totAGU, 2));?></b></td>
                    <td class="isi_table" style="text-align:right;"><b><?=str_replace(',', '.', number_format($totSEP, 2));?></b></td>
                    <td class="isi_table" style="text-align:right;"><b><?=str_replace(',', '.', number_format($totOKT, 2));?></b></td>
                    <td class="isi_table" style="text-align:right;"><b><?=str_replace(',', '.', number_format($totNOP, 2));?></b></td>
                    <td class="isi_table" style="text-align:right;"><b><?=str_replace(',', '.', number_format($totDES, 2));?></b></td>
            </tr>


            <?PHP
            } else { ?>

            <tr>
                    <td class="isi_table" style="text-align:center;" colspan="21"> <b> Tidak ada data </b> </td>
            </tr>

            <?PHP }
            ?>
            </tbody>
        </table>



<?php
exit()
?>
