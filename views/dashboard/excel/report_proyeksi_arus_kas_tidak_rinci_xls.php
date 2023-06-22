<?PHP 
    header("Cache-Control: no-cache, no-store, must-revalidate");  
    header("Content-Type: application/vnd.ms-excel");  
    header("Content-Disposition: attachment; filename=Proyeksi_arus_kas_tidak_rinci_$thn.xls");
?>

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
function angka_positif_rp($angka){
    if($angka < 0){
        $angka = -$angka;
        $angka = "(".number_format($angka,0,',','.').")";
    }else{
        $angka = number_format($angka,0,',','.');
    }
    return $angka;
}

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

<!-- <table align="center">
    <tr>
        <td>
            <img src="<?=base_url();?>files/pdam/logo-pdamtp.png" width="70" height="70" alt="KOP PDAM">
        </td>
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="250" height="90" alt="KOP PDAM"></td>
        <td>
            <img src="<?=base_url();?>files/pdam/KOP_tulisan.png" width="350" height="70" alt="KOP PDAM">
        </td>
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="250" height="90" alt="KOP PDAM"></td>
        <td>
            <img src="<?=base_url();?>files/pdam/logo_perpamsi_glossy2.png" width="100" height="70" alt="KOP PDAM">
        </td>
    </tr>
</table>

<hr>
 -->
<table align="center">
    <tr>
        <td style="text-align:center;" colspan="9">
            <h3>
                <?php echo $title; ?> <br>
                TAHUN ANGGARAN : <?php echo $thn;?>
            </h3>
        </td>
    </tr>
</table>

<br>

<?php
    $_2014 = $thn-1;
    $_2013 = $thn-2;
