@extends('Layout.App')
@section('title','App Content Options')
@section('content')

<div class="row">
    <div class="col-sm-12 col-md-8 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">App Content</h4>
                <hr>
                <form action="" method="POST" id="update_header_options">
                    <div class="form-group">
                        <label for="app_title">App Title:</label>
                        <input type="text" id="app_title" value="{{ $data[0]['app_title'] }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="icon">App Icon:</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="icon" data-preview="holder3" class="btn btn-primary file_attach_btn">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="icon" class="form-control" type="text" value="{{ $data[0]['icon'] }}" name="icon">
                        </div> 
                        <div id="holder3" style="margin-top:15px;max-width:300px;"><img src="{{ $data[0]['icon'] }}"></div>
                    </div>
                    <div class="form-group">
                        <label for="logo">App Logo:</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm2" data-input="logo" data-preview="holder2" class="btn btn-primary file_attach_btn">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="logo" class="form-control" type="text" value="{{ $data[0]['logo'] }}" name="logo">
                        </div> 
                        <div id="holder2" style="margin-top:15px;max-width:300px;"><img src="{{ $data[0]['logo'] }}"></div>
                    </div>
                    <div class="form-group">
                        <label for="splash_img">Splash Image:</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm3" data-input="splash_img" data-preview="holder7" class="btn btn-primary file_attach_btn">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="splash_img" class="form-control" type="text" value="{{ $data[0]['splash_img'] }}" name="splash_img">
                        </div> 
                        <div id="holder7" style="margin-top:15px;max-width:300px;"><img src="{{ $data[0]['splash_img'] }}"></div>
                    </div>

                    <div class="form-group">
                        <label for="home_title">Home Title:</label>
                        <input type="text" id="home_title" value="{{ $data[0]['home_title'] }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="home_img">Home Image:</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm4" data-input="home_img" data-preview="holder4" class="btn btn-primary file_attach_btn">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="home_img" class="form-control" type="text" value="{{ $data[0]['home_img'] }}" name="home_img">
                        </div> 
                        <div id="holder4" style="margin-top:15px;max-width:300px;"><img src="{{ $data[0]['home_img'] }}"></div>
                    </div>
                    <div class="form-group">
                        <label for="login_img">Login Image:</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm5" data-input="login_img" data-preview="holder5" class="btn btn-primary file_attach_btn">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="login_img" class="form-control" type="text" value="{{ $data[0]['login_img'] }}" name="login_img">
                        </div> 
                        <div id="holder5" style="margin-top:15px;max-width:300px;"><img src="{{ $data[0]['login_img'] }}"></div>
                    </div>

                    <div class="form-group">
                        <label for="about_title">About Title:</label>
                        <input type="text" id="about_title" value="{{ $data[0]['about_title'] }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="about_content">About Content:</label>
                        <textarea type="text" id="about_content"  class="form-control">{{ $data[0]['about_content'] }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="about_img">About Image:</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm6" data-input="about_img" data-preview="holder6" class="btn btn-primary file_attach_btn">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="about_img" class="form-control" type="text" value="{{ $data[0]['about_img'] }}" name="about_img">
                        </div> 
                        <div id="holder6" style="margin-top:15px;max-width:300px;"><img src="{{ $data[0]['about_img'] }}"></div>
                    </div>
 
                    <div class="form-group">
                        <input type="submit" id="update_home_btn" value="Update" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 
@endsection
@section('scripts')
<script>
 
$('#lfm,#lfm2,#lfm3,#lfm4,#lfm5,#lfm6,#lfm7').filemanager('file');

$('#update_header_options').on('submit',function(e){
    e.preventDefault();
    var icon = $('#icon').val();
    var logo = $('#logo').val();
    var home_title = $('#home_title').val();
    var home_img = $('#home_img').val();
    var login_img = $('#login_img').val();
    var about_title = $('#about_title').val();
    var about_content = $('#about_content').val();
    var about_img = $('#about_img').val();
    var app_title = $('#app_title').val();
    var splash_img = $('#splash_img').val();
     
    if(app_title.length == 0){
        toastr.error('App Title is Required!'); 
    } 
    else if(home_title.length == 0){
        toastr.error('Home Title is Required!'); 
    } 
    else{
        $('#update_home_btn').val('Updating...');
        axios.post('/api-update-app-content',{
            icon:icon,
            logo:logo,
            home_title:home_title,
            home_img:home_img,
            login_img:login_img,
            about_title:about_title,
            about_content:about_content,
            about_img:about_img,
            app_title:app_title,
            splash_img:splash_img
        })
        .then(function(response){
            if(response.status == 200){
                if(response.data == 1){
                    toastr.success('Update Success!');
                    $('#update_home_btn').val('Update');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } 
                else{
                    toastr.error(response.data);
                    $('#update_home_btn').val('Update');
                } 
            } 
        })
    }
});
 
</script>
@endsection