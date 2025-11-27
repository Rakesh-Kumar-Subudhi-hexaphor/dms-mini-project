<x-backend.app-layout>
    <style>
        .tag {
            display: inline-block;
            padding: 5px 10px;
            margin: 5px;
            background-color: blue;
            color: white;
            border-radius: 5px;
        }
    </style>
    <div class="bg-white m-3 p-3">
        <div id="success-msg"
            style="display:none; position:fixed; top:10px; right:10px; 
     background:green; color:white; padding:10px; border-radius:5px; z-index:1000;">
        </div>
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
                            <th>Order stock Status</th>
                            <th>Permission</th>
                            <th>Payment Status</th>
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
                                <td>
                                    @php
                                        // Total stock for this product
                                        $totalStock = $order->product->stocks->sum('quantity');
                                    @endphp

                                    @if ($order->order_qty_status == 'hold')
                                        @if ($totalStock >= $order->unit)
                                            <span class="badge bg-primary">Resume</span>
                                        @else
                                            <span class="badge bg-danger">Hold (No Stocks)</span>
                                        @endif
                                    @elseif ($order->order_qty_status == 'resume')
                                        <span class="badge bg-primary">Resume</span>
                                    @endif
                                </td>


                                <td>
                                    <select class="permission-dropdown" data-id="{{ $order->id }}">
                                        <option value="pending" {{ $order->permission == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="approved"
                                            {{ $order->permission == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected"
                                            {{ $order->permission == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </td>


                                <td>
                                    @if ($order->status == 'unpaid')
                                        <select class="payment-status-dropdown" data-id="{{ $order->id }}">
                                            <option value="unpaid" selected>Unpaid</option>
                                            <option value="Paid">Paid</option>
                                        </select>
                                    @else
                                        <span style="color: green; font-weight: bold;">Paid</span>
                                    @endif
                                </td>


                                <!-- Order Status Dropdown -->
                                <td>
                                    @php $stages = ['Pending', 'Processing', 'Dispatched', 'Delivered']; @endphp
                                    <select class="status-dropdown select-control" data-id="{{ $order->id }}">
                                        @foreach ($stages as $stage)
                                            <option value="{{ $stage }}"
                                                {{ $stage === $order->order_status ? 'selected' : '' }}
                                                {{ array_search($stage, $stages) < array_search($order->order_status, $stages) ? 'disabled' : '' }}>
                                                {{ $stage }}
                                            </option>
                                        @endforeach
                                    </select>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script>
        $(document).ready(function() {

            // Permission dropdown change
            $('.permission-dropdown').change(function() {
                let el = $(this);
                let orderId = el.data('id');
                let permission = el.val();

                $.ajax({
                    url: '/orders/' + orderId + '/permission',
                    type: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}',
                        permission: permission
                    },
                    success: function(res) {
                        // Change color
                        if (permission == 'approved') el.css('color', 'green');
                        else if (permission == 'rejected') el.css('color', 'red');
                        else el.css('color', 'orange');

                        // Disable after selection
                        el.prop('disabled', true);

                        // Show success message
                        $('#success-msg').text('Permission updated successfully!').fadeIn()
                            .delay(2000).fadeOut();
                    },
                    error: function() {
                        $('#success-msg').text('Something went wrong!').css('background', 'red')
                            .fadeIn().delay(2000).fadeOut();
                    }
                });
            });

            $('.status-dropdown').change(function() {
                let el = $(this);
                let orderId = el.data('id');
                let order_status = el.val(); // define variable

                $.ajax({
                    url: '/orders/' + orderId + '/order-status',
                    type: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}',
                        order_status: order_status
                    },
                    success: function(res) {
                        // Disable all previous stages
                        el.find('option').each(function() {
                            if ($(this).index() < el.prop('selectedIndex')) {
                                $(this).prop('disabled', true);
                            }
                        });

                        $('#success-msg').text('Order status updated successfully!').fadeIn()
                            .delay(2000).fadeOut();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // log the exact Laravel error
                        $('#success-msg').text('Something went wrong!').css('background', 'red')
                            .fadeIn().delay(2000).fadeOut();
                    }
                });
            });

            // Payment Status dropdown change
            $('.payment-status-dropdown').change(function() {
                let el = $(this);
                let orderId = el.data('id');
                let payment_status = el.val();

                $.ajax({
                    url: '/orders/' + orderId + '/payment-status',
                    type: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: payment_status
                    },
                    success: function(res) {

                        if (payment_status == 'Paid') {
                            // Replace dropdown with green Paid text
                            el.parent().html(
                                '<span style="color: green; font-weight: bold;">Paid</span>'
                            );
                        }

                        $('#success-msg').text('Payment status updated!').fadeIn()
                            .delay(2000).fadeOut();
                    },
                    error: function() {
                        $('#success-msg').text('Update failed!').css('background', 'red')
                            .fadeIn().delay(2000).fadeOut();
                    }
                });
            });

            $('.resume-btn').click(function() {
                let orderId = $(this).data('id');

                $.ajax({
                    url: '/orders/' + orderId + '/resume-qty',
                    type: 'PATCH',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        location.reload();
                    },
                    error: function() {
                        alert("Failed to resume order!");
                    }
                });
            });

        });
    </script>
</x-backend.app-layout>
