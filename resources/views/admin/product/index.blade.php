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
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Product</h4>

        <a href="{{ route('admin.product.create') }}" class="btn btn-primary mb-2">+ Create</a>
        <!-- Role Table -->
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="datatables-users table border-top">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>


                                <td>{{ $product->title }}</td>
                                <td>

                                    <a href="{{ asset($product->image) }}">
                                        <img src="{{ asset($product->image) }}" class="w-px-40 h-auto rounded-circle"
                                            alt="product Image">
                                    </a>


                                </td>


                                <td>{{ $product->price }}</td>

                                <td>
                                    <div class="d-flex justify-content-start" style="gap: 7px;">
                                        <a href="{{ route('admin.product.edit', $product->id) }}"
                                            class="btn btn-info mr-2">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="{{ route('admin.product.delete', $product->id) }}"
                                            class="btn btn-danger mr-2">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </a>
                                    </div>

                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Role Table -->
    </div>
</x-backend.app-layout>
