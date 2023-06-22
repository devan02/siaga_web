<script type="text/javascript" src="<?=base_url();?>material/vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js-devan/alert.js"></script>
<script type="text/javascript">
$(document).ready(function(){

    get_nomor_rab();

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

    $('#korang').click(function(){
        get_popup_barang();
        ajax_barang();
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


    $.barang_nama({
        url : '<?php echo base_url(); ?>dashboard/input_anggaran_c/get_barang',
        result : '#jns_kegiatan',
    });

});

function get_data_rab(id){

    $('#simpan').hide();
    $('#reset').hide();

    $('#simpan_ubah').show();
    $('#reset_ubah').show();

    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/master_rab_c/get_data_rab',
        data : {id:id},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){
            $("#id_rab").val(res.ID);
            $("#tahun2").val(res.TAHUN);
            $("#nomor_rab").val(res.NO_RAB);
            $("#kota").val(res.KOTA);
            $("#kegiatan").val(res.KEGIATAN);
            $("#pekerjaan").val(res.PEKERJAAN);
            $("#lokasi").val(res.LOKASI);
            $("#location").val(res.SUMBER_DANA);

            get_detail_rab(id);


            $('body,html').animate({
                scrollTop : 0                       // Scroll to top of body
            }, 500);
        }
    });
}

function get_detail_rab(id){
    $('.add_head').remove();
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/master_rab_c/get_detail_data_rab',
        data : {id:id},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(data){
            $isi = "";
            var i = 0;
            var total_semua = 0;
            for(var x=0;x<data.length;x++){       
                i++;         
                var total = parseFloat(data[x].VOLUME)*parseFloat(data[x].HARGA_SATUAN);
                total_semua += total;
                $isi += "<tr class='add_head' id='tr_"+i+"'>"+
                           "<td style='text-align:center;'><a onclick='delete_tr("+i+", "+total+");' href='javascript:;' style='height: 30px; width: 70px;' class='btn btn-sm btn-danger'> Hapus </a></td>"+
                           "<td> <input type='hidden' value='"+data[x].KEGIATAN+"' name='jns_kegiatan2[]'/> "+data[x].KEGIATAN+"</td>"+               
                           "<td style='text-align:center;'> <input style='width: 100px; text-align: center;' type='text' value='"+data[x].VOLUME+"' name='volume2[]' onkeyup='FormatCurrency(this); hitung_total();'/> </td>"+               
                           "<td style='text-align:center;'> <input style='width: 100px;' type='text' value='"+data[x].SATUAN+"' name='satuan2[]'/> </td>"+               
                           "<td> <input type='hidden' value='"+data[x].STS_JENIS+"' name='sts_jns_kegiatan2[]'/> <input type='hidden' value='"+data[x].HARGA_SATUAN+"' name='harga_satuan2[]'/> Rp. "+NumberToMoney(data[x].HARGA_SATUAN)+"</td>"+            
                           "<td>Rp. "+NumberToMoney(total)+"</td>"+
                       "</tr>";        
            }
            $('#tes2 tbody').html($isi);

            $('#sum_total').val(total_semua);

            var hitung_ppn = (total_semua*10) / 100;
            var hitung_total_all = total_semua + hitung_ppn;

            $('#sub_total').html("<b>Rp. "+NumberToMoney(total_semua)+"</b>");
            $('#ppn').html("<b>Rp. "+NumberToMoney(hitung_ppn)+"</b>");
            $('#total_all').html("<b>Rp. "+NumberToMoney(hitung_total_all)+"</b>" );

            $('#foot_add').show();
        }
    }); 
}

function get_nomor_rab(){

    var jns = $("input[name='jenis_rab']:checked").val();
    var thn = $('#tahun2').val();

    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/master_rab_c/get_nomor_rab',
        data : {
            jns:jns, 
            thn:thn,
        },
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){
            $('#nomor_rab').val(res);
        }
    });
}
    

