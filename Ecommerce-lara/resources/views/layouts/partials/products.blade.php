 

<div class="all-products">
  <div class="card card-set">
    <div class="card-header">
    <h4 class="pro-heading">New Products</h4>
    </div>
  </div>
  <div class="new-pro1">
    <div class="owl-carousel owl-theme">
    
      @foreach($products as $p)
      <div class="card">
      <div class="card-body">
        <img src="{{asset('storage/app/public/'.$p->thumbnail)}}" style="height: 180px;">
      </div>
      </div>
      @endforeach
    
  </div>
  </div>

  <div class="new-pro">
    <ul>
    @foreach($latests as $l)
    <li>
   
    <div class="card" id="show-pro-desc">
     <img src="{{asset('storage/app/public/'.$l->thumbnail)}}" class="card-img-top" alt="...">
     <div class="card-body">
      <div class="card-text">
        <center>
          <div class="pro-view"><a href="{{route('products.single',$l->id)}}">View Product</a></div>
          <p>{{$l->title}}</p>
          <p><strong>${{$l->price}}.00</strong></p>
          <a href="{{route('products.addToCart',$l->id)}}" class="btn btn-warning btn-xs" style="background: #f89406; border: 1px solid #f89406;">Add to Cart</a>
          
        </center>
    </div>
    </div>
  </div>
  </li>
   @endforeach 
  </ul>
  </div>
</div>  

<div class="all-products featured-pro">
  <div class="card card-set">
    <div class="card-header">
     <div class="feature-header"> 
      <div style="float: left;"><h4 class="pro-heading">Featured Products</h4></div>
      <div style="float:right;"><a href="" class="btn btn-info btn-sm all-pro">View More</a></div>
        
    </div>
    </div>
  </div>
 

  <div class="new-pro">
    <ul>
    @foreach($all as $a)
    <li>
    <div class="card" style="">
     <img src="{{asset('storage/app/public/'.$a->thumbnail)}}" class="card-img-top" alt="...">
     <div class="card-body">
      <div class="card-text">
        <center>
          <div class="pro-view"><a href="{{route('products.single',$a->id)}}">View Product</a></div>
          <p>{{$a->title}}</p>
       
        <div class="pro-desc">  
          <ul>
            <li><a href="{{route('products.single',$a->id)}}" style="color: #000"><i class="fa fa-search-plus"></i></a></li>
            <li><strong>${{$a->price}}.00</strong></li>
            <li><a href="{{route('products.addToCart',$a->id)}}" class="btn btn-warning btn-xs" style="background: #f89406; border: 1px solid #f89406;">Add to Cart</a></li>
          </ul>
        </div>
         </center>
    </div>
    </div>
  </div>
  </li>
   @endforeach 
  </ul>
  </div>
</div> 












