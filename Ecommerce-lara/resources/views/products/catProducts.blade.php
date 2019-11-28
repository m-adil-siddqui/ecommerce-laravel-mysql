@extends('layouts.app')
@section('sidebar')
@include('layouts/partials/sidebar')
 
@endsection

@section('content')
<div class="all-products" style="height: auto !important;">
   <div class="new-pro" style="height: auto !important; padding-bottom: 1em;">
    <ul>
    @foreach($products as $p)
    <li>
   
    <div class="card" id="show-pro-desc" style="margin-bottom: .8em;">
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
  </li>
   @endforeach 
  </ul>
  </div>
</div>
  
 
@endsection


