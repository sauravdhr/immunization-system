@extends('layout.admin')
@section('content')
<div class="col-lg-12 text-center">
   <div class="row">
      <div class="col-lg-12 text-center">
         <div class="col-sm-6 col-md-4.5 col-md-offset-3">
            <h2 class = "brand-name">
               <small> Employee's Profile </small>
            </h2>
            <div class="table-responsive">
               <table class="table">
                  <tbody>
                     <tr>
                        <td><b>First Name</b></td>
                        <td>{{ $data->first_name }}</td>
                     </tr>
                     <tr>
                        <td><b>Last Name</b></td>
                        <td>{{ $data->last_name }}</td>
                     </tr>
                     <tr>
                        <td><b>Designation</b></td>
                        <td>{{ $data->designation }}</td>
                     </tr>
                     <tr>
                        <td><b>Gender</b></td>
                        <td>{{ $data->gender }}</td>
                     </tr>
                     <tr>
                        <td><b>Mobile No.</b></td>
                        <td>{{ $data->mobile_no }}</td>
                     </tr>
                     <tr>
                        <td><b>Email</b></td>
                        <td>{{ $data->email }}</td>
                     </tr>
                     <tr>
                        <td><b>Address</b></td>
                        <td>{{ $data->address }}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <form action="/approveEmployee2" method="POST" class="form-horizontal" role="form" >
               {!! csrf_field() !!}
               <div class="form-group">
                  <div class="col-sm-offset-1 col-sm-10">
                     <button type="submit" class="btn btn-info">Approve</button>
                     <a href="approveEmployee2/{{ $data->emp_no }}" class="btn btn-danger">Deny</a>
                     <a href="{{ URL::to('approveEmployee') }}" class="btn btn-info">Cancel</a>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection