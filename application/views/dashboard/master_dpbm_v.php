<script type="text/javascript" src="<?=base_url();?>material/vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(".num_only").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    <?php
        if($msg == 1){
    ?>
        pesan_sukses();
    <?php
        }
    ?>

    <?php
        if($msg == 3){
    ?>
        pesan_hapus();
    <?php
        }
    ?>

    $('#korang').click(function(){
        get_popup_barang();
        ajax_barang();
    });

});

   

function pesan_sukses(){
    var pesan = '<div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div>'+
                '<h4 class="ui-pnotify-title">Berhasil</h4>'+
                '<div class="ui-pnotify-text"><strong>Data berhasil disimpan!</strong></div>';

    $.jGrowl(pesan, { header: '', life:3000 });
}

function delete_tr(id){
    $('#tr_'+id).remove();
}

function add_row(){

    var nom = $('.add_head').length + 1;
    var kode_barang = $('#kode_barang').val();
    var nama_barang = $('#nama_barang').val();
    var vol_barang =  $('#vol_barang').val();
    var harga =  $('#harga_satuan').val();

    $isi = "<tr class='add_head' id='tr_"+nom+"'>"+
               "<td style='text-align:center;'><a onclick='delete_tr("+nom+");' href='javascript:;' style='height: 30px; width: 70px;' class='btn btn-sm btn-danger'> Hapus </a></td>"+
               "<td style='text-align:center;'>  <input type='hidden' name='kode_barang2[]' value='"+kode_barang+"' />"+kode_barang+"</td>"+  
               "<td> <input type='hidden' name='nama_barang2[]' value='"+nama_barang+"' /> "+nama_barang+"</td>"+               
               "<td style='text-align:center;'> <input type='hidden' name='vol_barang2[]' value='"+vol_barang+"' />  "+vol_barang+"</td>"+       
               "<td style='text-align:center;'> <input type='hidden' name='harga2[]' value='"+harga+"' /> Rp. "+harga+"</td>"+       
               "<td><input type='text' name='no_po[]' value='' style='width:100%;' placeholder='Isikan no PO' /></td>"+       
           "</tr>";
     $('#tes tbody').append($isi);

     $('#kode_barang').val('');
     $('#nama_barang').val('');
     $('#vol_barang').val('');
     $('#harga_satuan').val('');

}

function get_data_dpbm(id){

    $('#simpan').hide();
    $('#reset').hide();

    $('#simpan_ubah').show();
    $('#reset_ubah').show();

    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/master_dpbm_c/get_data_dpbm',
        data : {id:id},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){
            $("#id_dpbm").val(res.ID);
            $("#no_dpbm").val(res.NO_DPBM);
            $("#tanggal").val(res.TANGGAL);
            $("#diminta").val(res.DIMINTA_OLEH);
            $("#keterangan").val(res.KETERANGAN);

            get_detail_dpbm(id);


            $('body,html').animate({
                scrollTop : 0                       // Scroll to top of body
            }, 500);
        }
    });
}

function get_detail_dpbm(id){
    $('.add_head').remove();
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/master_dpbm_c/get_detail_data_dpbm',
        data : {id:id},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(data){
            $isi = "";
            var i = 0;
            for(var x=0;x<data.length;x++){       
                i++;         
                $isi += "<tr class='add_head' id='tr_"+i+"'>"+
                           "<td style='text-align:center;'><a onclick='delete_tr("+i+");' href='javascript:;' style='height: 30px; width: 70px;' class='btn btn-sm btn-danger'> Hapus </a></td>"+
                           "<td style='text-align:center;'>  <input type='hidden' name='kode_barang2[]' value='"+data[x].KODE_BARANG+"' />"+data[x].KODE_BARANG+"</td>"+  
                           "<td> <input type='hidden' name='nama_barang2[]' value='"+data[x].NAMA_BARANG+"' /> "+data[x].NAMA_BARANG+"</td>"+               
                           "<td style='text-align:center;'> <input type='text' name='vol_barang2[]' value='"+data[x].VOLUME+"' style='width: 50px; text-align: center;' /></td>"+       
                           "<td style='text-align:center;'> <input type='text' name='harga2[]' value='"+NumberToMoney(data[x].HARGA).split('.00').join('')+"' style='width: 150px;' onkeyup='FormatCurrency(this);' /> </td>"+       
                           "<td><input type='text' name='no_po[]' value='"+data[x].NO_PO+"' style='width:100%;' placeholder='Isikan no PO' /></td>"+       
                       "</tr>";        
            }
            $('#tes tbody').html($isi);
        }
    }); 
}

