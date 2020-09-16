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
										<button data-toggle="modal" data-target="#staticBackdrop" class="btn btn-sm btn-link edit-row btn-info" data-payload='<?php echo json_encode(['id' => $value->id, 'name' => $value->name, 'email' => $value->email, 'role_title' => $value->role_title, 'contact_num' => $value->contact_num, 'profile_pic_path' => $value->profile_pic_path], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE)?>'><i class="fa fa-edit"></i> Edit</button>
										<button data-toggle="modal" data-payload='<?php echo json_encode(['id' => $value->id, 'name' => $value->name], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE)?>' class="btn btn-sm btn-link btn-delete btn-danger"><i class="fa fa-trash"></i> Delete</button>

										<?php if ($value->role_title == 'sales'): ?>
											<a href="<?php echo base_url('cms/users/quota/' . $value->id ) ?>" class="btn btn-link btn-sm btn-success">
												<i class="fa fa-chart-bar"></i> Quota
											</a>
										<?php endif ?>

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
         <form role="form" method="post" enctype="multipart/form-data" id="edit-form">
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
<script>

$(document).ready(function() {

    //Updating
    $('html').on('click', '.edit-row', function(){
      $('#edit-form')[0].reset() // reset the form
      const payload = $(this).data('payload')
      $('#staticBackdropLabel').text('Editing ' + payload.name)
  
      $('input[name=name]').removeAttr('required')
      $('input[name=email]').removeAttr('required')
      $('input[name=profile_pic_filename]').removeAttr('required')
      $('input[name=password]').removeAttr('required')
      $('input[id=confirm_password]').removeAttr('required')
  

  	  $('select[name=role_title]').removeAttr('required')
  	  $('select[name=role_title]').attr('disabled', true)
      $('select[name=role_title]').val(payload.role_title).change()

      $('input[name=name]').val(payload.name)
      $('input[name=email]').val(payload.email)
      $('input[name=contact_num]').val(payload.contact_num)
      
      $('form').attr('action', base_url + 'cms/users/update/' + payload.id)

      $('#pfp').attr('src', payload.profile_pic_path)
      
      $('#staticBackdrop').modal()
    })
  
    // Adding
    $('.add-btn').on('click', function() {
      $('#edit-form')[0].reset() // reset the form
      $('#staticBackdropLabel').text('Add new')

      $('select[name=role_title]').attr('disabled', false)
      $('input[name=name]').attr('required', 'required')
      $('input[name=email]').attr("required", 'required')
      $('input[name=password]').attr("required", 'required')
      $('input[name=contact_num]').attr("required", 'required')
      $('input[id=confirm_password]').attr("required", 'required')

      $('#pfp').attr('src', '')

      $('form').attr('action', base_url + 'cms/users/add')
      $('#staticBackdrop').modal()
    })
  
    //Deleting
    // $('.btn-delete').on('click', function(){
  
    //   let p = prompt("Are you sure you want to delete this? Type DELETE to continue", "");
    //   if (p === 'DELETE') {
    //     const id = $(this).data('id')
  
    //     invokeForm(base_url + 'cms/users/delete', {id: id});
    //   }
  
    // })
  
    $('#edit-form').on('submit', function (){
  
      let p = $('input[name=password]').val()
      let cp = $('input[id=confirm_password]').val()
  
    if (!(p === cp)) {
      swal("Passwords don't match", "Please try again or leave them blank when adding a new user", {
        icon : "error",
        buttons: {              
          confirm: {
            className : 'btn btn-danger'
          }
        },
      });
        return false
      }
  
    })

 $('html').on('click', '.btn-delete', function(e) {
      swal({
        title: 'Are you sure you want to delete ' + $(this).data('payload').name + '?',
        text: "You won't be able to revert this!",
        type: 'warning',
        buttons:{
          cancel: {
            visible: true,
            text : 'No, cancel!',
            className: 'btn btn-danger'
          },              
          confirm: {
            text : 'Yes, delete ' + $(this).data('payload').name,
            className : 'btn btn-success'
          }
        }
      }).then((willDelete) => {
        if (willDelete) {
          swal($(this).data('payload').name + " deleted successfully", {
            icon: "success",
            buttons : {
              confirm : {
                className: 'btn btn-success'
              }
            }
          });

          invokeForm(base_url + 'cms/users/delete', {id: $(this).data('payload').id});
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
</script>