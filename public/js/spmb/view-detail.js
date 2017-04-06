var myToken = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function() {
	$('.view-detail-spmb-item').click(function() {
		clearDetail();
		loadDetail($(this).data('detail-id'));
		$('#modalViewDetailSPMB').modal();
	});
});

function loadDetail(id) 
{
	$.ajax({
		url: base_url + 'spmb/api/loadDetail',
		dataType: 'json',
		type: 'POST',
		data: { 
				_token: myToken,
                spmb_detail_id: id },
        error: function(data) {
        	console.log('error loading data..');
        	alert('Error loading data...');
        },
        success: function(data) {
        	//console.log(data);
 			$('#span_item_category_name').append(data.detail.itemcategory.item_category_name);
			$('#span_spmb_detail_account_no').append(data.detail.spmb_detail_account_no);
			$('#span_spmb_detail_item_name').append(data.detail.spmb_detail_item_name);
			$('#span_unit_name').append(data.detail.unit.unit_name);
			$('#span_spmb_detail_qty').append(data.detail.spmb_detail_qty);
			$('#span_spmb_detail_note').append(data.detail.spmb_detail_note);    

			var tbl = '';
			$.each(data.detail.spmbdetailvendors, function(key, value) {
				tbl += '<tr>';
				tbl += '<td>' + value.vendor.vendor_name + '</td>';
				tbl += '<td>' + convertNumber(value.spmb_detail_vendor_offer_price) + '</td>';
				tbl += '<td>' + convertNumber(value.spmb_detail_vendor_deal_price) + '</td>';
				tbl += '<td>' + ((value.spmb_detail_vendor_status=='1') ? 'DEAL' : 'WAITING') + '</td>';
				tbl += '<td>' + ((value.spmb_detail_vendor_note==null) ? '-' : value.spmb_detail_vendor_note) + '</td>';
				tbl += '</tr>';
			});

			$('#vendor-tables').append(tbl);
        }
	});
}

function clearDetail()
{
	$('#span_item_category_name').empty();
	$('#span_spmb_detail_account_no').empty();
	$('#span_spmb_detail_item_name').empty();
	$('#span_unit_name').empty();
	$('#span_spmb_detail_qty').empty();
	$('#span_spmb_detail_note').empty();

	$('#vendor-tables tbody').empty();
}