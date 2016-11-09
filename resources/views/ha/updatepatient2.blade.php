@extends('layout.ha')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h2>
               Update Patients Vaccination History
            </h2>
            <h2 class = "brand-after">
               <small> Patient's ID: {{ $data[0] }}</br>
               </small>
               <small> Patient's Name: {{ $data[1] }}</br>
               </small>
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
@if ($data[2]!=null)
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h2 class = "brand-after">
               <small> Vaccination History
               </small>
            </h2>
            <hr class="tagline-divider">
         </div>
      </div>
   </div>
</div>
<table class="table">
   <tr style="color:White;background-color:#507CD1;font-weight:bold;">
      <th scope="col">VACCINATED BY</th>
      <th scope="col">CENTER</th>
      <th scope="col">VACC DATE</th>
      <th scope="col">VACCINE</th>
      @foreach ($data[2] as $line)
   <tr>
      <td>{{ $line->healthasst_id }}</td>
      <td>{{ $line->center }}</td>
      <td>{{ $line->vacc_date }}</td>
      <td>{{ $line->vaccine }}</td>
   </tr>
   @endforeach
</table>
<hr class="tagline-divider">
<p></p>
@endif
<form action="/updatepatient2" method="POST" class="form-horizontal" role="form" >
   {!! csrf_field() !!}
   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Vaccine Name</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="firstname" name="vaccine"
            placeholder="Enter Vaccine">
      </div>
   </div>
   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Vaccine Date</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="example1" name="vaccine_date"
            placeholder="Enter Vaccine Date">
      </div>
   </div>
   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Center Name</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="firstname" name="CenterName"
            placeholder="Enter Center Name">
      </div>
   </div>
   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <button type="submit" class="btn btn-default">Add Patient's History</button>
         <a href="{{ URL::to('updatepatient') }}" class="btn btn-danger">Cancel</a>
      </div>
   </div>
</form>
@endsection
@section('toast')
@if ($data[3]!=null)
<script type="text/javascript">
   $(document).ready(function() {
   
       // show when page load
       toastr.success('{{ $data[3] }}');
   
   });
   
</script>
@endif
@endsection
