@extends('admin.app')
@section('breadcrubms')
  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
 <li class="breadcrumb-item active" aria-current="page">users</li>
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
<form action="{{route('admin.profile.store')}}" method="post" accept-charset="utf8" enctype="multipart/form-data">
	@csrf
	
	<div class="row">
		<div class="col-lg-8">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label id="username">Username</label>
						<input type="text" name="name" id="txturl" class="form-control" placeholder="Username">
						<p class="small">{{config('app.url')}}/<span id="url"></span></p>
						<input type="hidden" name="slug" id="slug">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label id="email">Email</label>
						<input type="text" id="email" name="email" class="form-control" placeholder="Email">
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
					<option value="0">Blocked</option>
					<option value="1">Active</option>
				</select>
			</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
				<label id="role">Role</label>
				<select name="role" class="form-control">
					<option>Select Role</option>
					<option value="2">Admin</option>
					<option value="1">Customer</option>	
				</select>
			</div>
				</div>
			</div>
			<div class="form-group">
				<label id="address">Address</label>
				<input type="text" id="address" name="address" class="form-control" value="">
			</div>
			<div class="row">
				<div class="col-md-3">
				<label id="country">Country</label>
				<select name="country_id" class="form-control" id="countries">
					<option value="0">Select a Country</option>
					@foreach($countries as $country)
					<option value="{{$country->id}}">{{$country->name}}</option>
					@endforeach
				</select>
				</div>
				<div class="col-md-3">
				<label id="state">State</label>
				<select name="state_id" class="form-control" id="states">
					<option value="0">Select a State</option>
				</select>
				</div>
				<div class="col-md-3">
				<label id="city">City</label>
				<select name="city_id" class="form-control" id="cities">
					<option></option>
				</select>
				</div>
				<div class="col-md-3">
				<label id="country">Phone No</label>
				<input type="text" name="phone" class="form-control">
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
						<img src="@if(isset($user)) {{asset('storage/'.$user->thumbnail)}} @else {{asset('public/images/no-img.gif')}} @endif" id="imgthumbnail" class="img-fluid" alt="">
					</div>
				</li>
				<li class="list-group-item">
					<div class="form-group row">
						<div class="col-md-12">
					      <input type="submit" name="add" class="btn btn-success btn-block">
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
 //// slug

  function slugify(text){
  	return text.toString().toLowerCase()
  	.replace(/\s+/g, '-')
  	.replace(/[^\w\-]+/g, '')
  	.replace(/^-+/,'')
  	.replace(/-+$/,'')
  	.replace(/\-\-+/g,'-');
  }
  $("#txturl").on('keyup', function(){
  	var url = slugify($(this).val());
  	$("#url").html(url);
  	$("#slug").val(url);
  })


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
