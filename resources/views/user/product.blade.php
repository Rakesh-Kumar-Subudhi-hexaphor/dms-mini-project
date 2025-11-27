<x-user.app-layout>
    <style>
        .product-card {
            /* width: 320px; */
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
            padding: 15px;
            transition: all 0.3s ease;
            border: 1px solid #eee;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.15);
        }

        .product-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
        }

        .product-title {
            font-size: 20px;
            font-weight: 600;
            margin: 12px 0 6px;
            color: #333;
        }

        .product-desc {
            font-size: 14px;
            color: #777;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-price {
            font-size: 18px;
            font-weight: 700;
            color: #1a73e8;
        }

        .order-btn {
            padding: 10px 18px;
            background: #1a73e8;
            color: #fff;
            border: none;
            outline: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .order-btn:hover {
            background: #0f57b3;
        }
    </style>

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row mb-6">
            <!-- Browser Default -->
            <div class="col-md-12 mb-6 mb-md-0">
                <div class="card">
                    <h5 class="card-header">Product List</h5>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-lg-4">
                                    <div class="product-card">
                                        <img src="{{ asset($product->image) }}" class="product-img" alt="Product">

                                        <h3 class="product-title">{{ $product->title }}</h3>

                                        <p class="product-desc">
                                            {{ $product->desc }}
                                        </p>

                                        <div class="product-footer">
                                            <span class="product-price">${{ $product->price }}</span>

                                            <!-- Button to open modal -->
                                            <button class="order-btn" data-bs-toggle="modal"
                                                data-bs-target="#orderModal{{ $product->id }}">
                                                Place Order
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- ORDER MODAL -->
                                <div class="modal fade" id="orderModal{{ $product->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Place Order - {{ $product->title }}</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>

                                            <form action="{{ route('order.store') }}" method="POST"
                                                id="orderForm{{ $product->id }}">
                                                @csrf

                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="price"
                                                    id="hiddenTotal{{ $product->id }}">
                                                <input type="hidden" name="unit" id="unit{{ $product->id }}">
                                                <input type="hidden" name="status" id="status{{ $product->id }}">
                                                <input type="hidden" name="permission" value="Pending">
                                                <input type="hidden" name="razorpay_payment_id"
                                                    id="rpPayId{{ $product->id }}">
                                                <input type="hidden" name="payment_method"
                                                    id="paymentMethodHidden{{ $product->id }}">

                                                <div class="modal-body">

                                                    <!-- ⭐ Product Price -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Price (Per Unit)</label>
                                                        <input type="text" class="form-control"
                                                            value="₹{{ $product->price }}" readonly>

                                                        <!-- hidden numeric price (IMPORTANT!!) -->
                                                        <input type="hidden" id="price{{ $product->id }}"
                                                            value="{{ $product->price }}">
                                                    </div>

                                                    <!-- ⭐ Quantity -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Quantity / Unit</label>
                                                        <input type="number" class="form-control" min="1"
                                                            id="qty{{ $product->id }}"
                                                            oninput="updateTotal({{ $product->id }})" required>
                                                    </div>

                                                    <!-- ⭐ Total Price -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Total Price</label>
                                                        <input type="text" class="form-control"
                                                            id="total{{ $product->id }}" readonly>
                                                    </div>

                                                    <!-- ⭐ Payment Method -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Payment Method</label>
                                                        <select class="form-select"
                                                            id="paymentMethod{{ $product->id }}" required>
                                                            <option value="cod">Cash On Delivery</option>
                                                            <option value="online">Online Payment</option>
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="submitOrder({{ $product->id }})">
                                                        Submit Order
                                                    </button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>



                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        function updateTotal(id) {

            let price = parseFloat(document.getElementById('price' + id).value);
            let qty = parseInt(document.getElementById('qty' + id).value);

            if (!qty || qty < 1) qty = 0;

            let total = price * qty;

            document.getElementById('total' + id).value = "₹" + total.toFixed(2);

            document.getElementById('hiddenTotal' + id).value = total.toFixed(2);
            document.getElementById('unit' + id).value = qty;
        }


        // MAIN SUBMISSION
        function submitOrder(id) {

            let method = document.getElementById('paymentMethod' + id).value;

            // ⭐ Store payment method into hidden field
            document.getElementById('paymentMethodHidden' + id).value = method;

            // COD ------------------------
            if (method === "cod") {
                document.getElementById('status' + id).value = "unpaid";
                document.getElementById('orderForm' + id).submit();
                return;
            }

            // ONLINE PAYMENT -------------
            if (method === "online") {

                let amount = parseFloat(document.getElementById('hiddenTotal' + id).value) * 100;

                let options = {
                    "key": "{{ env('RAZORPAY_KEY') }}",
                    "amount": amount,
                    "currency": "INR",
                    "name": "Product Purchase",
                    "description": "Order Payment",

                    "handler": function(response) {

                        document.getElementById('rpPayId' + id).value = response.razorpay_payment_id;

                        // Payment was online → paid
                        document.getElementById('status' + id).value = "paid";

                        // ⭐ Save payment_method into hidden field
                        document.getElementById('paymentMethodHidden' + id).value = "online";

                        document.getElementById('orderForm' + id).submit();
                    }
                };

                let rzp = new Razorpay(options);
                rzp.open();
            }
        }
    </script>


</x-user.app-layout>
