<div id="container">
	<h1>Add Expended Entry</h1>

	<div id="body">
		<form id="add_entry" class="form-horizontal"  method="post">
			<label>Select Year</label></br>
		        <select type="text" id="entry_year" name ="entry_year" class="form-control">
		        </select>
		        </br>
		    <label>Code (PAP)</label></br>
	        	<select type="text" id="entry_n_code" name ="entry_app" class="form-control">
	        	</select>
	        	</br>
			<label>APP No:</label></br>
	        	<select type="text" id="entry_n_appno" name="entry_appno" class="form-control">
	        	</select>
	        	</br>
	        <label>Project Name</label></br>
	        	<select type="text" id="entry_n_proj" name="entry_proj" class="form-control">
	        	</select>
	        	</br>
	        <label>Entry Type</label></br>
	        	<select type="text" id="entry_type" name="entry_type" class="form-control">
	        		<option value="PROCURED">PROCURED</option>
	        		<option value="PO">PO</option>
	        	</select>
	        <label>Particulars</label></br>
	        <textarea name="particulars" class="form-control"></textarea>
	        <label>Amount</label></br>
	        <input type="number" step="any" name="entry_amount" class="form-control">
	     </form>
	        <a type="submit" class="btn btn-primary pull-right" style="color:#ffffff; font-size:10px;" id="submit_entry">Submit Entry</a>
	   

	</div>

                  <div class="table-responsive">
	                  <table class="table table-hover" style="font-size:12px;" id="entry_table">
							<thead>
								<th>Year</th>
								<th>Code (PAP)</th>
								<th>App No.</th>
								<th>Project Name</th>
								<th>Entry Type</th>
								<th>Amount</th>
								<th style="width:10%">Action</th>
							</thead>
							<tbody id="entry_list">
							</tbody>
							<tfoot>
								
							</tfoot>
						</table>
					</div>
</div>

<script type="text/javascript">
	
	$(document).ready(function(){


//--------------------------------------------------------
			
		loadentry();

		$('#entry_year').change(function(){
		  var appyear= $(this).val();

		  	$.ajax({
				url:'<?php echo base_url(); ?>proc/loadapps',
				method:'POST',
				data:{'app' : appyear},
				dataType:'json',
				success: function(data){
					console.log(data);

					$('#entry_n_code').empty();
					$('#entry_n_appno').empty();
					$('#entry_n_proj').empty();
	 				$.each(data, function(i, item) {
	 					$('#entry_n_code').append($('<option />').val(data[i].app_id).html(data[i].app_code));		
                    });
	 				$('#entry_n_code').trigger('change');

				}
			});
          
		});


		$('#entry_n_code').change(function(){
		  var app_id= $(this).val();

		  	$.ajax({
				url:'<?php echo base_url(); ?>proc/loadappno',
				method:'POST',
				data:{'app_id' : app_id},
				dataType:'json',
				success: function(data){
					console.log(data);

					$('#entry_n_appno').empty();
					$('#entry_n_proj').empty();
	 				$.each(data, function(i, item) {
	 					$('#entry_n_appno').append($('<option />').val(data[i].app_proj_id).html(data[i].app_no));		
	 						
                    });
                    $('#entry_n_appno').trigger('change');
				}
			});
          
		});


		$('#entry_n_appno').change(function(){
		  var app_proj_id= $(this).val();

		  	$.ajax({
				url:'<?php echo base_url(); ?>proc/loadproj',
				method:'POST',
				data:{'app_proj_id' : app_proj_id},
				dataType:'json',
				success: function(data){
					console.log(data);
					$('#entry_n_proj').empty();
	 				$.each(data, function(i, item) {
	 					$('#entry_n_proj').append($('<option />').val(data[i].proj_id).html(data[i].project_name));		
	 						
                    });
				}
			});
          
		});

		loadyear();
		//loadproc();

		function loadyear(){
			$('#entry_year').empty();
			for (i = new Date().getFullYear(); i > 2000; i--)
				{
				    $('#entry_year').append($('<option />').val(i).html(i));
				}
			$('#entry_year').trigger('change');
		}


		function loadentry(){
			$('#entry_list').html('');
			$('#entry_table').dataTable();
      		$('#entry_table').dataTable().fnDestroy();

			$.ajax({
				url:'<?php echo base_url(); ?>entry/loadentry',
				method:'POST',
				dataType:'json',
				success: function(data){
					var trHTML;

	 				$.each(data, function(i, item) {
	 						trHTML += '<tr>'
	 								+ '<td>'+data[i].year+'</td>'
	 								+ '<td>'+data[i].app_code+'</td>'
	 								+ '<td>'+data[i].app_no+'</td>'
	 								+ '<td>'+data[i].app_proj_name+' - ' +data[i].project_name+ '</td>'
	 								+ '<td>'+data[i].entry_type+'</td>'
	 								+ '<td style="text-align:right;">'+Number(data[i].amount).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })+'</td>'
	 								+ '<td style="padding-top:0px; padding-bottom:0px;">'
	 								+ '<a class="delete_link btn btn-warning deleteFlag" style="font-size:10px;" href="javascript:calltoDelete('+data[i].entry_id+');")>Delete</a> </td></tr>';
	 								
                    });

                    $('#entry_list').html(trHTML);
                    $('#entry_table').DataTable( {
                        dom: 'frtip'
                    } );
				}
			});
		}



//--------------- INITIAL LOAD END ------------------



		$('#submit_entry').click(function(){
			$.ajax({
				url:'<?php echo base_url(); ?>entry/add_entry',
				method:'POST',
				data:$('#add_entry').serialize(),
				dataType:'json',
				success: function(data){
					if(data[0].error == null){
						
						$('#add_entry')[0].reset();
						loadentry();
						//loadproc();
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