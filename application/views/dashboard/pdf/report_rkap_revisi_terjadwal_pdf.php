<?PHP  ob_start(); ?>

<style>

.grid th {
    background: #1793d1;
    vertical-align: middle;
    color : #FFF;
    width: 140px;
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

#persegipanjangmerah{
    width:50px;
    height:20px;
    background:#ff2b00;
}
#persegipanjangkuning{
    width:50px;
    height:20px;
    background:#ffe600;
}
#persegipanjangbiru{
    width:50px;
    height:20px;
    background:#0079C1;
}
#persegipanjangorange{
    width:50px;
    height:20px;
    background:#faa43d;
}
#persegipanjangungu{
    width:50px;
    height:20px;
    background:#8e44ad;
}
</style>
		
<table align="center">
    <tr>
        <td>
            <img src="<?=base_url();?>files/pdam/logo-pdamtp.png" width="110" height="90" alt="KOP PDAM">
        </td>
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="1140" height="90" alt="KOP PDAM"></td>
        <td>
            <img src="<?=base_url();?>files/pdam/KOP_tulisan.png" width="550" height="90" alt="KOP PDAM">
        </td>
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="1140" height="90" alt="KOP PDAM"></td>
        <td>
            <img src="<?=base_url();?>files/pdam/logo_perpamsi_glossy.png" width="160" height="90" alt="KOP PDAM">
        </td>
    </tr>
</table>

<hr>

<table align="center">
    <tr>
        <td style="text-align:center;">
            <h3 style="font-family:Arial; font-weight:bold; line-height:1.4;">
                RENCANA KERJA DAN ANGGARAN PERUSAHAAN REVISI<br>
                 <?php echo $ket; ?> <br>
                 TAHUN ANGGARAN : <?php echo $thn; ?>
            </h3>
        </td>
    </tr>
</table>

<br>

<table align="center" class="grid">
    <thead>
        <tr>
            <th style="width:30px;">No</th>
            <th width="120">Perkiraan</th>
            <th width="170">Uraian</th>
            <th width="120">Sub Bagian</th>
            <th width="120">Vol Usulan</th>
            <th width="120">Vol Setuju</th>
            <th width="100">Satuan</th>
            <th width="120">Harga Satuan</th>
            <th width="120">RKAP <?php echo $thn;?></th>
            <th width="120">Revisi</th>
            <th width="100">Ket</th>
            <th width="120">Jan</th>
            <th width="120">Feb</th>
            <th width="120">Mar</th>
            <th width="120">Apr</th>
            <th width="120">Mei</th>
            <th width="120">Jun</th>
            <th width="120">Jul</th>
            <th width="120">Agt</th>
            <th width="120">Sep</th>
            <th width="120">Okt</th>
            <th width="120">Nov</th>
            <th width="120">Des</th>
        </tr>
    </thead>    
    <tbody>
        <?php
        $no = 1;
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
            <td <?php echo $warna; ?> align="center" style="width:10px;"><?php echo $no++; ?></td>
            <td <?php echo $warna; ?> width="120"><?php echo $row_detil->KODE_ANGGARAN; ?></td>
            <td <?php echo $warna; ?> width="170"><?php echo $row_detil->URAIAN; ?></td>
            <td <?php echo $warna; ?> width="120" align="center"><?php echo $row_detil->NAMA_DIVISI; ?></td>
            <td <?php echo $warna; ?> width="120" align="center"><?php echo $jumlah_rkap; ?></td>
            <td <?php echo $warna; ?> width="120" align="center"><?php echo $jumlah_revisi; ?></td>
            <td <?php echo $warna; ?> width="100" align="center"><?php echo $row_detil->SATUAN; ?></td>
            <td <?php echo $warna; ?> width="120" align="center"><?php echo number_format($harga_satuan,2,',','.'); ?></td>
            <td <?php echo $warna; ?> width="120" align="center"><?php echo number_format($rkap_fix, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> width="120" align="center"><?php echo number_format($revisi_fix, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> width="100" align="center"><?php echo $ket; ?></td>
            <td <?php echo $warna; ?> width="120" align="center"><?php echo number_format($row_detil->JANUARI, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> width="120" align="center"><?php echo number_format($row_detil->FEBRUARI, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> width="120" align="center"><?php echo number_format($row_detil->MARET, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> width="120" align="center"><?php echo number_format($row_detil->APRIL, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> width="120" align="center"><?php echo number_format($row_detil->MEI, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> width="120" align="center"><?php echo number_format($row_detil->JUNI, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> width="120" align="center"><?php echo number_format($row_detil->JULI, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> width="120" align="center"><?php echo number_format($row_detil->AGUSTUS, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> width="120" align="center"><?php echo number_format($row_detil->SEPTEMBER, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> width="120" align="center"><?php echo number_format($row_detil->OKTOBER, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> width="120" align="center"><?php echo number_format($row_detil->NOVEMBER, 2, ",", "."); ?></td>
            <td <?php echo $warna; ?> width="120" align="center"><?php echo number_format($row_detil->DESEMBER, 2, ",", "."); ?></td>
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

<br/>

<table>
    <tr>
        <td><div id="persegipanjangmerah"></div></td>
        <td>Nilai Realisasi lebih besar dari nilai RKAP</td>
    </tr>
    <tr>
        <td><div id="persegipanjangkuning"></div></td>
        <td>Data sudah direalisasi</td>
    </tr>
    <tr>
        <td><div id="persegipanjangbiru"></div></td>
        <td>Data di periode RKAP diubah di periode RKAP REVISI</td>
    </tr>
    <tr>
        <td><div id="persegipanjangorange"></div></td>
        <td>Anggaran Tambahan</td>
    </tr>
    <tr>
        <td><div id="persegipanjangungu"></div></td>
        <td>Data dari Input Revisi RKAP</td>
    </tr>
</table>
<?PHP
    $content = ob_get_clean();
    $width_in_inches = 35.10;
    $height_in_inches = 20.40;
    $width_in_mm = $width_in_inches * 25.4;
    $height_in_mm = $height_in_inches * 25.4;
    $html2pdf = new HTML2PDF('L',array($width_in_mm,$height_in_mm),'en');
    $html2pdf->pdf->SetTitle("Laporan Revisi RKAP Terjadwal $thn");
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('$filename.pdf');
?>

