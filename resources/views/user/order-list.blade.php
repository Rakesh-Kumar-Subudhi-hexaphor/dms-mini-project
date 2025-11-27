<x-user.app-layout>
   
    <div class="bg-white m-3 p-3">
      
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Order</h4>
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="datatables-users table border-top">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Order No.</th>
                            <th>User name</th>
                            <th>Product Name</th>
                            <th>Units</th>
                            <th>Total Price</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Permission</th>
                            <th>Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->order_no }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->product->title ?? 'N/A' }}</td>
                                <td>{{ $order->unit }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>{{ $order->status }}</td>
                                <td>
                                    {{ $order->permission }}
                                </td>
                                <td>
                                    {{ $order->order_status }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-user.app-layout>
