@extends('layout.ho')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h2>
               Add Center
            </h2>
            <h2 class = "brand-after">
               <small> Enter Center Info </small>
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
<form action="/addCenter" method="POST" class="form-horizontal" role="form" >
   {!! csrf_field() !!}
   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Center Name</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="firstname" name="center_name"
            placeholder="Enter Center Name">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Center Location</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="lastname" name="location"
            placeholder="Enter Center Location">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">District</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="exampl" name="district"
            placeholder="Enter District">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Contact No.</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="lastname" name="contact_no"
            placeholder="Enter Contact No.">
      </div>
   </div>
   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <button type="submit" class="btn btn-default">Add Center</button>
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
