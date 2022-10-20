<div id="container">
	<h1>Summary Report</h1>

                  <div class="table-responsive">
	                  <table class="table table-hover" style="font-size:12px;" id="summary_table">
							<thead>
								<th>Code</th>
								<th>App No.</th>
								<th>PPP Sub</th>
								<th>End User</th>
								<th>Procurement</br>Mode</th>
								<th>IB/REI</th>
								<th>Open Bids</th>
								<th>Notice of Awards</th>
								<th>Contract Signing</th>
								<th>Delivery</th>
								<th>Source of Funds</th>
								<th>Total Amount</th>
								<th>Existing PPMP</th>
								<th>Additionl</br>Allocation</th>
								<th>Procured</th>
								<th>POed</th>
								<th>Est. Balance</th>
								<th>Actual Balance</th>
							</thead>
							<tbody id="summary_data">
							</tbody>
							<tfoot>
								
							</tfoot>
						</table>
					</div>
</div>

<script type="text/javascript">
	
	$(document).ready(function(){

		get_summary();

		function get_summary(){


			$.ajax({
				url:'<?php echo base_url(); ?>reports/generatesummary',
				method:'POST',
				data:{'year' : '2022'},
				dataType:'json',
				success: function(data){
					var trHTML;

	 				$.each(data, function(i, item) {
	 						trHTML += '<tr>'
	 								+ '<td>'+data[i].app_code+'</td>'
	 								+ '<td>'+data[i].app_no+'</td>'
	 								+ '<td>'+data[i].app_proj_name +' ( '+ data[i].project_name +') </td>'
	 								+ '<td>'+data[i].end_user +'</td>'
	 								+ '<td>'+data[i].proc_mode +'</td>'
	 								+ '<td>'+data[i].ib_rei +'</td>'
	 								+ '<td>'+data[i].open_bids +'</td>'
	 								+ '<td>'+data[i].notice_awards +'</td>'
	 								+ '<td>'+data[i].contract_signing +'</td>'
	 								+ '<td>'+data[i].delivery +'</td>'
	 								+ '<td>'+data[i].source_funds +'</td>'
	 								+ '<td style="text-align: right;">'+ Number(data[i].total).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })  +'</td>'
	 								+ '<td style="text-align: right;">'+ Number(data[i].mooe).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) +'</td>'
	 								+ '<td style="text-align: right;">'+ Number(data[i].add_amount).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) +'</td>'
	 								+ '<td style="text-align: right;">'+ Number(data[i].procured).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) +'</td>'
	 								+ '<td style="text-align: right;">'+ Number(data[i].poed).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) +'</td>'
	 								+ '<td style="text-align: right;">'+ Number(data[i].est_remains).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) +'</td>'
	 								+ '<td style="text-align: right;">'+ Number(data[i].act_remains).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) +'</td>'
	 								;
	 								
                    });

                    $('#summary_data').html(trHTML);
                    $('#summary_table').DataTable( {
                        dom: 'Bfrtip'
                    } );
				}
			});


		}

	})

</script>