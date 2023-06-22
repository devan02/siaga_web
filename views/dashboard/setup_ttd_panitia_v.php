<script type="text/javascript" src="<?=base_url();?>material/vendor/jquery/jquery-1.11.1.min.js"></script>
<style>
#popup_ttd {
    width: 100%;
    height: 100%;
    position: fixed;
    background: #000;
    z-index: 9999;
    opacity:0.8;
    filter:alpha(opacity=80); /* For IE8 and earlier */
    visibility:visible;
    top: 0;
    left: 0;
    display: none;
}

.window_ttd {
    width:70%;
    height:auto;
    position: relative;
    padding: 10px;
    margin: 4% auto;
    opacity:1.0;
    filter:alpha(opacity=0); /* For IE8 and earlier */
    background-color: #fff;
}
</style>
<script type="text/javascript">
$(document).ready(function(){

    <?php
        if($msg == 1){
    ?>
        pesan_sukses();
    <?php
        }
    ?>

    <?php
        if($id_lap != 0){
    ?>
        var a = $('#id_lap2').val();
        $('#nama_lap').val(a);
        get_detail_ttd();
    <?php
        }
    ?>

    $('#lihat').click(function(){
        $('#popup_ttd').css('display','block');
        $('#popup_ttd').show();
    });

    $('#pojok').click(function(){
        $('#popup_ttd').css('display','none');
        $('#popup_ttd').hide();
    });
});

function pesan_sukses(){
    var pesan = '<div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div>'+
                '<h4 class="ui-pnotify-title">Berhasil</h4>'+
                '<div class="ui-pnotify-text"><strong>Data berhasil disimpan!</strong></div>';

    $.jGrowl(pesan, { header: '', life:3000 });
}

