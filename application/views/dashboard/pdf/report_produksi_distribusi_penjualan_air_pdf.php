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
            <th rowspan="2">NO</th>
            <th rowspan="2">URAIAN</th>
            <th colspan="12">Bulan</th>
            <th rowspan="2">JUMLAH</th>
            <th rowspan="2">TAHUN 2014</th>
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
    <!-- PRODUKSI -->
        <tr>
            <td align="left"><b>I</b></td>
            <td colspan="17"><b>PRODUKSI</b></td>
        </tr>
    <?php
        $no = 0;
        $sum_jan_produksi = 0;
        $sum_feb_produksi = 0;
        $sum_mar_produksi = 0;
        $sum_apr_produksi = 0;
        $sum_mei_produksi = 0;
        $sum_jun_produksi = 0;
        $sum_jul_produksi = 0;
        $sum_agt_produksi = 0;
        $sum_sep_produksi = 0;
        $sum_okt_produksi = 0;
        $sum_nov_produksi = 0;
        $sum_des_produksi = 0;
        $sum_jumlah_produksi = 0;
        $sum_2014 = 0;
        $sum_total_jumlah = 0;

        foreach ($data as $value_produksi) {
            $no++;
            if($value_produksi->JENIS == "PRODUKSI"){
                $januari_produksi = $value_produksi->JANUARI;
                $februari_produksi = $value_produksi->FEBRUARI;
                $maret_produksi = $value_produksi->MARET;
                $april_produksi = $value_produksi->APRIL;
                $mei_produksi = $value_produksi->MEI;
                $juni_produksi = $value_produksi->JUNI;
                $juli_produksi = $value_produksi->JULI;
                $agustus_produksi = $value_produksi->AGUSTUS;
                $september_produksi = $value_produksi->SEPTEMBER;
                $oktober_produksi = $value_produksi->OKTOBER;
                $november_produksi = $value_produksi->NOVEMBER;
                $desember_produksi = $value_produksi->DESEMBER;
                $jumlah_prduksi = $januari_produksi+$februari_produksi+$maret_produksi+$april_produksi+$mei_produksi+$juni_produksi+$juli_produksi+$agustus_produksi+$september_produksi+$oktober_produksi+$november_produksi+$desember_produksi;
                $jumlah_produksi_2014 = $value_produksi->TAHUN_2014;
                $total_jumlah = $jumlah_prduksi-$jumlah_produksi_2014;
                $persen = 0;
                if($jumlah_produksi_2014 != 0){
                    $persen = ($total_jumlah/$jumlah_produksi_2014)*100;
                }
    ?>
        <tr>
            <td align="right"><?php echo $no; ?></td>
            <td><?php echo $value_produksi->URAIAN; ?></td>
            <td><?php echo number_format($januari_produksi,0,',','.'); ?></td>
            <td><?php echo number_format($februari_produksi,0,',','.'); ?></td>
            <td><?php echo number_format($maret_produksi,0,',','.'); ?></td>
            <td><?php echo number_format($april_produksi,0,',','.'); ?></td>
            <td><?php echo number_format($mei_produksi,0,',','.'); ?></td>
            <td><?php echo number_format($juni_produksi,0,',','.'); ?></td>
            <td><?php echo number_format($juli_produksi,0,',','.'); ?></td>
            <td><?php echo number_format($agustus_produksi,0,',','.'); ?></td>
            <td><?php echo number_format($september_produksi,0,',','.'); ?></td>
            <td><?php echo number_format($oktober_produksi,0,',','.'); ?></td>
            <td><?php echo number_format($november_produksi,0,',','.'); ?></td>
            <td><?php echo number_format($desember_produksi,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_prduksi,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_produksi_2014,0,',','.'); ?></td>
            <td><?php echo angka_positif($total_jumlah); ?></td>
            <td><?php echo positif_persen($persen); ?></td>
        </tr>
    <?php
                $sum_jan_produksi += $januari_produksi;
                $sum_feb_produksi += $februari_produksi;
                $sum_mar_produksi += $maret_produksi;
                $sum_apr_produksi += $april_produksi;
                $sum_mei_produksi += $mei_produksi;
                $sum_jun_produksi += $juni_produksi;
                $sum_jul_produksi += $juli_produksi;
                $sum_agt_produksi += $agustus_produksi;
                $sum_sep_produksi += $september_produksi;
                $sum_okt_produksi += $oktober_produksi;
                $sum_nov_produksi += $november_produksi;
                $sum_des_produksi += $desember_produksi;
                $sum_jumlah_produksi += $jumlah_prduksi;
                $sum_2014 += $jumlah_produksi_2014;
                $sum_total_jumlah += $total_jumlah;
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="right"><b>Jumlah Produksi</b></td>
            <td><?php echo number_format($sum_jan_produksi,0,',','.')?></td>
            <td><?php echo number_format($sum_feb_produksi,0,',','.')?></td>
            <td><?php echo number_format($sum_mar_produksi,0,',','.')?></td>
            <td><?php echo number_format($sum_apr_produksi,0,',','.')?></td>
            <td><?php echo number_format($sum_mei_produksi,0,',','.')?></td>
            <td><?php echo number_format($sum_jun_produksi,0,',','.')?></td>
            <td><?php echo number_format($sum_jul_produksi,0,',','.')?></td>
            <td><?php echo number_format($sum_agt_produksi,0,',','.')?></td>
            <td><?php echo number_format($sum_sep_produksi,0,',','.')?></td>
            <td><?php echo number_format($sum_okt_produksi,0,',','.')?></td>
            <td><?php echo number_format($sum_nov_produksi,0,',','.')?></td>
            <td><?php echo number_format($sum_des_produksi,0,',','.')?></td>
            <td><?php echo number_format($sum_jumlah_produksi,0,',','.')?></td>
            <td><?php echo number_format($sum_2014,0,',','.')?></td>
            <td><?php echo number_format($sum_total_jumlah,0,',','.')?></td>
            <td>
                <?php
                    $sum_persen = 0;
                    if($sum_2014 != 0){
                        $sum_persen = ($sum_total_jumlah/$sum_2014)*100;
                    }
                    echo positif_persen($sum_persen);
                ?>
            </td>
        </tr>
    <!-- DISTRIBUSI -->
        <tr>
            <td align="left"><b>II</b></td>
            <td colspan="17"><b>DISTRIBUSI</b></td>
        </tr>
    <?php
        $no2 = 1;
        $sum_jan_distribusi = 0;
        $sum_feb_distribusi = 0;
        $sum_mar_distribusi = 0;
        $sum_apr_distribusi = 0;
        $sum_mei_distribusi = 0;
        $sum_jun_distribusi = 0;
        $sum_jul_distribusi = 0;
        $sum_agt_distribusi = 0;
        $sum_sep_distribusi = 0;
        $sum_okt_distribusi = 0;
        $sum_nov_distribusi = 0;
        $sum_des_distribusi = 0;
        $sum_jumlah_distribusi = 0;
        $sum_2014_distribusi = 0;
        $sum_total_jumlah = 0;

        foreach ($data as $value_distribusi) {
            if($value_distribusi->JENIS == "DISTRIBUSI"){
                $januari_distribusi = $value_distribusi->JANUARI;
                $februari_distribusi = $value_distribusi->FEBRUARI;
                $maret_distribusi = $value_distribusi->MARET;
                $april_distribusi = $value_distribusi->APRIL;
                $mei_distribusi = $value_distribusi->MEI;
                $juni_distribusi = $value_distribusi->JUNI;
                $juli_distribusi = $value_distribusi->JULI;
                $agustus_distribusi = $value_distribusi->AGUSTUS;
                $september_distribusi = $value_distribusi->SEPTEMBER;
                $oktober_distribusi = $value_distribusi->OKTOBER;
                $november_distribusi = $value_distribusi->NOVEMBER;
                $desember_distribusi = $value_distribusi->DESEMBER;
                $jumlah_distribusi = $januari_distribusi+$februari_distribusi+$maret_distribusi+$april_distribusi+$mei_distribusi+$juni_distribusi+$juli_distribusi+$agustus_distribusi+$september_distribusi+$oktober_distribusi+$november_distribusi+$desember_distribusi;
                $jumlah_distribusi_2014 = $value_distribusi->TAHUN_2014;
                $total_jumlah = $jumlah_distribusi-$jumlah_distribusi_2014;
                $persen = 0;
                if($jumlah_distribusi_2014 != 0){
                    $persen = ($total_jumlah/$jumlah_distribusi_2014)*100;
                }
    ?>
        <tr>
            <td align="right"><?php echo $no2++; ?></td>
            <td><?php echo $value_distribusi->URAIAN; ?></td>
            <td><?php echo number_format($januari_distribusi,0,',','.'); ?></td>
            <td><?php echo number_format($februari_distribusi,0,',','.'); ?></td>
            <td><?php echo number_format($maret_distribusi,0,',','.'); ?></td>
            <td><?php echo number_format($april_distribusi,0,',','.'); ?></td>
            <td><?php echo number_format($mei_distribusi,0,',','.'); ?></td>
            <td><?php echo number_format($juni_distribusi,0,',','.'); ?></td>
            <td><?php echo number_format($juli_distribusi,0,',','.'); ?></td>
            <td><?php echo number_format($agustus_distribusi,0,',','.'); ?></td>
            <td><?php echo number_format($september_distribusi,0,',','.'); ?></td>
            <td><?php echo number_format($oktober_distribusi,0,',','.'); ?></td>
            <td><?php echo number_format($november_distribusi,0,',','.'); ?></td>
            <td><?php echo number_format($desember_distribusi,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_distribusi,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_distribusi_2014,0,',','.'); ?></td>
            <td><?php echo angka_positif($total_jumlah); ?></td>
            <td><?php echo positif_persen($persen); ?></td>
        </tr>
    <?php
                $sum_jan_distribusi += $januari_distribusi;
                $sum_feb_distribusi += $februari_distribusi;
                $sum_mar_distribusi += $maret_distribusi;
                $sum_apr_distribusi += $april_distribusi;
                $sum_mei_distribusi += $mei_distribusi;
                $sum_jun_distribusi += $juni_distribusi;
                $sum_jul_distribusi += $juli_distribusi;
                $sum_agt_distribusi += $agustus_distribusi;
                $sum_sep_distribusi += $september_distribusi;
                $sum_okt_distribusi += $oktober_distribusi;
                $sum_nov_distribusi += $november_distribusi;
                $sum_des_distribusi += $desember_distribusi;
                $sum_jumlah_distribusi += $jumlah_distribusi;
                $sum_2014_distribusi += $jumlah_distribusi_2014;
                $sum_total_jumlah += $total_jumlah;
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="right"><b>Jumlah Distribusi</b></td>
            <td><?php echo number_format($sum_jan_distribusi,0,',','.')?></td>
            <td><?php echo number_format($sum_feb_distribusi,0,',','.')?></td>
            <td><?php echo number_format($sum_mar_distribusi,0,',','.')?></td>
            <td><?php echo number_format($sum_apr_distribusi,0,',','.')?></td>
            <td><?php echo number_format($sum_mei_distribusi,0,',','.')?></td>
            <td><?php echo number_format($sum_jun_distribusi,0,',','.')?></td>
            <td><?php echo number_format($sum_jul_distribusi,0,',','.')?></td>
            <td><?php echo number_format($sum_agt_distribusi,0,',','.')?></td>
            <td><?php echo number_format($sum_sep_distribusi,0,',','.')?></td>
            <td><?php echo number_format($sum_okt_distribusi,0,',','.')?></td>
            <td><?php echo number_format($sum_nov_distribusi,0,',','.')?></td>
            <td><?php echo number_format($sum_des_distribusi,0,',','.')?></td>
            <td><?php echo number_format($sum_jumlah_distribusi,0,',','.')?></td>
            <td><?php echo number_format($sum_2014_distribusi,0,',','.')?></td>
            <td><?php echo number_format($sum_total_jumlah,0,',','.')?></td>
            <td>
                <?php
                    $sum_persen = 0;
                    if($sum_2014_distribusi != 0){
                        $sum_persen = ($sum_total_jumlah/$sum_2014_distribusi)*100;
                    }
                    echo positif_persen($sum_persen);
                ?>
            </td>
        </tr>
    <!-- TANGGUNG JAWAB AIR -->
        <tr>
            <td align="left"><b>III</b></td>
            <td colspan="17"><b>AIR YANG DAPAT DIPERTANGGUNGJAWABKAN</b></td>
        </tr>
        <tr>
            <td align="right">1</td>
            <td colspan="17">Penjualan : </td>
        </tr>
    <?php
        $sum_jan_jual_air = 0;
        $sum_feb_jual_air = 0;
        $sum_mar_jual_air = 0;
        $sum_apr_jual_air = 0;
        $sum_mei_jual_air = 0;
        $sum_jun_jual_air = 0;
        $sum_jul_jual_air = 0;
        $sum_agt_jual_air = 0;
        $sum_sep_jual_air = 0;
        $sum_okt_jual_air = 0;
        $sum_nov_jual_air = 0;
        $sum_des_jual_air = 0;
        $sum_jumlah_jual_air = 0;
        $sum_2014 = 0;
        $sum_total_jumlah = 0;

        foreach ($data as $value_jual_air) {
            if($value_jual_air->JENIS == "PENJUALAN AIR"){
                $januari_jual_air = $value_jual_air->JANUARI;
                $februari_jual_air = $value_jual_air->FEBRUARI;
                $maret_jual_air = $value_jual_air->MARET;
                $april_jual_air = $value_jual_air->APRIL;
                $mei_jual_air = $value_jual_air->MEI;
                $juni_jual_air = $value_jual_air->JUNI;
                $juli_jual_air = $value_jual_air->JULI;
                $agustus_jual_air = $value_jual_air->AGUSTUS;
                $september_jual_air = $value_jual_air->SEPTEMBER;
                $oktober_jual_air = $value_jual_air->OKTOBER;
                $november_jual_air = $value_jual_air->NOVEMBER;
                $desember_jual_air = $value_jual_air->DESEMBER;
                $jumlah_jual_air = $januari_jual_air+$februari_jual_air+$maret_jual_air+$april_jual_air+$mei_jual_air+$juni_jual_air+$juli_jual_air+$agustus_jual_air+$september_jual_air+$oktober_jual_air+$november_jual_air+$desember_jual_air;
                $jumlah_jual_air_2014 = $value_jual_air->TAHUN_2014;
                $total_jumlah = $jumlah_jual_air-$jumlah_jual_air_2014;
                $persen = 0;
                if($jumlah_jual_air_2014 != 0){
                    $persen = ($total_jumlah/$jumlah_jual_air_2014)*100;
                }
    ?>
        <tr>
            <td align="right"><?php echo "-"; ?></td>
            <td><?php echo $value_jual_air->URAIAN; ?></td>
            <td><?php echo number_format($januari_jual_air,0,',','.'); ?></td>
            <td><?php echo number_format($februari_jual_air,0,',','.'); ?></td>
            <td><?php echo number_format($maret_jual_air,0,',','.'); ?></td>
            <td><?php echo number_format($april_jual_air,0,',','.'); ?></td>
            <td><?php echo number_format($mei_jual_air,0,',','.'); ?></td>
            <td><?php echo number_format($juni_jual_air,0,',','.'); ?></td>
            <td><?php echo number_format($juli_jual_air,0,',','.'); ?></td>
            <td><?php echo number_format($agustus_jual_air,0,',','.'); ?></td>
            <td><?php echo number_format($september_jual_air,0,',','.'); ?></td>
            <td><?php echo number_format($oktober_jual_air,0,',','.'); ?></td>
            <td><?php echo number_format($november_jual_air,0,',','.'); ?></td>
            <td><?php echo number_format($desember_jual_air,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_jual_air,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_jual_air_2014,0,',','.'); ?></td>
            <td><?php echo angka_positif($total_jumlah); ?></td>
            <td><?php echo positif_persen($persen); ?></td>
        </tr>
    <?php
                $sum_jan_jual_air += $januari_jual_air;
                $sum_feb_jual_air += $februari_jual_air;
                $sum_mar_jual_air += $maret_jual_air;
                $sum_apr_jual_air += $april_jual_air;
                $sum_mei_jual_air += $mei_jual_air;
                $sum_jun_jual_air += $juni_jual_air;
                $sum_jul_jual_air += $juli_jual_air;
                $sum_agt_jual_air += $agustus_jual_air;
                $sum_sep_jual_air += $september_jual_air;
                $sum_okt_jual_air += $oktober_jual_air;
                $sum_nov_jual_air += $november_jual_air;
                $sum_des_jual_air += $desember_jual_air;
                $sum_jumlah_jual_air += $jumlah_jual_air;
                $sum_2014 += $jumlah_jual_air_2014;
                $sum_total_jumlah += $total_jumlah;
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="right"><b>Jumlah Penjualan</b></td>
            <td><?php echo number_format($sum_jan_jual_air,0,',','.')?></td>
            <td><?php echo number_format($sum_feb_jual_air,0,',','.')?></td>
            <td><?php echo number_format($sum_mar_jual_air,0,',','.')?></td>
            <td><?php echo number_format($sum_apr_jual_air,0,',','.')?></td>
            <td><?php echo number_format($sum_mei_jual_air,0,',','.')?></td>
            <td><?php echo number_format($sum_jun_jual_air,0,',','.')?></td>
            <td><?php echo number_format($sum_jul_jual_air,0,',','.')?></td>
            <td><?php echo number_format($sum_agt_jual_air,0,',','.')?></td>
            <td><?php echo number_format($sum_sep_jual_air,0,',','.')?></td>
            <td><?php echo number_format($sum_okt_jual_air,0,',','.')?></td>
            <td><?php echo number_format($sum_nov_jual_air,0,',','.')?></td>
            <td><?php echo number_format($sum_des_jual_air,0,',','.')?></td>
            <td><?php echo number_format($sum_jumlah_jual_air,0,',','.')?></td>
            <td><?php echo number_format($sum_2014,0,',','.')?></td>
            <td><?php echo number_format($sum_total_jumlah,0,',','.')?></td>
            <td>
                <?php
                    $sum_persen = 0;
                    if($sum_2014 != 0){
                        $sum_persen = ($sum_total_jumlah/$sum_2014)*100;
                    }
                    echo positif_persen($sum_persen);
                ?>
            </td>
        </tr>
    <!-- PEMAKAI SENDIRI -->
        <tr>
            <td align="right">2</td>
            <td colspan="17">Pemakaian Sendiri</td>
        </tr>
    <?php
        $sum_jan_pakai_sendiri = 0;
        $sum_feb_pakai_sendiri = 0;
        $sum_mar_pakai_sendiri = 0;
        $sum_apr_pakai_sendiri = 0;
        $sum_mei_pakai_sendiri = 0;
        $sum_jun_pakai_sendiri = 0;
        $sum_jul_pakai_sendiri = 0;
        $sum_agt_pakai_sendiri = 0;
        $sum_sep_pakai_sendiri = 0;
        $sum_okt_pakai_sendiri = 0;
        $sum_nov_pakai_sendiri = 0;
        $sum_des_pakai_sendiri = 0;
        $sum_jumlah_pakai_sendiri = 0;
        $sum_2014 = 0;
        $sum_total_jumlah = 0;

        foreach ($data as $value_pakai_sendiri) {
            if($value_pakai_sendiri->JENIS == "PEMAKAIAN SENDIRI"){
                $januari_pakai_sendiri = $value_pakai_sendiri->JANUARI;
                $februari_pakai_sendiri = $value_pakai_sendiri->FEBRUARI;
                $maret_pakai_sendiri = $value_pakai_sendiri->MARET;
                $april_pakai_sendiri = $value_pakai_sendiri->APRIL;
                $mei_pakai_sendiri = $value_pakai_sendiri->MEI;
                $juni_pakai_sendiri = $value_pakai_sendiri->JUNI;
                $juli_pakai_sendiri = $value_pakai_sendiri->JULI;
                $agustus_pakai_sendiri = $value_pakai_sendiri->AGUSTUS;
                $september_pakai_sendiri = $value_pakai_sendiri->SEPTEMBER;
                $oktober_pakai_sendiri = $value_pakai_sendiri->OKTOBER;
                $november_pakai_sendiri = $value_pakai_sendiri->NOVEMBER;
                $desember_pakai_sendiri = $value_pakai_sendiri->DESEMBER;
                $jumlah_pakai_sendiri = $januari_pakai_sendiri+$februari_pakai_sendiri+$maret_pakai_sendiri+$april_pakai_sendiri+$mei_pakai_sendiri+$juni_pakai_sendiri+$juli_pakai_sendiri+$agustus_pakai_sendiri+$september_pakai_sendiri+$oktober_pakai_sendiri+$november_pakai_sendiri+$desember_pakai_sendiri;
                $jumlah_pakai_sendiri_2014 = $value_pakai_sendiri->TAHUN_2014;
                $total_jumlah = $jumlah_pakai_sendiri-$jumlah_pakai_sendiri_2014;
                $persen = 0;
                if($jumlah_pakai_sendiri_2014 != 0){
                    $persen = ($total_jumlah/$jumlah_pakai_sendiri_2014)*100;
                }
    ?>
        <tr>
            <td align="right"><?php echo "-"; ?></td>
            <td><?php echo $value_pakai_sendiri->URAIAN; ?></td>
            <td><?php echo number_format($januari_pakai_sendiri,0,',','.'); ?></td>
            <td><?php echo number_format($februari_pakai_sendiri,0,',','.'); ?></td>
            <td><?php echo number_format($maret_pakai_sendiri,0,',','.'); ?></td>
            <td><?php echo number_format($april_pakai_sendiri,0,',','.'); ?></td>
            <td><?php echo number_format($mei_pakai_sendiri,0,',','.'); ?></td>
            <td><?php echo number_format($juni_pakai_sendiri,0,',','.'); ?></td>
            <td><?php echo number_format($juli_pakai_sendiri,0,',','.'); ?></td>
            <td><?php echo number_format($agustus_pakai_sendiri,0,',','.'); ?></td>
            <td><?php echo number_format($september_pakai_sendiri,0,',','.'); ?></td>
            <td><?php echo number_format($oktober_pakai_sendiri,0,',','.'); ?></td>
            <td><?php echo number_format($november_pakai_sendiri,0,',','.'); ?></td>
            <td><?php echo number_format($desember_pakai_sendiri,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_pakai_sendiri,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_pakai_sendiri_2014,0,',','.'); ?></td>
            <td><?php echo angka_positif($total_jumlah); ?></td>
            <td><?php echo positif_persen($persen); ?></td>
        </tr>
    <?php
                $sum_jan_pakai_sendiri += $januari_pakai_sendiri;
                $sum_feb_pakai_sendiri += $februari_pakai_sendiri;
                $sum_mar_pakai_sendiri += $maret_pakai_sendiri;
                $sum_apr_pakai_sendiri += $april_pakai_sendiri;
                $sum_mei_pakai_sendiri += $mei_pakai_sendiri;
                $sum_jun_pakai_sendiri += $juni_pakai_sendiri;
                $sum_jul_pakai_sendiri += $juli_pakai_sendiri;
                $sum_agt_pakai_sendiri += $agustus_pakai_sendiri;
                $sum_sep_pakai_sendiri += $september_pakai_sendiri;
                $sum_okt_pakai_sendiri += $oktober_pakai_sendiri;
                $sum_nov_pakai_sendiri += $november_pakai_sendiri;
                $sum_des_pakai_sendiri += $desember_pakai_sendiri;
                $sum_jumlah_pakai_sendiri += $jumlah_pakai_sendiri;
                $sum_2014 += $jumlah_pakai_sendiri_2014;
                $sum_total_jumlah += $total_jumlah;
            }
        }
    ?>
    <!-- LAIN LAIN     -->
        <tr>
            <td align="right">3</td>
            <td colspan="17">Hydran Kebakaran</td>
        </tr>
    <?php
        foreach ($data as $value_lain) {
            if($value_lain->JENIS == "LAIN"){
                $januari_lain = $value_lain->JANUARI;
                $februari_lain = $value_lain->FEBRUARI;
                $maret_lain = $value_lain->MARET;
                $april_lain = $value_lain->APRIL;
                $mei_lain = $value_lain->MEI;
                $juni_lain = $value_lain->JUNI;
                $juli_lain = $value_lain->JULI;
                $agustus_lain = $value_lain->AGUSTUS;
                $september_lain = $value_lain->SEPTEMBER;
                $oktober_lain = $value_lain->OKTOBER;
                $november_lain = $value_lain->NOVEMBER;
                $desember_lain = $value_lain->DESEMBER;
                $jumlah_lain = $januari_lain+$februari_lain+$maret_lain+$april_lain+$mei_lain+$juni_lain+$juli_lain+$agustus_lain+$september_lain+$oktober_lain+$november_lain+$desember_lain;
                $jumlah_lain_2014 = $value_lain->TAHUN_2014;
                $total_jumlah = $jumlah_lain-$jumlah_lain_2014;
                $persen = 0;
                if($jumlah_lain_2014 != 0){
                    $persen = ($total_jumlah/$jumlah_lain_2014)*100;
                }
    ?>
        <tr>
            <td align="right"><?php echo "-"; ?></td>
            <td><?php echo $value_lain->URAIAN; ?></td>
            <td><?php echo number_format($januari_lain,0,',','.'); ?></td>
            <td><?php echo number_format($februari_lain,0,',','.'); ?></td>
            <td><?php echo number_format($maret_lain,0,',','.'); ?></td>
            <td><?php echo number_format($april_lain,0,',','.'); ?></td>
            <td><?php echo number_format($mei_lain,0,',','.'); ?></td>
            <td><?php echo number_format($juni_lain,0,',','.'); ?></td>
            <td><?php echo number_format($juli_lain,0,',','.'); ?></td>
            <td><?php echo number_format($agustus_lain,0,',','.'); ?></td>
            <td><?php echo number_format($september_lain,0,',','.'); ?></td>
            <td><?php echo number_format($oktober_lain,0,',','.'); ?></td>
            <td><?php echo number_format($november_lain,0,',','.'); ?></td>
            <td><?php echo number_format($desember_lain,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_lain,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_lain_2014,0,',','.'); ?></td>
            <td><?php echo angka_positif($total_jumlah); ?></td>
            <td><?php echo positif_persen($persen); ?></td>
        </tr>
    <?php
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="right"><b>Jumlah Air Yang Dapat Dipertanggungjawabkan</b></td>
            <td><?php echo number_format($sum_jan_pakai_sendiri,0,',','.')?></td>
            <td><?php echo number_format($sum_feb_pakai_sendiri,0,',','.')?></td>
            <td><?php echo number_format($sum_mar_pakai_sendiri,0,',','.')?></td>
            <td><?php echo number_format($sum_apr_pakai_sendiri,0,',','.')?></td>
            <td><?php echo number_format($sum_mei_pakai_sendiri,0,',','.')?></td>
            <td><?php echo number_format($sum_jun_pakai_sendiri,0,',','.')?></td>
            <td><?php echo number_format($sum_jul_pakai_sendiri,0,',','.')?></td>
            <td><?php echo number_format($sum_agt_pakai_sendiri,0,',','.')?></td>
            <td><?php echo number_format($sum_sep_pakai_sendiri,0,',','.')?></td>
            <td><?php echo number_format($sum_okt_pakai_sendiri,0,',','.')?></td>
            <td><?php echo number_format($sum_nov_pakai_sendiri,0,',','.')?></td>
            <td><?php echo number_format($sum_des_pakai_sendiri,0,',','.')?></td>
            <td><?php echo number_format($sum_jumlah_pakai_sendiri,0,',','.')?></td>
            <td><?php echo number_format($sum_2014,0,',','.')?></td>
            <td><?php echo number_format($sum_total_jumlah,0,',','.')?></td>
            <td>
                <?php
                    $sum_persen = 0;
                    if($sum_2014 != 0){
                        $sum_persen = ($sum_total_jumlah/$sum_2014)*100;
                    }
                    echo positif_persen($sum_persen);
                ?>
            </td>
        </tr>
        <tr>
            <td align="left"><b>IV</b></td>
            <td colspan="17"><b>AIR YG TDK DPT DIPERTANGGUNGJAWABKAN</b></td>
        </tr>
    <?php
        $sum_jan_hilang_air = 0;
        $sum_feb_hilang_air = 0;
        $sum_mar_hilang_air = 0;
        $sum_apr_hilang_air = 0;
        $sum_mei_hilang_air = 0;
        $sum_jun_hilang_air = 0;
        $sum_jul_hilang_air = 0;
        $sum_agt_hilang_air = 0;
        $sum_sep_hilang_air = 0;
        $sum_okt_hilang_air = 0;
        $sum_nov_hilang_air = 0;
        $sum_des_hilang_air = 0;
        $sum_jumlah_hilang_air = 0;
        $sum_2014_hilang_air = 0;
        $sum_total_jumlah = 0;

        foreach ($data as $value_hilang_air) {
           if($value_hilang_air->JENIS == "AIR TIDAK DIPERTANGGUNGJAWABKAN"){
                $januari_hilang_air = $value_hilang_air->JANUARI;
                $februari_hilang_air = $value_hilang_air->FEBRUARI;
                $maret_hilang_air = $value_hilang_air->MARET;
                $april_hilang_air = $value_hilang_air->APRIL;
                $mei_hilang_air = $value_hilang_air->MEI;
                $juni_hilang_air = $value_hilang_air->JUNI;
                $juli_hilang_air = $value_hilang_air->JULI;
                $agustus_hilang_air = $value_hilang_air->AGUSTUS;
                $september_hilang_air = $value_hilang_air->SEPTEMBER;
                $oktober_hilang_air = $value_hilang_air->OKTOBER;
                $november_hilang_air = $value_hilang_air->NOVEMBER;
                $desember_hilang_air = $value_hilang_air->DESEMBER;
                $jumlah_hilang_air = $januari_hilang_air+$februari_hilang_air+$maret_hilang_air+$april_hilang_air+$mei_hilang_air+$juni_hilang_air+$juli_hilang_air+$agustus_hilang_air+$september_hilang_air+$oktober_hilang_air+$november_hilang_air+$desember_hilang_air;
                $jumlah_hilang_air_2014 = $value_hilang_air->TAHUN_2014;
                $total_jumlah = $jumlah_hilang_air-$jumlah_hilang_air_2014;
                $persen = 0;
                if($jumlah_hilang_air_2014 != 0){
                    $persen = ($total_jumlah/$jumlah_hilang_air_2014)*100;
                }
    ?>
        <tr>
            <td align="right"><?php echo "-"; ?></td>
            <td>Kehilangan Air</td>
            <td><?php echo number_format($januari_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($februari_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($maret_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($april_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($mei_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($juni_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($juli_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($agustus_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($september_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($oktober_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($november_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($desember_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($jumlah_hilang_air_2014,0,',','.'); ?></td>
            <td><?php echo angka_positif($total_jumlah); ?></td>
            <td><?php echo positif_persen($persen); ?></td>
        </tr>
    <?php
                $sum_jan_hilang_air += $januari_hilang_air;
                $sum_feb_hilang_air += $februari_hilang_air;
                $sum_mar_hilang_air += $maret_hilang_air;
                $sum_apr_hilang_air += $april_hilang_air;
                $sum_mei_hilang_air += $mei_hilang_air;
                $sum_jun_hilang_air += $juni_hilang_air;
                $sum_jul_hilang_air += $juli_hilang_air;
                $sum_agt_hilang_air += $agustus_hilang_air;
                $sum_sep_hilang_air += $september_hilang_air;
                $sum_okt_hilang_air += $oktober_hilang_air;
                $sum_nov_hilang_air += $november_hilang_air;
                $sum_des_hilang_air += $desember_hilang_air;
                $sum_jumlah_hilang_air += $jumlah_hilang_air;
                $sum_2014_hilang_air += $jumlah_hilang_air_2014;
                $sum_total_jumlah += $total_jumlah;
           }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="right"><b>Jumlah Air yg Tdk Dapat Dipertanggungjawabkan</b></td>
            <td><?php echo number_format($sum_jan_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($sum_feb_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($sum_mar_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($sum_apr_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($sum_mei_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($sum_jun_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($sum_jul_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($sum_agt_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($sum_sep_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($sum_okt_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($sum_nov_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($sum_des_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($sum_jumlah_hilang_air,0,',','.'); ?></td>
            <td><?php echo number_format($sum_2014_hilang_air,0,',','.'); ?></td>
            <td><?php echo angka_positif($sum_total_jumlah); ?></td>
            <td>
                <?php
                    $sum_persen = 0;
                    if($sum_2014_hilang_air != 0){
                        $sum_persen = ($sum_total_jumlah/$sum_2014_hilang_air)*100;
                    }
                    echo positif_persen($sum_persen);
                ?>
            </td>
        </tr>
        <?php
            $sum_jan_hilang_air_prosen = ($sum_jan_hilang_air/$sum_jan_distribusi)*100;
            $sum_feb_hilang_air_prosen = ($sum_feb_hilang_air/$sum_feb_distribusi)*100;
            $sum_mar_hilang_air_prosen = ($sum_mar_hilang_air/$sum_mar_distribusi)*100;
            $sum_apr_hilang_air_prosen = ($sum_apr_hilang_air/$sum_apr_distribusi)*100;
            $sum_mei_hilang_air_prosen = ($sum_mei_hilang_air/$sum_mei_distribusi)*100;
            $sum_jun_hilang_air_prosen = ($sum_jun_hilang_air/$sum_jun_distribusi)*100;
            $sum_jul_hilang_air_prosen = ($sum_jul_hilang_air/$sum_jul_distribusi)*100;
            $sum_agt_hilang_air_prosen = ($sum_agt_hilang_air/$sum_agt_distribusi)*100;
            $sum_sep_hilang_air_prosen = ($sum_sep_hilang_air/$sum_sep_distribusi)*100;
            $sum_okt_hilang_air_prosen = ($sum_okt_hilang_air/$sum_okt_distribusi)*100;
            $sum_nov_hilang_air_prosen = ($sum_nov_hilang_air/$sum_nov_distribusi)*100;
            $sum_des_hilang_air_prosen = ($sum_des_hilang_air/$sum_des_distribusi)*100;
            $sum_jumlah_hilang_air_prosen = ($sum_jumlah_hilang_air/$sum_jumlah_distribusi)*100;
            $sum_2014_hilang_air_prosen = ($sum_2014_hilang_air/$sum_2014_distribusi)*100;
            $sum_total_jumlah_hilang_air_prosen = $sum_jumlah_hilang_air_prosen-$sum_2014_hilang_air_prosen;
        ?>
        <tr>
            <td>&nbsp;</td>
            <td align="right"><b>Kehilangan Air dalam Prosen (%)</b></td>
            <td><?php echo positif_persen($sum_jan_hilang_air_prosen); ?></td>
            <td><?php echo positif_persen($sum_feb_hilang_air_prosen); ?></td>
            <td><?php echo positif_persen($sum_mar_hilang_air_prosen); ?></td>
            <td><?php echo positif_persen($sum_apr_hilang_air_prosen); ?></td>
            <td><?php echo positif_persen($sum_mei_hilang_air_prosen); ?></td>
            <td><?php echo positif_persen($sum_jun_hilang_air_prosen); ?></td>
            <td><?php echo positif_persen($sum_jul_hilang_air_prosen); ?></td>
            <td><?php echo positif_persen($sum_agt_hilang_air_prosen); ?></td>
            <td><?php echo positif_persen($sum_sep_hilang_air_prosen); ?></td>
            <td><?php echo positif_persen($sum_okt_hilang_air_prosen); ?></td>
            <td><?php echo positif_persen($sum_nov_hilang_air_prosen); ?></td>
            <td><?php echo positif_persen($sum_des_hilang_air_prosen); ?></td>
            <td><?php echo positif_persen($sum_jumlah_hilang_air_prosen); ?></td>
            <td><?php echo positif_persen($sum_2014_hilang_air_prosen); ?></td>
            <td><?php echo positif_persen($sum_total_jumlah_hilang_air_prosen); ?></td>
            <td>
                <?php
                    $sum_persen = 0;
                    if($sum_2014_hilang_air_prosen != 0){
                        $sum_persen = ($sum_total_jumlah_hilang_air_prosen/$sum_2014_hilang_air_prosen)*100;
                    }
                    echo positif_persen($sum_persen);
                ?>
            </td>
        </tr>
    </tbody>
</table>
<?PHP
    // require_once "localhost/siaga/material/fpdf/html2pdf.class.php";
    
    $content = ob_get_clean();
    $width_in_inches = 19.39;
    $height_in_inches = 11.70;
    $width_in_mm = $width_in_inches * 25.4;
    $height_in_mm = $height_in_inches * 25.4;
    $html2pdf = new HTML2PDF('L',array($width_in_mm,$height_in_mm),'en');
    $html2pdf->pdf->SetTitle("Rencana Perkembangan Sambungan Pelanggan $tahun");
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('laporan_sambungan_pelanggan_$tahun.pdf');
?>