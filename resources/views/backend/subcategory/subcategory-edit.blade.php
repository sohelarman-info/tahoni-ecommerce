@extends('backend.master')
@section('category','active show-sub')
@section('active','active')
@section('content')
<div class="row row-sm">
    <div class="col-xl-6">
        <div class="card pd-5 pd-sm-40 form-layout form-layout-4">
            <h6 class="card-body-title text-center">{{ __('Edit Your Category') }}</h6>
            <div class="row">
                <div class="col-sm-12 mg-t-20 mg-sm-t-0">
                    <form action="{{ url('subcategory-update') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $scategories->id }}" name="id">
                        <input type="text" class="form-control" value="{{ $scategories->subcategory_name }}" id="subcategory_name" name="subcategory_name" placeholder="">
                        <label>Select Category:</label>
                        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" >
                            @foreach ($categories as $category)
                            <option @if ($category->id == $scat->category_id) selected @endif class="form-control" value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
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
                        <td>{{ __('Sub Category ID') }}</td>
                        <td>{{ $scategories->id }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Category ID') }}</td>
                        <td>{{ $scategories->category_id }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Category Name') }}</td>
                        <td>{{ $scategories->get_category->category_name }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Sub Category Name') }}</td>
                        <td>{{ $scategories->subcategory_name }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Sub Category Slug') }}</td>
                        <td>{{ $scategories->slug }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Sub Category Created') }}</td>
                        <td>{{ $scategories->created_at }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Sub Category Updated') }}</td>
                        <td>{{ $scategories->updated_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- card -->
</div>
@endsection

