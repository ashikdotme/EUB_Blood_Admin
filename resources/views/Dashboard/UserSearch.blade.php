@extends('Layout.App')
@section('title','Search User')
@section('content') 
<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Search User</h4>
                <hr> 
                <form action="" method="POST" id="searchForm">
                    <div class="form-group">
                        <label for="search_mobile">Mobile Number</label>
                        <input type="text"  class="form-control" id="search_mobile">
                    </div>

                    <div class="form-group"> 
                        <input type="submit" class="btn btn-success" value="Search" id="search_mobile">
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>
 
@endsection

@section('scripts')
<script>
    $('#searchForm').on('submit',function(e){
        e.preventDefault();

    var search_mobile = $('#search_mobile').val();
    axios.post('/api-search-the-user',{
        search_mobile:search_mobile
    })
    .then(function(response){
        if(response.status==200){
            if(response.data==0){ 
                toastr.error('User Not Found!'); 
                
            }else{
               setTimeout(() => {
                    window.location.href="view-user?id="+response.data;
               }, 2000);
                toastr.success('Find The User!');
            }
        }
    })
});
</script>
@endsection