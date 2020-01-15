@extends('layouts.backend')
@section('title', 'Category')
@section('breadcrumbs')
	<a href="{{route('admin.dashboard')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
	<span class="kt-subheader__breadcrumbs-separator"></span>
	<!-- <a href="" class="kt-subheader__breadcrumbs-link">
											Forms </a>
										<span class="kt-subheader__breadcrumbs-separator"></span> -->
	<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Category</span>
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
						<a href="{{route('admin.category.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
							<i class="la la-plus"></i>
							New Category
						</a>&nbsp;
						<a href="{{route('admin.category.trash')}}" class="btn btn-brand btn-elevate btn-icon-sm">
							<i class="la la-trash"></i>
							Trashed List
						</a>
						
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable">
				<thead>
					<tr>
						<th>ID</th>
						<th>title</th>
						<th>Slug</th>
						<th>Categories</th>
						
						<th>Description</th>
						<th>Created</th>
						<!-- <th>Deleted</th> -->
						<!-- <th>Status</th> -->
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@if($categories)
						@foreach($categories as $category)
					<tr>
						<td>{{$category->id}}</td>
						<td>{{$category->title}}</td>
						<td>{{$category->slug}}</td>
						<td>
							@if($category->childens->count() >0)
								@foreach($category->childens as $childen)
								{{$childen->title}},
								@endforeach
							@else
							<strong> Parent Category</strong>
							@endif

						</td>
						<td> {!! $category->description !!}</td>
						<td>@if($category->trashed())
							{{date('d/m/Y',strtotime($category->deleted_at))}}
						@else {{date('d/m/Y',strtotime($category->created_at))}}
						@endif
					</td>
						<!-- <td>
							<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Active</span></td> -->

						<td>
						@if($category->trashed())	
						<a href="{{route('admin.category.recover',$category->id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Restore">
                          <i class="la la-undo"></i>
                        </a>
                       
                        @else
                        <a href="{{route('admin.category.edit',$category->id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
                          <i class="la la-edit"></i>
                        </a>
                         <a href="{{route('admin.category.remove',$category->id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Trash">
                          <i class="la la-trash"></i>
                        </a>
							
                        @endif
                        <a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" onclick="confirmDelete('{{$category->id}}')">
                          <i class="la la-close"></i>
                        </a>
                         <form id="confirm-delete-form-{{$category->id}}" action="{{ route('admin.category.destroy',$category->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                    </td>
					</tr>
						@endforeach
					@endif
					@if($categories->count()==0)
					<tr>
						<td colspan="7"><center>No record found.</center></td>
						
					</tr>
					@endif
				</tbody>
			</table>
			{{$categories->links()}}
			<!--end: Datatable -->
		</div>
	</div>

@endsection
