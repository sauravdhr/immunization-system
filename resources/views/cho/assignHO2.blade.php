@extends('layout.cho')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-1 col-md-7 col-md-offset-2">
            <h2>
               Assign Health Officer
            </h2>
            <h2 class = "brand-after">
               <small>Select Center</small>
            </h2>
            <hr class="tagline-divider">
            <p>
            </p>
            <div class="table-responsive">
               <table class="table">
                  <tr style="color:White;background-color:#507CD1;font-weight:bold;">
                     <th scope="col">&nbsp;</th>
                     <th scope="col">Center Name</th>
                     <th scope="col">Location</th>
                     <th scope="col">District</th>
                     <th scope="col">Contact No.</th>
                     <th scope="col">Health Officer</th>
                     @if ($data[0]!=null)
                     @foreach ($data[0] as $line)
                  <tr >
                     <td><a href="assignHO2/{{ $line->center_no }}" style="color:blue">Select</a></td>
                     <td>{{ $line->center_name}}</td>
                     <td>{{ $line->location}}</td>
                     <td>{{ $line->district }}</td>
                     <td>{{ $line->contact_no }}</td>
                     <td>{{ $line->health_officer }}</td>
                  </tr>
                  @endforeach
                  @endif
               </table>
               <hr class="tagline-divider">
               <p>
               </p>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('toast')
@if ($data[1]!=null)
<script type="text/javascript">
   $(document).ready(function() {
   
       // show when page load
       toastr.success('{{ $data[1] }}');
   
   });
   
</script>
@endif
@endsection