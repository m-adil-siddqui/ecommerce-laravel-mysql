@extends('admin.app')
@section('breadcrubms')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">Products</a></li>
<li class="breadcrumb-item active" aria-current="page">Add / Edit Product</li>
@endsection
@section('content')
@if(session()->has('message'))
 <p class="alert alert-success">{{session('message')}}</p>
 @endif
<form accept-charset="utf8" action=
"@if(isset($product)){{route('admin.product.update', $product)}}@else {{route('admin.product.store')}} @endif"
 method="post" enctype="multipart/form-data">
	@csrf
	@if(isset($product))
	 @method('PUT')
	@endif
	<div class="row">
		<div class="col-lg-9">
			@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		    @endif
			<div class="form-group row">
				<div class="col-lg-12">
					<label class="form-control-label">Title:</label>
					<input type="text" id="title" name="title" class="form-control" value="{{@$product->title}}">
					<p class="small">{{config('app.url')}}/<span id="url">{{@$product->slug}}</span>
                    <input type="hidden" name="slug" id="slug"  value="{{@$product->slug}}">
					</p>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-lg-12">
					<label class="form-control-label">Description:</label>
					<textarea class="form-control" name="description" cols="20" id="editor" rows="5">{{@$product->description}}</textarea>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-6">
					<label class="form-control-label">Price:</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">$</span>
						</div>
						<input type="text" name="price" value="{{@$product->price}}" class="form-control" placeholder="0.00">
					</div>
				</div>
				<div class="col-6">
					<label class="form-control-label">Discount:</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">$</span>
						</div>
						<input type="text" name="discount_price" class="form-control" placeholder="0.00">
					</div>
				</div>
			</div>

			<div class="form-group row">
				<div class="card col-sm-12 p-0 mb-2">
					<div class="card-header align-items-center">
						<h5 class="card-title float-left">Extra options:</h5>
						<div class="float-right">
							<button type="button" class="btn btn-primary btn-sm" id="add-btn">+</button>
							<button type="button" class="btn btn-danger btn-sm" id="remove-btn">-</button>
						</div>
					</div>
					<div class="card-body" id="extras">
						<!-- <div class="row align-items-center options">
							<div class="col-sm-4">
								<label class="form-control-label">Option<span class="count">1</span></label>
								<input type="text" name="extra[option][]" class="form-control" placeholder="size">
							</div>
							<div class="col-sm-8">
								<label class="form-control-label">Values</label>
								<input type="text" name="extra[values][]" class="form-control" placeholder="options1 | option2 | option3" />
								<label class="form-control-label">Additional Prices</label>
								<input type="text" name="extra[prices][]" class="form-control" placeholder="price1 | price2 | price3" />
							</div>
						</div> -->
					</div>
				</div>
			</div>

		</div>
		<div class="col-lg-3">
			<ul class="list-group row">
				<li class="list-group-item active"><h5>Status</h5></li>
				<li class="list-group-item">
					<div class="form-group row">
						<select class="form-control" name="status">
							<option value="1" @if(@$product->status == 1) {{'selected'}} @endif>pending</option>
							<option value="2" @if(@$product->status == 2) {{'selected'}} @endif>publish</option>
						</select>
					</div>
					<div class="form-group row">
						<div class="col-lg-12">
							@if(isset($product))
							<input type="submit" name="submit" value="Update Product" class="btn btn-primary btn-block">
                             @else
							<input type="submit" name="submit" value="Add Product" class="btn btn-primary btn-block">
							@endif
						</div>
					</div>
				</li>
				<li class="list-group-item active"><h5>Feaured Image</h5></li>
				<li class="list-group-item">
					<div class="input-group mb-3">
						<div class="custom-file">
							<input type="file" name="thumbnail" class="custom-file-input" id="thumbnail">
							<label class="custom-file-label" for="thumbnail">Choose File</label>
						</div>
					</div>
					<div class="img-thumbnail  text-center">
					<img src="@if(isset($product)) {{asset('storage/app/public/'.$product->thumbnail)}} @else  {{asset('public/images/no-img.gif')}} @endif" id="imgthumbnail" class="img-fluid" alt="">
				</div>
				</li>
				<li class="list-group-item">
				 <div class="col-12">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text"><input id="featured" type="checkbox" name="featured" value=
								"@if(isset($product)) {{@$product->featured}} @else{{0}} @endif"
								 @if(@$product->featured == 1) {{'checked'}} @endif /></span>
						</div>
						<p type="text" class="form-control" name="featured" placeholder="0.00" aria-label="featured" aria-describedby="featured" >Featured Product</p>
					</div>
				 </div>
			   </li>
			   @php
                $ids = (isset($product) && $product->categories->count() > 0)?
                array_pluck($product->categories->toArray(), 'id') : null;
                
			   @endphp
			   <li class="list-group-item active"><h5>Select Categories</h5></li>
			   <li class="list-group-item ">
				<select name="category_id[]" id="select2" class="form-control" multiple>
					@if($categories->count() > 0)
					 @foreach($categories as $c)
					   <option value="{{$c->id}}"
                        @if(!is_null($ids) && in_array($c->id, $ids))
                          {{'selected'}}
                        @endif 
					   	>{{$c->title}}</option>	
					  @endforeach
					@endif  			
				</select>
		       </li>
			</ul>
		</div>
	</div>
