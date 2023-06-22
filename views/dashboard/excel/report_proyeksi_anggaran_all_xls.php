<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Proyeksi_Anggaran.xls");
?>


<style>

.grid th {
	background: #1793d1;
	vertical-align: middle;
	color : #FFF;
	width: 100px;
    text-align: center;
    height: 80px;
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

}

.judul{
    height: 50px;
}

.kolom_header{
    height: 80px;
}





</style>
        <img src="<?=base_url();?>files/pdam/kop_surat.png" width="600" alt="KOP PDAM">

        <br><br><br><br><br><br>

        <table align="left">
            <tr>
                <td style="text-align:left;" colspan="20">
                    <h3 style="font-family:Arial; font-weight:normal; line-height:1.6;">
                        <b>
                         HASIL PEMBAHASAN AKHIR RENCANA KERJA DAN ANGGARAN PERUSAHAAN <br>
                         PDAM TIRTA PATRIOT - KOTA BEKASI <br>
                         TAHUN ANGGARAN : <?=$thn;?> (<?=$ket_periode;?>)
                        </b>
                    </h3>
                </td>
            </tr>

        </table>           


        <br><br>		

        <table align="center" border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
            <tr>
                <!-- LABA RUGI -->
                <td style="vertical-align:top;" align="center">
                    <h3><b>PROYEKSI LABA - RUGI TAHUN <?=$thn;?></b></h3>
                    <br>
                    <table cellspacing="2" class="grid" style="border-spacing: 0;">
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

                            $totJML = 0;
                            $totJML_pend = 0; 
                            $totJML_biaya_lgs = 0 ;    
                            $totJML_biaya_tdk_lgs = 0;               
                            $totJML_pend_biaya_luar = 0;
                            $laba_sblm_pajak = 0;
                            $totpph29 = 0;

                            $last_key   = end(array_keys($dt));

                            if( count($dt) > 0 ) {
                            foreach ($dt as $key => $row) { 

                            $nama_perk = $row->NAMA_PERKIRAAN;                

                            $judul1 = TRIM($row->INDUK);

                            if ($old_judul != $judul1) {
                                $old_judul  = $judul1 ;

                                if($judul1 != "PENDAPATAN USAHA"){
                                echo "<tr>";
                                echo "<td class='isi_table'><b></b></td>" ;
                                echo "<td class='isi_table'></td>" ;
                                echo "<td class='isi_table'></td>";
                                echo "</tr>";
                                }

                                echo "<tr>";
                                echo "<td class='isi_table'><b></b></td>" ;
                                echo "<td class='isi_table' style='text-align:left;'><b>".$row->INDUK."</b></td>" ;
                                echo "<td class='isi_table'></td>";
                                echo "</tr>";
                            }

                            ?>
                            <?PHP if($row->INDUK == "KEUNTUNGAN ( KERUGIAN ) LUAR BIASA"){ 
                                if($row->KODE_PERKIRAAN == "98.00.00"){
                                    $nama_perk = "Kerugian Luar Biasa";
                                }
                            ?> 

                            <tr>
                                <td class='isi_table' style="text-align:center;"><?=$row->KODE_PERKIRAAN;?></td>
                                <td class='isi_table' style='text-align:left;'><?=ucwords(strtolower($nama_perk));?></td>
                                <td class='isi_table' text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                            </tr>

                            <?PHP } else { 


                            ?>
                            <tr>
                                <td class='isi_table' style="text-align:center;"><?=$row->KODE_PERKIRAAN;?></td>
                                <td class='isi_table' style='text-align:left;'><?=ucwords(strtolower($row->NAMA_PERKIRAAN));?></td>                    
                                <td class='isi_table' text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($row->JML))) ;?></td>
                            </tr>

                             <?PHP if($row->KODE_PERKIRAAN == "96.00.00"){  ?> 
                            <tr>
                                <td class='isi_table' style="text-align:center;"></td>
                                <td class='isi_table' style="text-align:left;">Biaya Penyusutan thn Berjalan X NP</td>
                                <td class='isi_table' text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut1->JML))) ;?></td>
                            </tr>

                            <tr>
                                <td class='isi_table' style="text-align:center;"></td>
                                <td class='isi_table' style="text-align:left;">Biaya Penyusutan Thn Sebelumnya X NB</td>
                                <td class='isi_table' text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($susut2->JML))) ;?></td>
                            </tr>

                            <?PHP } ?>

                            <?PHP 
                            }
                        
                            $JML   = str_replace(',', '.', $row->JML);

                            if ($key < $last_key) {
                            $k          = $key + 1;
                            $next_judul1    = $dt[$k]->INDUK ;
                            }
                            else{
                                $next_judul1    = "" ;
                            }

                            if($row->INDUK == "PENDAPATAN / (BIAYA) DILUAR USAHA"){
                        
                            $totJML -= $JML;

                            } else {
                    
                            $totJML += $JML;

                            }

                            if($row->INDUK == "PENDAPATAN USAHA"){
                               
                                $totJML_pend = $totJML;
                            }

                            if($row->INDUK == "BIAYA LANGSUNG USAHA"){
                            
                                $totJML_biaya_lgs = $totJML;
                            }

                            if($row->INDUK == "BIAYA TIDAK LANGSUNG USAHA"){
                               
                                $totJML_biaya_tdk_lgs = $totJML + $susut1->JML + $susut2->JML;

                            }

                            if($row->INDUK == "PENDAPATAN / (BIAYA) DILUAR USAHA"){
                               
                                $totJML_pend_biaya_luar = $totJML;
                            }



                            if ($judul1 != $next_judul1 && $row->INDUK != "KEUNTUNGAN ( KERUGIAN ) LUAR BIASA") {

                                echo "<tr>";
                                echo "<td class='isi_table'><b></b></td>" ;
                                echo "<td class='isi_table'></td>" ;
                                echo "<td class='isi_table'></td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td class='isi_table'><b></b></td>" ;
                                echo "<td class='isi_table'text-align='right'><b>Jumlah ".ucwords(strtolower($row->INDUK))."</b></td>" ;                   
                                echo "<td class='isi_table'text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML)))."</b></td>";                
                                echo "</tr>";
                            
                                $totJML = 0;

                            }


                            if($judul1 != $next_judul1 && $row->INDUK == "BIAYA LANGSUNG USAHA"){

                                echo "<tr>";
                                echo "<td class='isi_table'><b></b></td>" ;
                                echo "<td class='isi_table'></td>" ;
                                echo "<td class='isi_table'></td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td class='isi_table'><b></b></td>" ;
                                echo "<td class='isi_table'text-align='left'><b>Laba / ( Rugi ) Kotor Usaha</b></td>" ;                    
                                echo "<td class='isi_table'text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_pend - $totJML_biaya_lgs)))."</b></td>";                     
                                echo "</tr>";
                            }

                            if($judul1 != $next_judul1 && $row->INDUK == "BIAYA TIDAK LANGSUNG USAHA"){

                                echo "<tr>";
                                echo "<td class='isi_table'><b></b></td>" ;
                                echo "<td class='isi_table'></td>" ;
                                echo "<td class='isi_table'></td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td class='isi_table'><b></b></td>" ;     
                                echo "<td class='isi_table' text-align='left'><b>Laba / ( Rugi ) Usaha</b></td>" ;              
                                echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs)))."</b></td>";                    
                                echo "</tr>";
                            }

                            if($judul1 != $next_judul1 && $row->INDUK == "PENDAPATAN / (BIAYA) DILUAR USAHA"){

                                echo "<tr>";
                                echo "<td class='isi_table'><b></b></td>" ;
                                echo "<td class='isi_table'></td>" ;
                                echo "<td class='isi_table'></td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td class='isi_table'><b></b></td>" ;
                                echo "<td class='isi_table' text-align='left'><b>Laba / ( Rugi ) Sebelum Pos Luar Biasa</b></td>" ;
                                echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar)))."</b></td>";                    
                                echo "</tr>";
                            }

                            if($judul1 != $next_judul1 && $row->INDUK == "KEUNTUNGAN ( KERUGIAN ) LUAR BIASA"){


                                if($pph29 == null || $pph29 == ""){

                                  $laba_sblm_pajak = $totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar;
                                  $totpph29 = $laba_sblm_pajak;
                                  $totpph29 = ($totpph29 * 25) / 100;  

                                } else {

                                  $laba_sblm_pajak = $totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar;
                                  $totpph29 = $laba_sblm_pajak + ($pph29->TOTAL1 - $pph29->TOTAL2);
                                  $totpph29 = ($totpph29 * 25) / 100;  

                                }
                                
                                echo "<tr>";
                                echo "<td class='isi_table'><b></b></td>" ;
                                echo "<td class='isi_table'></td>" ;
                                echo "<td class='isi_table'></td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td class='isi_table'><b></b></td>" ;
                                echo "<td class='isi_table' text-align='left'><b>Laba / ( Rugi ) Sebelum Pajak</b></td>" ;
                                echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar)))."</b></td>";                   
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td class='isi_table'><b></b></td>" ;
                                echo "<td class='isi_table'></td>" ;
                                echo "<td class='isi_table'></td>";
                                echo "</tr>";
                                

                                echo "<tr>";
                                echo "<td class='isi_table'><b></b></td>" ;
                                echo "<td class='isi_table' text-align='left'>Taksiran Pajak Badan (PPh 29)</td>" ;
                                echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totpph29)))."</b></td>";                  
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td class='isi_table'><b></b></td>" ;
                                echo "<td class='isi_table'><b>".$row->INDUK."</b></td>" ;
                                echo "<td class='isi_table'></td>";
                                echo "</tr>";


                                echo "<tr>";
                                echo "<td class='isi_table'><b></b></td>" ;
                                echo "<td class='isi_table' text-align='left'><b>Laba / ( Rugi ) Bersih</b></td>" ;
                                echo "<td class='isi_table' text-align='right'><b>".format_akuntansi(str_replace(',', '.', number_format($totJML_pend - $totJML_biaya_lgs - $totJML_biaya_tdk_lgs + $totJML_pend_biaya_luar - $totpph29)))."</b></td>";                 
                                echo "</tr>";
                            }


                            } 
                        } else { ?>

                        <tr>
                                <td class='isi_table' style="text-align:center;" colspan="3"> <b> Tidak ada data </b> </td>
                        </tr>

                        <?PHP }
                        ?>
                        </tbody>
                    </table>
                </td>

                <td style="width:130px;"></td>

                <!-- ARUS KAS -->
                <td style="vertical-align:top;" align="center">
                    <h3><b>PROYEKSI ARUS KAS TAHUN <?=$thn;?></b></h3>
                    <br>
                    <table cellspacing="2" class="grid" style="border-spacing: 0;">
                        <thead>
                            <tr>
                                <th class="kolom_header" style="width:50px;">NO</th>
                                <th class="kolom_header">URAIAN</th>
                                <th class="kolom_header">JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class='isi_table' align="center">I</td>
                                <td class='isi_table' align="left"><b>PROYEKSI PENERIMAAN KAS</b></td>
                                <td class='isi_table' align="center"></td>
                            </tr>
                            <tr>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                            </tr>
                            <tr>
                                <td class='isi_table' align="center">1.</td>
                                <td class='isi_table' align="left"><b>Penerimaan Operasi</b></td>
                                <td class='isi_table' align="center"></td>
                            </tr>
                            <tr>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                            </tr>
                            <?php
                                $no = 0;
                                $tot_jumlah = 0;

                                foreach ($arus as $data_detil) {
                                    if($data_detil->JENIS == "Penerimaan Operasi"){
                                        $jumlah = $data_detil->JUMLAH;
                            ?>
                            <tr>
                                <td class='isi_table'>&nbsp;</td>
                                <td class='isi_table' style='text-align:left;'><?php echo $data_detil->URAIAN; ?></td>
                                <td class='isi_table' align="right"><?php echo number_format($jumlah,0,',','.'); ?></td>
                            </tr>
                            <?php
                                    $tot_jumlah += $jumlah;
                                    }
                                }
                            ?>
                            <tr>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                            </tr>
                            <tr>
                                <td class='isi_table'></td>
                                <td class='isi_table' align="right">Jumlah Penerimaan Operasi</td>
                                <td class='isi_table' align="right"><?php echo number_format($tot_jumlah,0,',','.'); ?></td>
                            </tr>
                            <tr>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                            </tr>
                            <tr>
                                <td class='isi_table' align="center">2.</td>
                                <td class='isi_table' align="left"><b>Penerimaan Non Operasi</b></td>
                                <td class='isi_table' align="center"></td>
                            </tr>
                            <tr>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                            </tr>
                            <?php
                                $tot_jumlah2 = 0;

                                foreach ($arus as $data_detil) {
                                    if($data_detil->JENIS == "Penerimaan Non Operasi"){
                                        $jumlah = $data_detil->JUMLAH;
                            ?>
                            <tr>
                                <td class='isi_table'>&nbsp;</td>
                                <td class='isi_table' style='text-align:left;'><?php echo $data_detil->URAIAN; ?></td>
                                <td class='isi_table' align="right"><?php echo number_format($jumlah,0,',','.'); ?></td>
                            </tr>
                            <?php
                                    $tot_jumlah2 += $jumlah;
                                    }
                                }
                            ?>
                            <tr>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                            </tr>
                            <tr>
                                <td class='isi_table'></td>
                                <td class='isi_table' align="right">Jumlah Penerimaan Non Operasi</td>
                                <td class='isi_table' align="right"><?php echo number_format($tot_jumlah2,0,',','.'); ?></td>
                            </tr>
                            <tr>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                            </tr>
                            <?php
                                $jum_jumlah_terima = $tot_jumlah + $tot_jumlah2;
                            ?>
                            
                            <tr>
                                <td class='isi_table'></td>
                                <td class='isi_table' align="center">Jumlah Penerimaan Kas</td>
                                <td class='isi_table' align="right"><?php echo number_format($jum_jumlah_terima,0,',','.'); ?></td>
                            </tr>
                            <tr>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                            </tr>
                            <tr>
                                <td class='isi_table' align="center">II</td>
                                <td class='isi_table' align="left"><b>PROYEKSI PENGELUARAN KAS</b></td>
                                <td class='isi_table' align="center"></td>
                            </tr>
                            <tr>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                            </tr>
                            <tr>
                                <td class='isi_table' align="center">1.</td>
                                <td class='isi_table' align="left"><b>Pengeluaran Operasi</b></td>
                                <td class='isi_table' align="center"></td>
                            </tr>
                            <tr>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                                <td class='isi_table'></td>
                            </tr>
                            <?php
                                $tot_luar_jumlah = 0;
                                foreach ($arus as $data_detil) {
                                    if($data_detil->JENIS == "Pengeluaran Operasi"){
                                        $jumlah = $data_detil->JUMLAH;
                            ?>
                                <tr>
                                    <td class='isi_table'>&nbsp;</td>
                                    <td class='isi_table' style='text-align:left;'><?php echo $data_detil->URAIAN; ?></td>
                                    <td class='isi_table' align="right"><?php echo number_format($jumlah,0,',','.'); ?></td>
                                </tr>
                            <?php
                                        $tot_luar_jumlah += $jumlah;
                                    }
                                }
                            ?>
                                <tr>
                                    <td class='isi_table'></td>
                                    <td class='isi_table'></td>
                                    <td class='isi_table'></td>
                                </tr>
                                <tr>
                                    <td class='isi_table'>&nbsp;</td>
                                    <td class='isi_table' align="right">Jumlah Pengeluaran Operasi</td>
                                    <td class='isi_table' align="right"><?php echo number_format($tot_luar_jumlah,0,',','.'); ?></td>
                                </tr>
                                <tr>
                                    <td class='isi_table'></td>
                                    <td class='isi_table'></td>
                                    <td class='isi_table'></td>
                                </tr>
                                <tr>
                                    <td class='isi_table' align="center">2.</td>
                                    <td class='isi_table' align="left"><b>Pengeluaran Non Operasi</b></td>
                                    <td class='isi_table' align="center"></td>
                                </tr>
                                <tr>
                                    <td class='isi_table'></td>
                                    <td class='isi_table'></td>
                                    <td class='isi_table'></td>
                                </tr>
                            <?php
                                $tot_luar_jumlah2 = 0;
                                foreach ($arus as $data_detil) {
                                    if($data_detil->JENIS == "Pengeluaran Non Operasi"){
                                        $jumlah = $data_detil->JUMLAH;
                            ?>

                                <tr>
                                    <td class='isi_table'>&nbsp;</td>
                                    <td class='isi_table' style='text-align:left;'><?php echo $data_detil->URAIAN; ?></td>
                                    <td class='isi_table' align="right"><?php echo number_format($jumlah,0,',','.'); ?></td>
                                </tr>
                            <?php
                                        $tot_luar_jumlah2 += $jumlah;
                                    }
                                }
                            ?>
                                <tr>
                                    <td class='isi_table'></td>
                                    <td class='isi_table'></td>
                                    <td class='isi_table'></td>
                                </tr>
                                <tr>
                                    <td class='isi_table'>&nbsp;</td>
                                    <td class='isi_table'>Jumlah Pengeluaran Non Operasi</td>
                                    <td class='isi_table' align="right"><?php echo number_format($tot_luar_jumlah2,0,',','.'); ?></td>
                                </tr>
                                <?php
                                    $jum_jumlah_luar = $tot_luar_jumlah + $tot_luar_jumlah2;
                                ?>
                                <tr>
                                    <td class='isi_table'></td>
                                    <td class='isi_table'></td>
                                    <td class='isi_table'></td>
                                </tr>
                                <tr>
                                    <td class='isi_table'>&nbsp;</td>
                                    <td class='isi_table' align="center">Jumlah Pengeluaran Kas</td>
                                    <td class='isi_table' align="right"><?php echo number_format($jum_jumlah_luar,0,',','.'); ?></td>
                                </tr>
                                <tr>
                                    <td class='isi_table'></td>
                                    <td class='isi_table'></td>
                                    <td class='isi_table'></td>
                                </tr>
                                <?php
                                    $hasil_jumlah = $jum_jumlah_terima - $jum_jumlah_luar;
                                ?>
                                <tr>
                                    <td class='isi_table'>III</td>
                                    <td class='isi_table' style='text-align:left;'><b>KENAIKAN / (PENURUNAN) KAS</b></td>
                                    <td class='isi_table' align="right"><?php echo angka_positif($hasil_jumlah); ?></td>
                                </tr>
                                <tr>
                                    <td class='isi_table'></td>
                                    <td class='isi_table'></td>
                                    <td class='isi_table'></td>
                                </tr>
                                <?php
                                    foreach ($arus as $data_detil) {
                                        if($data_detil->JENIS == "Saldo Awal"){
                                            $jumlah_sa = $data_detil->JUMLAH;  
                                ?>
                                <tr>
                                    <td class='isi_table'>IV</td>
                                    <td class='isi_table' style='text-align:left;'><b><?php echo $data_detil->URAIAN; ?></b></td>
                                    <td class='isi_table' align="right"><?php echo number_format($jumlah_sa,0,',','.'); ?></td>
                                </tr>

                                <?php
                                        }
                                    }
                                ?>
                                <?php
                                    $saldo_akhir_jumlah = $hasil_jumlah+$jumlah_sa;
                                ?>
                                <tr>
                                    <td class='isi_table'>V</td>
                                    <td class='isi_table' style="font-weight:bold; text-align:left;">SALDO AKHIR KAS</td>
                                    <td class='isi_table' style="font-weight:bold;" align="right"><?php echo number_format($saldo_akhir_jumlah,0,',','.'); ?></td>
                                </tr>
                        </tbody>
                    </table>   
                </td>

                <td style="width:130px;"></td>

                <!-- NERACA -->
                <td style="vertical-align:top;" align="center">
                <h3><b>PROYEKSI NERACA TAHUN <?=$thn;?></b></h3>
                <br>
                <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;" class="grid">
                    <tr>
                        <td style="vertical-align:top;">
                            <table cellspacing="2" class="grid" style="border-spacing: 0;">
                                <thead>
                                    <tr>
                                        <th class="kolom_header"> URAIAN</th>
                                        <th class="kolom_header"> PROYEKSI AKTIVA </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?PHP
                                    $old_judul = "";
                                    $old_sub_judul = "";
                                    $old_judul2 = "";
                                    $old_sub_judul2 = "";
                                    $next_judul1 = "";
                                    $next_judul2 = "";
                                    $TOT_NILAI  = 0;     
                                    $SUM_TOT_NILAI       = 0;
                                    $TOT_NILAI_AKTIVA       = 0;

                                    $penyesuaian = $get_penyesuaian->NILAI_KEWAJIBAN -  $get_penyesuaian->NILAI_AKTIVA;


                                    $last_key   = end(array_keys($setup));
                                    foreach ($setup as $key => $set) {
                                        if($set->STS == "AKTIVA"){
                                            $judul1 = TRIM($set->AKTIVA_INDUK1);
                                            $judul2 = TRIM($set->AKTIVA_INDUK2);

                                            if ($old_judul != $judul1) {
                                                $old_judul  = $judul1 ;
                                                echo "<tr><td class='isi_table'></td> <td class='isi_table'></td> </tr>";
                                                echo "<tr>";
                                                echo "<td style='text-align:left;' class='isi_table'><b>".$set->AKTIVA_INDUK1."</b></td>" ;
                                                echo "<td class='isi_table'></td>";
                                                echo "</tr>";
                                            }

                                            if ($old_sub_judul != $judul2 && $judul2 != "a") {
                                                $old_sub_judul  = $judul2 ;
                                                echo "<tr>";
                                                echo "<td style='text-align:left;' class='isi_table'>&nbsp; <b>".$set->AKTIVA_INDUK2."</b></td>" ;
                                                echo "<td class='isi_table'></td>";
                                                echo "</tr>";
                                            }


                                            if($set->AKTIVA_INDUK1 != "AKTIVA TETAP"){
                                                echo "<tr>";
                                                if($set->AKTIVA_JUDUL == "" || $set->AKTIVA_JUDUL == null){
                                                echo "<td class='isi_table' style='text-align:left;'>&nbsp;&nbsp;".$set->AKTIVA_JUDUL."</td>" ;
                                                } else {
                                                echo "<td class='isi_table' style='text-align:left;'>&nbsp;&nbsp; - ".$set->AKTIVA_JUDUL."</td>" ;    
                                                }
                                                echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($set->NILAI))."</td>";
                                                echo "</tr>";
                                            }

                                            $NILAI         = str_replace(',', '.', $set->NILAI);

                                            if ($key < $last_key) {
                                            $k          = $key + 1;
                                            $next_judul1    = $setup[$k]->AKTIVA_INDUK1;
                                            }
                                            else{
                                                $next_judul1    = "" ;
                                            }

                                            $TOT_NILAI         += $NILAI;
                                            $SUM_TOT_NILAI       += $NILAI;

                                            if($set->AKTIVA_INDUK1 == "AKTIVA TETAP"){
                                                $TOT_NILAI_AKTIVA         += $NILAI;
                                            }

                                            if ($judul1 != $next_judul1 && $judul1 == "AKTIVA TETAP") {

                                                echo "<tr>";
                                                echo "<td class='isi_table' style='text-align:left;'>- Nilai Perolehan</td>" ;
                                                echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI))."</td>";
                                                echo "</tr>";

                                            }
                                            

                                            if ($judul1 != $next_judul1) {


                                                echo "<tr>";
                                                echo "<td class='isi_table' style='text-align:right;'>Jumlah ".$set->AKTIVA_INDUK1."</td>" ;
                                                echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI))."</td>";
                                                echo "</tr>";

                                                $TOT_NILAI        = 0;
                                            }

                                            if ($judul1 != $next_judul1 && $set->AKTIVA_INDUK1 == "AKTIVA LANCAR") {
                                                echo "<tr><td class='isi_table'></td><td class='isi_table'></td></tr>";
                                                echo "<tr>";
                                                echo "<td style='text-align:left;' class='isi_table'><b>INVESTASI JANGKA PANJANG</b></td>" ;
                                                echo "<td class='isi_table'></td>";
                                                echo "</tr>";
                                            }

                                            if ($judul1 != $next_judul1 && $set->AKTIVA_INDUK1 == "AKTIVA TETAP") {

                                                echo "<tr><td class='isi_table'></td><td class='isi_table'></td></tr>";
                                                echo "<tr>";
                                                echo "<td style='text-align:left;' class='isi_table'> - Akumulasi Penyusutan</td>" ;
                                                echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($penyesuaian)))."</td>";
                                                echo "</tr>";


                                                echo "<tr>";
                                                echo "<td class='isi_table' style='text-align:right;'>Nilai Buku Aktiva Tetap</td>" ;
                                                echo "<td class='isi_table' style='text-align:right;'>".format_akuntansi(str_replace(',', '.', number_format($penyesuaian + $TOT_NILAI_AKTIVA)))."</td>";
                                                echo "</tr>";

                                                echo "<tr><td class='isi_table'></td><td class='isi_table'></td></tr>";
                                                echo "<tr>";
                                                echo "<td style='text-align:left;' class='isi_table'><b>Aktiva Tetap Leasing</b></td>" ;
                                                echo "<td class='isi_table'></td>";
                                                echo "</tr>";
                                            }
                                        }                                

                                    }

                                    echo "<tr>";
                                    echo "<td class='isi_table' style='text-align:left;'><b>JUMLAH AKTIVA</b></td>" ;
                                    echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($SUM_TOT_NILAI + $penyesuaian))."</td>";
                                    echo "</tr>";
                                ?>  
                                </tbody>
                            </table>
                        </td>

                        <td style="vertical-align:top;">
                            <table cellspacing="2" class="grid">
                                <thead>
                                    <tr>
                                        <th class="kolom_header"> URAIAN</th>
                                        <th class="kolom_header"> PROYEKSI PASIVA </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?PHP
                                        $old_judul = "";
                                        $old_sub_judul = "";
                                        $old_judul2 = "";
                                        $old_sub_judul2 = "";
                                        $next_judul1 = "";
                                        $next_judul2 = "";
                                        $TOT_NILAI  = 0;     
                                        $SUM_TOT_NILAI       = 0;

                                        $last_key   = end(array_keys($setup));
                                        foreach ($setup as $key => $set) {
                                            if($set->STS == "KEWAJIBAN"){
                                                $judul1 = TRIM($set->KEWAJIBAN_INDUK1);
                                                $judul2 = TRIM($set->KEWAJIBAN_INDUK2);

                                                if ($old_judul != $judul1) {
                                                    $old_judul  = $judul1 ;
                                                    echo "<tr><td class='isi_table'></td><td></td></tr>";
                                                    echo "<tr>";
                                                    echo "<td style='text-align:left;' class='isi_table'><b>".$set->KEWAJIBAN_INDUK1."</b></td>" ;
                                                    echo "<td class='isi_table'></td>";
                                                    echo "</tr>";
                                                }

                                                if ($old_sub_judul != $judul2 && $judul2 != "a") {
                                                    $old_sub_judul  = $judul2 ;
                                                    echo "<tr>";
                                                    echo "<td style='text-align:left;' class='isi_table'>&nbsp; <b>".$set->KEWAJIBAN_INDUK2."</b></td>" ;
                                                    echo "<td class='isi_table'></td>";
                                                    echo "</tr>";
                                                }


                                                echo "<tr>";
                                                if($set->KEWAJIBAN_JUDUL == "" || $set->KEWAJIBAN_JUDUL == null){
                                                echo "<td class='isi_table' style='text-align:left;'>&nbsp;&nbsp;".$set->KEWAJIBAN_JUDUL."</td>" ;
                                                } else {
                                                echo "<td class='isi_table' style='text-align:left;'>&nbsp;&nbsp; - ".$set->KEWAJIBAN_JUDUL."</td>" ;    
                                                }
                                                 echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($set->NILAI))."</td>";;
                                                 echo "</tr>";

                                                $NILAI         = str_replace(',', '.', $set->NILAI);

                                                if ($key < $last_key) {
                                                $k          = $key + 1;
                                                $next_judul1    = $setup[$k]->KEWAJIBAN_INDUK1;
                                                }
                                                else{
                                                    $next_judul1    = "" ;
                                                }

                                                if ($key < $last_key) {
                                                $k          = $key + 1;
                                                $next_judul2    = $setup[$k]->KEWAJIBAN_INDUK2;
                                                }
                                                else{
                                                    $next_judul2    = "" ;
                                                }

                                                $TOT_NILAI         += $NILAI;
                                                $SUM_TOT_NILAI         += $NILAI;

                                                if ($judul2 != $next_judul2 && $judul2 != "a") {

                                                    echo "<tr>";
                                                    echo "<td class='isi_table' style='text-align:right;'>Jumlah ".$set->KEWAJIBAN_INDUK2."</td>" ;
                                                    echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI))."</td>";
                                                    echo "</tr>";

                                                    $TOT_NILAI        = 0;
                                                }


                                                if ($judul1 != $next_judul1) {

                                                    $nama_perk = $set->KEWAJIBAN_INDUK1;
                                                    if($nama_perk == "KEWAJIBAN JK. PANJANG & LAIN - LAIN"){
                                                        $nama_perk = "KEWAJIBAN JK. PANJANG";
                                                    }

                                                    echo "<tr>";
                                                    echo "<td class='isi_table' style='text-align:right;'>Jumlah ".$nama_perk."</td>" ;
                                                    echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($TOT_NILAI))."</td>";
                                                    echo "</tr>";

                                                    $TOT_NILAI        = 0;
                                                }


                                            }

                                        }


                                        echo "<tr><td class='isi_table'></td> <td class='isi_table'></td></tr>";

                                        echo "<tr>";
                                        echo "<td class='isi_table' style='text-align:left;'><b>JUMLAH KEWAJIBAN DAN MODAL</b></td>" ;
                                        echo "<td class='isi_table' style='text-align:right;'>".str_replace(',', '.', number_format($SUM_TOT_NILAI))."</td>";
                                        echo "</tr>";
                                    ?> 
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>

                </td>
            </tr>
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
    
    function angka_positif($angka){
        if($angka < 0){
            $angka = -$angka;
            $angka = "(".number_format($angka,0,',','.').")";
        }else{
            $angka = number_format($angka,0,',','.');
        }
        return $angka;
    }

?>



<?php
exit()
?>
