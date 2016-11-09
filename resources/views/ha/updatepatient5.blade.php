@extends('layout.ha')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h2>
               Update Patients Vaccination History
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
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h2 class = "brand-after">
               <small> Enter Vaccination History
               </small>
            </h2>
            <hr class="tagline-divider">
         </div>
      </div>
   </div>
</div>
<form action="/editpatient3" method="POST" class="form-horizontal" role="form" >
   {!! csrf_field() !!}
   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Vaccine Name</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="firstname" name="vaccine"
            value = "{{ $data->vaccine }}">
      </div>
   </div>
   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Vaccine Date</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="example1" name="vaccine_date"
            value = "{{ $data->vacc_date }}">
      </div>
   </div>
   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Center Name</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="firstname" name="CenterName"
            value = "{{ $data->center }}">
      </div>
   </div>
   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <button type="submit" class="btn btn-default">Edit Patient's History</button>
      </div>
   </div>
</form>
@endsection
