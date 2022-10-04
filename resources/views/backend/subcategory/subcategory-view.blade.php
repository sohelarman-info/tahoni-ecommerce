@extends('backend.master')
@section('breadcrumb')
    Sub Category
@endsection
@section('category','active show-sub')
@section('subcategory-list','active')
@section('content')
<div class="container">
    @if (session('SubCategoryAdd'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('SubCategoryAdd') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('SubCategoryUpdate'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('SubCategoryUpdate') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('SubCategoryDelete'))
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            {{ session('SubCategoryDelete') }}
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
        <h6 class="card-body-title text-center">{{ __('View Sub Category') }}</h6>
        <p class="mg-b-20 mg-sm-b-30 flaot-right"><a href="{{ url('subcategory-add') }}"><i class="fa fa-plus"> {{ __('Add Sub Category') }}</i></a></p>

        <div class="table-responsive">
            <table class="table table-bordered mg-b-0">
                <thead>
                    <tr>
                        <th class="text-center">SL</th>
                        <th>Sub Category Name</th>
                        <th>Slug</th>
                        <th>Category Name</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scategories as $key => $item )
                    <tr>
                        <td class="text-center">{{ $scategories->firstItem() + $key }}</td>
                        <td title="{{ $item->id ?? 'N/A' }}">{{ $item->subcategory_name ?? 'N/A' }}</td>
                        <td>{{ $item->slug ?? 'N/A' }}</td>
                        <td>{{ $item->get_category->category_name ?? 'N/A' }}</td>
                        <td title="{{ $item->created_at != null ? $item->created_at->format( 'Y-m-d (h:i:sa)' ) : 'N/A'}}">{{ $item->created_at != null ? $item->created_at->diffForHumans() : 'N/A'}}</td>
                        <td title="{{ $item->updated_at != null ? $item->created_at->format( 'Y-m-d (h:i:sa)' ) : 'N/A'}}">{{ $item->updated_at != null ? $item->updated_at->diffForHumans() : 'N/A'}}</td>
                        <td class="text-center">
                            {{-- Use Url Method --}}
                            {{-- <a href="{{ url('subcategory-edit') }}/{{ $item->slug }}" class="btn btn-purple">Edit</a> --}}

                            {{-- Use Route Method --}}
                            <a href="{{ route('SubCategoryEdit', $item->slug) }}" class="btn btn-purple">Edit</a>
                            <a href="{{ url('/subcategory-delete') }}/{{ $item->id }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- table-responsive -->
    </div><!-- card -->
</div>
@endsection
