@extends('layouts.backend')
@section('title', 'Customers')
@section('breadcrumbs')
	<a href="{{route('admin.dashboard')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
	<span class="kt-subheader__breadcrumbs-separator"></span>
	<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Customers</span>
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
							<a href="{{route('admin.profile.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
							<i class="la la-plus"></i>
							New Customer
						</a>
						&nbsp;
						<a href="{{route('admin.profile.trash')}}" class="btn btn-brand btn-elevate btn-icon-sm">
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
						<th>Name</th>
						<th>Email</th>
						<th>Role</th>
						<th>Phone</th>
						<th>Address</th>
						<th>Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@if($users->count() > 0)
						@foreach($users as $user)
							<tr>
								<td>{{$user->id}}</td>
								<td><img src="{{asset('storage/'.$user->profile->thumbnail)}}" alt="{{$user->name}}" class="img-responsive" height="50"/></td>
							 	<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
								<td>{{$user->role->name}}</td>
								<td>{{$user->profile->phone}}</td>
								<td>
									{{$user->profile->address}}
								</td>
							
								<td>
									@if($user->trashed())
										{{date('d/m/Y',strtotime($user->deleted_at))}}
									@else 
										{{date('d/m/Y',strtotime($user->created_at))}}
									@endif
								</td>
								
								<td>
						@if($user->trashed())	
						<a href="{{route('admin.user.recover',$user->id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Restore">
                          <i class="la la-undo"></i>
                        </a>
                       
                        @else
                        <a href="{{route('admin.profile.edit',$user->id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
                          <i class="la la-edit"></i>
                        </a>
                         <a href="{{route('admin.profile.remove',$user->id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Trash">
                          <i class="la la-trash"></i>
                        </a>
							
                        @endif
                        <a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" onclick="confirmDelete('{{$user->id}}')">
                          <i class="la la-close"></i>
                        </a>
                         <form id="confirm-delete-form-{{$user->id}}" action="{{ route('admin.profile.destroy',$user->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                    </td>
								
							</tr>
						@endforeach
					@endif
					@if($users->count()==0)
					<tr>
						<td colspan="9"><center>No record found.</center></td>
						
					</tr>
					@endif
				</tbody>
			</table>
			{{$users->links()}}
			<!--end: Datatable -->
		</div>
	</div>

@endsection