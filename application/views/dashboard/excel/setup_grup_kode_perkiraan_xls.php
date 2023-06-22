<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Data_grup_koper.xls");
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
                        Data Grup Kode Perkiraan PDAM Tirta Patriot Bekasi
                    </h3>
                </td>
            </tr>
        </table> 

        <br><br>

        <table align="center" class="grid">
            <thead>
                <tr>
                    <th class="kolom_header" style="vertical-align: middle;">KODE GRUP</th>
                    <th class="kolom_header" style="vertical-align: middle;">KODE SUB</th>
                    <th class="kolom_header" style="vertical-align: middle;">GRUP</th>
                    <th class="kolom_header" style="vertical-align: middle;">SUB GRUP 1</th>
                    <th class="kolom_header" style="vertical-align: middle;">SUB GRUP 2</th>
                    <th class="kolom_header" style="vertical-align: middle;">SUB GRUP 3</th>
                </tr>
            </thead>  
            <tbody>
                <?PHP 
                    foreach ($dt as $key => $row) {
                ?>
                <tr style="cursor:pointer;">
                    <td align="center" class="isi_table"><?=$row->KP_GRUP;?></td>
                    <td align="center" class="isi_table"><?=$row->KP_SUB;?></td>
                    <td class="isi_table"><?=$row->GRUP;?></td>
                    <td class="isi_table"><?=$row->SUB_GRUP1;?></td>
                    <td class="isi_table"><?=$row->SUB_GRUP2;?></td>
                    <td class="isi_table"><?=$row->SUB_GRUP3;?></td>
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

