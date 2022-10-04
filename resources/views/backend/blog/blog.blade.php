@extends('backend.master')
@section('breadcrumb')
    Category
@endsection
@section('category','active show-sub')
@section('category-list','active')
@section('content')
<div class="container">
    <div class="card pd-10 pd-sm-10 mg-t-10">
        <h6 class="card-body-title text-center">{{ __('View Category') }}</h6>
        <div class="table-responsive">
            <table class="table table-bordered mg-b-0">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Thumbnail</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @csrf
                    @foreach ($blog as $key => $item )
                    <tr>
                        <td class="text-center">{{ $blog->firstItem()+$key }}</td>
                        <td>{{ $item->title ?? 'N/A' }}</td>
                        <td>{{ $item->slug ?? 'N/A' }}</td>
                        <td>{{ $item->thumbnail ?? 'N/A' }}</td>
                        <td>{{ $item->created_at != null ? $item->created_at->diffForHumans() : 'N/A'}}</td>
                        <td>{{ $item->created_at != null ? $item->updated_at->diffForHumans() : 'N/A'}}</td>
                        <td class="text-center">
                            <a href="{{ url('/category-edit') }}/{{ $item->id }}" class="btn btn-purple">Edit</a>
                            <a href="{{ url('/category-delete') }}/{{ $item->id }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="5"><button class="btn btn-primary">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div><!-- table-responsive -->
        {{ $blog->links() }}
    </div><!-- card -->
</div>
@endsection
