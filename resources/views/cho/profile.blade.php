@extends('layout.cho')
@section('content')
<div class="col-lg-12 text-center">
   <div class="row">
      <div class="col-lg-12 text-center">
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
                        <td><b>Designation</b></td>
                        <td>{{ $data[0]->designation }}</td>
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
                        <td><b>Email</b></td>
                        <td>{{ $data[0]->email }}</td>
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