function reset_form(){
    $('body,html').animate({
                scrollTop : 0                       // Scroll to top of body
    }, 500);

    $('.add_head').remove();
    $('#simpan_ubah').hide();
    $('#reset_ubah').hide();

    $('#simpan').show();
    $('#reset').show();
    
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
                '                        <th style="white-space:nowrap; text-align:center;">KODE BARANG</th>'+
                '                        <th>NAMA BARANG</th>'+
                '                        <th>SATUAN</th>'+
                '                        <th>HARGA</th>'+
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

function ajax_barang(){
    var keyword = $('#search_koang').val();
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/master_rab_c/get_kode_barang',
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
                            '<td align="center"><a href="javascript:void(0);" onclick=get_kode_barang('+res.ID+');>'+res.KODE_BARANG+'</a></td>'+
                            '<td>'+res.NAMA_BARANG+'</td>'+
                            '<td>'+res.SATUAN+'</td>'+
                            '<td>'+NumberToMoney(res.HARGA_BARANG).split('.00').join('')+'</td>'+
                        '</tr>';
            });
            $('#tes5 tbody').html(isine); 
            $('#search_koang').off('keyup').keyup(function(){
                ajax_barang();
            });
        }
    });
}

function get_kode_barang(id){
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/master_rab_c/get_detil_barang',
        data : {id:id},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){
            $('#nama_barang').val(res.NAMA_BARANG);
            $('#kode_barang').val(res.KODE_BARANG);
            $('#harga_satuan').val(NumberToMoney(res.HARGA_BARANG).split('.00').join(''));
        }
    });


    $('#search_koang').val("");
    $('#popup_koang').css('display','none');
    $('#popup_koang').hide();
}

</script>

<?PHP if($msg == 5){ ?> 
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-danger pr10"></i>
    <strong>Perhatian! Nomor DPBM tidak dapat dihapus karena telah terpakai untuk Realisasi Anggaran</strong>
</div>
<?PHP } ?>

<form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>">
<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body form-horizontal">

        

            <div class="form-group">
                <label for="no_dpbm" class="col-lg-3 control-label">No DPBM</label>
                <div class="col-lg-5">
                    <input type="text" required name="no_dpbm" id="no_dpbm" class="form-control" value="" />
                    <input type="hidden" required name="id_dpbm" id="id_dpbm" class="form-control" value="" />
                </div>
            </div>

            <div class="form-group view_non_barang">
                <label class="col-lg-3 control-label" for="datetimepicker2">Tanggal Pelaksanaan</label>
                <div class="col-lg-3">
                    <div class="input-group date" id="datetimepicker2">
                        <span class="input-group-addon cursor"><i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" class="form-control" name="tanggal" id="tanggal" value="">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="diminta" class="col-lg-3 control-label">Diminta Oleh</label>
                <div class="col-lg-5">
                    <input type="text" required name="diminta" id="diminta" class="form-control" value="" />
                </div>
            </div>

            
            <div class="form-group">
                <label class="col-lg-3 control-label" for="keterangan">Keterangan</label>
                <div class="col-lg-8">
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                </div>
            </div>
  
    </div>

            <table style="margin-top: 10px; margin-bottom: 10px; margin-left: 25px;">
                <tr>
                    <td style="width: 100px;">Kode Barang</td>
                    <td>
                        <input type="text" readonly name="kode_barang" id="kode_barang" class="form-control" value="" />                        
                    </td>
                    <td id='basic-modal' class="admin-form">
                        <a id="korang" class="button" style="border: 1px solid #61b3de; height: 39px; padding-bottom: 0; padding-top: 0;">
                          <i class="fa fa-search"></i>
                        </a>
                    </td>
                </tr>  
            </table>

            <table style="margin-top: 10px; margin-bottom: 10px; margin-left: 25px;">
                <tr>
                    <td style="width: 100px;">Nama Barang</td>
                    <td><input style="width: 400px;" type="text" readonly name="nama_barang" id="nama_barang" class="form-control" value="" /></td>
                </tr>
            </table>

            <table style="margin-top: 10px; margin-bottom: 10px; margin-left: 25px;">
                <tr>
                    <td style="width: 100px;">Volume</td>
                    <td><input type="text"  name="vol_barang" id="vol_barang" class="form-control num_only" value="" /></td>
                </tr>
            </table>

            <table style="margin-top: 10px; margin-bottom: 10px; margin-left: 25px;">
                <tr>
                    <td style="width: 100px;">Harga Satuan</td>
                    <td><input type="text" onkeyup="FormatCurrency(this);" name="harga_satuan" id="harga_satuan" class="form-control num_only" value="" /></td>
                </tr>
            </table>

            <table style="margin-top: 10px; margin-bottom: 10px; margin-left: 25px;">
                <tr>
                    <td style="width: 100px;">&nbsp;</td>
                    <td>
                        <a onclick="add_row();" href="javascript:;" style="height: 30px; width: 100px;"class="btn btn-sm btn-warning btn-block"><i class="fa fa-plus"></i> Tambah</a>
                    </td>
                </tr>
            </table>

            
                

    <div class="panel-footer">                
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title">
                            <span class="glyphicons glyphicons-table"></span>List Barang</span>
                    </div>
                    <div class="panel-body pn">
                        <table class="table table-bordered" id="tes">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle; text-align:center;">#</th>
                                    <th style="vertical-align: middle; text-align:center;">Kode Barang</th>
                                    <th style="vertical-align: middle; text-align:center;">Nama Barang</th>
                                    <th style="vertical-align: middle; text-align:center;">Volume</th>
                                    <th style="vertical-align: middle; text-align:center;">Harga Satuan</th>
                                    <th style="vertical-align: middle; text-align:center;">NO PO</th>
                                </tr> 
                            </thead>
                            <tbody>
                              
                            </tbody>
                        </table>
                    </div>
                </div>
            
            <hr style="margin-bottom: 10px;">
            <center>

                <input id="simpan" type="submit" name="simpan" value="SIMPAN" class="btn btn-primary btn-gradient dark" style="font-weight:bold;" />
                <input id="simpan_ubah" type="submit" name="ubah" value="SIMPAN PERUBAHAN" class="btn btn-primary btn-gradient dark" style="font-weight:bold; display:none;" />
                &nbsp;
                <input id="reset" type="reset" value="BATAL" class="btn btn-default btn-gradient dark" style="font-weight:bold;" />
                <input onclick="reset_form();" id="reset_ubah" type="reset" value="BATAL UBAH" class="btn btn-default btn-gradient dark" style="font-weight:bold; display:none;" />
            </center>
                        
        
    </div>

