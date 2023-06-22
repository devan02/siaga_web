(function ( $ ) {
 
    $.barang = function(shade) {
        var settings = $.extend({
            // These are the defaults.
            selector : "#kobar",
            url : "",
            result : "",
            color: "blue",
            backgroundColor: "white",
            data : {},
        }, shade );

        var ajax = "";
        var url_plus = "";

        function tabel(){

        	var $isi = '<div id="popup_barang">'+
						    '<div class="window_barang">'+
						    '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_barang"></a>'+
						    '    <div class="panel-body">'+
						    '    <input type="text" name="search_barang" id="search_barang" class="form-control" value="" placeholder="Cari barang...">'+
				            '	 <div class="table-responsive">'+
							'            <table class="table table-hover" id="tes">'+
							'                <thead>'+
							'                    <tr>'+
							'                        <th style="white-space:nowrap; text-align:center;">NO</th>'+
							'                        <th style="white-space:nowrap; text-align:center;">KODE BARANG</th>'+
                            '                        <th style="white-space:nowrap; text-align:center;">NAMA BARANG</th>'+
                            '                        <th style="white-space:nowrap; text-align:center;">SATUAN</th>'+
                            '                        <th style="white-space:nowrap; text-align:center;">HARGA</th>'+
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

				$('#pojok_barang').click(function(){
			        $('#popup_barang').css('display','none');
			        $('#popup_barang').hide();
			        $('#search_barang').val("");
			    });

		       $('#popup_barang').css('display','block');
		       $('#popup_barang').show();
        }

        function get_data(){
        	var kode_barang = $('#search_barang').val();

            if(settings.url_plus){
                url_plus = settings.url_plus.call();
            }

        	if(ajax){
        		ajax.abort();
        	}

        	ajax = $.ajax({
        		url : settings.url+'/'+url_plus,
        		type : "GET",
        		dataType : "json",
        		data : {
        			keyword : kode_barang,
        		},
        		success : function(result){
        			var isine = '';
        			var no = 0;
        			$.each(result,function(i,res){
        				no++;
        				isine += '<tr>'+
								    '<td align="center">'+no+'</td>'+
								    '<td align="center"><a href="javascript:void(0);">'+res.KODE_BARANG+'</a></td>'+
                                    '<td>'+res.NAMA_BARANG+'</td>'+
                                    '<td align="center">'+res.SATUAN+'</td>'+
                                    '<td>'+NumberToMoney(res.HARGA_BARANG)+'</td>'+
							    '</tr>';
        			});
        			$('#tes tbody').html(isine); 
        			$('#search_barang').off('keyup').keyup(function(){
			        	get_data();
			        });

			        $('#popup_barang tbody a').off('click').click(function(){
			        	var kode_anggaran = $(this).text();
			        	$(settings.result).val(kode_anggaran);
					    $('#popup_barang').css('display','none');
					    $('#popup_barang').hide();
			        })
        		}
        	});
        }

       	

        $(settings.selector).click(function(){
        	tabel();
        	get_data();
        });

    };
 
}( jQuery ));



