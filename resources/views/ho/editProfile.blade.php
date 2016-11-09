@extends('layout.ho')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h2>
               Edit Profile
            </h2>
            <h2 class = "brand-after">
               <small> Enter New info. </small>
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
<form action="/editProfile" method="POST" class="form-horizontal" role="form" >
   {!! csrf_field() !!}
   <p> 
   </p>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">First Name</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="concept" name="first_name" value="{{$data->first_name}}"> 
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Last Name</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="concept" name="last_name" value="{{$data->last_name}}"> 
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
         <input type="text" class="form-control" id="concept" name="mobile_no" value="{{$data->mobile_no}}">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">E-Mail</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="concept" name="email" value="{{$data->email}}"> 
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Address</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="concept" name="address" value="{{$data->address}}">
      </div>
   </div>
   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <button type="submit" class="btn btn-info">Save</button>
         <a href="{{ URL::to('profile') }}" class="btn btn-danger">Cancel</a>
      </div>
   </div>
</form>
@endsection
