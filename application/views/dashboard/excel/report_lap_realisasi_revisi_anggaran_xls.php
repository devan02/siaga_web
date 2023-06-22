<?PHP   
header("Cache-Control: no-cache, no-store, must-revalidate");  
header("Content-Type: application/vnd.ms-excel");  
header("Content-Disposition: attachment; filename=$filename.xls");  
?>

<style>

.grid th {
	background: #1793d1;
	vertical-align: middle;
	color : #FFF;
	width: 90px;
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
    background:#d0006f;
}

.merah{
    background: #ff2b00;
} 
.kuning { 
    background: #ffe600;
}
.biru { 
    background: #0079C1;
}
.orange { 
    background: #faa43d;
}
.ungu { 
    background: #8e44ad;
}
.hijau { 
    background: #69c76c;
}
.putih { 
    background: #fff;
}
</style>

<?php
function angka_positif($angka){
    if($angka < 0){
        $angka = -$angka;
        $angka = "(".$angka.")";
    }else{
        $angka = $angka;
    }
    return $angka;
}

function angka_positif_rp($angka){
    if($angka < 0){
        $angka = -$angka;
        $angka = "(Rp ".number_format($angka,2,',','.').")";
    }else{
        $angka = number_format($angka,2,',','.');
    }
    return $angka;
}
?>
<!-- <table align="center">
    <tr>
        <td>
            <img src="<?=base_url();?>files/pdam/logo-pdamtp.png" width="110" height="90" alt="KOP PDAM">
        </td>
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="680" height="90" alt="KOP PDAM"></td>
        <td>
            <img src="<?=base_url();?>files/pdam/KOP_tulisan.png" width="550" height="90" alt="KOP PDAM">
        </td>
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="680" height="90" alt="KOP PDAM"></td>
        <td>
            <img src="<?=base_url();?>files/pdam/logo_perpamsi_glossy.png" width="160" height="90" alt="KOP PDAM">
        </td>
    </tr>
</table>

<hr> -->

<table align="center">
    <tr>
        <td align="center" colspan="15">
            <h3>
                <?php echo $title; ?> <br>
                <?php echo $bag_subbag; ?> <br>
                TAHUN <?php echo $thn;?>
            </h3>
        </td>
    </tr>
</table>

<br>

