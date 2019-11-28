@extends('layouts.app')
@section('sidebar')
@include('layouts/partials/sidebar')
 
@endsection
@section('content')
  <!-- <div class="album py-5 bg-light"> -->
       <!--  <div class="container"> -->
       <!--  <div style="margin-top: 15px;"></div> -->
        <div class="single-pro">
          <div class="row"> 
            <div class="col-md-12"> 
              <div class="mb-4">
              	 <div class="row">
              	 	<div class="col-md-4">
              	 		<img class="img-thumbnail"  src="{{asset('storage/app/public/'.$product->thumbnail)}}">
              	 	</div>
              	 	<div class="col-md-8">
              	 	  <h4 class="card-title">{{$product->title}}</h4>
                      <p class="card-text">{!! $product->description !!}</p>
                      <div class="d-block justify-content-between align-items-center">
                       <div class="btn-group">
                      <a type="button" class="btn btn-sm btn-primary" href="{{route('products.addToCart',$product)}}">Add to Cart</a>
                    </div>
                      <p class="text-muted">9 mins</p>
                      </div>
                     <p style="margin-top: 15px;"><span>Price:</span> ${{$product->price}} &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>Discount: </span> ${{$product->discount}}</p>
              	 	</div>
              	 </div>
                
                
              </div>
            </div>
           <!--  <p style="border:1px solid #eee; width: 100%;"></p> -->
            <div class="col-md-12">
              <h4 class="re-pro-heading">Related Products</h4>
            
            @foreach($products as $p)
             <p style="border:1px solid #eee; width: 100%;"></p>
            <div class="row">
              <div class="col-md-3">
                <div class="single-pro-img">
                  
                    <img class="fluid-img" src="{{asset('storage/app/public/'.$p->thumbnail)}}">
                  
                </div>
              </div>
              <div class="col-md-6">
                <div class="single-pro-desc-left">
                  <h5>{{$p->title}}</h5>
                 <!--  <p>{!! str_limit($p->description, 20, '&raquo;') !!}</p> -->
                  <p>{!! str_limit($p->description) !!}</p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="single-pro-desc-left">
                  <p><strong>Rs{{$p->price}}</strong></p>
                  <p>Discount Rs{{$p->discount}}</p>
                  <a href="{{route('products.addToCart',$p->id)}}" class="btn btn-info">Add to Cart</a>
                  <a href="{{route('products.single',$p->id)}}" class="btn btn-warning">View</a>
                </div>
              </div>

            </div><!---/row--->
           
          @endforeach
           </div>
        </div>
</div>





@endsection


