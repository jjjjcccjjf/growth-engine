<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Sales of <?php echo $user->name ?></h4>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card"> 
						<div class="card-header">
							<h4 class="card-title">
								Sales list
								<button class="add-new btn btn-sm btn-info pull-right"><i class="fa fa-plus"></i> Add new</button>
							</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="basic-datatables" class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th>Project Name</th>
											<th>Amount</th>
											<th>Client Name</th>
											<th>Payment Terms</th>
											<th>Status</th>
											<th>Date created</th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Project Name</th>
											<th>Amount</th>
											<th>Client Name</th>
											<th>Payment Terms</th>
											<th>Status</th>
											<th>Date created</th>
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>
										 <?php foreach ($sales as $value): ?>
										<tr>
											<td><?php echo $value->project_name ?></td>
											<td><?php echo $value->amount ?></td>
											<td><?php echo $value->client_name ?></td>
											<td><?php echo $value->payment_terms ?></td>
											<td><?php echo $value->is_verified ?></td>
											<td><?php echo $value->created_at ?></td>
											<td><?php echo $value->id ?></td>
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
<div class="modal fade" id="staticBackdrop" data-keyboard="false" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content card">
      <div class="modal-header card-header">
        <h3 class="modal-title card-title" id="staticBackdropLabel" style="font-weight:bold">Add new Sale</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/sales/add') ?>">
         	<div class="row">
	            <div class="form-group col-md-6">
	              <label >Project Name</label>
	              <input type="text" class="form-control" name="project_name" placeholder="Project name">
	            </div>
	            <div class="form-group col-md-6">
	              <label >Project Description</label>
	              <textarea class="form-control" placeholder="Project description..." name="project_description"></textarea>
	            </div>
	            <div class="form-group col-md-6">
	              <label >Client</label>
	              <select class="form-control" name='client_id'>
	              	<?php foreach ($clients as $value): ?>
	              		<option value="<?php echo $value->id ?>"><?php echo $value->client_name ?></option>
	              	<?php endforeach ?>
	              </select>
	            </div>
	            <div class="form-group col-md-3">
	              <label >Amount (in peso)</label>
	              <input type="number" step="0.5" min="0" class="form-control" name="amount" placeholder="Amount">
	            </div>
	            <div class="form-group col-md-3">
	              <label >VAT (in percent %)</label>
	              <input type="number" class="form-control" name="vat_percent" placeholder="VAT" value="12.0">
	            </div>
	            <div class="form-group col-md-6">
	              <label >Payment Terms</label>
	              <input type="text" class="form-control" name="payment_terms" placeholder="Payment terms">
                  <small class="form-text text-muted">Example: Quarterly</small>
	            </div>
	            <div class="form-group col-md-6">
	              <label >Payment Terms Notes</label>
	              <textarea class="form-control" placeholder="Payment terms notes..." name="payment_terms_notes"></textarea>
	            </div>
	            <div class="form-group col-md-6">
	              <label >Duration</label>
	              <input type="text" class="form-control" name="duration" placeholder="Duration">
                  <small class="form-text text-muted">Example: 12 months</small>
	            </div>
	            <div class="form-group col-md-6">
	              <label >Number of Invoices</label>
	              <input type="number" class="form-control" name="num_of_invoices" min="0" placeholder="Number of Invoices">
	            </div> 
	            <div class="form-group col-md-6">
	              <label >Attachments</label>
	              <input type="file" class="form-control" name="attachments[]" multiple>
	            </div>  
	            <div class="form-group col-md-6">
	              <label >Category</label>
	              <select class="form-control" name='category'>
	              	<?php foreach ($categories as $value): ?>
	              		<option><?php echo $value ?></option>
	              	<?php endforeach ?>
	              </select>
	            </div> 
                <input type="hidden" class="form-control" name="user_id" value="<?php echo $this->session->id ?>">
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
		    "targets": 6,
		    "render": function ( data, type, row, meta ) {
		      return '<a href="'+base_url + 'cms/sales/view/' + data+'" title="Edit"><i class="fa fa-edit"></i></a>&nbsp; <a href="javascript:void(0)" class="btn-delete" data-id="'+ data +'" title="Delete"><i class="fa fa-trash"></i></a>';
		    }
		  },
		  {
		    "targets": 4,
		    "render": function ( data, type, row, meta ) {
		      if (parseInt(data)) {
		      	return '<button class="btn-success btn btn-xs btn-round" title="At least one collection"><i class="fas fa-check"></i> VERIFIED</button>'
		      } else {
		      	return '<button class="btn-warning btn btn-xs btn-round"><i class="fas fa-exclamation-triangle"></i> UNVERIFIED</button>'
		      }
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
		$('.modal').modal()
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

	 $('.btn-delete').click(function(e) {
      swal({
        title: 'Are you sure you want to delete this?',
        text: "You won't be able to revert this!",
        type: 'warning',
        icon: 'warning',
        buttons:{
          confirm: {
            text : 'Yes, delete this',
            className : 'btn btn-success'
          },
          cancel: {
            visible: true,
            text : 'No, cancel!',
            className: 'btn btn-danger'
          }
        }
      }).then((willDelete) => {
        if (willDelete) {
          // swal("Sale deleted successfully", {
          //   icon: "success",
          //   buttons : {
          //     confirm : {
          //       className: 'btn btn-success'
          //     }
          //   }
          // });

          invokeForm(base_url + 'cms/sales/delete', {id: $(this).data('id')});
        } else {
          swal("Operation cancelled", {
            buttons : {
              confirm : {
                className: 'btn btn-success'
              }
            }
          });
        }
      });
    })
});
</script>