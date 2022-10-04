@extends('backend.master')
@section('breadcrumb')
    Category
@endsection
@section('category','active show-sub')
@section('category-list','active')
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
    <div class="card pd-10 pd-sm-10 mg-t-10">
        <div class="row">
            <div class="col-md-12">
                <div class="from-control">
                  <form action="{{ route('ExcelImport') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="file" style="border: 1px solid #DEE2E6; padding: 6px" name="excel">
                      <input type="submit" class="btn btn-primary" value="Upload Excel">
                  </form>
                </div>
            </div>
        </div>
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
                    <form action="{{ route('SelectCategoryDelete') }}" method="POST">
                        @csrf
                        @foreach ($categories as $key => $cat )
                        <tr>
                            <td class="text-center"><input type="checkbox" name="cat_id[]" value="{{ $cat->id }}"></td>
                            <td class="text-center">{{ $categories->firstItem()+$key }}</td>
                            <td>{{ $cat->category_name ?? 'N/A' }}</td>
                            <td>{{ $cat->slug ?? 'N/A' }}</td>
                            <td>{{ $cat->created_at != null ? $cat->created_at->diffForHumans() : 'N/A'}}</td>
                            <td>{{ $cat->created_at != null ? $cat->updated_at->diffForHumans() : 'N/A'}}</td>
                            <td class="text-center">
                                <a href="{{ url('/category-edit') }}/{{ $cat->id }}" class="btn btn-purple">Edit</a>
                                <a href="{{ url('/category-delete') }}/{{ $cat->id }}" class="btn btn-danger">Delete</a>
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
        {{ $categories->links() }}
    </div><!-- card -->

    {{-- <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header text-center bg-primary">{{ __('View Category') }}</div>
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
                <div class="card-header text-center bg-success">{{ __('Add Category') }}</div>
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
                    <form action="{{url('category-post')}}" method="POST">
                      @csrf
                      <div class="form-group">
                        <label for="category_name">Category</label>
                        <input type="text" name="category_name" id="category_name" class="form-control @error('category_name') is-invalid @enderror" value="{{ old('category_name') }}" placeholder="Ex: Fashion">
                        @error('category_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="text-center">
                          <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection


@section('footer_js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          @if (session('CategoryAddAlart'))
            Toast.fire({
                icon: 'error',
                title: '{{ session('CategoryAddAlart') }}'
            })
          @endif
          @if (session('CategoryDelete'))
            Toast.fire({
                icon: 'success',
                title: '{{ session('CategoryDelete') }}'
            })
          @endif

          $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
