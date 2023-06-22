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
            <img src="<?=base_url();?>files/pdam/logo-pdamtp.png" width="110" height="90" alt="KOP PDAM">
        </td>
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="580" height="90" alt="KOP PDAM"></td>
        <td>
            <img src="<?=base_url();?>files/pdam/KOP_tulisan.png" width="550" height="90" alt="KOP PDAM">
        </td>
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="580" height="90" alt="KOP PDAM"></td>
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
            <th rowspan="2" style="width:50px;">NO</th>
            <th rowspan="2">URAIAN</th>
            <th rowspan="2">TARIF</th>
            <th rowspan="2">Estimasi Des'<?php echo $tahun-1; ?></th>
            <th colspan="12">BULAN</th>
            <th rowspan="2">JUMLAH</th>
            <th rowspan="2">ESTIMASI<br/>TAHUN<br/><?php echo $tahun-1; ?></th>
            <th colspan="3">MENAIK /<br/>(MENURUN)</th>
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
        	<th>JUMLAH</th>
        	<th>TOTAL</th>
        	<th>%</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td align="center">I</td>
            <td colspan="20">KELOMPOK PELANGGAN I</td>
        </tr>
    <?php
    	$no = 0;
        $tot_estimasi_des_14_kp1 = 0;
        $tot_jan_kp1 = 0;
        $tot_feb_kp1 = 0;
        $tot_mar_kp1 = 0;
        $tot_apr_kp1 = 0;
        $tot_mei_kp1 = 0;
        $tot_jun_kp1 = 0;
        $tot_jul_kp1 = 0;
        $tot_agt_kp1 = 0;
        $tot_sep_kp1 = 0;
        $tot_okt_kp1 = 0;
        $tot_nov_kp1 = 0;
        $tot_des_kp1 = 0;
        $tot_jumlah_kp1 = 0;
        $tot_estimasi_2014_kp1 = 0;
        $tot_jumlah_min_estimasi_kp1 = 0;
        $tot_jumlah_pendapatan_kp1 = 0;
        $persen_kp1 = 0;

    	foreach ($data as $data_detil) {
    		$no++;
            $estimasi_des_14_kp1 = $data_detil->ESTIMASI_DES_2014;
            $jan_kp1 = $data_detil->JANUARI;
            $feb_kp1 = $data_detil->FEBRUARI;
            $mar_kp1 = $data_detil->MARET;
            $apr_kp1 = $data_detil->APRIL;
            $mei_kp1 = $data_detil->MEI;
            $jun_kp1 = $data_detil->JUNI;
            $jul_kp1 = $data_detil->JULI;
            $agt_kp1 = $data_detil->AGUSTUS;
            $sep_kp1 = $data_detil->SEPTEMBER;
            $okt_kp1 = $data_detil->OKTOBER;
            $nov_kp1 = $data_detil->NOVEMBER;
            $des_kp1 = $data_detil->DESEMBER;
            $jumlah_kp1 = $data_detil->JUMLAH;
            $estimasi_2014_kp1 = $data_detil->ESTIMASI_2014;
            $jumlah_min_estimasi_kp1 = $jumlah_kp1-$estimasi_2014_kp1;
            $jumlah_pendapatan_kp1 = $data_detil->JUMLAH_PENDAPATAN;

            if($data_detil->ESTIMASI_2014 == 0){
                $persen_kp1 = 0;
            }else{
                $persen_kp1 = ($jumlah_min_estimasi_kp1/$estimasi_2014_kp1)*100;
            }

            if($data_detil->KELOMPOK_PELANGGAN == "KELOMPOK PELANGGAN I"){
    ?>
        <tr>
            <td align="center"><?php echo $no; ?></td>
            <td><?php echo $data_detil->URAIAN; ?></td>
            <td align="center"><?php echo number_format($data_detil->TARIF,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($estimasi_des_14_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($jan_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($feb_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($mar_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($apr_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($mei_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($jun_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($jul_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($agt_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($sep_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($okt_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($nov_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($des_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($jumlah_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($estimasi_2014_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo angka_positif($jumlah_min_estimasi_kp1); ?></td>
            <td align="center"><?php echo number_format($jumlah_pendapatan_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($persen_kp1,2); ?></td>
        </tr>
    <?php
                $tot_estimasi_des_14_kp1 += $estimasi_des_14_kp1;
                $tot_jan_kp1 += $jan_kp1;
                $tot_feb_kp1 += $feb_kp1;
                $tot_mar_kp1 += $mar_kp1;
                $tot_apr_kp1 += $apr_kp1;
                $tot_mei_kp1 += $mei_kp1;
                $tot_jun_kp1 += $jun_kp1;
                $tot_jul_kp1 += $jul_kp1;
                $tot_agt_kp1 += $agt_kp1;
                $tot_sep_kp1 += $sep_kp1;
                $tot_okt_kp1 += $okt_kp1;
                $tot_nov_kp1 += $nov_kp1;
                $tot_des_kp1 += $des_kp1;
                $tot_jumlah_kp1 += $jumlah_kp1;
                $tot_estimasi_2014_kp1 += $estimasi_2014_kp1;
                $tot_jumlah_min_estimasi_kp1 += $jumlah_min_estimasi_kp1;
                $tot_jumlah_pendapatan_kp1 += $jumlah_pendapatan_kp1;
            }
    	}
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="center"><b>Jumlah Kelompok Pelanggan I</b></td>
            <td>&nbsp;</td>
            <td align="center"><?php echo number_format($tot_estimasi_des_14_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_jan_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_feb_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_mar_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_apr_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_mei_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_jun_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_jul_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_agt_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_sep_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_okt_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_nov_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_des_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_jumlah_kp1,0,',','.')?></td>
            <td align="center"><?php echo number_format($tot_estimasi_2014_kp1,0,',','.'); ?></td>
            <td align="center"><?php echo angka_positif($tot_jumlah_min_estimasi_kp1); ?></td>
            <td align="center"><?php echo angka_positif($tot_jumlah_pendapatan_kp1); ?></td>
            <td align="center">
                <?php
                    $tot_persen_kp1 = 0;
                    if($tot_estimasi_2014_kp1 != 0){
                        $tot_persen_kp1 = ($tot_jumlah_min_estimasi_kp1/$tot_estimasi_2014_kp1)*100;
                    }
                    echo number_format($tot_persen_kp1,2);
                ?>
            </td>
        </tr>
        <!-- KP 2 -->
        <tr>
            <td align="center">II</td>
            <td colspan="20">KELOMPOK PELANGGAN II</td>
        </tr>
    <?php
        $no = 0;
        $tot_estimasi_des_14_kp2 = 0;
        $tot_jan_kp2 = 0;
        $tot_feb_kp2 = 0;
        $tot_mar_kp2 = 0;
        $tot_apr_kp2 = 0;
        $tot_mei_kp2 = 0;
        $tot_jun_kp2 = 0;
        $tot_jul_kp2 = 0;
        $tot_agt_kp2 = 0;
        $tot_sep_kp2 = 0;
        $tot_okt_kp2 = 0;
        $tot_nov_kp2 = 0;
        $tot_des_kp2 = 0;
        $tot_jumlah_kp2 = 0;
        $tot_estimasi_2014_kp2 = 0;
        $tot_jumlah_min_estimasi_kp2 = 0;
        $tot_jumlah_pendapatan_kp2 = 0;
        $persen_kp2 = 0;

        foreach ($data as $data_detil) {
            $no++;
            $estimasi_des_14_kp2 = $data_detil->ESTIMASI_DES_2014;
            $jan_kp2 = $data_detil->JANUARI;
            $feb_kp2 = $data_detil->FEBRUARI;
            $mar_kp2 = $data_detil->MARET;
            $apr_kp2 = $data_detil->APRIL;
            $mei_kp2 = $data_detil->MEI;
            $jun_kp2 = $data_detil->JUNI;
            $jul_kp2 = $data_detil->JULI;
            $agt_kp2 = $data_detil->AGUSTUS;
            $sep_kp2 = $data_detil->SEPTEMBER;
            $okt_kp2 = $data_detil->OKTOBER;
            $nov_kp2 = $data_detil->NOVEMBER;
            $des_kp2 = $data_detil->DESEMBER;
            $jumlah_kp2 = $data_detil->JUMLAH;
            $estimasi_2014_kp2 = $data_detil->ESTIMASI_2014;
            $jumlah_min_estimasi_kp2 = $jumlah_kp2-$estimasi_2014_kp2;
            $jumlah_pendapatan_kp2 = $data_detil->JUMLAH_PENDAPATAN;

            if($data_detil->ESTIMASI_2014 == 0){
                $persen_kp2 = 0;
            }else{
                $persen_kp2 = ($jumlah_min_estimasi_kp2/$estimasi_2014_kp2)*100;
            }

            if($data_detil->KELOMPOK_PELANGGAN == "KELOMPOK PELANGGAN II"){
    ?>
        <tr>
            <td align="center"><?php echo $no; ?></td>
            <td><?php echo $data_detil->URAIAN; ?></td>
            <td align="center"><?php echo number_format($data_detil->TARIF,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($estimasi_des_14_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($jan_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($feb_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($mar_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($apr_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($mei_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($jun_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($jul_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($agt_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($sep_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($okt_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($nov_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($des_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($jumlah_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($estimasi_2014_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo angka_positif($jumlah_min_estimasi_kp2); ?></td>
            <td align="center"><?php echo number_format($jumlah_pendapatan_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($persen_kp2,2); ?></td>
        </tr>
    <?php
                $tot_estimasi_des_14_kp2 += $estimasi_des_14_kp2;
                $tot_jan_kp2 += $jan_kp2;
                $tot_feb_kp2 += $feb_kp2;
                $tot_mar_kp2 += $mar_kp2;
                $tot_apr_kp2 += $apr_kp2;
                $tot_mei_kp2 += $mei_kp2;
                $tot_jun_kp2 += $jun_kp2;
                $tot_jul_kp2 += $jul_kp2;
                $tot_agt_kp2 += $agt_kp2;
                $tot_sep_kp2 += $sep_kp2;
                $tot_okt_kp2 += $okt_kp2;
                $tot_nov_kp2 += $nov_kp2;
                $tot_des_kp2 += $des_kp2;
                $tot_jumlah_kp2 += $jumlah_kp2;
                $tot_estimasi_2014_kp2 += $estimasi_2014_kp2;
                $tot_jumlah_min_estimasi_kp2 += $jumlah_min_estimasi_kp2;
                $tot_jumlah_pendapatan_kp2 += $jumlah_pendapatan_kp2;
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="center"><b>Jumlah Kelompok Pelanggan II</b></td>
            <td>&nbsp;</td>
            <td align="center"><?php echo number_format($tot_estimasi_des_14_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_jan_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_feb_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_mar_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_apr_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_mei_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_jun_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_jul_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_agt_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_sep_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_okt_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_nov_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_des_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_jumlah_kp2,0,',','.')?></td>
            <td align="center"><?php echo number_format($tot_estimasi_2014_kp2,0,',','.'); ?></td>
            <td align="center"><?php echo angka_positif($tot_jumlah_min_estimasi_kp2); ?></td>
            <td align="center"><?php echo angka_positif($tot_jumlah_pendapatan_kp2); ?></td>
            <td align="center">
                <?php
                    $tot_persen_kp2 = 0;
                    if($tot_estimasi_2014_kp2 != 0){
                        $tot_persen_kp2 = ($tot_jumlah_min_estimasi_kp2/$tot_estimasi_2014_kp2)*100;
                    }
                    echo number_format($tot_persen_kp2,2);
                ?>
            </td>
        </tr>
        <!-- KP 3 -->
        <tr>
            <td align="center">III</td>
            <td colspan="20">KELOMPOK PELANGGAN III</td>
        </tr>
    <?php
        $no = 0;
        $tot_estimasi_des_14_kp3 = 0;
        $tot_jan_kp3 = 0;
        $tot_feb_kp3 = 0;
        $tot_mar_kp3 = 0;
        $tot_apr_kp3 = 0;
        $tot_mei_kp3 = 0;
        $tot_jun_kp3 = 0;
        $tot_jul_kp3 = 0;
        $tot_agt_kp3 = 0;
        $tot_sep_kp3 = 0;
        $tot_okt_kp3 = 0;
        $tot_nov_kp3 = 0;
        $tot_des_kp3 = 0;
        $tot_jumlah_kp3 = 0;
        $tot_estimasi_2014_kp3 = 0;
        $tot_jumlah_min_estimasi_kp3 = 0;
        $tot_jumlah_pendapatan_kp3 = 0;
        $persen_kp3 = 0;

        foreach ($data as $data_detil) {
            $no++;
            $estimasi_des_14_kp3 = $data_detil->ESTIMASI_DES_2014;
            $jan_kp3 = $data_detil->JANUARI;
            $feb_kp3 = $data_detil->FEBRUARI;
            $mar_kp3 = $data_detil->MARET;
            $apr_kp3 = $data_detil->APRIL;
            $mei_kp3 = $data_detil->MEI;
            $jun_kp3 = $data_detil->JUNI;
            $jul_kp3 = $data_detil->JULI;
            $agt_kp3 = $data_detil->AGUSTUS;
            $sep_kp3 = $data_detil->SEPTEMBER;
            $okt_kp3 = $data_detil->OKTOBER;
            $nov_kp3 = $data_detil->NOVEMBER;
            $des_kp3 = $data_detil->DESEMBER;
            $jumlah_kp3 = $data_detil->JUMLAH;
            $estimasi_2014_kp3 = $data_detil->ESTIMASI_2014;
            $jumlah_min_estimasi_kp3 = $jumlah_kp3-$estimasi_2014_kp3;
            $jumlah_pendapatan_kp3 = $data_detil->JUMLAH_PENDAPATAN;

            if($data_detil->ESTIMASI_2014 == 0){
                $persen_kp3 = 0;
            }else{
                $persen_kp3 = ($jumlah_min_estimasi_kp3/$estimasi_2014_kp3)*100;
            }

            if($data_detil->KELOMPOK_PELANGGAN == "KELOMPOK PELANGGAN III"){
    ?>
        <tr>
            <td align="center"><?php echo $no; ?></td>
            <td><?php echo $data_detil->URAIAN; ?></td>
            <td align="center"><?php echo number_format($data_detil->TARIF,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($estimasi_des_14_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($jan_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($feb_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($mar_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($apr_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($mei_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($jun_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($jul_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($agt_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($sep_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($okt_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($nov_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($des_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($jumlah_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($estimasi_2014_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo angka_positif($jumlah_min_estimasi_kp3); ?></td>
            <td align="center"><?php echo number_format($jumlah_pendapatan_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($persen_kp3,2); ?></td>
        </tr>
    <?php
                $tot_estimasi_des_14_kp3 += $estimasi_des_14_kp3;
                $tot_jan_kp3 += $jan_kp3;
                $tot_feb_kp3 += $feb_kp3;
                $tot_mar_kp3 += $mar_kp3;
                $tot_apr_kp3 += $apr_kp3;
                $tot_mei_kp3 += $mei_kp3;
                $tot_jun_kp3 += $jun_kp3;
                $tot_jul_kp3 += $jul_kp3;
                $tot_agt_kp3 += $agt_kp3;
                $tot_sep_kp3 += $sep_kp3;
                $tot_okt_kp3 += $okt_kp3;
                $tot_nov_kp3 += $nov_kp3;
                $tot_des_kp3 += $des_kp3;
                $tot_jumlah_kp3 += $jumlah_kp3;
                $tot_estimasi_2014_kp3 += $estimasi_2014_kp3;
                $tot_jumlah_min_estimasi_kp3 += $jumlah_min_estimasi_kp3;
                $tot_jumlah_pendapatan_kp3 += $jumlah_pendapatan_kp3;
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="center"><b>Jumlah Kelompok Pelanggan III</b></td>
            <td>&nbsp;</td>
            <td align="center"><?php echo number_format($tot_estimasi_des_14_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_jan_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_feb_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_mar_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_apr_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_mei_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_jun_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_jul_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_agt_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_sep_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_okt_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_nov_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_des_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_jumlah_kp3,0,',','.')?></td>
            <td align="center"><?php echo number_format($tot_estimasi_2014_kp3,0,',','.'); ?></td>
            <td align="center"><?php echo angka_positif($tot_jumlah_min_estimasi_kp3); ?></td>
            <td align="center"><?php echo angka_positif($tot_jumlah_pendapatan_kp3); ?></td>
            <td align="center">
                <?php
                    $tot_persen_kp3 = 0;
                    if($tot_estimasi_2014_kp3 != 0){
                        $tot_persen_kp3 = ($tot_jumlah_min_estimasi_kp3/$tot_estimasi_2014_kp3)*100;
                    }
                    echo number_format($tot_persen_kp3,2);
                ?>
            </td>
        </tr>
        <!-- KP IV -->
        <tr>
            <td align="center">IV</td>
            <td colspan="20">KELOMPOK PELANGGAN IV</td>
        </tr>
    <?php
        $no = 0;
        $tot_estimasi_des_14_kp4 = 0;
        $tot_jan_kp4 = 0;
        $tot_feb_kp4 = 0;
        $tot_mar_kp4 = 0;
        $tot_apr_kp4 = 0;
        $tot_mei_kp4 = 0;
        $tot_jun_kp4 = 0;
        $tot_jul_kp4 = 0;
        $tot_agt_kp4 = 0;
        $tot_sep_kp4 = 0;
        $tot_okt_kp4 = 0;
        $tot_nov_kp4 = 0;
        $tot_des_kp4 = 0;
        $tot_jumlah_kp4 = 0;
        $tot_estimasi_2014_kp4 = 0;
        $tot_jumlah_min_estimasi_kp4 = 0;
        $tot_jumlah_pendapatan_kp4 = 0;
        $persen_kp4 = 0;

        foreach ($data as $data_detil) {
            $no++;
            $estimasi_des_14_kp4 = $data_detil->ESTIMASI_DES_2014;
            $jan_kp4 = $data_detil->JANUARI;
            $feb_kp4 = $data_detil->FEBRUARI;
            $mar_kp4 = $data_detil->MARET;
            $apr_kp4 = $data_detil->APRIL;
            $mei_kp4 = $data_detil->MEI;
            $jun_kp4 = $data_detil->JUNI;
            $jul_kp4 = $data_detil->JULI;
            $agt_kp4 = $data_detil->AGUSTUS;
            $sep_kp4 = $data_detil->SEPTEMBER;
            $okt_kp4 = $data_detil->OKTOBER;
            $nov_kp4 = $data_detil->NOVEMBER;
            $des_kp4 = $data_detil->DESEMBER;
            $jumlah_kp4 = $data_detil->JUMLAH;
            $estimasi_2014_kp4 = $data_detil->ESTIMASI_2014;
            $jumlah_min_estimasi_kp4 = $jumlah_kp4-$estimasi_2014_kp4;
            $jumlah_pendapatan_kp4 = $data_detil->JUMLAH_PENDAPATAN;

            if($data_detil->ESTIMASI_2014 == 0){
                $persen_kp4 = 0;
            }else{
                $persen_kp4 = ($jumlah_min_estimasi_kp4/$estimasi_2014_kp4)*100;
            }

            if($data_detil->KELOMPOK_PELANGGAN == "KELOMPOK PELANGGAN IV"){
    ?>
        <tr>
            <td align="center"><?php echo $no; ?></td>
            <td><?php echo $data_detil->URAIAN; ?></td>
            <td align="center"><?php echo number_format($data_detil->TARIF,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($estimasi_des_14_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($jan_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($feb_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($mar_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($apr_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($mei_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($jun_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($jul_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($agt_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($sep_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($okt_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($nov_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($des_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($jumlah_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($estimasi_2014_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo angka_positif($jumlah_min_estimasi_kp4); ?></td>
            <td align="center"><?php echo number_format($jumlah_pendapatan_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($persen_kp4,2); ?></td>
        </tr>
    <?php
                $tot_estimasi_des_14_kp4 += $estimasi_des_14_kp4;
                $tot_jan_kp4 += $jan_kp4;
                $tot_feb_kp4 += $feb_kp4;
                $tot_mar_kp4 += $mar_kp4;
                $tot_apr_kp4 += $apr_kp4;
                $tot_mei_kp4 += $mei_kp4;
                $tot_jun_kp4 += $jun_kp4;
                $tot_jul_kp4 += $jul_kp4;
                $tot_agt_kp4 += $agt_kp4;
                $tot_sep_kp4 += $sep_kp4;
                $tot_okt_kp4 += $okt_kp4;
                $tot_nov_kp4 += $nov_kp4;
                $tot_des_kp4 += $des_kp4;
                $tot_jumlah_kp4 += $jumlah_kp4;
                $tot_estimasi_2014_kp4 += $estimasi_2014_kp4;
                $tot_jumlah_min_estimasi_kp4 += $jumlah_min_estimasi_kp4;
                $tot_jumlah_pendapatan_kp4 += $jumlah_pendapatan_kp4;
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="center"><b>Jumlah Kelompok Pelanggan IV</b></td>
            <td>&nbsp;</td>
            <td align="center"><?php echo number_format($tot_estimasi_des_14_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_jan_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_feb_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_mar_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_apr_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_mei_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_jun_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_jul_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_agt_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_sep_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_okt_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_nov_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_des_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo number_format($tot_jumlah_kp4,0,',','.')?></td>
            <td align="center"><?php echo number_format($tot_estimasi_2014_kp4,0,',','.'); ?></td>
            <td align="center"><?php echo angka_positif($tot_jumlah_min_estimasi_kp4); ?></td>
            <td align="center"><?php echo angka_positif($tot_jumlah_pendapatan_kp4); ?></td>
            <td align="center">
                <?php
                    $tot_persen_kp4 = 0;
                    if($tot_estimasi_2014_kp4 != 0){
                        $tot_persen_kp4 = ($tot_jumlah_min_estimasi_kp4/$tot_estimasi_2014_kp4)*100;
                    }
                    echo number_format($tot_persen_kp4,2);
                ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="center"><b>Jumlah Pelanggan</b></td>
            <td>&nbsp;</td>
            <td align="center">
                <?php
                    $total_kp = $tot_estimasi_des_14_kp1+$tot_estimasi_des_14_kp2+$tot_estimasi_des_14_kp3+$tot_estimasi_des_14_kp4;
                    echo angka_positif($total_kp);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_jan = $tot_jan_kp1+$tot_jan_kp2+$tot_jan_kp3+$tot_jan_kp4;
                    echo angka_positif($total_jan);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_feb = $tot_feb_kp1+$tot_feb_kp2+$tot_feb_kp3+$tot_feb_kp4;
                    echo angka_positif($total_feb);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_mar = $tot_mar_kp1+$tot_mar_kp2+$tot_mar_kp3+$tot_mar_kp4;
                    echo angka_positif($total_mar);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_apr = $tot_apr_kp1+$tot_apr_kp2+$tot_apr_kp3+$tot_apr_kp4;
                    echo angka_positif($total_apr);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_mei = $tot_mei_kp1+$tot_mei_kp2+$tot_mei_kp3+$tot_mei_kp4;
                    echo angka_positif($total_mei);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_jun = $tot_jun_kp1+$tot_jun_kp2+$tot_jun_kp3+$tot_jun_kp4;
                    echo angka_positif($total_jun);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_jul = $tot_jul_kp1+$tot_jul_kp2+$tot_jul_kp3+$tot_jul_kp4;
                    echo angka_positif($total_jul);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_agt = $tot_agt_kp1+$tot_agt_kp2+$tot_agt_kp3+$tot_agt_kp4;
                    echo angka_positif($total_agt);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_sep = $tot_sep_kp1+$tot_sep_kp2+$tot_sep_kp3+$tot_sep_kp4;
                    echo angka_positif($total_sep);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_okt = $tot_okt_kp1+$tot_okt_kp2+$tot_okt_kp3+$tot_okt_kp4;
                    echo angka_positif($total_okt);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_nov = $tot_nov_kp1+$tot_nov_kp2+$tot_nov_kp3+$tot_nov_kp4;
                    echo angka_positif($total_nov);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_des = $tot_des_kp1+$tot_des_kp2+$tot_des_kp3+$tot_des_kp4;
                    echo angka_positif($total_des);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_jumlah = $tot_jumlah_kp1+$tot_jumlah_kp2+$tot_jumlah_kp3+$tot_jumlah_kp4;
                    echo angka_positif($total_jumlah);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_estimasi_2014 = $tot_estimasi_2014_kp1+$tot_estimasi_2014_kp2+$tot_estimasi_2014_kp3+$tot_estimasi_2014_kp4;
                    echo angka_positif($total_estimasi_2014);
                ?>
            </td>
            <td align="center">
                <?php
                    $jumlah_min_estimasi = $total_jumlah-$total_estimasi_2014;
                    echo angka_positif($jumlah_min_estimasi);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_pendapatan = $tot_jumlah_pendapatan_kp1+$tot_jumlah_pendapatan_kp2+$tot_jumlah_pendapatan_kp3+$tot_jumlah_pendapatan_kp4;
                    echo angka_positif($total_pendapatan);
                ?>
            </td>
            <td align="center">
                <?php
                    $persen = 0;
                    if($total_estimasi_2014 != 0){
                        $persen = ($jumlah_min_estimasi/$total_estimasi_2014)*100;
                    }
                    echo number_format($persen,2);
                ?>
            </td>
        </tr>
    </tbody>
</table>
<?PHP
    // require_once "localhost/siaga/material/fpdf/html2pdf.class.php";
    
    $content = ob_get_clean();
    $width_in_inches = 21.39;
    $height_in_inches = 14.54;
    $width_in_mm = $width_in_inches * 25.4;
    $height_in_mm = $height_in_inches * 25.4;
    $html2pdf = new HTML2PDF('L',array($width_in_mm,$height_in_mm),'en');
    $html2pdf->pdf->SetTitle("Rencana Perkembangan Sambungan Pelanggan $tahun");
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('laporan_sambungan_pelanggan_$tahun.pdf');
?>