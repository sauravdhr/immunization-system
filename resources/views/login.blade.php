@extends('layout.app')
@section('content')
<div class="col-lg-12 text-center">
<div class="container">
   <div class="row">
      <div class="col-sm-6 col-md-4 col-md-offset-4">
         <h3 class="text-center login-title">Sign in to continue to IMS</h3>
         <div class="account-wall">
            @if ($errors->has())
            <div class="alert alert-danger">
               @foreach ($errors->all() as $error)
               {{ $error }}<br>        
               @endforeach
            </div>
            @endif
            <form action="/login" method="POST" class="form-signin">
               {!! csrf_field() !!}                                 
               <input type="text" name="id" class="form-control" placeholder="ID"  required autofocus>
               <p></p>
               <input type="password" name="password" class="form-control" placeholder="Password" required>
               <p></p>
               <button class="btn btn-lg btn-primary btn-block" type="submit">
               Sign in</button>
            </form>
            <p></p>
         </div>
         <p>
         </p>
         <a href="{{ URL::to('login2') }}" class="text-center new-account">Login as an employee </a>
      </div>
   </div>
</div>
@endsection
