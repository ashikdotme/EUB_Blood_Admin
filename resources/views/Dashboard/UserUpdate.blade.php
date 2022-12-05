@extends('Layout.App')
@section('title','Update User')
@section('content') 
<div class="row">
    <div class="col-sm-12 col-md-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update User</h4> 
                <hr> 
                <form action="" method="POST" id="updateUserForm">
                <div class="table table-responsive"> 
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" value="{{ $data[0]['name'] }}" id="name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" value="{{ $data[0]['email'] }}" id="email">
                    </div>

                    <div class="form-group">
                        <label for="mobile">Mobile:</label>
                        <input type="text" class="form-control" value="{{ $data[0]['mobile'] }}" id="mobile">
                    </div>
                    
                    <div class="form-group">
                        <label for="st_id">Student ID:</label>
                        <input type="text" class="form-control" value="{{ $data[0]['st_id'] }}" id="st_id">
                    </div>
                    <div class="form-group">
                        <label for="department">Department:</label>
                        <select name="department"  class="form-control"   id="department">
                            <option value="{{ $data[0]['department'] }}" selected>{{ $data[0]['department'] }}</option>
                            <option value="CSE">CSE</option>
                            <option value="EEE">EEE</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="donor_type">Donor Type:</label>
                        <select name="donor_type"  class="form-control"   id="donor_type">
                            <option value="{{ $data[0]['donor_type'] }}" selected>{{ $data[0]['donor_type'] }}</option>
                            <option value="Teacher">Teacher</option>
                            <option value="Staff">Staff</option>
                            <option value="Student">Student</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="blood_group">Blood Group:</label>
                        <select name="blood_group" class="form-control"  id="blood_group">
                            <option value="{{ $data[0]['blood_group'] }}" selected>{{ $data[0]['blood_group'] }}</option>
                             <option value="A+">A+</option>
                             <option value="A-">A-</option>
                             <option value="B+">B+</option>
                             <option value="B-">B-</option>
                             <option value="O+">O+</option>
                             <option value="O-">O-</option>
                             <option value="AB+">AB+</option>
                             <option value="AB-">AB-</option>
                         </select>
                    </div>

                    <div class="form-group">
                        <label for="last_donate_date">Last Donate Date:</label>
                        <input type="date" class="form-control" value="{{ $data[0]['last_donate_date'] }}" id="last_donate_date">
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" value="{{ $data[0]['address'] }}" id="address">
                    </div>

                    <div class="form-group">
                        <label for="upzila">Upzila:</label>
                        <input type="text" class="form-control" value="{{ $data[0]['upzila'] }}" id="upzila">
                    </div>
                    
                    <div class="form-group">
                        <label for="district">District:</label> 
                        <select name="district"  class="form-control"   id="district">
                            <option value="{{ $data[0]['district'] }}" selected>{{ $data[0]['district'] }}</option>
                            <option value="Bagerhat">Bagerhat</option>
                            <option value="Bandarban">Bandarban</option>
                            <option value="Barguna">Barguna</option>
                            <option value="Barisal">Barisal</option>
                            <option value="Bhola">Bhola</option>
                            <option value="Bogra">Bogra</option>
                            <option value="Brahmanbaria">Brahmanbaria</option>
                            <option value="Chandpur">Chandpur</option>
                            <option value="Chittagong">Chittagong</option>
                            <option value="Chuadanga">Chuadanga</option>
                            <option value="Comilla">Comilla</option>
                            <option value="Cox'sBazar">Cox'sBazar</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Dinajpur">Dinajpur</option>
                            <option value="Faridpur">Faridpur</option>
                            <option value="Feni">Feni</option>
                            <option value="Gaibandha">Gaibandha</option>
                            <option value="Gazipur">Gazipur</option>
                            <option value="Gopalganj">Gopalganj</option>
                            <option value="Habiganj">Habiganj</option>
                            <option value="Jaipurhat">Jaipurhat</option>
                            <option value="Jamalpur">Jamalpur</option>
                            <option value="Jessore">Jessore</option>
                            <option value="Jhalokati">Jhalokati</option>
                            <option value="Jhenaidah">Jhenaidah</option>
                            <option value="Khagrachari">Khagrachari</option>
                            <option value="Khulna">Khulna</option>
                            <option value="Kishoreganj">Kishoreganj</option>
                            <option value="Kurigram">Kurigram</option>
                            <option value="Kushtia">Kushtia</option>
                            <option value="Lakshmipur">Lakshmipur</option>
                            <option value="Lalmonirhat">Lalmonirhat</option>
                            <option value="Madaripur">Madaripur</option>
                            <option value="Magura">Magura</option>
                            <option value="Manikganj">Manikganj</option>
                            <option value="Maulvibazar">Maulvibazar</option>
                            <option value="Meherpur">Meherpur</option>
                            <option value="Munshiganj">Munshiganj</option>
                            <option value="Mymensingh">Mymensingh</option>
                            <option value="Naogaon">Naogaon</option>
                            <option value="Narail">Narail</option>
                            <option value="Narayanganj">Narayanganj</option>
                            <option value="Narsingdi">Narsingdi</option>
                            <option value="Natore">Natore</option>
                            <option value="Nawabganj">Nawabganj</option>
                            <option value="Netrokona">Netrokona</option>
                            <option value="Nilphamari">Nilphamari</option>
                            <option value="Noakhali">Noakhali</option>
                            <option value="Pabna">Pabna</option>
                            <option value="Panchagarh">Panchagarh</option>
                            <option value="Patuakhali">Patuakhali</option>
                            <option value="Pirojpur">Pirojpur</option>
                            <option value="Rajbari">Rajbari</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Rangamati">Rangamati</option>
                            <option value="Rangpur">Rangpur</option>
                            <option value="Satkhira">Satkhira</option>
                            <option value="Shariatpur">Shariatpur</option>
                            <option value="Sherpur">Sherpur</option>
                            <option value="Sirajganj">Sirajganj</option>
                            <option value="Sunamganj">Sunamganj</option>
                            <option value="Sylhet">Sylhet</option>
                            <option value="Tangail">Tangail</option>
                            <option value="Thakurgaon">Thakurgaon</option>
                        </select>  
                    </div>
 
                    <div class="form-group">
                        <label for="birthday">Birthday:</label>
                        <input type="date" class="form-control" value="{{ $data[0]['birthday'] }}" id="birthday">
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select name="gender" class="form-control" id="gender">
                            <option value="{{ $data[0]['gender'] }}" selected>{{ $data[0]['gender'] }}</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select> 
                    </div>
 
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="If you won't change the password please skip it">
                    </div>
                    <input type="hidden" class="form-control" id="user_id" value="{{ $data[0]['id'] }}">
                    <div class="form-group">
                        <input type="submit" value="Update User" id="updateBtn" class="btn btn-success">
                    </div>
 
                </div>
            </form> 
            </div>
        </div>
    </div> 
