@extends('layouts.backend')
@section('title', 'Add/Edit User')
@section('breadcrumbs')
	<a href="{{route('admin.dashboard')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
	<span class="kt-subheader__breadcrumbs-separator"></span>
	<a href="{{route('admin.profile.index')}}" class="kt-subheader__breadcrumbs-link">Customer </a>
	<span class="kt-subheader__breadcrumbs-separator"></span>
	<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Add/Edit User</span>
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
			<form class="kt-form" action="{{route('admin.profile.store')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
				@csrf
				@if(isset($product))
					@method('PUT')
				@endif
				<div class="kt-portlet__body">
					<!-- data manage start -->
					<div class="row">
						<div class="col-md-8">
							<div class="form-group row">
								<div class="col-md-6" >
									<label>Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror  @error('slug') is-invalid @enderror" id="txturl" name="name" placeholder="Enter name"  value="@if(isset($product->name))  {{$product->name}} @else {{old('name')}}  @endif">
								<div class="invalid-feedback">{{ $errors->first('title') }}</div>
								<span class="form-text text-muted"><strong>Slug :</strong>{{url('/')}}/<span id="slugUrl">@if(isset($product->slug))  {{$product->slug}} @else {{old('slug')}}  @endif</span></span>

								<input type="hidden" name="slug" id="sluginput"  value="@if(isset($product->slug))  {{$product->slug}} @else {{old('slug')}}  @endif">
								<div class="invalid-feedback">{{ $errors->first('slug') }}</div>
								</div>
								<div class="col-md-6" >
									<label>Email</label>
								<input type="text" class="form-control @error('email') is-invalid @enderror  " id="email" name="email" placeholder="Enter email"  value="@if(isset($product->email))  {{$product->email}} @else {{old('email')}}  @endif">
								<div class="invalid-feedback">{{ $errors->first('email') }}</div>
								</div>
								
							</div>					
							<div class="form-group row">
								<div class="col-md-6" >
									<label>Password</label>
									<input type="password" class="form-control @error('password') is-invalid @enderror  "  name="password" placeholder="Enter password">
									<div class="invalid-feedback">{{ $errors->first('password') }}</div>
								</div>
							
								<div class="col-md-6" >
									
									<label>Confirm Password</label>
									<input type="password" class="form-control @error('c_password') is-invalid @enderror  "  name="c_password" placeholder="Enter confirm password" >
									<div class="invalid-feedback">{{ $errors->first('c_password') }}</div>
								

								</div>
							</div>
							<div class="form-group row">
								<div class="col-6">
									<label>Role</label>
									<select class="form-control @error('role_id') is-invalid @enderror"  name="role_id">
										@if($roles)
											@foreach($roles as $role)
											<option value="{{$role->id}}"  
											> {{$role->name}}</option>
											@endforeach
										@endif
									</select>
									<div class="invalid-feedback">{{ $errors->first('role_id') }}</div>
								</div>
								<div class="col-6">
									<label>Phone</label>
									<input type="text" class="form-control @error('phone') is-invalid @enderror  "  name="phone" placeholder="Enter phone number" >
									<div class="invalid-feedback">{{ $errors->first('phone') }}</div>
								</div>	
							</div>					
							<div class="form-group row">
								<div class="col-12">
									<label>Address</label>
									<input type="text" class="form-control @error('address') is-invalid @enderror  "  name="address" placeholder="Enter address" >
									<div class="invalid-feedback">{{ $errors->first('address') }}</div>
								</div>
								
							</div>

						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Status</label>
									<select class="form-control @error('status') is-invalid @enderror" name="status">
										
										<option value="1"
										 @if(isset($product) && $product->status == 1) {{'selected'}} @endif
										 >Active</option>
										<option value="0" 
										@if(isset($product) && $product->status == 0) {{'selected'}} @endif

										>Inactive</option>
											
									</select>
									<div class="invalid-feedback">{{ $errors->first('status') }}</div>
							</div>
							<div class="form-group">
								<label>Profile Image</label>
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
						</div>
					</div>
					<!-- data manage start -->
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="submit" class="btn btn-primary">@if(isset($product)) {{'Update'}} @else {{'Add'}}  @endif User</button>
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
