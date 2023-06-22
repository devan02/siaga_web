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
        <tr>
            <td><b>I</b></td>
            <td colspan="17"><b>PENERIMAAN PENGHASILAN DILUAR USAHA</b></td>
        </tr>
    <?php
        $sum_jan_ag = 0;
        $sum_feb_ag = 0;
        $sum_mar_ag = 0;
        $sum_apr_ag = 0;
        $sum_mei_ag = 0;
        $sum_jun_ag = 0;
        $sum_jul_ag = 0;
        $sum_agt_ag = 0;
        $sum_sep_ag = 0;
        $sum_okt_ag = 0;
        $sum_nov_ag = 0;
        $sum_des_ag = 0;
        $sum_jumlah_ag = 0;
        $sum_2014_ag = 0;
        foreach ($data as $value_penerimaan_pg) {
            if($value_penerimaan_pg->JENIS == "PENERIMAAN PENGHASILAN DI LUAR USAHA"){
                $jan_ag = $value_penerimaan_pg->JANUARI;
                $feb_ag = $value_penerimaan_pg->FEBRUARI;
                $mar_ag = $value_penerimaan_pg->MARET;
                $apr_ag = $value_penerimaan_pg->APRIL;
                $mei_ag = $value_penerimaan_pg->MEI;
                $jun_ag = $value_penerimaan_pg->JUNI;
                $jul_ag = $value_penerimaan_pg->JULI;
                $agt_ag = $value_penerimaan_pg->AGUSTUS;
                $sep_ag = $value_penerimaan_pg->SEPTEMBER;
                $okt_ag = $value_penerimaan_pg->OKTOBER;
                $nov_ag = $value_penerimaan_pg->NOVEMBER;
                $des_ag = $value_penerimaan_pg->DESEMBER;
                $jumlah_ag = $jan_ag+$feb_ag+$mar_ag+$apr_ag+$mei_ag+$jun_ag+$jul_ag+$agt_ag+$sep_ag+$okt_ag+$nov_ag+$des_ag;
                $tahun_2014_ag = $value_penerimaan_pg->TAHUN_2014;
                $tot_jumlah_ag = $jumlah_ag-$tahun_2014_ag;
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $value_penerimaan_pg->URAIAN; ?></td>
            <td><?php echo number_format($jan_ag,2,',','.')?></td>
            <td><?php echo number_format($feb_ag,2,',','.')?></td>
            <td><?php echo number_format($mar_ag,2,',','.')?></td>
            <td><?php echo number_format($apr_ag,2,',','.')?></td>
            <td><?php echo number_format($mei_ag,2,',','.')?></td>
            <td><?php echo number_format($jun_ag,2,',','.')?></td>
            <td><?php echo number_format($jul_ag,2,',','.')?></td>
            <td><?php echo number_format($agt_ag,2,',','.')?></td>
            <td><?php echo number_format($sep_ag,2,',','.')?></td>
            <td><?php echo number_format($okt_ag,2,',','.')?></td>
            <td><?php echo number_format($nov_ag,2,',','.')?></td>
            <td><?php echo number_format($des_ag,2,',','.')?></td>
            <td><?php echo number_format($jumlah_ag,2,',','.')?></td>
            <td><?php echo number_format($tahun_2014_ag,2,',','.')?></td>
            <td><?php echo angka_positif($tot_jumlah_ag); ?></td>
            <td>
                <?php
                    $persen_ag = 0;
                    if($jumlah_ag != 0){
                        $persen_ag = ($tot_jumlah_ag/$jumlah_ag)*100;
                    }
                    echo positif_persen($persen_ag);
                ?>
            </td>
        </tr>
    <?php
                $sum_jan_ag += $jan_ag;
                $sum_feb_ag += $feb_ag;
                $sum_mar_ag += $mar_ag;
                $sum_apr_ag += $apr_ag;
                $sum_mei_ag += $mei_ag;
                $sum_jun_ag += $jun_ag;
                $sum_jul_ag += $jul_ag;
                $sum_agt_ag += $agt_ag;
                $sum_sep_ag += $sep_ag;
                $sum_okt_ag += $okt_ag;
                $sum_nov_ag += $nov_ag;
                $sum_des_ag += $des_ag;
                $sum_jumlah_ag += $jumlah_ag;
                $sum_2014_ag += $tahun_2014_ag;
                $total_jumlah_ag = $sum_jumlah_ag-$sum_2014_ag;
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="right">Jumlah Penerimaan Diluar Usaha</td>
            <td><?php echo number_format($sum_jan_ag,2,',','.')?></td>
            <td><?php echo number_format($sum_feb_ag,2,',','.')?></td>
            <td><?php echo number_format($sum_mar_ag,2,',','.')?></td>
            <td><?php echo number_format($sum_apr_ag,2,',','.')?></td>
            <td><?php echo number_format($sum_mei_ag,2,',','.')?></td>
            <td><?php echo number_format($sum_jun_ag,2,',','.')?></td>
            <td><?php echo number_format($sum_jul_ag,2,',','.')?></td>
            <td><?php echo number_format($sum_agt_ag,2,',','.')?></td>
            <td><?php echo number_format($sum_sep_ag,2,',','.')?></td>
            <td><?php echo number_format($sum_okt_ag,2,',','.')?></td>
            <td><?php echo number_format($sum_nov_ag,2,',','.')?></td>
            <td><?php echo number_format($sum_des_ag,2,',','.')?></td>
            <td><?php echo number_format($sum_jumlah_ag,2,',','.')?></td>
            <td><?php echo number_format($sum_2014_ag,2,',','.')?></td>
            <td><?php echo angka_positif($total_jumlah_ag); ?></td>
            <td>
                <?php
                    $sum_persen_ag = ($total_jumlah_ag/$sum_2014_ag)*100;
                    echo positif_persen($sum_persen_ag);
                ?>
            </td>
        </tr>
    </tbody>
</table>
<?PHP
    // require_once "localhost/siaga/material/fpdf/html2pdf.class.php";
    
    $content = ob_get_clean();
    $width_in_inches = 20.39;
    $height_in_inches = 14.54;
    $width_in_mm = $width_in_inches * 25.4;
    $height_in_mm = $height_in_inches * 25.4;
    $html2pdf = new HTML2PDF('L',array($width_in_mm,$height_in_mm),'en');
    $html2pdf->pdf->SetTitle("Rencana Perkembangan Sambungan Pelanggan $tahun");
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('laporan_sambungan_pelanggan_$tahun.pdf');
?>