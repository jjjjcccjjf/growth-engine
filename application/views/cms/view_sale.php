<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title"><?php echo $res->project_name ?> <?php echo $verified_status ?>
				</h4>
				<ul class="breadcrumbs">
					<li class="nav-home">
						<a href="<?php echo base_url('cms') ?>">
							<i class="flaticon-home"></i>
						</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<?php if (in_array($this->session->role, ['sales'])): ?>
					<li class="nav-item">
						<a href="<?php echo base_url('cms/sales') ?>">Sales</a>
					</li>
					<?php elseif (in_array($this->session->role, ['finance'])): ?>
					<li class="nav-item">
						<a href="<?php echo base_url('cms/finance/issue_invoice') ?>">Issue Invoice</a>
					</li>
					<?php elseif (in_array($this->session->role, ['superadmin'])): ?>
					<li class="nav-item">
						<a href="<?php echo base_url('cms/finance/issue_invoice') ?>">Issue Invoice</a>
					</li>
					<?php endif ?>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Sale ID # <?php echo $res->id ?></a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title"><?php echo $res->project_name ?> <?php echo $verified_status ?>
								<?php if(in_array($this->session->role, ['finance', 'superadmin'])): ?>
								<a href="<?php echo base_url('cms/finance/issue_invoice') ?>"><button class='btn btn-primary btn-sm pull-right'>&laquo; Return to sales list</button></a>
								<?php endif; ?>
								<?php if(in_array($this->session->role, ['sales'])): ?>
								<a href="<?php echo base_url('cms/sales') ?>"><button class='btn btn-primary btn-sm pull-right'>&laquo; Return to sales list</button></a>
								<?php endif; ?>
							</div>
							<br>
							<ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">View Sale</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">View Invoice(s)</a>
								</li>
							</ul>
						</div>
						<div class="tab-content mt-2 mb-3" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<div class="card-body">
									<div class="card-sub">
										<div class="row">
											<div class="col-md-8">
												Attachment count: <span class="attachment_count"><?php echo $res->attachment_count ?></span><br>
												<?php foreach ($res->attachments as $value): ?>
												<span class="file-wrapper-<?php echo $value->id ?>">
													<a href="<?php echo $value->attachment_path ?>"><i class="fa fa-file"></i> <?php echo $value->attachment_name ?></a>
													<i class="fa fa-times delete-me" style="color:red; cursor:pointer" title="Delete" data-id="<?php echo $value->id ?>"></i>
													</br>
												</span>
												<?php endforeach ?>
											</div>
											<div class="col-md-4">
												<form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/sales/add_attachments/' . $res->id) ?>" id="upload_attachment">
													<div class="form-group">
														<input type="file" name="attachments[]" multiple class="form-control">
													</div>
													<div class="form-group">
														<button type="submit" class="btn btn-sm btn-info"><i class="fa fa-plus"></i>  Add more files</button>
													</div>
												</form>
											</div>
										</div>
									</div>
									<form role="form" method="post" action="<?php echo base_url('cms/sales/update/' . $res->id) ?>">
										<div class="row">
											<div class="form-group col-md-6">
												<label >Project Name</label>
												<input type="text" class="form-control" name="project_name" placeholder="Project name" value="<?php echo $res->project_name ?>">
											</div>
											<div class="form-group col-md-6">
												<label >Project Description</label>
												<textarea class="form-control" placeholder="Project description..." name="project_description"><?php echo $res->project_description ?></textarea>
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
												<input type="number" step="0.5" min="0" class="form-control" name="amount" placeholder="Amount" value="<?php echo $res->amount ?>">
											</div>
											<div class="form-group col-md-3">
												<label >VAT (in percent %)</label>
												<input type="number" class="form-control" name="vat_percent" placeholder="VAT" value="<?php echo $res->vat_percent ?>">
											</div>
											<div class="form-group col-md-6">
												<label >Payment Terms</label>
												<input type="text" class="form-control" name="payment_terms" placeholder="Payment terms" value="<?php echo $res->payment_terms ?>">
												<small class="form-text text-muted">Example: Quarterly</small>
											</div>
											<div class="form-group col-md-6">
												<label >Payment Terms Notes</label>
												<textarea class="form-control" placeholder="Payment terms notes..." name="payment_terms_notes"><?php echo $res->payment_terms_notes ?></textarea>
											</div>
											<div class="form-group col-md-6">
												<label >Duration</label>
												<input type="text" class="form-control" name="duration" placeholder="Duration" value="<?php echo $res->duration ?>">
												<small class="form-text text-muted">Example: 12 months</small>
											</div>
											<div class="form-group col-md-6">
												<label >Number of Invoices</label>
												<input type="number" class="form-control" readonly="readonly" placeholder="Number of Invoices" min="0" value="<?php echo $res->num_of_invoices ?>" style="color:black">
											</div>
											<div class="form-group col-md-6">
												<label >Category</label>
												<select class="form-control" name='category'>
													<?php foreach ($categories as $value): ?>
													<option><?php echo $value ?></option>
													<?php endforeach ?>
												</select>
											</div>
											<!-- <input type="hidden" class="form-control" name="user_id" value="<?php echo $this->session->id ?>"> -->
										</div>
										<div class="modal-footer card-footer">
											<input class="btn btn-primary" type="submit" value="Save changes">
										</div>
									</form>
								</div> <!-- end cardbody -->
							</div>

							<!-- SECOND TAB  -->
							<!-- SECOND TAB  -->
							<!-- SECOND TAB  -->
							<!-- SECOND TAB  -->
							<!-- SECOND TAB  -->

							<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
								<div class="card-body">
									<?php if(@$invoices):foreach ($invoices as $value): ?>

										<div class="card-sub">
											<div class="row">
												<div class="col-md-8">
													<h3><?php echo $value->invoice_name ?>
													<?php if ($value->collected_date): ?>
														<button class="btn btn-xs btn-success"><i class="fas fa-check"></i> Collected</button>
													<?php else: ?>
														<button class="btn btn-xs btn-warning"><i class="fas fas fa-exclamation-triangle"></i> Uncollected</button>
													<?php endif ?>
													</h3>
														<small>Collected amount: <span style="font-weight:bold"><?php echo $value->collected_amount ?></span></small><br>
														<small>Due date (yyyy-mm-dd): <span style="font-weight:bold"><?php echo $value->due_date ?></span></small><br>
														<small>Date sent (yyyy-mm-dd): <span style="font-weight:bold"><?php echo $value->sent_date ?: 'Unspecified' ?></span></small><br>								
														<small>Collected date (yyyy-mm-dd): <span style="font-weight:bold"><?php echo $value->collected_date ?: 'Unspecified' ?></span></small><br>								
														<small>Received by: <span style="font-weight:bold"><?php echo $value->received_by ?: 'Unspecified' ?></span></small><br>
														<small>Quickbooks ID: <span style="font-weight:bold"><?php echo $value->quickbooks_id ?></span></small>
														<hr>
													<h3>Attachments: <span class="attachment_count"><?php echo $value->attachment_count ?></span></h3>
													<?php foreach ($value->attachments as $attch): ?>
													<span class="file-wrapper-<?php echo $attch->id ?>">
														<a href="<?php echo $attch->attachment_path ?>"><i class="fa fa-file"></i> <?php echo $attch->attachment_name ?></a>
														<i class="fa fa-times delete-me" style="color:red; cursor:pointer" title="Delete" data-id="<?php echo $attch->id ?>"></i>
														</br>
													</span>
													<?php endforeach ?>
												</div>
												<div class="col-md-4">
													<form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/finance/add_attachments_from_sale/' . $value->id . '/' . $value->sale_id) ?>" id="upload_attachment">
														<div class="form-group">
															<input type="file" name="attachments[]" multiple class="form-control">
														</div>
														<div class="form-group">
															<button type="submit" class="btn btn-sm btn-info"><i class="fa fa-plus"></i>  Add more files</button>
														</div>
													</form>
												</div>
											</div>
										</div>
										
									<?php endforeach; else: ?>
										<h3>Nothing to see here. 🤷‍♀️ Finance should issue an invoice first.</h3>
									<?php endif ?>


									
								</div>
							</div> 
						</div>

					</div>
				
				</div>
			</div>
		</div> <!-- / row -->
	</div>
	
