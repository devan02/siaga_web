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
    font: 11px sans-serif;
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
<?php
    function angka_positif($angka){
        if($angka < 0){
            $angka = -$angka;
            $angka = "(".number_format($angka,0,',','.').")";
        }else{
            $angka = number_format($angka,0,',','.');
        }
        return $angka;
    }

    function positif_persen($angka){
        if($angka < 0){
            $angka = -$angka;
            $angka = "(".number_format($angka,2).")";
        }else{
            $angka = number_format($angka,2);
        }
        return $angka;
    }
?>
<table align="center">
    <tr>
        <td>
            <img src="<?=base_url();?>files/pdam/logo-pdamtp.png" width="110" height="90" alt="KOP PDAM">
        </td>
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="380" height="90" alt="KOP PDAM"></td>
        <td>
            <img src="<?=base_url();?>files/pdam/KOP_tulisan.png" width="550" height="90" alt="KOP PDAM">
        </td>
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="380" height="90" alt="KOP PDAM"></td>
        <td>
            <img src="<?=base_url();?>files/pdam/logo_perpamsi_glossy.png" width="160" height="90" alt="KOP PDAM">
        </td>
    </tr>
</table>

<hr>

<table align="center">
    <tr>
        <td style="text-align:center;">
            <h3>
                <?php echo $title; ?> <br>
                TAHUN : <?php echo $tahun;?>
            </h3>
        </td>
    </tr>
</table>

<br/>

