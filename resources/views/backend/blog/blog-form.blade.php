@extends('backend.master')
@section('blog','active show-sub')
@section('blog-add','active')
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
        <h6 class="card-body-title mg-b-20 mg-sm-b-30 text-center">Add Products</h6>
        <form action="{{ route('Blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <label class="col-sm-4 form-control-label">Category: <span class="tx-danger">*</span></label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" >
                    @foreach ($categories as $category)
                    <option class="form-control" value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            </div><!-- row -->
            <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label">Sub Category: <span class="tx-danger">*</span></label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <select name="subcategory_id" id="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror" >
                    @foreach ($scat as $sc)
                    <option class="form-control" value="{{ $sc->id }}">{{ $sc->subcategory_name }}</option>
                    @endforeach
                </select>
            </div>
            </div><!-- row -->
            <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label">Title: <span class="tx-danger">*</span></label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Ex: Title">
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
                <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="$500">
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            </div>
            <div class="row mg-t-20">
            <label for="my-editor" class="col-sm-4 form-control-label">Summary: <span class="tx-danger">*</span></label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <textarea name="summary" id="my-editor" rows="2" class="form-control" placeholder="Type Your Summary"></textarea>
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

 <script>
    function addInput(divName, template){
          var newdiv = document.createElement('div');
          newdiv.innerHTML = document.getElementById(divName).innerHTML;
          document.getElementById(template).appendChild(newdiv);
    }
    </script>
    {{-- <a href="#" onClick="addInput('template', 'add_more_item');">+ Add more</a> --}}
@endsection
@section('footer_js')
<script src="//cdn.ckeditor.com/4.6.2/full-all/ckeditor.js"></script>
<script>
  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
  CKEDITOR.replace('my-editor', options);
</script>
@endsection






