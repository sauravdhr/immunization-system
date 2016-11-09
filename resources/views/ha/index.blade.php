@extends('layout.ha')
@section('content')
<div class="col-lg-12 text-center">
<h2>
   Welcome {{ $name[0] }}
</h2>
<h2 class = "brand-after">
   <small> Centers you are assigned at </small>
</h2>
@if ($name[1]!=null)
<div class="col-sm-1 col-md-6 col-md-offset-3">
   <div class="table-responsive">
      <table class="table">
         <tr style="color:White;background-color:#507CD1;font-weight:bold;">
            <th scope="col">Center Name</th>
            <th scope="col">Location</th>
            <th scope="col">District</th>
            <th scope="col">Camapign Name</th>
            <th scope="col">Campaign Date</th>
            @foreach ($name[1] as $line)
         <tr >
            <td>{{ $line->center_name}}</td>
            <td>{{ $line->location}}</td>
            <td>{{ $line->district }}</td>
            <td>{{ $line->campaign_name }}</td>
            <td>{{ $line->campaign_date }}</td>
         </tr>
         @endforeach
      </table>
   </div>
   @endif
   @if ($name[1]==null)
   <div class="col-sm-6 col-md-4 col-md-offset-4">
      <h2 >
         <small> You are not assigned to any centers currently. </small>
      </h2>
   </div>
   @endif    
</div>
@endsection
