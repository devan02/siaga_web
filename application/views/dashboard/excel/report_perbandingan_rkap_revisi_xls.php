<?PHP  
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=laporan_perbandingan_excel.xls");
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

<!-- <table align="center">
    <tr>
        <td>
            <img src="<?=base_url();?>files/pdam/logo-pdamtp.png" width="110" height="90" alt="KOP PDAM">
        </td>
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="420" height="90" alt="KOP PDAM"></td>
        <td>
            <img src="<?=base_url();?>files/pdam/KOP_tulisan.png" width="550" height="90" alt="KOP PDAM">
        </td>
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="420" height="90" alt="KOP PDAM"></td>
        <td>
            <img src="<?=base_url();?>files/pdam/logo_perpamsi_glossy.png" width="160" height="90" alt="KOP PDAM">
        </td>
    </tr>
</table>

<hr> -->

<table align="center">
    <tr>
        <td style="text-align:center;" colspan="8">
            <h3>
                <?php echo $title; ?><br/>
                <?php echo $title2; ?><br/>
                TAHUN <?php echo $tahun;?>
            </h3>
        </td>
    </tr>
</table>

<br/>

<table class="grid">
    <thead>
        <tr>
            <th>NO. ANGGARAN</th>
            <th>URAIAN</th>
            <th>SUB BAGIAN</th>
            <th>VOLUME</th>
            <th>SATUAN</th>
            <th>HARGA</th>
            <th>RKAP</th>
            <th>REVISI</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $old_judul = "";
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

            if($old_judul != $judul1){
                $old_judul  = $judul1;
    ?>
        <tr>
            <td colspan="8"><b><?php echo $koper->INDUK_KODE." - ".$koper->NAMA_PERKIRAAN2; ?></b></td>
        </tr>
    <?php            
            }
    ?>
        <tr>
            <td colspan="8"><b><?php echo $koper->KODE_PERKIRAAN." - ".$koper->NAMA_PERKIRAAN; ?></b></td>
        </tr>
        <?php
            $data_detil = $this->model->get_perbandingan_rkap_revisi($koper->KODE_PERKIRAAN,$tahun);
            foreach ($data_detil as $row_detil) {
        ?>
            <tr>
                <td><?php echo $row_detil->KODE_ANGGARAN; ?></td>
                <td><?php echo $row_detil->URAIAN; ?></td>
                <td align="center"><?php echo $row_detil->NAMA_SUB_BAGIAN; ?></td>
                <td align="center"><?php echo $row_detil->JUMLAH; ?></td>
                <td align="center"><?php echo $row_detil->SATUAN; ?></td>
                <td><?php echo "Rp. ".number_format($row_detil->HARGA,2,',','.'); ?></td>
                <td align="left"><?php echo "Rp. ".number_format($row_detil->RKAP,2,',','.'); ?></td>
                <td align="left"><?php echo "Rp. ".number_format($row_detil->RKAP_REVISI,2,',','.'); ?></td>
            </tr>
        <?php
            }
        ?>
    <?php
        }
    ?>
    </tbody>
</table>
<?PHP
   exit();
?>