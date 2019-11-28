@extends('layouts.app')
@section('contact-us')
<div class="contact-us">
  <div class="row">
    <div class="col-md-10 offset-md-1">
<div class="row">
	<div class="col-md-12">
		<h2>Vist Us</h2>
		<hr>
	</div>	
	<div class="col-md-8">
		
		<div class="contact-us-map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d435521.4079239993!2d74.07127853381661!3d31.48263523074283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39190483e58107d9%3A0xc23abe6ccc7e2462!2sLahore%2C+Punjab!5e0!3m2!1sen!2s!4v1551185474817" width="570" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	</div>
	<div class="col-md-4">
		<h4>Mail Us</h4>
		 <form>
		 	<div class="form-group">
		 		<input type="text" name="name" placeholder="Name" class="form-control">
		 	</div>
		 	<div class="form-group">
		 		<input type="text" name="email" placeholder="Email" class="form-control">
		 	</div>
		 	<div class="form-group">
		 		<input type="text" name="subject" placeholder="Subject" class="form-control">
		 	</div>
		 	<div class="form-group">
		 		<textarea class="form-control"></textarea>
		 	</div>
		 	<div class="form-group">
		 		<input type="submit" name="submit" value="Submit" class="btn btn-warning">
		 	</div>
		 </form>
		
	</div>

</div>
</div>
</div> 
</div>


@endsection
