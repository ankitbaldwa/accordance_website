"use strict";
var KTDatatablesDataSourceAjaxServer = function() {

	var initTable1 = function() {
		var table = $('#kt_table_1');
		// begin first table
		table.DataTable({
			responsive: true,
			scrollY: '35vh',
			scrollX: true,
			scrollCollapse: true,
			dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>
			<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,

			buttons: [
				{
					extend: 'print',
					text: 'Print',
					exportOptions: {
						modifier: {
							page: 'current'
						},
						columns: ':visible'
					},
					customize: function (win) {
						//$(win.document.body).find('table').addClass('display').css('font-size', '9px');
						/*$(win.document.body).find('tr:nth-child(odd) td').each(function(index){
							$(this).css('background-color','#D0D0D0');
						});*/
						$(win.document.body).find('h1').css('text-align','center').text(jQuery('.kt-subheader__title').text());
					}
				},
				//'copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdfHtml5',
			],
			//searchDelay: 500,
			processing: true,
			serverSide: true,
			order: [[ 0, "desc" ]],
			ajax: {
				"url": url,
				'type': 'POST',
				'headers': {
					'X-CSRF-Token': csrfToken
				}
			},
			columnDefs: column,
			oLanguage: {
				sProcessing: '<div class="col-sm"><div class="kt-spinner kt-spinner--lg kt-spinner--info"></div></div>'
			}
		});
		$('#export_print').on('click', function(e) {
			e.preventDefault();
			table.button(0).trigger();
		});

		$('#export_copy').on('click', function(e) {
			e.preventDefault();
			table.button(1).trigger();
		});

		$('#export_excel').on('click', function(e) {
			e.preventDefault();
			table.button(2).trigger();
		});

		$('#export_csv').on('click', function(e) {
			e.preventDefault();
			table.button(3).trigger();
		});

		$('#export_pdf').on('click', function(e) {
			e.preventDefault();
			table.button(4).trigger();
		});
	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesDataSourceAjaxServer.init();
});
jQuery(document).on('click','.edit, .add, .view', function(){
	var $this = jQuery(this);
	var url = $this.attr('data-url');
	jQuery.ajax({
		'url': url, 
		'type': 'GET',
		'headers': {
			'X-CSRF-Token': csrfToken
		},
		'success': function(result){
			jQuery(".content-data").html(result);
			jQuery(".modal-title").text($this.attr('title'));
			setSelect2Field();
			jQuery('#kt_modal_country').modal({
				'show': true,
				'backdrop': 'static'
			});
	  	}
	});
});
jQuery(document).on('click','.status', function(e) {
	var $this = jQuery(this);
	var status = $this.find('span').text();
	if(status == 'Active')
		status = 'Inactive';
	else
		status = 'Active';
	var url = $this.attr('data-url');
	swal.fire({
		title: 'Are you sure do you want to change status to '+status+'?',
		text: "",
		type: 'info',
		showCancelButton: true,
		confirmButtonText: 'Yes, change status!'
	}).then(function(result) {
		if (result.value) {
			jQuery.ajax({
				'url': url, 
				'type': 'POST',
				'headers': {
					'X-CSRF-Token': csrfToken
				},
				'data': {'status': status },
				'success': function(result){
					$this.find('span').text(status);
					if(status == 'Active')
						$this.find('span').removeClass('kt-badge--danger').addClass('kt-badge--success');
					else
						$this.find('span').removeClass('kt-badge--success').addClass('kt-badge--danger');
					swal.fire(
						'Status Changed!',
						'',
						'success'
					)
				  }
			});
		}
	});
});
function setSelect2Field(){
	jQuery(".country").select2({
		placeholder: "Select Country",
		width: '100%'
	}).on("change", function (e) {
		var str = $(this).select2('data');
		DOSelectAjaxProd(str, $(this));
  	});
	jQuery(".state").select2({
		placeholder: "Select Country First",
		width: '100%'
	});
}