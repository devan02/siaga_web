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

        <table align="center">
            <tr>
                <td>
                    <img src="<?=base_url();?>files/pdam/logo-pdamtp.png" width="110" height="100" alt="KOP PDAM">
                </td>
                <td><img src="<?=base_url();?>files/pdam/kosong.png" width="160" height="100" alt="KOP PDAM"></td>
                <td>
                    <img src="<?=base_url();?>files/pdam/KOP_tulisan.png" width="550" height="100" alt="KOP PDAM">
                </td>
                <td><img src="<?=base_url();?>files/pdam/kosong.png" width="320" height="100" alt="KOP PDAM"></td>
                <td>
                    <img src="<?=base_url();?>files/pdam/logo_perpamsi_glossy.png" width="160" height="100" alt="KOP PDAM">
                </td>
            </tr>
        </table>
        
        <hr>

        <table align="center">
            <tr>
                <td style="text-align:center;">
                    <h2 style="font-family:Arial; font-weight:normal; line-height:1.6;">
                        Data SPM PDAM Tirta Patriot Bekasi
                    </h2>
                </td>
            </tr>

        </table>

        <br><br>

        <table align="center" class="grid">
            <thead>
                <tr>
                    <th style="vertical-align: middle;">NO SPM</th>
                    <th style="vertical-align: middle;">TANGGAL</th>
                    <th style="vertical-align: middle;">KETERANGAN</th>
                    <th style="vertical-align: middle;">NILAI SPM</th>
                </tr>
            </thead>  
            <tbody>
                <?PHP 
                    foreach ($dt as $key => $row) {
                ?>
                <tr style="cursor:pointer;">
                    <td style="width:200px;"><?=$row->NO_SPM;?></td>
                    <td><?=$row->TGL_SPM;?></td>
                    <td style="width:300px;"><?=$row->KET;?></td>
                    <td>Rp. <?=str_replace(',', '.', number_format($row->NILAI));?></td>
                </tr>
                <?PHP } ?>
            </tbody>

        </table>

<?PHP 
    function format_akuntansi($val){

        $val = str_replace('.', '', $val);
        $val = floatval($val);

        if($val < 0){
            $val = $val * -1;
            $val = "(".str_replace(',', '.', number_format($val)).")";
        } else {
            $val = str_replace(',', '.', number_format($val));
        }

        return $val;
    }
    
?>

<?PHP
    $content = ob_get_clean();
    // require_once "localhost/siaga/material/fpdf/html2pdf.class.php";
    $html2pdf = new HTML2PDF('L','A4','fr');
    $html2pdf->pdf->SetTitle("Data SPM PDAM Tirta Patriot Bekasi");
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('data_SPM.pdf');
?>

