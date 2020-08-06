<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Users
							<button class='btn btn-info btn-sm pull-right add-btn'><i class="fa fa-plus"></i> Add new</button>
						</div>
					</div>
					<div class="card-body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Email</th>
									<th>Role</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($res as $value): ?>
								<tr>
									<td>#</td>
									<td><?php echo $value->name ?></td>
									<td><?php echo $value->email ?></td>
									<td><?php echo $value->role_title ?></td>
									<td>
										<button data-toggle="modal" data-target="#staticBackdrop" class="btn btn-link edit-row" data-payload='<?php echo json_encode(['id' => $value->id, 'name' => $value->name, 'email' => $value->email, 'role_title' => $value->role_title, 'contact_num' => $value->contact_num, 'profile_pic_path' => $value->profile_pic_path], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE)?>'><i class="fa fa-edit"></i> Edit</button>
										<button data-toggle="modal" data-payload='<?php echo json_encode(['id' => $value->id, 'name' => $value->name], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE)?>' class="btn btn-link btn-delete"><i class="fa fa-trash"></i> Delete</button>

									</td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
<!-- 						<ul class="pagination pg-primary">
							<li class="page-item">
								<a class="page-link" href="#" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
									<span class="sr-only">Previous</span>
								</a>
							</li>
							<li class="page-item active"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item">
								<a class="page-link" href="#" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
									<span class="sr-only">Next</span>
								</a>
							</li>
						</ul> -->
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
        <h3 class="modal-title card-title" id="staticBackdropLabel" style="font-weight:bold"></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form role="form" method="post" enctype="multipart/form-data">
         	<div class="row">
	            <div class="form-group col-md-6">
	              <label >Name</label>
	              <input type="text" class="form-control" name="name" placeholder="Name">
	            </div>
	            <div class="form-group col-md-6">
	              <label >Email</label>
	              <input type="email" class="form-control" name="email" placeholder="Email">
	            </div>
	            <div class="form-group col-md-6">
	              <label >Contact No.</label>
	              <input type="text" class="form-control" name="contact_num" placeholder="Contact No.">
	            </div>
	            <div class="form-group col-md-6">
	              <label >Role</label>
	              <select class="form-control" name='role_title'>
	              	<?php foreach ($roles as $value): ?>
	              		<option><?php echo $value ?></option>
	              	<?php endforeach ?>
	              </select>
	            </div> 
	            <div class="form-group col-md-6">
	              <label >Profile Picture</label>
	              <input type="file" class="form-control" name="profile_pic_filename">
	            </div> 
	            <div class="form-group col-md-6">
	            	<img src="" id="pfp" style="width: 100px" onerror="this.src='<?php echo base_url('public/admin/') ?>/assets/img/optimind-logo.png'">
	            </div> 
	            <div class="form-group col-md-12">
	            	<hr>
	            </div> 
	            <div class="form-group col-md-6">
	            	<label>New Password</label>
	            	<input type="password" class="form-control" name="password">
	            </div>
	            <div class="form-group col-md-6">
	            	<label>Confirm Password</label>
	            	<input type="password" class="form-control" id="confirm_password">
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
<script src="<?php echo base_url('public/admin/assets/js/custom/users_management.js') ?>"></script>
<script>
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
</script>