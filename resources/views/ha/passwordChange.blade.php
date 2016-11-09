@extends('layout.ha')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h2>
               Change Password
            </h2>
            <h2 class = "brand-after">
               <small> Enter New and old Password </small>
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
<form action="/changePassword" method="POST" class="form-horizontal" role="form" >
   {!! csrf_field() !!}
   <p> 
   </p>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Old Password</label>
      <div class="col-sm-5">
         <input type="password" class="form-control" id="concept" name="password1" 
            placeholder="Enter Old Password "> 
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">New Password</label>
      <div class="col-sm-5">
         <input type="password" class="form-control" id="concept" name="password" 
            placeholder="Enter Password"> 
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Password Retype</label>
      <div class="col-sm-5">
         <input type="password" name="password_retype" class="form-control" id="password_retype" 
            placeholder="Enter New Password Again">
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
