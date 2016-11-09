@extends('layout.cho')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h2>
               Create Campaign
            </h2>
            <h2 class = "brand-after">
               <small> Enter Campaign Info </small>
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
<form action="/createCampaign" method="POST" class="form-horizontal" role="form" >
   {!! csrf_field() !!}
   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Campaign Name</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="firstname" name="campaign_name"
            placeholder="Enter Campaign Name">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Vaccine Name</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="lastname" name="vaccine_name"
            placeholder="Enter Vaccine Name">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Campaign Date</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="example1" name="campaign_date"
            placeholder="Enter Campaign Date">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Start Age(in months)</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="lastname" name="start_age"
            placeholder="Enter Start Age (in months)">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">End Age(in months)</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="lastname" name="end_age"
            placeholder="Enter End Age (in months)">
      </div>
   </div>
   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <button type="submit" class="btn btn-default">Create Campaign</button>
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
