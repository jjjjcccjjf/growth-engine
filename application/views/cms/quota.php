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
              <div class="card-title">Edit Quota of <?php echo $user->name ?>
              <a href="<?php echo base_url('cms/users') ?>">
                <button class="add-new btn btn-sm btn-warning pull-right"> &laquo; Return to users</button>
              </a>
              </div
                >
            </div>
            <div class="card-body">
   

                <form role="form" method="post" enctype="multipart/form-data" id="quota-form" action="<?php echo base_url('cms/quota/add') ?>">

                  <div class='quota-holder'> 
                  <?php if ($quota): ?>
                    <?php foreach ($quota as $value): ?>
                    <div class="row">
                        <div class="form-group col-md-5">
                          <label >Year</label>
                          <input type="number" class="form-control" name="year[]" placeholder="Year" min="1970" value="<?php echo $value->year ?>">
                        </div>
                        <div class="form-group col-md-5">
                          <label >Quota amount</label>
                          <input type="number" class="form-control" name="quota_amount[]" placeholder="Quota amount" value="<?php echo $value->quota_amount ?>">
                        </div> 
                        <div class="form-group col-md-2">
                          <label >&nbsp;</label>
                          <div><button class="btn btn-sm btn-info new-row" type="button"><i class="fa fa-plus"></i></button>
                            <button class="btn btn-sm btn-danger del-row" type="button"><i class="fa fa-times"></i></button></div>
                        </div> 
                    </div>
                    <?php endforeach ?>
                  <?php else: ?>
                    <div class="row">
                        <div class="form-group col-md-5">
                          <label >Year</label>
                          <input type="number" class="form-control" name="year[]" placeholder="Year" min="1970">
                        </div>
                        <div class="form-group col-md-5">
                          <label >Quota amount</label>
                          <input type="number" class="form-control" name="quota_amount[]" placeholder="Quota amount">
                        </div> 
                        <div class="form-group col-md-2">
                          <label >&nbsp;</label>
                          <div>
                            <button class="btn btn-sm btn-info new-row" type="button"><i class="fa fa-plus"></i></button> 
                          <button class="btn btn-sm btn-danger del-row" type="button"><i class="fa fa-times"></i></button>
                        </div>
                        </div> 
                    </div>
                  <?php endif ?>
                  </div>



                  <div class="card-action">
                          <button class="btn btn-success" type="submit">Save</button>
                  </div>
                  <input type="hidden" name="user_id" value="<?php echo $user->id ?>">
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

        var $quotaRow = `<div class="row">
                        <div class="form-group col-md-5">
                          <label >Year</label>
                          <input type="number" class="form-control" name="year[]" placeholder="Year" min="1970">
                        </div>
                        <div class="form-group col-md-5">
                          <label >Quota amount</label>
                          <input type="number" class="form-control" name="quota_amount[]" placeholder="Quota amount">
                        </div> 
                        <div class="form-group col-md-2">
                          <label >&nbsp;</label>
                          <div>
                            <button class="btn btn-sm btn-info new-row" type="button"><i class="fa fa-plus"></i></button> 
                          <button class="btn btn-sm btn-danger del-row" type="button"><i class="fa fa-times"></i></button>
                        </div>
                        </div> 
                    </div>`

        $(document).on('click', '.new-row', function(){
          $('.quota-holder').append($quotaRow)
        })

        $(document).on('click', '.del-row', function(){
          $(this).parent().parent().parent().remove()
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