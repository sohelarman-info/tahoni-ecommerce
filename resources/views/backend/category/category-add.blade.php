@extends('backend.master')
@section('category','active show-sub')
@section('category-add','active')
@section('content')
@if (session('CategoryAdd'))
<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
    {{ session('CategoryAdd') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="row row-sm mg-t-20">
    <div class="col-xl-6">
      <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
        <div class="table-responsive">
            <table class="table table-bordered mg-b-0">
              <thead>
                <tr>
                  <th class="text-center">SL</th>
                  <th>Name</th>
                  <th>Created At</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($categories as $key => $cat)
                  <tr>
                    <td class="text-center">{{ $categories->firstItem() + $key }}</td>
                    <td>{{ $cat->category_name ?? 'N/A' }}</td>
                    <td>{{ $cat->created_at != null ? $cat->created_at->diffForHumans() : 'N/A' }}</td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>

      </div><!-- card -->
    </div><!-- col-6 -->
    <div class="col-xl-6 mg-t-25 mg-xl-t-0">
      <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Add Category</h6>
        <form action="{{url('category-post')}}" method="POST">
            @csrf
            <div class="row row-xs">
                <div class="col-sm-8 col-md-12 mg-t-10 mg-sm-t-0">
                    <input type="text" name="category_name" id="category_name" class="form-control @error('category_name') is-invalid @enderror" value="{{ old('category_name') }}" placeholder="Ex: Fashion">
                    @error('category_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><!-- row -->
            <div class="row row-xs mg-t-10">
            <div class="col-md-12 mg-l-auto">
                <div class="form-layout-footer text-center">
                <button class="btn btn-info" style="cursor: pointer">Submit Form</button>
                </div><!-- form-layout-footer -->
            </div><!-- col-8 -->
            </div>
        </form>
      </div><!-- card -->
    </div><!-- col-6 -->
  </div><!-- row -->

@endsection
