<?php
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$filename.xls");
?>
    
<img src="<?=base_url();?>files/pdam/kop_surat.png" width="600" height="110" alt="KOP PDAM">

<br><br>

<table>
    <tr>
        <td colspan="23" align="center">
            <h3 style="font-family:Arial; font-weight:bold; line-height:1.4;">
                RENCANA KERJA DAN ANGGARAN PERUSAHAAN REVISI<br>
                 <?php echo $ket; ?> <br>
                 TAHUN ANGGARAN : <?php echo $thn; ?>
            </h3>
        </td>
    </tr>
</table>

<br><br>

<table align="center" border="1">
    <thead>
        <tr>
            <th style="background:#1793d1; color:#FFF;">No</th>
            <th style="background:#1793d1; color:#FFF;">Perkiraan</th>
            <th style="background:#1793d1; color:#FFF;">Uraian</th>
            <th style="background:#1793d1; color:#FFF;">Divisi</th>
            <th style="background:#1793d1; color:#FFF;">Vol Usulan</th>
            <th style="background:#1793d1; color:#FFF;">Vol Setuju</th>
            <th style="background:#1793d1; color:#FFF;">Satuan</th>
            <th style="background:#1793d1; color:#FFF;">Harga Satuan</th>
            <th style="background:#1793d1; color:#FFF;">RKAP <?php echo $thn;?></th>
            <th style="background:#1793d1; color:#FFF;">Revisi</th>
            <th style="background:#1793d1; color:#FFF;">Ket</th>
            <th style="background:#1793d1; color:#FFF;">Januari</th>
            <th style="background:#1793d1; color:#FFF;">Februari</th>
            <th style="background:#1793d1; color:#FFF;">Maret</th>
            <th style="background:#1793d1; color:#FFF;">April</th>
            <th style="background:#1793d1; color:#FFF;">Mei</th>
            <th style="background:#1793d1; color:#FFF;">Juni</th>
            <th style="background:#1793d1; color:#FFF;">Juli</th>
            <th style="background:#1793d1; color:#FFF;">Agustus</th>
            <th style="background:#1793d1; color:#FFF;">September</th>
            <th style="background:#1793d1; color:#FFF;">Oktober</th>
            <th style="background:#1793d1; color:#FFF;">November</th>
            <th style="background:#1793d1; color:#FFF;">Desember</th>
        </tr>
    </thead>    
    <tbody>
    <?php
        $no = 0;
        $total_semua1 = 0;
        $total_semua2 = 0;
        $total_all1 = 0;
        $total_all2 = 0;

        $old_judul = "";
        $old_judul2 = "";
        $next_judul1 = "";
        $next_judul2 = "";

        $last_key   = end(array_keys($koper));

        foreach ($koper as $key => $row) {

            echo "<tr>";
            echo "<td colspan='23' style='padding-left:10px;'></td>" ;
            echo "</tr>";

            $kode_perkiraan = $row->KODE_PERKIRAAN2;

            $dat_nama = $this->db->query("select a.NAMA_PERKIRAAN from stp_setup_kode_perkiraan a 
                                    where trim(a.KODE_PERKIRAAN)='$kode_perkiraan' ")->row();
            if ($dat_nama != null) {
                $nama_perkiraan = $dat_nama->NAMA_PERKIRAAN;
            } else {
                $nama_perkiraan = "" ;
            }

            $judul1 = TRIM($row->INDUK_KODE);

            if ($old_judul != $judul1) {
                $old_judul  = $judul1 ;
                echo "<tr>";
                echo "<td colspan='23' style='padding-left:7px;'><b>".$row->INDUK_KODE." - ".$row->NAMA_PERKIRAAN2."</b></td>" ;
                echo "</tr>";
            }

    ?>
        <tr>
            <td colspan="23" style="padding-left:15px;"><b><?php echo $row->KODE_PERKIRAAN." - ".$row->NAMA_PERKIRAAN; ?></b></td>
        </tr>
        <?php 
            $data_detil = $data_detil = $this->model->get_report_rinci($row->KODE_PERKIRAAN,$thn,$krit,$dep,$div);
            $total_rkap = 0;
            $total_rkap1 = 0;
            $ket = "-";

            foreach ($data_detil as $row_detil) {
                $no++;
                if($row_detil->CAT_TAMBAHAN != "" ){
                    $ket = $row_detil->CAT_TAMBAHAN;
                }

                $total = 0;

                if($row_detil->JENIS_ANGGARAN == "Barang"){
                    $total = $row_detil->TOTAL;
                }else{
                    $total = $row_detil->TOTAL_PELAKSANAAN;
                }

                $jumlah_rkap = $row_detil->JUMLAH_DASAR;
                $jumlah_revisi = $row_detil->JUMLAH_REVISI;
                $jumlah_usulan = $row_detil->JUMLAH_USULAN;
                $real_vol = $row_detil->REAL_VOL;
                $harga_satuan = $row_detil->HARGA;
                $rkap = $jumlah_rkap * $harga_satuan;
                $revisi = $jumlah_revisi * $harga_satuan;
                $realisasi = $row_detil->REALISASI;

                $warna = "";
                $rkap_fix = 0;
                $revisi_fix = 0;

                if($row_detil->REALISASI > $total && $row_detil->REALISASI > 0){
                //MERAH
                    $warna = "style='background:#ff2b00; color:#fff;'";
                    //jumlah
                    $jumlah_rkap = $jumlah_rkap;
                    $jumlah_revisi = $real_vol;
                    //rkap
                    $rkap_fix = $rkap;
                    $revisi_fix = $realisasi;
                }else if($row_detil->REALISASI < $total && $row_detil->REALISASI > 0){
                //KUNING
                    $warna = "style='background:#ffe600; color:#000;'";
                    //jumlah
                    $jumlah_rkap = $jumlah_rkap;
                    $jumlah_revisi = $real_vol;
                    //rkap
                    $rkap_fix = $rkap;
                    $revisi_fix = $realisasi;
                }else if($row_detil->STS_TAMBAHAN == 4){
                //ORANGE
                    $warna = "style='background:#f99104; color:#fff;'";
                    //jumlah
                    $jumlah_rkap = $jumlah_rkap;
                    $jumlah_revisi = $jumlah_rkap;
                    //rkap
                    $rkap_fix = $rkap;
                    $revisi_fix = $rkap;
                }else if($row_detil->STS_TAMBAHAN == 1 && $row_detil->STS_REVISI == 6){
                //BIRU
                    $warna = "style='background:#0079C1; color:#fff;'";
                    //jumlah
                    $jumlah_rkap = $jumlah_rkap;
                    $jumlah_revisi = $jumlah_revisi;
                    //rkap
                    $rkap_fix = $rkap;
                    $revisi_fix = $revisi;
                }else if($row_detil->STS_REVISI == 5){
                //BIRU
                    $warna = "style='background:#0079C1; color:#fff;'";
                    //jumlah
                    $jumlah_rkap = $jumlah_rkap;
                    $jumlah_revisi = $jumlah_revisi;
                    //rkap
                    $rkap_fix = $rkap;
                    $revisi_fix = $revisi;
                }else if($row_detil->STS_TAMBAHAN == 3){
                //UNGU
                    $warna = "style='background:#8e44ad; color:#fff;'";
                    //jumlah
                    $jumlah_rkap = $jumlah_rkap;
                    $jumlah_revisi = $jumlah_rkap;
                    //rkap
                    $rkap_fix = $rkap;
                    $revisi_fix = $rkap;
                }else{
                //PUTIH
                    $warna = "style='background:#fff; color:#000;'";
                    //jumlah
                    $jumlah_rkap = $jumlah_rkap;
                    $jumlah_revisi = $jumlah_rkap;
                    //rkap
                    $rkap_fix = $rkap;
                    $revisi_fix = $rkap;
                }

                $jumlah_rkap = ($jumlah_rkap == null || $jumlah_rkap == '') ? 0 : $jumlah_rkap;
                $jumlah_revisi = ($jumlah_revisi == null || $jumlah_revisi == '') ? 0 : $jumlah_revisi;
        ?>    
        <tr>
            <td <?php echo $warna; ?> align="center"><?php echo $no; ?></td>
            <td <?php echo $warna; ?>><?php echo $row_detil->KODE_ANGGARAN; ?></td>
            <td <?php echo $warna; ?>><?php echo $row_detil->URAIAN; ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo $row_detil->NAMA_DIVISI; ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo $jumlah_rkap; ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo $jumlah_revisi; ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo trim($row_detil->SATUAN); ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo number_format($harga_satuan,2,',','.'); ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo number_format($rkap_fix, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo number_format($revisi_fix, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo $ket; ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo number_format($row_detil->JANUARI, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo number_format($row_detil->FEBRUARI, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo number_format($row_detil->MARET, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo number_format($row_detil->APRIL, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo number_format($row_detil->MEI, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo number_format($row_detil->JUNI, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo number_format($row_detil->JULI, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo number_format($row_detil->AGUSTUS, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo number_format($row_detil->SEPTEMBER, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo number_format($row_detil->OKTOBER, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo number_format($row_detil->NOVEMBER, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> align="center"><?php echo number_format($row_detil->DESEMBER, 2, ",", "."); ?></td>
        </tr>
        <?php 
                $total_rkap = $total_rkap + $rkap_fix;
                $total_rkap1 = $total_rkap1 + $revisi_fix;
                
                $total_semua1 += $rkap_fix;
                $total_semua2 += $revisi_fix;

                $total_all1 += $rkap_fix;
                $total_all2 += $revisi_fix;
            }
        ?>
        <tr>
            <td colspan="8">Sub Total Biaya RKAP </td>
            <td><?php echo "Rp. ".str_replace(',', '.', number_format($total_rkap, 2, ",", ".")) ;?></td>
            <td>&nbsp;</td>
            <td><b></b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td colspan="8">Sub Total Biaya Revisi </td>
            <td>&nbsp;</td>
            <td><?php echo "Rp. ".str_replace(',', '.', number_format($total_rkap1, 2, ",", ".")) ;?></td>
            <td><b></b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <?php
            if($key < $last_key) {
                $k = $key + 1;
                $next_judul1 = $koper[$k]->INDUK_KODE;
            }else{
                $next_judul1 = "" ;
            }

            if($judul1 != $next_judul1) { ?>

        <tr>
            <td colspan="8"><b>Total <?=$row->INDUK_KODE." - ".$row->NAMA_PERKIRAAN2;?> </b></td>
            <td><b><?php echo "Rp. ".str_replace(',', '.', number_format($total_semua1, 2, ",", ".")) ;?></b></td>
            <td><b><?php echo "Rp. ".str_replace(',', '.', number_format($total_semua2, 2, ",", ".")) ;?></b></td>
            <td><b></b></td>
        </tr>

        <?PHP
                $total_semua1 = 0;
                $total_semua2 = 0;
            }
        }
        ?>  

        <tr>
            <td colspan='23' style='padding-left:10px;'></td>
        </tr>
        
        <tr>
            <td colspan="8" style="height:40px; text-align:center;"><b> TOTAL </b></td>
            <td><b><?php echo "Rp. ".str_replace(',', '.', number_format($total_all1, 2, ",", ".")) ;?></b></td>
            <td><b><?php echo "Rp. ".str_replace(',', '.', number_format($total_all2, 2, ",", ".")) ;?></b></td>
            <td><b></b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr> 
    </tbody>
</table>

<?php
    exit();
?>