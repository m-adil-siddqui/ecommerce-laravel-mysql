<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('public/js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('node_modules/owl.carousel/dist/assets/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('node_modules/owl.carousel/dist/assets/owl.theme.default.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/style.css')}}">
    @yield('admin_css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel fixed-top top-nav">
            <div class="container">
                <div class="social-icons">
                  <ul>
                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>

                  </ul>
                 
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                  <i class="fa fa-lock"></i> {{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-edit"></i> {{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->email }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="color: #000 !important;">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        <li class="nav-item">
                          <a href="{{route('contactus.index')}}" class="nav-link"><i class="fa fa-envelope"></i> Contact us</a>
                        </li>
                        <li class="nav-item cart-set @if(request()->url() == route('cart.all')) {{'nav-active'}} @endif {{''}}
                        "><a href="{{route('cart.all')}}" class="nav-link"><i class="fa fa-shopping-cart"></i>
                          {{Session::has('cart') ? Session::get('cart')->getTotalQty() :'0'}}
                        item(s)</a></li>
                    </ul>
                </div>
            </div>
        </nav>
 
 <div style="margin-top:1em;"></div>     
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div id="navbar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav add-nav-active">
              <li class="nav-item  @if(request()->url() == 'http://localhost/Ecommerce-lara' || request()->url() == 'http://localhost/Ecommerce-lara/products') {{'nav-active'}} @endif">
                <a class="nav-link"  href="{{route('products.all')}}">Home</a>
              </li>
               
              @foreach($categories as $key => $c) 
              <li class="nav-item">
                <a class="nav-link" href="{{url('cote/'.$c->id)}}">{{$c->title}}</a>
              </li>
              @endforeach
              <li class="nav-item search-bar">
                <div class="search-box">
                  <form method="get" action="{{url('products/search')}}">
                    @csrf
                    <input type="text" name="search" placeholder="search products">
                    <button type="submit"><i class="fas fa-search"></i></button>
                  </form>
                </div>
              </li>
            </ul>
          </div>
        </nav>
        </div>
      </div>
      <div class="col-md-12">
         @if(session()->has('message'))
        <p class="alert alert-success" style="margin-left: 25px;">{{session()->get('message')}}</p>
        @endif
      </div>
      <div class="col-md-12">
        @yield('cart')
      </div>
      <div class="col-md-3">
        
       
       @yield('sidebar')
      </div> 
    <div class="col-md-9 carousel-set">
      @yield('slider')
     <div class="row">
      <div class="col-md-12">
      
          @yield('content')
         
      </div>
     </div>
      <div class="row">
        <div class="col-md-8">
          @yield('register')
            
        </div>      
      </div>
    </div><!---col-md-9--->
   
   
  </div><!-----row--->
   <div id="show-content"> 
   <div class="row">
    <div class="col-md-12">
      @yield('show-all')
    </div>  
   </div><!---/ row--->
   </div><!----/show-content---->
      @yield('contact-us')
      
      @yield('checkout')


  
      </div><!----/container--->
    <div class="footer-wrap">  
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10 offset-md-1">
            
         <footer>
         <div id="footer">
          <div class="row">

            <div class="col-md-2" style="padding-left: 0">
              <h4 style="padding-left: 35px;">Your Account</h4>
               <ul>
                 <li><a href="">Your Account</a></li>
                 <li><a href="">Personal Information</a></li>
                 <li><a href="">Address</a></li>
                 <li><a href="">Discount</a></li>
                 <li><a href="">Order History</a></li>

               </ul>
            </div>
            <div class="col-md-2">
              <h4>Information</h4>
                 <li><a href="">Contact</a></li>
                 <li><a href="">Sitemap</a></li>
                 <li><a href="">Legal notice</a></li>
                 <li><a href="">Terms and Conditions</a></li>
                 <li><a href="">About Us</a></li>
            </div>
            <div class="col-md-2">
                 <h4>Our Offers</h4>
                 <li><a href="">New Products</a></li>
                 <li><a href="">Top Sellers</a></li>
                 <li><a href="">Specials</a></li>
                 <li><a href="">Manufacturers</a></li>
                 <li><a href="">Suppiers</a></li>   
            </div>
            <div class="col-md-5">
              <h4>The standard chunk of Lorem</h4>
              <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
            </div>
          </div><!--row-->
        </div>
      </footer>
      </div><!---/col-md-10---->
    
        </div>
      </div>
    </div>
    
    </div><!----#app --->
    <script type="text/javascript" src="{{asset('public/js/app.js')}}"></script>
    <script src="{{asset('node_modules/owl.carousel/dist/owl.carousel.min.js')}}"></script>
    @yield('script')
    <script type="text/javascript">
      jQuery(document).ready(function($) {
        $('.owl-carousel').owlCarousel({
          loop:true,
          autoplay:true,
          margin:25,
          dots:false,
          autoplayHoverPause:true,
          smartSpeed:300,
          responsive:{
            0:{
              items:1,
            },
            300:{
              items:2,
            },
            600:{
              items:3,
            },
            1000:{
              items:4,
            }

          }
        });
        
        $(".card").mouseenter(function(){
          $(this).find('.pro-view').css('display', 'block');
          
        }).mouseleave(function(){
          $(this).find('.pro-view').css('display', 'none');
        });
         
        let path = window.location.href;//.pathname;//split("/").pop(); 

        
        
        $('nav .add-nav-active li a').filter(function(){
           return this.href == path;
        }).parent().addClass('nav-active');

        if (window.location.pathname == '/Ecommerce-lara/products-all'){
             $("#show-content").addClass('show-all');
        }else{
          $("#show-content").removeClass('show-all');
        }
        
      })
    </script>
</body>
</html>
