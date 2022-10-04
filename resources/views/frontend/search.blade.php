@extends('frontend.master')
@section('content')
<form action="{{ route('Search') }}" method="GET" enctype="multipart/form-data">
    @csrf
    <input type="text" style="border: 1px solid #DEE2E6; padding: 6px" name="query">
    <input type="submit" class="btn btn-primary" value="Search Category">
</form>
<div class="card pd-10 pd-sm-10 mg-t-10">
    <h6 class="card-body-title text-center">{{ __('View Category') }}</h6>
    <div class="table-responsive">
        <table class="table table-bordered mg-b-0">
            <thead>
                <tr>
                    <td class="text-center"><input type="checkbox" id="checkAll"> ALL</td>
                    <th class="text-center">SL</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <form action="" method="POST">
                    @csrf
                    @foreach ($products as  $cat )
                    <tr>
                        <td class="text-center"><input type="checkbox" name="cat_id[]" value="{{ $cat->id }}"></td>
                        <td class="text-center">{{ $products->firstItem()+$key }}</td>
                        <td>{{ $cat->category_name ?? 'N/A' }}</td>
                        <td>{{ $cat->slug ?? 'N/A' }}</td>
                        <td>{{ $cat->created_at != null ? $cat->created_at->diffForHumans() : 'N/A'}}</td>
                        <td>{{ $cat->created_at != null ? $cat->updated_at->diffForHumans() : 'N/A'}}</td>
                        <td class="text-center">
                            <a href="" class="btn btn-purple">Edit</a>
                            <a href="" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="5"><button class="btn btn-primary">Delete</button></td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div><!-- table-responsive -->
</div>
@foreach ($products as $item)
    <div class="">{{ $item->title }}</div>
@endforeach
@endsection