function get_detail_ttd() {

    $('#head_detail').html('');
    var id_ttd = $('#nama_lap').val();

    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/setup_ttd_panitia_c/get_ttd_detail',
        data : {id_ttd:id_ttd},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){
            $isi = "";
            $jml = res.length;


            if($jml == 0){

            $isi = 
            '<div class="form-group det" style="margin-bottom: 20px;">'+
                '<input id="is_tgl_txt_1" type="hidden"  name="is_tgl_txt[]" value="0">'+
                '<div class="row">'+
                    '<label class="col-md-1 control-label" for="detail_1">1. </label>'+
                    '<div class="col-md-4">'+
                        '<input value="" required placeholder="Masukkan Jabatan TTD" style="cursor:pointer;" type="text" class="form-control pull-right" name="jabatan[]">'+
                    '</div>'+

                    '<div class="col-md-4">'+
                        '<div class="checkbox-custom fill checkbox-primary mb5" style="margin-top: 8px;">'+
                            '<input onclick="change_tgl(1)"; id="is_tgl_1" type="checkbox"  name="is_tgl[]" value="1">'+
                            '<label for="is_tgl_1"> Memakai Tanggal </label>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="row">'+
                    '<label class="col-md-1 control-label" for="detail_1"></label>'+
                    '<div class="col-md-4 admin-form" style="margin-top: 10px;">'+
                        '<div class="smart-widget sm-right smr-50">'+
                           '<label class="field">'+
                                '<input value="" required placeholder="Masukkan Nama Pejabat" style="cursor:pointer;" id="pejabat_nama_1" type="text" class="form-control pull-right" name="pejabat[]">'+
                            '</label>'+
                            '<a onclick="show_pop_peg(1);" class="button" style="height: 39px;">'+
                                '<i class="fa fa-search"></i>'+
                            '</a>'+
                        '</div>'+
                        '<a onclick="add_pejabat();" id="add_pejabat_1" class="btn btn-primary btn-gradient dark" style="font-weight:bold; margin-top: 8px;">'+
                           'Tambah Pejabat'+
                        '</a>'+
                    '</div>'+
                '</div>'+
            '</div>'+

            '<div style="border-top: 1px dashed #ccc; margin-bottom: 34px;"></div>'; 

            } else if($jml == 1){

            $chk2 = "";
            $val_chk2 = 0;
            if(res[i].IS_TGL == 1){
                $chk2 = "checked";
                $val_chk2 = 1;
            }


            $isi = 
                '<div class="form-group det" style="margin-bottom: 20px;">'+
                    '<input id="is_tgl_txt_1" type="hidden"  name="is_tgl_txt[]" value="'+$val_chk2+'">'+
                    '<div class="row">'+
                        '<label class="col-md-1 control-label" for="detail_1">1. </label>'+
                        '<div class="col-md-4">'+
                            '<input value="'+res[i].JABATAN+'" required placeholder="Masukkan Jabatan TTD" style="cursor:pointer;" type="text" class="form-control pull-right" name="jabatan[]">'+
                        '</div>'+

                        '<div class="col-md-4">'+
                            '<div class="checkbox-custom fill checkbox-primary mb5" style="margin-top: 8px;">'+
                                '<input onclick="change_tgl(1);" id="is_tgl_1" '+$chk2+' type="checkbox"  name="is_tgl[]" value="1">'+
                                '<label for="is_tgl_1"> Memakai Tanggal </label>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="row">'+
                        '<label class="col-md-1 control-label" for="detail_1"></label>'+
                        '<div class="col-md-4 admin-form" style="margin-top: 10px;">'+
                            '<div class="smart-widget sm-right smr-50">'+
                               ' <label class="field">'+
                                    '<input value="'+res[i].NAMA+'" required placeholder="Masukkan Nama Pejabat" style="cursor:pointer;" id="pejabat_nama_1" type="text" class="form-control pull-right" name="pejabat[]">'+
                                '</label>'+
                                '<a onclick="show_pop_peg(1);" class="button" style="height: 39px;">'+
                                    '<i class="fa fa-search"></i>'+
                                '</a>'+
                            '</div>'+
                            '<a onclick="add_pejabat();" id="add_pejabat_1" class="btn btn-primary btn-gradient dark" style="font-weight:bold; margin-top: 8px;">'+
                               'Tambah Pejabat'+
                            '</a>'+
                        '</div>'+
                    '</div>'+
                '</div>'+

                '<div style="border-top: 1px dashed #ccc; margin-bottom: 34px;"></div>'; 

            } else if($jml > 1){
            
            for(var i=0; i<res.length; i++){

                $chk = "";
                $val_chk = 0;
                if(res[i].IS_TGL == 1){
                    $chk = "checked";
                    $val_chk = 1;
                }

                var no = parseInt(i+1);

                if(i == 0){
                $isi += 
                '<div class="form-group det" style="margin-bottom: 20px;">'+
                    '<input id="is_tgl_txt_1" type="hidden"  name="is_tgl_txt[]" value="'+$val_chk +'">'+
                    '<div class="row">'+
                        '<label class="col-md-1 control-label" for="detail_1">1. </label>'+
                        '<div class="col-md-4">'+
                            '<input value="'+res[i].JABATAN+'" required placeholder="Masukkan Jabatan TTD" style="cursor:pointer;" type="text" class="form-control pull-right" name="jabatan[]">'+
                        '</div>'+

                        '<div class="col-md-4">'+
                            '<div class="checkbox-custom fill checkbox-primary mb5" style="margin-top: 8px;">'+
                                '<input onclick="change_tgl(1);" id="is_tgl_1" '+$chk+' type="checkbox"  name="is_tgl[]" value="1">'+
                                '<label for="is_tgl_1"> Memakai Tanggal </label>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="row">'+
                        '<label class="col-md-1 control-label" for="detail_1"></label>'+
                        '<div class="col-md-4 admin-form" style="margin-top: 10px;">'+
                            '<div class="smart-widget sm-right smr-50">'+
                               ' <label class="field">'+
                                    '<input value="'+res[i].NAMA+'" required placeholder="Masukkan Nama Pejabat" style="cursor:pointer;" id="pejabat_nama_1" type="text" class="form-control pull-right" name="pejabat[]">'+
                                '</label>'+
                                '<a onclick="show_pop_peg(1);" class="button" style="height: 39px;">'+
                                    '<i class="fa fa-search"></i>'+
                                '</a>'+
                            '</div>'+
                            '<a onclick="add_pejabat();" id="add_pejabat_1" class="btn btn-primary btn-gradient dark" style="display:none; font-weight:bold; margin-top: 8px;">'+
                               'Tambah Pejabat'+
                            '</a>'+
                        '</div>'+
                    '</div>'+
                '</div>'+

                '<div style="border-top: 1px dashed #ccc; margin-bottom: 34px;"></div>';
                } else if(no == res.length){
                    $isi += 
                    '<div class="form-group det" style="margin-bottom: 20px;" id="bungkus_det_'+no+'">'+
                        '<input id="is_tgl_txt_'+no+'" type="hidden"  name="is_tgl_txt[]" value="'+$val_chk +'">'+
                        '<div class="row">'+
                            '<label class="col-md-1 control-label" for="detail_'+no+'">'+no+'. </label>'+
                            '<div class="col-md-4">'+
                                '<input value="'+res[i].JABATAN+'" required placeholder="Masukkan Jabatan TTD" style="cursor:pointer;" type="text" class="form-control pull-right" name="jabatan[]">'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<div class="checkbox-custom fill checkbox-primary mb5" style="margin-top: 8px;">'+
                                    '<input onclick="change_tgl('+no+');" '+$chk+' id="is_tgl_'+no+'" type="checkbox"  name="is_tgl[]" value="1">'+
                                    '<label for="is_tgl_'+no+'"> Memakai Tanggal </label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<label class="col-md-1 control-label" for="detail_'+no+'"></label>'+
                            '<div class="col-md-4 admin-form" style="margin-top: 10px;">'+
                                '<div class="smart-widget sm-right smr-50">'+
                                   ' <label class="field">'+
                                        '<input value="'+res[i].NAMA+'" required placeholder="Masukkan Nama Pejabat" style="cursor:pointer;" id="pejabat_nama_'+no+'" type="text" class="form-control pull-right" name="pejabat[]">'+
                                    '</label>'+
                                    '<a onclick="show_pop_peg('+no+');" class="button" style="height: 39px;">'+
                                        '<i class="fa fa-search"></i>'+
                                    '</a>'+
                                '</div>'+
                                '<a onclick="hapus_row('+no+');" id="del_pejabat_'+no+'" class="btn btn-danger btn-gradient dark" style="font-weight:bold; margin-top: 8px;">'+
                                  'Hapus'+
                                '</a>'+
                                '&nbsp;&nbsp;'+
                                '<a onclick="add_pejabat();" id="add_pejabat_'+no+'" class="btn btn-primary btn-gradient dark" style="font-weight:bold; margin-top: 8px;">'+
                                   'Tambah Pejabat'+
                                '</a>'+
                            '</div>'+           
                        '</div>'+           
                    '</div>'+
                    '<div style="border-top: 1px dashed #ccc; margin-bottom: 34px;" id="border_det_'+no+'"></div>';
                } else {
                    $isi += 
                    '<div class="form-group det" style="margin-bottom: 20px;" id="bungkus_det_'+no+'">'+
                        '<input id="is_tgl_txt_'+no+'" type="hidden"  name="is_tgl_txt[]" value="'+$val_chk +'">'+
                        '<div class="row">'+
                            '<label class="col-md-1 control-label" for="detail_'+no+'">'+no+'. </label>'+
                            '<div class="col-md-4">'+
                                '<input value="'+res[i].JABATAN+'" required placeholder="Masukkan Jabatan TTD" style="cursor:pointer;" type="text" class="form-control pull-right" name="jabatan[]">'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<div class="checkbox-custom fill checkbox-primary mb5" style="margin-top: 8px;">'+
                                    '<input onclick="change_tgl('+no+');" '+$chk+' id="is_tgl_'+no+'" type="checkbox"  name="is_tgl[]" value="1">'+
                                    '<label for="is_tgl_'+no+'"> Memakai Tanggal </label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<label class="col-md-1 control-label" for="detail_'+no+'"></label>'+
                            '<div class="col-md-4 admin-form" style="margin-top: 10px;">'+
                                '<div class="smart-widget sm-right smr-50">'+
                                   ' <label class="field">'+
                                        '<input value="'+res[i].NAMA+'" required placeholder="Masukkan Nama Pejabat" style="cursor:pointer;" id="pejabat_nama_'+no+'" type="text" class="form-control pull-right" name="pejabat[]">'+
                                    '</label>'+
                                    '<a onclick="show_pop_peg('+no+');" class="button" style="height: 39px;">'+
                                        '<i class="fa fa-search"></i>'+
                                    '</a>'+
                                '</div>'+
                                '<a onclick="hapus_row('+no+');" id="del_pejabat_'+no+'" class="btn btn-danger btn-gradient dark" style="display:none; font-weight:bold; margin-top: 8px;">'+
                                  'Hapus'+
                                '</a>'+
                                '&nbsp;&nbsp;'+
                                '<a onclick="add_pejabat();" id="add_pejabat_'+no+'" class="btn btn-primary btn-gradient dark" style="display:none; font-weight:bold; margin-top: 8px;">'+
                                   'Tambah Pejabat'+
                                '</a>'+
                            '</div>'+           
                        '</div>'+           
                    '</div>'+
                    '<div style="border-top: 1px dashed #ccc; margin-bottom: 34px;" id="border_det_'+no+'"></div>';
                }

            }

            }



            $('#head_detail').html($isi);

        }
    });
}

