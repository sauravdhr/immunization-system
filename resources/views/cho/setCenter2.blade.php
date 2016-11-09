@extends('layout.cho')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-1 col-md-6 col-md-offset-3">
            <h2>
               Set Centers
            </h2>
            <h2 class = "brand-after">
               <small> Select Centers </small>
            </h2>
            <hr class="tagline-divider">
            <p>
            </p>
            <div class="table-responsive">
               <table class="table">
                  <tr style="color:White;background-color:#507CD1;font-weight:bold;">
                     <th scope="col">&nbsp;</th>
                     <th scope="col">Center Name</th>
                     <th scope="col">Location</th>
                     <th scope="col">District</th>
                     <th scope="col">Contact No.</th>
                     @if ($data[0]!=null)
                     @foreach ($data[0] as $line)
                  <tr >
                     <td><a href="setCenter2/add/{{ $line->center_no }}" style="color:blue">Select</a></td>
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
               <small> Selected Centers </small>
            </h2>
            <div class="table-responsive">
               <table class="table">
                  <tr style="color:White;background-color:#507CD1;font-weight:bold;">
                     <th scope="col">&nbsp;</th>
                     <th scope="col">Center Name</th>
                     <th scope="col">Location</th>
                     <th scope="col">District</th>
                     <th scope="col">Contact No.</th>
                     @if ($data[1]!=null)
                     @foreach ($data[1] as $line)
                  <tr >
                     <td><a href="setCenter2/del/{{ $line->center_no }}" style="color:blue">Deselect</a></td>
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
            <form action="/setCenter2" method="POST" class="form-horizontal" role="form" >
               {!! csrf_field() !!}
               <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-8">
                     <button type="submit" class="btn btn-default">Confirm Centers</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
