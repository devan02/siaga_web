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
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="480" height="90" alt="KOP PDAM"></td>
        <td>
            <img src="<?=base_url();?>files/pdam/KOP_tulisan.png" width="550" height="90" alt="KOP PDAM">
        </td>
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="480" height="90" alt="KOP PDAM"></td>
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
            <th rowspan="2">NOMOR PERKIRAAN</th>
            <th rowspan="2">URAIAN</th>
            <th colspan="12">Bulan</th>
            <th rowspan="2">JUMLAH</th>
            <th rowspan="2">ESTIMASI<br/>TAHUN<br/>2014</th>
            <th colspan="2">MENAIK /<br/>(MENURUN)</th>
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
            <th width="80">JUMLAH</th>
            <th width="80">%</th>
        </tr>
    </thead>
    <tbody>
    <!-- NON AIR -->
        <tr>
            <td>81.02.00</td>
            <td colspan="17"><b>PENDAPATAN NON AIR</b></td>
        </tr>
    <?php
        $sum_jan_non_air = 0;
        $sum_feb_non_air = 0;
        $sum_mar_non_air = 0;
        $sum_apr_non_air = 0;
        $sum_mei_non_air = 0;
        $sum_jun_non_air = 0;
        $sum_jul_non_air = 0;
        $sum_agt_non_air = 0;
        $sum_sep_non_air = 0;
        $sum_okt_non_air = 0;
        $sum_nov_non_air = 0;
        $sum_des_non_air = 0;
        $sum_jumlah_non_air = 0;
        $sum_estimasi_2014_non_air = 0;

        foreach ($data as $value_non_air) {
           if($value_non_air->JENIS == "PENDAPATAN NON AIR"){
                $jan_non_air = $value_non_air->JANUARI;
                $feb_non_air = $value_non_air->FEBRUARI;
                $mar_non_air = $value_non_air->MARET;
                $apr_non_air = $value_non_air->APRIL;
                $mei_non_air = $value_non_air->MEI;
                $jun_non_air = $value_non_air->JUNI;
                $jul_non_air = $value_non_air->JULI;
                $agt_non_air = $value_non_air->AGUSTUS;
                $sep_non_air = $value_non_air->SEPTEMBER;
                $okt_non_air = $value_non_air->OKTOBER;
                $nov_non_air = $value_non_air->NOVEMBER;
                $des_non_air = $value_non_air->DESEMBER;
                $jumlah_non_air = $jan_non_air+$feb_non_air+$mar_non_air+$apr_non_air+$mei_non_air+$jun_non_air+$jul_non_air+$agt_non_air+$sep_non_air+$okt_non_air+$nov_non_air+$des_non_air;
                $estimasi_2014_non_air = $value_non_air->ESTIMASI_TAHUN_2014;
    ?>
        <tr>
            <td align="center"><?php echo $value_non_air->KODE_PERKIRAAN; ?></td>
            <td><?php echo $value_non_air->NAMA_PERKIRAAN; ?></td>
            <td><?php echo number_format($jan_non_air,0,',','.')?></td>
            <td><?php echo number_format($feb_non_air,0,',','.')?></td>
            <td><?php echo number_format($mar_non_air,0,',','.')?></td>
            <td><?php echo number_format($apr_non_air,0,',','.')?></td>
            <td><?php echo number_format($mei_non_air,0,',','.')?></td>
            <td><?php echo number_format($jun_non_air,0,',','.')?></td>
            <td><?php echo number_format($jul_non_air,0,',','.')?></td>
            <td><?php echo number_format($agt_non_air,0,',','.')?></td>
            <td><?php echo number_format($sep_non_air,0,',','.')?></td>
            <td><?php echo number_format($okt_non_air,0,',','.')?></td>
            <td><?php echo number_format($nov_non_air,0,',','.')?></td>
            <td><?php echo number_format($des_non_air,0,',','.')?></td>
            <td><?php echo number_format($jumlah_non_air,0,',','.')?></td>
            <td><?php echo number_format($estimasi_2014_non_air,0,',','.')?></td>
            <td>
                <?php
                    $total_non_air = $jumlah_non_air-$estimasi_2014_non_air;
                    echo angka_positif($total_non_air);
                ?>
            </td>
            <td>
                <?php
                    $persen_non_air = 0;
                    if($estimasi_2014_non_air != 0){
                        $persen_non_air = ($total_non_air/$estimasi_2014_non_air)*100;
                    }
                    echo positif_persen($persen_non_air);
                ?>
            </td>
        </tr>
    <?php
                $sum_jan_non_air += $jan_non_air;
                $sum_feb_non_air += $feb_non_air;
                $sum_mar_non_air += $mar_non_air;
                $sum_apr_non_air += $apr_non_air;
                $sum_mei_non_air += $mei_non_air;
                $sum_jun_non_air += $jun_non_air;
                $sum_jul_non_air += $jul_non_air;
                $sum_agt_non_air += $agt_non_air;
                $sum_sep_non_air += $sep_non_air;
                $sum_okt_non_air += $okt_non_air;
                $sum_nov_non_air += $nov_non_air;
                $sum_des_non_air += $des_non_air;
                $sum_jumlah_non_air += $jumlah_non_air;
                $sum_estimasi_2014_non_air += $value_non_air->ESTIMASI_TAHUN_2014;
           }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="center"><b>Jumlah Pendapatan Non Air</b></td>
            <td><?php echo number_format($sum_jan_non_air,0,',','.')?></td>
            <td><?php echo number_format($sum_feb_non_air,0,',','.')?></td>
            <td><?php echo number_format($sum_mar_non_air,0,',','.')?></td>
            <td><?php echo number_format($sum_apr_non_air,0,',','.')?></td>
            <td><?php echo number_format($sum_mei_non_air,0,',','.')?></td>
            <td><?php echo number_format($sum_jun_non_air,0,',','.')?></td>
            <td><?php echo number_format($sum_jul_non_air,0,',','.')?></td>
            <td><?php echo number_format($sum_agt_non_air,0,',','.')?></td>
            <td><?php echo number_format($sum_sep_non_air,0,',','.')?></td>
            <td><?php echo number_format($sum_okt_non_air,0,',','.')?></td>
            <td><?php echo number_format($sum_nov_non_air,0,',','.')?></td>
            <td><?php echo number_format($sum_des_non_air,0,',','.')?></td>
            <td><?php echo number_format($sum_jumlah_non_air,0,',','.')?></td>
            <td><?php echo number_format($sum_estimasi_2014_non_air,0,',','.')?></td>
            <td>
                <?php
                    $total_jumlah_non_air = $sum_jumlah_non_air-$sum_estimasi_2014_non_air;
                    echo angka_positif($total_jumlah_non_air);
                ?>
            </td>
            <td>
                <?php
                    $sum_persen_non_air = 0;
                    if($sum_estimasi_2014_non_air != 0){
                        $sum_persen_non_air = ($total_jumlah_non_air/$sum_estimasi_2014_non_air)*100;
                    }
                    echo positif_persen($sum_persen_non_air);
                ?>
            </td>
        </tr>
    <!-- KEMITRAAN -->
        <tr>
            <td>81.10.00</td>
            <td colspan="17"><b>PENDAPATAN KEMITRAAN</b></td>
        </tr>
    <?php
        $sum_jan_kemitraan = 0;
        $sum_feb_kemitraan = 0;
        $sum_mar_kemitraan = 0;
        $sum_apr_kemitraan = 0;
        $sum_mei_kemitraan = 0;
        $sum_jun_kemitraan = 0;
        $sum_jul_kemitraan = 0;
        $sum_agt_kemitraan = 0;
        $sum_sep_kemitraan = 0;
        $sum_okt_kemitraan = 0;
        $sum_nov_kemitraan = 0;
        $sum_des_kemitraan = 0;
        $sum_jumlah_kemitraan = 0;
        $sum_estimasi_2014_kemitraan = 0;

        foreach ($data as $value_kemitraan) {
           if($value_kemitraan->JENIS == "PENDAPATAN KEMITRAAN"){
                $jan_kemitraan = $value_kemitraan->JANUARI;
                $feb_kemitraan = $value_kemitraan->FEBRUARI;
                $mar_kemitraan = $value_kemitraan->MARET;
                $apr_kemitraan = $value_kemitraan->APRIL;
                $mei_kemitraan = $value_kemitraan->MEI;
                $jun_kemitraan = $value_kemitraan->JUNI;
                $jul_kemitraan = $value_kemitraan->JULI;
                $agt_kemitraan = $value_kemitraan->AGUSTUS;
                $sep_kemitraan = $value_kemitraan->SEPTEMBER;
                $okt_kemitraan = $value_kemitraan->OKTOBER;
                $nov_kemitraan = $value_kemitraan->NOVEMBER;
                $des_kemitraan = $value_kemitraan->DESEMBER;
                $jumlah_kemitraan = $jan_kemitraan+$feb_kemitraan+$mar_kemitraan+$apr_kemitraan+$mei_kemitraan+$jun_kemitraan+$jul_kemitraan+$agt_kemitraan+$sep_kemitraan+$okt_kemitraan+$nov_kemitraan+$des_kemitraan;
                $estimasi_2014_kemitraan = $value_kemitraan->ESTIMASI_TAHUN_2014;
    ?>
        <tr>
            <td align="center"><?php echo $value_kemitraan->KODE_PERKIRAAN; ?></td>
            <td><?php echo $value_kemitraan->NAMA_PERKIRAAN; ?></td>
            <td><?php echo number_format($jan_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($feb_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($mar_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($apr_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($mei_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($jun_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($jul_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($agt_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($sep_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($okt_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($nov_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($des_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($jumlah_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($estimasi_2014_kemitraan,0,',','.')?></td>
            <td>
                <?php
                    $total_kemitraan = $jumlah_kemitraan-$estimasi_2014_kemitraan;
                    echo angka_positif($total_kemitraan);
                ?>
            </td>
            <td>
                <?php
                    $persen_kemitraan = 0;
                    if($estimasi_2014_kemitraan != 0){
                        $persen_kemitraan = ($total_kemitraan/$estimasi_2014_kemitraan)*100;
                    }
                    echo positif_persen($persen_kemitraan);
                ?>
            </td>
        </tr>
    <?php
                $sum_jan_kemitraan += $jan_kemitraan;
                $sum_feb_kemitraan += $feb_kemitraan;
                $sum_mar_kemitraan += $mar_kemitraan;
                $sum_apr_kemitraan += $apr_kemitraan;
                $sum_mei_kemitraan += $mei_kemitraan;
                $sum_jun_kemitraan += $jun_kemitraan;
                $sum_jul_kemitraan += $jul_kemitraan;
                $sum_agt_kemitraan += $agt_kemitraan;
                $sum_sep_kemitraan += $sep_kemitraan;
                $sum_okt_kemitraan += $okt_kemitraan;
                $sum_nov_kemitraan += $nov_kemitraan;
                $sum_des_kemitraan += $des_kemitraan;
                $sum_jumlah_kemitraan += $jumlah_kemitraan;
                $sum_estimasi_2014_kemitraan += $value_kemitraan->ESTIMASI_TAHUN_2014;
           }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="center"><b>Jumlah Pendapatan Kemitraan</b></td>
            <td><?php echo number_format($sum_jan_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($sum_feb_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($sum_mar_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($sum_apr_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($sum_mei_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($sum_jun_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($sum_jul_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($sum_agt_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($sum_sep_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($sum_okt_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($sum_nov_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($sum_des_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($sum_jumlah_kemitraan,0,',','.')?></td>
            <td><?php echo number_format($sum_estimasi_2014_kemitraan,0,',','.')?></td>
            <td>
                <?php
                    $total_jumlah_kemitraan = $sum_jumlah_kemitraan-$sum_estimasi_2014_kemitraan;
                    echo angka_positif($total_jumlah_kemitraan);
                ?>
            </td>
            <td>
                <?php
                    $sum_persen_kemitraan = 0;
                    if($sum_estimasi_2014_kemitraan != 0){
                        $sum_persen_kemitraan = ($total_jumlah_kemitraan/$sum_estimasi_2014_kemitraan)*100;
                    }
                    echo positif_persen($sum_persen_kemitraan);
                ?>
            </td>
        </tr>
    <!-- PENDAPATAN AIR LIMBAH -->
        <tr>
            <td>81.20.00</td>
            <td colspan="17"><b>PENDAPATAN AIR LIMBAH</b></td>
        </tr>
    <?php
        $sum_jan_air_limbah = 0;
        $sum_feb_air_limbah = 0;
        $sum_mar_air_limbah = 0;
        $sum_apr_air_limbah = 0;
        $sum_mei_air_limbah = 0;
        $sum_jun_air_limbah = 0;
        $sum_jul_air_limbah = 0;
        $sum_agt_air_limbah = 0;
        $sum_sep_air_limbah = 0;
        $sum_okt_air_limbah = 0;
        $sum_nov_air_limbah = 0;
        $sum_des_air_limbah = 0;
        $sum_jumlah_air_limbah = 0;
        $sum_estimasi_2014_air_limbah = 0;

        foreach ($data as $value_air_limbah) {
           if($value_air_limbah->JENIS == "PENDAPATAN AIR LIMBAH"){
                $jan_air_limbah = $value_air_limbah->JANUARI;
                $feb_air_limbah = $value_air_limbah->FEBRUARI;
                $mar_air_limbah = $value_air_limbah->MARET;
                $apr_air_limbah = $value_air_limbah->APRIL;
                $mei_air_limbah = $value_air_limbah->MEI;
                $jun_air_limbah = $value_air_limbah->JUNI;
                $jul_air_limbah = $value_air_limbah->JULI;
                $agt_air_limbah = $value_air_limbah->AGUSTUS;
                $sep_air_limbah = $value_air_limbah->SEPTEMBER;
                $okt_air_limbah = $value_air_limbah->OKTOBER;
                $nov_air_limbah = $value_air_limbah->NOVEMBER;
                $des_air_limbah = $value_air_limbah->DESEMBER;
                $jumlah_air_limbah = $jan_air_limbah+$feb_air_limbah+$mar_air_limbah+$apr_air_limbah+$mei_air_limbah+$jun_air_limbah+$jul_air_limbah+$agt_air_limbah+$sep_air_limbah+$okt_air_limbah+$nov_air_limbah+$des_air_limbah;
                $estimasi_2014_air_limbah = $value_air_limbah->ESTIMASI_TAHUN_2014;
    ?>
        <tr>
            <td align="center"><?php echo $value_air_limbah->KODE_PERKIRAAN; ?></td>
            <td><?php echo $value_air_limbah->NAMA_PERKIRAAN; ?></td>
            <td><?php echo number_format($jan_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($feb_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($mar_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($apr_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($mei_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($jun_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($jul_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($agt_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($sep_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($okt_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($nov_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($des_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($jumlah_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($estimasi_2014_air_limbah,0,',','.')?></td>
            <td>
                <?php
                    $total_air_limbah = $jumlah_air_limbah-$estimasi_2014_air_limbah;
                    echo angka_positif($total_air_limbah);
                ?>
            </td>
            <td>
                <?php
                    $persen_air_limbah = 0;
                    if($estimasi_2014_air_limbah != 0){
                        $persen_air_limbah = ($total_air_limbah/$estimasi_2014_air_limbah)*100;
                    }
                    echo positif_persen($persen_air_limbah);
                ?>
            </td>
        </tr>
    <?php
                $sum_jan_air_limbah += $jan_air_limbah;
                $sum_feb_air_limbah += $feb_air_limbah;
                $sum_mar_air_limbah += $mar_air_limbah;
                $sum_apr_air_limbah += $apr_air_limbah;
                $sum_mei_air_limbah += $mei_air_limbah;
                $sum_jun_air_limbah += $jun_air_limbah;
                $sum_jul_air_limbah += $jul_air_limbah;
                $sum_agt_air_limbah += $agt_air_limbah;
                $sum_sep_air_limbah += $sep_air_limbah;
                $sum_okt_air_limbah += $okt_air_limbah;
                $sum_nov_air_limbah += $nov_air_limbah;
                $sum_des_air_limbah += $des_air_limbah;
                $sum_jumlah_air_limbah += $jumlah_air_limbah;
                $sum_estimasi_2014_air_limbah += $value_air_limbah->ESTIMASI_TAHUN_2014;
           }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="center"><b>Jumlah Pendapatan Air Limbah</b></td>
            <td><?php echo number_format($sum_jan_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($sum_feb_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($sum_mar_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($sum_apr_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($sum_mei_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($sum_jun_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($sum_jul_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($sum_agt_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($sum_sep_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($sum_okt_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($sum_nov_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($sum_des_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($sum_jumlah_air_limbah,0,',','.')?></td>
            <td><?php echo number_format($sum_estimasi_2014_air_limbah,0,',','.')?></td>
            <td>
                <?php
                    $total_jumlah_air_limbah = $sum_jumlah_air_limbah-$sum_estimasi_2014_air_limbah;
                    echo angka_positif($total_jumlah_air_limbah);
                ?>
            </td>
            <td>
                <?php
                    $sum_persen_air_limbah = 0;
                    if($sum_estimasi_2014_air_limbah != 0){
                        $sum_persen_air_limbah = ($total_jumlah_air_limbah/$sum_estimasi_2014_air_limbah)*100;
                    }
                    echo positif_persen($sum_persen_air_limbah);
                ?>
            </td>
        </tr>
        <?php
            $jan_pendapatan_lainnya = $sum_jan_non_air+$sum_jan_kemitraan+$sum_jan_air_limbah;
            $feb_pendapatan_lainnya = $sum_feb_non_air+$sum_feb_kemitraan+$sum_feb_air_limbah;
            $mar_pendapatan_lainnya = $sum_mar_non_air+$sum_mar_kemitraan+$sum_mar_air_limbah;
            $apr_pendapatan_lainnya = $sum_apr_non_air+$sum_apr_kemitraan+$sum_apr_air_limbah;
            $mei_pendapatan_lainnya = $sum_mei_non_air+$sum_mei_kemitraan+$sum_mei_air_limbah;
            $jun_pendapatan_lainnya = $sum_jun_non_air+$sum_jun_kemitraan+$sum_jun_air_limbah;
            $jul_pendapatan_lainnya = $sum_jul_non_air+$sum_jul_kemitraan+$sum_jul_air_limbah;
            $agt_pendapatan_lainnya = $sum_agt_non_air+$sum_agt_kemitraan+$sum_agt_air_limbah;
            $sep_pendapatan_lainnya = $sum_sep_non_air+$sum_sep_kemitraan+$sum_sep_air_limbah;
            $okt_pendapatan_lainnya = $sum_okt_non_air+$sum_okt_kemitraan+$sum_okt_air_limbah;
            $nov_pendapatan_lainnya = $sum_nov_non_air+$sum_nov_kemitraan+$sum_nov_air_limbah;
            $des_pendapatan_lainnya = $sum_des_non_air+$sum_des_kemitraan+$sum_des_air_limbah;
            $jumlah_pendapatan_lainnya = $sum_jumlah_non_air+$sum_jumlah_kemitraan+$sum_jumlah_air_limbah;
            $estimasi_2014_pendapatan_lainnya = $sum_estimasi_2014_non_air+$sum_estimasi_2014_kemitraan+$sum_estimasi_2014_air_limbah;
        ?>
        <tr>
            <td>&nbsp;</td>
            <td><b>Jumlah Pendapatan Usaha Lainnya</b></td>
            <td><?php echo number_format($jan_pendapatan_lainnya,0,',','.')?></td>
            <td><?php echo number_format($feb_pendapatan_lainnya,0,',','.')?></td>
            <td><?php echo number_format($mar_pendapatan_lainnya,0,',','.')?></td>
            <td><?php echo number_format($apr_pendapatan_lainnya,0,',','.')?></td>
            <td><?php echo number_format($mei_pendapatan_lainnya,0,',','.')?></td>
            <td><?php echo number_format($jun_pendapatan_lainnya,0,',','.')?></td>
            <td><?php echo number_format($jul_pendapatan_lainnya,0,',','.')?></td>
            <td><?php echo number_format($agt_pendapatan_lainnya,0,',','.')?></td>
            <td><?php echo number_format($sep_pendapatan_lainnya,0,',','.')?></td>
            <td><?php echo number_format($okt_pendapatan_lainnya,0,',','.')?></td>
            <td><?php echo number_format($nov_pendapatan_lainnya,0,',','.')?></td>
            <td><?php echo number_format($des_pendapatan_lainnya,0,',','.')?></td>
            <td><?php echo number_format($jumlah_pendapatan_lainnya,0,',','.')?></td>
            <td><?php echo number_format($estimasi_2014_pendapatan_lainnya,0,',','.')?></td>
            <td>
                <?php
                    $total_pendapatan = $jumlah_pendapatan_lainnya-$estimasi_2014_pendapatan_lainnya;
                    echo angka_positif($total_pendapatan);
                ?>
            </td>
            <td>
                <?php
                    $persen_pendapatan = 0;
                    if($estimasi_2014_pendapatan_lainnya != 0){
                        $persen_pendapatan = ($total_pendapatan/$estimasi_2014_pendapatan_lainnya)*100;
                    }
                    echo positif_persen($persen_pendapatan);
                ?>
            </td>
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