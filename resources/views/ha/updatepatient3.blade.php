@extends('layout.ha')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h2>
               Edit Patient's Vaccination History
            </h2>
            <h2 class = "brand-after">
               <small> Enter Patient's ID </small>
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
<form action="/editpatient" method="POST" class="form-horizontal" role="form" >
   {!! csrf_field() !!}
   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Patients ID</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="firstname" name="id"
            placeholder="Enter Patient's ID">
      </div>
   </div>
   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <button type="submit" class="btn btn-default">Search Patient</button>
      </div>
   </div>
</form>
@endsection
