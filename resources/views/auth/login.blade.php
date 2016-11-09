@extends('layout.app')

@section('content')

<div class="col-lg-12 text-center">
                
                   <div class="container">
                      <div class="row">
                          <div class="col-sm-6 col-md-4 col-md-offset-4">
                              <h3 class="text-center login-title">Sign in to continue to Immunization management</h3>
                              <div class="account-wall">
                                  
                                  <form action="/auth/login" method="POST" class="form-signin">
                                  {!! csrf_field() !!}                                 
                                  <input type="text" name="id" class="form-control" placeholder="ID" required autofocus>
								  <p></p>
                                  <input type="password" name="password" class="form-control" placeholder="Password" required>
                                  <p></p>
								  <button class="btn btn-lg btn-primary btn-block" type="submit">
                                      Sign in</button>
                                 
                                 
                                  </form>
								  <p></p>
                              </div>
                              <a href="{{ URL::to('signup') }}" class="text-center new-account">Create an account </a>
                          </div>
                      </div>
                    </div>


@endsection