@extends('Layout.App')
@section('title','Team Members')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Team Members &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#" class="btn btn-sm btn-success"  data-toggle="modal" data-target="#AddOrgModal">Add New</a></h4> 
                <div class="table-responsive">
                    <table id="UserTable" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr>
                                <th style="width:20px;">#</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Department</th> 
                                <th>Student ID</th>
                                <th>Photo</th> 
                                <th>Mobile</th> 
                                <th>FB Url</th> 
                                <th>Priority</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <div id="tableLoader" class="spinner-grow" style="width: 3rem; height: 3rem;margin:auto;display:block" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <tbody id="UserTableRow">
                            
                        </tbody> 
                    </table> 
 
                </div>
            </div>
        </div>
    </div>
</div>
 
{{-- Delete Modal --}}
<div id="DeleteConfirm" class="modal fade" tabindex="-1" role="dialog"
aria-labelledby="danger-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-danger">
                <h4 class="modal-title" id="danger-header-modalLabel">Delete</h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body text-center"> 
                <h5>do you want to delete...</h5>
                <h5>Are you sure?</h5>
                <br>
                <input type="hidden" name="" id="del_type_id">
               <button class="btn btn-danger" id="yes_delete">Yes</button> &nbsp;&nbsp;
               <button class="btn btn-success" data-dismiss="modal">No</button>
            </div> 
        </div>
    </div>
</div> 
 
{{-- Create New --}}
<div id="AddOrgModal" class="modal fade" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Add New</h4>
            <button type="button" class="close" data-dismiss="modal"
                aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
            <form action="" id="create_form">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name"   class="form-control">
                </div>
                <div class="form-group">
                    <label for="designation">Designation:</label>
                    <input type="text" id="designation" class="form-control">
                </div>
                <div class="form-group">
                    <label for="department">Department:</label>
                    <input type="text" id="department" class="form-control">
                </div>
                <div class="form-group">
                    <label for="st_id">Student ID:</label>
                    <input type="text" id="st_id" class="form-control">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile:</label>
                    <input type="text" id="mobile" class="form-control">
                </div>
                <div class="form-group">
                    <label for="fb_url">FB Url:</label>
                    <input type="text" id="fb_url" class="form-control">
                </div>
                <div class="form-group">
                    <label for="priority">Priority:</label>
                    <input type="number" id="priority" class="form-control">
                </div>
                <div class="form-group">
                    <label for="photo">Photo:</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm2" data-input="photo" data-preview="holder2" class="btn btn-primary file_attach_btn">
                            <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span>
                        <input id="photo" class="form-control" type="text"  name="photo">
                    </div> 
                    <div id="holder2" style="margin-top:15px;max-width:150px;"><img src=""></div>
                </div>
                <div class="form-group">  
                    <input type="submit" id="create_btn" value="Create New" class="btn btn-success">
                </div>
            </form>
        </div>
        
    </div>
</div>
</div>

@endsection
@section('scripts')
<script>
     
$('#lfm,#lfm2,#lfm3').filemanager('file');
// Create New Item
$('#create_form').on('submit',function(e){
    e.preventDefault(); 
    var name = $('#name').val();
    var designation = $('#designation').val();
    var department = $('#department').val();
    var st_id = $('#st_id').val();
    var mobile = $('#mobile').val();
    var fb_url = $('#fb_url').val();
    var priority = $('#priority').val();
    var photo = $('#photo').val(); 
    
    if(name.length == 0){
        toastr.error('Name is Required!'); 
    } 
    else if(mobile.length == 0){
        toastr.error('Mobile Number is Required!'); 
    } 
    else{
        $('#create_btn').val('Creating...');
        axios.post('/api-volunteers-create-list-data',{
            name:name,
            designation:designation,
            department:department,
            st_id:st_id,
            mobile:mobile,
            fb_url:fb_url,
            priority:priority,
            photo:photo
        })
        .then(function(response){
            if(response.status == 200){
                if(response.data == 1){
                    toastr.success('Create Success!');
                    $('#create_btn').val('Create New');
                    List();
                    $('#AddOrgModal').modal('hide');
                } 
                else{
                    toastr.error(response.data);
                    $('#create_btn').val('Create New');
                } 
            } 
        })
    }
});


// Delete 
$('#yes_delete').click(function(){
    var delid = $('#del_type_id').val();
    axios.post('/api-volunteers-delete-list',{
        delid:delid
    })
    .then(function(response){
        if(response.status==200){
            if(response.data==1){ 
                toastr.success('Deleted Successfully!');
                List();
                $('#DeleteConfirm').modal('hide');
                
                $('#del_type_id').val('');  
            }else if(response.data==0){
                $('#del_type_id').val(''); 
                toastr.error('Deleted Failed!'); 
                $('#DeleteConfirm').modal('hide');
            }
        }
    })
});
List();
function List(){
$('#tableLoader').show();
axios.get('/api-volunteers-list')
.then(function(response){ 
    if(response.status==200){ 
        $('#UserTable').DataTable().destroy();
        $('#UserTableRow').empty();
        var jsonData = response.data;
        $('#tableLoader').hide();
        var a = 1;
        $.each(jsonData,function(i,item){
            $('<tr>').html(
                '<td>'+a+'</td>'+
                '<td>'+jsonData[i].name+'</td>'+
                '<td>'+jsonData[i].designation+'</td>'+
                '<td>'+jsonData[i].department+'</td>'+
                '<td>'+jsonData[i].st_id+'</td>'+
                '<td>'+photo()+'</td>'+
                '<td>'+jsonData[i].phone+'</td>'+
                '<td>'+jsonData[i].fb_url+'</td>'+ 
                '<td>'+jsonData[i].priority+'</td>'+ 
                '<td>'+buttonDelete()+'</td>'

            ).appendTo('#UserTableRow');
            a++; 
            function photo(){
                let photo = jsonData[i].photo;
                if(photo != null){
                    return '<img style="max-width:150px;" src="'+jsonData[i].photo+'" />';
                }else{
                    return '';
                }
            } 
            function buttonDelete(){
                return '&nbsp;&nbsp;<a data-id='+jsonData[i].id+' href="#" class="btn btn-danger btn-sm DelBtn DelBtn'+jsonData[i].id+'"> <i class="fas fa-trash"></i></a> ';
            }

        });
   
        // Delete Cat item
        $('.DelBtn').click(function(){
            var delid = $(this).data('id');
            
            $('#del_type_id').val(delid);
            $('#DeleteConfirm').modal('show');
            return false;
        }); 
 
        $('#UserTable').DataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
            "bDestroy": true
        });
        $('.dataTables_length').addClass('bs-select'); 
    } 
}) 
}    
  
</script>
@endsection