@extends('layout.ho')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h2>
               Add Vaccine
            </h2>
            <h2 class = "brand-after">
               <small> Enter Vaccine Info </small>
            </h2>
            <hr class="tagline-divider">
            <p>
            </p>
         </div>
      </div>
   </div>
</div>
@if ($errors->has())
<div class="alert alert-danger">
   @foreach ($errors->all() as $error)
   {{ $error }}<br>        
   @endforeach
</div>
@endif
<form action="/addVaccine" method="POST" class="form-horizontal" role="form" >
   {!! csrf_field() !!}
   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Vaccine Name</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="firstname" name="vaccine_name"
            placeholder="Enter Vaccine Name">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Inventory Name</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="lastname" name="inventory_name"
            placeholder="Enter inventory Name">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Total Vials</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="lastname" name="total_vials"
            placeholder="Enter Total Vials">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Available Vials</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="lastname" name="available_vials"
            placeholder="Enter Available Vials">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Manufacturer</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="lastname" name="manufacturer"
            placeholder="Enter manufacturer">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Mfg Date</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="example1" name="mfg_date"
            placeholder="Enter Mfg Date">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">Expire Date</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="example2" name="exp_date"
            placeholder="Enter Expire Date">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">VFC eligibility</label>
      <div class="col-sm-5">
         <select name="DropDownList2" id="DropDownList2">
            <option selected="selected" value="True">True</option>
            <option value="False">False</option>
         </select>
      </div>
   </div>
   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <button type="submit" class="btn btn-default">Add Vaccine</button>
      </div>
   </div>
</form>
@endsection
@section('toast')
@if ($temp!=null)
<script type="text/javascript">
   $(document).ready(function() {
   
       // show when page load
       toastr.success('{{ $temp }}');
   
   });
   
</script>
@endif
@endsection
