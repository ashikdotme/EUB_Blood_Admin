@extends('Layout.App')
@section('title','Change Password')
@section('content')

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Change Password</h4>
                <hr>
                <form action="" method="POST" id="update_pass_form">
                    <div class="form-group">
                        <label for="current_password">Current Password:</label>
                        <input type="password" id="current_password" placeholder="Change Password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password:</label>
                        <input type="password" id="new_password" placeholder="New Password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="new_password">Confirm New Password:</label>
                        <input type="password" id="confirm_new_password" placeholder="Confirm New Password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" id="update_pass_btn" value="Change Password" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection
@section('scripts')
<script>

$('#update_pass_form').on('submit',function(e){
    e.preventDefault();
    var current_password = $('#current_password').val();
    var new_password = $('#new_password').val();
    var confirm_new_password = $('#confirm_new_password').val();
    
    if(current_password.length == 0){
        toastr.error('Current Password is Required!'); 
    }
    else if(new_password.length == 0){
        toastr.error('New Password is Required!'); 
    }
    else if(confirm_new_password.length == 0){
        toastr.error('Confirm New Password is Required!'); 
    }
    else if(confirm_new_password != new_password){
        toastr.error("Confirm Password Does't Match!"); 
    }
    
    else{
        $('#update_pass_btn').val('Updating...');
        axios.post('/api-change-password',{
            current_password:current_password,
            new_password:new_password,
            confirm_new_password:confirm_new_password
        })
        .then(function(response){
            if(response.status == 200){
                if(response.data == 1){
                    toastr.success('Password Update Success!');
                    $('#update_pass_btn').val('Update Password');

                    setTimeout(() => {
                        window.location = "login";
                    }, 2000);
                }
                else if(response.data == 0){
                    toastr.error('Something went wrong!');
                    $('#update_pass_btn').val('Update Password');
                }
                else{
                    toastr.error(response.data);
                    $('#update_pass_btn').val('Update Password');
                }

            }else{
                toastr.error('Something went wrong!');
                $('#update_blc').val('Update Balance');
            }
        })
    }

});
</script>
@endsection