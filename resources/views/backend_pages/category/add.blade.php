@extends('layouts.backend')
@section('title', 'Add Category')
@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
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
			<form class="kt-form">
				<div class="kt-portlet__body">
					
					<div class="form-group">
						<label>Email address</label>
						<input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
						<span class="form-text text-muted">We'll never share your email with anyone else.</span>
					</div>
					<div class="form-group form-group-last">
						<label for="exampleTextarea">Example textarea</label>
						<textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
					</div>
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="reset" class="btn btn-primary">Submit</button>
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