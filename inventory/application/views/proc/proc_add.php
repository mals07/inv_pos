<div id="container">
	<h1>Add APP</h1>

	<div id="body">
		<form id="addProc" class="form-horizontal"  method="post">
			<label>Select Year</label></br>
		        <select type="text" id="pick_year" name ="" class="form-control">
		        </select>
		        </br>
			<label>Code (PAP)</label></br>
	        	<select type="text" id="pick_code" name ="p_code" class="form-control">
	        	</select>
	        	</br>
			<label>APP No:</label></br>
	        	<select type="text" id="pick_appno" name="p_appno" class="form-control">
	        	</select>
	        	</br>
	        <label>Project Name</label></br>
	        <input type="text" name="proc_name" class="form-control"></br>
	        <label>End User</label></br>
	        <input type="text" name="end_user" class="form-control">
	        <label>Procurement Mode</label></br>
	        <input type="text" name="proc_mode" class="form-control">
	        <label>IB/REI</label></br>
	        <input type="text" name="ib_rei" class="form-control">
	        <label>Open Bids</label></br>
	        <input type="text" name="open_bid" class="form-control">
	        <label>Notice of Awards</label></br>
	        <input type="text" name="notice_awards" class="form-control">
	        <label>Contract Signing</label></br>
	        <input type="text" name="con_sign" class="form-control">
	        <label>Delivery</label></br>
	        <input type="text" name="delivery" class="form-control">
	        <label>Source of Funds</label></br>
	        <input type="text" name="source_fund" class="form-control">
	        <label>Total Amount</label></br>
	        <input type="text" name="total" class="form-control">
	        <label>Existing PPMP</label></br>
	        <input type="text" name="mooe" class="form-control">
	     </form>
	        <a type="submit" class="btn btn-primary pull-right" style="color:#ffffff; font-size:10px;" id="submit_proc">Save Procurement Project</a>
	   

	</div>

                  <div class="table-responsive">
	                  <table class="table table-hover" style="font-size:12px;" id="app_proc_table">
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
								<th style="width:10%">Action</th>
							</thead>
							<tbody id="proc_list">
							</tbody>
							<tfoot>
								
							</tfoot>
						</table>
					</div>
</div>

<script type="text/javascript">
	var calltoAddAlloc;
	var calltoDelete;

	$(document).ready(function(){

		calltoAddAlloc = function(proj_id){
			$.redirect('proc/additional_alloc', {'proj_id': proj_id});
	 	}

	 	calltoUpdateStat = function(proj_id){

	 	}

//--------------- INITIAL LOAD ------------------
		$('#pick_code').change(function(){
		  var app_id= $(this).val();

		  	$.ajax({
				url:'<?php echo base_url(); ?>proc/loadappno',
				method:'POST',
				data:{'app_id' : app_id},
				dataType:'json',
				success: function(data){
					console.log(data);

					$('#pick_appno').html();
	 				$.each(data, function(i, item) {
	 					$('#pick_appno').append($('<option />').val(data[i].app_proj_id).html(data[i].app_no));		
	 						
                    });
				}
			});
          
		});


		$('#pick_year').change(function(){
		  var appyear= $(this).val();

		  	$.ajax({
				url:'<?php echo base_url(); ?>proc/loadapps',
				method:'POST',
				data:{'app' : appyear},
				dataType:'json',
				success: function(data){
					console.log(data);

					$('#pick_code').html();
	 				$.each(data, function(i, item) {
	 					$('#pick_code').append($('<option />').val(data[i].app_id).html(data[i].app_code));		
                    });
	 				$('#pick_code').trigger('change');

				}
			});
          
		});

		loadyear();
		loadproc();

		function loadyear(){
			$('#pick_year').html();
			for (i = new Date().getFullYear(); i > 2000; i--)
				{
				    $('#pick_year').append($('<option />').val(i).html(i));
				}
			$('#pick_year').trigger('change');
		}


		function loadproc(){
			$('#proc_list').html('');
			$('#app_proc_table').dataTable();
      		$('#app_proc_table').dataTable().fnDestroy();

			$.ajax({
				url:'<?php echo base_url(); ?>proc/loadproc',
				method:'POST',
				data:$('#addApp').serialize(),
				dataType:'json',
				success: function(data){
					var trHTML;
	 				$.each(data, function(i, item) {
	 						trHTML += '<tr>'
	 								+ '<td>'+data[i].app_code+'</td>'
	 								+ '<td>'+data[i].apj_no+'</td>'
	 								+ '<td>'+data[i].project_name+'</td>'
	 								+ '<td>'+data[i].end_user+'</td>'
	 								+ '<td>'+data[i].proc_mode+'</td>'
	 								+ '<td>'+data[i].ib_rei+'</td>'
	 								+ '<td>'+data[i].open_bids+'</td>'
	 								+ '<td>'+data[i].notice_awards+'</td>'
	 								+ '<td>'+data[i].contract_signing+'</td>'
	 								+ '<td>'+data[i].delivery+'</td>'
	 								+ '<td>'+data[i].source_funds+'</td>'
	 								+ '<td style="text-align: right;">'+Number(data[i].total).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })+'</td>'
	 								+ '<td style="text-align: right;">'+Number(data[i].mooe).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })+'</td>'
	 								+ '<td style="padding-top:0px; padding-bottom:0px;"><a class="edit_link btn btn-info updateFlag" style="font-size:10px;" href="javascript:calltoAddAlloc('+data[i].proj_id+');">Add Allocation</a>'
	 								+ '<a class="delete_link btn btn-warning deleteFlag" style="font-size:10px;" href="javascript:calltoUpdateStat('+data[i].proj_id+');")>Delete</a> </td></tr>';
	 					

                    });
                    $('#proc_list').html(trHTML);
                    $('#app_proc_table').DataTable( {
                        dom: 'frtip'
                    } );
				}
			});
		}


//--------------- INITIAL LOAD END ------------------


		$('#submit_proc').click(function(){
			$.ajax({
				url:'<?php echo base_url(); ?>proc/add_proc',
				method:'POST',
				data:$('#addProc').serialize(),
				dataType:'json',
				success: function(data){
					if(data[0].error == null){
						
						$('#addProc')[0].reset();
						loadproc();
								//window.location.href = "<?php echo base_url().'users';?>";
								//loadusers();
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