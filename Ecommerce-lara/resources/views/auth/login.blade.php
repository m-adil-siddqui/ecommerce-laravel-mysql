@extends('layouts.app')
@section('register')
 <div class="register-box">
     <h1>Login</h1>
     <form  method="POST" action="{{ route('login') }}"> 
        @csrf
         <div class="text-box">
             <!-- <i class="fa fa-user" aria-hidden="true"></i> -->
             <label for="email">Email</label>
             <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
             @if($errors->has('email'))
              <strong>{{$errors->first('email')}}</strong>
             @endif
         </div>
         <div class="form-group">
            <!-- <i class="fa fa-lock" aria-hidden="true"></i> -->
            <label for="password">Password</label>
             <input type="password" class="form-control" name="password" id="password" placeholder="Password">
             @if($errors->has('password'))
               <strong>{{$errors->first('password')}}</strong>
              @endif
         </div>
         <div class="form-group">
            <input type="submit" class="btn btn-warning btn-block" value="Log in" name="">
         </div>
     </form>
    
 </div>
 

@endsection