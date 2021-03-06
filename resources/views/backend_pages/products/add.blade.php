@extends('layouts.backend')
@section('title', 'Add/Edit Product')
@section('breadcrumbs')
	<a href="{{route('admin.dashboard')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
	<span class="kt-subheader__breadcrumbs-separator"></span>
	<a href="{{route('admin.product.index')}}" class="kt-subheader__breadcrumbs-link">Products </a>
	<span class="kt-subheader__breadcrumbs-separator"></span>
	<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Add/Edit Product</span>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<!--begin::Portlet-->
		<div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
				Base Controls
				</h3>
				</div>
			</div>
			<!--begin::Form-->
			<form class="kt-form" action="@if(isset($product)) {{route('admin.product.update',$product->id)}} @else {{route('admin.product.store')}} @endif" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
				@csrf
				@if(isset($product))
					@method('PUT')
				@endif
				<div class="kt-portlet__body">
					<!-- data manage start -->
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label>Title</label>
								<input type="text" class="form-control @error('title') is-invalid @enderror  @error('slug') is-invalid @enderror" id="txturl" name="title" placeholder="Enter title"  value="@if(isset($product->title))  {{$product->title}} @else {{old('title')}}  @endif">
								<div class="invalid-feedback">{{ $errors->first('title') }}</div>
								<span class="form-text text-muted"><strong>Slug :</strong>{{url('/')}}/<span id="slugUrl">@if(isset($product->slug))  {{$product->slug}} @else {{old('slug')}}  @endif</span></span>

								<input type="hidden" name="slug" id="sluginput"  value="@if(isset($product->slug))  {{$product->slug}} @else {{old('slug')}}  @endif">
								<div class="invalid-feedback">{{ $errors->first('slug') }}</div>
							</div>
							<div class="form-group">
								<label>Category</label>
									<select class="form-control kt-select2 @error('category_id') is-invalid @enderror" id="kt_select2_3" name="category_id[]"  multiple="multiple">
										@if($categories)
											@foreach($categories as $category)
											<option value="{{$category->id}}"  
											@if(isset($ids) && !is_null($ids) && in_array($category->id, $ids))
						{{'selected'}}
						@endif

											> {{$category->title}}</option>
											@endforeach
										@endif
									</select>
									<div class="invalid-feedback">{{ $errors->first('category_id') }}</div>
							</div>
							<div class="form-group row">
								<div class="col-6">
									<label class="form-control-label">Price: </label>
										<div class="input-group mb-3">
										<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">$</span>
									</div>
										<input type="text" class="form-control @error('price') is-invalid @enderror" placeholder="0.00" aria-label="Username" aria-describedby="basic-addon1" name="price" value="{{@$product->price}}" />
										<div class="invalid-feedback">{{ $errors->first('price') }}</div>
									</div>
								</div>
								<div class="col-6">
									<label class="form-control-label">Discount: </label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">$</span>
										</div>
										<input type="text" class="form-control" name="discount_price" placeholder="0.00" aria-label="discount_price" aria-describedby="discount" value="{{@$product->discount_price}}" />
									</div>
								</div>
							</div>
							<div class="form-group form-group-last">
								<label for="exampleTextarea">Decription</label>
								<textarea name="description" class="form-control" data-provide="markdown" rows="10">@if(isset($product->description)) {!! $product->description!!} @else {!!old('description')!!}  @endif</textarea>
														
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Status</label>
									<select class="form-control @error('status') is-invalid @enderror" name="status">
										
										<option value="0"
										 @if(isset($product) && $product->status == 0) {{'selected'}} @endif
										 >Pending</option>
										<option value="1" 
										@if(isset($product) && $product->status == 1) {{'selected'}} @endif

										>Publish</option>
											
									</select>
									<div class="invalid-feedback">{{ $errors->first('status') }}</div>
							</div>
							<div class="form-group">
								<label>Feaured Image</label>
									<div class="input-group mb-3">
										<div class="custom-file ">
										<input type="file"  class="custom-file-input @error('thumbnail') is-invalid @enderror" name="thumbnail" id="thumbnail">
									
											<label class="custom-file-label" for="thumbnail">Choose file</label>

										</div>
											<div class="invalid-feedback" style="display: block;" >{{ $errors->first('thumbnail') }}</div>
									</div>

									<div class="img-thumbnail  text-center">

									<img src="@if( isset($product) && @$product->thumbnail) {{asset('storage/'.$product->thumbnail)}} @else {{ asset('images/no-thumbnail.jpeg')}} @endif" id="imgthumbnail" class="img-fluid" alt="">
									</div>
							</div>

							<div class="form-group">
								<label>Featured Product</label>
								<div class="kt-checkbox-list">

									<label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
									<input type="checkbox" id="featured" type="checkbox" name="featured" value="@if(isset($product)){{@$product->featured}}@else{{0}}@endif"  @if(isset($product) && $product->featured == 1) {{'checked'}} @endif  /> Yes
								<span></span>
								</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row" id="extraItems" data-url="{{route('admin.product.extras')}}" >
		
						<div class="card col-sm-12 p-0 mb-2">
							<div class="card-header align-items-center">
								<h5 class="card-title float-left">Extra Options</h5>
								<div class="float-right" >
									<button type="button" id="btn-add" class="btn btn-primary btn-sm">+</button>
									<button type="button" id="btn-remove" class="btn btn-danger btn-sm">-</button>
								</div>

							</div>
							<div class="card-body" id="extras">
								@if(isset($product))
								 @if(isset($extras) && is_array($extras))
								 
								  @foreach($extras as $option) 
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
			<input type="text" name="extras[option][]" class="form-control" value="{{ $option[0]}}" placeholder="size">
		</div>
		<div class="form-group">
			<label>Values</label>
			<input type="text" name="extras[values][]" class="form-control" placeholder="options1 | option2 | option3" />
		</div>	
		<div class="form-group">
			<label>Additional Prices</label>
			<input type="text" name="extras[prices][]" class="form-control" placeholder="price1 | price2 | price3"  />
		</div>	
	</div>
</div>
								  @endforeach

								 @endif
								@endif

							</div>
						</div>
				
					</div>
					<!-- data manage start -->
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="submit" class="btn btn-primary">@if(isset($product)) {{'Update'}} @else {{'Add'}}  @endif Product</button>
						<button type="reset" class="btn btn-secondary">Cancel</button>
					</div>
				</div>
			</form>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->
	<!--end::Portlet-->
	</div>
</div>
@endsection