</div>

<script>
	$(document).ready(function($) {
$('select[name=category]').val('<?php echo $res->category ?>').change()
$('select[name=client_id]').val('<?php echo $res->client_id ?>').change()
$('.delete-me').on('click', function(e){
e.preventDefault();
swal({
title: 'Are you sure you want to delete this?',
text: "You won't be able to revert this!",
type: 'warning',
icon: 'warning',
buttons:{
confirm: {
text : 'Yes, delete it!',
className : 'btn btn-success'
},
cancel: {
visible: true,
className: 'btn btn-danger'
}
}
}).then((Delete) => {
if (Delete) {
let file_attachment_id =  $(this).data('id')
$.getJSON( "<?php echo base_url('cms/sales/attachment_delete/') ?>" + file_attachment_id, function( data ) {

$('.attachment_count').text($('.attachment_count').text() - 1)
$('.file-wrapper-' + file_attachment_id).remove()
swal({
title: 'Deleted!',
text: 'Your file has been deleted.',
type: 'success',
icon: 'success',
buttons : {
confirm: {
className : 'btn btn-success'
}
}
});
});
} else {
swal.close();
}
});
}) // end swal
<?php if(in_array($this->session->role, ['finance'])): ?>
$('form#upload_attachment, input[type=submit]').hide()
$('input, textarea, select').attr('readonly', 'readonly').css('color', 'black')
<?php endif; ?>
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