<div id="container">
	<h1>Additional Allocation</h1>

	<div id="body">
		<form id="add_additional" class="form-horizontal"  method="post">
	        <label>CODE (PAP)</label></br>
	        <input type="hidden" name="alloc_app"  value="<?php echo $app_id; ?>">
	        <input type="hidden" name="alloc_proj" value="<?php echo $proj_id; ?>">
	        <input type="text" name="app_code" class="form-control" value="<?php echo $app_code; ?>" readonly></br>
	        <label>Project Name</label></br>
	        <input type="text" name="end_user" class="form-control" value="<?php echo $proj_name; ?>" >
	        <label>Total Current Amount</label></br>
	        <input type="number" name="" class="form-control" value="<?php echo $proj_amount; ?>" readonly>
	        <label>Additional</label></br>
	        <input type="number" step="any" name="add_amount" class="form-control">
	     </form>
	        <a type="submit" class="btn btn-primary pull-right" style="color:#ffffff; font-size:10px;" id="submit_add_alloc">Save Additional Allocation</a>
	   

	</div>

                  <div class="table-responsive">
	                  <table class="table table-hover" style="font-size:12px;" id="allocations_table">
							<thead>
								<th>Amount</th>
								<th>Date Added</th>
								<th style="width:10%">Action</th>
							</thead>
							<tbody id="allocation_list">
							</tbody>
							<tfoot>
								
							</tfoot>
						</table>
					</div>
</div>

<script type="text/javascript">

	var calltoEdit;
	var calltoDelete;
	
	$(document).ready(function(){

		calltoAddAlloc = function(proj_id){
			
	 	}

	 	calltoUpdateStat = function(proj_id){

	 	}

	 	loadalloc();


		function loadalloc(){
			$('#allocation_list').html('');
			$('#allocations_table').dataTable();
      		$('#allocations_table').dataTable().fnDestroy();

			$.ajax({
				url:'<?php echo base_url(); ?>proc/loadalloc',
				method:'POST',
				data:{'proj_id' : $('input[name="alloc_proj"]').val()},
				dataType:'json',
				success: function(data){
					var trHTML;

	 				$.each(data, function(i, item) {
	 						trHTML += '<tr>'
	 								+ '<td style="text-align:right;">'+Number(data[i].amount).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })+'</td>'
	 								+ '<td>'+data[i].creation_date+'</td>'
	 								+ '<td style="padding-top:0px; padding-bottom:0px;">'
	 								+ '<a class="delete_link btn btn-warning deleteFlag" style="font-size:10px;" href="javascript:calltoDelete('+data[i].app_add_id+');")>Delete</a> </td></tr>';
	 								
                    });

                    $('#allocation_list').html(trHTML);
                    $('#allocations_table').DataTable( {
                        dom: 'frtip'
                    } );
				}
			});
		}

		$('#submit_add_alloc').click(function(){
			$.ajax({
				url:'<?php echo base_url(); ?>proc/add_alloc',
				method:'POST',
				data:$('#add_additional').serialize(),
				dataType:'json',
				success: function(data){
					if(data[0].error == '0'){
						
						$('#add_additional')[0].reset();

					}else{
						alert('Error :' + data[0].msg);
								//loadusers();
					}
				},
				complete: function(){

				},
				beforeSend: function(){

				},
				error: function(){

				}
			});

		});




	});


</script>