function add_pejabat(){
    $no = $('.det').length + 1;
    $no2 = $('.det').length;

    $('#add_pejabat_'+$no2).hide();
    $('#del_pejabat_'+$no2).hide();

    $isi = 
        '<div class="form-group det" style="margin-bottom: 20px;" id="bungkus_det_'+$no+'">'+
            '<input id="is_tgl_txt_'+$no+'" type="hidden"  name="is_tgl_txt[]" value="0">'+
            '<div class="row">'+
                '<label class="col-md-1 control-label" for="detail_'+$no+'">'+$no+'. </label>'+
                '<div class="col-md-4">'+
                    '<input required placeholder="Masukkan Jabatan TTD" style="cursor:pointer;" type="text" class="form-control pull-right" name="jabatan[]">'+
                '</div>'+
                '<div class="col-md-4">'+
                    '<div class="checkbox-custom fill checkbox-primary mb5" style="margin-top: 8px;">'+
                        '<input onclick="change_tgl('+$no+');" id="is_tgl_'+$no+'" type="checkbox"  name="is_tgl[]" value="1">'+
                        '<label for="is_tgl_'+$no+'"> Memakai Tanggal </label>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<div class="row">'+
                '<label class="col-md-1 control-label" for="detail_'+$no+'"></label>'+
                '<div class="col-md-4 admin-form" style="margin-top: 10px;">'+
                    '<div class="smart-widget sm-right smr-50">'+
                       ' <label class="field">'+
                            '<input required placeholder="Masukkan Nama Pejabat" style="cursor:pointer;" id="pejabat_nama_'+$no+'" type="text" class="form-control pull-right" name="pejabat[]">'+
                        '</label>'+
                        '<a onclick="show_pop_peg('+$no+');" class="button" style="height: 39px;">'+
                            '<i class="fa fa-search"></i>'+
                        '</a>'+
                    '</div>'+
                    '<a onclick="hapus_row('+$no+');" id="del_pejabat_'+$no+'" class="btn btn-danger btn-gradient dark" style="font-weight:bold; margin-top: 8px;">'+
                      'Hapus'+
                    '</a>'+
                    '&nbsp;&nbsp;'+
                    '<a onclick="add_pejabat();" id="add_pejabat_'+$no+'" class="btn btn-primary btn-gradient dark" style="font-weight:bold; margin-top: 8px;">'+
                       'Tambah Pejabat'+
                    '</a>'+
                '</div>'+           
            '</div>'+           
        '</div>'+
        '<div style="border-top: 1px dashed #ccc; margin-bottom: 34px;" id="border_det_'+$no+'"></div>';

    $('#head_detail').append($isi);
}

