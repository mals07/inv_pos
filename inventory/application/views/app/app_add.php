<div id="container">
	<h1>Add APP</h1>

	<div id="body">
		<form id="addApp" class="form-horizontal"  method="post">
			<label>Code (PAP)</label></br>
	        <input type="text" name ="app_code" class="form-control"></br>
			<label>APP No:</label></br>
	        <input type="text" name="app_no" class="form-control"></br>
	        <label>APP Year</label></br>
	        <select name="app_year" id="app_year" class="form-control"></select></br>
	        <label>Description</label></br>
	        <input type="text" name="app_description" class="form-control">
	        <a type="submit" class="btn btn-primary pull-right" style="color:#ffffff; font-size:10px;" id="submit_app">Save APP</a>
	    </form>
	</div>

                  <div class="table-responsive">
	                  <table class="table table-hover" style="font-size:12px;" id="app_code_table">
							<thead>
								<th>Code</th>
								<th>Year</th>
								<th>Description</th>
								<th style="width:24%">Action</th>
							</thead>
							<tbody id="code_list">
							</tbody>
							<tfoot>
								
							</tfoot>
						</table>
					</div>
</div>


	  <div class="modal fade modal-open" id="appmodal_edit" role="dialog">
	    <div class="modal-dialog modal-lg">
	      <div class="modal-content">
	        <div class="modal-header">
                  <h4 class="card-title" style="font-size:16px;">Edit APP Information</h4>
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body">
	          <form id="edit_app_form">
	          	<input type="hidden" name="e_app_id">
	            <div >
	            	<label class="">Code (PAP)</label>
                		<input name="e_code" type="text" class="form-control">
	            </div>
	            <div>
	            	<label class="">APP Year</label>
                		<select name="e_year" type="text" class="form-control" id="e_year"></select>
	            </div>
	            <div>
	            	<label class="">Description</label>
                		<input name="e_description" type="text" class="form-control">
	            </div>
	          </form>
	        </div>
	        <div class="modal-footer">
	          <a class="btn btn-default" id="modify_app" style="color:#ffffff; font-size:10px;">UPDATE</a>
	        </div>
	      </div>
	    </div>
	  </div>

<script type="text/javascript">
	var calltoAddAPPNo;
	var calltoDelete;
	var calltoEdit;
	$(document).ready(function(){
		loadcodes();
		

		function loadyear(){
			$('#app_year').empty();
			$('#e_year').empty();
			for (i = new Date().getFullYear(); i > 2000; i--)
				{
				    $('#app_year').append($('<option />').val(i).html(i));
				    $('#e_year').append($('<option />').val(i).html(i));
				}
		}

		loadyear();

		calltoAddAPPNo = function(app_id){
			$.redirect('proj', {'app_id': app_id});
	 	}

	 	calltoEdit = function(app_id){
			$('#appmodal_edit').modal('show');

				$.ajax({
					url:'<?php echo base_url(); ?>app/getapp',
					method:'POST',
					data:{'app_id' : app_id},
					dataType:'json',
					success: function(data){
						if(data[0].error == null){


							$.each(data, function(i, item) {
								$('input[name="e_app_id"]').val(data[i].app_id);
								$('input[name="e_code"]').val(data[i].app_code);
								$('input[name="e_year"]').val(data[i].app_year);
								$('input[name="e_description"]').val(data[i].description);
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

	 	calltoUpdateStat = function(app_id){

	 	}


		 // $("#add_user_form").validate({
   //               rules: {
   //                   uname: {
   //                      required: true
   //                   },
   //                   password: {
   //                      required: true
   //                   },
   //                   cpassword:    {
			// 	        required : true,
			// 	        equalTo: "#passwd"
			// 	     },
   //                   fname: {
   //                      required: true
   //                   },
   //                   lname: {
   //                      required: true
   //                   }
   //               }
   //          });



		function loadcodes(){
			$('#code_list').html('');
			$('#app_code_table').dataTable();
      		$('#app_code_table').dataTable().fnDestroy();
			$.ajax({
				url:'<?php echo base_url(); ?>app/loadcodes',
				method:'POST',
				data:$('#addApp').serialize(),
				dataType:'json',
				success: function(data){
					var trHTML;
	 				$.each(data, function(i, item) {
	 						trHTML += '<tr>'
	 								+ '<td>'+data[i].app_code+'</td>'
	 								+ '<td>'+data[i].app_year+'</td>'
	 								+ '<td>'+data[i].description+'</td>'
	 								+ '<td style="padding-top:0px; padding-bottom:0px;"><a class="edit_link btn btn-info updateFlag" style="font-size:10px;" href="javascript:calltoAddAPPNo('+data[i].app_id+');">Add APP NO</a>'
	 								+ '<a class="edit_link btn btn-success updateFlag" style="font-size:10px;" href="javascript:calltoEdit('+data[i].app_id+');">Edit</a>'
	 								+ '<a class="delete_link btn btn-warning deleteFlag" style="font-size:10px;" href="javascript:calltoUpdateStat('+data[i].app_id+');")>Delete</a> </td></tr>';
	 					

                    });
                    $('#code_list').html(trHTML);
                    $('#app_code_table').DataTable({
                        dom: 'frtip'
                    });
				}
			});
		}



		$('#submit_app').click(function(){

			// if($("#add_user_form").valid() == true){
				$.ajax({
					url:'<?php echo base_url(); ?>app/add_app',
					method:'POST',
					data:$('#addApp').serialize(),
					dataType:'json',
					success: function(data){
						if(data[0].error == null){
							
							$('#addApp')[0].reset();
							loadcodes();
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
			// }

		});


		$('#modify_app').click(function(){



				$.ajax({
					url:'<?php echo base_url(); ?>app/edit_app',
					method:'POST',
					data:$('#edit_app_form').serialize(),
					dataType:'json',
					success: function(data){
						if(data[0].error == null){
							loadcodes();

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


	});


</script>
0