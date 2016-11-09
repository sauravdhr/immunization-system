@extends('layout.admin')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-2 col-md-8 col-md-offset-2">
            <h2>
               Delete Vaccine Entry
            </h2>
            <h2 class = "brand-after">
               <small> Select Vaccine Entry </small>
            </h2>
            <hr class="tagline-divider">
            <p>
            </p>
            @if ($temp[0]!=null)
            <div class="table-responsive">
               <table class="table">
                  <tr style="color:White;background-color:#507CD1;font-weight:bold;">
                     <th scope="col">&nbsp;</th>
                     <th scope="col">Vaccine Name</th>
                     <th scope="col">Inventory Date</th>
                     <th scope="col">Total Vials</th>
                     <th scope="col">Available Vials</th>
                     <th scope="col">Manufacturer</th>
                     <th scope="col">Manufacture Date</br>
                     <th scope="col">Expire Date</br>
                     <th scope="col">VFC eligibility</br>
                        @foreach ($temp[0] as $line)
                  <tr>
                     <td><a href="deleteVaccine/{{ $line->vaccine_no }}" style="color:blue">Select</a></td>
                     <td>{{ $line->vaccine_name}}</td>
                     <td>{{ $line->inventory_name}}</td>
                     <td>{{ $line->total_vials}}</td>
                     <td>{{ $line->available_vials}}</td>
                     <td>{{ $line->manufacturer}}</td>
                     <td>{{ $line->mfg_date }}</td>
                     <td>{{ $line->exp_date }}</td>
                     <td>{{ $line->vfc }}</td>
                  </tr>
                  @endforeach
               </table>
               <hr class="tagline-divider">
               <p></p>
               @endif
               @if ($temp[0]==null)
               <h2>
                  There arent any vaccines in the vaccine inventory database :( 
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