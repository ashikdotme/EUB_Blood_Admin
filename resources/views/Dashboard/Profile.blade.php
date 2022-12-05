@extends('Layout.App')
@section('title','Profile')
@section('content') 
<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Admin Profile</h4>
                <hr> 
                <div class="table table-responsive"> 
                    <table class="table profile-table">
                        <tr>
                            <td>Name:</td>
                            <td>{{ $data[0]['name'] }}</td>
                        </tr>
                        <tr>
                            <td>Username:</td>
                            <td>{{ $data[0]['username'] }}</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>{{ $data[0]['email'] }}</td>
                        </tr> 
                        <tr>
                            <td>Role:</td>
                            <td>{{ $data[0]['role'] }}</td>
                        </tr>
                        <tr>
                            <td>Photo:</td>
                            <td><img style="max-width:200px;width:auto;"  src="{{ $data[0]['photo'] }}" alt="{{ $data[0]['name'] }}"></td>
                        </tr>
                        <tr>
                            <td>Joined:</td>
                            <td>{{ date('d-m-Y h:i:s A',strtotime($data[0]['created_at']))  }}</td>
                        </tr>
                        <tr>
                            <td><button data-toggle="modal" data-target="#profileModal"   class="btn btn-info">Edit Profile</button></td> 
                        </tr>
                    </table> 

                </div> 
            </div>
        </div>
    </div> 
</div>
<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModal" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="multiple-oneModalLabel">Update Admin Profile</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div> 
        <div class="modal-body"> 
            <form action="" class="form" id="update_profile_form">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $data[0]['name'] }}">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control" id="email" value="{{ $data[0]['email'] }}">
                </div>
                <div class="form-group">
                    <label for="profile_photo">Photo: <small><mark>skip it, if won't update the photo</mark></small></label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="profilePhoto" data-preview="holder" class="btn btn-primary file_attach_btn">
                            <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span>
                        <input id="profilePhoto" class="form-control" type="text" name="profilePhoto">
                    </div> 
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                </div>
                    
                <div class="form-group text-left mt-20">
                    <input type="submit" class="btn btn-success" id="update_profile_btn" value="Update Profile">
                </div> 
            </form>  
        </div> 
    </div>
</div>
</div>
<!-- Profile Modal --> 
@endsection

@section('scripts')
   <script>  
       $('#lfm').filemanager('file');
        $('#update_profile_form').on('submit',function(e){
            e.preventDefault(); 
            var name=  $('#name').val();
            var email=  $('#email').val();
            var photo=  $('#profilePhoto').val();

            if(name.length==0){
                toastr.error('Name is Required!');
            }
            else if(email.length==0){
                toastr.error('Email is Required!');
            }
            else{
                $('#update_profile_btn').val('Loading....');
                axios.post('/api-update-profile',{
                    name:name,
                    email:email,
                    photo:photo
                })
                .then(function(response){
                    if(response.status==200){
                        $('#update_profile_btn').html('Update Profile');
                        if(response.data==1){
                            toastr.success('Profile Update Success!');
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                            
                        }else{
                            toastr.error('Username or Password is Wrong!');
                            $('#update_profile_btn').val('Update Profile');
                        }
                    }else{
                        toastr.error('Something went wrong!');
                        $('#update_profile_btn').val('Update Profile');
                    }
                })
                .catch(function (error) {
                    toastr.error('Something went wrong!');
                    $('#update_profile_btn').val('Update Profile');
                })
            }
        });
 
    </script> 
@endsection