function pesan_sukses(){
    var pesan = '<div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div>'+
                '<h4 class="ui-pnotify-title">Berhasil</h4>'+
                '<div class="ui-pnotify-text"><strong>Data berhasil disimpan!</strong></div>';

    $.jGrowl(pesan, { header: '', life:3000 });
}

function get_grup(id){


    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/setup_grup_kode_perkiraan_c/get_grup',
        data : {id:id},
        type : "POST",
        dataType : "json",
        async : false,
        success : function(res){
            $("#kode_grup").val(res.KP_GRUP);
            $("#kode_sub").val(res.KP_SUB);
            $("#sub_grup1").val(res.SUB_GRUP1);
            $("#sub_grup2").val(res.SUB_GRUP2);
            $("#sub_grup3").val(res.SUB_GRUP3);
            $("#location").val(res.GRUP);

            $('body,html').animate({
                scrollTop : 0                       // Scroll to top of body
            }, 500);
        }
    });
}

function hitung_total(){
    var volume = $('#volume').val();
    var harga_satuan = $('#harga_satuan').val().split(',').join('');

    if(harga_satuan == ""){
        harga_satuan = 0;
    }

    if(volume == ""){
        volume = 0;
    }

    var total = parseFloat(volume)*parseFloat(harga_satuan);
    $('#jumlah_harga').val(NumberToMoney(total));
}

function delete_tr(id, jml){
    $('#tr_'+id).remove();
    var total_all = $('#sum_total').val();
    var total_all2 = total_all - jml;

    var hitung_ppn = (total_all2*10) / 100;
    var hitung_total_all = total_all2 + hitung_ppn;

    $('#sum_total').val(total_all2);

     $('#sub_total').html("<b>Rp. "+NumberToMoney(total_all2)+"</b>");
     $('#ppn').html("<b>Rp. "+NumberToMoney(hitung_ppn)+"</b>");
     $('#total_all').html("<b>Rp. "+NumberToMoney(hitung_total_all)+"</b>" );

    if($('.add_head').length == 0){
        $('#foot_add').hide();
    }
}

function add_row(){
    var jns_kegiatan = $('#jns_kegiatan').val();
    var sts_jns_kegiatan = $('#sts_jns_kegiatan').val();
    var kode_br = $('#kode_br').val();
    var volume = $('#volume').val();
    var satuan = $('#satuan').val();
    var harga_satuan = $('#harga_satuan').val().split(',').join('');;
    var jumlah_harga = $('#jumlah_harga').val().split('.00').join('');
    var jumlah_harga_txt = jumlah_harga.split(',').join('');
    var sum_total =  $('#sum_total').val();
    var no = $('.add_head').length + 1;
    var hitung_ppn = 0;
    var hitung_total_all = 0;

    var hitung_total = parseFloat(sum_total) + parseFloat(jumlah_harga_txt);
    hitung_ppn = (hitung_total*10) / 100;
    hitung_total_all = hitung_total + hitung_ppn;

    $('#sum_total').val(hitung_total);

    $isi = "<tr class='add_head' id='tr_"+no+"'>"+
               "<td style='text-align:center;'><a onclick='delete_tr("+no+", "+jumlah_harga_txt+");' href='javascript:;' style='height: 30px; width: 70px;' class='btn btn-sm btn-danger'> Hapus </a></td>"+
               "<td> <input type='hidden' value='"+jns_kegiatan+"' name='jns_kegiatan2[]'/> "+jns_kegiatan+"</td>"+               
               "<td style='text-align:center;'> <input type='hidden' value='"+volume+"' name='volume2[]'/> "+volume+"</td>"+               
               "<td style='text-align:center;'> <input type='hidden' value='"+satuan+"' name='satuan2[]'/> "+satuan+"</td>"+               
               "<td> <input type='hidden' value='"+kode_br+"' name='kode_barang2[]'/> <input type='hidden' value='"+sts_jns_kegiatan+"' name='sts_jns_kegiatan2[]'/> <input type='hidden' value='"+harga_satuan+"' name='harga_satuan2[]'/> Rp. "+NumberToMoney(harga_satuan)+"</td>"+            
               "<td>Rp. "+NumberToMoney(jumlah_harga_txt)+"</td>"+
           "</tr>";
     $('#tes2 tbody').append($isi);
     $('#sub_total').html("<b>Rp. "+NumberToMoney(hitung_total)+"</b>");
     $('#ppn').html("<b>Rp. "+NumberToMoney(hitung_ppn)+"</b>");
     $('#total_all').html("<b>Rp. "+NumberToMoney(hitung_total_all)+"</b>" );
     $('#foot_add').show();

     $('#batalkan').click();
     document.getElementById("add_form").reset();

}