</div>

 </form>



<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body form-horizontal">

    <div class="col-md-12">
        <form method="post" target="_blank" action="<?=base_url().$post_url;?>">
            <input type="submit" value="Cetak Excel" name="excel" class="btn btn-primary btn-gradient dark" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/xls.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;" />        
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
            <input type="submit" value="Cetak PDF" name="pdf" class="btn btn-primary btn-gradient dark" style="margin-top:5px; background-image: url('<?=base_url()?>/ico/pdf.gif');background-position: 5px 50%;background-repeat: no-repeat;padding: 4px 4px 4px 22px;" />  
        </form>
    </div>

    <br><br><br>

    <div class="col-md-12">
            <div class="panel panel-visible">
                <div class="panel-heading">
                    <div class="panel-title hidden-xs">
                        <span class="glyphicon glyphicon-tasks"></span>List Data DPBM</div>
                </div>
                <div class="panel-body pn">
                    <table class="table table-bordered table-hover" id="datatable2" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle;">#</th>
                                <th style="vertical-align: middle;">NO DPBM</th>
                                <th style="vertical-align: middle;">TANGGAL</th>
                                <th style="vertical-align: middle;">DIMINTA OLEH</th>
                                <th style="vertical-align: middle; text-align: center;">UBAH</th>
                                <th style="vertical-align: middle; text-align: center;">HAPUS</th>
                        </thead>
                        <tbody>
                            <?PHP 
                                $no = 0;
                                foreach ($dt as $key => $row) {
                                $no++;
                            ?>
                            <tr style="cursor:pointer;">
                                <td><?=$no;?></td>
                                <td><?=$row->NO_DPBM;?></td>
                                <td><?=datetostr($row->TANGGAL);?></td>
                                <td><?=$row->DIMINTA_OLEH;?></td>

                                <td>
                                    <center> 
                                        <button onclick="get_data_dpbm('<?=$row->ID;?>');" style="height: 30px; width: 100px;"class="btn btn-sm btn-warning btn-block" type="button"><i class="fa fa-edit"></i> Ubah </button> 
                                    </center>
                                </td>

                                <td>
                                    <center> 
                                        <button onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID;?>');" style="height: 30px; width: 100px;"class="btn btn-sm btn-danger btn-block" type="button"><i class="fa fa-remove"></i> Hapus</button> 
                                    </center>
                                </td>
                            </tr>
                            </tr>
                            <?PHP } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
  
    </div>
</div>



<!-- preload the images -->
<div style='display:none'>
    <img src='<?=base_url();?>material/modal/img/basic/x.png' alt='' />
</div>


<a id="dialog-btn" href="javascript:;" class="cd-popup-trigger" style="display:none;">View Pop-up</a>

<div class="cd-popup" role="alert">
    <div class="cd-popup-container">

        <form id="delete" method="post" action="<?=base_url().$post_url;?>">
            <input type="hidden" name="id_hapus" id="id_hapus" value="" />
        </form>   
         
        <p>Apakah anda yakin ingin menghapus data ini?</p>
        <ul class="cd-buttons">            
            <li><a href="javascript:;" onclick="$('#delete').submit();">Ya</a></li>
            <li><a onclick="$('.cd-popup-close').click(); $('#id_hapus').val('');" href="javascript:;">Tidak</a></li>
        </ul>
        <a href="#0" onclick="$('#id_hapus').val('');" class="cd-popup-close img-replace">Close</a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->