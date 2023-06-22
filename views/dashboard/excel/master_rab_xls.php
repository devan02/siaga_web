<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Data_RAB.xls");
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
                Data RAB PDAM Tirta Patriot Bekasi
            </h3>
        </td>
    </tr>
</table> 

<br><br>

<table align="center" class="grid">
    <thead>
        <tr>
            <th class="kolom_header" style="vertical-align: middle;">#</th>
            <th class="kolom_header" style="vertical-align: middle;">NO RAB</th>
            <th class="kolom_header" style="vertical-align: middle;">JENIS RAB</th>
            <th class="kolom_header" style="vertical-align: middle;">TAHUN</th>
            <th class="kolom_header" style="vertical-align: middle;">KEGIATAN</th>
            <th class="kolom_header" style="vertical-align: middle;">PEKERJAAN</th>
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
            <td class="isi_table"><?=$row->NO_RAB;?></td>
            <td class="isi_table"><?=ucfirst($row->JENIS);?></td>
            <td class="isi_table"><?=$row->TAHUN;?></td>
            <td class="isi_table" style="width:250px;"><?=$row->KEGIATAN;?></td>
            <td class="isi_table" style="width:250px;"><?=$row->PEKERJAAN;?></td>
        </tr>
        <?PHP } ?>
    </tbody>
</table>

<?PHP
exit();
?>