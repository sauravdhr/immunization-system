@extends('layout.pat')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-1 col-md-6 col-md-offset-3">
            <h2>View Notifications</h2>
            <h2 class = "brand-after">
               <small> Select Notifications </small>
            </h2>
            <hr class="tagline-divider">
            <p>
            </p>
            @if ($temp!=null)
            <table class="table">
               <tr style="color:White;background-color:#507CD1;font-weight:bold;">
                  <th scope="col">&nbsp;</th>
                  <th scope="col">Campaign Name</th>
                  <th scope="col">Date & Time </th>
                  @foreach ($temp as $line)
               <tr >
                  <td><a href="viewNotifications/{{ $line->noti_no }}" style="color:blue">Select</a></td>
                  <td>{{ $line->campaign_name}}</td>
                  <td>{{ $line->msg_date}}</td>
               </tr>
               @endforeach
            </table>
            <hr class="tagline-divider">
            <p>
            </p>
            @endif
            @if ($temp==null)
            <h2>
               There is no notifications
            </h2>
            @endif
         </div>
      </div>
   </div>
</div>
@endsection
