<?PHP ob_start(); ?>

<style>
.grid {
    border: 1px solid #000;
    table-layout: fixed;
    border-collapse: collapse;
}

.grid td {
	border: 1px solid #000;
    text-align: left;
    padding: 5px 5px 5px 5px;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

#wrapper {width:auto ;}
#left{
float:left;
width:65%;
background:orange;

}
#right{
background:red;
float:right;

}

.clear {clear:both;}
</style>

<table align="center">
    <tr>
        <td>
            <img src="<?=base_url();?>files/pdam/logo-pdamtp.png" width="70" height="70" alt="KOP PDAM">
        </td>
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="100" height="90" alt="KOP PDAM"></td>
        <td>
            <img src="<?=base_url();?>files/pdam/KOP_tulisan.png" width="350" height="70" alt="KOP PDAM">
        </td>
        <td><img src="<?=base_url();?>files/pdam/kosong.png" width="100" height="90" alt="KOP PDAM"></td>
        <td>
            <img src="<?=base_url();?>files/pdam/logo_perpamsi_glossy.png" width="100" height="70" alt="KOP PDAM">
        </td>
    </tr>
</table>

<hr>

<table align="center">
    <tr>
        <td align="center">
            <h3><u><?php echo $title; ?></u></h3>
        </td>
    </tr>
</table>

<br/>

<?PHP 
	$no_bukti = $surat_atas->NO_BUKTI;
	if($no_bukti == ""){
		$no_bukti = "Lain - lain";
	}
?>

<table align="left">
    <tr>
        <td style="vertical-align: middle;">No. Surat</td>
        <td style="vertical-align: middle;">:</td>
        <td style="vertical-align: middle;"><?php echo $surat_atas->NO_SURAT; ?></td>
    </tr>
    <tr>
        <td style="vertical-align: middle;">No. Bukti</td>
        <td style="vertical-align: middle;">:</td>
        <td style="vertical-align: middle;"><?php echo $no_bukti; ?></td>
    </tr>
    <tr>
        <td style="vertical-align: middle;">Tanggal</td>
        <td style="vertical-align: middle;">:</td>
        <td style="vertical-align: middle;"><?php echo $surat_atas->TANGGAL; ?></td>
    </tr>
</table>

<br/>

<table class="grid">
	<tr>
		<td width="30" align="center" style="vertical-align: middle;">1</td>
		<td width="650" style="vertical-align: middle;">Program Biaya <?php echo $surat_atas->PROGRAM_BIAYA; ?></td>
	</tr>
	<tr>
		<td width="30" align="center" style="vertical-align: middle;">2</td>
		<td width="650" style="vertical-align: middle;">Alasan Permintaan <?php echo $surat_atas->ALASAN; ?></td>
	</tr>
	<tr>
		<td width="30" align="center">&nbsp;</td>
		<td width="650" height="150">
			<p style="top:0px; right:0px; margin-left:400px;">
				<p style="width:150px; text-align:center;">
					Dibuat Oleh,<br/>
					<br/>
					<br/><br/><br/><br/>
					DHOFIRI, S.Si<br/>
					102 306 049
				</p>
			</p>
		</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="30">&nbsp;</td>
		<td width="650" align="center" style="vertical-align: middle;">KONFIRMASI BAGIAN KEUANGAN</td>
	</tr>
	<tr>
		<td width="30">&nbsp;</td>
		<td width="650" height="200">
			<div>
				<img src="<?php echo base_url(); ?>images/rectangle.png" width="30" height="20">
				Tidak termasuk dalam RKAP Tahun _____________________
			</div>
			<br/>
			<div>
				<img src="<?php echo base_url(); ?>images/rectangle.png" width="30" height="20">
				Melebihi Anggaran
			</div>
			<br/>
			<div>
				<img src="<?php echo base_url(); ?>images/rectangle.png" width="30" height="20">
				Dapat / Tidak dapat di mutasi ke anggaran lain karena ________________________________________<br/>
				________________________________________________________________________________________ <br><br>

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				Mengetahui <br><br>

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Kabag Keuangan
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Kasubag Keuangan

				<br><br><br><br><br><br>

				MUHAMAD IMANNUDIN, SE

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				DHOFIRI, S.Si
			</div>
			<br/>
			<div id="wrapper" class="clear">
				<!-- <div id="left">Left side div</div>  
				<div id="right">Right side div</div> -->
			</div>
		</td>
	</tr>
	
	<tr>
		<td width="30">&nbsp;</td>
		<td width="650" align="center" style="vertical-align: middle;">PERSETUJUAN DIREKSI</td>
	</tr>
	<tr>
		<td width="30" align="center">&nbsp;</td>
		<td width="650" height="150">
			<p style="top:0px; right:0px;">
				<p style="width:150px; text-align:center;">
					Menyetujui/Tidak Menyetujui program tersebut<br/>
					Direktur Utama<br/>
					<br/><br/><br/><br/><br/>
					TUBAGUS HENDY IRAWAN.,H., SE
				</p>
			</p>
		</td>
	</tr>
</table>
<?PHP
    // $content = ob_get_clean();
    // $width_in_inches = 21.60;
    // $height_in_inches = 27.90;
    // $width_in_mm = $width_in_inches * 25.4;
    // $height_in_mm = $height_in_inches * 25.4;
    // $html2pdf = new HTML2PDF('L',array($width_in_mm,$height_in_mm),'en');
    // $html2pdf->pdf->SetTitle("Izin Penggunaan Biaya Diluar Anggaran");
    // $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    // $html2pdf->Output('laporan_biaya_luar_anggaran.pdf');

    $content = ob_get_clean();
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->pdf->SetTitle("Izin Penggunaan Biaya Diluar Anggaran");
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('laporan_biaya_luar_anggaran.pdf');
?>