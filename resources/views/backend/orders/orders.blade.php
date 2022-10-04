@extends('backend.master')
@section('orders','active show-sub')
@section('order','active')
@section('content')
<div class="table-responsive">
    <div class="row">
      <div class="col-md-6">
        <form action="{{ route('SelectedDateExcelDownload') }}" method="POST">
          @csrf
          <input type="date" data-date-format="dd/mm/yyyy" class="form-control" name="start">
          <input type="date" class="form-control" name="end">
          <input type="submit" class="btn btn-primary" value="Selected Date">
        </form>
      </div>

      <div class="col-md-6">
        <div class="float-right">
          <a class="btn btn-primary" href="{{ route('ExcelDownload') }}"><b> <i class="fa fa-download"></i> Download Excel</b></a>
          <a class="btn btn-primary" href="{{ route('PDFDonwload') }}"><b> <i class="fa fa-download"></i> Download PDF</b></a>
        </div>
      </div>
    </div>
    <table class="table mg-b-0">
      <thead>
        <tr>
            <th class="text-center">SL</th>
            <th class="text-center">Product Name</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Unit Price</th>
            <th class="text-center">Total Unit</th>
            <th class="text-center">Bought</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($orders as $key => $order)
            <tr>
                <td class="text-center">{{ $orders->firstItem() + $key }}</td>
                <td class="text-left">{{ $order->product->title ?? 'N/A' }}</td>
                <td class="text-center">{{ $order->quantity ?? 'N/A' }}</td>
                <td class="text-center">{{ $order->product_unit_price ?? 'N/A' }}</td>
                <td class="text-center">{{ $order->quantity * $order->product_unit_price ?? 'N/A' }}</td>
                <td class="text-center">{{ $order->created_at }}</td>
            </tr>
          @endforeach
      </tbody>
    </table>
    {{ $orders->links() }}
  </div>
@endsection
@section('foorer_js')

@endsection
