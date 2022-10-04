@extends('backend.master')
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
    <div class="col-xl-12">
      <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
        <h6 class="card-body-title mg-b-20 mg-sm-b-30 text-center">Edit Products</h6>
        <form action="{{ route('ProductUpdate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <label class="col-sm-4 form-control-label">Category: <span class="tx-danger">*</span></label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="hidden" name="product_id" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ $product->id }}" placeholder="Ex: Title">
                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" >
                    <option value>Select One</option>
                    @foreach ($categories as $category)
                        <option @if ($product->category_id == $category->id) selected @endif class="form-control" value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            </div><!-- row -->
            <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label">Sub Category: <span class="tx-danger">*</span></label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <select name="subcategory_id" id="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror" >
                    <option class="form-control" value="{{ $product->subcategory_id }}">{{ $product->subcategory->subcategory_name }}</option>
                </select>
            </div>
            </div><!-- row -->
            <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label">Brand: <span class="tx-danger">*</span></label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <select name="brand_id" id="brand_id" class="form-control @error('brand_id') is-invalid @enderror" >
                    <option value>Select One</option>
                    @foreach ($brands as $brand)
                        <option @if ($product->brand_id == $brand->id) selected @endif class="form-control" value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                    @endforeach
                </select>
            </div>
            </div><!-- row -->
            <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label">Title: <span class="tx-danger">*</span></label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ $product->title }}" placeholder="Ex: Title">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            </div>
            <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label">price: <span class="tx-danger">*</span></label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ $product->price }}" placeholder="$500">
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            </div>
            <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label">Summary: <span class="tx-danger">*</span></label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <textarea style="height: 100px" name="summary" id="summary" rows="2" class="form-control" placeholder="Type Your Summary">{{ $product->summary }}</textarea>
            </div>
            </div>
            <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label">Description: <span class="tx-danger">*</span></label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <textarea style="height: 150px" name="description" id="description" rows="2" class="form-control" placeholder="Enter your address">{{ $product->description }}</textarea>
            </div>
            </div>
            <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label">Thumbnail: <span class="tx-danger">*</span></label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="file" name="thumbnail" id="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" value="{{ old('thumbnail') }}" placeholder="$500">
                    @error('thumbnail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            </div>
            <div class="form-layout-footer mg-t-30 text-center">
                <button class="btn btn-info mg-r-5">Submit Form</button>
                <button class="btn btn-secondary">Cancel</button>
            </div><!-- form-layout-footer -->
        </form>
      </div><!-- card -->
    </div><!-- col-12 -->
  </div><!-- row -->
@endsection

@section('footer_js')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $("#category_id").change(function(){
       if(category_id){
            let category_id = $(this).val();
            $.ajax({
                type:'GET',
                url: '/category/ajax/' + category_id,
                success:function(data){
                    if (data) {
                        $('#subcategory_id').empty();
                        $('#subcategory_id').append('<option>Select SCat</option>');
                        $.each(data,function(key,value){
                            $('#subcategory_id').append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');
                        })
                    } else {
                        $('#subcategory_id').empty();
                    }
                }
            });
       }else{
            $('#subcategory_id').empty();
        }
    })
</script>

@endsection
