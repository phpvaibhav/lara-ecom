@extends('layouts.backend')
@section('title', 'Add/Edit Category')
@section('breadcrumbs')
	<a href="{{route('admin.dashboard')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
	<span class="kt-subheader__breadcrumbs-separator"></span>
	<a href="{{route('admin.category.index')}}" class="kt-subheader__breadcrumbs-link">Category </a>
	<span class="kt-subheader__breadcrumbs-separator"></span>
	<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Add/Edit Category</span>
@endsection
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
			<form class="kt-form" action="@if(isset($category)) {{route('admin.category.update',$category->id)}} @else {{route('admin.category.store')}} @endif" method="post" accept-charset="utf-8">
				@csrf
				@if(isset($category))
					@method('PUT')
				@endif
				<div class="kt-portlet__body">
					
					<div class="form-group">
						<label>Title</label>
						<input type="text" class="form-control @error('title') is-invalid @enderror  @error('slug') is-invalid @enderror" id="txturl" name="title" placeholder="Enter title"  value="@if(isset($category->title))  {{$category->title}} @else {{old('title')}}  @endif">
						<div class="invalid-feedback">{{ $errors->first('title') }}</div>
						<span class="form-text text-muted"><strong>Slug :</strong>{{url('/')}}/<span id="slugUrl">@if(isset($category->slug))  {{$category->slug}} @else {{old('slug')}}  @endif</span></span>
						
						<input type="hidden" name="slug" id="sluginput"  value="@if(isset($category->slug))  {{$category->slug}} @else {{old('slug')}}  @endif">
						<div class="invalid-feedback">{{ $errors->first('slug') }}</div>
					</div>
					<div class="form-group">
						<label>Category</label>
						
					

						
							<select class="form-control kt-select2" id="kt_select2_3" name="parent_id[]" multiple="multiple">
								@if($categories)
									@foreach($categories as $category)
									<option value="{{$category->id}}" @if(isset($ids) && !is_null($ids) && in_array($category->id,$ids)){{'selected'}} @endif >{{$category->title}}</option>
									@endforeach
								@endif
							</select>
						
					</div>
					<div class="form-group form-group-last">
						<label for="exampleTextarea">Decription</label>
						<textarea name="description" class="form-control" data-provide="markdown" rows="10">@if(isset($category->description)) {!! $category->description!!} @else {!!old('description')!!}  @endif</textarea>
												
					</div>
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="submit" class="btn btn-primary">@if(isset($category)) {{'Update'}} @else {{'Add'}} @endif</button>
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
