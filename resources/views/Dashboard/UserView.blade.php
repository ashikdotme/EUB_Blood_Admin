@extends('Layout.App')
@section('title','View User Details')
@section('content') 
<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">User Details &nbsp;&nbsp;  <a href="update-user?id={{ $data[0]['id'] }}" class="btn btn-warning">Edit User</a>  
                </h4> 
                <hr> 
                <div class="table table-responsive"> 
                    <table class="table profile-table">
                        <tr>
                            <td>Name:</td>
                            <td>{{ $data[0]['name'] }}</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>{{ $data[0]['email'] }}</td>
                        </tr>
                        <tr>
                            <td>Mobile:</td>
                            <td>{{ $data[0]['mobile'] }}</td>
                        </tr> 
                        <tr>
                            <td>Student ID:</td>
                            <td>{{ $data[0]['st_id'] }}</td>
                        </tr>
                        <tr>
                            <td>Department:</td>
                            <td>{{ $data[0]['department'] }}</td>
                        </tr>
                        <tr>
                            <td>Donor Type:</td>
                            <td>{{ $data[0]['donor_type'] }}</td>
                        </tr>
                        <tr>
                            <td>Blood Group:</td>
                            <td>{{ $data[0]['blood_group'] }}</td>
                        </tr>
                        <tr>
                            <td>Last Donate:</td>
                            <td>{{ $data[0]['last_donate_date']  }}</td>
                        </tr>
 
                        <tr>
                            <td>Address:</td>
                            <td>{{ $data[0]['address']  }}</td>
                        </tr>
                        <tr>
                            <td>Upzila:</td>
                            <td>{{ $data[0]['upzila']  }}</td>
                        </tr>
                        <tr>
                            <td>District:</td>
                            <td>{{ $data[0]['district']  }}</td>
                        </tr>
                        <tr>
                            <td>Birthday:</td>
                            <td>{{ $data[0]['birthday']  }}</td>
                        </tr>
                        <tr>
                            <td>Gender:</td>
                            <td>{{ $data[0]['gender']  }}</td>
                        </tr>    
                        <tr>
                            <td>Photo:</td>
                            <td><img style="max-width:200px;width:auto;"  src="{{ $data[0]['photo'] }} "></td>
                        </tr> 
                        <tr>
                            <td>Registration Date:</td>
                            <td>{{ $data[0]['created_at']  }}</td>
                        </tr>  
                        <tr>
                            <td>Updated At:</td>
                            <td>{{ $data[0]['updated_at']  }}</td>
                        </tr>  
                    </table> 

                </div> 
            </div>
        </div>
    </div> 
</div>
@endsection
