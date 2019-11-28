@extends('layouts.app')
@section('show-all')

<div class="row">
@foreach($products as $p)
	<div class="col-md-3">
      <div class="card show-all-desc">
       <img src="{{asset('storage/app/public/'.$p->thumbnail)}}" class="card-img-top" alt="...">
       <div class="card-body">
        <div class="card-text">
         <center>
          <div class="pro-view"><a href="{{route('products.single',$p->id)}}">View Product</a></div>
          <p>{{$p->title}}</p>
          <p><strong>${{$p->price}}.00</strong></p>
          <a href="{{route('products.addToCart',$p->id)}}" class="btn btn-warning btn-xs">Add to Cart</a>
          
        </center>
    </div>
    </div>
  </div>
	</div>
	 
@endforeach

</div>









@endsection