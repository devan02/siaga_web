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
?>

<table align="center">
    <tr>
        <td>
            <img src="<?=base_url();?>files/pdam/logo-pdamtp.png" width="70" height="70" alt="KOP PDAM">
        </td>
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="570" height="90" alt="KOP PDAM"></td>
        <td>
            <img src="<?=base_url();?>files/pdam/KOP_tulisan.png" width="350" height="70" alt="KOP PDAM">
        </td>
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="570" height="90" alt="KOP PDAM"></td>
        <td>
            <img src="<?=base_url();?>files/pdam/logo_perpamsi_glossy.png" width="100" height="70" alt="KOP PDAM">
        </td>
    </tr>
</table>

<hr>

<table align="center" width="100%">
    <tr>
        <td style="text-align:center;" width="80%">
            <h3>
                <?php echo $title; ?> <br>
                TAHUN ANGGARAN : <?php echo $thn;?>
            </h3>
        </td>
    </tr>
</table>

<br>

<table class="grid">
    <thead>
        <tr>
            <th rowspan="2" style="width:50px;">NO</th>
            <th rowspan="2">URAIAN</th>
            <th colspan="12">BULAN</th>
            <th rowspan="2">JUMLAH</th>
        </tr>
        <tr>
            <th>Januari</th>
            <th>Februari</th>
            <th>Maret</th>
            <th>April</th>
            <th>Mei</th>
            <th>Juni</th>
            <th>Juli</th>
            <th>Agustus</th>
            <th>September</th>
            <th>Oktober</th>
            <th>November</th>
            <th>Desember</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td align="center">I</td>
            <td colspan="14" align="left"><b>PROYEKSI PENERIMAAN KAS</b></td>
        </tr>
        <tr>
            <td align="center">1.</td>
            <td colspan="14" align="left"><b>Penerimaan Operasi</b></td>
        </tr>
        <?php
            $no = 0;
            $tot_jan = 0;
            $tot_feb = 0;
            $tot_mar = 0;
            $tot_apr = 0;
            $tot_mei = 0;
            $tot_jun = 0;
            $tot_jul = 0;
            $tot_agt = 0;
            $tot_sep = 0;
            $tot_okt = 0;
            $tot_nov = 0;
            $tot_des = 0;
            $tot_jumlah = 0;

            foreach ($arus as $data_detil) {
                if($data_detil->JENIS == "Penerimaan Operasi"){
                    $jan = $data_detil->JANUARI;
                    $feb = $data_detil->FEBRUARI;
                    $mar = $data_detil->MARET;
                    $apr = $data_detil->APRIL;
                    $mei = $data_detil->MEI;
                    $jun = $data_detil->JUNI;
                    $jul = $data_detil->JULI;
                    $agt = $data_detil->AGUSTUS;
                    $sep = $data_detil->SEPTEMBER;
                    $okt = $data_detil->OKTOBER;
                    $nov = $data_detil->NOVEMBER;
                    $des = $data_detil->DESEMBER;
                    $jumlah = $data_detil->JUMLAH;
        ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $data_detil->URAIAN; ?></td>
            <td align="right"><?php echo number_format($jan,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($feb,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($mar,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($apr,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($mei,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($jun,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($jul,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($agt,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($sep,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($okt,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($nov,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($des,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($jumlah,0,',','.'); ?></td>
        </tr>
        <?php
                $tot_jan += $jan;
                $tot_feb += $feb;
                $tot_mar += $mar;
                $tot_apr += $apr;
                $tot_mei += $mei;
                $tot_jun += $jun;
                $tot_jul += $jul;
                $tot_agt += $agt;
                $tot_sep += $sep;
                $tot_okt += $okt;
                $tot_nov += $nov;
                $tot_des += $des;
                $tot_jumlah += $jumlah;
                }
            }
        ?>
        <tr>
            <td></td>
            <td align="right">Jumlah Penerimaan Operasi</td>
            <td align="right"><?php echo number_format($tot_jan,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_feb,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_mar,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_apr,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_mei,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_jun,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_jul,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_agt,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_sep,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_okt,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_nov,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_des,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_jumlah,0,',','.'); ?></td>
        </tr>
        <tr>
            <td align="center">2.</td>
            <td colspan="14" align="left"><b>Penerimaan Non Operasi</b></td>
        </tr>
        <?php
            $tot_jan2 = 0;
            $tot_feb2 = 0;
            $tot_mar2 = 0;
            $tot_apr2 = 0;
            $tot_mei2 = 0;
            $tot_jun2 = 0;
            $tot_jul2 = 0;
            $tot_agt2 = 0;
            $tot_sep2 = 0;
            $tot_okt2 = 0;
            $tot_nov2 = 0;
            $tot_des2 = 0;
            $tot_jumlah2 = 0;

            foreach ($arus as $data_detil) {
                if($data_detil->JENIS == "Penerimaan Non Operasi"){
                    $jan = $data_detil->JANUARI;
                    $feb = $data_detil->FEBRUARI;
                    $mar = $data_detil->MARET;
                    $apr = $data_detil->APRIL;
                    $mei = $data_detil->MEI;
                    $jun = $data_detil->JUNI;
                    $jul = $data_detil->JULI;
                    $agt = $data_detil->AGUSTUS;
                    $sep = $data_detil->SEPTEMBER;
                    $okt = $data_detil->OKTOBER;
                    $nov = $data_detil->NOVEMBER;
                    $des = $data_detil->DESEMBER;
                    $jumlah = $data_detil->JUMLAH;
        ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $data_detil->URAIAN; ?></td>
            <td align="right"><?php echo number_format($jan,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($feb,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($mar,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($apr,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($mei,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($jun,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($jul,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($agt,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($sep,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($okt,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($nov,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($des,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($jumlah,0,',','.'); ?></td>
        </tr>
        <?php
                $tot_jan2 += $jan;
                $tot_feb2 += $feb;
                $tot_mar2 += $mar;
                $tot_apr2 += $apr;
                $tot_mei2 += $mei;
                $tot_jun2 += $jun;
                $tot_jul2 += $jul;
                $tot_agt2 += $agt;
                $tot_sep2 += $sep;
                $tot_okt2 += $okt;
                $tot_nov2 += $nov;
                $tot_des2 += $des;
                $tot_jumlah2 += $jumlah;
                }
            }
        ?>
        <tr>
            <td></td>
            <td align="right">Jumlah Penerimaan Non Operasi</td>
            <td align="right"><?php echo number_format($tot_jan2,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_feb2,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_mar2,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_apr2,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_mei2,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_jun2,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_jul2,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_agt2,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_sep2,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_okt2,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_nov2,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_des2,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($tot_jumlah2,0,',','.'); ?></td>
        </tr>
        <?php
            $jum_jan_terima = $tot_jan + $tot_jan2;
            $jum_feb_terima = $tot_feb + $tot_feb2;
            $jum_mar_terima = $tot_mar + $tot_mar2;
            $jum_apr_terima = $tot_apr + $tot_apr2;
            $jum_mei_terima = $tot_mei + $tot_mei2;
            $jum_jun_terima = $tot_jun + $tot_jun2;
            $jum_jul_terima = $tot_jul + $tot_jul2;
            $jum_agt_terima = $tot_agt + $tot_agt2;
            $jum_sep_terima = $tot_sep + $tot_sep2;
            $jum_okt_terima = $tot_okt + $tot_okt2;
            $jum_nov_terima = $tot_nov + $tot_nov2;
            $jum_des_terima = $tot_des + $tot_des2;
            $jum_jumlah_terima = $tot_jumlah + $tot_jumlah2;
        ?>
        <tr>
            <td></td>
            <td align="center">Jumlah Penerimaan Kas</td>
            <td align="right"><?php echo number_format($jum_jan_terima,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($jum_feb_terima,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($jum_mar_terima,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($jum_apr_terima,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($jum_mei_terima,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($jum_jun_terima,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($jum_jul_terima,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($jum_agt_terima,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($jum_sep_terima,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($jum_okt_terima,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($jum_nov_terima,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($jum_des_terima,0,',','.'); ?></td>
            <td align="right"><?php echo number_format($jum_jumlah_terima,0,',','.'); ?></td>
        </tr>
        <tr>
            <td align="center">II</td>
            <td colspan="14" align="left"><b>PROYEKSI PENGELUARAN KAS</b></td>
        </tr>
        <tr>
            <td align="center">1.</td>
            <td colspan="14" align="left"><b>Pengeluaran Operasi</b></td>
        </tr>
        <?php
            $tot_luar_jan = 0;
            $tot_luar_feb = 0;
            $tot_luar_mar = 0;
            $tot_luar_apr = 0;
            $tot_luar_mei = 0;
            $tot_luar_jun = 0;
            $tot_luar_jul = 0;
            $tot_luar_agt = 0;
            $tot_luar_sep = 0;
            $tot_luar_okt = 0;
            $tot_luar_nov = 0;
            $tot_luar_des = 0;
            $tot_luar_jumlah = 0;
            foreach ($arus as $data_detil) {
                if($data_detil->JENIS == "Pengeluaran Operasi"){
                    $jan = $data_detil->JANUARI;
                    $feb = $data_detil->FEBRUARI;
                    $mar = $data_detil->MARET;
                    $apr = $data_detil->APRIL;
                    $mei = $data_detil->MEI;
                    $jun = $data_detil->JUNI;
                    $jul = $data_detil->JULI;
                    $agt = $data_detil->AGUSTUS;
                    $sep = $data_detil->SEPTEMBER;
                    $okt = $data_detil->OKTOBER;
                    $nov = $data_detil->NOVEMBER;
                    $des = $data_detil->DESEMBER;
                    $jumlah = $data_detil->JUMLAH;
        ?>
            <tr>
                <td>&nbsp;</td>
                <td><?php echo $data_detil->URAIAN; ?></td>
                <td align="right"><?php echo number_format($jan,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($feb,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($mar,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($apr,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($mei,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jun,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jul,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($agt,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($sep,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($okt,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($nov,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($des,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jumlah,0,',','.'); ?></td>
            </tr>
        <?php
                    $tot_luar_jan += $jan;
                    $tot_luar_feb += $feb;
                    $tot_luar_mar += $mar;
                    $tot_luar_apr += $apr;
                    $tot_luar_mei += $mei;
                    $tot_luar_jun += $jun;
                    $tot_luar_jul += $jul;
                    $tot_luar_agt += $agt;
                    $tot_luar_sep += $sep;
                    $tot_luar_okt += $okt;
                    $tot_luar_nov += $nov;
                    $tot_luar_des += $des;
                    $tot_luar_jumlah += $jumlah;
                }
            }
        ?>
            <tr>
                <td>&nbsp;</td>
                <td align="right">Jumlah Pengeluaran Operasi</td>
                <td align="right"><?php echo number_format($tot_luar_jan,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_feb,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_mar,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_apr,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_mei,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_jun,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_jul,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_agt,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_sep,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_okt,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_nov,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_des,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_jumlah,0,',','.'); ?></td>
            </tr>
            <tr>
                <td align="center">2.</td>
                <td colspan="14" align="left"><b>Pengeluaran Non Operasi</b></td>
            </tr>
        <?php
            $tot_luar_jan2 = 0;
            $tot_luar_feb2 = 0;
            $tot_luar_mar2 = 0;
            $tot_luar_apr2 = 0;
            $tot_luar_mei2 = 0;
            $tot_luar_jun2 = 0;
            $tot_luar_jul2 = 0;
            $tot_luar_agt2 = 0;
            $tot_luar_sep2 = 0;
            $tot_luar_okt2 = 0;
            $tot_luar_nov2 = 0;
            $tot_luar_des2 = 0;
            $tot_luar_jumlah2 = 0;
            foreach ($arus as $data_detil) {
                if($data_detil->JENIS == "Pengeluaran Non Operasi"){
                    $jan = $data_detil->JANUARI;
                    $feb = $data_detil->FEBRUARI;
                    $mar = $data_detil->MARET;
                    $apr = $data_detil->APRIL;
                    $mei = $data_detil->MEI;
                    $jun = $data_detil->JUNI;
                    $jul = $data_detil->JULI;
                    $agt = $data_detil->AGUSTUS;
                    $sep = $data_detil->SEPTEMBER;
                    $okt = $data_detil->OKTOBER;
                    $nov = $data_detil->NOVEMBER;
                    $des = $data_detil->DESEMBER;
                    $jumlah = $data_detil->JUMLAH;
        ?>
            <tr>
                <td>&nbsp;</td>
                <td><?php echo $data_detil->URAIAN; ?></td>
                <td align="right"><?php echo number_format($jan,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($feb,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($mar,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($apr,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($mei,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jun,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jul,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($agt,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($sep,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($okt,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($nov,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($des,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jumlah,0,',','.'); ?></td>
            </tr>
        <?php
                    $tot_luar_jan2 += $jan;
                    $tot_luar_feb2 += $feb;
                    $tot_luar_mar2 += $mar;
                    $tot_luar_apr2 += $apr;
                    $tot_luar_mei2 += $mei;
                    $tot_luar_jun2 += $jun;
                    $tot_luar_jul2 += $jul;
                    $tot_luar_agt2 += $agt;
                    $tot_luar_sep2 += $sep;
                    $tot_luar_okt2 += $okt;
                    $tot_luar_nov2 += $nov;
                    $tot_luar_des2 += $des;
                    $tot_luar_jumlah2 += $jumlah;
                }
            }
        ?>
            <tr>
                <td>&nbsp;</td>
                <td>Jumlah Pengeluaran Non Operasi</td>
                <td align="right"><?php echo number_format($tot_luar_jan2,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_feb2,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_mar2,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_apr2,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_mei2,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_jun2,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_jul2,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_agt2,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_sep2,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_okt2,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_nov2,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_des2,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($tot_luar_jumlah2,0,',','.'); ?></td>
            </tr>
            <?php
                $jum_jan_luar = $tot_luar_jan + $tot_luar_jan2;
                $jum_feb_luar = $tot_luar_feb + $tot_luar_feb2;
                $jum_mar_luar = $tot_luar_mar + $tot_luar_mar2;
                $jum_apr_luar = $tot_luar_apr + $tot_luar_apr2;
                $jum_mei_luar = $tot_luar_mei + $tot_luar_mei2;
                $jum_jun_luar = $tot_luar_jun + $tot_luar_jun2;
                $jum_jul_luar = $tot_luar_jul + $tot_luar_jul2;
                $jum_agt_luar = $tot_luar_agt + $tot_luar_agt2;
                $jum_sep_luar = $tot_luar_sep + $tot_luar_sep2;
                $jum_okt_luar = $tot_luar_okt + $tot_luar_okt2;
                $jum_nov_luar = $tot_luar_nov + $tot_luar_nov2;
                $jum_des_luar = $tot_luar_des + $tot_luar_des2;
                $jum_jumlah_luar = $tot_luar_jumlah + $tot_luar_jumlah2;
            ?>
            <tr>
                <td>&nbsp;</td>
                <td align="center">Jumlah Pengeluaran Kas</td>
                <td align="right"><?php echo number_format($jum_jan_luar,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jum_feb_luar,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jum_mar_luar,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jum_apr_luar,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jum_mei_luar,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jum_jun_luar,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jum_jul_luar,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jum_agt_luar,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jum_sep_luar,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jum_okt_luar,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jum_nov_luar,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jum_des_luar,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jum_jumlah_luar,0,',','.'); ?></td>
            </tr>
            <?php
                $hasil_jan = $jum_jan_terima - $jum_jan_luar;
                $hasil_feb = $jum_feb_terima - $jum_feb_luar;
                $hasil_mar = $jum_mar_terima - $jum_mar_luar;
                $hasil_apr = $jum_apr_terima - $jum_apr_luar;
                $hasil_mei = $jum_mei_terima - $jum_mei_luar;
                $hasil_jun = $jum_jun_terima - $jum_jun_luar;
                $hasil_jul = $jum_jul_terima - $jum_jul_luar;
                $hasil_agt = $jum_agt_terima - $jum_agt_luar;
                $hasil_sep = $jum_sep_terima - $jum_sep_luar;
                $hasil_okt = $jum_okt_terima - $jum_okt_luar;
                $hasil_nov = $jum_nov_terima - $jum_nov_luar;
                $hasil_des = $jum_des_terima - $jum_des_luar;
                $hasil_jumlah = $jum_jumlah_terima - $jum_jumlah_luar;
            ?>
            <tr>
                <td>III</td>
                <td><b>KENAIKAN / (PENURUNAN) KAS</b></td>
                <td align="right"><?php echo angka_positif($hasil_jan); ?></td>
                <td align="right"><?php echo angka_positif($hasil_feb); ?></td>
                <td align="right"><?php echo angka_positif($hasil_mar); ?></td>
                <td align="right"><?php echo angka_positif($hasil_apr); ?></td>
                <td align="right"><?php echo angka_positif($hasil_mei); ?></td>
                <td align="right"><?php echo angka_positif($hasil_jun); ?></td>
                <td align="right"><?php echo angka_positif($hasil_jul); ?></td>
                <td align="right"><?php echo angka_positif($hasil_agt); ?></td>
                <td align="right"><?php echo angka_positif($hasil_sep); ?></td>
                <td align="right"><?php echo angka_positif($hasil_okt); ?></td>
                <td align="right"><?php echo angka_positif($hasil_nov); ?></td>
                <td align="right"><?php echo angka_positif($hasil_des); ?></td>
                <td align="right"><?php echo angka_positif($hasil_jumlah); ?></td>
            </tr>
            <?php
                foreach ($arus as $data_detil) {
                    if($data_detil->JENIS == "Saldo Awal"){
                        $jan_sa = $data_detil->JANUARI;
                        $feb_sa = $data_detil->FEBRUARI;
                        $mar_sa = $data_detil->MARET;
                        $apr_sa = $data_detil->APRIL;
                        $mei_sa = $data_detil->MEI;
                        $jun_sa = $data_detil->JUNI;
                        $jul_sa = $data_detil->JULI;
                        $agt_sa = $data_detil->AGUSTUS;
                        $sep_sa = $data_detil->SEPTEMBER;
                        $okt_sa = $data_detil->OKTOBER;
                        $nov_sa = $data_detil->NOVEMBER;
                        $des_sa = $data_detil->DESEMBER;
                        $jumlah_sa = $data_detil->JUMLAH;  
            ?>
            <tr>
                <td>IV</td>
                <td><b><?php echo $data_detil->URAIAN; ?></b></td>
                <td align="right"><?php echo number_format($jan_sa,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($feb_sa,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($mar_sa,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($apr_sa,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($mei_sa,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jun_sa,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jul_sa,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($agt_sa,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($sep_sa,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($okt_sa,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($nov_sa,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($des_sa,0,',','.'); ?></td>
                <td align="right"><?php echo number_format($jumlah_sa,0,',','.'); ?></td>
            </tr>
            <?php
                    }
                }
            ?>
            <?php
                $saldo_akhir_jan = $hasil_jan+$jan_sa;
                $saldo_akhir_feb = $hasil_feb+$feb_sa;
                $saldo_akhir_mar = $hasil_mar+$mar_sa;
                $saldo_akhir_apr = $hasil_apr+$apr_sa;
                $saldo_akhir_mei = $hasil_mei+$mei_sa;
                $saldo_akhir_jun = $hasil_jun+$jun_sa;
                $saldo_akhir_jul = $hasil_jul+$jul_sa;
                $saldo_akhir_agt = $hasil_agt+$agt_sa;
                $saldo_akhir_sep = $hasil_sep+$sep_sa;
                $saldo_akhir_okt = $hasil_okt+$okt_sa;
                $saldo_akhir_nov = $hasil_nov+$nov_sa;
                $saldo_akhir_des = $hasil_des+$des_sa;
                $saldo_akhir_jumlah = $hasil_jumlah+$jumlah_sa;
            ?>
            <tr>
                <td>V</td>
                <td style="font-weight:bold;">SALDO AKHIR KAS</td>
                <td style="font-weight:bold;" align="right"><?php echo number_format($saldo_akhir_jan,0,',','.'); ?></td>
                <td style="font-weight:bold;" align="right"><?php echo number_format($saldo_akhir_feb,0,',','.'); ?></td>
                <td style="font-weight:bold;" align="right"><?php echo number_format($saldo_akhir_mar,0,',','.'); ?></td>
                <td style="font-weight:bold;" align="right"><?php echo number_format($saldo_akhir_apr,0,',','.'); ?></td>
                <td style="font-weight:bold;" align="right"><?php echo number_format($saldo_akhir_mei,0,',','.'); ?></td>
                <td style="font-weight:bold;" align="right"><?php echo number_format($saldo_akhir_jun,0,',','.'); ?></td>
                <td style="font-weight:bold;" align="right"><?php echo number_format($saldo_akhir_jul,0,',','.'); ?></td>
                <td style="font-weight:bold;" align="right"><?php echo number_format($saldo_akhir_agt,0,',','.'); ?></td>
                <td style="font-weight:bold;" align="right"><?php echo number_format($saldo_akhir_sep,0,',','.'); ?></td>
                <td style="font-weight:bold;" align="right"><?php echo number_format($saldo_akhir_okt,0,',','.'); ?></td>
                <td style="font-weight:bold;" align="right"><?php echo number_format($saldo_akhir_nov,0,',','.'); ?></td>
                <td style="font-weight:bold;" align="right"><?php echo number_format($saldo_akhir_des,0,',','.'); ?></td>
                <td style="font-weight:bold;" align="right"><?php echo number_format($saldo_akhir_jumlah,0,',','.'); ?></td>
            </tr>
    </tbody>
</table>

<?PHP
    $content = ob_get_clean();
    // require_once "localhost/siaga/material/fpdf/html2pdf.class.php";
    $width_in_inches = 19.02;
    $height_in_inches = 11.69;
    $width_in_mm = $width_in_inches * 25.4;
    $height_in_mm = $height_in_inches * 25.4;
    $html2pdf = new HTML2PDF('L',array($width_in_mm,$height_in_mm),'en');
    $html2pdf->pdf->SetTitle("Proyeksi Arus Kas $thn");
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('laporan_arus_kas.pdf');
?>