</div>

@endsection
@section('scripts')
<script>

$('#updateUserForm').on('submit',function(e){
    e.preventDefault();
    let name = $('#name').val(); 
    let email = $('#email').val();
    let mobile = $('#mobile').val();
    let st_id = $('#st_id').val(); 
    let department = $('#department').val(); 
    let donor_type = $('#donor_type').val(); 
    let blood_group = $('#blood_group').val();
    let last_donate_date = $('#last_donate_date').val(); 
    let address = $('#address').val();
    let upzila = $('#upzila').val();
    let district = $('#district').val();
    let gender = $('#gender').val();
    let birthday = $('#birthday').val(); 
    let password = $('#password').val();
    let user_id = $('#user_id').val();
    
    $('#updateBtn').val('Updating...');
    axios.post('/api-update-the-user-data',{
        name:name, 
        email:email,
        mobile:mobile,
        st_id:st_id,
        department:department,
        donor_type:donor_type,
        blood_group:blood_group,
        last_donate_date:last_donate_date,
        address:address,
        upzila:upzila,
        district:district,
        gender:gender,
        birthday:birthday,
        password:password,
        user_id:user_id
    })
    .then(function(response){
        if(response.status == 200){
            if(response.data == 1){
                toastr.success('Update Success!');
                $('#updateBtn').val('Update User');
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } 
            else{
                toastr.error(response.data);
                $('#updateBtn').val('Update User');
            } 
        } 
    })
 
});
</script>
@endsection