<table align="center" class="grid">
    <thead>
        <tr>
            <th width="120" style="text-align:center;"> NO. ANGGARAN</th>
            <th width="170" style="text-align:center;"> URAIAN </th>
            <th width="150" style="text-align:center;"> SUB BAGIAN </th>
            <th width="80" style="text-align:center;"> VOL </th>
            <th width="80" style="text-align:center;"> SATUAN </th>
            <th width="120" style="text-align:center;"> HARGA<br/>SATUAN </th>
            <th width="120" style="text-align:center;"> RKAP </th>
            <th width="220" style="text-align:center;"> NO BUKTI </th>
            <th width="80" style="text-align:center;"> NO KEU </th>
            <th width="150" style="text-align:center;"> TANGGAL </th>
            <th width="100" style="text-align:center;"> REALISASI<br/>(VOL) </th>
            <th width="120" style="text-align:center;"> REALISASI<br/>(HARGA/UNIT) </th>
            <th width="120" style="text-align:center;"> REALISASI<br/>(TOTAL) </th>
            <th width="100" style="text-align:center;"> SISA<br/>(VOL) </th>
            <th width="120" style="text-align:center;"> SISA<br/>(RP) </th>
        </tr>
    </thead>
    <tbody>
    <?php
        $tot_rkap = 0;
        $tot_realisasi = 0;
        $old_judul = "";
        $old_judul2 = "";
        $next_judul1 = "";
        $next_judul2 = "";
        $total_semua1 = 0;
        $total_semua2 = 0;
        $total_all1 = 0;
        $total_all2 = 0;
        $last_key = end(array_keys($kd_perkiraan));

        foreach ($kd_perkiraan as $key => $koper) {
            $kode_perkiraan = $koper->KODE_PERKIRAAN2;

            $dat_nama = $this->db->query("select a.NAMA_PERKIRAAN from stp_setup_kode_perkiraan a 
                                    where trim(a.KODE_PERKIRAAN)= '$kode_perkiraan'")->row();
            if ($dat_nama != null) {
                $nama_perkiraan = $dat_nama->NAMA_PERKIRAAN;
            } else {
                $nama_perkiraan = "" ;
            }

            $judul1 = TRIM($koper->INDUK_KODE);

            if ($old_judul != $judul1) {
                $old_judul  = $judul1;
    ?>
        <tr>
            <td colspan="15"><b><?php echo $koper->INDUK_KODE." - ".$koper->NAMA_PERKIRAAN2; ?></b></td>
        </tr>
    <?php
            }
    ?>
        <tr>
            <td colspan="15"><b><?php echo $koper->KODE_PERKIRAAN." - ".$koper->NAMA_PERKIRAAN; ?></b></td>
        </tr>
        <?php
            $kode_anggaran = "";
            $uraian = "";
            $divisi = "";
            $jumlah = "";
            $satuan = "";
            $harga = "";
            $rkap = "";
            // $no_bukti = "";
            // $no_keu = "";
            // $tanggal = "";
            // $real_vol = 0;
            // $real_harga = 0;
            $real = 0;
            $vol_real = 0;
            $sisa_vol = "";
            $sisa_rp = "";

            $row_detil = $this->model->laporan_realisasi($thn,$kriteria,$bagian,$sub_bagian,$koper->KODE_PERKIRAAN);
            foreach ($row_detil as $data_detil) {
                
                $rkap = $data_detil->JUMLAH * $data_detil->HARGA;

                $tot_real = $this->model->hitung_realisasi($thn,$kriteria,$bagian,$sub_bagian,$koper->KODE_PERKIRAAN,$data_detil->KODE_ANGGARAN);
                foreach ($tot_real as $row_real) {
                    $real = $row_real->REALISASI;
                    $vol_real = $row_real->REAL_VOL;
                    $sts_tambahan = $row_real->STS_TAMBAHAN;
                    $sts_revisi = $row_real->STS_REVISI;
                }

                $color = "";

                if($real < $rkap && $real > 0){
                    $color = "background:#ffe600;";
                }else if($real > $rkap && $real > 0){
                    $color = "background:#ff2b00; color:#fff;";
                }else if($sts_tambahan == 3){
                    $color = "background:#8e44ad; color:#fff;";
                }else if($sts_tambahan == 4){
                    $color = "background:#FF7F00; color:#fff;";
                }else if($sts_revisi == 5){
                    $color = "background:#0079C1; color:#fff;";
                }else{
                    $color = "background:#fff;";
                } 

                //ADENDUM
                $no_adendum = $data_detil->ADENDUM;
                $nilai_adendum = $data_detil->NILAI_ADENDUM;
                
                $no_bukti = $data_detil->NO_BUKTI;
                $no_keu = $data_detil->NO_KEU;
                $tanggal = $data_detil->TANGGAL;
                $real_vol = $data_detil->REAL_VOL;
                $real_harga = $data_detil->REAL_HARGA;
                $uraian = $data_detil->URAIAN;
                $divisi = $data_detil->NAMA_DIVISI;
                $jumlah = $data_detil->JUMLAH;
                $satuan = $data_detil->SATUAN;
                $real = $real;
                $vol_real = $vol_real;

                $harga = $data_detil->HARGA;
                $sisa_vol_fix = $jumlah-$vol_real;
                $sisa_vol = angka_positif($sisa_vol_fix);
                $sisa_rp_fix = $rkap-$real;
                $sisa_rp = angka_positif_rp($sisa_rp_fix);

                if($kode_anggaran != $data_detil->KODE_ANGGARAN){
                    $kode_anggaran = $data_detil->KODE_ANGGARAN;
                    $uraian = $uraian;
                    $divisi = $divisi;
                    $jumlah = $jumlah;
                    $satuan = $satuan;
                    $harga = "Rp. ".number_format($harga,2,',','.');
                    $rkap = "Rp. ".number_format($rkap,2,',','.');
                    $real = "Rp. ".number_format($real,2,',','.');
                    $sisa_vol = $sisa_vol;
                    $sisa_rp = $sisa_rp;
                }else{
                    $kode_anggaran = "";
                    $uraian = "";
                    $divisi = "";
                    $jumlah = "";
                    $satuan = "";
                    $harga = "";
                    $rkap = "";
                    $real = "";
                    $sisa_vol = "";
                    $sisa_rp = "";
                }

                $no_keu = $no_keu == ""?"-":$no_keu;
                $no_bukti = $no_bukti == ""?"-":$no_bukti;
                $tanggal = $tanggal == ""?"-":$tanggal;
                $real_vol = $real_vol == ""?"0":$real_vol;
    ?>
        <tr style="<?php echo $color; ?>">
            <td style="<?php echo $color; ?>" width="120" align="center"><?php echo $kode_anggaran; ?></td>
            <td style="<?php echo $color; ?>" width="170"><?php echo $uraian; ?></td>
            <td style="<?php echo $color; ?>" width="150" align="center"><?php echo $divisi; ?></td>
            <td style="<?php echo $color; ?>" width="80" align="center"><?php echo $jumlah; ?></td>
            <td style="<?php echo $color; ?>" width="80" align="center"><?php echo $satuan; ?></td>
            <td style="<?php echo $color; ?>" style="width:150px;"><?php echo $harga; ?></td>
            <td style="<?php echo $color; ?>" style="width:150px;"><?php echo $rkap; ?></td>
            <td style="<?php echo $color; ?>" width="220"><?php echo $no_bukti; ?></td>
            <td style="<?php echo $color; ?>" width="80" align="center"><?php echo $no_keu; ?></td>
            <td style="<?php echo $color; ?>" width="150" align="center"><?php echo $tanggal; ?></td>
            <td style="<?php echo $color; ?>" width="100" align="center"><?php echo $real_vol; ?></td>
            <td style="<?php echo $color; ?>" style="width:150px;"><?php echo "Rp. ".number_format($real_harga,2,',','.'); ?></td>
            <td style="<?php echo $color; ?>" style="width:150px;"><?php echo $real; ?></td>
            <td style="<?php echo $color; ?>" width="100" align="center"><?php echo $sisa_vol; ?></td>
            <td style="<?php echo $color; ?>" style="width:150px;"><?php echo $sisa_rp; ?></td>
        </tr>
        <?php
            if($no_adendum != null || $no_adendum != ""){
        ?>
        <tr style="<?php echo $color; ?>">
            <td style="<?php echo $color; ?>">&nbsp;</td>
            <td style="<?php echo $color; ?>">&nbsp;</td>
            <td style="<?php echo $color; ?>">&nbsp;</td>
            <td style="<?php echo $color; ?>">&nbsp;</td>
            <td style="<?php echo $color; ?>">&nbsp;</td>
            <td style="<?php echo $color; ?>">&nbsp;</td>
            <td style="<?php echo $color; ?>">&nbsp;</td>
            <td style="<?php echo $color; ?>"><?php echo $no_adendum; ?></td>
            <td style="<?php echo $color; ?>">&nbsp;</td>
            <td style="<?php echo $color; ?>">&nbsp;</td>
            <td style="<?php echo $color; ?>" align="center"><?php echo $real_vol; ?></td>
            <td style="<?php echo $color; ?>"><?php echo "Rp. ".number_format($nilai_adendum,2,',','.'); ?></td>
            <td style="<?php echo $color; ?>">&nbsp;</td>
            <td style="<?php echo $color; ?>">&nbsp;</td>
            <td style="<?php echo $color; ?>">&nbsp;</td>
        </tr>
        <?php
            }
        ?>
    <?php
                $kode_anggaran = $data_detil->KODE_ANGGARAN;
                $uraian = $data_detil->URAIAN;
                $divisi = $data_detil->NAMA_DIVISI;
                $jumlah = $data_detil->JUMLAH;
                $satuan = $data_detil->SATUAN;
                    
                $tot_rkap += $data_detil->RKAP;
                $tot_realisasi += $real;

                $total_semua1 += $data_detil->RKAP;
                $total_semua2 += $real;
            }
    ?>
        <?php
            if($key < $last_key) {
                $k = $key + 1;
                $next_judul1 = $kd_perkiraan[$k]->INDUK_KODE;
            }else{
                $next_judul1 = "" ;
            }

            if($judul1 != $next_judul1) { 
        ?>
            <tr>
                <td colspan="6"><b>Total <?=$koper->INDUK_KODE." - ".$koper->NAMA_PERKIRAAN2;?> </b></td>
                <td><b><?php echo "Rp. ".str_replace(',', '.', number_format($total_semua1, 2, ",", ".")) ;?></b></td>
                <td colspan="5">&nbsp;</td>
                <td><b><?php echo "Rp. ".str_replace(',', '.', number_format($total_semua2, 2, ",", ".")) ;?></b></td>
                <td colspan="2">&nbsp;</td>
            </tr>
        <?php
                $total_semua1 = 0;
                $total_semua2 = 0;
            }
        ?>
    <?php
        }  
    ?> 
        <tr>
            <td colspan="6" align="center"><b>Total</b></td>
            <td align="center"><b><?php echo "Rp. ".number_format($tot_rkap,2,',','.'); ?></b></td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center"><b><?php echo "Rp. ".number_format($tot_realisasi,2,',','.'); ?></b></td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
        </tr>
    </tbody>
</table>

<br/>

<table>
    <tr>
        <td style="width:50px; height:20px; background:#ff2b00;"></td>
        <td>Nilai Realisasi lebih besar dari nilai RKAP</td>
    </tr>
    <tr>
        <td style="width:50px; height:20px; background:#ffe600;"></td>
        <td>Data sudah direalisasi</td>
    </tr>
    <tr>
        <td style="width:50px; height:20px; background:#0079C1;"></td>
        <td>Nilai Realisasi sama dengan nilai RKAP</td>
    </tr>
    <tr>
        <td style="width:50px; height:20px; background:#faa43d;"></td>
        <td>Anggaran Tambahan</td>
    </tr>
    <tr>
        <td style="width:50px; height:20px; background:#d0006f;"></td>
        <td>Data dari Input Revisi RKAP</td>
    </tr>
</table>

<?PHP
    exit();
?>

