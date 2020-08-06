<div class="main-panel">
  <div class="content">
    <div class="page-inner">
<!--       <div class="page-header">
        <h4 class="page-title">Forms</h4>
      </div> -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Edit Profile</div>
            </div>
            <div class="card-body">
              <form enctype="multipart/form-data" method="post" role="form" action="<?php echo base_url('cms/profile/update/') . $this->session->id ?>">
                <div class="row">
           <div class="form-group col-md-6">
                <label >Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $user->name ?>">
              </div>
              <div class="form-group col-md-6">
                <label >Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $user->email ?>">
              </div>
              <div class="form-group col-md-6">
                <label >Contact No.</label>
                <input type="text" class="form-control" name="contact_num" placeholder="Contact No." value="<?php echo $user->contact_num ?>">
              </div>
              <div class="form-group col-md-6">
                <label >Role</label>
                <select class="form-control" disabled id="role_title">
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
                <img src="<?php echo $user->profile_pic_path ?>" id="pfp" style="width: 100px" onerror="this.src='<?php echo base_url('public/admin/assets/img/optimind-logo.png') ?>'">
              </div> 
              <div class="form-group col-md-12">
                <hr>
              </div> 
              <div class="form-group col-md-6">
                <label>New Password</label>
                <input type="password" class="form-control" name="password" autocomplete="off">
              </div>
              <div class="form-group col-md-6">
                <label>Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password">
              </div>
                    
                    
                    <div class="card-action">
                      <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>

  <script>
    $(document).ready(function($) {

       $('select[id=role_title]').val('<?php echo $user->role_title ?>').change()
       
       $('form').on('submit', function (){
  
        let p = $('input[name=password]').val()
        let cp = $('input[id=confirm_password]').val()
    
      if (!(p === cp)) {
        swal("Passwords don't match", "Please try again or leave them blank", {
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