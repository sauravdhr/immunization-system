@extends('layout.cho')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-1 col-md-7 col-md-offset-2">
            <h2>
               Assign Health Officer
            </h2>
            <h2 class = "brand-after">
               <small>Select Health Officer</small>
            </h2>
            <hr class="tagline-divider">
            <p>
            </p>
            <div class="col-sm-2 col-md-4 col-md-offset-4">
               <div class="table-responsive">
                  <table class="table">
                     <tr style="color:White;background-color:#507CD1;font-weight:bold;">
                        <th scope="col">&nbsp;</th>
                        <th scope="col">Health Officer</th>
                        @if ($temp!=null)
                        @foreach ($temp as $line)
                     <tr >
                        <td><a href="/assignHO3/{{ $line->emp_no }}" style="color:blue">Select</a></td>
                        <td>{{ $line->name}}</td>
                     </tr>
                     @endforeach
                     @endif
                  </table>
                  <hr class="tagline-divider">
                  <p>
                  </p>
               </div>
            </div>
            <form action="/assignHO3" method="POST" class="form-horizontal" role="form" >
               {!! csrf_field() !!}
               <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-8">
                     <button type="submit" class="btn btn-default">Clear</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
