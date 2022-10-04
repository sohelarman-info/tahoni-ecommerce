@extends('backend.master')
@section('category','active show-sub')
@section('subcategory-add','active')
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
    <div class="col-xl-10 m-auto mg-xl-t-0">
      <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Add sub Category</h6>
        <form action="{{url('subcategory-post')}}" method="POST">
            @csrf
            <div class="row row-xs">
                <div class="col-sm-8 col-md-12 mg-t-10 mg-sm-t-0">
                    <label>Select Category:</label>
                    <select name="category_id" id="category_id" class="form-control @error('category_name') is-invalid @enderror" >
                        @foreach ($categories as $category)
                        <option class="form-control" value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <label>Type Sub Category:</label>
                    <input type="text" name="subcategory_name" id="subcategory_name" class="form-control @error('category_name') is-invalid @enderror" value="{{ old('subcategory_name') }}" placeholder="Ex: Fashion">
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
