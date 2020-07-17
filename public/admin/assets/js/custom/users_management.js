$(document).ready(function() {
    //Updating
    $('.edit-row').on('click', function(){
      $('form')[0].reset() // reset the form
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
      
      $('.modal').modal()
    })
  
    // Adding
    $('.add-btn').on('click', function() {
      $('form')[0].reset() // reset the form
      $('#staticBackdropLabel').text('Add new')

      $('select[name=role_title]').attr('disabled', false)
      $('input[name=name]').attr('required', 'required')
      $('input[name=email]').attr("required", 'required')
      $('input[name=password]').attr("required", 'required')
      $('input[name=contact_num]').attr("required", 'required')
      $('input[id=confirm_password]').attr("required", 'required')

      $('#pfp').attr('src', '')

      $('form').attr('action', base_url + 'cms/users/add')
      $('.modal').modal()
    })
  
    //Deleting
    // $('.btn-delete').on('click', function(){
  
    //   let p = prompt("Are you sure you want to delete this? Type DELETE to continue", "");
    //   if (p === 'DELETE') {
    //     const id = $(this).data('id')
  
    //     invokeForm(base_url + 'cms/users/delete', {id: id});
    //   }
  
    // })
  
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

 $('.btn-delete').click(function(e) {
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