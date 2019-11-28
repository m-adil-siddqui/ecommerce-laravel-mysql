@extends('admin.app')
@section('breadcrubms')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
<li class="breadcrumb-item active" aria-current="page">Category</li>
@if (session()->has('message'))
   &nbsp;&nbsp;&nbsp;&nbsp;<p id="msg" style="color: green;">{{session('message')}}</p>
@endif
@endsection
@section('content')
<div class="row">
<div class="col-md-10"><h2>Categories</h2></div>
<div class="col-md-2">
       <a href="{{route('admin.category.create')}}" class="btn btn-sm btn-outline-secondary">Add Category</a>	          
</div>
</div>
<div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Slug</th>
                  <th>Categories</th>
                  <th>Date Created</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	@if($categories)
              	@foreach($categories as $key => $c)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$c->title}}</td>
                  <td>{!! substr($c->description,0,15) !!}</td>
                  <td>{{$c->slug}}</td>
                  <td>
                  	 @if($c->childrens()->count() > 0)
                       @foreach($c->childrens as $children)
                         {{$children->title}},
                       @endforeach
                     @else
                      {{"Parent Category"}}
                  	 @endif
                  </td>
                  @if($c->trashed())
                   <td>{{$c->deleted_at}}</td>
                   <td><a href="{{route('admin.category.recover',$c->id)}}" class="btn btn-info btn-sm" >Restore</a> |
                    <a href="{{url('admin/cat',$c->id)}}" class="btn btn-danger btn-sm" >Delete</a>
                   <!-- <form class="" action="{{url('admin/category/trash')}}" id="category-delete-{{$c->id}}" method="post" style="display: none;">
                   	<input type="hidden" name="tid" value="{{$c->id}}">                  	
                  	
                  	@csrf
                   </form> -->
                   </td>
                  @else 
                  <td>{{$c->created_at}}</td>
                  <td><a href="{{route('admin.category.edit',$c->id)}}"  class="btn btn-info btn-sm">Edit</a> | <a href="{{route('admin.category.remove',$c->id)}}" class="btn btn-sm btn-warning" id="trash-category-{{$c->id}}">Trash</a> |
                  <a href="javascript:;" onclick="confirmDelete('{{$c->id}}')" class="btn btn-danger btn-sm">Delete</a>
                  <form method="post" id="category-delete-{{$c->id}}" style="display: none;" action="{{route('admin.category.destroy',$c->id)}}">
                  	
                  	@method('DELETE')
                  	@csrf
                  </form>
                  </td>
                  @endif
                </tr>
                @endforeach
                @else
                 <tr><td colspan="5"><h3>Category Not Found...</h3></td></tr>
                @endif
              </tbody>
            </table>
          </div>
          <div class="row">
          	<div class="col-md-12" style="margin-top: 1em;">
          		{{$categories->links()}}
          	</div>
          </div>
@endsection
@section('script')
<script type="text/javascript">
	function confirmDelete(id){
		let choice = confirm("Are You sure? You want to delete!!");
		if(choice){
			document.getElementById('category-delete-'+id).submit();  
		}
	}
	$("#msg").fadeOut(6000);
</script>

@endsection


