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
      <th scope="col">&nbsp;</th>
      <th scope="col">VACCINATED BY</th>
      <th scope="col">CENTER</th>
      <th scope="col">VACC DATE</th>
      <th scope="col">VACCINE</th>
      @foreach ($data[2] as $line)
   <tr>
      <td><a href="editpatient2/{{ $line->record_no }}" style="color:blue">Select</a>
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
