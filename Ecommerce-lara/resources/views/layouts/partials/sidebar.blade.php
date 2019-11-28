
<div class="fornt-side">
<div class="sidebar-cat">
  <ul>
    <li><a href="{{url('products/category/Fashion')}}"><i class="fa fa-angle-right"></i> Fashion</a></li>
    <li><a href="{{url('products/category/Watches')}}"><i class="fa fa-angle-right"></i> Watches</a></li>
    <li><a href="{{url('products/category/Jewelry')}}"><i class="fa fa-angle-right"></i> Fine Jewelry</a></li>
    <li><a href="{{url('products/category/shirt')}}"><i class="fa fa-angle-right"></i> T-shirts</a></li>
    <li><a href="{{url('products/category/Jeans')}}"><i class="fa fa-angle-right"></i> Men's & Women Jeans</a></li>
    <li><a href="{{url('products/category/Mobiles')}}"><i class="fa fa-angle-right"></i> Electronics</a></li>
    <li><a href="#"><i class="fa fa-angle-right"></i> Vintage & Antique</a></li>
    <li><a href="#"><i class="fa fa-angle-right"></i> Loose Diamonds</a></li>
    <li><a href="{{url('products-all')}}"><i class="fa fa-angle-right"></i> See All Products</a></li>
  </ul>
</div>

<div class="sidebar-disc">
  <h3>50% Discount</h3>
  <p>only valid for online order.</p>
  <p><a href="#" class="btn btn-info btn-sm">Click Here</a></p>
</div>

<div class="sidebar-pay">
  <img src="{{asset('public/images/paypal.jpg')}}">
</div>

@foreach($latests as $l)
<div class="sidebar-single-pro">
  <div class="card">
    <div class="card-body">
      <img src="{{asset('storage/app/public/'.$l->thumbnail)}}">
      <div class="card-text">
        <ul class="single-pro-desc">
          <li><a href="{{route('products.single',$l)}}" class="btn btn-info btn-sm">View</a></li>
          <li><strong>$22.00</strong></li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endforeach


</div>

