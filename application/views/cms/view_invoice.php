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
								<a href="<?php echo base_url('cms/finance/invoice_management') ?>">Invoices</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Invoice ID # <?php echo $res->id ?> </a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">
										<?php echo $res->invoice_name ?>
										<?php if ($res->collected_date): ?>
											<button class="btn btn-round btn-success btn-xs"><i class="fas fa-check"></i> COLLECTED</button>
										<?php else: ?>
											<button class="btn btn-round btn-warning btn-xs"><i class="fas fa-exclamation-triangle"></i> UNCOLLECTED</button>
										<?php endif ?>

										<a href="<?php echo base_url('cms/finance/invoice_management_collected') ?>"><button class='btn btn-success btn-sm pull-right'>&laquo; Return to Collected Invoices</button></a>
										<a href="<?php echo base_url('cms/finance/invoice_management') ?>"><button class='btn btn-warning btn-sm pull-right' style="margin-right:12px">&laquo; Return to Uncollected Invoices</button></a>
									</div>
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
												<form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/finance/add_attachments/' . $res->id) ?>" id="upload_attachment">
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
									 <form role="form" method="post" action="<?php echo base_url('cms/finance/update_invoice/' . $res->id) ?>">
						         	<div class="row">
							            <div class="form-group col-md-4">
							              <label >Project name</label>
							              <input style="color:black" type="text" class="form-control" placeholder="Project name" value="<?php echo $res->project_name ?>" readonly="readonly">
							            </div>  
							            <div class="form-group col-md-4">
							              <label >Invoice name</label>
							              <input type="text" class="form-control" name="invoice_name" placeholder="Invoice name" value="<?php echo $res->invoice_name ?>">
							            </div>  
							            <div class="form-group col-md-4">
							              <label >Invoice amount (in peso)</label>
							              <input type="number" step="0.01" min="0" class="form-control" name="invoice_amount" placeholder="Invoice amount" value="<?php echo $res->invoice_amount ?>">
							            </div> 
							            <div class="form-group col-md-4">
							              <label >Collected amount (in peso)</label>
							              <input type="number" step="0.01" min="0" class="form-control" name="collected_amount" placeholder="Collected amount" value="<?php echo $res->collected_amount ?>">
							            </div> 							            
							            <div class="form-group col-md-4">
							              <label >Withholding tax amount (in peso)</label>
							              <input type="number" step="0.01" min="0" class="form-control" name="withholding_tax_amount" placeholder="Withholding tax amount" value="<?php echo $res->withholding_tax_amount ?>">
							            </div> 
							            <div class="form-group col-md-4">
							              <label >Collected date</label>
							              <input type="date"  class="form-control" name="collected_date" placeholder="Collected date" value="<?php echo $res->collected_date ?>">
							            </div> 
							            <div class="form-group col-md-4">
							              <label >Due date</label>
							              <input type="date"  class="form-control" name="due_date" placeholder="Due date" value="<?php echo $res->due_date?>">
							            </div>  
							            <div class="form-group col-md-4">
							              <label >Quickbooks ID</label>
							              <input type="text"  class="form-control" name="quickbooks_id" placeholder="Quickbooks ID" value="<?php echo $res->quickbooks_id ?>">
							            </div> 
							            <div class="form-group col-md-4">
							              <label >Date sent</label>
							              <input type="date"  class="form-control" name="sent_date" value="<?php echo $res->sent_date ?>">
							            </div> 
							            <div class="form-group col-md-4">
							              <label >Received by</label>
							              <input type="text"  class="form-control" name="received_by" placeholder="Received by" value="<?php echo $res->received_by ?>">
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

      			$('.delete-me').on('click', function(e){
      				e.preventDefault();
					swal({
						title: 'Are you sure you want to delete this?',
						text: "You won't be able to revert this!",
						type: 'warning',
						icon: 'warning',
						buttons:{
							cancel: {
								visible: true,
								className: 'btn btn-danger'
							},
							confirm: {
								text : 'Yes, delete it!',
								className : 'btn btn-success'
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

				// $('form#upload_attachment, input[type=submit]').hide()
				// $('input, textarea, select').attr('readonly', 'readonly').css('color', 'black')
				// $('.delete-me').hide()

			});
		</script>