<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Data_Sub_Bagian.xls");
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
                        Data Sub Bagian PDAM Tirta Patriot Bekasi
                    </h3>
                </td>
            </tr>
        </table> 

        <br><br>

        <table align="center" class="grid">
            <thead>
                <tr>
                    <th class="kolom_header" style="vertical-align: middle; text-align:center;">#</th>
                    <th class="kolom_header" style="vertical-align: middle;">BAGIAN</th>
                    <th class="kolom_header" style="vertical-align: middle;">KODE SUB BAGIAN</th>
                    <th class="kolom_header" style="vertical-align: middle;">NAMA SUB BAGIAN</th>
                    <th class="kolom_header" style="vertical-align: middle;">KETERANGAN</th>
                    <th class="kolom_header" style="vertical-align: middle;">STATUS</th>
                </tr>
            </thead>  
            <tbody>
                <?PHP 
                    $no = 0;
                    foreach ($dt as $key => $row) {
                        $no++;
                ?>
                <tr style="cursor:pointer;">
                    <td class="isi_table" style="text-align:center;"><?=$no;?></td>
                    <td class="isi_table"><?=$row->BAGIAN;?></td>
                    <td class="isi_table"><?=$row->KODE==""?"-":$row->KODE;?></td>
                    <td class="isi_table"><?=$row->NAMA;?></td>
                    <td class="isi_table"><?=$row->KETERANGAN==""?"-":$row->KETERANGAN;?></td>
                    <td class="isi_table"><?=$row->AKTIF==1?"Aktif":"Tidak Aktif";?></td>
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
    exit();
?>

