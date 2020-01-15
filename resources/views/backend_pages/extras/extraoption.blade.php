@if(request()->ajax())

<div class="row options">
	<div class="kt-portlet__head col-sm-12">
	<div class="kt-portlet__head-label">
		<h3 class="kt-portlet__head-title">
	Extra
	</h3>
	</div>
</div>
	<div class="col-sm-12">
		<div class="form-group">
			<label>Option</label>
			<input type="text" name="option[]" class="form-control" value="" placeholder="size">
		</div>
		<div class="form-group">
			<label>Values</label>
			<input type="text" name="values[]" class="form-control" placeholder="options1 | option2 | option3" />
		</div>	
		<div class="form-group">
			<label>Additional Prices</label>
			<input type="text" name="prices[]" class="form-control" placeholder="price1 | price2 | price3" />
		</div>	
	</div>
</div>

@else
<p class="alert alert-danger">You Can not Access Directly!!!!</p>
@endif