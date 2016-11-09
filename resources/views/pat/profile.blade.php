@extends('layout.pat')
@section('content')
<div class="col-lg-12 text-center">
   <div class="col-lg-12 text-center">
      <div class="row">
         <a href="{{ URL::to('editProfile') }}" class="btn btn-info">Edit Profile</a>
         <a href="{{ URL::to('changePassword') }}" class="btn btn-info">Change Password</a>
         <div class="col-sm-6 col-md-4.5 col-md-offset-3">
            <h2 class = "brand-name">
               <medium> Profile </medium>
            </h2>
            <div class="table-responsive">
               <table class="table">
                  <tbody>
                     <tr>
                        <td><b>First Name</b></td>
                        <td>{{ $data[0]->first_name }}</td>
                     </tr>
                     <tr>
                        <td><b>Last Name</b></td>
                        <td>{{ $data[0]->last_name }}</td>
                     </tr>
                     <tr>
                        <td><b>Fathers Name</b></td>
                        <td>{{ $data[0]->father_name}}</td>
                     </tr>
                     <tr>
                        <td><b>Mothers Name</b></td>
                        <td>{{ $data[0]->mother_name}}</td>
                     </tr>
                     <tr>
                        <td><b>Gender</b></td>
                        <td>{{ $data[0]->gender }}</td>
                     </tr>
                     <tr>
                        <td><b>Mobile No.</b></td>
                        <td>{{ $data[0]->mobile_no }}</td>
                     </tr>
                     <tr>
                        <td><b>Date of Birth</b></td>
                        <td>{{ $data[0]->date_of_birth }}</td>
                     </tr>
                     <tr>
                        <td><b>Age</b></td>
                        <td>{{ $data[0]->age }}</td>
                     </tr>
                     <tr>
                        <td><b>Address</b></td>
                        <td>{{ $data[0]->address }}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
@if ($data[1]!=null)
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-6 col-md-3 col-md-offset-4">
            <h2 class = "brand-after">
               <small> Vaccination History
               </small>
            </h2>
            <hr class="tagline-divider">
         </div>
      </div>
   </div>
</div>
<div class="col-sm-6 col-md-6 col-md-offset-3">
   <table class="table">
      <tr style="color:White;background-color:#507CD1;font-weight:bold;">
         <th scope="col">VACCINATED BY</th>
         <th scope="col">CENTER</th>
         <th scope="col">VACCINE DATE</th>
         <th scope="col">VACCINE</th>
         @foreach ($data[1] as $line)
      <tr>
         <td>{{ $line->healthasst_id }}</td>
         <td>{{ $line->center }}</td>
         <td>{{ $line->vacc_date }}</td>
         <td>{{ $line->vaccine }}</td>
      </tr>
      @endforeach
   </table>
</div>
<hr class="tagline-divider">
<p></p>
@endif
@if ($data[1]==null)
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-6 col-md-3 col-md-offset-4">
            <h2 class = "brand-after">
               <medium> Vaccination History
               </medium>
            </h2>
            <hr class="tagline-divider">
         </div>
      </div>
   </div>
</div>
<div class="col-sm-6 col-md-4 col-md-offset-4">
   <h2 >
      <small> You have not taken any vaccines yet </small>
   </h2>
</div>
<hr class="tagline-divider">
<p></p>
@endif
@endsection
@section('toast')
@if ($data[2]!=null)
<script type="text/javascript">
   $(document).ready(function() {
   
       // show when page load
       toastr.success('{{ $data[2] }}');
   
   });
   
</script>
@endif
@endsection
