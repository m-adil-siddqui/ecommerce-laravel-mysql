@extends('admin.app')
@section('breadcrubms')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
<li class="breadcrumb-item active" aria-current="page">Product</li>

@endsection
@section('content')
<div class="row">
	<div class="col-md-10"><h2>Products</h2></div>
	<div class="col-md-2">
	       <a href="{{route('admin.product.create')}}" class="btn btn-sm btn-outline-secondary">Add Product</a>	          
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
                  <th>Price</th>
                  <th>Thumbnail</th>
                  <th>Date Created</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	@if($products)
              	@foreach($products as $key => $p)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$p->title}}</td>
                  <td>{!! substr($p->description,0,15) !!}</td>
                  <td>{{$p->slug}}</td>
                  <td>
                  	 @if($p->categories()->count() > 0)
                       @foreach($p->categories as $category)
                         {{$category->title}},
                       @endforeach
                     @else
                      <strong>{{"Product"}}</strong>
                  	 @endif
                  </td>
                  <td>${{$p->price}}</td>
                  <td><img src="{{asset('storage/app/public/'.$p->thumbnail)}}" width="70" height="70"></td>
                  @if($p->trashed())
                   <td>{{$p->deleted_at}}</td>
                   <td><a href="{{route('admin.product.recover',$p->id)}}" class="btn btn-info btn-sm" >Restore</a> |
                    <a href="{{url('admin/pro',$p->id)}}" class="btn btn-danger btn-sm" >Delete</a>

                   </td>
                  @else 
                  <td>{{$p->created_at}}</td>
                  <td><a href="{{route('admin.product.edit',$p->id)}}"  class="btn btn-info btn-sm">Edit</a> | <a href="{{route('admin.product.remove',$p)}}" class="btn btn-sm btn-warning" id="trash-product-{{$p->id}}">Trash</a> |
                  <a href="javascript:;" onclick="confirmDelete('{{$p->id}}')" class="btn btn-danger btn-sm">Delete</a>
                  <form method="post" id="product-delete-{{$p->id}}" style="display: none;" action="{{route('admin.product.destroy',$p)}}">
                  	
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
          	<div class="col-md-12">
          		{{$products->links()}}
          	</div>
          </div>
@endsection
@section('script')
<script type="text/javascript">
	function confirmDelete(id){
		let choice = confirm("Are You sure? You want to delete!!");
		if(choice){
			document.getElementById('product-delete-'+id).submit();  
		}
	}
	$("#msg").fadeOut(6000);
</script>

@endsection


