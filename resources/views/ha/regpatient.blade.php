@extends('layout.ha')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h2>
               Register Patients
            </h2>
            <h2 class = "brand-after">
               <small> Enter Patient's Info </small>
            </h2>
            <hr class="tagline-divider">
            <p>
            </p>
         </div>
      </div>
   </div>
</div>
@if ($errors->has())
<div class="alert alert-danger">
   @foreach ($errors->all() as $error)
   {{ $error }}<br>        
   @endforeach
</div>
@endif
<form action="/registerpatient" method="POST" class="form-horizontal" role="form" >
   {!! csrf_field() !!}
   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Patients ID</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" name="id"  id="firstname" 
            placeholder="Enter Patient's ID">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Password</label>
      <div class="col-sm-5">
         <input type="password" class="form-control" name="password" id="lastname" 
            placeholder="Enter Password">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Password Retype</label>
      <div class="col-sm-5">
         <input type="password" class="form-control" name="password_retype"  id="lastname" 
            placeholder="Enter Password Again">
      </div>
   </div>
   <hr class="tagline-divider">
   <p> 
   </p>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Patients First Name</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="first_name" name="first_name" 
            placeholder="Enter Patients First Name">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Patients Last Name</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="last_name" name="last_name" 
            placeholder="Enter Patient's Name">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Fathers Name</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="father_name" name="father_name"
            placeholder="Enter Father's Name">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Mothers Name</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="mother_name" name="mother_name"
            placeholder="Enter Mother's Name">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Date of Birth</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="example1" name="date_of_birth"
            placeholder="Enter Date of Birth">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Gender</label>
      <div class="col-sm-5">
         <select name="gender" id="MainContent_DropDownList2" >
            <option selected="selected" value="Male">Male</option>
            <option value="Female">Female</option>
         </select>
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Mobile No.</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="lastname" name="mobile_no"
            placeholder="Enter Mobile No.">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Address</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="lastname" name="address"
            placeholder="Enter Address">
      </div>
   </div>
   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <button type="submit" class="btn btn-default">Register</button>
      </div>
   </div>
</form>
@endsection
@section('toast')
@if ($temp!=null)
<script type="text/javascript">
   $(document).ready(function() {
   
       // show when page load
       toastr.success('{{ $temp }}');
   
   });
   
</script>
@endif
@endsection
