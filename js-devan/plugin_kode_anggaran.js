(function ( $ ) {
 
    $.kd_anggaran = function(shade) {
        var settings = $.extend({
            // These are the defaults.
            selector : "#koang",
            url : "",
            result : "",
            color: "blue",
            backgroundColor: "white",
            data : {},
        }, shade );

        var ajax = "";
        var url_plus = "";

        function tabel(){

        	var $isi = '<div id="popup_koang">'+
						    '<div class="window_koang">'+
						    '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
						    '    <div class="panel-body">'+
						    '    <input type="text" name="search_koang" id="search_koang" class="form-control" value="" placeholder="Cari perkiraan...">'+
				            '	 <div class="table-responsive">'+
							'            <table class="table table-hover" id="tes">'+
							'                <thead>'+
							'                    <tr>'+
							'                        <th>NO</th>'+
							'                        <th style="white-space:nowrap; text-align:center;">KODE ANGGARAN</th>'+
							'                        <th>URAIAN</th>'+
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
			        $('#search_koang').val("");
			    });

		       $('#popup_koang').css('display','block');
		       $('#popup_koang').show();
        }

        function get_data(){
        	var koper = $('#search_koang').val();

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
        			keyword : koper,
        		},
        		success : function(result){
        			var isine = '';
        			var no = 0;
        			$.each(result,function(i,res){
        				no++;
        				isine += '<tr>'+
								    '<td align="center">'+no+'</td>'+
								    '<td align="center"><a href="javascript:void(0);">'+res.KODE_ANGGARAN+'</a></td>'+
								    '<td>'+res.URAIAN+'</td>'+
							    '</tr>';
        			});
        			$('#tes tbody').html(isine); 
        			$('#search_koang').off('keyup').keyup(function(){
			        	get_data();
			        });

			        $('#popup_koang tbody a').off('click').click(function(){
			        	var kode_anggaran = $(this).text();
			        	$(settings.result).val(kode_anggaran);
					    $('#popup_koang').css('display','none');
					    $('#popup_koang').hide();
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