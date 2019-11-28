@extends('admin.app')
@section('breadcrubms')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Category</a></li>
<li class="breadcrumb-item active" aria-current="page">Add/Edit Category</li>
@endsection
@section('content')

<form action="@if(isset($category)) {{route('admin.category.update',$category->id)}} @else {{route('admin.category.store')}} @endif" method="post" accept-charset="utf-8">
	@csrf
	@if(isset($category))
     @method('PUT')
	@endif
 <div class="form-group">
  	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session()->has('message'))
    <div class="alert alert-success">{{session('message')}}</div>
    @endif

    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" id="txturl" placeholder="Enter title" value="{{@$category->title}}">
    <p class="small">{{config('app.url')}}/{{@$category->slug}}<span id="url"></span></p>
    <input type="hidden" name="slug" id="slug" value="{{@$category->slug}}">
  </div>
  
  
  <div class="form-group">
    <label for="editor">Description</label>
    <textarea class="form-control" name="description" id="editor" rows="20" cols="80">{!! @$category->description !!}</textarea>
  </div>
<div class="form-group">
	@php
    $ids =  (isset($category->childrens) && $category->childrens->count() > 0) ? array_pluck($category->childrens, 'id') : null
	@endphp

    <label for="parent_id">Select Category</label><br>
    <select class="form-control" id="parent_id"  name="parent_id[]" multiple>
      @if(isset($categories))
      <option value="0">Top Level</option>	
         @foreach($categories as $c)
         <option value="{{$c->id}}" @if(!is_null($ids) && in_array($c->id, $ids)){{'selected'}} @endif>{{$c->title}}</option>
         @endforeach
      @endif
      option
    </select>
  </div>

  <div class="form-group">
  	@if(isset($category))
  	<input type="submit" name="submit" class="btn btn-primary" value="Update Category">
  	@else
  	<input type="submit" name="submit" class="btn btn-primary" value="Add Category">
  	@endif

  </div>


</form>


@endsection
@section('script')

<script type="text/javascript">

$(function(){
	function slugify(text){
		return text.toString().toLowerCase() 
		  .replace(/\s+/g, '-') //replace spaces with -
	    .replace(/[^\w\-]+/g, '') //remove all non-word
	    .replace(/\-\-+/g, '-') // replace multiple - with -
	    .replace(/^-+/, '')  //Trim - from all the text
	    .replace(/-+$/, '');  // Trim -from end of the text
	}
	ClassicEditor.create(document.querySelector('#editor'),{
		toolbar:['heading', 'Link', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
	}).then(editor => {
		console.log(editor);
	}).catch(error => {
		console.error(error);
	});



   $("#txturl").on('keyup', function(){
   	var url = slugify($(this).val());
   	$("#url").html(url);
   	$("#slug").val(url);
   });


   $('#parent_id').select2({
    placeholder: 'Select a Parent Cateogry',
    allowClear: true,
    minimumResultsForSearch: Infinity 
    });
   
   $(".alert-success").fadeOut(6000);	
})



</script>

@endsection