function reset_first(){
    $('.add_head').remove();
    $('#foot_add').hide();
}

function reset_form(){
     $('body,html').animate({
                scrollTop : 0 // Scroll to top of body
    }, 500);


    $('.add_head').remove();
    $('#foot_add').hide();

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
            $('#jns_kegiatan').val(res.KODE_BARANG+" - "+res.NAMA_BARANG);
            $('#kode_br').val(res.KODE_BARANG);
            $('#sts_jns_kegiatan').val(1);
            $('#satuan').val(res.SATUAN);
            $('#volume').val(0);
            $('#jumlah_harga').val(0);
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
    <strong>Perhatian! Nomor RAB tidak dapat dihapus karena telah terpakai untuk SPK</strong>
</div>
<?PHP } ?>


<?PHP if($msg == 6){ ?> 
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-danger pr10"></i>
    <strong>Perhatian! Nomor RAB tidak dapat dihapus karena telah terpakai untuk Realisasi Anggaran</strong>
</div>
<?PHP } ?>


<form class="form-horizontal" role="form" method="post" action="<?=base_url().$post_url;?>">
<div class="panel">
    <div class="panel-headin" style="background:#4a89dc; color: #fff; height: 0;">
        <span class="panel-title"></span>
    </div>
    <div class="panel-body form-horizontal">       

            <div class="form-group">
                <label for="disabledInput" class="col-lg-3 control-label">Jenis RAB</label>
                <div class="col-lg-8" style="margin-top: 8px;">
                    <div class="radio-custom radio-primary mb5">
                        <input onclick="get_nomor_rab()" type="radio" id="radioExample1" name="jenis_rab" value="operasional" checked="checked">
                        <label for="radioExample1" style="margin-right: 15px; padding-left: 25px;">Operasional</label>

                        <input onclick="get_nomor_rab()" type="radio" id="radioExample2" name="jenis_rab" value="teknik">
                        <label for="radioExample2" style="margin-right: 15px; padding-left: 25px;">Teknik</label>
                    </div>
                </div>
            </div>

            <div class="form-group admin-form">
                <label for="inputPassword" class="col-lg-3 control-label">Tahun Anggaran</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="tahun2" name="tahun" style="cursor:pointer;" onchange="get_nomor_rab();">
                                        <?php
                                            $thn = date('Y');
                                            for($i=2015; $i<=$thn+2; $i++) {
                                                if ($i==$thn){
                                                    echo"<option selected='selected' value=".$i."> ".$i." </option>";
                                                }else{
                                                    echo"<option value=".$i."> ".$i." </option>";
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

            <div class="form-group">
                <label for="nomor_rab" class="col-lg-3 control-label">Nomor RAB</label>
                <div class="col-lg-5">
                    <input type="text" required readonly name="nomor_rab" id="nomor_rab" class="form-control" value="" />
                    <input type="hidden" name="id_rab" id="id_rab" class="form-control" value="" />
                </div>
            </div>

            <div class="form-group">
                <label for="kota" class="col-lg-3 control-label">Kota</label>
                <div class="col-lg-5">
                    <input type="text" required name="kota" id="kota" class="form-control" value="" />
                </div>
            </div>

            
            <div class="form-group">
                <label class="col-lg-3 control-label" for="kegiatan">Kegiatan</label>
                <div class="col-lg-8">
                    <textarea class="form-control" id="kegiatan" name="kegiatan" rows="3"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="pekerjaan">Pekerjaan</label>
                <div class="col-lg-8">
                    <textarea class="form-control" id="pekerjaan" name="pekerjaan" rows="3"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="lokasi">Lokasi</label>
                <div class="col-lg-8">
                    <input type="text" required name="lokasi" id="lokasi" class="form-control" value="" />
                </div>
            </div>

            <div class="form-group admin-form">
                <label for="inputPassword" class="col-lg-3 control-label">Sumber Dana</label>
                <div class="col-lg-3">
                    <div class="admin-form">
                        <div>
                            <div class="smart-widget sm-right smr-50">
                                <label class="field select">
                                    <select id="location" name="sumber_dana" style="cursor:pointer;">
                                        <option value="">Pilih Sumber Dana</option>
                                        <option value="PDAM">PDAM</option>
                                        <option value="PEMERINTAH KOTA">PEMERINTAH KOTA</option>
                                    </select>
                                    <i style="z-index:99;" class="arrow"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div class="panel-footer">
                <input type="hidden" id="sum_total" value="0"/>
                <a href="#tambah" style="height: 30px; width: 100px;"class="btn btn-sm btn-warning btn-block"><i class="fa fa-plus"></i> Tambah</a>
                <br>
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title">
                            <span class="glyphicons glyphicons-table"></span>List Kegiatan</span>
                    </div>
                    <div class="panel-body pn">
                        <table class="table table-bordered" id="tes2">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle; text-align:center;" rowspan="2">#</th>
                                    <th style="vertical-align: middle; text-align:center;" rowspan="2">Jenis Kegiatan</th>
                                    <th style="vertical-align: middle; text-align:center;" rowspan="2">Volume</th>
                                    <th style="vertical-align: middle; text-align:center;" rowspan="2">Satuan</th>
                                    <th style="vertical-align: middle; text-align:center;" colspan="2">Harga Kontrak</th>
                                </tr>
                                <tr>
                                    <th style="vertical-align: middle; text-align:center;">Harga Satuan <br> (Rp.)</th>
                                    <th style="vertical-align: middle; text-align:center;">Jumlah Harga <br> (Rp.)</th>
                                </tr>   
                            </thead>
                            <tbody>
                              
                            </tbody>

                            <tfoot id="foot_add" style="display:none;">
                                <tr>
                                    <td colspan="4"><b>Sub Total</b></td>
                                    <td colspan="2" style="text-align:center;" id="sub_total"></td>
                                </tr>

                                <tr>
                                    <td colspan="4"><b>PPN 10%</b></td>
                                    <td colspan="2" style="text-align:center;" id="ppn"></td>
                                </tr>

                                <tr>
                                    <td colspan="4"><b>TOTAL</b></td>
                                    <td colspan="2" style="text-align:center;" id="total_all"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            
            <hr style="margin-bottom: 10px;">
            <center>

                <input id="simpan" type="submit" name="simpan" value="SIMPAN" class="btn btn-primary btn-gradient dark" style="font-weight:bold;" />
                <input id="simpan_ubah" type="submit" name="ubah" value="SIMPAN PERUBAHAN" class="btn btn-primary btn-gradient dark" style="font-weight:bold; display:none;" />
                &nbsp;
                <input onclick="reset_first();" id="reset" type="reset" value="BATAL" class="btn btn-default btn-gradient dark" style="font-weight:bold;" />
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
                        <span class="glyphicon glyphicon-tasks"></span>List Data RAB</div>
                </div>
                <div class="panel-body pn">
                    <table class="table table-bordered table-hover" id="datatable2" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle;">#</th>
                                <th style="vertical-align: middle;">NO RAB</th>
                                <th style="vertical-align: middle;">JENIS RAB</th>
                                <th style="vertical-align: middle;">TAHUN</th>
                                <th style="vertical-align: middle;">KEGIATAN</th>
                                <th style="vertical-align: middle;">PEKERJAAN</th>
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
                                <td style="text-align:center;"><?=$no;?></td>
                                <td><?=$row->NO_RAB;?></td>
                                <td><?=ucfirst($row->JENIS);?></td>
                                <td><?=$row->TAHUN;?></td>
                                <td><?=$row->KEGIATAN;?></td>
                                <td><?=$row->PEKERJAAN;?></td>

                                <td>
                                    <center> 
                                        <button onclick="get_data_rab('<?=$row->ID;?>');" style="height: 30px; width: 100px;"class="btn btn-sm btn-warning btn-block" type="button"><i class="fa fa-edit"></i> Ubah </button> 
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


<!-- TAMBAH MODAL -->

<div id="tambah" class="modalDialogs" style="z-index: 9999;">
    <div>
        

        <div class="modals_head">
            <span>
                <h3>Tambah Jenis Kegiatan</h3>
            </span>

            <span>
                <!-- <a href="#close" title="Close" class="closeit">X</a> -->
                <a href="#close" id="closeit" style="float:right;" class="close-button" title="Tutup"><img src="<?=base_url();?>images/close.png" width="20px" height="20px" style="margin-top: -40px;"></a>
            </span>  
        </div>

            <form id="add_form" class="form-horizontal" role="form" method="post" action="#">

                <div class="form-group admin-form">
                    <label for="jns_kegiatan" class="col-lg-4 control-label">Jenis Kegiatan</label>
                    <div class="col-lg-6" style="margin-right: -11px;">
                        <input type="text" name="jns_kegiatan" id="jns_kegiatan" class="form-control"  value="" />                        
                        <input type="hidden" name="sts_jns_kegiatan" id="sts_jns_kegiatan" class="form-control"  value="" />                        
                        <input type="hidden" name="kode_br" id="kode_br" class="form-control"  value="" />                        
                    </div>

                    <a class="button" id="korang" style="height: 39px; line-height: 36px; border: 1px solid #61b3de;">
                          <i class="fa fa-search"></i>
                    </a>
                </div>

                <div class="form-group admin-form">
                    <label for="volume" class="col-lg-4 control-label">Volume</label>
                    <div class="col-lg-7">
                        <input onkeyup="hitung_total();" type="text" name="volume" id="volume" class="form-control num_only"  value="" />
                    </div>
                </div>

                <div class="form-group admin-form">
                    <label for="satuan" class="col-lg-4 control-label">Satuan</label>
                    <div class="col-lg-7">
                        <input type="text" name="satuan" id="satuan" class="form-control"  value="" />
                    </div>
                </div>

                <div class="form-group admin-form">
                    <label for="harga_satuan" class="col-lg-4 control-label">Harga Satuan</label>
                    <div class="col-lg-7">
                        <input onkeyup="FormatCurrency(this); hitung_total();" type="text" name="harga_satuan" id="harga_satuan" class="form-control num_only"  value="" />
                    </div>
                </div>


                <div class="form-group admin-form">
                    <label for="jumlah_harga" class="col-lg-4 control-label">Jumlah Harga</label>
                    <div class="col-lg-7">
                        <input readonly type="text" name="jumlah_harga" id="jumlah_harga" class="form-control"  value="" />
                    </div>
                </div>


                <hr style="margin-bottom: 10px;">

                <center>

                    <a href="javascript:;" onclick="add_row();" class="btn btn-primary btn-gradient dark" style="font-weight:bold;"> Tambahkan </a>
                    &nbsp;
                    <input id="batalkan" type="button" onclick="window.location='#close';" value="BATAL" class="btn btn-default btn-gradient dark" style="font-weight:bold;" />
                </center>
                            
             </form>   

    </div>
</div>


<!-- END -->

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