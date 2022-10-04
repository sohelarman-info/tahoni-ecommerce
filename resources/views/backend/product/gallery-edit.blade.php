@extends('backend.master')
@section('content')
@if (session('ImageAdd'))
<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
    {{ session('ImageAdd') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session('ImageDelete'))
<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
    {{ session('ImageDelete') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="row row-sm mg-t-20">
    <div class="col-xl-12">
      <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
        <h6 class="card-body-title mg-b-20 mg-sm-b-30 text-center">Edit Products</h6>
        <form action="{{ route('MultiImgUpadate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="hidden" name="product_id" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ $product->id }}">
            </div>
            </div>

            {{-- Loop Images --}}
            @foreach ($gallery as $img)
            <div class="row mg-t-20">
                <label class="col-sm-2 form-control-label">Thumbnail: ({{ $product->id }}->{{ $img->id }})</label>
                <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                    <input type="file" name="images[]" id="MultiImage" class="form-control @error('MultiImage') is-invalid @enderror" value="{{ old('thumbnail') }}" placeholder="$500">
                        @error('MultiImage')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="col-sm-2 mg-t-10 mg-sm-t-0 text-center">
                    <img style="width: 50px" class="img-thumbnail w-1" src="{{ asset('gallery/'.$img->created_at->format('Y/m/').$img->product_id.'/'.$img->images) }}" alt="">
                </div>
                <div class="col-sm-2 mg-t-10 mg-sm-t-0 text-center">
                    <a class="btn btn-danger" href="{{ route('GalleryImageDelete', $img->id )}}">Delete</a>
                </div>
            </div>
            @endforeach
            <div class="row mg-t-20">
                <label class="col-sm-2 form-control-label">Images:</label>
                <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                    <input type="file" name="images[]" id="MultiImage" class="form-control @error('MultiImage') is-invalid @enderror" value="{{ old('thumbnail') }}" placeholder="$500">
                        @error('MultiImage')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-2 form-control-label">Multiple Image:</label>
                <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                    <input type="file" name="images[]" id="MultiImage" class="form-control @error('MultiImage') is-invalid @enderror" value="{{ old('thumbnail') }}" placeholder="$500">
                        @error('MultiImage')
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
