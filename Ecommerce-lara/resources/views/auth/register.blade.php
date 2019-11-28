 @extends('layouts.app')

@section('register')

<div class="register-box">
     <h1>Register</h1>
     <form  method="POST" action="{{ route('register') }}"> 
        @csrf
        <div class="form-group">
             <!-- <i class="fa fa-user" aria-hidden="true"></i> -->
             <label for="name">Username</label>
             <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}">
             @if($errors->has('name'))
              <strong>{{$errors->first('name')}}</strong>
             @endif
         </div>
         <div class="form-group">
             <!-- <i class="fa fa-envelope-square" aria-hidden="true"></i> -->
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
             <!-- <i class="fa fa-lock" aria-hidden="true"></i> -->
             <label for="password-confirm">Confirm Password</label>
             <input type="password" class="form-control" name="password_confirmation" id="password-confirm" placeholder="Confirm Password">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-warning btn-block" value="Log in" name="">
        </div> 
     </form>

 </div>
@endsection

 