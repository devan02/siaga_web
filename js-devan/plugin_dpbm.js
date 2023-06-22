(function ( $ ) {
 
    $.dpbm = function(shade) {
        var settings = $.extend({
            // These are the defaults.
            selector : "#kode_dpbm",
            url : "",
            result : "",
            color: "blue",
            backgroundColor: "white",
            data : {},
        }, shade );

        var ajax = "";
        var url_plus = "";

        function tabel(){

        	var $isi = '<div id="popup_dpbm">'+
						    '<div class="window_dpbm">'+
						    '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_dpbm"></a>'+
						    '    <div class="panel-body">'+
						    '    <input type="text" name="search_dpbm" id="search_dpbm" class="form-control" value="" placeholder="Cari barang...">'+
				            '	 <div class="table-responsive">'+
							'            <table class="table table-hover" id="tes">'+
							'                <thead>'+
							'                    <tr>'+
							'                        <th style="white-space:nowrap; text-align:center;">NO DPBM</th>'+
							'                        <th style="white-space:nowrap; text-align:center;">KODE BARANG</th>'+
                            '                        <th style="white-space:nowrap; text-align:center;">NAMA BARANG</th>'+
                            '                        <th style="white-space:nowrap; text-align:center;">VOLUME</th>'+
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

				$('#pojok_dpbm').click(function(){
			        $('#popup_dpbm').css('display','none');
			        $('#popup_dpbm').hide();
			        $('#search_dpbm').val("");
			    });

		       $('#popup_dpbm').css('display','block');
		       $('#popup_dpbm').show();
        }

        function get_data(){
        	var kode_barang = $('#search_dpbm').val();

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
								    '<td align="center"><a href="javascript:void(0);">'+res.NO_DPBM+'</a></td>'+
                                    '<td align="center">'+res.KODE_BARANG+'</td>'+
                                    '<td>'+res.NAMA_BARANG+'</td>'+
                                    '<td align="center">'+res.VOLUME+'</td>'+
                                    '<td align="center">'+res.SATUAN+'</td>'+
                                    '<td>'+NumberToMoney(res.HARGA)+'</td>'+
							    '</tr>';
        			});
        			$('#tes tbody').html(isine); 
        			$('#search_dpbm').off('keyup').keyup(function(){
			        	get_data();
			        });

			        $('#popup_dpbm tbody a').off('click').click(function(){
			        	var kode_anggaran = $(this).text();
			        	$(settings.result).val(kode_anggaran);
					    $('#popup_dpbm').css('display','none');
					    $('#popup_dpbm').hide();
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