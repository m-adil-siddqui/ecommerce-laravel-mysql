@extends('admin.app')
@section('breadcrubms')
  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
 <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.profile.index')}}">Users</a></li>
 <li class="breadcrumb-item active" aria-current="page">Update user</li>
@endsection
@section('content')
  <div class="row d-block">
    <div class="col-sm-12">
      @if (session()->has('message'))
      <div class="alert alert-success">
        {{session('message')}}
      </div>
      @endif
    </div>
  </div>
  @section('content')
<form action="{{route('admin.profile.update',$profile)}}" method="post" accept-charset="utf8" enctype="multipart/form-data">
	@csrf
	 @method('PUT')
	<div class="row">
		<div class="col-lg-8">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label id="username">Username</label>
						<input type="text" name="name" value="{{$profile->name}}" id="txturl" class="form-control" placeholder="Username">
						<input type="hidden" name="id" value="{{$profile->id}}">
						<input type="hidden" name="slug" value="{{$profile->slug}}">
						
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label id="email">Email</label>
						
						<input type="text" id="email" value="{{$user->email}}" name="email" class="form-control" placeholder="Email">
						
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label id="password">Password</label>
						<input type="password" id="password" name="password" class="form-control" placeholder="Password">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label id="re-password">Re-type Password</label>
						<input type="password" id="re-password" name="password_confirm" class="form-control" placeholder="Re-type Password">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
				<div class="form-group">
				<label id="status">Status</label>
				<select name="status" class="form-control">
					<option value="">Status</option>
					<option value="0" @if($user->status == 0){{'selected'}} @endif>Blocked</option>
					<option value="1" @if($user->status == 1){{'selected'}} @endif>Active</option>
				</select>
			</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
					
				<label id="role">Role</label>
				<select name="role" class="form-control">
					<option>Select Role</option>
					
					<option value="1" @if($user->role->id == 2)  {{'selected'}} @endif>Admin</option>
					<option value="2" @if($user->role->id == 1)  {{'selected'}} @endif>Customer</option>
					
				</select>
			</div>
				</div>
			</div>
			<div class="form-group">
				<label id="address">Address</label>
				<input type="text" id="address" value="{{$profile->address}}" name="address" class="form-control" value="">
			</div>
			<div class="row">
				<div class="col-md-3">
				<label id="country">Country</label>
					<!--  -->

				<select name="country_id" class="form-control" id="countries">
					<option value="0">Select a Country</option>
					
					<option value="{{$profile->country->id}}" selected >{{$profile->country->name}}</option>
				
				</select>
				</div>
				<div class="col-md-3">
				<label id="state">State</label>
				<select name="state_id" class="form-control" id="states">
					<option value="0">Select a State</option>
					<option value="{{$profile->state->id}}">{{$profile->state->name}}</option>
				</select>
				</div>
				<div class="col-md-3">
				<label id="city">City</label>
				<select name="city_id" class="form-control" id="cities">
					<option value="{{$profile->city->id}}">{{$profile->city->name}}</option>
				</select>
				</div>
				<div class="col-md-3">
				<label id="country">Phone No</label>
				<input type="text" name="phone" value="{{$profile->phone}}" class="form-control">
				</div>
			</div>
		</div>
		<div class=" col-lg-3">
			<ul class="list-group row">
				<li class="list-group-item active"><h5>Profile Image</h5></li>
				<li class="list-group-item">
					<div class="input-group mb-3">
						<div class="custom-file">
							<input type="file" name="thumbnail" class="custom-file-input" id="thumbnail">
							<label class="custom-file-label">Choose file</label>
						</div>
					</div>
					<div class="img-thumnail text-center">
						<img src="@if(isset($profile)){{asset('storage/app/public/'.$profile->thumbnail)}} @else {{asset('public/images/no-img.gif')}} @endif" id="imgthumbnail" class="img-fluid" alt="">
						
					</div>
				</li>
				<li class="list-group-item">
					<div class="form-group row">
						<div class="col-md-12">
					      <input type="submit" value="Update" name="add" class="btn btn-success btn-block">
				     	</div>
					</div>
				</li>
			</ul>
		</div>	
	</div>
	
</form>  



@endsection
@section('script')
<script type="text/javascript">

 //file uploaded

   $("#thumbnail").on('change', function(){
   	  var file = $(this).get(0).files;
   	  var reader = new FileReader();
   	  reader.readAsDataURL(file[0]);
   	  reader.addEventListener('load', function(e){
   	  	var img = e.target.result;
   	  	$("#imgthumbnail").attr('src', img);
   	  })
   }) 

// select2
	$("#countries").select2();
	$("#states").select2();
	$("#cities").select2();

// ON changed country

	$("#countries").on('change', function() {
		var id = $("#countries").select2('data')[0].id;
		$("#states").val(null);
		$("#states option").remove();
		var studentSelect = $('#states');
		
        $.ajax({
        type: 'GET',
        url: "{{route('admin.profile.state')}}/"+id
        }).then(function (data) {
        // create the option and append to Select2
        //console.log(data.length);
        for(i = 0; i < data.length; i++){
        	var item = data[i];
           var option = new Option(item.name, item.id, true, true);
           studentSelect.append(option);
        }
        studentSelect.trigger('change');
    });

    $("#states").on('change', function(){
    	var id = $("#states").select2('data')[0].id;
    	var cities = $("#cities");
    	$("#cities").val(null);
    	$("#cities option").remove();
    	$.ajax({
    		type: 'GET',
    		url: "{{route('admin.profile.city')}}/" + id
    	}).then(function(data){
    		for(i = 0; i < data.length; i++){
    			var item = data[i];
    			var option = new Option(item.name, item.id,true, true);
    			cities.append(option);
    		}
    	})
    })    


	})
</script>



@endsection
