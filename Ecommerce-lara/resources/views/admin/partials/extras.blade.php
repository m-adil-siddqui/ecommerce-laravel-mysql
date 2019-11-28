@if(request()->ajax())
<div class="row align-items-center options">
  <div class="col-sm-12">
  	<h5 class="pt-2 pb-2 bg-primary text-center" style="color: #fff;">Extras</h5>
  </div>	
  <div class="col-sm-4">
  	<label class="form-control-label">Options</label>
  	<input type="text" name="options[]" placeholder="size" class="form-control">
  </div>
  <div class="col-sm-8">
  	<label class="form-control-label">Values</label>
  	<input type="text" name="values[]" placeholder="option1 | option2 | option3" class="form-control">
  	<label class="form-control-label">Additional Price</label>
  	<input type="text" name="prices[]" placeholder="price1 | price2 | price3" class="form-control">
  </div>
</div>


@endif