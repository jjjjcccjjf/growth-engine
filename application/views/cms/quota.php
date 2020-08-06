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
								Quota management
								<button class="add-new btn btn-sm btn-info pull-right"><i class="fa fa-plus"></i> Add new</button>
							</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="basic-datatables" class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th>Year</th>
											<th>Quota amount</th>
											<th>Period</th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Year</th>
											<th>Quota amount</th>
											<th>Period</th>
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>
										 <?php foreach ($res as $value): ?>
										<tr>
											<td><?php echo $value->year ?></td>
											<td><?php echo $value->quota_amount ?></td>
											<td><?php echo $value->period ?></td>
											<td><?php echo json_encode(['id' => $value->id, 'year' => $value->year, 'quota_amount' => $value->quota_amount ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?></td>
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
  <div class="modal-dialog modal-sm">
    <div class="modal-content card">
      <div class="modal-header card-header">
        <h3 class="modal-title card-title" id="staticBackdropLabel" style="font-weight:bold">Add new Quota</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/quota/add') ?>">
         	<div class="row">
	            <div class="form-group col-md-12">
	              <label >Year</label>
	              <input type="number" min="1970" class="form-control" name="year" placeholder="Year">
	              <small>Example: 2021</small>
	            </div>
	            <div class="form-group col-md-12">
	              <label >Quota amount</label>
	              <input type="number" class="form-control" name="quota_amount" placeholder="Quota amount">
	              <small>Example: 1000000</small>
	            </div>
	            <div class="form-group col-md-12">
	              <label >Period</label>
	              <input type="text" class="form-control" placeholder="Period" value="Quarterly" readonly name="period" style="color:black">
	            </div>
	             
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

<!-- Modal -->
<div class="modal update-modal fade" id="staticBackdrop2" data-keyboard="false" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content card">
      <div class="modal-header card-header">
        <h3 class="modal-title card-title" id="staticBackdropLabel" style="font-weight:bold">Update client</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/quota/update') ?>">
         	<div class="row">
	            <div class="form-group col-md-12">
	              <label >Year</label>
	              <input type="number" min="1970" class="form-control" name="year" placeholder="Year" id="up_year">
	              <small>Example: 2021</small>
	            </div>
	            <div class="form-group col-md-12">
	              <label >Quota amount</label>
	              <input type="number" class="form-control" name="quota_amount" placeholder="Quota amount" id="up_quota_amount">
	              <small>Example: 1000000</small>
	            </div>
	            <div class="form-group col-md-12">
	              <label >Period</label>
	              <input type="text" class="form-control" placeholder="Period" value="Quarterly" readonly style="color:black">
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

	$('#basic-datatables').DataTable({
		  "columnDefs": [ 
		  {
		    "targets": 3,
		    "render": function ( data, type, row, meta ) {
	    	 data = JSON.parse(data)
		      return '<button data-id="'+ data.id +'" data-year="'+data.year+'" data-quota_amount="'+data.quota_amount+'" class="edit-client btn btn-link btn-sm"><i class="fas fa-book"> Edit</button>';
		    }
		  },
		  {
	    	"targets": 1,
		    "render": function ( data, type, row, meta ) {
		      return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		    }
		  }
 	   ]
	});

	$('.add-new').on('click', function(){
		$('.add-modal').modal()
	})

	$('.edit-client').on('click', function(){
		let id = $(this).data('id')
		let year = $(this).data('year')
		let quota_amount = $(this).data('quota_amount')

		$('#up_year').val(year)
		$('#up_quota_amount').val(quota_amount)
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

	<?php elseif ($flash['color'] == 'red'): ?>
	swal("Failed", "<?php echo $flash['message'] ?>", {
		icon : "error",
		buttons: {        			
			confirm: {
				className : 'btn btn-danger'
			}
		},
	});
	<?php endif; ?>
});
</script>