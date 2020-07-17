		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title"><?php echo $res->project_name ?></h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="<?php echo base_url('cms') ?>">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url('cms/sales') ?>">Sales</a>
							</li>
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
									<div class="card-title"><?php echo $res->project_name ?></div>
								</div>
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
												<form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/sales/add_attachments/' . $res->id) ?>">
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
							              <label >Client Name</label>
							              <input type="text" class="form-control" name="client_name" placeholder="Client name" value="<?php echo $res->client_name ?>" list="client_names">
			              	              <datalist id="client_names">
							              	<?php foreach ($unique_clients as $value): ?>
							              		<option><?php echo $value->client_name ?></option>
							              	<?php endforeach ?>
							              </datalist>
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
							              <input type="number" class="form-control" readonly="readonly" placeholder="Number of Invoices" value="<?php echo $res->num_of_invoices ?>" style="color:black">
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
						          </div>
			                    <div class="modal-footer card-footer">
						            <input class="btn btn-primary" type="submit" value="Save changes">
						          </div>
						        </form>
								</div>
							</div>
 
						</div>
 
					</div>
				</div>
			</div>
 
		</div>
		
		<script>
			$(document).ready(function($) {
      			$('select[name=category]').val('<?php echo $res->category ?>').change()

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



			});
		</script>