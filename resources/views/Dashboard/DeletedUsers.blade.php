@extends('Layout.App')
@section('title','Deleted Users')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Deleted Users</h4> 
                <div class="table-responsive">
                    <table id="UserTable" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr>
                                <th style="width:20px;">#</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Blood Group</th> 
                                <th>Last Donate Date</th> 
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

 

{{-- Restore Modal --}}
<div id="DeleteConfirm" class="modal fade" tabindex="-1" role="dialog"
aria-labelledby="success-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-success">
                <h4 class="modal-title" id="danger-header-modalLabel">Restore User</h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body text-center"> 
                <h5>do you want to Restore...</h5>
                <h5>Are you sure?</h5>
                <br>
                <input type="hidden" name="" id="del_type_id">
               <button class="btn btn-success" id="yes_restore">Yes</button> &nbsp;&nbsp;
               <button class="btn btn-danger" data-dismiss="modal">No</button>
            </div> 
        </div>
    </div>
</div> 
 

@endsection
@section('scripts')
<script>
 // Restore 
$('#yes_restore').click(function(){
    var delid = $('#del_type_id').val();
    axios.post('/api-deleted-user-restore',{
        delid:delid
    })
    .then(function(response){
        if(response.status==200){
            if(response.data==1){ 
                toastr.success('Restore Successfully!');
                UsersList();
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
UsersList();
function UsersList(){
axios.get('/api-all-deleted-user-list')
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
                '<td>'+jsonData[i].mobile+'</td>'+
                '<td>'+jsonData[i].blood_group+'</td>'+
                '<td>'+jsonData[i].last_donate_date+'</td>'+
                '<td>'+ buttonDelete()+'</td>'

            ).appendTo('#UserTableRow');
            a++;
 
            function buttonDelete(){
                return '&nbsp;&nbsp;<a data-id='+jsonData[i].id+' href="#" class="btn btn-success btn-sm DelBtn DelBtn'+jsonData[i].id+'"> <i class="fas fa-redo"></i> Restore</a> ';
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