<table class="grid">
    <thead>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">URAIAN</th>
            <th rowspan="2">TARIF</th>
            <th colspan="12">Bulan</th>
            <th rowspan="2">JUMLAH</th>
        </tr>
        <tr>
            <th width="80">JAN</th>
            <th width="80">FEB</th>
            <th width="80">MAR</th>
            <th width="80">APR</th>
            <th width="80">MEI</th>
            <th width="80">JUN</th>
            <th width="80">JUL</th>
            <th width="80">AGT</th>
            <th width="80">SEP</th>
            <th width="80">OKT</th>
            <th width="80">NOV</th>
            <th width="80">DES</th>
        </tr>
    </thead>
    <tbody>
    <!-- KP 1 -->
        <tr>
            <td><b>I</b></td>
            <td colspan="15"><b>KELOMPOK PELANGGAN I</b></td>
        </tr>
        <!-- sosial umum -->
        <tr>
            <td align="right"><b>1</b></td>
            <td colspan="15"><b>Sosial Umum</b></td>
        </tr>
    <?php
        $jan_kali_umum = 1;
        $feb_kali_umum = 1;
        $mar_kali_umum = 1;
        $apr_kali_umum = 1;
        $mei_kali_umum = 1;
        $jun_kali_umum = 1;
        $jul_kali_umum = 1;
        $agt_kali_umum = 1;
        $sep_kali_umum = 1;
        $okt_kali_umum = 1;
        $nov_kali_umum = 1;
        $des_kali_umum = 1;
        $jumlah_kali_umum = 0;

        foreach ($data as $key => $value_sosial_umum) {
            if($value_sosial_umum->JENIS_KELOMPOK_PELANGGAN == "Sosial Umum"){
                $jan_sosial_umum = $value_sosial_umum->JANUARI;
                $feb_sosial_umum = $value_sosial_umum->FEBRUARI;
                $mar_sosial_umum = $value_sosial_umum->MARET;
                $apr_sosial_umum = $value_sosial_umum->APRIL;
                $mei_sosial_umum = $value_sosial_umum->MEI;
                $jun_sosial_umum = $value_sosial_umum->JUNI;
                $jul_sosial_umum = $value_sosial_umum->JULI;
                $agt_sosial_umum = $value_sosial_umum->AGUSTUS;
                $sep_sosial_umum = $value_sosial_umum->SEPTEMBER;
                $okt_sosial_umum = $value_sosial_umum->OKTOBER;
                $nov_sosial_umum = $value_sosial_umum->NOVEMBER;
                $des_sosial_umum = $value_sosial_umum->DESEMBER;
                $jumlah_sosial_umum = $value_sosial_umum->JUMLAH;

    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_umum->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_umum->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_umum,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_umum,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_umum,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_umum,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_umum,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_umum,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_umum,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_umum,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_umum,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_umum,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_umum,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_umum,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_umum,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_umum = $jan_kali_umum * $jan_sosial_umum;
                $feb_kali_umum = $feb_kali_umum * $feb_sosial_umum;
                $mar_kali_umum = $mar_kali_umum * $mar_sosial_umum;
                $apr_kali_umum = $apr_kali_umum * $apr_sosial_umum;
                $mei_kali_umum = $mei_kali_umum * $mei_sosial_umum;
                $jun_kali_umum = $jun_kali_umum * $jun_sosial_umum;
                $jul_kali_umum = $jul_kali_umum * $jul_sosial_umum;
                $agt_kali_umum = $agt_kali_umum * $agt_sosial_umum;
                $sep_kali_umum = $sep_kali_umum * $sep_sosial_umum;
                $okt_kali_umum = $okt_kali_umum * $okt_sosial_umum;
                $nov_kali_umum = $nov_kali_umum * $nov_sosial_umum;
                $des_kali_umum = $des_kali_umum * $des_sosial_umum;
                $jumlah_kali_umum = ($jan_kali_umum+$feb_kali_umum+$mar_kali_umum+$apr_kali_umum+$mei_kali_umum+$jun_kali_umum+$jul_kali_umum+$agt_kali_umum+$sep_kali_umum+$okt_kali_umum+$nov_kali_umum+$des_kali_umum);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan 1.1</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_umum,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_umum,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_umum,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_umum,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_umum,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_umum,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_umum,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_umum,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_umum,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_umum,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_umum,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_umum,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_umum,0,',','.'); ?></td>
        </tr>

        <!-- sosial khusus -->
        <tr>
            <td align="right"><b>2</b></td>
            <td colspan="15"><b>Sosial Khusus</b></td>
        </tr>
    <?php
        $jan_kali_khusus = 1;
        $feb_kali_khusus = 1;
        $mar_kali_khusus = 1;
        $apr_kali_khusus = 1;
        $mei_kali_khusus = 1;
        $jun_kali_khusus = 1;
        $jul_kali_khusus = 1;
        $agt_kali_khusus = 1;
        $sep_kali_khusus = 1;
        $okt_kali_khusus = 1;
        $nov_kali_khusus = 1;
        $des_kali_khusus = 1;
        $jumlah_kali_khusus = 0;

        foreach ($data as $key => $value_sosial_khusus) {
            if($value_sosial_khusus->JENIS_KELOMPOK_PELANGGAN == "Sosial Khusus"){
                $jan_sosial_khusus = $value_sosial_khusus->JANUARI;
                $feb_sosial_khusus = $value_sosial_khusus->FEBRUARI;
                $mar_sosial_khusus = $value_sosial_khusus->MARET;
                $apr_sosial_khusus = $value_sosial_khusus->APRIL;
                $mei_sosial_khusus = $value_sosial_khusus->MEI;
                $jun_sosial_khusus = $value_sosial_khusus->JUNI;
                $jul_sosial_khusus = $value_sosial_khusus->JULI;
                $agt_sosial_khusus = $value_sosial_khusus->AGUSTUS;
                $sep_sosial_khusus = $value_sosial_khusus->SEPTEMBER;
                $okt_sosial_khusus = $value_sosial_khusus->OKTOBER;
                $nov_sosial_khusus = $value_sosial_khusus->NOVEMBER;
                $des_sosial_khusus = $value_sosial_khusus->DESEMBER;
                $jumlah_sosial_khusus = $value_sosial_khusus->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_khusus->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_khusus->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_khusus,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_khusus = $jan_kali_khusus * $jan_sosial_khusus;
                $feb_kali_khusus = $feb_kali_khusus * $feb_sosial_khusus;
                $mar_kali_khusus = $mar_kali_khusus * $mar_sosial_khusus;
                $apr_kali_khusus = $apr_kali_khusus * $apr_sosial_khusus;
                $mei_kali_khusus = $mei_kali_khusus * $mei_sosial_khusus;
                $jun_kali_khusus = $jun_kali_khusus * $jun_sosial_khusus;
                $jul_kali_khusus = $jul_kali_khusus * $jul_sosial_khusus;
                $agt_kali_khusus = $agt_kali_khusus * $agt_sosial_khusus;
                $sep_kali_khusus = $sep_kali_khusus * $sep_sosial_khusus;
                $okt_kali_khusus = $okt_kali_khusus * $okt_sosial_khusus;
                $nov_kali_khusus = $nov_kali_khusus * $nov_sosial_khusus;
                $des_kali_khusus = $des_kali_khusus * $des_sosial_khusus;
                $jumlah_kali_khusus = ($jan_kali_khusus+$feb_kali_khusus+$mar_kali_khusus+$apr_kali_khusus+$mei_kali_khusus+$jun_kali_khusus+$jul_kali_khusus+$agt_kali_khusus+$sep_kali_khusus+$okt_kali_khusus+$nov_kali_khusus+$des_kali_khusus);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan 1.2</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_khusus,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_khusus,0,',','.'); ?></td>
        </tr>
        <?php
            $total_jan_kp1 = $jan_kali_umum+$jan_kali_khusus;
            $total_feb_kp1 = $feb_kali_umum+$feb_kali_khusus;
            $total_mar_kp1 = $mar_kali_umum+$mar_kali_khusus;
            $total_apr_kp1 = $apr_kali_umum+$apr_kali_khusus;
            $total_mei_kp1 = $mei_kali_umum+$mei_kali_khusus;
            $total_jun_kp1 = $jun_kali_umum+$jun_kali_khusus;
            $total_jul_kp1 = $jul_kali_umum+$jul_kali_khusus;
            $total_agt_kp1 = $agt_kali_umum+$agt_kali_khusus;
            $total_sep_kp1 = $sep_kali_umum+$sep_kali_khusus;
            $total_okt_kp1 = $okt_kali_umum+$okt_kali_khusus;
            $total_nov_kp1 = $nov_kali_umum+$nov_kali_khusus;
            $total_des_kp1 = $des_kali_umum+$des_kali_khusus;
        ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan I</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($total_jan_kp1,0,',','.'); ?></td>
            <td><?php echo number_format($total_feb_kp1,0,',','.'); ?></td>
            <td><?php echo number_format($total_mar_kp1,0,',','.'); ?></td>
            <td><?php echo number_format($total_apr_kp1,0,',','.'); ?></td>
            <td><?php echo number_format($total_mei_kp1,0,',','.'); ?></td>
            <td><?php echo number_format($total_jun_kp1,0,',','.'); ?></td>
            <td><?php echo number_format($total_jul_kp1,0,',','.'); ?></td>
            <td><?php echo number_format($total_agt_kp1,0,',','.'); ?></td>
            <td><?php echo number_format($total_sep_kp1,0,',','.'); ?></td>
            <td><?php echo number_format($total_okt_kp1,0,',','.'); ?></td>
            <td><?php echo number_format($total_nov_kp1,0,',','.'); ?></td>
            <td><?php echo number_format($total_des_kp1,0,',','.'); ?></td>
            <td>
                <?php
                    $total_kp1 = ($total_jan_kp1+$total_feb_kp1+$total_mar_kp1+$total_apr_kp1+$total_mei_kp1+$total_jun_kp1+$total_jul_kp1+$total_agt_kp1+$total_sep_kp1+$total_okt_kp1+$total_nov_kp1+$total_des_kp1); 
                    echo number_format($total_kp1,0,',','.'); 
                ?>
            </td>
        </tr>
    <!-- KP 2 -->
        <tr>
            <td><b>II</b></td>
            <td colspan="15"><b>KELOMPOK PELANGGAN II</b></td>
        </tr>
        <!-- RT 1 -->
        <tr>
            <td align="right"><b>1</b></td>
            <td colspan="15"><b>Rumah Tangga 1 (R1)</b></td>
        </tr>
    <?php
        $jan_kali_rt1 = 1;
        $feb_kali_rt1 = 1;
        $mar_kali_rt1 = 1;
        $apr_kali_rt1 = 1;
        $mei_kali_rt1 = 1;
        $jun_kali_rt1 = 1;
        $jul_kali_rt1 = 1;
        $agt_kali_rt1 = 1;
        $sep_kali_rt1 = 1;
        $okt_kali_rt1 = 1;
        $nov_kali_rt1 = 1;
        $des_kali_rt1 = 1;
        $jumlah_kali_rt1 = 0;

        foreach ($data as $key => $value_sosial_rt1) {
            if($value_sosial_rt1->JENIS_KELOMPOK_PELANGGAN == "Rumah Tangga 1 (R1)"){
                $jan_sosial_rt1 = $value_sosial_rt1->JANUARI;
                $feb_sosial_rt1 = $value_sosial_rt1->FEBRUARI;
                $mar_sosial_rt1 = $value_sosial_rt1->MARET;
                $apr_sosial_rt1 = $value_sosial_rt1->APRIL;
                $mei_sosial_rt1 = $value_sosial_rt1->MEI;
                $jun_sosial_rt1 = $value_sosial_rt1->JUNI;
                $jul_sosial_rt1 = $value_sosial_rt1->JULI;
                $agt_sosial_rt1 = $value_sosial_rt1->AGUSTUS;
                $sep_sosial_rt1 = $value_sosial_rt1->SEPTEMBER;
                $okt_sosial_rt1 = $value_sosial_rt1->OKTOBER;
                $nov_sosial_rt1 = $value_sosial_rt1->NOVEMBER;
                $des_sosial_rt1 = $value_sosial_rt1->DESEMBER;
                $jumlah_sosial_rt1 = $value_sosial_rt1->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_rt1->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_rt1->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_rt1,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_rt1 = $jan_kali_rt1 * $jan_sosial_rt1;
                $feb_kali_rt1 = $feb_kali_rt1 * $feb_sosial_rt1;
                $mar_kali_rt1 = $mar_kali_rt1 * $mar_sosial_rt1;
                $apr_kali_rt1 = $apr_kali_rt1 * $apr_sosial_rt1;
                $mei_kali_rt1 = $mei_kali_rt1 * $mei_sosial_rt1;
                $jun_kali_rt1 = $jun_kali_rt1 * $jun_sosial_rt1;
                $jul_kali_rt1 = $jul_kali_rt1 * $jul_sosial_rt1;
                $agt_kali_rt1 = $agt_kali_rt1 * $agt_sosial_rt1;
                $sep_kali_rt1 = $sep_kali_rt1 * $sep_sosial_rt1;
                $okt_kali_rt1 = $okt_kali_rt1 * $okt_sosial_rt1;
                $nov_kali_rt1 = $nov_kali_rt1 * $nov_sosial_rt1;
                $des_kali_rt1 = $des_kali_rt1 * $des_sosial_rt1;
                $jumlah_kali_rt1 = ($jan_kali_rt1+$feb_kali_rt1+$mar_kali_rt1+$apr_kali_rt1+$mei_kali_rt1+$jun_kali_rt1+$jul_kali_rt1+$agt_kali_rt1+$sep_kali_rt1+$okt_kali_rt1+$nov_kali_rt1+$des_kali_rt1);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan 2.1</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_rt1,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_rt1,0,',','.'); ?></td>
        </tr>
        <!-- RT 2 -->
        <tr>
            <td align="right"><b>2</b></td>
            <td colspan="15"><b>Rumah Tangga 2 (R2)</b></td>
        </tr>
    <?php
        $jan_kali_rt2 = 1;
        $feb_kali_rt2 = 1;
        $mar_kali_rt2 = 1;
        $apr_kali_rt2 = 1;
        $mei_kali_rt2 = 1;
        $jun_kali_rt2 = 1;
        $jul_kali_rt2 = 1;
        $agt_kali_rt2 = 1;
        $sep_kali_rt2 = 1;
        $okt_kali_rt2 = 1;
        $nov_kali_rt2 = 1;
        $des_kali_rt2 = 1;
        $jumlah_kali_rt2 = 0;

        foreach ($data as $key => $value_sosial_rt2) {
            if($value_sosial_rt2->JENIS_KELOMPOK_PELANGGAN == "Rumah Tangga 2 (R2)"){
                $jan_sosial_rt2 = $value_sosial_rt2->JANUARI;
                $feb_sosial_rt2 = $value_sosial_rt2->FEBRUARI;
                $mar_sosial_rt2 = $value_sosial_rt2->MARET;
                $apr_sosial_rt2 = $value_sosial_rt2->APRIL;
                $mei_sosial_rt2 = $value_sosial_rt2->MEI;
                $jun_sosial_rt2 = $value_sosial_rt2->JUNI;
                $jul_sosial_rt2 = $value_sosial_rt2->JULI;
                $agt_sosial_rt2 = $value_sosial_rt2->AGUSTUS;
                $sep_sosial_rt2 = $value_sosial_rt2->SEPTEMBER;
                $okt_sosial_rt2 = $value_sosial_rt2->OKTOBER;
                $nov_sosial_rt2 = $value_sosial_rt2->NOVEMBER;
                $des_sosial_rt2 = $value_sosial_rt2->DESEMBER;
                $jumlah_sosial_rt2 = $value_sosial_rt2->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_rt2->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_rt2->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_rt2,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_rt2 = $jan_kali_rt2 * $jan_sosial_rt2;
                $feb_kali_rt2 = $feb_kali_rt2 * $feb_sosial_rt2;
                $mar_kali_rt2 = $mar_kali_rt2 * $mar_sosial_rt2;
                $apr_kali_rt2 = $apr_kali_rt2 * $apr_sosial_rt2;
                $mei_kali_rt2 = $mei_kali_rt2 * $mei_sosial_rt2;
                $jun_kali_rt2 = $jun_kali_rt2 * $jun_sosial_rt2;
                $jul_kali_rt2 = $jul_kali_rt2 * $jul_sosial_rt2;
                $agt_kali_rt2 = $agt_kali_rt2 * $agt_sosial_rt2;
                $sep_kali_rt2 = $sep_kali_rt2 * $sep_sosial_rt2;
                $okt_kali_rt2 = $okt_kali_rt2 * $okt_sosial_rt2;
                $nov_kali_rt2 = $nov_kali_rt2 * $nov_sosial_rt2;
                $des_kali_rt2 = $des_kali_rt2 * $des_sosial_rt2;
                $jumlah_kali_rt2 = ($jan_kali_rt2+$feb_kali_rt2+$mar_kali_rt2+$apr_kali_rt2+$mei_kali_rt2+$jun_kali_rt2+$jul_kali_rt2+$agt_kali_rt2+$sep_kali_rt2+$okt_kali_rt2+$nov_kali_rt2+$des_kali_rt2);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan 2.2</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_rt2,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_rt2,0,',','.'); ?></td>
        </tr>
        <!-- RT 3 -->
        <tr>
            <td align="right"><b>3</b></td>
            <td colspan="15"><b>Rumah Tangga 3 (R3)</b></td>
        </tr>
    <?php
        $jan_kali_rt3 = 1;
        $feb_kali_rt3 = 1;
        $mar_kali_rt3 = 1;
        $apr_kali_rt3 = 1;
        $mei_kali_rt3 = 1;
        $jun_kali_rt3 = 1;
        $jul_kali_rt3 = 1;
        $agt_kali_rt3 = 1;
        $sep_kali_rt3 = 1;
        $okt_kali_rt3 = 1;
        $nov_kali_rt3 = 1;
        $des_kali_rt3 = 1;
        $jumlah_kali_rt3 = 0;

        foreach ($data as $key => $value_sosial_rt3) {
            if($value_sosial_rt3->JENIS_KELOMPOK_PELANGGAN == "Rumah Tangga 3 (R3)"){
                $jan_sosial_rt3 = $value_sosial_rt3->JANUARI;
                $feb_sosial_rt3 = $value_sosial_rt3->FEBRUARI;
                $mar_sosial_rt3 = $value_sosial_rt3->MARET;
                $apr_sosial_rt3 = $value_sosial_rt3->APRIL;
                $mei_sosial_rt3 = $value_sosial_rt3->MEI;
                $jun_sosial_rt3 = $value_sosial_rt3->JUNI;
                $jul_sosial_rt3 = $value_sosial_rt3->JULI;
                $agt_sosial_rt3 = $value_sosial_rt3->AGUSTUS;
                $sep_sosial_rt3 = $value_sosial_rt3->SEPTEMBER;
                $okt_sosial_rt3 = $value_sosial_rt3->OKTOBER;
                $nov_sosial_rt3 = $value_sosial_rt3->NOVEMBER;
                $des_sosial_rt3 = $value_sosial_rt3->DESEMBER;
                $jumlah_sosial_rt3 = $value_sosial_rt3->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_rt3->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_rt3->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_rt3,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_rt3 = $jan_kali_rt3 * $jan_sosial_rt3;
                $feb_kali_rt3 = $feb_kali_rt3 * $feb_sosial_rt3;
                $mar_kali_rt3 = $mar_kali_rt3 * $mar_sosial_rt3;
                $apr_kali_rt3 = $apr_kali_rt3 * $apr_sosial_rt3;
                $mei_kali_rt3 = $mei_kali_rt3 * $mei_sosial_rt3;
                $jun_kali_rt3 = $jun_kali_rt3 * $jun_sosial_rt3;
                $jul_kali_rt3 = $jul_kali_rt3 * $jul_sosial_rt3;
                $agt_kali_rt3 = $agt_kali_rt3 * $agt_sosial_rt3;
                $sep_kali_rt3 = $sep_kali_rt3 * $sep_sosial_rt3;
                $okt_kali_rt3 = $okt_kali_rt3 * $okt_sosial_rt3;
                $nov_kali_rt3 = $nov_kali_rt3 * $nov_sosial_rt3;
                $des_kali_rt3 = $des_kali_rt3 * $des_sosial_rt3;
                $jumlah_kali_rt3 = ($jan_kali_rt3+$feb_kali_rt3+$mar_kali_rt3+$apr_kali_rt3+$mei_kali_rt3+$jun_kali_rt3+$jul_kali_rt3+$agt_kali_rt3+$sep_kali_rt3+$okt_kali_rt3+$nov_kali_rt3+$des_kali_rt3);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan 2.3</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_rt3,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_rt3,0,',','.'); ?></td>
        </tr>
        <!-- RT 4 -->
        <tr>
            <td align="right"><b>4</b></td>
            <td colspan="15"><b>Rumah Tangga 4 (R4)</b></td>
        </tr>
    <?php
        $jan_kali_rt4 = 1;
        $feb_kali_rt4 = 1;
        $mar_kali_rt4 = 1;
        $apr_kali_rt4 = 1;
        $mei_kali_rt4 = 1;
        $jun_kali_rt4 = 1;
        $jul_kali_rt4 = 1;
        $agt_kali_rt4 = 1;
        $sep_kali_rt4 = 1;
        $okt_kali_rt4 = 1;
        $nov_kali_rt4 = 1;
        $des_kali_rt4 = 1;
        $jumlah_kali_rt4 = 0;

        foreach ($data as $key => $value_sosial_rt4) {
            if($value_sosial_rt4->JENIS_KELOMPOK_PELANGGAN == "Rumah Tangga 3 (R3)"){
                $jan_sosial_rt4 = $value_sosial_rt4->JANUARI;
                $feb_sosial_rt4 = $value_sosial_rt4->FEBRUARI;
                $mar_sosial_rt4 = $value_sosial_rt4->MARET;
                $apr_sosial_rt4 = $value_sosial_rt4->APRIL;
                $mei_sosial_rt4 = $value_sosial_rt4->MEI;
                $jun_sosial_rt4 = $value_sosial_rt4->JUNI;
                $jul_sosial_rt4 = $value_sosial_rt4->JULI;
                $agt_sosial_rt4 = $value_sosial_rt4->AGUSTUS;
                $sep_sosial_rt4 = $value_sosial_rt4->SEPTEMBER;
                $okt_sosial_rt4 = $value_sosial_rt4->OKTOBER;
                $nov_sosial_rt4 = $value_sosial_rt4->NOVEMBER;
                $des_sosial_rt4 = $value_sosial_rt4->DESEMBER;
                $jumlah_sosial_rt4 = $value_sosial_rt4->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_rt4->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_rt4->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_rt4,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_rt4 = $jan_kali_rt4 * $jan_sosial_rt4;
                $feb_kali_rt4 = $feb_kali_rt4 * $feb_sosial_rt4;
                $mar_kali_rt4 = $mar_kali_rt4 * $mar_sosial_rt4;
                $apr_kali_rt4 = $apr_kali_rt4 * $apr_sosial_rt4;
                $mei_kali_rt4 = $mei_kali_rt4 * $mei_sosial_rt4;
                $jun_kali_rt4 = $jun_kali_rt4 * $jun_sosial_rt4;
                $jul_kali_rt4 = $jul_kali_rt4 * $jul_sosial_rt4;
                $agt_kali_rt4 = $agt_kali_rt4 * $agt_sosial_rt4;
                $sep_kali_rt4 = $sep_kali_rt4 * $sep_sosial_rt4;
                $okt_kali_rt4 = $okt_kali_rt4 * $okt_sosial_rt4;
                $nov_kali_rt4 = $nov_kali_rt4 * $nov_sosial_rt4;
                $des_kali_rt4 = $des_kali_rt4 * $des_sosial_rt4;
                $jumlah_kali_rt4 = ($jan_kali_rt4+$feb_kali_rt4+$mar_kali_rt4+$apr_kali_rt4+$mei_kali_rt4+$jun_kali_rt4+$jul_kali_rt4+$agt_kali_rt4+$sep_kali_rt4+$okt_kali_rt4+$nov_kali_rt4+$des_kali_rt4);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan 2.4</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_rt4,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_rt4,0,',','.'); ?></td>
        </tr>
        <!-- IP 1 -->
        <tr>
            <td align="right"><b>6</b></td>
            <td colspan="15"><b>Instansi Pemerintah ( IP1 ) ( Kantor Pemerintah )</b></td>
        </tr>
    <?php
        $jan_kali_ip1 = 1;
        $feb_kali_ip1 = 1;
        $mar_kali_ip1 = 1;
        $apr_kali_ip1 = 1;
        $mei_kali_ip1 = 1;
        $jun_kali_ip1 = 1;
        $jul_kali_ip1 = 1;
        $agt_kali_ip1 = 1;
        $sep_kali_ip1 = 1;
        $okt_kali_ip1 = 1;
        $nov_kali_ip1 = 1;
        $des_kali_ip1 = 1;
        $jumlah_kali_ip1 = 0;

        foreach ($data as $key => $value_sosial_ip1) {
            if($value_sosial_ip1->JENIS_KELOMPOK_PELANGGAN == "Instalasi / Kantor Pemerintah"){
                $jan_sosial_ip1 = $value_sosial_ip1->JANUARI;
                $feb_sosial_ip1 = $value_sosial_ip1->FEBRUARI;
                $mar_sosial_ip1 = $value_sosial_ip1->MARET;
                $apr_sosial_ip1 = $value_sosial_ip1->APRIL;
                $mei_sosial_ip1 = $value_sosial_ip1->MEI;
                $jun_sosial_ip1 = $value_sosial_ip1->JUNI;
                $jul_sosial_ip1 = $value_sosial_ip1->JULI;
                $agt_sosial_ip1 = $value_sosial_ip1->AGUSTUS;
                $sep_sosial_ip1 = $value_sosial_ip1->SEPTEMBER;
                $okt_sosial_ip1 = $value_sosial_ip1->OKTOBER;
                $nov_sosial_ip1 = $value_sosial_ip1->NOVEMBER;
                $des_sosial_ip1 = $value_sosial_ip1->DESEMBER;
                $jumlah_sosial_ip1 = $value_sosial_ip1->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_ip1->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_ip1->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_ip1,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_ip1 = $jan_kali_ip1 * $jan_sosial_ip1;
                $feb_kali_ip1 = $feb_kali_ip1 * $feb_sosial_ip1;
                $mar_kali_ip1 = $mar_kali_ip1 * $mar_sosial_ip1;
                $apr_kali_ip1 = $apr_kali_ip1 * $apr_sosial_ip1;
                $mei_kali_ip1 = $mei_kali_ip1 * $mei_sosial_ip1;
                $jun_kali_ip1 = $jun_kali_ip1 * $jun_sosial_ip1;
                $jul_kali_ip1 = $jul_kali_ip1 * $jul_sosial_ip1;
                $agt_kali_ip1 = $agt_kali_ip1 * $agt_sosial_ip1;
                $sep_kali_ip1 = $sep_kali_ip1 * $sep_sosial_ip1;
                $okt_kali_ip1 = $okt_kali_ip1 * $okt_sosial_ip1;
                $nov_kali_ip1 = $nov_kali_ip1 * $nov_sosial_ip1;
                $des_kali_ip1 = $des_kali_ip1 * $des_sosial_ip1;
                $jumlah_kali_ip1 = ($jan_kali_ip1+$feb_kali_ip1+$mar_kali_ip1+$apr_kali_ip1+$mei_kali_ip1+$jun_kali_ip1+$jul_kali_ip1+$agt_kali_ip1+$sep_kali_ip1+$okt_kali_ip1+$nov_kali_ip1+$des_kali_ip1);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan 2.6</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_ip1,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_ip1,0,',','.'); ?></td>
        </tr>
        <!-- IP 2 -->
        <tr>
            <td align="right"><b>7</b></td>
            <td colspan="15"><b>Instansi Pemerintah ( IP2 ) ( Sekolah Negeri / Universitas Negeri )</b></td>
        </tr>
    <?php
        $jan_kali_ip2 = 1;
        $feb_kali_ip2 = 1;
        $mar_kali_ip2 = 1;
        $apr_kali_ip2 = 1;
        $mei_kali_ip2 = 1;
        $jun_kali_ip2 = 1;
        $jul_kali_ip2 = 1;
        $agt_kali_ip2 = 1;
        $sep_kali_ip2 = 1;
        $okt_kali_ip2 = 1;
        $nov_kali_ip2 = 1;
        $des_kali_ip2 = 1;
        $jumlah_kali_ip2 = 0;

        foreach ($data as $key => $value_sosial_ip2) {
            if($value_sosial_ip2->JENIS_KELOMPOK_PELANGGAN == "Sekolah Negeri / Universitas Negeri"){
                $jan_sosial_ip2 = $value_sosial_ip2->JANUARI;
                $feb_sosial_ip2 = $value_sosial_ip2->FEBRUARI;
                $mar_sosial_ip2 = $value_sosial_ip2->MARET;
                $apr_sosial_ip2 = $value_sosial_ip2->APRIL;
                $mei_sosial_ip2 = $value_sosial_ip2->MEI;
                $jun_sosial_ip2 = $value_sosial_ip2->JUNI;
                $jul_sosial_ip2 = $value_sosial_ip2->JULI;
                $agt_sosial_ip2 = $value_sosial_ip2->AGUSTUS;
                $sep_sosial_ip2 = $value_sosial_ip2->SEPTEMBER;
                $okt_sosial_ip2 = $value_sosial_ip2->OKTOBER;
                $nov_sosial_ip2 = $value_sosial_ip2->NOVEMBER;
                $des_sosial_ip2 = $value_sosial_ip2->DESEMBER;
                $jumlah_sosial_ip2 = $value_sosial_ip2->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_ip2->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_ip2->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_ip2,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_ip2 = $jan_kali_ip2 * $jan_sosial_ip2;
                $feb_kali_ip2 = $feb_kali_ip2 * $feb_sosial_ip2;
                $mar_kali_ip2 = $mar_kali_ip2 * $mar_sosial_ip2;
                $apr_kali_ip2 = $apr_kali_ip2 * $apr_sosial_ip2;
                $mei_kali_ip2 = $mei_kali_ip2 * $mei_sosial_ip2;
                $jun_kali_ip2 = $jun_kali_ip2 * $jun_sosial_ip2;
                $jul_kali_ip2 = $jul_kali_ip2 * $jul_sosial_ip2;
                $agt_kali_ip2 = $agt_kali_ip2 * $agt_sosial_ip2;
                $sep_kali_ip2 = $sep_kali_ip2 * $sep_sosial_ip2;
                $okt_kali_ip2 = $okt_kali_ip2 * $okt_sosial_ip2;
                $nov_kali_ip2 = $nov_kali_ip2 * $nov_sosial_ip2;
                $des_kali_ip2 = $des_kali_ip2 * $des_sosial_ip2;
                $jumlah_kali_ip2 = ($jan_kali_ip2+$feb_kali_ip2+$mar_kali_ip2+$apr_kali_ip2+$mei_kali_ip2+$jun_kali_ip2+$jul_kali_ip2+$agt_kali_ip2+$sep_kali_ip2+$okt_kali_ip2+$nov_kali_ip2+$des_kali_ip2);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan 2.7</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_ip2,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_ip2,0,',','.'); ?></td>
        </tr>
        <!-- IP 3 -->
        <tr>
            <td align="right"><b>8</b></td>
            <td colspan="15"><b>Instansi Pemerintah ( IP3 ) ( RS. Pemerintah / Poliklinik / Puskesmas )</b></td>
        </tr>
    <?php
        $jan_kali_ip3 = 1;
        $feb_kali_ip3 = 1;
        $mar_kali_ip3 = 1;
        $apr_kali_ip3 = 1;
        $mei_kali_ip3 = 1;
        $jun_kali_ip3 = 1;
        $jul_kali_ip3 = 1;
        $agt_kali_ip3 = 1;
        $sep_kali_ip3 = 1;
        $okt_kali_ip3 = 1;
        $nov_kali_ip3 = 1;
        $des_kali_ip3 = 1;
        $jumlah_kali_ip3 = 0;

        foreach ($data as $key => $value_sosial_ip3) {
            if($value_sosial_ip3->JENIS_KELOMPOK_PELANGGAN == "RS Pemerintah / Poliklinik / Puskesmas"){
                $jan_sosial_ip3 = $value_sosial_ip3->JANUARI;
                $feb_sosial_ip3 = $value_sosial_ip3->FEBRUARI;
                $mar_sosial_ip3 = $value_sosial_ip3->MARET;
                $apr_sosial_ip3 = $value_sosial_ip3->APRIL;
                $mei_sosial_ip3 = $value_sosial_ip3->MEI;
                $jun_sosial_ip3 = $value_sosial_ip3->JUNI;
                $jul_sosial_ip3 = $value_sosial_ip3->JULI;
                $agt_sosial_ip3 = $value_sosial_ip3->AGUSTUS;
                $sep_sosial_ip3 = $value_sosial_ip3->SEPTEMBER;
                $okt_sosial_ip3 = $value_sosial_ip3->OKTOBER;
                $nov_sosial_ip3 = $value_sosial_ip3->NOVEMBER;
                $des_sosial_ip3 = $value_sosial_ip3->DESEMBER;
                $jumlah_sosial_ip3 = $value_sosial_ip3->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_ip3->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_ip3->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_ip3,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_ip3 = $jan_kali_ip3 * $jan_sosial_ip3;
                $feb_kali_ip3 = $feb_kali_ip3 * $feb_sosial_ip3;
                $mar_kali_ip3 = $mar_kali_ip3 * $mar_sosial_ip3;
                $apr_kali_ip3 = $apr_kali_ip3 * $apr_sosial_ip3;
                $mei_kali_ip3 = $mei_kali_ip3 * $mei_sosial_ip3;
                $jun_kali_ip3 = $jun_kali_ip3 * $jun_sosial_ip3;
                $jul_kali_ip3 = $jul_kali_ip3 * $jul_sosial_ip3;
                $agt_kali_ip3 = $agt_kali_ip3 * $agt_sosial_ip3;
                $sep_kali_ip3 = $sep_kali_ip3 * $sep_sosial_ip3;
                $okt_kali_ip3 = $okt_kali_ip3 * $okt_sosial_ip3;
                $nov_kali_ip3 = $nov_kali_ip3 * $nov_sosial_ip3;
                $des_kali_ip3 = $des_kali_ip3 * $des_sosial_ip3;
                $jumlah_kali_ip3 = ($jan_kali_ip3+$feb_kali_ip3+$mar_kali_ip3+$apr_kali_ip3+$mei_kali_ip3+$jun_kali_ip3+$jul_kali_ip3+$agt_kali_ip3+$sep_kali_ip3+$okt_kali_ip3+$nov_kali_ip3+$des_kali_ip3);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan 2.8</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_ip3,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_ip3,0,',','.'); ?></td>
        </tr>
        <!-- IP 4 -->
        <tr>
            <td align="right"><b>9</b></td>
            <td colspan="15"><b>Instansi Pemerintah ( IP4 ) ( Kedutaan / Konsulat )</b></td>
        </tr>
    <?php
        $jan_kali_ip4 = 1;
        $feb_kali_ip4 = 1;
        $mar_kali_ip4 = 1;
        $apr_kali_ip4 = 1;
        $mei_kali_ip4 = 1;
        $jun_kali_ip4 = 1;
        $jul_kali_ip4 = 1;
        $agt_kali_ip4 = 1;
        $sep_kali_ip4 = 1;
        $okt_kali_ip4 = 1;
        $nov_kali_ip4 = 1;
        $des_kali_ip4 = 1;
        $jumlah_kali_ip4 = 0;

        foreach ($data as $key => $value_sosial_ip4) {
            if($value_sosial_ip4->JENIS_KELOMPOK_PELANGGAN == "Kedutaan / Konsulat"){
                $jan_sosial_ip4 = $value_sosial_ip4->JANUARI;
                $feb_sosial_ip4 = $value_sosial_ip4->FEBRUARI;
                $mar_sosial_ip4 = $value_sosial_ip4->MARET;
                $apr_sosial_ip4 = $value_sosial_ip4->APRIL;
                $mei_sosial_ip4 = $value_sosial_ip4->MEI;
                $jun_sosial_ip4 = $value_sosial_ip4->JUNI;
                $jul_sosial_ip4 = $value_sosial_ip4->JULI;
                $agt_sosial_ip4 = $value_sosial_ip4->AGUSTUS;
                $sep_sosial_ip4 = $value_sosial_ip4->SEPTEMBER;
                $okt_sosial_ip4 = $value_sosial_ip4->OKTOBER;
                $nov_sosial_ip4 = $value_sosial_ip4->NOVEMBER;
                $des_sosial_ip4 = $value_sosial_ip4->DESEMBER;
                $jumlah_sosial_ip4 = $value_sosial_ip4->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_ip4->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_ip4->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_ip4,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_ip4 = $jan_kali_ip4 * $jan_sosial_ip4;
                $feb_kali_ip4 = $feb_kali_ip4 * $feb_sosial_ip4;
                $mar_kali_ip4 = $mar_kali_ip4 * $mar_sosial_ip4;
                $apr_kali_ip4 = $apr_kali_ip4 * $apr_sosial_ip4;
                $mei_kali_ip4 = $mei_kali_ip4 * $mei_sosial_ip4;
                $jun_kali_ip4 = $jun_kali_ip4 * $jun_sosial_ip4;
                $jul_kali_ip4 = $jul_kali_ip4 * $jul_sosial_ip4;
                $agt_kali_ip4 = $agt_kali_ip4 * $agt_sosial_ip4;
                $sep_kali_ip4 = $sep_kali_ip4 * $sep_sosial_ip4;
                $okt_kali_ip4 = $okt_kali_ip4 * $okt_sosial_ip4;
                $nov_kali_ip4 = $nov_kali_ip4 * $nov_sosial_ip4;
                $des_kali_ip4 = $des_kali_ip4 * $des_sosial_ip4;
                $jumlah_kali_ip4 = ($jan_kali_ip4+$feb_kali_ip4+$mar_kali_ip4+$apr_kali_ip4+$mei_kali_ip4+$jun_kali_ip4+$jul_kali_ip4+$agt_kali_ip4+$sep_kali_ip4+$okt_kali_ip4+$nov_kali_ip4+$des_kali_ip4);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan 2.9</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_ip4,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_ip4,0,',','.'); ?></td>
        </tr>
        <?php
            $total_jan_kp2 = $jan_kali_rt1+$jan_kali_rt2+$jan_kali_rt3+$jan_kali_rt4+$jan_kali_ip1+$jan_kali_ip2+$jan_kali_ip3+$jan_kali_ip4;
            $total_feb_kp2 = $feb_kali_rt1+$feb_kali_rt2+$feb_kali_rt3+$feb_kali_rt4+$feb_kali_ip1+$feb_kali_ip2+$feb_kali_ip3+$feb_kali_ip4;
            $total_mar_kp2 = $mar_kali_rt1+$mar_kali_rt2+$mar_kali_rt3+$mar_kali_rt4+$mar_kali_ip1+$mar_kali_ip2+$mar_kali_ip3+$mar_kali_ip4;
            $total_apr_kp2 = $apr_kali_rt1+$apr_kali_rt2+$apr_kali_rt3+$apr_kali_rt4+$apr_kali_ip1+$apr_kali_ip2+$apr_kali_ip3+$apr_kali_ip4;
            $total_mei_kp2 = $mei_kali_rt1+$mei_kali_rt2+$mei_kali_rt3+$mei_kali_rt4+$mei_kali_ip1+$mei_kali_ip2+$mei_kali_ip3+$mei_kali_ip4;
            $total_jun_kp2 = $jun_kali_rt1+$jun_kali_rt2+$jun_kali_rt3+$jun_kali_rt4+$jun_kali_ip1+$jun_kali_ip2+$jun_kali_ip3+$jun_kali_ip4;
            $total_jul_kp2 = $jul_kali_rt1+$jul_kali_rt2+$jul_kali_rt3+$jul_kali_rt4+$jul_kali_ip1+$jul_kali_ip2+$jul_kali_ip3+$jul_kali_ip4;
            $total_agt_kp2 = $agt_kali_rt1+$agt_kali_rt2+$agt_kali_rt3+$agt_kali_rt4+$agt_kali_ip1+$agt_kali_ip2+$agt_kali_ip3+$agt_kali_ip4;
            $total_sep_kp2 = $sep_kali_rt1+$sep_kali_rt2+$sep_kali_rt3+$sep_kali_rt4+$sep_kali_ip1+$sep_kali_ip2+$sep_kali_ip3+$sep_kali_ip4;
            $total_okt_kp2 = $okt_kali_rt1+$okt_kali_rt2+$okt_kali_rt3+$okt_kali_rt4+$okt_kali_ip1+$okt_kali_ip2+$okt_kali_ip3+$okt_kali_ip4;
            $total_nov_kp2 = $nov_kali_rt1+$nov_kali_rt2+$nov_kali_rt3+$nov_kali_rt4+$nov_kali_ip1+$nov_kali_ip2+$nov_kali_ip3+$nov_kali_ip4;
            $total_des_kp2 = $des_kali_rt1+$des_kali_rt2+$des_kali_rt3+$des_kali_rt4+$des_kali_ip1+$des_kali_ip2+$des_kali_ip3+$des_kali_ip4;
        ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan II</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($total_jan_kp2,0,',','.'); ?></td>
            <td><?php echo number_format($total_feb_kp2,0,',','.'); ?></td>
            <td><?php echo number_format($total_mar_kp2,0,',','.'); ?></td>
            <td><?php echo number_format($total_apr_kp2,0,',','.'); ?></td>
            <td><?php echo number_format($total_mei_kp2,0,',','.'); ?></td>
            <td><?php echo number_format($total_jun_kp2,0,',','.'); ?></td>
            <td><?php echo number_format($total_jul_kp2,0,',','.'); ?></td>
            <td><?php echo number_format($total_agt_kp2,0,',','.'); ?></td>
            <td><?php echo number_format($total_sep_kp2,0,',','.'); ?></td>
            <td><?php echo number_format($total_okt_kp2,0,',','.'); ?></td>
            <td><?php echo number_format($total_nov_kp2,0,',','.'); ?></td>
            <td><?php echo number_format($total_des_kp2,0,',','.'); ?></td>
            <td>
                <?php
                    $total_kp2 = ($total_jan_kp2+$total_feb_kp2+$total_mar_kp2+$total_apr_kp2+$total_mei_kp2+$total_jun_kp2+$total_jul_kp2+$total_agt_kp2+$total_sep_kp2+$total_okt_kp2+$total_nov_kp2+$total_des_kp2); 
                    echo number_format($total_kp2,0,',','.');
                ?>
            </td>
        </tr>
    <!-- KP 3 -->
        <tr>
            <td><b>III</b></td>
            <td colspan="15"><b>KELOMPOK PELANGGAN III</b></td>
        </tr>
        <!-- N1 -->
        <tr>
            <td align="right"><b>1</b></td>
            <td colspan="15"><b>Niaga Kecil ( N1 )/ RS Ananda</b></td>
        </tr>
    <?php
        $jan_kali_n1 = 1;
        $feb_kali_n1 = 1;
        $mar_kali_n1 = 1;
        $apr_kali_n1 = 1;
        $mei_kali_n1 = 1;
        $jun_kali_n1 = 1;
        $jul_kali_n1 = 1;
        $agt_kali_n1 = 1;
        $sep_kali_n1 = 1;
        $okt_kali_n1 = 1;
        $nov_kali_n1 = 1;
        $des_kali_n1 = 1;
        $jumlah_kali_n1 = 0;

        foreach ($data as $key => $value_sosial_n1) {
            if($value_sosial_n1->JENIS_KELOMPOK_PELANGGAN == "Niaga Kecil / RS Ananda"){
                $jan_sosial_n1 = $value_sosial_n1->JANUARI;
                $feb_sosial_n1 = $value_sosial_n1->FEBRUARI;
                $mar_sosial_n1 = $value_sosial_n1->MARET;
                $apr_sosial_n1 = $value_sosial_n1->APRIL;
                $mei_sosial_n1 = $value_sosial_n1->MEI;
                $jun_sosial_n1 = $value_sosial_n1->JUNI;
                $jul_sosial_n1 = $value_sosial_n1->JULI;
                $agt_sosial_n1 = $value_sosial_n1->AGUSTUS;
                $sep_sosial_n1 = $value_sosial_n1->SEPTEMBER;
                $okt_sosial_n1 = $value_sosial_n1->OKTOBER;
                $nov_sosial_n1 = $value_sosial_n1->NOVEMBER;
                $des_sosial_n1 = $value_sosial_n1->DESEMBER;
                $jumlah_sosial_n1 = $value_sosial_n1->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_n1->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_n1->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_n1,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_n1,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_n1,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_n1,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_n1,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_n1,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_n1,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_n1,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_n1,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_n1,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_n1,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_n1,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_n1,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_n1 = $jan_kali_n1 * $jan_sosial_n1;
                $feb_kali_n1 = $feb_kali_n1 * $feb_sosial_n1;
                $mar_kali_n1 = $mar_kali_n1 * $mar_sosial_n1;
                $apr_kali_n1 = $apr_kali_n1 * $apr_sosial_n1;
                $mei_kali_n1 = $mei_kali_n1 * $mei_sosial_n1;
                $jun_kali_n1 = $jun_kali_n1 * $jun_sosial_n1;
                $jul_kali_n1 = $jul_kali_n1 * $jul_sosial_n1;
                $agt_kali_n1 = $agt_kali_n1 * $agt_sosial_n1;
                $sep_kali_n1 = $sep_kali_n1 * $sep_sosial_n1;
                $okt_kali_n1 = $okt_kali_n1 * $okt_sosial_n1;
                $nov_kali_n1 = $nov_kali_n1 * $nov_sosial_n1;
                $des_kali_n1 = $des_kali_n1 * $des_sosial_n1;
                $jumlah_kali_n1 = ($jan_kali_n1+$feb_kali_n1+$mar_kali_n1+$apr_kali_n1+$mei_kali_n1+$jun_kali_n1+$jul_kali_n1+$agt_kali_n1+$sep_kali_n1+$okt_kali_n1+$nov_kali_n1+$des_kali_n1);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan 3.1</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_n1,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_n1,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_n1,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_n1,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_n1,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_n1,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_n1,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_n1,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_n1,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_n1,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_n1,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_n1,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_n1,0,',','.'); ?></td>
        </tr>
        <!-- N2 -->
        <tr>
            <td align="right"><b>2</b></td>
            <td colspan="15"><b>Niaga Menengah ( N2 )</b></td>
        </tr>
    <?php
        $jan_kali_n2 = 1;
        $feb_kali_n2 = 1;
        $mar_kali_n2 = 1;
        $apr_kali_n2 = 1;
        $mei_kali_n2 = 1;
        $jun_kali_n2 = 1;
        $jul_kali_n2 = 1;
        $agt_kali_n2 = 1;
        $sep_kali_n2 = 1;
        $okt_kali_n2 = 1;
        $nov_kali_n2 = 1;
        $des_kali_n2 = 1;
        $jumlah_kali_n2 = 0;

        foreach ($data as $key => $value_sosial_n2) {
            if($value_sosial_n2->JENIS_KELOMPOK_PELANGGAN == "Niaga Menengah / VIP"){
                $jan_sosial_n2 = $value_sosial_n2->JANUARI;
                $feb_sosial_n2 = $value_sosial_n2->FEBRUARI;
                $mar_sosial_n2 = $value_sosial_n2->MARET;
                $apr_sosial_n2 = $value_sosial_n2->APRIL;
                $mei_sosial_n2 = $value_sosial_n2->MEI;
                $jun_sosial_n2 = $value_sosial_n2->JUNI;
                $jul_sosial_n2 = $value_sosial_n2->JULI;
                $agt_sosial_n2 = $value_sosial_n2->AGUSTUS;
                $sep_sosial_n2 = $value_sosial_n2->SEPTEMBER;
                $okt_sosial_n2 = $value_sosial_n2->OKTOBER;
                $nov_sosial_n2 = $value_sosial_n2->NOVEMBER;
                $des_sosial_n2 = $value_sosial_n2->DESEMBER;
                $jumlah_sosial_n2 = $value_sosial_n2->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_n2->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_n2->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_n2,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_n2,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_n2,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_n2,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_n2,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_n2,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_n2,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_n2,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_n2,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_n2,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_n2,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_n2,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_n2,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_n2 = $jan_kali_n2 * $jan_sosial_n2;
                $feb_kali_n2 = $feb_kali_n2 * $feb_sosial_n2;
                $mar_kali_n2 = $mar_kali_n2 * $mar_sosial_n2;
                $apr_kali_n2 = $apr_kali_n2 * $apr_sosial_n2;
                $mei_kali_n2 = $mei_kali_n2 * $mei_sosial_n2;
                $jun_kali_n2 = $jun_kali_n2 * $jun_sosial_n2;
                $jul_kali_n2 = $jul_kali_n2 * $jul_sosial_n2;
                $agt_kali_n2 = $agt_kali_n2 * $agt_sosial_n2;
                $sep_kali_n2 = $sep_kali_n2 * $sep_sosial_n2;
                $okt_kali_n2 = $okt_kali_n2 * $okt_sosial_n2;
                $nov_kali_n2 = $nov_kali_n2 * $nov_sosial_n2;
                $des_kali_n2 = $des_kali_n2 * $des_sosial_n2;
                $jumlah_kali_n2 = ($jan_kali_n2+$feb_kali_n2+$mar_kali_n2+$apr_kali_n2+$mei_kali_n2+$jun_kali_n2+$jul_kali_n2+$agt_kali_n2+$sep_kali_n2+$okt_kali_n2+$nov_kali_n2+$des_kali_n2);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan 3.2</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_n2,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_n2,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_n2,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_n2,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_n2,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_n2,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_n2,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_n2,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_n2,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_n2,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_n2,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_n2,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_n2,0,',','.'); ?></td>
        </tr>
        <!-- N3 -->
        <tr>
            <td align="right"><b>3</b></td>
            <td colspan="15"><b>Niaga Besar ( N3 )</b></td>
        </tr>
    <?php
        $jan_kali_n3 = 1;
        $feb_kali_n3 = 1;
        $mar_kali_n3 = 1;
        $apr_kali_n3 = 1;
        $mei_kali_n3 = 1;
        $jun_kali_n3 = 1;
        $jul_kali_n3 = 1;
        $agt_kali_n3 = 1;
        $sep_kali_n3 = 1;
        $okt_kali_n3 = 1;
        $nov_kali_n3 = 1;
        $des_kali_n3 = 1;
        $jumlah_kali_n3 = 0;

        foreach ($data as $key => $value_sosial_n3) {
            if($value_sosial_n3->JENIS_KELOMPOK_PELANGGAN == "Niaga Besar"){
                $jan_sosial_n3 = $value_sosial_n3->JANUARI;
                $feb_sosial_n3 = $value_sosial_n3->FEBRUARI;
                $mar_sosial_n3 = $value_sosial_n3->MARET;
                $apr_sosial_n3 = $value_sosial_n3->APRIL;
                $mei_sosial_n3 = $value_sosial_n3->MEI;
                $jun_sosial_n3 = $value_sosial_n3->JUNI;
                $jul_sosial_n3 = $value_sosial_n3->JULI;
                $agt_sosial_n3 = $value_sosial_n3->AGUSTUS;
                $sep_sosial_n3 = $value_sosial_n3->SEPTEMBER;
                $okt_sosial_n3 = $value_sosial_n3->OKTOBER;
                $nov_sosial_n3 = $value_sosial_n3->NOVEMBER;
                $des_sosial_n3 = $value_sosial_n3->DESEMBER;
                $jumlah_sosial_n3 = $value_sosial_n3->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_n3->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_n3->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_n3,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_n3,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_n3,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_n3,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_n3,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_n3,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_n3,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_n3,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_n3,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_n3,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_n3,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_n3,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_n3,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_n3 = $jan_kali_n3 * $jan_sosial_n3;
                $feb_kali_n3 = $feb_kali_n3 * $feb_sosial_n3;
                $mar_kali_n3 = $mar_kali_n3 * $mar_sosial_n3;
                $apr_kali_n3 = $apr_kali_n3 * $apr_sosial_n3;
                $mei_kali_n3 = $mei_kali_n3 * $mei_sosial_n3;
                $jun_kali_n3 = $jun_kali_n3 * $jun_sosial_n3;
                $jul_kali_n3 = $jul_kali_n3 * $jul_sosial_n3;
                $agt_kali_n3 = $agt_kali_n3 * $agt_sosial_n3;
                $sep_kali_n3 = $sep_kali_n3 * $sep_sosial_n3;
                $okt_kali_n3 = $okt_kali_n3 * $okt_sosial_n3;
                $nov_kali_n3 = $nov_kali_n3 * $nov_sosial_n3;
                $des_kali_n3 = $des_kali_n3 * $des_sosial_n3;
                $jumlah_kali_n3 = ($jan_kali_n3+$feb_kali_n3+$mar_kali_n3+$apr_kali_n3+$mei_kali_n3+$jun_kali_n3+$jul_kali_n3+$agt_kali_n3+$sep_kali_n3+$okt_kali_n3+$nov_kali_n3+$des_kali_n3);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan 3.3</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_n3,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_n3,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_n3,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_n3,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_n3,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_n3,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_n3,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_n3,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_n3,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_n3,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_n3,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_n3,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_n3,0,',','.'); ?></td>
        </tr>
        <!-- I1 -->
        <tr>
            <td align="right"><b>4</b></td>
            <td colspan="15"><b>Industri Kecil ( I1 )</b></td>
        </tr>
    <?php
        $jan_kali_i1 = 1;
        $feb_kali_i1 = 1;
        $mar_kali_i1 = 1;
        $apr_kali_i1 = 1;
        $mei_kali_i1 = 1;
        $jun_kali_i1 = 1;
        $jul_kali_i1 = 1;
        $agt_kali_i1 = 1;
        $sep_kali_i1 = 1;
        $okt_kali_i1 = 1;
        $nov_kali_i1 = 1;
        $des_kali_i1 = 1;
        $jumlah_kali_i1 = 0;

        foreach ($data as $key => $value_sosial_i1) {
            if($value_sosial_i1->JENIS_KELOMPOK_PELANGGAN == "Industri Kecil"){
                $jan_sosial_i1 = $value_sosial_i1->JANUARI;
                $feb_sosial_i1 = $value_sosial_i1->FEBRUARI;
                $mar_sosial_i1 = $value_sosial_i1->MARET;
                $apr_sosial_i1 = $value_sosial_i1->APRIL;
                $mei_sosial_i1 = $value_sosial_i1->MEI;
                $jun_sosial_i1 = $value_sosial_i1->JUNI;
                $jul_sosial_i1 = $value_sosial_i1->JULI;
                $agt_sosial_i1 = $value_sosial_i1->AGUSTUS;
                $sep_sosial_i1 = $value_sosial_i1->SEPTEMBER;
                $okt_sosial_i1 = $value_sosial_i1->OKTOBER;
                $nov_sosial_i1 = $value_sosial_i1->NOVEMBER;
                $des_sosial_i1 = $value_sosial_i1->DESEMBER;
                $jumlah_sosial_i1 = $value_sosial_i1->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_i1->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_i1->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_i1,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_i1,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_i1,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_i1,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_i1,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_i1,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_i1,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_i1,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_i1,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_i1,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_i1,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_i1,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_i1,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_i1 = $jan_kali_i1 * $jan_sosial_i1;
                $feb_kali_i1 = $feb_kali_i1 * $feb_sosial_i1;
                $mar_kali_i1 = $mar_kali_i1 * $mar_sosial_i1;
                $apr_kali_i1 = $apr_kali_i1 * $apr_sosial_i1;
                $mei_kali_i1 = $mei_kali_i1 * $mei_sosial_i1;
                $jun_kali_i1 = $jun_kali_i1 * $jun_sosial_i1;
                $jul_kali_i1 = $jul_kali_i1 * $jul_sosial_i1;
                $agt_kali_i1 = $agt_kali_i1 * $agt_sosial_i1;
                $sep_kali_i1 = $sep_kali_i1 * $sep_sosial_i1;
                $okt_kali_i1 = $okt_kali_i1 * $okt_sosial_i1;
                $nov_kali_i1 = $nov_kali_i1 * $nov_sosial_i1;
                $des_kali_i1 = $des_kali_i1 * $des_sosial_i1;
                $jumlah_kali_i1 = ($jan_kali_i1+$feb_kali_i1+$mar_kali_i1+$apr_kali_i1+$mei_kali_i1+$jun_kali_i1+$jul_kali_i1+$agt_kali_i1+$sep_kali_i1+$okt_kali_i1+$nov_kali_i1+$des_kali_i1);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan 3.4</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_i1,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_i1,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_i1,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_i1,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_i1,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_i1,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_i1,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_i1,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_i1,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_i1,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_i1,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_i1,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_i1,0,',','.'); ?></td>
        </tr>
        <!-- I2 -->
        <tr>
            <td align="right"><b>5</b></td>
            <td colspan="15"><b>Industri Sedang ( I2 )</b></td>
        </tr>
    <?php
        $jan_kali_i2 = 1;
        $feb_kali_i2 = 1;
        $mar_kali_i2 = 1;
        $apr_kali_i2 = 1;
        $mei_kali_i2 = 1;
        $jun_kali_i2 = 1;
        $jul_kali_i2 = 1;
        $agt_kali_i2 = 1;
        $sep_kali_i2 = 1;
        $okt_kali_i2 = 1;
        $nov_kali_i2 = 1;
        $des_kali_i2 = 1;
        $jumlah_kali_i2 = 0;

        foreach ($data as $key => $value_sosial_i2) {
            if($value_sosial_i2->JENIS_KELOMPOK_PELANGGAN == "Industri Sedang"){
                $jan_sosial_i2 = $value_sosial_i2->JANUARI;
                $feb_sosial_i2 = $value_sosial_i2->FEBRUARI;
                $mar_sosial_i2 = $value_sosial_i2->MARET;
                $apr_sosial_i2 = $value_sosial_i2->APRIL;
                $mei_sosial_i2 = $value_sosial_i2->MEI;
                $jun_sosial_i2 = $value_sosial_i2->JUNI;
                $jul_sosial_i2 = $value_sosial_i2->JULI;
                $agt_sosial_i2 = $value_sosial_i2->AGUSTUS;
                $sep_sosial_i2 = $value_sosial_i2->SEPTEMBER;
                $okt_sosial_i2 = $value_sosial_i2->OKTOBER;
                $nov_sosial_i2 = $value_sosial_i2->NOVEMBER;
                $des_sosial_i2 = $value_sosial_i2->DESEMBER;
                $jumlah_sosial_i2 = $value_sosial_i2->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_i2->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_i2->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_i2,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_i2,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_i2,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_i2,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_i2,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_i2,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_i2,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_i2,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_i2,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_i2,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_i2,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_i2,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_i2,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_i2 = $jan_kali_i2 * $jan_sosial_i2;
                $feb_kali_i2 = $feb_kali_i2 * $feb_sosial_i2;
                $mar_kali_i2 = $mar_kali_i2 * $mar_sosial_i2;
                $apr_kali_i2 = $apr_kali_i2 * $apr_sosial_i2;
                $mei_kali_i2 = $mei_kali_i2 * $mei_sosial_i2;
                $jun_kali_i2 = $jun_kali_i2 * $jun_sosial_i2;
                $jul_kali_i2 = $jul_kali_i2 * $jul_sosial_i2;
                $agt_kali_i2 = $agt_kali_i2 * $agt_sosial_i2;
                $sep_kali_i2 = $sep_kali_i2 * $sep_sosial_i2;
                $okt_kali_i2 = $okt_kali_i2 * $okt_sosial_i2;
                $nov_kali_i2 = $nov_kali_i2 * $nov_sosial_i2;
                $des_kali_i2 = $des_kali_i2 * $des_sosial_i2;
                $jumlah_kali_i2 = ($jan_kali_i2+$feb_kali_i2+$mar_kali_i2+$apr_kali_i2+$mei_kali_i2+$jun_kali_i2+$jul_kali_i2+$agt_kali_i2+$sep_kali_i2+$okt_kali_i2+$nov_kali_i2+$des_kali_i2);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan 3.5</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_i2,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_i2,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_i2,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_i2,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_i2,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_i2,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_i2,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_i2,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_i2,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_i2,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_i2,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_i2,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_i2,0,',','.'); ?></td>
        </tr>
        <!-- I3 -->
        <tr>
            <td align="right"><b>6</b></td>
            <td colspan="15"><b>Industri Besar (I3)</b></td>
        </tr>
    <?php
        $jan_kali_i3 = 1;
        $feb_kali_i3 = 1;
        $mar_kali_i3 = 1;
        $apr_kali_i3 = 1;
        $mei_kali_i3 = 1;
        $jun_kali_i3 = 1;
        $jul_kali_i3 = 1;
        $agt_kali_i3 = 1;
        $sep_kali_i3 = 1;
        $okt_kali_i3 = 1;
        $nov_kali_i3 = 1;
        $des_kali_i3 = 1;
        $jumlah_kali_i3 = 0;

        foreach ($data as $key => $value_sosial_i3) {
            if($value_sosial_i3->JENIS_KELOMPOK_PELANGGAN == "Industri Besar"){
                $jan_sosial_i3 = $value_sosial_i3->JANUARI;
                $feb_sosial_i3 = $value_sosial_i3->FEBRUARI;
                $mar_sosial_i3 = $value_sosial_i3->MARET;
                $apr_sosial_i3 = $value_sosial_i3->APRIL;
                $mei_sosial_i3 = $value_sosial_i3->MEI;
                $jun_sosial_i3 = $value_sosial_i3->JUNI;
                $jul_sosial_i3 = $value_sosial_i3->JULI;
                $agt_sosial_i3 = $value_sosial_i3->AGUSTUS;
                $sep_sosial_i3 = $value_sosial_i3->SEPTEMBER;
                $okt_sosial_i3 = $value_sosial_i3->OKTOBER;
                $nov_sosial_i3 = $value_sosial_i3->NOVEMBER;
                $des_sosial_i3 = $value_sosial_i3->DESEMBER;
                $jumlah_sosial_i3 = $value_sosial_i3->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_i3->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_i3->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_i3,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_i3,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_i3,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_i3,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_i3,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_i3,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_i3,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_i3,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_i3,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_i3,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_i3,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_i3,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_i3,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_i3 = $jan_kali_i3 * $jan_sosial_i3;
                $feb_kali_i3 = $feb_kali_i3 * $feb_sosial_i3;
                $mar_kali_i3 = $mar_kali_i3 * $mar_sosial_i3;
                $apr_kali_i3 = $apr_kali_i3 * $apr_sosial_i3;
                $mei_kali_i3 = $mei_kali_i3 * $mei_sosial_i3;
                $jun_kali_i3 = $jun_kali_i3 * $jun_sosial_i3;
                $jul_kali_i3 = $jul_kali_i3 * $jul_sosial_i3;
                $agt_kali_i3 = $agt_kali_i3 * $agt_sosial_i3;
                $sep_kali_i3 = $sep_kali_i3 * $sep_sosial_i3;
                $okt_kali_i3 = $okt_kali_i3 * $okt_sosial_i3;
                $nov_kali_i3 = $nov_kali_i3 * $nov_sosial_i3;
                $des_kali_i3 = $des_kali_i3 * $des_sosial_i3;
                $jumlah_kali_i3 = ($jan_kali_i3+$feb_kali_i3+$mar_kali_i3+$apr_kali_i3+$mei_kali_i3+$jun_kali_i3+$jul_kali_i3+$agt_kali_i3+$sep_kali_i3+$okt_kali_i3+$nov_kali_i3+$des_kali_i3);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan 3.6</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_i3,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_i3,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_i3,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_i3,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_i3,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_i3,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_i3,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_i3,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_i3,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_i3,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_i3,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_i3,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_i3,0,',','.'); ?></td>
        </tr>
        <?php
            $tot_jan_kp3 = $jan_kali_n1+$jan_kali_n2+$jan_kali_n3+$jan_kali_i1+$jan_kali_i2+$jan_kali_i3;
            $tot_feb_kp3 = $feb_kali_n1+$feb_kali_n2+$feb_kali_n3+$feb_kali_i1+$feb_kali_i2+$feb_kali_i3;
            $tot_mar_kp3 = $mar_kali_n1+$mar_kali_n2+$mar_kali_n3+$mar_kali_i1+$mar_kali_i2+$mar_kali_i3;
            $tot_apr_kp3 = $apr_kali_n1+$apr_kali_n2+$apr_kali_n3+$apr_kali_i1+$apr_kali_i2+$apr_kali_i3;
            $tot_mei_kp3 = $mei_kali_n1+$mei_kali_n2+$mei_kali_n3+$mei_kali_i1+$mei_kali_i2+$mei_kali_i3;
            $tot_jun_kp3 = $jun_kali_n1+$jun_kali_n2+$jun_kali_n3+$jun_kali_i1+$jun_kali_i2+$jun_kali_i3;
            $tot_jul_kp3 = $jul_kali_n1+$jul_kali_n2+$jul_kali_n3+$jul_kali_i1+$jul_kali_i2+$jul_kali_i3;
            $tot_agt_kp3 = $agt_kali_n1+$agt_kali_n2+$agt_kali_n3+$agt_kali_i1+$agt_kali_i2+$agt_kali_i3;
            $tot_sep_kp3 = $sep_kali_n1+$sep_kali_n2+$sep_kali_n3+$sep_kali_i1+$sep_kali_i2+$sep_kali_i3;
            $tot_okt_kp3 = $okt_kali_n1+$okt_kali_n2+$okt_kali_n3+$okt_kali_i1+$okt_kali_i2+$okt_kali_i3;
            $tot_nov_kp3 = $nov_kali_n1+$nov_kali_n2+$nov_kali_n3+$nov_kali_i1+$nov_kali_i2+$nov_kali_i3;
            $tot_des_kp3 = $des_kali_n1+$des_kali_n2+$des_kali_n3+$des_kali_i1+$des_kali_i2+$des_kali_i3;
            $tot_jumlah_kp3 = $tot_jan_kp3+$tot_feb_kp3+$tot_mar_kp3+$tot_apr_kp3+$tot_mei_kp3+$tot_jun_kp3+$tot_jul_kp3+$tot_agt_kp3+$tot_sep_kp3+$tot_okt_kp3+$tot_nov_kp3+$tot_des_kp3;
        ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan III</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($tot_jan_kp3,0,',','.'); ?></td>
            <td><?php echo number_format($tot_feb_kp3,0,',','.'); ?></td>
            <td><?php echo number_format($tot_mar_kp3,0,',','.'); ?></td>
            <td><?php echo number_format($tot_apr_kp3,0,',','.'); ?></td>
            <td><?php echo number_format($tot_mei_kp3,0,',','.'); ?></td>
            <td><?php echo number_format($tot_jun_kp3,0,',','.'); ?></td>
            <td><?php echo number_format($tot_jul_kp3,0,',','.'); ?></td>
            <td><?php echo number_format($tot_agt_kp3,0,',','.'); ?></td>
            <td><?php echo number_format($tot_sep_kp3,0,',','.'); ?></td>
            <td><?php echo number_format($tot_okt_kp3,0,',','.'); ?></td>
            <td><?php echo number_format($tot_nov_kp3,0,',','.'); ?></td>
            <td><?php echo number_format($tot_des_kp3,0,',','.'); ?></td>
            <td><?php echo number_format($tot_jumlah_kp3,0,',','.'); ?></td>
        </tr>
    <!-- KP 4 -->
        <tr>
            <td align="left"><b>IV</b></td>
            <td colspan="15"><b>KELOMPOK PELANGGAN IV</b></td>
        </tr>
        <!-- PDAM -->
        <tr>
            <td align="right"><b>1</b></td>
            <td colspan="15"><b>Khusus PDAM</b></td>
        </tr>
    <?php
        $jan_kali_pdam = 1;
        $feb_kali_pdam = 1;
        $mar_kali_pdam = 1;
        $apr_kali_pdam = 1;
        $mei_kali_pdam = 1;
        $jun_kali_pdam = 1;
        $jul_kali_pdam = 1;
        $agt_kali_pdam = 1;
        $sep_kali_pdam = 1;
        $okt_kali_pdam = 1;
        $nov_kali_pdam = 1;
        $des_kali_pdam = 1;
        $jumlah_kali_pdam = 0;

        foreach ($data as $key => $value_sosial_pdam) {
            if($value_sosial_pdam->JENIS_KELOMPOK_PELANGGAN == "Curah PDAM Bekasi"){
                $jan_sosial_pdam = $value_sosial_pdam->JANUARI;
                $feb_sosial_pdam = $value_sosial_pdam->FEBRUARI;
                $mar_sosial_pdam = $value_sosial_pdam->MARET;
                $apr_sosial_pdam = $value_sosial_pdam->APRIL;
                $mei_sosial_pdam = $value_sosial_pdam->MEI;
                $jun_sosial_pdam = $value_sosial_pdam->JUNI;
                $jul_sosial_pdam = $value_sosial_pdam->JULI;
                $agt_sosial_pdam = $value_sosial_pdam->AGUSTUS;
                $sep_sosial_pdam = $value_sosial_pdam->SEPTEMBER;
                $okt_sosial_pdam = $value_sosial_pdam->OKTOBER;
                $nov_sosial_pdam = $value_sosial_pdam->NOVEMBER;
                $des_sosial_pdam = $value_sosial_pdam->DESEMBER;
                $jumlah_sosial_pdam = $value_sosial_pdam->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_pdam->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_pdam->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_pdam,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_pdam = $jan_kali_pdam * $jan_sosial_pdam;
                $feb_kali_pdam = $feb_kali_pdam * $feb_sosial_pdam;
                $mar_kali_pdam = $mar_kali_pdam * $mar_sosial_pdam;
                $apr_kali_pdam = $apr_kali_pdam * $apr_sosial_pdam;
                $mei_kali_pdam = $mei_kali_pdam * $mei_sosial_pdam;
                $jun_kali_pdam = $jun_kali_pdam * $jun_sosial_pdam;
                $jul_kali_pdam = $jul_kali_pdam * $jul_sosial_pdam;
                $agt_kali_pdam = $agt_kali_pdam * $agt_sosial_pdam;
                $sep_kali_pdam = $sep_kali_pdam * $sep_sosial_pdam;
                $okt_kali_pdam = $okt_kali_pdam * $okt_sosial_pdam;
                $nov_kali_pdam = $nov_kali_pdam * $nov_sosial_pdam;
                $des_kali_pdam = $des_kali_pdam * $des_sosial_pdam;
                $jumlah_kali_pdam = ($jan_kali_pdam+$feb_kali_pdam+$mar_kali_pdam+$apr_kali_pdam+$mei_kali_pdam+$jun_kali_pdam+$jul_kali_pdam+$agt_kali_pdam+$sep_kali_pdam+$okt_kali_pdam+$nov_kali_pdam+$des_kali_pdam);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Khusus PDAM</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_pdam,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_pdam,0,',','.'); ?></td>
        </tr>
        <!-- TA -->
        <tr>
            <td align="right"><b>2</b></td>
            <td colspan="15"><b>Khusus TA</b></td>
        </tr>
    <?php
        $jan_kali_ta = 1;
        $feb_kali_ta = 1;
        $mar_kali_ta = 1;
        $apr_kali_ta = 1;
        $mei_kali_ta = 1;
        $jun_kali_ta = 1;
        $jul_kali_ta = 1;
        $agt_kali_ta = 1;
        $sep_kali_ta = 1;
        $okt_kali_ta = 1;
        $nov_kali_ta = 1;
        $des_kali_ta = 1;
        $jumlah_kali_ta = 0;

        foreach ($data as $key => $value_sosial_ta) {
            if($value_sosial_ta->JENIS_KELOMPOK_PELANGGAN == "Mobil Tangki / Angkutan Lainnya"){
                $jan_sosial_ta = $value_sosial_ta->JANUARI;
                $feb_sosial_ta = $value_sosial_ta->FEBRUARI;
                $mar_sosial_ta = $value_sosial_ta->MARET;
                $apr_sosial_ta = $value_sosial_ta->APRIL;
                $mei_sosial_ta = $value_sosial_ta->MEI;
                $jun_sosial_ta = $value_sosial_ta->JUNI;
                $jul_sosial_ta = $value_sosial_ta->JULI;
                $agt_sosial_ta = $value_sosial_ta->AGUSTUS;
                $sep_sosial_ta = $value_sosial_ta->SEPTEMBER;
                $okt_sosial_ta = $value_sosial_ta->OKTOBER;
                $nov_sosial_ta = $value_sosial_ta->NOVEMBER;
                $des_sosial_ta = $value_sosial_ta->DESEMBER;
                $jumlah_sosial_ta = $value_sosial_ta->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_ta->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_ta->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_ta,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_ta,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_ta,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_ta,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_ta,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_ta,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_ta,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_ta,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_ta,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_ta,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_ta,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_ta,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_ta,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_ta = $jan_kali_ta * $jan_sosial_ta;
                $feb_kali_ta = $feb_kali_ta * $feb_sosial_ta;
                $mar_kali_ta = $mar_kali_ta * $mar_sosial_ta;
                $apr_kali_ta = $apr_kali_ta * $apr_sosial_ta;
                $mei_kali_ta = $mei_kali_ta * $mei_sosial_ta;
                $jun_kali_ta = $jun_kali_ta * $jun_sosial_ta;
                $jul_kali_ta = $jul_kali_ta * $jul_sosial_ta;
                $agt_kali_ta = $agt_kali_ta * $agt_sosial_ta;
                $sep_kali_ta = $sep_kali_ta * $sep_sosial_ta;
                $okt_kali_ta = $okt_kali_ta * $okt_sosial_ta;
                $nov_kali_ta = $nov_kali_ta * $nov_sosial_ta;
                $des_kali_ta = $des_kali_ta * $des_sosial_ta;
                $jumlah_kali_ta = ($jan_kali_ta+$feb_kali_ta+$mar_kali_ta+$apr_kali_ta+$mei_kali_ta+$jun_kali_ta+$jul_kali_ta+$agt_kali_ta+$sep_kali_ta+$okt_kali_ta+$nov_kali_ta+$des_kali_ta);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Khusus TA</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_ta,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_ta,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_ta,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_ta,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_ta,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_ta,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_ta,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_ta,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_ta,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_ta,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_ta,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_ta,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_ta,0,',','.'); ?></td>
        </tr>
        <!-- Sumarrecon -->
        <tr>
            <td align="right"><b>3</b></td>
            <td colspan="15"><b>Khusus Summarecon</b></td>
        </tr>
    <?php
        $jan_kali_sc = 1;
        $feb_kali_sc = 1;
        $mar_kali_sc = 1;
        $apr_kali_sc = 1;
        $mei_kali_sc = 1;
        $jun_kali_sc = 1;
        $jul_kali_sc = 1;
        $agt_kali_sc = 1;
        $sep_kali_sc = 1;
        $okt_kali_sc = 1;
        $nov_kali_sc = 1;
        $des_kali_sc = 1;
        $jumlah_kali_sc = 0;

        foreach ($data as $key => $value_sosial_sc) {
            if($value_sosial_sc->JENIS_KELOMPOK_PELANGGAN == "Curah PT SUMMARECON"){
                $jan_sosial_sc = $value_sosial_sc->JANUARI;
                $feb_sosial_sc = $value_sosial_sc->FEBRUARI;
                $mar_sosial_sc = $value_sosial_sc->MARET;
                $apr_sosial_sc = $value_sosial_sc->APRIL;
                $mei_sosial_sc = $value_sosial_sc->MEI;
                $jun_sosial_sc = $value_sosial_sc->JUNI;
                $jul_sosial_sc = $value_sosial_sc->JULI;
                $agt_sosial_sc = $value_sosial_sc->AGUSTUS;
                $sep_sosial_sc = $value_sosial_sc->SEPTEMBER;
                $okt_sosial_sc = $value_sosial_sc->OKTOBER;
                $nov_sosial_sc = $value_sosial_sc->NOVEMBER;
                $des_sosial_sc = $value_sosial_sc->DESEMBER;
                $jumlah_sosial_sc = $value_sosial_sc->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_sc->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_sc->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_sc,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_sc,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_sc,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_sc,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_sc,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_sc,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_sc,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_sc,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_sc,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_sc,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_sc,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_sc,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_sc,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_sc = $jan_kali_sc * $jan_sosial_sc;
                $feb_kali_sc = $feb_kali_sc * $feb_sosial_sc;
                $mar_kali_sc = $mar_kali_sc * $mar_sosial_sc;
                $apr_kali_sc = $apr_kali_sc * $apr_sosial_sc;
                $mei_kali_sc = $mei_kali_sc * $mei_sosial_sc;
                $jun_kali_sc = $jun_kali_sc * $jun_sosial_sc;
                $jul_kali_sc = $jul_kali_sc * $jul_sosial_sc;
                $agt_kali_sc = $agt_kali_sc * $agt_sosial_sc;
                $sep_kali_sc = $sep_kali_sc * $sep_sosial_sc;
                $okt_kali_sc = $okt_kali_sc * $okt_sosial_sc;
                $nov_kali_sc = $nov_kali_sc * $nov_sosial_sc;
                $des_kali_sc = $des_kali_sc * $des_sosial_sc;
                $jumlah_kali_sc = ($jan_kali_sc+$feb_kali_sc+$mar_kali_sc+$apr_kali_sc+$mei_kali_sc+$jun_kali_sc+$jul_kali_sc+$agt_kali_sc+$sep_kali_sc+$okt_kali_sc+$nov_kali_sc+$des_kali_sc);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Khusus Summarecon</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_sc,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_sc,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_sc,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_sc,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_sc,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_sc,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_sc,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_sc,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_sc,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_sc,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_sc,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_sc,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_sc,0,',','.'); ?></td>
        </tr>
        <!-- General Motor -->
        <tr>
            <td align="right"><b>4</b></td>
            <td colspan="15"><b>Khusus PT. GENERAL MOTORS</b></td>
        </tr>
    <?php
        $jan_kali_gm = 1;
        $feb_kali_gm = 1;
        $mar_kali_gm = 1;
        $apr_kali_gm = 1;
        $mei_kali_gm = 1;
        $jun_kali_gm = 1;
        $jul_kali_gm = 1;
        $agt_kali_gm = 1;
        $sep_kali_gm = 1;
        $okt_kali_gm = 1;
        $nov_kali_gm = 1;
        $des_kali_gm = 1;
        $jumlah_kali_gm = 0;

        foreach ($data as $key => $value_sosial_gm) {
            if($value_sosial_gm->JENIS_KELOMPOK_PELANGGAN == "Curah PT SUMMARECON"){
                $jan_sosial_gm = $value_sosial_gm->JANUARI;
                $feb_sosial_gm = $value_sosial_gm->FEBRUARI;
                $mar_sosial_gm = $value_sosial_gm->MARET;
                $apr_sosial_gm = $value_sosial_gm->APRIL;
                $mei_sosial_gm = $value_sosial_gm->MEI;
                $jun_sosial_gm = $value_sosial_gm->JUNI;
                $jul_sosial_gm = $value_sosial_gm->JULI;
                $agt_sosial_gm = $value_sosial_gm->AGUSTUS;
                $sep_sosial_gm = $value_sosial_gm->SEPTEMBER;
                $okt_sosial_gm = $value_sosial_gm->OKTOBER;
                $nov_sosial_gm = $value_sosial_gm->NOVEMBER;
                $des_sosial_gm = $value_sosial_gm->DESEMBER;
                $jumlah_sosial_gm = $value_sosial_gm->JUMLAH;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_sosial_gm->URAIAN; ?></td>
            <td><?php echo number_format($value_sosial_gm->M3,0,',','.'); ?></td>
            <td><?php echo number_format($jan_sosial_gm,0,',','.'); ?></td>
            <td><?php echo number_format($feb_sosial_gm,0,',','.'); ?></td>
            <td><?php echo number_format($mar_sosial_gm,0,',','.'); ?></td>
            <td><?php echo number_format($apr_sosial_gm,0,',','.'); ?></td>
            <td><?php echo number_format($mei_sosial_gm,0,',','.'); ?></td>
            <td><?php echo number_format($jun_sosial_gm,0,',','.'); ?></td>
            <td><?php echo number_format($jul_sosial_gm,0,',','.'); ?></td>
            <td><?php echo number_format($agt_sosial_gm,0,',','.'); ?></td>
            <td><?php echo number_format($sep_sosial_gm,0,',','.'); ?></td>
            <td><?php echo number_format($okt_sosial_gm,0,',','.'); ?></td>
            <td><?php echo number_format($nov_sosial_gm,0,',','.'); ?></td>
            <td><?php echo number_format($des_sosial_gm,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_sosial_gm,0,',','.'); ?></td>
        </tr>
    <?php
                $jan_kali_gm = $jan_kali_gm * $jan_sosial_gm;
                $feb_kali_gm = $feb_kali_gm * $feb_sosial_gm;
                $mar_kali_gm = $mar_kali_gm * $mar_sosial_gm;
                $apr_kali_gm = $apr_kali_gm * $apr_sosial_gm;
                $mei_kali_gm = $mei_kali_gm * $mei_sosial_gm;
                $jun_kali_gm = $jun_kali_gm * $jun_sosial_gm;
                $jul_kali_gm = $jul_kali_gm * $jul_sosial_gm;
                $agt_kali_gm = $agt_kali_gm * $agt_sosial_gm;
                $sep_kali_gm = $sep_kali_gm * $sep_sosial_gm;
                $okt_kali_gm = $okt_kali_gm * $okt_sosial_gm;
                $nov_kali_gm = $nov_kali_gm * $nov_sosial_gm;
                $des_kali_gm = $des_kali_gm * $des_sosial_gm;
                $jumlah_kali_gm = ($jan_kali_gm+$feb_kali_gm+$mar_kali_gm+$apr_kali_gm+$mei_kali_gm+$jun_kali_gm+$jul_kali_gm+$agt_kali_gm+$sep_kali_gm+$okt_kali_gm+$nov_kali_gm+$des_kali_gm);
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Khusus General Motors</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jan_kali_gm,0,',','.'); ?></td>
            <td><?php echo number_format($feb_kali_gm,0,',','.'); ?></td>
            <td><?php echo number_format($mar_kali_gm,0,',','.'); ?></td>
            <td><?php echo number_format($apr_kali_gm,0,',','.'); ?></td>
            <td><?php echo number_format($mei_kali_gm,0,',','.'); ?></td>
            <td><?php echo number_format($jun_kali_gm,0,',','.'); ?></td>
            <td><?php echo number_format($jul_kali_gm,0,',','.'); ?></td>
            <td><?php echo number_format($agt_kali_gm,0,',','.'); ?></td>
            <td><?php echo number_format($sep_kali_gm,0,',','.'); ?></td>
            <td><?php echo number_format($okt_kali_gm,0,',','.'); ?></td>
            <td><?php echo number_format($nov_kali_gm,0,',','.'); ?></td>
            <td><?php echo number_format($des_kali_gm,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_kali_gm,0,',','.'); ?></td>
        </tr>
        <?php
            $tot_jan_kp4 = $jan_kali_pdam+$jan_kali_ta+$jan_kali_sc+$jan_kali_gm;
            $tot_feb_kp4 = $feb_kali_pdam+$feb_kali_ta+$feb_kali_sc+$feb_kali_gm;
            $tot_mar_kp4 = $mar_kali_pdam+$mar_kali_ta+$mar_kali_sc+$mar_kali_gm;
            $tot_apr_kp4 = $apr_kali_pdam+$apr_kali_ta+$apr_kali_sc+$apr_kali_gm;
            $tot_mei_kp4 = $mei_kali_pdam+$mei_kali_ta+$mei_kali_sc+$mei_kali_gm;
            $tot_jun_kp4 = $jun_kali_pdam+$jun_kali_ta+$jun_kali_sc+$jun_kali_gm;
            $tot_jul_kp4 = $jul_kali_pdam+$jul_kali_ta+$jul_kali_sc+$jul_kali_gm;
            $tot_agt_kp4 = $agt_kali_pdam+$agt_kali_ta+$agt_kali_sc+$agt_kali_gm;
            $tot_sep_kp4 = $sep_kali_pdam+$sep_kali_ta+$sep_kali_sc+$sep_kali_gm;
            $tot_okt_kp4 = $okt_kali_pdam+$okt_kali_ta+$okt_kali_sc+$okt_kali_gm;
            $tot_nov_kp4 = $nov_kali_pdam+$nov_kali_ta+$nov_kali_sc+$nov_kali_gm;
            $tot_des_kp4 = $des_kali_pdam+$des_kali_ta+$des_kali_sc+$des_kali_gm;
            $tot_jumlah_kp4 = $tot_jan_kp4+$tot_feb_kp4+$tot_mar_kp4+$tot_apr_kp4+$tot_mei_kp4+$tot_jun_kp4+$tot_jul_kp4+$tot_agt_kp4+$tot_sep_kp4+$tot_okt_kp4+$tot_nov_kp4+$tot_des_kp4;
        ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Harga Air Kelompok Pelanggan IV</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($tot_jan_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($tot_feb_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($tot_mar_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($tot_apr_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($tot_mei_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($tot_jun_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($tot_jul_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($tot_agt_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($tot_sep_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($tot_okt_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($tot_nov_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($tot_des_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($tot_jumlah_kp4,0,',','.'); ?></td>
        </tr>
        <?php
            $total_jan_kp1_kp4 = $total_jan_kp1+$total_jan_kp2+$tot_jan_kp3+$tot_jan_kp4;
            $total_feb_kp1_kp4 = $total_feb_kp1+$total_feb_kp2+$tot_feb_kp3+$tot_feb_kp4;
            $total_mar_kp1_kp4 = $total_mar_kp1+$total_mar_kp2+$tot_mar_kp3+$tot_mar_kp4;
            $total_apr_kp1_kp4 = $total_apr_kp1+$total_apr_kp2+$tot_apr_kp3+$tot_apr_kp4;
            $total_mei_kp1_kp4 = $total_mei_kp1+$total_mei_kp2+$tot_mei_kp3+$tot_mei_kp4;
            $total_jun_kp1_kp4 = $total_jun_kp1+$total_jun_kp2+$tot_jun_kp3+$tot_jun_kp4;
            $total_jul_kp1_kp4 = $total_jul_kp1+$total_jul_kp2+$tot_jul_kp3+$tot_jul_kp4;
            $total_agt_kp1_kp4 = $total_agt_kp1+$total_agt_kp2+$tot_agt_kp3+$tot_agt_kp4;
            $total_sep_kp1_kp4 = $total_sep_kp1+$total_sep_kp2+$tot_sep_kp3+$tot_sep_kp4;
            $total_okt_kp1_kp4 = $total_okt_kp1+$total_okt_kp2+$tot_okt_kp3+$tot_okt_kp4;
            $total_nov_kp1_kp4 = $total_nov_kp1+$total_nov_kp2+$tot_nov_kp3+$tot_nov_kp4;
            $total_des_kp1_kp4 = $total_des_kp1+$total_des_kp2+$tot_des_kp3+$tot_des_kp4;
            $total_jumlah_kp = $total_jan_kp1_kp4+$total_feb_kp1_kp4+$total_mar_kp1_kp4+$total_apr_kp1_kp4+$total_mei_kp1_kp4+$total_jun_kp1_kp4+$total_jul_kp1_kp4+$total_agt_kp1_kp4+$total_sep_kp1_kp4+$total_okt_kp1_kp4+$total_nov_kp1_kp4+$total_des_kp1_kp4;
        ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah    Harga   Air (I s.d. IV)</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($total_jan_kp1_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($total_feb_kp1_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($total_mar_kp1_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($total_apr_kp1_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($total_mei_kp1_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($total_jun_kp1_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($total_jul_kp1_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($total_agt_kp1_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($total_sep_kp1_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($total_okt_kp1_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($total_nov_kp1_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($total_des_kp1_kp4,0,',','.'); ?></td>
            <td><?php echo number_format($total_jumlah_kp,0,',','.'); ?></td>
        </tr>
    <!-- UNSUR LAINNYA -->
        <tr>
            <td align="left"><b>V</b></td>
            <td colspan="15"><b>UNSUR - UNSUR LAINNYA</b></td>
        </tr>
        <?php
            $total_m3 = 0;
            $total_jan_m3 = 0;
            $total_feb_m3 = 0;
            $total_mar_m3 = 0;
            $total_apr_m3 = 0;
            $total_mei_m3 = 0;
            $total_jun_m3 = 0;
            $total_jul_m3 = 0;
            $total_agt_m3 = 0;
            $total_sep_m3 = 0;
            $total_okt_m3 = 0;
            $total_nov_m3 = 0;
            $total_des_m3 = 0;

            foreach ($data as $value_sp) {
                if($value_sp->URAIAN == "Jumlah sambungan pelanggan ( SP )"){
                    $total_m3 += $value_sp->M3;
                    $total_jan_m3 += $value_sp->JANUARI;
                    $total_feb_m3 += $value_sp->FEBRUARI;
                    $total_mar_m3 += $value_sp->MARET;
                    $total_apr_m3 += $value_sp->APRIL;
                    $total_mei_m3 += $value_sp->MEI;
                    $total_jun_m3 += $value_sp->JUNI;
                    $total_jul_m3 += $value_sp->JULI;
                    $total_agt_m3 += $value_sp->AGUSTUS;
                    $total_sep_m3 += $value_sp->SEPTEMBER;
                    $total_okt_m3 += $value_sp->OKTOBER;
                    $total_nov_m3 += $value_sp->NOVEMBER;
                    $total_des_m3 += $value_sp->DESEMBER;
                }
            }
        ?>
        <tr>
            <td>&nbsp;</td>
            <td>- Total Pelanggan Aktif Komulatif</td>
            <td><?php echo number_format($total_m3,0,',','.'); ?></td>
            <td><?php echo number_format($total_jan_m3,0,',','.'); ?></td>
            <td><?php echo number_format($total_feb_m3,0,',','.'); ?></td>
            <td><?php echo number_format($total_mar_m3,0,',','.'); ?></td>
            <td><?php echo number_format($total_apr_m3,0,',','.'); ?></td>
            <td><?php echo number_format($total_mei_m3,0,',','.'); ?></td>
            <td><?php echo number_format($total_jun_m3,0,',','.'); ?></td>
            <td><?php echo number_format($total_jul_m3,0,',','.'); ?></td>
            <td><?php echo number_format($total_agt_m3,0,',','.'); ?></td>
            <td><?php echo number_format($total_sep_m3,0,',','.'); ?></td>
            <td><?php echo number_format($total_okt_m3,0,',','.'); ?></td>
            <td><?php echo number_format($total_nov_m3,0,',','.'); ?></td>
            <td><?php echo number_format($total_des_m3,0,',','.'); ?></td>
            <td><?php echo number_format($total_des_m3,0,',','.'); ?></td>
        </tr>
        <?php
            $jasa_admin = 0;
            $jasa_admin1 = 0;
            $jasa_admin2 = 0;
            $jasa_admin3 = 0;
            $jasa_admin4 = 0;
            $jasa_admin5 = 0;
            $jasa_admin6 = 0;
            $jasa_admin7 = 0;
            $jasa_admin8 = 0;
            $jasa_admin9 = 0;
            $jasa_admin10 = 0;
            $jasa_admin11 = 0;
            $jasa_admin_jumlah = 0;

            foreach ($data as $value_admin) {
               if($value_admin->JENIS_KELOMPOK_PELANGGAN == "Jasa Administrasi"){
                    $jasa_admin = $value_admin->JANUARI;
                    $jasa_admin1 = $value_admin->FEBRUARI;
                    $jasa_admin2 = $value_admin->MARET;
                    $jasa_admin3 = $value_admin->APRIL;
                    $jasa_admin4 = $value_admin->MEI;
                    $jasa_admin5 = $value_admin->JUNI;
                    $jasa_admin6 = $value_admin->JULI;
                    $jasa_admin7 = $value_admin->AGUSTUS;
                    $jasa_admin8 = $value_admin->SEPTEMBER;
                    $jasa_admin9 = $value_admin->OKTOBER;
                    $jasa_admin10 = $value_admin->NOVEMBER;
                    $jasa_admin11 = $value_admin->DESEMBER;
                    $jasa_admin_jumlah = $value_admin->DESEMBER;
        ?>
        <tr>
            <td>&nbsp;</td>
            <td>- <?php echo $value_admin->URAIAN; ?></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($jasa_admin,0,',','.'); ?></td>
            <td><?php echo number_format($jasa_admin1,0,',','.'); ?></td>
            <td><?php echo number_format($jasa_admin2,0,',','.'); ?></td>
            <td><?php echo number_format($jasa_admin3,0,',','.'); ?></td>
            <td><?php echo number_format($jasa_admin4,0,',','.'); ?></td>
            <td><?php echo number_format($jasa_admin5,0,',','.'); ?></td>
            <td><?php echo number_format($jasa_admin6,0,',','.'); ?></td>
            <td><?php echo number_format($jasa_admin7,0,',','.'); ?></td>
            <td><?php echo number_format($jasa_admin8,0,',','.'); ?></td>
            <td><?php echo number_format($jasa_admin9,0,',','.'); ?></td>
            <td><?php echo number_format($jasa_admin10,0,',','.'); ?></td>
            <td><?php echo number_format($jasa_admin11,0,',','.'); ?></td>
            <td><?php echo number_format($jasa_admin_jumlah,0,',','.'); ?></td>
        </tr>
        <?php
               }
            }
        ?>
        <?php
            $total_admin = $jasa_admin;
            $total_admin1 = $jasa_admin1;
            $total_admin2 = $jasa_admin2;
            $total_admin3 = $jasa_admin3;
            $total_admin4 = $jasa_admin4;
            $total_admin5 = $jasa_admin5;
            $total_admin6 = $jasa_admin6;
            $total_admin7 = $jasa_admin7;
            $total_admin8 = $jasa_admin8;
            $total_admin9 = $jasa_admin9;
            $total_admin10 = $jasa_admin10;
            $total_admin11 = $jasa_admin11;
            $total_admin_jumlah = $total_admin+$total_admin1+$total_admin2+$total_admin3+$total_admin4+$total_admin5+$total_admin6+$total_admin7+$total_admin8+$total_admin9+$total_admin10+$total_admin11;
        ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Pendapatan Penjualan Air unsur lainnya</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($total_admin,0,',','.'); ?></td>
            <td><?php echo number_format($total_admin1,0,',','.'); ?></td>
            <td><?php echo number_format($total_admin2,0,',','.'); ?></td>
            <td><?php echo number_format($total_admin3,0,',','.'); ?></td>
            <td><?php echo number_format($total_admin4,0,',','.'); ?></td>
            <td><?php echo number_format($total_admin5,0,',','.'); ?></td>
            <td><?php echo number_format($total_admin6,0,',','.'); ?></td>
            <td><?php echo number_format($total_admin7,0,',','.'); ?></td>
            <td><?php echo number_format($total_admin8,0,',','.'); ?></td>
            <td><?php echo number_format($total_admin9,0,',','.'); ?></td>
            <td><?php echo number_format($total_admin10,0,',','.'); ?></td>
            <td><?php echo number_format($total_admin11,0,',','.'); ?></td>
            <td><?php echo number_format($total_admin_jumlah,0,',','.'); ?></td>
        </tr>
    <!-- TOTAL -->
        <?php
            $total_jan = $total_admin+$total_jan_kp1_kp4;
            $total_feb = $total_admin1+$total_feb_kp1_kp4;
            $total_mar = $total_admin2+$total_mar_kp1_kp4;
            $total_apr = $total_admin3+$total_apr_kp1_kp4;
            $total_mei = $total_admin4+$total_mei_kp1_kp4;
            $total_jun = $total_admin5+$total_jun_kp1_kp4;
            $total_jul = $total_admin6+$total_jul_kp1_kp4;
            $total_agt = $total_admin7+$total_agt_kp1_kp4;
            $total_sep = $total_admin8+$total_sep_kp1_kp4;
            $total_okt = $total_admin9+$total_okt_kp1_kp4;
            $total_nov = $total_admin10+$total_nov_kp1_kp4;
            $total_des = $total_admin11+$total_nov_kp1_kp4;
            $total_jumlah = $total_jan+$total_feb+$total_mar+$total_apr+$total_mei+$total_jun+$total_jul+$total_agt+$total_sep+$total_okt+$total_nov+$total_des;
        ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>TOTAL</b></td>
            <td>&nbsp;</td>
            <td><?php echo number_format($total_jan,0,',','.'); ?></td>
            <td><?php echo number_format($total_feb,0,',','.'); ?></td>
            <td><?php echo number_format($total_mar,0,',','.'); ?></td>
            <td><?php echo number_format($total_apr,0,',','.'); ?></td>
            <td><?php echo number_format($total_mei,0,',','.'); ?></td>
            <td><?php echo number_format($total_jun,0,',','.'); ?></td>
            <td><?php echo number_format($total_jul,0,',','.'); ?></td>
            <td><?php echo number_format($total_agt,0,',','.'); ?></td>
            <td><?php echo number_format($total_sep,0,',','.'); ?></td>
            <td><?php echo number_format($total_okt,0,',','.'); ?></td>
            <td><?php echo number_format($total_nov,0,',','.'); ?></td>
            <td><?php echo number_format($total_des,0,',','.'); ?></td>
            <td><?php echo number_format($total_jumlah,0,',','.'); ?></td>
        </tr>
    </tbody>
</table>
<?PHP
    // require_once "localhost/siaga/material/fpdf/html2pdf.class.php";
    
    $content = ob_get_clean();
    $width_in_inches = 19.4;
    $height_in_inches = 13.5;
    $width_in_mm = $width_in_inches * 25.4;
    $height_in_mm = $height_in_inches * 25.4;
    $html2pdf = new HTML2PDF('L',array($width_in_mm,$height_in_mm),'en');
    // $html2pdf = new HTML2PDF('L','A2','fr');
    $html2pdf->pdf->SetTitle("Rencana Perkembangan Sambungan Pelanggan $tahun");
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('laporan_sambungan_pelanggan_$tahun.pdf');
?>