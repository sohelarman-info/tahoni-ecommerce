@extends('backend.master')
@section('breadcrumb')
    Users
@endsection
@section('products','active show-sub')
@section('product-list','active')
@section('content')
<div class="container">
    @if (session('ProductAdd'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('ProductAdd') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('ProductUpdate'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('ProductUpdate') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('ProductDelete'))
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            {{ session('ProductDelete') }}
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
        <h6 class="card-body-title text-center">{{ __('View Products List') }} ({{ $product_count }})</h6>
        <a class="text-right" href="{{ route('ProductAdd') }}"><i class="fa fa-plus"></i> Add Products</a>
        <div class="table-responsive">
            <table class="table table-bordered mg-b-0">
                <thead>
                    <tr>
                        <th class="text-center">SL</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>summary</th>
                        <th>Thumbanil</th>
                        <th>Images</th>
                        <th>Size</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product )
                    <tr>
                        <td class="text-center">{{ $products->firstItem()+$key }}</td>
                        <td>{{ $product->title ?? 'N/A' }}</td>
                        <td>{{ $product->price ?? 'N/A' }}</td>
                        <td>{{ $product->summary ?? 'N/A' }}</td>
                        <td width='7%'><img class="img-thumbnail w-5" w-25 src="images/{{ $product->thumbnail ?? 'N/A' }}" alt=""></td>
                        <td width='7%'>
                            @foreach ($product->gallery as $img)
                                <img class="img-thumbnail w-5" w-25 src="{{ asset('gallery/'.$img->created_at->format('Y/m/').$img->product_id.'/'. $img->images) }}" alt="">
                            @endforeach
                        </td>
                        <td width='15%'>
                            @foreach (App\attribute::where('product_id', $product->id)->get() as $test)
                                <span>Size: {{ $test->Size->size_name }}</span><br>
                                <span style="color: red">Color: {{ $test->Color->color_name }}</span><br>
                                <span style="color: black">Quantity: {{ $test->quantity }}</span><br>
                            @endforeach
                        </td>
                        <td width='10%' title="{{ $product->created_at != null ? $product->created_at->format('h:i:sa d-M-Y') : 'N/A'}}">{{ $product->created_at != null ? $product->created_at->diffForHumans() : 'N/A'}}</td>
                        <td width='10%'>{{ $product->updated_at != null ? $product->updated_at->diffForHumans() : 'N/A'}}</td>
                        <td class="text-center" width='15%'>
                            <a href="{{ route('ProductEdit', $product->slug) }}" class="btn btn-outline-secondary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a href="{{ route('ProductImageEdit', $product->slug) }}" class="btn btn-outline-secondary"><i class="fa fa-image" aria-hidden="true"></i></a>
                            <a href="{{ route('ProductDelete', $product->id) }}" class="btn btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
        <!-- table-responsive -->
    </div><!-- card -->

</div>
@endsection
