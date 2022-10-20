<div id="container">
	<h1>Add APP No. for <?php echo $app_code; ?></h1>

	<div id="body">
		<form id="addProj" class="form-horizontal"  method="post">
			<input type="hidden" name="p_app_id" value="<?php echo $app_id;?>">
			<label>Code (PAP)</label></br>
	        <input type="text" name ="p_code" class="form-control" value="<?php echo $app_code; ?>" readonly></br>
			<label>APP No:</label></br>
	        <input type="text" name="p_app_no" class="form-control"></br>
	        <label>Description</label></br>
	        <input type="text" name="p_description" class="form-control">
	        <a type="submit" class="btn btn-primary pull-right" style="color:#ffffff; font-size:10px;" id="submit_app_no">Save APP no</a>
	    </form>
	</div>

                  <div class="table-responsive">
	                  <table class="table table-hover" style="font-size:12px;" id="app_no_table">
							<thead>
								<th>APP No</th>
								<th>Description</th>
								<th>Code (PAP)</th>
								<th style="width:21%">Action</th>
							</thead>
							<tbody id="app_no_list">
							</tbody>
							<tfoot>
								
							</tfoot>
						</table>
					</div>

	<a type="submit" class="btn btn-info pull-right" style="color:#ffffff; font-size:10px;" id="back_app">Back to Add APP</a>					
</div>

	  <div class="modal fade modal-open" id="projmodal_edit" role="dialog">
	    <div class="modal-dialog modal-lg" style="width:300px;">
	      <div class="modal-content">
	        <div class="modal-header">
                  <h4 class="card-title" style="font-size:16px;">Edit APP No.</h4>
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body">
	          <form id="edit_proj_form">
	          	<input type="hidden" name="e_proj_id">
	            <div >
	            	<label class="">Code (PAP)</label>
                		<input name="eproj_code" type="text" class="form-control" value="<?php echo $app_code; ?>" readonly>
	            </div>
	            <div>
	            	<label class="">APP No:</label>
                		<input name="eproj_app_no" type="text" class="form-control">
	            </div>
	            <div>
	            	<label class="">Description</label>
                		<input name="eproj_description" type="text" class="form-control">
	            </div>
	          </form>
	        </div>
	        <div class="modal-footer">
	          <a class="btn btn-default" id="modify_proj" style="color:#ffffff; font-size:10px;">UPDATE</a>
	        </div>
	      </div>
	    </div>
	  </div>

<script type="text/javascript">
	var calltoEditAppNo;
	var calltoDeleteAppNo;

$(document).ready(function(){

	loadappno();


		calltoEditAppNo = function(proj_id){
			$('#projmodal_edit').modal('show');

				$.ajax({
					url:'<?php echo base_url(); ?>proj/getproj',
					method:'POST',
					data:{'proj_id' : proj_id},
					dataType:'json',
					success: function(data){
						if(data[0].error == null){


							$.each(data, function(i, item) {
								$('input[name="e_proj_id"]').val(data[i].app_proj_id);
								$('input[name="eproj_code"]').val(data[i].app_code);
								$('input[name="eproj_app_no"]').val(data[i].app_no);
								$('input[name="eproj_description"]').val(data[i].app_proj_name);
                    		});

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
	 	}



	function loadappno(){
			$('#app_no_list').html('');
			$('#app_no_table').dataTable();
      		$('#app_no_table').dataTable().fnDestroy();

			$.ajax({
				url:'<?php echo base_url(); ?>proj/loadappno',
				method:'POST',
				data:$('#addApp').serialize(),
				dataType:'json',
				success: function(data){
					var trHTML;

	 				$.each(data, function(i, item) {
	 						trHTML += '<tr>'
	 								+ '<td>'+data[i].app_no+'</td>'
	 								+ '<td>'+data[i].app_proj_name+'</td>'
	 								+ '<td>'+data[i].app_code+'</td>'
	 								+ '<td style="padding-top:0px; padding-bottom:0px;"><a class="edit_link btn btn-info updateFlag" style="font-size:10px;" href="javascript:calltoEditAppNo('+data[i].app_proj_id+');">Edit</a>'
	 								+ '<a class="delete_link btn btn-warning deleteFlag" style="font-size:10px;" href="javascript:calltoUpdateStatAppNo('+data[i].app_proj_id+');")>Delete</a> </td></tr>';
	 								
                    });

                    $('#app_no_list').html(trHTML);
                    $('#app_no_table').DataTable( {
                        dom: 'frtip'
                    } );
				}
			});
	}



	$('#submit_app_no').click(function(){
		$.ajax({
			url:'<?php echo base_url(); ?>proj/add_proj',
			method:'POST',
			data:$('#addProj').serialize(),
			dataType:'json',
			success: function(data){
				if(data[0].error == null){
					
					$('#addProj')[0].reset();
					loadappno();
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


	$('#modify_proj').click(function(){

				$.ajax({
					url:'<?php echo base_url(); ?>proj/edit_proj',
					method:'POST',
					data:$('#edit_proj_form').serialize(),
					dataType:'json',
					success: function(data){
						if(data[0].error == null){
							loadappno();

							// $.each(data, function(i, item) {
							// 	$('input[name="e_code"]').val(data[i].app_code);
							// 	$('input[name="e_year"]').val(data[i].app_year);
							// 	$('input[name="e_description"]').val(data[i].description);
       //              		});
							
						}else{
							alert('Error :' + data[0].msg);
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


	$('#back_app').click(function(){
		window.location.href = "<?php echo base_url().'app';?>";
	});

});



</script>