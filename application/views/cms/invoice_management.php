<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title"><?php echo $title ?></h4>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card"> 
						<div class="card-header">
							<h4 class="card-title">
								<?php echo $title ?> &nbsp; 
								<br>
								<small style="color:gainsboro">Scroll to the right or zoom out to see more options</small>
 							<?php if ($this->uri->segment(3) == 'invoice_management'): ?>
 								<?php if (@$_GET['show_all']): ?>
									(All) &nbsp; 
									<a href="<?php echo current_url()?>">
										<button class="add-new btn btn-sm btn-info"><i class="fa fa-eye"></i> Show This Month & Uncollected only</button>
									</a>
								<?php else: ?>
									(Uncollected) &nbsp; 
									<a href="<?php echo current_url() . '?show_all=1'?>">
										<button class="add-new btn btn-sm btn-danger"><i class="fa fa-eye"></i> Show All</button>
									</a>
								<?php endif; ?> 
							<?php endif; ?> 
							</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="basic-datatables" class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th>Invoice name</th>
											<th>Project name</th>
											<th>Collect amount (in Peso)</th>
											<th>Due date</th>
											<th>Status</th>
											<th>Quickbooks ID</th>
											<th>Date created</th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Invoice name</th>
											<th>Project name</th>
											<th>Collect amount (in Peso)</th>
											<th>Due date</th>
											<th>Status</th>
											<th>Quickbooks ID</th>
											<th>Date created</th>
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>
										 <?php if(@$invoices): foreach ($invoices as $value): ?>
										<tr>
											<td><?php echo $value->invoice_name ?></td>
											<td><?php echo $value->project_name ?></td>
											<td><?php echo $value->collected_amount ?></td>
											<td><?php echo $value->due_date ?></td>
											<td><?php echo json_encode(['collected_date' => $value->collected_date, 'sent_date' => $value->sent_date]) ?></td>
											<td><?php echo $value->quickbooks_id ?></td>
											<td><?php echo $value->created_at ?></td>
											<td><?php echo json_encode(['id' => $value->id, 'collected_date' => $value->collected_date, 'sent_date' => $value->sent_date]) ?></td>
										</tr>
										 <?php endforeach; endif; ?>
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
<div class="modal fade" id="staticBackdrop1" data-keyboard="false" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content card">
      <div class="modal-header card-header">
        <h3 class="modal-title card-title" id="staticBackdropLabel" style="font-weight:bold">Collected when?</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/finance/collect') ?>">
         	<div class="row">
	         	<div class="col-md-12 form-group">
	              <label >Collected date</label>
	              <input type="date" class="form-control" name="collected_date" required="required">
	              <small>This field is required.</small> 
				  <br>
	              <label >Attachments</label>
	              <input type="file" name="attachments[]" class="form-control" multiple>

	              <input type="hidden"  name="id">
	            </div>
	             
         	</div>
          </div>
          <div class="modal-footer card-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            <input class="btn btn-primary" type="submit" value="Tag as collected">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop2" data-keyboard="false" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content card">
      <div class="modal-header card-header">
        <h3 class="modal-title card-title" id="staticBackdropLabel" style="font-weight:bold">Delivered when?</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/finance/deliver') ?>">
         	<div class="row">
	         	<div class="col-md-12 form-group">      
				  <label >Date sent to Client</label>
	              <input type="date" class="form-control" name="sent_date" required="required">
	              <small>This field is required.</small>
				  <br>
	              <label >Received by</label>
	              <input type="text" class="form-control" name="received_by" required="required" placeholder="Received by">
	              <small>This field is required.</small>
				  <br>
	              <label >Attachments</label>
	              <input type="file" name="attachments[]" class="form-control" multiple>

	              <input type="hidden"  name="id">
	            </div>
	             
         	</div>
          </div>
          <div class="modal-footer card-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            <input class="btn btn-primary" type="submit" value="Tag as delivered">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function($) {
	var invoices = []
	<?php if (@$invoices): foreach($invoices as $value): ?>
	    invoices[<?php echo $value->id ?>] = '<?php echo $value->invoice_name ?>'
	<?php endforeach; endif; ?>
	$('#basic-datatables').DataTable({
		  "columnDefs": [ {
		    "targets": 7,
		    "render": function ( data, type, row, meta ) {
		    	data = JSON.parse(data)
		      	
		      	let stringy = '' 
		      	let collect_button = '<button data-id="' + data.id +'" class="btn btn-link btn-sm btn-collect" title="Tag as collected"><i class="fa fa-check"></i> Tag as collected</button>'
		      	let delivered_button = '<button data-id="' + data.id +'" class="btn btn-link btn-sm btn-deliver" title="Tag as delivered"><i class="fa fa-box"></i> Tag as delivered</button>'
		      	let view = '<a href="<?php echo base_url('cms/finance/view_invoice/') ?>'+ data.id +'"><button class="btn btn-link btn-sm view-invoice" title="View invoice"><i class="fas fa-book"></i> Details</button></a>'
		    	
		    	if (!data.collected_date || !data.sent_date) {
		    		stringy = view
		    		<?php if(in_array($this->session->role, ['collection'])): ?>
		    			if (!data.sent_date) {
		    				stringy = stringy + delivered_button
		    			}
		    			if (!data.collected_date) {
		    				stringy = stringy + collect_button
		    			}
		    		<?php endif; ?>
		    		return stringy
		    	} else {
		    		return view
		    	}
		    }
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
		    	data = JSON.parse(data)

		    	let str = ''
		    	if (data.collected_date) {
     	      		str = str + '<button style="margin-top:4px" class="btn-success btn btn-xs btn-round"><i class="fas fa-check"></i>COLLECTED</button>'
		    	} else {
		    		str = str + '<button style="margin-top:4px" class="btn-warning btn btn-xs btn-round"><i class="fas fa-exclamation-triangle"></i> UNCOLLECTED</button>'
		    	}		    	

		    	if (data.sent_date) {
     	      		str = str + '<button style="margin-top:4px" class="btn-success btn btn-xs btn-round"><i class="fas fa-check"></i> DELIVERED</button>'
		    	} else {
		    		str = str + '<button style="margin-top:4px" class="btn-warning btn btn-xs btn-round"><i class="fas fa-exclamation-triangle"></i> UNDELIVERED</button>'
		    	}

		    	return str
		    }
		  }

		   ]
	});

	$('html').on('click', '.btn-collect', function(e){
		e.preventDefault()
		$('input[name=id]').val($(this).data('id'))
		$('#staticBackdropLabel').text('Collect date for ' + invoices[$(this).data('id')])
		$('#staticBackdrop1').modal()
	})

	$('html').on('click', '.btn-deliver', function(e){
		e.preventDefault()
		$('input[name=id]').val($(this).data('id'))
		$('#staticBackdropLabel').text('Collect date for ' + invoices[$(this).data('id')])
		$('#staticBackdrop2').modal()
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