@extends('backend.master')
@section('breadcrumb')
    Users
@endsection
@section('users','active show-sub')
@section('users-list','active')
@section('content')
<div class="container">
    @if (session('CategoryRestore'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('CategoryRestore') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('UserDelete'))
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            {{ session('UserDelete') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="card pd-10 pd-sm-10 mg-t-10">
        <h6 class="card-body-title text-center">{{ __('View Users List') }} ({{ $user_count }})</h6>
        <div class="table-responsive">
            <table class="table table-bordered mg-b-0">
                <thead>
                    <tr>
                        <th class="text-center">SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user )
                    <tr>
                        <td class="text-center">{{ $users->firstItem()+$key }}</td>
                        <td>{{ $user->name ?? 'N/A' }}</td>
                        <td>{{ $user->email ?? 'N/A' }}</td>
                        <td title="{{ $user->created_at != null ? $user->created_at->format('h:i:sa d-M-Y') : 'N/A'}}">{{ $user->created_at != null ? $user->created_at->diffForHumans() : 'N/A'}}</td>
                        <td>{{ $user->created_at != null ? $user->updated_at->diffForHumans() : 'N/A'}}</td>
                        <td class="text-center">
                            <a href="{{ url('/user-edit') }}/{{ $user->id }}" class="btn btn-purple">Edit</a>
                            <a href="{{ url('/user-delete') }}/{{ $user->id }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
        <!-- table-responsive -->
    </div><!-- card -->

</div>
@endsection