</form>

@endsection
@section('script')
<script type="text/javascript">
	$(function(){
       
        $('#thumbnail').on('change', function(){
        	var file = $(this).get(0).files;
        	var reader = new FileReader();
        	reader.readAsDataURL(file[0]);
        	reader.addEventListener("load", function(e){
        		var img = e.target.result;
        		$("#imgthumbnail").attr('src', img);
        	});
        });
      
      

		$("#add-btn").on('click',function(e){
			var count = $('.options').length+1;
			//alert(count);
			$('#extras').append('<div class="row align-items-center options">\
						<div class="col-sm-4">\
						<label class="form-control-label">Option <span>'+count+'</span></label>\
						<input type="text" name="extra[\'option\'][]" class="form-control" value="" placeholder="size">\
						</div>\
						<div class="col-sm-8">\
						<label class="form-control-label">Values</label>\
						<input type="text" name="extra[\'values\'][]" class="form-control" placeholder="options1 | option2 | option3" />\
						<label class="form-control-label">Additional Prices</label>\
						<input type="text" name="extra[\'prices\'][]" class="form-control" placeholder="price1 | price2 | price3" />\
						</div>\
					</div>');
		})

		$("#remove-btn").on('click', function(e){
			if($('.options').length > 1){
				$('.options:last').remove();
			}
		});

		ClassicEditor.create(document.querySelector("#editor"),{
			toolbar:['heading', 'bold', 'Link', 'italic', 'bulletedList', 'numberedList', 'undo', 'redo', 'blockQuote'],
		}).then(editor => {
			console.log(editor);
		}).catch(error => {
			console.log(error);
		})



		$("#select2").select2({
			placeholder: 'Select category',
			allowClear: true,
			minimumResultsForSearch: Infinity
		});

		function slugify(text){
			return text.toString().toLowerCase()
			.replace(/\s+/g, '-')
			.replace(/[^\w\-]+/g, '')
			.replace(/\-\-+/g, '-')
			.replace(/^-+/, '')
			.replace(/-+$/, '');
		}
    
        @php
        if(!isset($product)){ 
        @endphp
        $("#title").on('keyup', function(){
        	var text = slugify($(this).val());
            $("#url").html(text);
            $("#slug").val(text);
        })   
        @php
        }
        @endphp
        $('#featured').on('change', function(){
        	if($(this).is(':checked')){
        		$(this).val(1);
        	}
        	else{
        		$(this).val(0)
        	}
        })

	})
</script>


@endsection