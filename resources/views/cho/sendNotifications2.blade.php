@extends('layout.cho')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-0 col-md-5 col-md-offset-3">
            <h2>
               Send Notifications
            </h2>
            <h2 class = "brand-after">
               <small>Campaign Info</small>
            </h2>
            <hr class="tagline-divider">
            <p>
            </p>
            <div class="table-responsive">
               <table class="table">
                  <tbody>
                     <tr>
                        <td><b>Campaign Name</b></td>
                        <td>{{ $data[0][0]->campaign_name }}</td>
                     </tr>
                     <tr>
                        <td><b>Vaccine Name</b></td>
                        <td>{{ $data[0][0]->vaccine_name }}</td>
                     </tr>
                     <tr>
                        <td><b>Campaign Date</b></td>
                        <td>{{ $data[0][0]->campaign_date }}</td>
                     </tr>
                     <tr>
                        <td><b>Start Age(in months)</b></td>
                        <td>{{ $data[0][0]->start_age }}</td>
                     </tr>
                     <tr>
                        <td><b>End Age(in months)</b></td>
                        <td>{{ $data[0][0]->end_age }}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <h2 class = "brand-after">
               <small> Centers Under this campaign</small>
            </h2>
            <hr class="tagline-divider">
            <div class="table-responsive">
               <table class="table">
                  <tr style="color:White;background-color:#507CD1;font-weight:bold;">
                     <th scope="col">Center Name</th>
                     <th scope="col">Location</th>
                     <th scope="col">District</th>
                     <th scope="col">Contact No.</th>
                     @if ($data[1]!=null)
                     @foreach ($data[1] as $line)
                  <tr >
                     <td>{{ $line->center_name}}</td>
                     <td>{{ $line->location}}</td>
                     <td>{{ $line->district }}</td>
                     <td>{{ $line->contact_no }}</td>
                  </tr>
                  @endforeach
                  @endif
               </table>
               <hr class="tagline-divider">
               <p>
               </p>
            </div>
            <h2 class = "brand-after">
               <small> Notification Message:</small>
            </h2>
            @if ($errors->has())
            <div class="alert alert-danger">
               @foreach ($errors->all() as $error)
               {{ $error }}<br>        
               @endforeach
            </div>
            @endif
            <form action="/notify2" method="POST" class="form-horizontal" role="form" >
               {!! csrf_field() !!}
               <div class="form-group">
                  <div class="col-sm-offset-1 col-sm-10">
                     <textarea class="form-control" rows="10" id="comment" name="noti" placeholder="message cannot be more than 430 words"></textarea>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-8">
                     <button type="submit" class="btn btn-default">Send Notifications</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
