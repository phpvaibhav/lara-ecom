@extends('layouts.backend')
@section('title', 'Products')
@section('breadcrumbs')
	<a href="{{route('admin.dashboard')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
	<span class="kt-subheader__breadcrumbs-separator"></span>
	<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Product</span>
@endsection
@section('content')

	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					List
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						
						&nbsp;
							<a href="{{route('admin.product.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
							<i class="la la-plus"></i>
							New Product
						</a>
						&nbsp;
						<a href="{{route('admin.product.trash')}}" class="btn btn-brand btn-elevate btn-icon-sm">
							<i class="la la-trash"></i>
							Trashed List
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable" >
				<thead>
					<tr>
						<th>#</th>
						<th>Image</th>
						<th>Title</th>
						<th>Description</th>
						<th>Slug</th>
						<th>Categories</th>
						<th>Price</th>
						<th>Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@if($products->count() > 0)
						@foreach($products as $product)
							<tr>
								<td>{{$product->id}}</td>
								<td><img src="{{asset('storage/'.$product->thumbnail)}}" alt="{{$product->title}}" class="img-responsive" height="50"/></td>
								 
								<td>{{$product->title}}</td><td>{{$product->description}}</td>
								<td>{{$product->slug}}</td>
								<td>
									@if($product->categories()->count() > 0)
									@foreach($product->categories as $children)
										{{$children->title}},
									@endforeach
									@else 
										<strong>	{{"product"}}</strong>
									@endif
								</td>
								<td>${{$product->price}}</td>
								<td>
									@if($product->trashed())
										{{date('d/m/Y',strtotime($product->deleted_at))}}
									@else 
										{{date('d/m/Y',strtotime($product->created_at))}}
									@endif
								</td>
								
								<td>
						@if($product->trashed())	
						<a href="{{route('admin.product.recover',$product->id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Restore">
                          <i class="la la-undo"></i>
                        </a>
                       
                        @else
                        <a href="{{route('admin.product.edit',$product->id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
                          <i class="la la-edit"></i>
                        </a>
                         <a href="{{route('admin.product.remove',$product->id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Trash">
                          <i class="la la-trash"></i>
                        </a>
							
                        @endif
                        <a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" onclick="confirmDelete('{{$product->id}}')">
                          <i class="la la-close"></i>
                        </a>
                         <form id="confirm-delete-form-{{$product->id}}" action="{{ route('admin.product.destroy',$product->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                    </td>
								
							</tr>
						@endforeach
					@endif
					@if($products->count()==0)
					<tr>
						<td colspan="9"><center>No record found.</center></td>
						
					</tr>
					@endif
				</tbody>
			</table>
			{{$products->links()}}
			<!--end: Datatable -->
		</div>
	</div>

@endsection