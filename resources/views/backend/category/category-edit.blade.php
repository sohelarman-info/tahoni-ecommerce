@extends('backend.master')
@section('content')
<div class="row row-sm mg-t-10">
    <div class="col-xl-6">
        <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
            <h6 class="card-body-title text-center m-b-20">Edit Your Category</h6>
            <div class="row">
                <div class="col-sm-12 mg-t-20 mg-sm-t-0">
                    <form action="{{ url('category-update') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $edit_category->id }}" name="id">
                        <input type="text" class="form-control" value="{{ $edit_category->category_name }}" id="category_name" name="category_name" placeholder="{{ $edit_category->category_name }}">
                        <div class="form-layout-footer mg-t-30 text-center">
                            <button class="btn btn-info mg-r-5" style="cursor: pointer">Submit Form</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div>
            </div><!-- row -->
        </div><!-- card -->
    </div><!-- col-6 -->
    <div class="col-xl-6 mg-t-25 mg-xl-t-0">
        <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Category Details</h6>
            <table class="table table-bordered mg-b-0">
                <tbody>
                    <tr>
                        <td>{{ __('Category Name') }}</td>
                        <td>{{ $edit_category->category_name }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Category Slug') }}</td>
                        <td>{{ $edit_category->slug }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Category Created') }}</td>
                        <td>{{ $edit_category->created_at }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Category Updated') }}</td>
                        <td>{{ $edit_category->updated_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- card -->
</div>




{{--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header text-center bg-primary">{{ __('View Edieted Category') }}</div>
                <div class="card-body">
                    @if (session('CategoryRestore'))
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            {{ session('CategoryRestore') }}
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
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="text-center">Serial</th>
                          <th class="text-center">Name</th>
                          <th class="text-center">Slug</th>
                          <th class="text-center">Created_at</th>
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $key => $cat)
                            <tr>
                                <!--$loop->index + 1-->
                                <th class="text-center">{{$categories->firstItem() + $key }}</th>
                                <td>{{ $cat->category_name ?? 'N/A'}}</td>
                                <td>{{ $cat->slug ?? 'N/A'}}</td>
                                <td>{{ $cat->created_at != null ? $cat->created_at->diffForHumans() : 'N/A'}}</td>
                                <td class="text-center">
                                    <a href="{{ url('/category-edit') }}/{{ $cat->id }}" class="btn btn-outline-primary">Edit</a>
                                    <a href="{{ url('/category-delete') }}/{{ $cat->id }}" class="btn btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
            <div class="card">
                <div class="card-header text-center bg-danger">{{ __('Deleted Category') }}</div>
                <div class="card-body">
                    @if (session('CategoryDelete'))
                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                            {{ session('CategoryDelete') }}
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
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="text-center">Serial</th>
                          <th class="text-center">Name</th>
                          <th class="text-center">Slug</th>
                          <th class="text-center">Created_at</th>
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($trash_category as $t_cat)
                            <tr>
                                <th class="text-center">{{ $loop->index + 1 }}</th>
                                <td>{{ $t_cat->category_name ?? 'N/A'}}</td>
                                <td>{{ $t_cat->slug ?? 'N/A'}}</td>
                                <td>{{ $t_cat->created_at != null ? $t_cat->created_at->diffForHumans() : 'N/A'}}</td>
                                <td class="text-center">
                                    <a href="{{ url('category-restore') }}/{{ $t_cat->id }}" class="btn btn-outline-success">Undo</a>
                                    <a href="{{ url('/category-permanent-delete') }}/{{ $t_cat->id }}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-outline-danger">Permanent Delete</a>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center bg-success">{{ __('Edit Category') }}</div>
                @if (session('CategoryAdd'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('CategoryAdd') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{url('category-update')}}" method="POST">
                      @csrf
                      <div class="form-group">
                          <input type="hidden" value="{{ $edit_category->id }}" name="id">
                        <label for="category_name">Category</label>
                        <input type="text" class="form-control" value="{{ $edit_category->category_name }}" id="category_name" name="category_name" placeholder="Ex: Fashion">
                      </div>
                      <div class="text-center">
                          <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
