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
            <td colspan="18" align="center"><b>Tidak Ada Data</b></td>
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