function hapus_row(id){

    var id2 = parseInt(id - 1);

    $('#bungkus_det_'+id).remove();
    $('#border_det_'+id).remove();

    $('#add_pejabat_'+id2).show();
    $('#del_pejabat_'+id2).show();
}

function change_tgl(id){
    var tombol = $('#is_tgl_'+id).is(':checked');
    if(tombol){
        $('#is_tgl_txt_'+id).val(1); 
    }else{
        $('#is_tgl_txt_'+id).val(0);
    }
}

function show_pop_peg(id){
    get_popup_barang();
    ajax_barang(id);
}

function get_popup_barang(){
    var base_url = '<?php echo base_url(); ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input type="text" name="search_koang" id="search_koang" class="form-control" value="" placeholder="Cari Barang...">'+
                '    <div class="table-responsive">'+
                '            <table class="table table-hover" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>NO</th>'+
                '                        <th style="white-space:nowrap; text-align:center;">NIP</th>'+
                '                        <th>NAMA PEGAWAI</th>'+
                '                    </tr>'+
                '                </thead>'+
                '                <tbody>'+
            
                '                </tbody>'+
                '            </table>'+
                '        </div>'+
                '    </div>'+
                '</div>'+
            '</div>';
    $('body').append($isi);

    $('#pojok_koang').click(function(){
        $('#popup_koang').css('display','none');
        $('#popup_koang').hide();
    });

    $('#popup_koang').css('display','block');
    $('#popup_koang').show();
}

