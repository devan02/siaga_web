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
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="400" height="90" alt="KOP PDAM"></td>
        <td>
            <img src="<?=base_url();?>files/pdam/KOP_tulisan.png" width="550" height="90" alt="KOP PDAM">
        </td>
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="400" height="90" alt="KOP PDAM"></td>
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
        <tr>
            <td>88.01.00</td>
            <td colspan="17"><b>PENDAPATAN LAIN - LAIN</b></td>
        </tr>
    <?php
        $sum_jan_lain = 0;
        $sum_feb_lain = 0;
        $sum_mar_lain = 0;
        $sum_apr_lain = 0;
        $sum_mei_lain = 0;
        $sum_jun_lain = 0;
        $sum_jul_lain = 0;
        $sum_agt_lain = 0;
        $sum_sep_lain = 0;
        $sum_okt_lain = 0;
        $sum_nov_lain = 0;
        $sum_des_lain = 0;
        $sum_jumlah_lain = 0;
        $sum_estimasi_2014_lain = 0;

        foreach ($data as $value_lain) {
            if($value_lain->JENIS == "PENDAPATAN LAIN - LAIN"){
                $jan_lain = $value_lain->JANUARI;
                $feb_lain = $value_lain->FEBRUARI;
                $mar_lain = $value_lain->MARET;
                $apr_lain = $value_lain->APRIL;
                $mei_lain = $value_lain->MEI;
                $jun_lain = $value_lain->JUNI;
                $jul_lain = $value_lain->JULI;
                $agt_lain = $value_lain->AGUSTUS;
                $sep_lain = $value_lain->SEPTEMBER;
                $okt_lain = $value_lain->OKTOBER;
                $nov_lain = $value_lain->NOVEMBER;
                $des_lain = $value_lain->DESEMBER;
                $jumlah_lain = $jan_lain+$feb_lain+$mar_lain+$apr_lain+$mei_lain+$jun_lain+$jul_lain+$agt_lain+$sep_lain+$okt_lain+$nov_lain+$des_lain;
                $estimasi_2014_lain = $value_lain->ESTIMASI_TAHUN_2014;
    ?>
        <tr>
            <td align="center"><?php echo $value_lain->KODE_PERKIRAAN; ?></td>
            <td><?php echo $value_lain->NAMA_PERKIRAAN; ?></td>
            <td><?php echo number_format($jan_lain,0,',','.')?></td>
            <td><?php echo number_format($feb_lain,0,',','.')?></td>
            <td><?php echo number_format($mar_lain,0,',','.')?></td>
            <td><?php echo number_format($apr_lain,0,',','.')?></td>
            <td><?php echo number_format($mei_lain,0,',','.')?></td>
            <td><?php echo number_format($jun_lain,0,',','.')?></td>
            <td><?php echo number_format($jul_lain,0,',','.')?></td>
            <td><?php echo number_format($agt_lain,0,',','.')?></td>
            <td><?php echo number_format($sep_lain,0,',','.')?></td>
            <td><?php echo number_format($okt_lain,0,',','.')?></td>
            <td><?php echo number_format($nov_lain,0,',','.')?></td>
            <td><?php echo number_format($des_lain,0,',','.')?></td>
            <td><?php echo number_format($jumlah_lain,0,',','.')?></td>
            <td><?php echo number_format($estimasi_2014_lain,0,',','.')?></td>
            <td>
                <?php
                    $total_lain = $jumlah_lain-$estimasi_2014_lain;
                    echo angka_positif($total_lain);
                ?>
            </td>
            <td>
                <?php
                    $persen_lain = 0;
                    if($estimasi_2014_lain != 0){
                        $persen_lain = ($total_lain/$estimasi_2014_lain)*100;
                    }
                    echo positif_persen($persen_lain);
                ?>
            </td>
        </tr>
    <?php
                $sum_jan_lain += $jan_lain;
                $sum_feb_lain += $feb_lain;
                $sum_mar_lain += $mar_lain;
                $sum_apr_lain += $apr_lain;
                $sum_mei_lain += $mei_lain;
                $sum_jun_lain += $jun_lain;
                $sum_jul_lain += $jul_lain;
                $sum_agt_lain += $agt_lain;
                $sum_sep_lain += $sep_lain;
                $sum_okt_lain += $okt_lain;
                $sum_nov_lain += $nov_lain;
                $sum_des_lain += $des_lain;
                $sum_jumlah_lain += $jumlah_lain;
                $sum_estimasi_2014_lain += $value_lain->ESTIMASI_TAHUN_2014;
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="center"><b>Jumlah Pendapatan Diluar Usaha</b></td>
            <td><?php echo number_format($sum_jan_lain,0,',','.')?></td>
            <td><?php echo number_format($sum_feb_lain,0,',','.')?></td>
            <td><?php echo number_format($sum_mar_lain,0,',','.')?></td>
            <td><?php echo number_format($sum_apr_lain,0,',','.')?></td>
            <td><?php echo number_format($sum_mei_lain,0,',','.')?></td>
            <td><?php echo number_format($sum_jun_lain,0,',','.')?></td>
            <td><?php echo number_format($sum_jul_lain,0,',','.')?></td>
            <td><?php echo number_format($sum_agt_lain,0,',','.')?></td>
            <td><?php echo number_format($sum_sep_lain,0,',','.')?></td>
            <td><?php echo number_format($sum_okt_lain,0,',','.')?></td>
            <td><?php echo number_format($sum_nov_lain,0,',','.')?></td>
            <td><?php echo number_format($sum_des_lain,0,',','.')?></td>
            <td><?php echo number_format($sum_jumlah_lain,0,',','.')?></td>
            <td><?php echo number_format($sum_estimasi_2014_lain,0,',','.')?></td>
            <td>
                <?php
                    $total_jumlah_lain = $sum_jumlah_lain-$sum_estimasi_2014_lain;
                    echo angka_positif($total_jumlah_lain);
                ?>
            </td>
            <td>
                <?php
                    $sum_persen_lain = 0;
                    if($sum_estimasi_2014_lain != 0){
                        $sum_persen_lain = ($total_jumlah_lain/$sum_estimasi_2014_lain)*100;
                    }
                    echo positif_persen($sum_persen_lain);
                ?>
            </td>
        </tr>
    <!-- LUAR BIASA -->
        <tr>
            <td>89.00.00</td>
            <td colspan="17"><b>KEUNTUNGAN LUAR BIASA</b></td>
        </tr>
    <?php
        $sum_jan_luar_biasa = 0;
        $sum_feb_luar_biasa = 0;
        $sum_mar_luar_biasa = 0;
        $sum_apr_luar_biasa = 0;
        $sum_mei_luar_biasa = 0;
        $sum_jun_luar_biasa = 0;
        $sum_jul_luar_biasa = 0;
        $sum_agt_luar_biasa = 0;
        $sum_sep_luar_biasa = 0;
        $sum_okt_luar_biasa = 0;
        $sum_nov_luar_biasa = 0;
        $sum_des_luar_biasa = 0;
        $sum_jumlah_luar_biasa = 0;
        $sum_estimasi_2014_luar_biasa = 0;

        foreach ($data as $value_luar_biasa) {
            if($value_luar_biasa->JENIS == "KEUNTUNGAN LUAR BIASA"){
                $jan_luar_biasa = $value_luar_biasa->JANUARI;
                $feb_luar_biasa = $value_luar_biasa->FEBRUARI;
                $mar_luar_biasa = $value_luar_biasa->MARET;
                $apr_luar_biasa = $value_luar_biasa->APRIL;
                $mei_luar_biasa = $value_luar_biasa->MEI;
                $jun_luar_biasa = $value_luar_biasa->JUNI;
                $jul_luar_biasa = $value_luar_biasa->JULI;
                $agt_luar_biasa = $value_luar_biasa->AGUSTUS;
                $sep_luar_biasa = $value_luar_biasa->SEPTEMBER;
                $okt_luar_biasa = $value_luar_biasa->OKTOBER;
                $nov_luar_biasa = $value_luar_biasa->NOVEMBER;
                $des_luar_biasa = $value_luar_biasa->DESEMBER;
                $jumlah_luar_biasa = $jan_luar_biasa+$feb_luar_biasa+$mar_luar_biasa+$apr_luar_biasa+$mei_luar_biasa+$jun_luar_biasa+$jul_luar_biasa+$agt_luar_biasa+$sep_luar_biasa+$okt_luar_biasa+$nov_luar_biasa+$des_luar_biasa;
                $estimasi_2014_luar_biasa = $value_luar_biasa->ESTIMASI_TAHUN_2014;
    ?>
        <tr>
            <td align="center"><?php echo $value_luar_biasa->KODE_PERKIRAAN; ?></td>
            <td><?php echo $value_luar_biasa->NAMA_PERKIRAAN; ?></td>
            <td><?php echo number_format($jan_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($feb_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($mar_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($apr_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($mei_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($jun_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($jul_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($agt_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($sep_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($okt_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($nov_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($des_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($jumlah_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($estimasi_2014_luar_biasa,0,',','.')?></td>
            <td>
                <?php
                    $total_luar_biasa = $jumlah_luar_biasa-$estimasi_2014_luar_biasa;
                    echo angka_positif($total_luar_biasa);
                ?>
            </td>
            <td>
                <?php
                    $persen_luar_biasa = 0;
                    if($estimasi_2014_luar_biasa != 0){
                        $persen_luar_biasa = ($total_luar_biasa/$estimasi_2014_luar_biasa)*100;
                    }
                    echo positif_persen($persen_luar_biasa);
                ?>
            </td>
        </tr>
    <?php
                $sum_jan_luar_biasa += $jan_luar_biasa;
                $sum_feb_luar_biasa += $feb_luar_biasa;
                $sum_mar_luar_biasa += $mar_luar_biasa;
                $sum_apr_luar_biasa += $apr_luar_biasa;
                $sum_mei_luar_biasa += $mei_luar_biasa;
                $sum_jun_luar_biasa += $jun_luar_biasa;
                $sum_jul_luar_biasa += $jul_luar_biasa;
                $sum_agt_luar_biasa += $agt_luar_biasa;
                $sum_sep_luar_biasa += $sep_luar_biasa;
                $sum_okt_luar_biasa += $okt_luar_biasa;
                $sum_nov_luar_biasa += $nov_luar_biasa;
                $sum_des_luar_biasa += $des_luar_biasa;
                $sum_jumlah_luar_biasa += $jumlah_luar_biasa;
                $sum_estimasi_2014_luar_biasa += $value_luar_biasa->ESTIMASI_TAHUN_2014;
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="center"><b>Jumlah Keuntungan Luar Biasa</b></td>
            <td><?php echo number_format($sum_jan_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($sum_feb_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($sum_mar_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($sum_apr_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($sum_mei_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($sum_jun_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($sum_jul_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($sum_agt_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($sum_sep_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($sum_okt_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($sum_nov_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($sum_des_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($sum_jumlah_luar_biasa,0,',','.')?></td>
            <td><?php echo number_format($sum_estimasi_2014_luar_biasa,0,',','.')?></td>
            <td>
                <?php
                    $total_jumlah_luar_biasa = $sum_jumlah_luar_biasa-$sum_estimasi_2014_luar_biasa;
                    echo angka_positif($total_jumlah_luar_biasa);
                ?>
            </td>
            <td>
                <?php
                    $sum_persen_luar_biasa = 0;
                    if($sum_estimasi_2014_luar_biasa != 0){
                        $sum_persen_luar_biasa = ($total_jumlah_luar_biasa/$sum_estimasi_2014_luar_biasa)*100;
                    }
                    echo positif_persen($sum_persen_luar_biasa);
                ?>
            </td>
        </tr>
    </tbody>
</table>

<?PHP
    // require_once "localhost/siaga/material/fpdf/html2pdf.class.php";
    
    $content = ob_get_clean();
    $width_in_inches = 18.4;
    $height_in_inches = 13.5;
    $width_in_mm = $width_in_inches * 25.4;
    $height_in_mm = $height_in_inches * 25.4;
    $html2pdf = new HTML2PDF('L',array($width_in_mm,$height_in_mm),'en');
    // $html2pdf = new HTML2PDF('L','A2','fr');
    $html2pdf->pdf->SetTitle("Rencana Perkembangan Sambungan Pelanggan $tahun");
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('laporan_sambungan_pelanggan_$tahun.pdf');
?>