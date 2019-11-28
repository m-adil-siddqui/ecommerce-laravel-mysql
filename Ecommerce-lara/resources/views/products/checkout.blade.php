@extends('layouts.app')
@section('checkout')
<div class="checkout-set">
<div class="row">
    <div class="col-md-4 offset-md-1 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill">{{$cart->getTotalQty()}}</span>
      </h4>
      <ul class="list-group mb-3">
        @foreach($cart->getContents() as $slug => $product)
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">{{$product['item']->title}}</h6>
            <small class="text-muted">{{$product['qty']}}</small>
          </div>
          <span class="text-muted">${{$product['price']}}</span>
        </li>
        @endforeach
 
        <!-- <li class="list-group-item d-flex justify-content-between bg-light">
          <div class="text-success">
            <h6 class="my-0">Promo code</h6>
            <small>EXAMPLECODE</small>
          </div>
          <span class="text-success">-$5</span>
        </li>--->
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (USD)</span>
          <strong>${{$cart->getTotalPrice()}}</strong>
        </li> 
      </ul>

<!--       <form class="card p-2">
      	@csrf
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Promo code">
          <div class="input-group-append">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </div>
      </form> -->
    </div>
    <div class="col-md-7 order-md-1">
       
      <h4 class="mb-3">Billing address</h4>
      <form class="needs-validation AVAST_PAM_nonloginform" action="{{route('checkout.store')}}" novalidate="" method="post" id="payment-form">
      	@csrf
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" name="billing_firstname" class="form-control" id="firstName" placeholder="" value="" required="">
            
              @if($errors->has('billing_firstname'))
              <div style="color: red; font-size: 14px;">
                {{$errors->first('billing_firstname')}}
               </div> 
              @endif
            
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" name="billing_lastname" class="form-control" id="lastName" placeholder="" value="" required="">
             @if($errors->has('billing_lastname'))
              <div style="color: red; font-size: 14px;">
                {{$errors->first('billing_lastname')}}
               </div> 
              @endif
          </div>
        </div>

        <div class="mb-3">
          <label for="username">Username</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">@</span>
            </div>
            <input type="text" name="username" class="form-control" id="username" placeholder="Username" required="">
              @if($errors->has('username'))
              {{$errors->first('username')}}
              @endif
            
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com">
            @if($errors->has('email'))
              <div  style="color: red; font-size: 14px;">
                {{$errors->first('email')}}
               </div> 
           @endif
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" name="billing_address1" class="form-control" id="address" placeholder="1234 Main St" required="">
            @if($errors->has('billing_firstname'))
              <div  style="color: red; font-size: 14px;">
                {{$errors->first('billing_address1')}}
               </div> 
            @endif
        </div>

        <div class="mb-3">
          <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
          <input type="text" name="billing_address2" class="form-control" id="address2" placeholder="Apartment or suite">
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select name="billing_country" class="custom-select d-block w-100" id="country" required="">
              <option value="">Choose...</option>
              <option>United States</option>
            </select>
            @if($errors->has('billing_country'))
              <div  style="color: red; font-size: 14px;">
                {{$errors->first('billing_country')}}
               </div> 
            @endif
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <select name="billing_state" class="custom-select d-block w-100" id="state" required="">
              <option value="">Choose...</option>
              <option>California</option>
            </select>
            @if($errors->has('billing_state'))
              <div  style="color: red; font-size: 14px;">
                {{$errors->first('billing_state')}}
               </div> 
            @endif
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input name="billing_zip" type="text" class="form-control" id="zip" placeholder="" required="">
            @if($errors->has('billing_zip'))
              <div  style="color: red; font-size: 14px;">
                {{$errors->first('billing_zip')}}
               </div> 
            @endif
          </div>
        </div>
        <hr class="mb-4">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" name="shipping_address" class="custom-control-input" id="same-address">
          <label  class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="save-info">
          <label class="custom-control-label" for="save-info">Save this information for next time</label>
        </div>
        

        <!-- <h4 class="mb-3">Shipping Address</h4> -->
         <div class="col-md-12 order-md-1" id="hide-shipping">
         	<hr class="mb-4">
      <h4 class="mb-3">Shipping address</h4>
      
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" name="shipping_firstname" class="form-control" id="firstName" placeholder="" value="" required="">
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input name="shipping_lastname" type="text" class="form-control" id="lastName" placeholder="" value="" required="">
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>

        
 
        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" name="shipping_address1" class="form-control" id="address" placeholder="1234 Main St" required="">
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>

        <div class="mb-3">
          <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
          <input type="text" name="shipping_address2" class="form-control" id="address2" placeholder="Apartment or suite">
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select name="shipping_country" class="custom-select d-block w-100" id="country" required="">
              <option value="">Choose...</option>
              <option>United States</option>
            </select>
            <!-- <div class="invalid-feedback">
              Please select a valid country.
            </div> -->
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <select name="shipping_state" class="custom-select d-block w-100" id="state" required="">
              <option value="">Choose...</option>
              <option>California</option>
            </select>
<!--             <div class="invalid-feedback">
              Please provide a valid state.
            </div> -->
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input type="text" name="shipping_zip" class="form-control" id="zip" placeholder="" required="">
            <!-- <div class="invalid-feedback">
              Zip code required.
            </div> -->
          </div>
        </div>

        </div>
        
        <hr class="mb-4">
        <script src="https://js.stripe.com/v3/"></script>
      <div class="form-row">
        <label for="card-element">
          Credit or debit card
        </label>
        <div id="card-element">
          <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
      </div>
        <button class="btn btn-primary btn-lg btn-block" type="submit" style="margin-top: 1em;">Continue to checkout</button>
      </form>
    </div>
  </div>
  </div>
@endsection

@section('script')
<script type="text/javascript">
	$(function(){
		$("#same-address").on('change', function(){
           $("#hide-shipping").slideToggle(!this.checked);
		});
    // Create a Stripe client.
var stripe = Stripe('pk_test_vBj8IqiUyAKT2VaO6M52k6vA');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}


	})
</script>

@endsection