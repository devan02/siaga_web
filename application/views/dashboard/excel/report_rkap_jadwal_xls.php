<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan-RKAP-Terjadwal.xls");
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
}
</style>
        

        <img src="<?=base_url();?>files/pdam/kop_surat.png" width="600" alt="KOP PDAM">

        <br><br><br><br><br><br>

        <table align="left">
            <tr>
                <td style="text-align:left;" colspan="5">
                    <h3 style="font-family:Arial; font-weight:normal; line-height:1.6;">
                        RENCANA KERJA DAN ANGGARAN PERUSAHAAN <br>
                         <?=$ket;?> <br>
                         TAHUN ANGGARAN : <?=$thn;?>
                    </h3>
                </td>
            </tr>

        </table>           
        

        <br><br>

        <table align="center" class="grid">
        <thead>
            <tr>
                <th class="kolom_header" style="width:30px;">No</th>
                <th class="kolom_header">Perkiraan</th>
                <th class="kolom_header">Uraian</th>
                <th class="kolom_header">Sub Bagian</th>
                <th class="kolom_header" style="width:80px;">Vol Usulan</th>
                <th class="kolom_header" style="width:80px;">Vol Setuju</th>
                <th class="kolom_header">Satuan</th>
                <th class="kolom_header">Biaya Usulan</th>
                <th class="kolom_header">RKAP <?=$thn;?></th>
                <th class="kolom_header">Ket</th>

                <th class="kolom_header">Jan</th>
                <th class="kolom_header">Feb</th>
                <th class="kolom_header">Mar</th>
                <th class="kolom_header">Apr</th>
                <th class="kolom_header">Mei</th>
                <th class="kolom_header">Jun</th>
                <th class="kolom_header">Jul</th>
                <th class="kolom_header">Agt</th>
                <th class="kolom_header">Sep</th>
                <th class="kolom_header">Okt</th>
                <th class="kolom_header">Nov</th>
                <th class="kolom_header">Des</th>
            </tr>
        </thead>    
        <tbody>
            <?php
            $no = 1;
            $total_semua1 = 0;
            $total_semua2 = 0;

            $old_judul = "";
            $old_judul2 = "";
            $next_judul1 = "";
            $next_judul2 = "";

            $last_key   = end(array_keys($koper));

            $total_all1 = 0;
            $total_all2 = 0;

            foreach ($koper as $key => $row) {

                    echo "<tr>";
                    echo "<td class='isi_table' colspan='22' style='padding-left:10px;'></td>" ;
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
                        echo "<td class='isi_table' colspan='22' style='padding-left:7px;'><b>".$row->INDUK_KODE." - ".$row->NAMA_PERKIRAAN2."</b></td>" ;
                        echo "</tr>";
                    }

            ?>
            <tr>
                <td class="isi_table" colspan="22" style="padding-left:15px;"><?php echo $row->KODE_PERKIRAAN." - ".$row->NAMA_PERKIRAAN; ?></td>
            </tr>
            <?php 
                $data_detil = $data_detil = $this->model->get_report_rinci($row->KODE_PERKIRAAN,$thn,$krit,$dep,$div);
                $total_rkap = 0;
                $total_rkap1 = 0;
                $ket = '';

                foreach ($data_detil as $row_detil) {

                if($row_detil->SETUJU == "DISETUJUI" ){
                    $ket = "Disetujui";
                } else {
                    $ket = "Tidak Disetujui";
                }


                    $biaya_usulan = $row_detil->BIAYA_USULAN;
                    $rkap = $row_detil->TOTAL + $row_detil->TOTAL_PELAKSANAAN;
                    $vol_usulan = $row_detil->VOL_USULAN;
                    $jumlah = $row_detil->JUMLAH;
                    $vol_rkap = $row_detil->JUMLAH;

                    if($vol_usulan == null || $vol_usulan == ""){
                        $vol_usulan = $row_detil->JUMLAH;
                        $vol_rkap   = 0;
                        $biaya_usulan = $row_detil->TOTAL + $row_detil->TOTAL_PELAKSANAAN;
                        $rkap = 0;
                    }

                    if($vol_rkap == 0){
                        $vol_rkap = $vol_usulan;
                        $rkap = $biaya_usulan;
                    }


            ?>    
            <tr>
                <td class="isi_table" style="text-align:center; width:10px;"><?php echo $no++; ?></td>
                <td class="isi_table"><?php echo $row_detil->KODE_ANGGARAN; ?></td>
                <td class="isi_table"><?php echo $row_detil->URAIAN; ?></td>
                <td class="isi_table" style="text-align:center;"><?php echo $row_detil->NAMA_DIVISI; ?></td>
                <td class="isi_table" style="text-align:center;"><?php echo $vol_usulan; ?></td>
                <td class="isi_table" style="text-align:center;"><?php echo $vol_rkap; ?></td>
                <td class="isi_table" style="text-align:center;"><?php echo $row_detil->SATUAN; ?></td>
                <td class="isi_table" style="text-align:center;"><?php echo "Rp. ".number_format($biaya_usulan, 2, ",", "."); ?></td>
                <td class="isi_table" style="text-align:center;"><?php echo "Rp. ".number_format($rkap, 2, ",", "."); ?></td>
                <td class="isi_table" style="text-align:center;"><?php echo $ket; ?></td>

                <td class="isi_table" style="text-align:center;"><?php echo "Rp. ".number_format($row_detil->JANUARI, 2, ",", "."); ?></td>
                <td class="isi_table" style="text-align:center;"><?php echo "Rp. ".number_format($row_detil->FEBRUARI, 2, ",", "."); ?></td>
                <td class="isi_table" style="text-align:center;"><?php echo "Rp. ".number_format($row_detil->MARET, 2, ",", "."); ?></td>
                <td class="isi_table" style="text-align:center;"><?php echo "Rp. ".number_format($row_detil->APRIL, 2, ",", "."); ?></td>
                <td class="isi_table" style="text-align:center;"><?php echo "Rp. ".number_format($row_detil->MEI, 2, ",", "."); ?></td>
                <td class="isi_table" style="text-align:center;"><?php echo "Rp. ".number_format($row_detil->JUNI, 2, ",", "."); ?></td>
                <td class="isi_table" style="text-align:center;"><?php echo "Rp. ".number_format($row_detil->JULI, 2, ",", "."); ?></td>
                <td class="isi_table" style="text-align:center;"><?php echo "Rp. ".number_format($row_detil->AGUSTUS, 2, ",", "."); ?></td>
                <td class="isi_table" style="text-align:center;"><?php echo "Rp. ".number_format($row_detil->SEPTEMBER, 2, ",", "."); ?></td>
                <td class="isi_table" style="text-align:center;"><?php echo "Rp. ".number_format($row_detil->OKTOBER, 2, ",", "."); ?></td>
                <td class="isi_table" style="text-align:center;"><?php echo "Rp. ".number_format($row_detil->NOVEMBER, 2, ",", "."); ?></td>
                <td class="isi_table" style="text-align:center;"><?php echo "Rp. ".number_format($row_detil->DESEMBER, 2, ",", "."); ?></td>
            </tr>
            <?php 
                $total_rkap = $total_rkap + $biaya_usulan;
                $total_rkap1 = $total_rkap1 + $rkap;
                
                $total_semua1 += $biaya_usulan;
                $total_semua2 += $rkap;

                $total_all1 += $biaya_usulan;
                $total_all2 += $rkap;
                }
            ?>
            <tr>
                <td class="isi_table" colspan="7">Sub Total Biaya Usulan & RKAP </td>
                <td class="isi_table"><?php echo "Rp. ".str_replace(',', '.', number_format($total_rkap, 2, ",", ".")) ;?></td>
                <td class="isi_table"><?php echo "Rp. ".str_replace(',', '.', number_format($total_rkap1, 2, ",", ".")) ;?></td>
                <td class="isi_table" colspan="13"><b></b></td>
            </tr>

            <?php       
            
            if ($key < $last_key) {
            $k          = $key + 1;
            $next_judul1    = $koper[$k]->INDUK_KODE ;
            }
            else{
                $next_judul1    = "" ;
            }

            if ($judul1 != $next_judul1) { ?>

            <tr>
                <td class="isi_table" colspan="7"><b>Total <?=$row->INDUK_KODE." - ".$row->NAMA_PERKIRAAN2;?> </b></td>
                <td class="isi_table"><b><?php echo "Rp. ".str_replace(',', '.', number_format($total_semua1, 2, ",", ".")) ;?></b></td>
                <td class="isi_table"><b><?php echo "Rp. ".str_replace(',', '.', number_format($total_semua2, 2, ",", ".")) ;?></b></td>
                <td class="isi_table" colspan="13"><b></b></td>
            </tr>

            <?PHP 

            $total_semua1 = 0;
            $total_semua2 = 0;
                }
            }
            ?>

            <tr>
                <td class="isi_table" colspan='22' style='padding-left:10px;'></td>
            </tr>
            
            <tr>
                <td class="isi_table" colspan="7" style="height:40px;"><b> TOTAL </b></td>
                <td class="isi_table"><b><?php echo "Rp. ".str_replace(',', '.', number_format($total_all1, 2, ",", ".")) ;?></b></td>
                <td class="isi_table"><b><?php echo "Rp. ".str_replace(',', '.', number_format($total_all2, 2, ",", ".")) ;?></b></td>
                <td class="isi_table" colspan="13"><b></b></td>
            </tr>  
        </tbody>

    </table>



<?php
exit()
?>
