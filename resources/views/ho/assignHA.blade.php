@extends('layout.ho')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-2 col-md-7 col-md-offset-2">
            <h2>
               Assign Health Assistant
            </h2>
            <h2 class = "brand-after">
               <small> Select Center that you are assigned to </small>
            </h2>
            <hr class="tagline-divider">
            <p>
            </p>
            @if ($temp[0]!=null)
            <div class="table-responsive">
               <table class="table">
                  <tr style="color:White;background-color:#507CD1;font-weight:bold;">
                     <th scope="col">&nbsp;</th>
                     <th scope="col">Campaign Name</th>
                     <th scope="col">Campaign Date</th>
                     <th scope="col">Center Name</th>
                     <th scope="col">Location</th>
                     <th scope="col">District</th>
                     <th scope="col">Contact No</br>
                        @foreach ($temp[0] as $line)
                  <tr>
                     <td><a href="assignHA/{{ $line->cc_no }}" style="color:blue">Select</a></td>
                     <td>{{ $line->campaign_name}}</td>
                     <td>{{ $line->campaign_date}}</td>
                     <td>{{ $line->center_name}}</td>
                     <td>{{ $line->location}}</td>
                     <td>{{ $line->district}}</td>
                     <td>{{ $line->contact_no }}</td>
                  </tr>
                  @endforeach
               </table>
               <hr class="tagline-divider">
               <p></p>
               @endif
               @if ($temp[0]==null)
               <h2>
                  You are not assigned to any centers
               </h2>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('toast')
@if ($temp[1]!=null)
<script type="text/javascript">
   $(document).ready(function() {
   
       // show when page load
       toastr.success('{{ $temp[1] }}');
   
   });
   
</script>
@endif
@endsection
