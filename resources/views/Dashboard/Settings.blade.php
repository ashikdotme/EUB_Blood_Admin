@extends('Layout.App')
@section('title','Settings')
@section('content')

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Female Password</h4>
                <div class="alert alert-info">Password: {{ $femalePassword }} </div>
                <hr>
                <form action="" method="POST" id="update_pass_form">
                    <div class="form-group">
                        <label for="new_password">Change Password:</label>
                        <input type="password" id="new_password" placeholder="Set New Password" class="form-control">
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
    var new_password = $('#new_password').val(); 
    
    if(new_password.length == 0){
        toastr.error('New Password is Required!'); 
    } 
    else{
        $('#update_pass_btn').val('Updating...');
        axios.post('/api-set-new-female-password',{ 
            new_password:new_password
        })
        .then(function(response){
            if(response.status == 200){
                if(response.data == 1){
                    toastr.success('Password Update Success!');
                    $('#update_pass_btn').val('Change Password');

                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } 
                else{
                    toastr.error(response.data);
                    $('#update_pass_btn').val('Change Password');
                }

            }else{
                toastr.error('Something went wrong!');
                $('#update_pass_btn').val('Change Password');
            }
        })
    }

});
</script>
@endsection