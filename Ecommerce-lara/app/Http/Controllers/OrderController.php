0<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Order;
use App\Customer;
use App\Cart;
use App\Category;
use Session;
use DB;
use App\Http\Requests\StoreOrder;
use Stripe\Stripe;
use Stripe\Charge;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Session::has('cart') || empty(Session::get('cart')->getContents())) {
            return redirect('products')->with('message', 'Sorry! cart is empty!!!!');
        }
        
        $categories = Category::all();
        $cart = Session::get('cart');
        return view('products.checkout', compact('cart','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrder $request)
    {
        
        $error = '';
        $success = '';
        $cart = [];
        $order = '';
        $customer = '';

        Stripe::setApiKey("sk_test_vKQuKqVvjqzZel3H2ovM9ROC");
        if(Session::has('cart'))
        {
            $cart = Session::get('cart');
            $charge = Charge::create([
           'amount' => $cart->getTotalPrice() * 100,
           'currency' => 'usd',
           'source' => $request->stripeToken,
           'receipt_email' => $request->email,
            ]);
        }
    if( isset($charge) ){

        if ($request->shipping_address) {
            $customers = [
              'billing_firstname' => $request->billing_firstname,
              'billing_lastname' => $request->billing_lastname,
              'username' => $charge->id,
              'email' => $request->email,
              'billing_address1' => $request->billing_address1,
              'billing_address2' => $request->billing_address2,
              'billing_country' => $request->billing_country,
              'billing_state' => $request->billing_state,
              'billing_zip' => $request->billing_zip,

              'shipping_firstname' => $request->shipping_firstname,
              'shipping_lastname' => $request->shipping_lastname,
              'username' => $charge->id,
              'email' => $request->email,
              'shipping_address1' => $request->shipping_address1,
              'shipping_address2' => $request->shipping_address2,
              'shipping_country' => $request->shipping_country,
              'shipping_state' => $request->shipping_state,
              'shipping_zip' => $request->shipping_zip,
              
            ];
        } else {
            $customers = [
              'billing_firstname' => $request->billing_firstname,
              'billing_lastname' => $request->billing_lastname,
              'username' => $charge->id,
              'email' => $request->email,
              'billing_address1' => $request->billing_address1,
              'billing_address2' => $request->billing_address2,
              'billing_country' => $request->billing_country,
              'billing_state' => $request->billing_state,
              'billing_zip' => $request->billing_zip,

            ];
        }

    }

        DB::beginTransaction();
        $customer = Customer::create($customers);
        
        foreach ($cart->getContents() as $slug => $product) {
          $orders = [
             'user_id' => $customer->id,
             'product_id' => 1,//$product['product']->id,
             'qty' => $product['qty'],
             'status' => 'pending',
             'price' => $product['price'],
             'payment_id' => 0
          ];
          $order = Order::create($orders);
        }

        if ($customer && $order) {
            DB::commit();
           // $request->session()->forget('cart');
            //$request->session()->flush();
            return redirect('products')->with('message', 'Your Order Successfully Completed!!!');

        } else {
            DB::rollback();
            return redirect('checkout')->with('message', 'Something went wrong!!!!');
        }

       // return response()->json($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
