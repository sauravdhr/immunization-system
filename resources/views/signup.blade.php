@extends('layout.app')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h2>
               Register Employee
            </h2>
            <h2 class = "brand-after">
               <small> Enter Employee's Info </small>
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
<form action="/signup" method="POST" class="form-horizontal" role="form" >
   {!! csrf_field() !!}
   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Employee ID</label>
      <div class="col-sm-5">
         <input type="text" name="id" class="form-control" id="eid" 
            placeholder="Enter Employee's ID">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Password</label>
      <div class="col-sm-5">
         <input type="password" name="password" class="form-control" id="password" 
            placeholder="Enter Password">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Password Retype</label>
      <div class="col-sm-5">
         <input type="password" name="password_retype" class="form-control" id="password_retype" 
            placeholder="Enter Password Again">
      </div>
   </div>
   <hr class="tagline-divider">
   <p> 
   </p>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">First Name</label>
      <div class="col-sm-5">
         <input type="text" name="firstname" class="form-control" id="employee-firstname" 
            placeholder="Enter Employee's First Name">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Last Name</label>
      <div class="col-sm-5">
         <input type="text" name="lastname" class="form-control" id="employee-lastname" 
            placeholder="Enter Employee's Last Name">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Gender</label>
      <div class="col-sm-5">
         <select name="DropDownList1" id="employee-DropDownList1">
            <option selected="selected" value="Male">Male</option>
            <option value="Female">Female</option>
         </select>
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Designation</label>
      <div class="col-sm-5">
         <select name="DropDownList2" id="employee-DropDownList2">
            <option selected="selected" value="Chief Health Officer">Chief Health Officer</option>
            <option value="Health Officer">Health Officer</option>
            <option value="Health Assistant">Health Assistant</option>
         </select>
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Mobile No.</label>
      <div class="col-sm-5">
         <input type="text" name="mobile_no" class="form-control" id="employee-mobile_no" 
            placeholder="Enter Mobile No.">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">E-Mail</label>
      <div class="col-sm-5">
         <input type="text" name="email" class="form-control" id="employee-email" 
            placeholder="Enter Address">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Address</label>
      <div class="col-sm-5">
         <input type="text" name="address" class="form-control" id="employee-address" 
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
