@extends('layout.admin')
@section('content')
<div class="col-lg-12 text-center">
   <div class="row">
      <div class="col-lg-12 text-center">
         <div class="col-sm-6 col-md-4.5 col-md-offset-3">
            <h2>
               Delete Vaccine Entry
            </h2>
            <h2 class = "brand-after">
               <small> Vaccine Entry </small>
            </h2>
            <hr class="tagline-divider">
            <div class="table-responsive">
               <table class="table">
                  <tbody>
                     <tr>
                        <td><b>Vaccine Name</b></td>
                        <td>{{ $temp->vaccine_name }}</td>
                     </tr>
                     <tr>
                        <td><b>Inventory Name</b></td>
                        <td>{{ $temp->inventory_name }}</td>
                     </tr>
                     <tr>
                        <td><b>Total Vials</b></td>
                        <td>{{ $temp->total_vials }}</td>
                     </tr>
                     <tr>
                        <td><b>Available Vials</b></td>
                        <td>{{ $temp->available_vials }}</td>
                     </tr>
                     <tr>
                        <td><b>Manufacturer</b></td>
                        <td>{{ $temp->manufacturer }}</td>
                     </tr>
                     <tr>
                        <td><b>Manufacture Date</b></td>
                        <td>{{ $temp->mfg_date }}</td>
                     </tr>
                     <tr>
                        <td><b>Expire Date</b></td>
                        <td>{{ $temp->exp_date }}</td>
                     </tr>
                     <tr>
                        <td><b>VFC Eligibility</b></td>
                        <td>{{ $temp->vfc }}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <form action="/deleteVaccine2" method="POST" class="form-horizontal" role="form" >
               {!! csrf_field() !!}
               <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-8">
                     <button type="submit" class="btn btn-default">Delete Vaccine</button>
                     <a href="{{ URL::to('deleteCampaign') }}" class="btn btn-danger">Cancel</a>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection