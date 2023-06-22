<style type="text/css">
    #datatable3_filter{
       margin-right: 15px;
       margin-top: 10px;
    }

    #datatable3_info{
       margin-left: 10px;
    }

    #datatable3_paginate .pagination{
       margin-right: 10px;
    }
</style>

<div class="row">
<div class="col-md-12">
    <div class="panel panel-visible">
        <div class="panel-heading">
            <div class="panel-title hidden-xs">
                <span class="glyphicon glyphicon-tasks"></span>Monitoring Aktifitas Pengguna</div>
        </div>
        <div class="panel-body pn">
            <table class="table table-bordered table-hover" id="datatable3" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="vertical-align: middle;">#</th>
                        <th style="vertical-align: middle;">Username / Nama Pengguna</th>
                        <th style="vertical-align: middle;">WAKTU</th>
                        <th style="vertical-align: middle; width: 550px;">KEGIATAN</th>
                        <th style="vertical-align: middle;">IP ADDRESS</th>
                </thead>
                <tbody>
                    <?PHP 
                    $nom = 0;
                    $dt_log = $this->model->get_log_user();
                        foreach ($dt_log as $key => $log) {
                        $nom++;
                    ?>
                    <tr style="cursor:pointer;">
                        <td><?=$nom;?></td>

                        <td>
                            <b><?PHP echo $log->USERNAME; ?></b> <br>
                            <?PHP echo $log->NAMA_PEGAWAI; ?> 
                        </td>

                        <td>
                            <?PHP echo datetostr($log->TANGGAL); ?> <br>
                            <i><?PHP echo $log->JAM; ?> WIB  </i>
                        </td>

                        <td>
                            <?=$log->KEGIATAN;?> 
                            <b><?=$log->MODUL;?></b> 
                            <?=$log->KEGIATAN2;?>  
                            <b><?=$log->OBJEK;?></b>
                        </td>

                        <td><?=$log->IP_ADDR;?></td>
                    </tr>
                    <?PHP } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>