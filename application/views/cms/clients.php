<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<!-- <div class="page-header">
				<h4 class="page-title">Clients</h4>
			</div> -->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">
								Clients list
								<button class="add-new btn btn-sm btn-info pull-right"><i class="fa fa-plus"></i> Add new</button>
							</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="basic-datatables" class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th>Client name</th>
											<th>Remarks</th>
											<th>Date created</th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Client name</th>
											<th>Remarks</th>
											<th>Date created</th>
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>
										 <?php foreach ($res as $value): ?>
										<tr>
											<td><?php echo $value->client_name ?></td>
											<td><?php echo $value->remarks ?></td>
											<td><?php echo $value->created_at ?></td>
											<td><?php echo json_encode(['id' => $value->id, 'client_name' => $value->client_name, 'remarks' => $value->remarks ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?></td>
										</tr>
										 <?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal add-modal fade" id="staticBackdrop" data-keyboard="false" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content card">
      <div class="modal-header card-header">
        <h3 class="modal-title card-title" id="staticBackdropLabel" style="font-weight:bold">Add new Client</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form role="form" class="dcheck" method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/clients/add') ?>">
         	<div class="row">
	            <div class="form-group col-md-12">
	              <label >Client Name</label>
	              <input type="text" class="form-control" name="client_name" placeholder="Client name">
	            </div>
	            <div class="form-group col-md-12">
	              <label >Remarks</label>
	              <textarea class="form-control" placeholder="Remarks" name="remarks"></textarea>
                  <small class="form-text text-muted"><b>(Note) Please include:</b> <b>Contact persons</b>, <b>Contact Info</b>, <b>Collection Schedule</b>, and <b>Address</b></small>

	            </div>

         	</div>
          </div>
          <div class="modal-footer card-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            <input class="btn btn-primary dcheck-btn" type="submit" value="Save changes">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal update-modal fade" id="staticBackdrop2" data-keyboard="false" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content card">
      <div class="modal-header card-header">
        <h3 class="modal-title card-title" id="staticBackdropLabel" style="font-weight:bold">Update client</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/clients/update') ?>">
         	<div class="row">
	            <div class="form-group col-md-12">
	              <label >Client Name</label>
	              <input type="text" class="form-control" name="client_name" placeholder="Client name" id="up_client_name">
	            </div>
	            <div class="form-group col-md-12">
	              <label >Remarks</label>
	              <textarea class="form-control" placeholder="Remarks" name="remarks" id="up_remarks"></textarea>
                  <small class="form-text text-muted"><b>(Note) Please include:</b> <b>Contact persons</b>, <b>Contact Info</b>, <b>Collection Schedule</b>, and <b>Address</b></small>

	            </div>
	             <input type="hidden" name="id" id="up_id">
         	</div>
          </div>
          <div class="modal-footer card-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            <input class="btn btn-primary" type="submit" value="Save changes">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function($) {

	// disable submit block
	$('.dcheck').on('submit', function(){
		console.log($('.dcheck-btn').attr('disabled', true).val('Loading...'))
	})
	// End disable submit block
	$('#basic-datatables').DataTable({
		  "columnDefs": [
		  {
		    "targets": 3,
		    "render": function ( data, type, row, meta ) {
	    	 data = JSON.parse(data)
		      return '<button data-id="'+ data.id +'" data-client_name="'+data.client_name+'" data-remarks="'+data.remarks+'" class="edit-client btn btn-link btn-sm"><i class="fas fa-book"> Edit</button>';
		    }
		  }
 	   ]
	});

	$('.add-new').on('click', function(){
		$('.add-modal').modal()
	})

	$('.edit-client').on('click', function(){
		let id = $(this).data('id')
		let client_name = $(this).data('client_name')
		let remarks = $(this).data('remarks')

		$('#up_client_name').val(client_name)
		$('#up_remarks').val(remarks)
		$('#up_id').val(id)
		$('.update-modal').modal()

	})

	<?php $flash = $this->session->flash_msg; if ($flash['color'] == 'green'): ?>
	swal("Success", "<?php echo $flash['message'] ?>", {
		icon : "success",
		buttons: {
			confirm: {
				className : 'btn btn-success'
			}
		},
	});
	<?php endif; ?>
});
</script>