function ajax_barang(id){
    var keyword = $('#search_koang').val();
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/user_manage_c/get_pegawai',
        type : "POST",
        dataType : "json",
        data : {
            keyword : keyword,
        },
        success : function(result){
            var isine = '';
            var no = 0;
            $.each(result,function(i,res){
                no++;
                isine += '<tr>'+
                            '<td align="center">'+no+'</td>'+
                            '<td align="center"><a href="javascript:void(0);" onclick="get_kode_barang(\'' +res.ID+ '\',\'' +id+ '\');">'+res.NIP+'</a></td>'+
                            '<td>'+res.NAMA+'</td>'+
                        '</tr>';
            });
            $('#tes5 tbody').html(isine); 
            $('#search_koang').off('keyup').keyup(function(){
                ajax_barang();
            });
        }
    });
}

function get_kode_barang(id, id_div){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/user_manage_c/get_pegawai_by_id',
        data : {id:id},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){
            $('#pejabat_nama_'+id_div).val(res.NAMA);
        }
    });

    $('#search_koang').val("");
    $('#popup_koang').css('display','none');
    $('#popup_koang').hide();
}

</script>

<?PHP if($id_lap != 0){ ?>
    <input type="hidden" id="id_lap2" value="<?=$id_lap;?>"/>
<?PHP } ?>

<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body">

        <form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>">

            <div class="form-group admin-form">
                <label for="inputPassword" class="col-lg-3 control-label" id="warna_bagian">Nama Laporan</label>
                <div class="col-lg-5">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select required id="nama_lap" name="nama_lap" style="cursor:pointer;" onchange="get_detail_ttd();">
                                        <option value=""> Pilih Nama Laporan</option>
                                        <?php
                                            if($list_laporan != ""){
                                                foreach ($list_laporan as $lap) {
                                        ?>
                                        <option value="<?php echo $lap->ID; ?>"><?php echo $lap->NAMA_LAPORAN; ?></option>    
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                    <i style="z-index:99;" class="arrow"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  

            <div style="border-top: 1px dashed #ccc; margin-bottom: 14px; margin-top: 20px;"></div>  

            <div id="head_detail">

                <div class="form-group det" style="margin-bottom: 20px;">
                    <input id="is_tgl_txt_1" type="hidden"  name="is_tgl_txt[]" value="0">
                    <div class="row">
                        <label class="col-md-1 control-label" for="detail_1">1. </label>
                        <div class="col-md-4">
                            <input required placeholder="Masukkan Jabatan TTD" style="cursor:pointer;" type="text" class="form-control pull-right" name="jabatan[]">
                        </div>

                        <div class="col-md-4">
                            <div class="checkbox-custom fill checkbox-primary mb5" style="margin-top: 8px;">
                                <input onclick="change_tgl(1);" id="is_tgl_1" type="checkbox"  name="is_tgl[]" value="1">
                                <label for="is_tgl_1"> Memakai Tanggal </label>
                                
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-md-1 control-label" for="detail_1"></label>
                        <div class="col-md-4 admin-form" style="margin-top: 10px;">
                            <div class="smart-widget sm-right smr-50" id='basic-modal'>
                                <label class="field">
                                    <input required placeholder="Masukkan Nama Pejabat" style="cursor:pointer;" id="pejabat_nama_1" type="text" class="form-control pull-right" name="pejabat[]">
                                </label>
                                <a onclick="show_pop_peg(1);" class="button" style="height: 39px;">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>

                            <a onclick="add_pejabat();" id="add_pejabat_1" class="btn btn-primary btn-gradient dark" style="font-weight:bold; margin-top: 8px;">
                               Tambah Pejabat
                            </a>
                        </div>
                    </div>
                </div>

                <div style="border-top: 1px dashed #ccc; margin-bottom: 34px;"></div>  

            </div>          
            
    </div>

    <div class="panel-footer admin-form">
       <center>
            <input type="submit" name="simpan" id="simpan" class="button btn-primary" value="Simpan">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" name="lihat" id="lihat" class="button btn-default" value="Lihat">
       </center> 
    </div>

    </form>
</div>

<div id="popup_ttd">
    <div class="window_ttd">
        <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>ico/cancel.gif" id="pojok"></a>
        <div class="panel-body">
            <img src="<?php echo base_url(); ?>images/ttd.png" height="300" width="900">
        </div>
    </div>
</div>