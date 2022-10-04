<table width='100%' style="border: 1px solid #000">
    <thead style="border: 1px solid #000">
    <tr> style="border: 1px solid #000"
        <th style="padding: 5px; border: 1px solid #000; background: #333; color: #fff">SL</th>
        <th style="padding: 5px; border: 1px solid #000; background: #333; color: #fff">Product Name</th>
        <th style="padding: 5px; border: 1px solid #000; background: #333; color: #fff">Product Price</th>
        <th style="padding: 5px; border: 1px solid #000; background: #333; color: #fff">Quantity</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td style="padding: 5px; border: 1px solid #000; text-align:center">{{ $loop->index + 1 }}</td>
            <td style="padding: 5px; border: 1px solid #000">{{ $order->product->title }}</td>
            <td style="padding: 5px; border: 1px solid #000; text-align:center">{{ $order->product_unit_price }}</td>
            <td style="padding: 5px; border: 1px solid #000; text-align:center">{{ $order->quantity }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
