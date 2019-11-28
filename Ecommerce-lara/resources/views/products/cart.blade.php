@extends('layouts.app')
 
@section('cart')
<div class="bred">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('all')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Cart</li>
  </ol>
</nav>
</div>
<div class="cart-desc-pro">
<h2>Shopping Cart </h2>
<hr><br><br>
@if(isset($cart) && $cart->getContents())

<div class="card table-responsive">
   <table class="table table-hover shopping-cart-wrap">
   	 <thead class="text-muted">
   	 	<tr>
   	 		<th scope="col">Product-img</th>
            <th scope="col">Description</th>
   	 		<th scope="col">Price</th>
   	 		<th scope="col" width="200">Quantity</th>
   	 		<th scope="col">Action</th>
   	 	</tr>
   	 </thead>
   	 <tbody>
      
   	 	@foreach($cart->getContents() as $slug => $product)
   	 	<tr>
   	 		<td>
   	 			<figure class="media">
   	 				<div class="img-wrap">
   	 					<img src="{{asset('storage/app/public/'.$product['item']->thumbnail)}}" width="120" height="120" class="img-thumbnail img-sm">
   	 				</div>
            </td>
            <td>      
   	 				<figcaption class="media-body">
   	 					<h6 class="title text-truncate">{{$product['item']->title}}</h6>
   	 					<dl class="param param-inline small">
   	 						<dt>Size:</dt>
   	 						<dd>XXL</dd>
   	 					</dl>
   	 					<dl class="param param-inline small">
   	 						<dt>Color:</dt>
   	 						<dd>Orange Color</dd>
   	 					</dl>
   	 				</figcaption>
   	 			 
   	 		</td>
   	 		
 			<td>
				<div class="price-wrap">
					<span class="price">USD{{$product['price']}}</span>
					<small class="text-muted"><p>(USD {{$product['item']->price}} each)</p></small>
				</div> <!-- price-wrap .// -->
			</td>
         <td>
               <form action="{{route('cart.update',$product['item']->id)}}" method="POST" accept-charset="utf-8">
                  @csrf
                  <input type="number" name="qty" id="qty" value="{{$product['qty']}}" class="form-control text-center">
                  <input type="submit" name="update" value="Update" class="btn btn-block btn-outline-success btn-round btn-sm" style="margin-top: 5px;">
               </form>
            </td>
			<td>
				<form action="{{route('cart.remove',$product['item']->id)}}" method="POST" accept-charset="utf-8">
				@csrf

				<input type="submit" value="x Remove" class="btn btn-outline-danger btn-block btn-sm"/>
				</form>
			</td>
   	 	</tr>
   	 	@endforeach
   	 	<tr>
   	 		<th colspan="2">Total Qty:</th>
   	 		<td>{{$cart->getTotalQty()}}</td>
   	 	</tr>
   	 	<tr>
   	 		<th colspan="2">Total Price:</th>
   	 		<td>{{$cart->getTotalPrice()}}</td>
   	 	</tr>
         <tr>
            <td colspan="5" class="checkout-btn"><a href="{{route('checkout.index')}}" class=" btn btn-warning">Checkout</a></td>
         </tr>

         
   	 </tbody>
	
   </table>

</div>
@else
 <p class="alert alert-danger">No Products in Cart <a href="{{route('products.all')}}">Buy Some Products</a></p>
@endif

</div>






@endsection









