<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Invoice List</h4>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card"> 
						<div class="card-header">
							<h4 class="card-title">
								Invoice List &nbsp; 
								<?php if (@$_GET['show_all']): ?>
									(All) &nbsp; 
									<a href="<?php echo base_url('cms/finance/invoice_management')?>">
										<button class="add-new btn btn-sm btn-info"><i class="fa fa-eye"></i> Show This Month & Uncollected only</button>
									</a>
								<?php else: ?>
									(Uncollected) &nbsp; 
									<a href="<?php echo base_url('cms/finance/invoice_management?show_all=1')?>">
										<button class="add-new btn btn-sm btn-danger"><i class="fa fa-eye"></i> Show All</button>
									</a>
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
											<th>Collect date</th>
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
											<th>Collect date</th>
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
											<td><?php echo $value->collected_date ?></td>
											<td><?php echo $value->quickbooks_id ?></td>
											<td><?php echo $value->created_at ?></td>
											<td>{"id": "<?php echo $value->id ?>", "is_collected": "<?php echo ($value->collected_date == '0000-00-00 00:00:00' || $value->collected_date == null ) ?>"}</td>
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
<div class="modal fade" id="staticBackdrop" data-keyboard="false" tabindex="-1" role="dialog">
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
	              <!-- <label >Collected date</label> -->
	              <input type="datetime-local" class="form-control" name="collected_date" required="required">
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
		      	let view = '<a href="<?php echo base_url('cms/finance/view_invoice/') ?>'+ data.id +'"><button class="btn btn-link btn-sm view-invoice" title="View invoice"><i class="fas fa-book"></i> Details</button></a>'
		    	
		    	if (data.is_collected) {
		    		stringy = view
		    		<?php if(in_array($this->session->role, ['collection'])): ?>
		    			stringy = stringy + collect_button
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
		  }

		   ]
	});

	$('.btn-collect').on('click', function(e){
		e.preventDefault()
		$('input[name=id]').val($(this).data('id'))
		$('#staticBackdropLabel').text('Collect date for ' + invoices[$(this).data('id')])
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