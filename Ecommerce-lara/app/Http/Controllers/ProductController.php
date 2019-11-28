<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Http\Requests\StoreProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Cart;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(3);
        return view('admin.products.index', compact('products'));
    }


    public function trash(){
       $products = Product::onlyTrashed()->paginate(3);
       return view('admin.products.index', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(StoreProduct  $request)
    {
    
        $extension = ".".$request->thumbnail->getClientOriginalExtension();
        $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
        $name = $name.$extension;
      //  $path = $request->thumbnail->storeAs('images', $name, '');
       // $request->thumbnail->move(public_path('images'), $name);
       // $path = $request->thumbnail->storeAs('images', $name);
        $path = $request->thumbnail->storeAs('images', $name, 'public');
        
        $product = Product::create([
            'title' => $request->title,
            'slug' =>  $request->slug,
            'description' => $request->description,
            'thumbnail' => $path,
            'status' => $request->status,
            'options' => isset($request->extra) ? json_encode($request->extra) :null,
            'featured' => ($request->featured) ? $request->featured : 0,
            'price'  =>  $request->price,
            'discount' => ($request->discount) ? $request->discount : 0,
            'discount_price' => ($request->discount_price) ? $request->discount_price : 0,


        ]);
        if($product){
            $product->categories()->attach($request->category_id);
            return back()->with('message', 'Product successfully Added');
        }else{
            return back()->with('message', 'Product not be Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $categories = Category::all();
        //$products = Product::paginate(6);
        $products = Product::all();
       // $latest = Product::orderBy('id')->get();
        $latests = Product::orderBy('id', 'desc')->limit(3)->get();
        $all = Product::orderBy('id', 'asc')->take(3)->get();
        
        return view('products.all', compact('products', 'latests','all', 'categories'));
    }

    public function showAll(){
        $products = Product::orderBy('created_at', 'desc')->get();
        $categories = Category::all();
        return view('products.show-all',compact('products','categories'));
    }

    public function single(Product $product){
        $categories = Category::all();
         $latests = Product::orderBy('id', 'desc')->limit(3)->get();
         $products = Product::orderBy('id', 'desc')->limit(6)->get();
        return view('products.single',compact('product','latests','products','categories'));
    }

    public function addToCart(Request $request, $id){
         
        $product = Product::find($id);
        $oldCart  = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
         
         $cart->add($product, $product->id);
       
        Session::put('cart', $cart);
        // dd(Session::get('cart'));
        //$request->session()->put('cart', $cart);
        $categories = Category::all();
        $latests = Product::orderBy('id', 'desc')->limit(3)->get();

        //return redirect()->route('products.all');
      
         return back()->with('message','Product '.$product->title.' has been successfully add to cart');

    }

    public function cart(){
        //Session::forget('cart');
        if(!Session::has('cart')){

           $categories = Category::all();
            return view('products.cart',compact('categories'));

        }else{
          $cart =  Session::get('cart');
        
           $categories = Category::all();
          // $latests = Product::orderBy('created_at', 'desc')->limit(3)->get();
           return view('products.cart', compact('cart', 'categories'));            
        }

    }
    
    public function removeProduct($id){

        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
       
        $cart = new Cart($oldCart);
        $cart->removeItem($product);
        Session::put('cart', $cart);
        return back()->with('message', 'Product '.$product->title.' has been successfully remove from cart');
    }


    public function updateProduct(Request $request, $id){
        //dd($request->qty);
        if($request->qty == 0 || $request->qty < 0 ){
            return back()->with('message', 'Please enter it least 1 quantity');
        }
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateCart($product, $request->qty);
        Session::put('cart', $cart);
        return back()->with('message', 'Product '.$product->title.' has been successfully update in the cart');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.create', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    { 
         
        
        if($request->has('thumbnail')){
            $extension = ".".$request->thumbnail->getClientOriginalExtension();
            $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
            $name = $name.$extension;
           // dd($name);
            //$request->thumbnail->move(public_path('images'), $name);
            //$product->thumbnail =  $name;
            $path = $request->thumbnail->storeAs('images', $name, 'public');
        }

        $product->title = $request->title;
        //$product->slug  =  $request->slug;
        $product->description = $request->description;
        $product->thumbnail = isset($request->thumbnail) == null ? $product->thumbnail : $path;
        $product->status = $request->status;
        $product->featured = ($request->featured) ? $request->featured : 0;
        $product->price  =  $request->price;
        $product->discount = ($request->discount) ? $request->discount : 0;
        $product->discount_price = ($request->discount_price) ? $request->discount_price : 0;
        $product->categories()->detach();
        
        if($product->save()){
          $product->categories()->attach($request->category_id);
          return back()->with('message', 'Product successfully updated');  
        }else{
            return back()->with('error', 'Error product updated');
        }
}

    public function recoverProduct($id){
        //$category = Category::withTrashed()->findOrFail($id);
        $product = Product::onlyTrashed()->findOrFail($id);
        if($product->restore()){
          return back()->with('message', 'Product Successfully Restored');       
        }
        else{
            return back()->with('message', 'Error!!!');
        }
        
    }

    /*
    |----
    |GET PRODUCT RELATED CATEGORY
    |
    |*/

    public function productRelatedCat($id){
        $categories = DB::table('category_product')->where('category_id', $id)
        ->pluck('product_id');
        //dd($categories);
        $products = Product::find($categories);
        $categories = Category::all();

        $latests = Product::orderBy('id', 'desc')->limit(3)->get();
        return view('products.catProducts', compact('products','categories', 'latests'));
    }

    public function productRelatedCat2($cat){
    
        $catArray = ["Shoes", "Watches", "Men fashion", "Jewelry" , "Women", "Child", "Fashion","Mobiles"];
        $catTitle = "";
        foreach($catArray as $c){
            if($c == $cat){
                $catTitle = $c;
            }
        }
        $catId = isset($cat) ? DB::table('categories')->where('title', $catTitle)->pluck('id') : null;
        if($catId == null || $catTitle ==''){
           $products = DB::table('products')->where('slug', 'like', '%'.$cat.'%')->get();
           $categories = Category::all();
           $latests = Product::orderBy('id', 'desc')->limit(3)->get();
           return view('products.catProducts', compact('products','categories', 'latests'));
        }else{ 
        $categories = DB::table('category_product')->where('category_id', $catId)->pluck('product_id');
        $products = Product::find($categories);
        $categories = Category::all();
        $latests = Product::orderBy('id', 'desc')->limit(3)->get();
        return view('products.catProducts', compact('products','categories', 'latests'));
       }
         
    }

    //get Product by search
    public function search(Request $request){

         $products = DB::table('products')->where('slug', 'like', '%'.$request->search.'%')->get();
          $categories = Category::all();
          $latests = Product::orderBy('id', 'desc')->limit(3)->get();
        
          return view('products.catProducts', compact('categories','latests', 'products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //dd('hi');
        //dd($product);
       // $product = Product::findOrFail($id);
        if($product->forceDelete()){
            $product->categories()->detach();
            Storage::delete($product->thumbnail);
            //Storage::disk('pulic')->delete($product->thumbnail);
            return back()->with('message', 'Product Successfully Deleted');       
        }
        else{
            return back()->with('message', 'Error!!!');
        }
    }

    public function remove(Product $product){
         //$product = Product::findOrFail($id);
        if($product->delete()){
          return back()->with('message', 'Product Successfully Trashed');       
        }
        else{
            return back()->with('message', 'Error!!!');
        }
    }
}
