<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title"><?php echo $title ?> </h4>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card"> 
						<div class="card-header">
							<h4 class="card-title">
								<?php echo $title ?>
								<a href="<?php echo base_url('cms/sales/export') ?>" class="btn btn-sm btn-warning pull-right" style="margin-right: 15px"><i class="fa fa-download"></i> Export Sales (this month)</a>
								<a href="<?php echo base_url('cms/finance/export') ?>" class="btn btn-sm btn-warning pull-right" style="margin-right: 15px"><i class="fa fa-download"></i> Export Collected (this month)</a>

								<!-- <button class="add-new btn btn-sm btn-info pull-right"><i class="fa fa-plus"></i> Add new</button> -->
							</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="basic-datatables" class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th>Project Name</th>
											<th>Sales Rep.</th>
											<th>Amount left</th>
											<th>Client Name</th>
											<!-- <th>Payment Terms</th> -->
											<th>Status</th>
											<th>Invoice(s) remaining</th>
											<!-- <th>Date created</th> -->
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Project Name</th>
											<th>Amount left</th>
											<th>Client Name</th>
											<!-- <th>Payment Terms</th> -->
											<th>Status</th>
											<th>Invoice(s) remaining</th>
											<!-- <th>Date created</th> -->
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>
										 <?php foreach ($sales as $value): ?>
										<tr>
											<td><?php echo $value->project_name ?></td>
											<td><?php echo $value->sales_rep ?></td>
											<td><?php echo $value->amount_left ?></td>
											<td><?php echo $value->client_name ?></td>
											<!-- <td><?php echo $value->payment_terms ?></td> -->
											 <td><?php echo $value->is_verified ?></td> 
											<td><?php echo $value->invoice_remaining ?></td>
											<!-- <td><?php echo $value->created_at ?></td> -->
											<td>{"id": "<?php echo $value->id ?>", "invoice_remaining": "<?php echo $value->invoice_remaining ?>"}</td>
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
        <h3 class="modal-title card-title" id="staticBackdropLabel" style="font-weight:bold">Issue Invoice</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/finance/add') ?>">
         	<div class="row">
	            <div class="form-group col-md-6">
	              <label >Invoice name</label>
	              <input type="text" class="form-control" name="invoice_name" placeholder="Invoice name">
	            </div> 
	            <div class="form-group col-md-6">
	              <label >Project</label>
	              <select class="form-control" name='sale_id'>
	              	<?php foreach ($sales as $value): ?>
	              		<option value="<?php echo $value->id ?>"><?php echo $value->project_name ?></option>
	              	<?php endforeach ?>
	              </select>
	            </div>  
	            <div class="form-group col-md-6">
	              <label >Invoice amount (in peso)</label>
	              <input type="number" step="0.01" min="0" class="form-control" name="invoice_amount" placeholder="Invoice amount">
	            </div>
	            <div class="form-group col-md-6">
	              <label >Due Date</label>
	              <input type="date" class="form-control" name="due_date" placeholder="">
	            </div> 
	            <div class="form-group col-md-6">
	              <label >Quickbooks ID</label>
	              <input type="text" class="form-control" name="quickbooks_id" placeholder="Quickbooks ID">
	            </div> 
	            <div class="form-group col-md-6">
	              <label >Attachments</label>
	              <input type="file" class="form-control" name="attachments[]" multiple>
	            </div>  
         	</div>
          </div>
          <div class="modal-footer card-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            <input class="btn btn-primary" type="submit" value="Create Invoice">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function($) {

	$('#basic-datatables').DataTable({
		  "columnDefs": [ {
		    "targets": 6,
		    "render": function ( data, type, row, meta ) {
		      data = JSON.parse(data)
		      let issue_invoice ='<button class="btn-link btn issue-invoice btn-sm" data-id="' + data.id +'"> <i class="fa fa-pen"></i> Issue Invoice</button>'
		      let view = '<button class="btn btn-link btn-sm"><a href="'+base_url + 'cms/sales/view/' + data.id+'" title="View"><i class="fas fa-book"></i> Details</a></button>'
		      let stringy = view
		      if (data.invoice_remaining > 0) {
		      	stringy = stringy + issue_invoice
		      }
		      return stringy;
		    },
		  },
  		  {
		    "targets": 2,
		    "render": function ( data, type, row, meta ) {
		      return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
		  }]
	});

	$('.add-new').on('click', function(){
		$('.modal').modal()
	})

	$('html').on('click', '.issue-invoice', function(){
		let sale_id = $(this).data('id')
		$('select[name=sale_id]').val(sale_id).change()
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
});
</script>