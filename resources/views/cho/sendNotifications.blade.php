@extends('layout.cho')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-1 col-md-6 col-md-offset-3">
            <h2>
               Send Notifications
            </h2>
            <h2 class = "brand-after">
               <small> Select Campaign </small>
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
                     <th scope="col">Vaccine</th>
                     <th scope="col">Start Age</br>(months)</th>
                     <th scope="col">End Age</br>(months)</th>
                     @foreach ($temp[0] as $line)
                  <tr >
                     <td><a href="notify/{{ $line->campaign_no }}" style="color:blue">Select</a></td>
                     <td>{{ $line->campaign_name}}</td>
                     <td>{{ $line->campaign_date}}</td>
                     <td>{{ $line->vaccine_name }}</td>
                     <td>{{ $line->start_age }}</td>
                     <td>{{ $line->end_age }}</td>
                  </tr>
                  @endforeach
               </table>
               <hr class="tagline-divider">
               <p></p>
               @endif
               @if ($temp[0]==null)
               <h2>
                  You have not created any campaigns
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