(function ( $ ) {
 
    $.barang_nama = function(shade) {
        var settings = $.extend({
            // These are the defaults.
            selector : "#kobar",
            url : "",
            result : "",
            color: "blue",
            backgroundColor: "white",
            data : {},
        }, shade );

        var ajax = "";
        var url_plus = "";

        function tabel(){

            var $isi = '<div id="popup_barang">'+
                            '<div class="window_barang">'+
                            '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_barang"></a>'+
                            '    <div class="panel-body">'+
                            '    <input type="text" name="search_barang" id="search_barang" class="form-control" value="" placeholder="Cari barang...">'+
                            '    <div class="table-responsive">'+
                            '            <table class="table table-hover" id="tes">'+
                            '                <thead>'+
                            '                    <tr>'+
                            '                        <th style="white-space:nowrap; text-align:center;">NO</th>'+
                            '                        <th style="white-space:nowrap; text-align:center;">KODE BARANG</th>'+
                            '                        <th style="white-space:nowrap; text-align:center;">NAMA BARANG</th>'+
                            '                        <th style="white-space:nowrap; text-align:center;">SATUAN</th>'+
                            '                        <th style="white-space:nowrap; text-align:center;">HARGA</th>'+
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

                $('#pojok_barang').click(function(){
                    $('#popup_barang').css('display','none');
                    $('#popup_barang').hide();
                    $('#search_barang').val("");
                });

               $('#popup_barang').css('display','block');
               $('#popup_barang').show();
        }

        function get_data(){
            var kode_barang = $('#search_barang').val();

            if(settings.url_plus){
                url_plus = settings.url_plus.call();
            }

            if(ajax){
                ajax.abort();
            }

            ajax = $.ajax({
                url : settings.url+'/'+url_plus,
                type : "GET",
                dataType : "json",
                data : {
                    keyword : kode_barang,
                },
                success : function(result){
                    var isine = '';
                    var no = 0;
                    $.each(result,function(i,res){
                        no++;
                        isine += '<tr>'+
                                    '<td align="center">'+no+'</td>'+
                                    '<td align="center">'+res.KODE_BARANG+'</a></td>'+
                                    '<td><a href="javascript:void(0);">'+res.NAMA_BARANG+'</a></td>'+
                                    '<td align="center">'+res.SATUAN+'</td>'+
                                    '<td>'+NumberToMoney(res.HARGA_BARANG)+'</td>'+
                                '</tr>';
                    });
                    $('#tes tbody').html(isine); 
                    $('#search_barang').off('keyup').keyup(function(){
                        get_data();
                    });

                    $('#popup_barang tbody a').off('click').click(function(){
                        var kode_anggaran = $(this).text();
                        $(settings.result).val(kode_anggaran);
                        $('#popup_barang').css('display','none');
                        $('#popup_barang').hide();
                    })
                }
            });
        }

        

        $(settings.selector).click(function(){
            tabel();
            get_data();
        });

    };
 
}( jQuery ));


(function ( $ ) {
 
    $.no_rab = function(shade) {
        var settings = $.extend({
            // These are the defaults.
            selector : "#norab",
            url : "",
            result : "",
            color: "blue",
            backgroundColor: "white",
            data : {},
        }, shade );

        var ajax = "";
        var url_plus = "";

        function tabel(){

            var $isi = '<div id="popup_barang">'+
                            '<div class="window_barang">'+
                            '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_barang"></a>'+
                            '    <div class="panel-body">'+
                            '    <input type="text" name="search_barang" id="search_barang" class="form-control" value="" placeholder="Cari nomor RAB ...">'+
                            '    <div class="table-responsive">'+
                            '            <table class="table table-hover" id="tes">'+
                            '                <thead>'+
                            '                    <tr>'+
                            '                        <th style="white-space:nowrap; text-align:center;">NO</th>'+
                            '                        <th style="white-space:nowrap; text-align:center;">NO. RAB</th>'+
                            '                        <th style="white-space:nowrap; text-align:center;">TAHUN</th>'+
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

                $('#pojok_barang').click(function(){
                    $('#popup_barang').css('display','none');
                    $('#popup_barang').hide();
                    $('#search_barang').val("");
                });

               $('#popup_barang').css('display','block');
               $('#popup_barang').show();
        }

        function get_data(){
            var kode_barang = $('#search_barang').val();

            if(settings.url_plus){
                url_plus = settings.url_plus.call();
            }

            if(ajax){
                ajax.abort();
            }

            ajax = $.ajax({
                url : settings.url+'/'+url_plus,
                type : "GET",
                dataType : "json",
                data : {
                    keyword : kode_barang,
                },
                success : function(result){
                    var isine = '';
                    var no = 0;
                    $.each(result,function(i,res){
                        no++;
                        isine += '<tr>'+
                                    '<td align="center">'+no+'</td>'+
                                    '<td align="center"><a href="javascript:void(0);">'+res.NO_RAB+'</a></td>'+
                                    '<td align="center">'+res.TAHUN+'</td>'+
                                '</tr>';
                    });
                    $('#tes tbody').html(isine); 
                    $('#search_barang').off('keyup').keyup(function(){
                        get_data();
                    });

                    $('#popup_barang tbody a').off('click').click(function(){
                        var kode_anggaran = $(this).text();
                        $(settings.result).val(kode_anggaran);
                        $('#popup_barang').css('display','none');
                        $('#popup_barang').hide();
                    })
                }
            });
        }

        

        $(settings.selector).click(function(){
            tabel();
            get_data();
        });

    };
 
}( jQuery ));