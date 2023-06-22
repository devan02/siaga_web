<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan-Rencana-Pembelian.xls");
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
                        RENCANA PENGELUARAN OPERASI LAINNYA TAHUN ANGGARAN : <?=$thn;?> (<?=$ket_periode;?>)
                    </h3>
                </td>
            </tr>

        </table>           
        

        <br><br>

        <table align="center" class="grid">
            <thead>
                <tr>
                    <th class="kolom_header" rowspan="2"> NO</th>
                    <th class="kolom_header" rowspan="2"> URAIAN </th>
                    <th class="kolom_header" colspan="12"> BULAN </th>
                    <th class="kolom_header" rowspan="2"> JUMLAH </th>

                    <th class="kolom_header" rowspan="2"> ESTIMASI TAHUN <?=$thn-1;?> </th>
                    <th class="kolom_header" colspan="2"> MENAIK / (MENURUN) </th>
                </tr>
                <tr>
                    <th class="kolom_header"> Januari </th>
                    <th class="kolom_header"> Pebruari </th>
                    <th class="kolom_header"> Maret </th>
                    <th class="kolom_header"> April </th>
                    <th class="kolom_header"> Mei </th>
                    <th class="kolom_header"> Juni </th>
                    <th class="kolom_header"> Juli </th>
                    <th class="kolom_header"> Agustus </th>
                    <th class="kolom_header"> September </th>
                    <th class="kolom_header"> Oktober </th>
                    <th class="kolom_header"> Nopember </th>
                    <th class="kolom_header"> Desember </th>
                    <th class="kolom_header">JUMLAH </th>
                    <th class="kolom_header">% </th>
                </tr>
            </thead>
            <tbody>
                
                <?PHP 
                $jml_susut_now  = str_replace(',', '.', $susut_now->JML);
                $jml_susut_lalu = str_replace(',', '.', $susut_lalu->JML);
                $jml_susut_lalu2 = str_replace(',', '.', $susut_lalu2->JML);

                $jml_susut = $jml_susut_now + $jml_susut_lalu;
                $jml_susut_per_bln = $jml_susut/12;

                $totJAN = $biaya_opr->JAN + $biaya_adm->JAN + $jml_susut_per_bln + $biaya_luar->JAN ;
                $totFEB = $biaya_opr->FEB + $biaya_adm->FEB + $jml_susut_per_bln + $biaya_luar->FEB ;
                $totMAR = $biaya_opr->MAR + $biaya_adm->MAR + $jml_susut_per_bln + $biaya_luar->MAR ;
                $totAPR = $biaya_opr->APR + $biaya_adm->APR + $jml_susut_per_bln + $biaya_luar->APR ;
                $totMEI = $biaya_opr->MEI + $biaya_adm->MEI + $jml_susut_per_bln + $biaya_luar->MEI ;
                $totJUN = $biaya_opr->JUN + $biaya_adm->JUN + $jml_susut_per_bln + $biaya_luar->JUN ;
                $totJUL = $biaya_opr->JUL + $biaya_adm->JUL + $jml_susut_per_bln + $biaya_luar->JUL ;
                $totAGU = $biaya_opr->AGU + $biaya_adm->AGU + $jml_susut_per_bln + $biaya_luar->AGU ;
                $totSEP = $biaya_opr->SEP + $biaya_adm->SEP + $jml_susut_per_bln + $biaya_luar->SEP ;
                $totOKT = $biaya_opr->OKT + $biaya_adm->OKT + $jml_susut_per_bln + $biaya_luar->OKT ;
                $totNOP = $biaya_opr->NOP + $biaya_adm->NOP + $jml_susut_per_bln + $biaya_luar->NOP ;
                $totDES = $biaya_opr->DES + $biaya_adm->DES + $jml_susut_per_bln + $biaya_luar->DES ;
                $totJML = $biaya_opr->JML + $biaya_adm->JML + $jml_susut + $biaya_luar->JML;
                $totJML_LALU1 = $biaya_opr->JML_LALU1 + $biaya_adm->JML_LALU1 + $biaya_luar->JML_LALU1;

                $totJAN2 = $rencana_beli->JAN + $jml_susut_per_bln ;
                $totFEB2 = $rencana_beli->FEB + $jml_susut_per_bln ;
                $totMAR2 = $rencana_beli->MAR + $jml_susut_per_bln ;
                $totAPR2 = $rencana_beli->APR + $jml_susut_per_bln ;
                $totMEI2 = $rencana_beli->MEI + $jml_susut_per_bln ;
                $totJUN2 = $rencana_beli->JUN + $jml_susut_per_bln ;
                $totJUL2 = $rencana_beli->JUL + $jml_susut_per_bln ;
                $totAGU2 = $rencana_beli->AGU + $jml_susut_per_bln ;
                $totSEP2 = $rencana_beli->SEP + $jml_susut_per_bln ;
                $totOKT2 = $rencana_beli->OKT + $jml_susut_per_bln ;
                $totNOP2 = $rencana_beli->NOP + $jml_susut_per_bln ;
                $totDES2 = $rencana_beli->DES + $jml_susut_per_bln ;
                $totJML2 = $rencana_beli->JML + $jml_susut;
                $totJML2_LALU1 = $rencana_beli->JML_LALU1 + $jml_susut_lalu + $jml_susut_lalu2;
                ?>

               <tr>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                </tr>
                
                <tr>
                    <?PHP 
                    $persen = 100;

                    if($biaya_opr->JML_LALU1 > 0){
                        $persen = (($biaya_opr->JML - $biaya_opr->JML_LALU1) / $biaya_opr->JML_LALU1) * 100;
                    } else if($biaya_opr->JML_LALU1 == 0 && $biaya_opr->JML == 0){
                        $persen = 0;
                    }

                    ?>
                    <td class="isi_table" style="text-align:center;">1</td>
                    <td class="isi_table">Rencana Biaya Operasi</td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($biaya_opr->JAN)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($biaya_opr->FEB)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($biaya_opr->MAR)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($biaya_opr->APR)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($biaya_opr->MEI)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($biaya_opr->JUN)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($biaya_opr->JUL)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($biaya_opr->AGU)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($biaya_opr->SEP)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($biaya_opr->OKT)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($biaya_opr->NOP)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($biaya_opr->DES)) ;?></td>
                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($biaya_opr->JML)) ;?></td>

                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_opr->JML_LALU1)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($biaya_opr->JML - $biaya_opr->JML_LALU1))) ;?></td>
                    <td class="isi_table"  text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format($persen))) ;?></td>
                </tr>

                <tr>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                </tr>

                <tr>

                    <?PHP 
                    $persen2 = 100;

                    if($biaya_adm->JML_LALU1 + ($jml_susut_lalu + $jml_susut_lalu2) > 0){
                        $persen2 = (($biaya_adm->JML + $jml_susut - $biaya_adm->JML_LALU1 + ($jml_susut_lalu + $jml_susut_lalu2)) / $biaya_adm->JML_LALU1 + ($jml_susut_lalu + $jml_susut_lalu2)) * 100;
                    } else if($biaya_adm->JML_LALU1 + ($jml_susut_lalu + $jml_susut_lalu2) == 0 && $biaya_adm->JML + $jml_susut == 0){
                        $persen2 = 0;
                    }
                    ?>
                    <td class="isi_table"  style="text-align:center;">2</td>
                    <td class="isi_table">Rencana Biaya Umum & Administrasi</td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_adm->JAN + $jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_adm->FEB + $jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_adm->MAR + $jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_adm->APR + $jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_adm->MEI + $jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_adm->JUN + $jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_adm->JUL + $jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_adm->AGU + $jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_adm->SEP + $jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_adm->OKT + $jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_adm->NOP + $jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_adm->DES + $jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_adm->JML + $jml_susut)) ;?></td>

                    <td class="isi_table" text-align="right"><?=str_replace(',', '.', number_format($biaya_adm->JML_LALU1 + ($jml_susut_lalu + $jml_susut_lalu2) )) ;?></td>
                    <td class="isi_table" text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($biaya_adm->JML + $jml_susut - $biaya_adm->JML_LALU1 + ($jml_susut_lalu + $jml_susut_lalu2) ))) ;?></td>
                    <td class="isi_table"  text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format($persen2))) ;?></td>
                </tr>

                <tr>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                </tr>

                <tr>
                    <?PHP 
                    $persen3 = 100;

                    if($biaya_luar->JML_LALU1 > 0){
                        $persen3 = (($biaya_luar->JML - $biaya_luar->JML_LALU1) / $biaya_luar->JML_LALU1) * 100;
                    } else if($biaya_luar->JML_LALU1 == 0 && $biaya_luar->JML == 0){
                        $persen3 = 0;
                    }
                    ?>
                    <td class="isi_table"  style="text-align:center;">3</td>
                    <td class="isi_table">Rencana Biaya Di Luar Usaha</td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_luar->JAN)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_luar->FEB)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_luar->MAR)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_luar->APR)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_luar->MEI)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_luar->JUN)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_luar->JUL)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_luar->AGU)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_luar->SEP)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_luar->OKT)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_luar->NOP)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_luar->DES)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_luar->JML)) ;?></td>

                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($biaya_luar->JML_LALU1)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($biaya_luar->JML - $biaya_luar->JML_LALU1))) ;?></td>
                    <td class="isi_table"  text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format($persen3))) ;?></td>
                </tr>

                <tr>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                </tr>

                <tr>
                    <?PHP 
                    $persen_tot1 = 100;

                    if($totJML_LALU1 > 0){
                        $persen_tot1 = (($totJML - $totJML_LALU1) / $totJML_LALU1) * 100;
                    } else if($totJML_LALU1 == 0 && $totJML == 0){
                        $persen_tot1 = 0;
                    }
                    ?>
                    <td class="isi_table"  style="text-align:center;"></td>
                    <td class="isi_table"  style="text-align:right;"><b>Jumlah I</b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totJAN)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totFEB)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totMAR)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totAPR)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totMEI)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totJUN)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totJUL)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totAGU)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totSEP)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totOKT)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totNOP)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totDES)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totJML)) ;?></b></td>

                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totJML_LALU1)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=format_akuntansi(str_replace(',', '.', number_format($totJML - $totJML_LALU1))) ;?></b></td>
                    <td class="isi_table"  text-align="center"><b><?=format_akuntansi(str_replace(',', '.', number_format($persen_tot1))) ;?></b></td>
                </tr>

                <tr>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                </tr>

                <tr>
                    <?PHP 
                    $persen4 = 100;

                    if($rencana_beli->JML_LALU1 > 0){
                        $persen4 = (($rencana_beli->JML - $rencana_beli->JML_LALU1) / $rencana_beli->JML_LALU1) * 100;
                    } else if($rencana_beli->JML_LALU1 == 0 && $rencana_beli->JML == 0){
                        $persen4 = 0;
                    }
                    ?>
                    <td class="isi_table"  style="text-align:center;">1</td>
                    <td class="isi_table">Rencana Pembelian</td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($rencana_beli->JAN)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($rencana_beli->FEB)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($rencana_beli->MAR)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($rencana_beli->APR)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($rencana_beli->MEI)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($rencana_beli->JUN)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($rencana_beli->JUL)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($rencana_beli->AGU)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($rencana_beli->SEP)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($rencana_beli->OKT)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($rencana_beli->NOP)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($rencana_beli->DES)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($rencana_beli->JML)) ;?></td>

                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($rencana_beli->JML_LALU1)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($rencana_beli->JML - $rencana_beli->JML_LALU1))) ;?></td>
                    <td class="isi_table"  text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format($persen4))) ;?></td>
                </tr>

                <tr>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                </tr>

                <tr>
                    <td class="isi_table"  style="text-align:center;">2</td>
                    <td class="isi_table">Rencana Biaya Tenaga Kerja</td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>

                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format(0)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format(0))) ;?></td>
                    <td class="isi_table"  text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format(0))) ;?></td>
                </tr>

                <tr>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                </tr>

                <tr>
                    <?PHP 
                    $persen6 = 100;
                    if($jml_susut_lalu + $jml_susut_lalu2 > 0){
                        $persen6 = (($jml_susut - $jml_susut_lalu + $jml_susut_lalu2) / $jml_susut_lalu + $jml_susut_lalu2) * 100;
                    } else if($jml_susut_lalu + $jml_susut_lalu2 == 0 && $jml_susut == 0){
                        $persen6 = 0;
                    }
                    ?>
                    <td class="isi_table"  style="text-align:center;">3</td>
                    <td class="isi_table" >Rencana Biaya Penyusutan dan Amortisasi</td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($jml_susut_per_bln)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($jml_susut)) ;?></td>

                    <td class="isi_table"  text-align="right"><?=str_replace(',', '.', number_format($jml_susut_lalu + $jml_susut_lalu2)) ;?></td>
                    <td class="isi_table"  text-align="right"><?=format_akuntansi(str_replace(',', '.', number_format($jml_susut - ($jml_susut_lalu + $jml_susut_lalu2) ))) ;?></td>
                    <td class="isi_table"  text-align="center"><?=format_akuntansi(str_replace(',', '.', number_format($persen6))) ;?></td>
                </tr>

                <tr>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                    <td class="isi_table"></td>
                </tr>

                <tr>
                    <?PHP 
                    $persen_tot2 = 100;

                    if($totJML2_LALU1 > 0){
                        $persen_tot2 = (($totJML2 - $totJML2_LALU1) / $totJML2_LALU1) * 100;
                    } else if($totJML2_LALU1 == 0 && $totJML2 == 0){
                        $persen_tot2 = 0;
                    }
                    ?>
                    <td class="isi_table"  style="text-align:center;"></td>
                    <td class="isi_table"  style="text-align:right;"><b>Jumlah 2</b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totJAN2)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totFEB2)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totMAR2)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totAPR2)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totMEI2)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totJUN2)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totJUL2)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totAGU2)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totSEP2)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totOKT2)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totNOP2)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totDES2)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totJML2)) ;?></b></td>

                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totJML2_LALU1)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=format_akuntansi(str_replace(',', '.', number_format($totJML2 - $totJML2_LALU1))) ;?></b></td>
                    <td class="isi_table"  text-align="center"><b><?=format_akuntansi(str_replace(',', '.', number_format($persen_tot2))) ;?></b></td>
                </tr>

                <tr>
                    <?PHP 
                    $persen_tot_all = 100;

                    if($totJML_LALU1 + $totJML2_LALU1 > 0){
                        $persen_tot_all = (( ($totJML + $totJML2) - ($totJML_LALU1 + $totJML2_LALU1) ) / $totJML_LALU1 + $totJML2_LALU1) * 100;
                    } else if($totJML_LALU1 + $totJML2_LALU1 == 0 && $totJML + $totJML2 == 0){
                        $persen_tot_all = 0;
                    }
                    ?>

                    <td class="isi_table" style="text-align:center;"></td>
                    <td class="isi_table" style="text-align:right;"><b>Jumlah Pengeluaran Operasi Lainnya ( Jumlah I - II )</b></td>
                    <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJAN + $totJAN2)) ;?></b></td>
                    <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totFEB + $totFEB2)) ;?></b></td>
                    <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totMAR + $totMAR2)) ;?></b></td>
                    <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totAPR + $totAPR2)) ;?></b></td>
                    <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totMEI + $totMEI2)) ;?></b></td>
                    <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJUN + $totJUN2)) ;?></b></td>
                    <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJUL + $totJUL2)) ;?></b></td>
                    <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totAGU + $totAGU2)) ;?></b></td>
                    <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totSEP + $totSEP2)) ;?></b></td>
                    <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totOKT + $totOKT2)) ;?></b></td>
                    <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totNOP + $totNOP2)) ;?></b></td>
                    <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totDES + $totDES2)) ;?></b></td>
                    <td class="isi_table" text-align="right"><b><?=str_replace(',', '.', number_format($totJML + $totJML2)) ;?></b></td>

                    <td class="isi_table"  text-align="right"><b><?=str_replace(',', '.', number_format($totJML_LALU1 + $totJML2_LALU1)) ;?></b></td>
                    <td class="isi_table"  text-align="right"><b><?=format_akuntansi(str_replace(',', '.', number_format( ($totJML - $totJML_LALU1) + ($totJML2 - $totJML2_LALU1) ))) ;?></b></td>
                    <td class="isi_table"  text-align="center"><b><?=format_akuntansi(str_replace(',', '.', number_format($persen_tot_all))) ;?></b></td>
                </tr>


                
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



<?php
exit()
?>

