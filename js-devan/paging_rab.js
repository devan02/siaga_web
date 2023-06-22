function paging_preview_rab(){

	window.tp = new Pagination('#tablePagingRAB', {
		itemsCount: $('#data_preview_rab tbody').find('tr').length,
		pageSize : 10,
		onPageSizeChange: function (ps) {
			console.log('changed to ' + ps);
		},
		onPageChange: function (paging) {
			//custom paging logic here
			//console.log(paging);
			var start = paging.pageSize * (paging.currentPage - 1),
				end = start + paging.pageSize,
				$rows = $('#data_preview_rab tbody').find('tr');

			$rows.hide();

			for (var i = start; i < end; i++) {
				$rows.eq(i).show();
			}
		}
	});
}