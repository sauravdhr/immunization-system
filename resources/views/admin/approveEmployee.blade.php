

@extends('layout.admin')
@section('content')
<div class="col-lg-12 text-center">
   <div class="container">
      <div class="row">
         <div class="col-sm-1 col-md-6 col-md-offset-3">
            <h2>
               Approve Employees
            </h2>
            <h2 class = "brand-after">
               <small> Select Employees </small>
            </h2>
            <hr class="tagline-divider">
            <p>
            </p>
            @if ($temp[0]!=null)
            <div class="table-responsive">
               <table class="table">
                  <tr style="color:White;background-color:#507CD1;font-weight:bold;">
                     <th scope="col">&nbsp;</th>
                     <th scope="col">Employee ID</th>
                     <th scope="col">First Name</th>
                     <th scope="col">Last Name</th>
                     <th scope="col">Designation</th>
                     @foreach ($temp[0] as $line)
                  <tr >
                     <td><a href="approveEmployee/{{ $line->emp_no }}" style="color:blue">Select</a></td>
                     <td>{{ $line->id}}</td>
                     <td>{{ $line->first_name}}</td>
                     <td>{{ $line->last_name }}</td>
                     <td>{{ $line->designation }}</td>
                  </tr>
                  @endforeach
               </table>
               <hr class="tagline-divider">
               <p></p>
               @endif
               @if ($temp[0]==null)
               <h2>
                  There are no employees to approve
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