?>
<table class="grid">
    <thead>
        <tr>
            <th rowspan="2" style="width:50px;">NO</th>
            <th rowspan="2">URAIAN</th>
            <th rowspan="2">TAHUN <?php echo $thn; ?></th>
            <th rowspan="2">TAHUN <?php echo $_2014; ?></th>
            <th rowspan="2">TAHUN <?php echo $_2013; ?></th>
            <th colspan="2">Proyeksi Tahun <?php echo $thn; ?><br/>dibanding<br/>Realisasi Tahun <?php echo $_2014; ?></th>
            <th colspan="2">Proyeksi Tahun <?php echo $thn; ?><br/>dibanding<br/>Realisasi Tahun <?php echo $_2013; ?></th>
        </tr>
        <tr>
            <th>Jumlah</th>
            <th>%</th>
            <th>Jumlah</th>
            <th>%</th>
        </tr>
    </thead>
    <tbody>
        <!-- PENERIMAAN KAS -->
        <tr>
            <td align="center">I</td>
            <td align="left" colspan="8"><b>PROYEKSI PENERIMAAN KAS</b></td>
        </tr>
        <tr>
            <td align="center">1.</td>
            <td align="left" colspan="8"><b>Penerimaan Operasi</b></td>
        </tr>
    <?php
        $tot_jumlah_2015 = 0;
        $tot_jumlah_2014 = 0;
        $tot_jumlah_2013 = 0;
        $jum_terima_2 = 0;
        $jumlah_2015 = 0;
        $jumlah_2014 = 0;
        $jumlah_2013 = 0;
        $persen1 = 0;
        $persen2 = 0;
        foreach ($arus2 as $data_detil) {
            if($data_detil->JENIS == "Penerimaan Operasi"){
                $jumlah_2015 = $data_detil->JUMLAH;
                $jumlah_2014 = $data_detil->JUMLAH_2014;
                $jumlah_2013 = $data_detil->JUMLAH_2013;
                $jumlah1 = 0;
                $jumlah2 = 0;

                if($jumlah_2013 != 0){
                    $jumlah2 = $jumlah_2015-$jumlah_2013;
                    $persen2 = ($jumlah2/$jumlah_2013)*100;
                }

                if($jumlah_2014 != 0){
                    $jumlah1 = $jumlah_2015-$jumlah_2014;
                    $persen1 = ($jumlah1/$jumlah_2014)*100;
                }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $data_detil->URAIAN; ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah_2015); ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah_2014); ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah_2013); ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah1); ?></td>
            <td align="center"><?php echo angka_positif($persen1); ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah2); ?></td>
            <td align="center"><?php echo angka_positif($persen2); ?></td>
        </tr>
    <?php
                $tot_jumlah_2015 += $jumlah_2015;
                $tot_jumlah_2014 += $jumlah_2014;
                $tot_jumlah_2013 += $jumlah_2013;
                $jum_terima_2 += $jumlah2;
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="right">Jumlah Penerimaan Operasi</td>
            <td align="center"><?php echo angka_positif_rp($tot_jumlah_2015); ?></td>
            <td align="center"><?php echo angka_positif_rp($tot_jumlah_2014); ?></td>
            <td align="center"><?php echo angka_positif_rp($tot_jumlah_2013); ?></td>
            <td align="center">
                <?php
                    $jum_terima_1 = $tot_jumlah_2015-$tot_jumlah_2014;
                    echo angka_positif_rp($jum_terima_1);
                ?>
            </td>
            <td align="center">
                <?php
                    $persen_terima1 = 0;
                    if($tot_jumlah_2014 != 0){
                        $persen_terima1 = ($jum_terima_1/$tot_jumlah_2014)*100;
                    }
                    echo angka_positif($persen_terima1);
                ?>
            </td>
            <td align="center">
                <?php
                    echo angka_positif_rp($jum_terima_2);
                ?>
            </td>
            <td align="center">
                <?php
                    $persen_terima2 = 0;
                    if($jum_terima_2 != 0){
                        $persen_terima2 = ($jum_terima_2/$tot_jumlah_2013)*100;
                    }
                    echo angka_positif($persen_terima2);
                ?>
            </td>
        </tr>
        <tr>
            <td align="center">2.</td>
            <td align="left" colspan="8"><b>Penerimaan Non Operasi</b></td>
        </tr>
    <?php
        $tot_jumlah_non_op_2015 = 0;
        $tot_jumlah_non_op_2014 = 0;
        $tot_jumlah_non_op_2013 = 0;
        $jum_luar_2 = 0;
        foreach ($arus2 as $data_detil) {
            $jumlah_non1 = 0;
            $jumlah_non2 = 0;
            $persen_non_1 = 0;
            $persen_non_2 = 0;
            if($data_detil->JENIS == "Penerimaan Non Operasi"){
                $jumlah_2015 = $data_detil->JUMLAH;
                $jumlah_2014 = $data_detil->JUMLAH_2014;
                $jumlah_2013 = $data_detil->JUMLAH_2013;
                
                if($jumlah_2014 != 0){
                    $jumlah_non1 = $jumlah_2015-$jumlah_2014;
                    $persen_non_1 = ($jumlah_non1/$jumlah_2014)*100;
                }

                if($jumlah_2013 != 0){
                    $jumlah_non2 = $jumlah_2015-$jumlah_2013;
                    $persen_non_2 = ($jumlah_non2/$jumlah_2013)*100;
                }

                if($persen_non_2 > 100){
                    $persen_non_2 = 0;
                }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $data_detil->URAIAN; ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah_2015); ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah_2014); ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah_2013); ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah_non1); ?></td>
            <td align="center"><?php echo angka_positif($persen_non_1); ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah_non2); ?></td>
            <td align="center"><?php echo angka_positif($persen_non_2); ?></td>
        </tr>
    <?php
                $tot_jumlah_non_op_2015 += $jumlah_2015;
                $tot_jumlah_non_op_2014 += $jumlah_2014;
                $tot_jumlah_non_op_2013 += $jumlah_2013;
                $jum_luar_2 += $jumlah_non2;
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="right">Jumlah Penerimaan Non Operasi</td>
            <td align="center"><?php echo angka_positif_rp($tot_jumlah_non_op_2015); ?></td>
            <td align="center"><?php echo angka_positif_rp($tot_jumlah_non_op_2014); ?></td>
            <td align="center"><?php echo angka_positif_rp($tot_jumlah_non_op_2013); ?></td>
            <td align="center">
                <?php
                    $jum_luar_1 = $tot_jumlah_non_op_2015-$tot_jumlah_non_op_2014;
                    echo angka_positif_rp($jum_luar_1);
                ?>
            </td>
            <td align="center">
                <?php
                    $persen_luar_1 = 0;
                    if($jum_luar_1 != 0){
                        $persen_luar_1 = ($jum_luar_1/$tot_jumlah_non_op_2014)*100;
                    }
                    echo angka_positif($persen_luar_1);
                ?>
            </td>
            <td align="center">
                <?php
                    echo angka_positif_rp($jum_luar_2);
                ?>
            </td>
            <td align="center">
                <?php
                    $persen_luar_2 = 0;
                    if($jum_luar_2 != 0){
                        $persen_luar_2 = ($jum_luar_2/$tot_jumlah_non_op_2013)*100;
                    }
                    echo angka_positif($persen_luar_2);
                ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="center"><b>Jumlah Penerimaan Kas</b></td>
            <td align="center">
                <?php 
                    $total_penerimaan_2015 = $tot_jumlah_2015+$tot_jumlah_non_op_2015;
                    echo angka_positif_rp($total_penerimaan_2015); 
                ?>
            </td>
            <td align="center">
                <?php 
                    $total_penerimaan_2014 = $tot_jumlah_2014+$tot_jumlah_non_op_2014;
                    echo angka_positif_rp($total_penerimaan_2014);
                ?>
            </td>
            <td align="center">
                <?php 
                    $total_penerimaan_2013 = $tot_jumlah_2013+$tot_jumlah_non_op_2013;
                    echo angka_positif_rp($total_penerimaan_2013);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_jumlah_terima1 = $total_penerimaan_2015-$total_penerimaan_2014;
                    echo angka_positif_rp($total_jumlah_terima1);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_persen_terima1 = 0;
                    if($total_penerimaan_2014 != 0){
                        $total_persen_terima1 = ($total_jumlah_terima1/$total_penerimaan_2014)*100;
                    }
                    echo angka_positif($total_persen_terima1);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_jumlah_terima2 = $total_penerimaan_2015-$total_penerimaan_2013;
                    echo angka_positif_rp($total_jumlah_terima2);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_persen_terima2 = 0;
                    if($total_penerimaan_2013 != 0){
                        $total_persen_terima2 = ($total_jumlah_terima2/$total_penerimaan_2013)*100;
                    }
                    echo angka_positif($total_persen_terima2);
                ?>
            </td>
        </tr>
        <!-- PENGELUARAN KAS -->
        <tr>
            <td align="center">II</td>
            <td align="left" colspan="8"><b>PROYEKSI PENGELUARAN KAS</b></td>
        </tr>
        <tr>
            <td align="center">1.</td>
            <td align="left" colspan="8"><b>Pengeluaran Operasi</b></td>
        </tr>
    <?php
        $tot_jumlah_luar_2015 = 0;
        $tot_jumlah_luar_2014 = 0;
        $tot_jumlah_luar_2013 = 0;
        foreach ($arus2 as $data_detil) {
            $jumlah_luar_2015 = 0;
            $jumlah_luar_2014 = 0;
            $jumlah_luar_2013 = 0;
            $jumlah_luar1 = 0;
            $jumlah_luar2 = 0;
            $persen_luar1 = 0;
            $persen_luar2 = 0;
            if($data_detil->JENIS == "Pengeluaran Operasi"){
                $jumlah_luar_2015 = $data_detil->JUMLAH;
                $jumlah_luar_2014 = $data_detil->JUMLAH_2014;
                $jumlah_luar_2013 = $data_detil->JUMLAH_2013;
                
                if($jumlah_luar_2014 != 0){
                    $jumlah_luar1 = $jumlah_luar_2015-$jumlah_luar_2014;
                    $persen_luar1 = ($jumlah_luar1/$jumlah_luar_2014)*100;
                }

                if($jumlah_luar_2013 != 0){
                    $jumlah_luar2 = $jumlah_luar_2015-$jumlah_luar_2013;
                    $persen_luar2 = ($jumlah_luar2/$jumlah_luar_2013)*100;
                }
                
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $data_detil->URAIAN; ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah_luar_2015); ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah_luar_2014); ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah_luar_2013); ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah_luar1); ?></td>
            <td align="center"><?php echo angka_positif($persen_luar1); ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah_luar2); ?></td>
            <td align="center"><?php echo angka_positif($persen_luar2); ?></td>
        </tr>
    <?php
                $tot_jumlah_luar_2015 += $jumlah_luar_2015;
                $tot_jumlah_luar_2014 += $jumlah_luar_2014;
                $tot_jumlah_luar_2013 += $jumlah_luar_2013;
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="right">Jumlah Pengeluaran Operasi</td>
            <td align="center"><?php echo angka_positif_rp($tot_jumlah_luar_2015); ?></td>
            <td align="center"><?php echo angka_positif_rp($tot_jumlah_luar_2014); ?></td>
            <td align="center"><?php echo angka_positif_rp($tot_jumlah_luar_2013); ?></td>
            <td align="center">
                <?php
                    $tot_jumlah_luar1 = $tot_jumlah_luar_2015-$tot_jumlah_luar_2014;
                    echo angka_positif_rp($tot_jumlah_luar1);
                ?>
            </td>
            <td align="center">
                <?php
                    $tot_persen_luar1 = 0;
                    if($tot_jumlah_luar1 != 0){
                        $tot_persen_luar1 = ($tot_jumlah_luar1/$tot_jumlah_luar_2014)*100;
                    }
                    echo angka_positif($tot_persen_luar1);
                ?>
            </td>
            <td align="center">
                <?php
                    $tot_jumlah_luar2 = $tot_jumlah_luar_2015-$tot_jumlah_luar_2013;
                    echo angka_positif_rp($tot_jumlah_luar2); 
                ?>
            </td>
            <td align="center">
                <?php
                    $tot_persen_luar2 = 0;
                    if($tot_jumlah_luar2 != 0){
                        $tot_persen_luar2 = ($tot_jumlah_luar2/$tot_jumlah_luar_2013)*100;
                    }
                    echo angka_positif($tot_persen_luar2);
                ?>
            </td>
        </tr>
        <tr>
            <td align="center">2.</td>
            <td align="left" colspan="8"><b>Pengeluaran Non Operasi</b></td>
        </tr>
    <?php
        $tot_jumlah_luar_non_op_2015 = 0;
        $tot_jumlah_luar_non_op_2014 = 0;
        $tot_jumlah_luar_non_op_2013 = 0;
        foreach ($arus2 as $data_detil) {
            $jumlah_luar_non_2015 = 0;
            $jumlah_luar_non_2014 = 0;
            $jumlah_luar_non_2013 = 0;
            $persen_luar_non1 = 0;
            $persen_luar_non2 = 0;
            if($data_detil->JENIS == "Pengeluaran Non Operasi"){
                $jumlah_luar_non_2015 = $data_detil->JUMLAH;
                $jumlah_luar_non_2014 = $data_detil->JUMLAH_2014;
                $jumlah_luar_non_2013 = $data_detil->JUMLAH_2013;

                if($jumlah_luar_non_2014 != 0){
                    $jumlah_luar_non1 = $jumlah_luar_non_2015-$jumlah_luar_non_2014;
                    $persen_luar_non1 = ($jumlah_luar_non1/$jumlah_luar_non_2014)*100;
                }

                if($jumlah_luar_non_2013 != 0){
                    $jumlah_luar_non2 = $jumlah_luar_non_2015-$jumlah_luar_non_2013;
                    $persen_luar_non2 = ($jumlah_luar_non2/$jumlah_luar_non_2013)*100;
                }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $data_detil->URAIAN; ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah_luar_non_2015); ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah_luar_non_2014); ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah_luar_non_2013); ?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah_luar_non1); ?></td>
            <td align="center"><?php echo angka_positif($persen_luar_non1);?></td>
            <td align="center"><?php echo angka_positif_rp($jumlah_luar_non2); ?></td>
            <td align="center"><?php echo angka_positif($persen_luar_non2);?></td>
        </tr>
    <?php
                $tot_jumlah_luar_non_op_2015 += $jumlah_luar_non_2015;
                $tot_jumlah_luar_non_op_2014 += $jumlah_luar_non_2014;
                $tot_jumlah_luar_non_op_2013 += $jumlah_luar_non_2013;
            }
        }
    ?>
        <tr>
            <td>&nbsp;</td>
            <td align="right">Jumlah Pengeluaran Non Operasi</td>
            <td align="center"><?php echo angka_positif_rp($tot_jumlah_luar_non_op_2015); ?></td>
            <td align="center"><?php echo angka_positif_rp($tot_jumlah_luar_non_op_2014); ?></td>
            <td align="center"><?php echo angka_positif_rp($tot_jumlah_luar_non_op_2013); ?></td>
            <td align="center">
                <?php
                    $tot_jumlah_luar_non1 = $tot_jumlah_luar_non_op_2015-$tot_jumlah_luar_non_op_2014;
                    echo angka_positif_rp($tot_jumlah_luar_non1);
                ?>
            </td>
            <td align="center">
                <?php
                    $tot_persen_luar_non1 = $tot_jumlah_luar_non_op_2015-$tot_jumlah_luar_non_op_2014;
                    echo angka_positif($tot_persen_luar_non1);
                ?>
            </td>
            <td align="center">
                <?php
                    $tot_jumlah_luar_non2 = $tot_jumlah_luar_non_op_2015-$tot_jumlah_luar_non_op_2013;
                    echo angka_positif_rp($tot_jumlah_luar_non2);
                ?>
            </td>
            <td align="center">0</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="center"><b>Jumlah Pengeluaran Kas</b></td>
            <td align="center">
                <?php 
                    $total_pengeluaran_2015 = $tot_jumlah_luar_2015+$tot_jumlah_luar_non_op_2015;
                    echo angka_positif_rp($total_pengeluaran_2015); 
                ?>
            </td>
            <td align="center">
                <?php
                    $total_pengeluaran_2014 = $tot_jumlah_luar_2014+$tot_jumlah_luar_non_op_2014;
                    echo angka_positif_rp($total_pengeluaran_2014); 
                ?>
            </td>
            <td align="center">
                <?php
                    $total_pengeluaran_2013 = $tot_jumlah_luar_2013+$tot_jumlah_luar_non_op_2013;
                    echo angka_positif_rp($total_pengeluaran_2013); 
                ?>
            </td>
            <td align="center">
                <?php
                    $total_pengeluaran_jumlah1 = $total_pengeluaran_2015-$total_pengeluaran_2014;
                    echo angka_positif_rp($total_pengeluaran_jumlah1); 
                ?>
            </td>
            <td align="center">
                <?php
                    $persen_pengeluaran1 = 0;
                    if($total_pengeluaran_jumlah1 != 0){
                        $persen_pengeluaran1 = ($total_pengeluaran_jumlah1/$total_pengeluaran_2014)*100;
                    }
                    echo angka_positif($persen_pengeluaran1);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_pengeluaran_jumlah2 = $total_pengeluaran_2015-$total_pengeluaran_2013;
                    echo angka_positif_rp($total_pengeluaran_jumlah2); 
                ?>
            </td>
            <td align="center">
                <?php
                    $persen_pengeluaran2 = 0;
                    if($total_pengeluaran_jumlah2 != 0){
                        $persen_pengeluaran2 = ($total_pengeluaran_jumlah2/$total_pengeluaran_2013)*100;
                    }
                    echo angka_positif($persen_pengeluaran2);
                ?>
            </td>
        </tr>
        <!-- KENAIKAN / PENURUNAN KAS -->
        <tr>
            <td>III</td>
            <td align="left"><b>KENAIKAN / PENURUNAN KAS</b></td>
            <td align="center">
                <?php 
                    $total_2015 = $total_penerimaan_2015-$total_pengeluaran_2015;
                    echo angka_positif_rp($total_2015); 
                ?>
            </td>
            <td align="center">
                <?php 
                    $total_2014 = $total_penerimaan_2014-$total_pengeluaran_2014;
                    echo angka_positif_rp($total_2014); 
                ?>
            </td>
            <td align="center">
                <?php 
                    $total_2013 = $total_penerimaan_2013-$total_pengeluaran_2013;
                    echo angka_positif_rp($total_2013); 
                ?>
            </td>
            <td align="center">
                <?php 
                    $total_jumlah1 = $total_2015-$total_2014;
                    echo angka_positif_rp($total_jumlah1);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_persen1 = 0;
                    if($total_2014 != 0){
                        $total_persen1 = ($total_jumlah1/$total_2014)*100;
                    }
                    echo angka_positif($total_persen1);
                ?>
            </td>
            <td align="center">
                <?php 
                    $total_jumlah2 = $total_2015-$total_2013;
                    echo angka_positif_rp($total_jumlah2);
                ?>
            </td>
            <td align="center">
                <?php
                    $total_persen2 = 0;
                    if($total_2013 != 0){
                        $total_persen2 = ($total_jumlah2/$total_2013)*100;
                    }
                    echo angka_positif($total_persen2);
                ?>
            </td>
        </tr>
        <!-- SALDO AWAL -->
    <?php
        $sa_akhir_2015 = 0;
        $sa_akhir_2013 = 0;
        $sa_2014 = 0;
        $sa_2013 = 0;
        $sa_2015 = 0;

        foreach ($arus2 as $data_detil) {
            if($data_detil->JENIS == "Saldo Awal"){
                $sa_2014 = $data_detil->JUMLAH_2014;
                $sa_2013 = $data_detil->JUMLAH_2013;
                $sa_2015 = $sa_2014+$total_2014;
                $sa_akhir_2015 = $total_2015+$sa_2015;
                $sa_akhir_2013 = $sa_2013+$total_2013+2;
    ?>
        <tr>
            <td>IV</td>
            <td align="left"><b>SALDO AWAL KAS</b></td>
            <td align="center"><?php echo angka_positif_rp($sa_2015); ?></td>
            <td align="center"><?php echo angka_positif_rp($sa_2014); ?></td>
            <td align="center"><?php echo angka_positif_rp($sa_2013); ?></td>
            <td align="center">
                <?php
                    $sa_jumlah1 = $sa_2015-$sa_2014;
                    echo angka_positif_rp($sa_jumlah1);
                ?>
            </td>
            <td align="center">
                <?php
                    $sa_persen1 = 0;
                    if($sa_jumlah1 != 0){
                        $sa_persen1 = ($sa_jumlah1/$sa_2014)*100;
                    }
                    echo angka_positif($sa_persen1);
                ?>
            </td>
            <td align="center">
                <?php
                    $sa_jumlah2 = $sa_2015-$sa_2013;
                    echo angka_positif_rp($sa_jumlah2);
                ?>
            </td>
            <td align="center">
                <?php
                    $sa_persen2 = 0;
                    if($sa_jumlah2 != 0){
                        $sa_persen2 = ($sa_jumlah2/$sa_2013)*100;
                    }
                    echo angka_positif($sa_persen2);
                ?>
            </td>
        </tr>
    <?php
            }
        }
    ?>
        <tr>
            <td>V</td>
            <td align="left"><b>SALDO AKHIR KAS</b></td>
            <td align="center"><?php echo angka_positif_rp($sa_akhir_2015); ?></td>
            <td align="center"><?php echo angka_positif_rp($sa_2015); ?></td>
            <td align="center"><?php echo angka_positif_rp($sa_akhir_2013); ?></td>
            <td align="center">
                <?php
                    $sa_akhir_jumlah1 = $sa_akhir_2015-$sa_2015;
                    echo angka_positif_rp($sa_akhir_jumlah1);
                ?>
            </td>
            <td align="center">
                <?php
                    $sa_akhir_persen1 = 0;
                    if($sa_akhir_jumlah1 != 0){
                        $sa_akhir_persen1 = ($sa_akhir_jumlah1/$sa_2015)*100;
                    }
                    echo angka_positif($sa_akhir_persen1);
                ?>
            </td>
            <td align="center">
                <?php
                    $sa_akhir_jumlah2 = $sa_akhir_2015-$sa_akhir_2013;
                    echo angka_positif_rp($sa_akhir_jumlah2);
                ?>
            </td>
            <td align="center">
                <?php
                    $sa_akhir_persen2 = 0;
                    if($sa_akhir_jumlah2 != 0){
                        $sa_akhir_persen2 = ($sa_akhir_jumlah2/$sa_akhir_2013)*100;
                    }
                    echo angka_positif($sa_akhir_persen2);
                ?>
            </td>
        </tr>
    </tbody>
</table>

<?PHP
    exit();
?>