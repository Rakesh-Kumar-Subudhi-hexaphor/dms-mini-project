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
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Stock</h4>

        <a href="{{ route('admin.stock.create') }}" class="btn btn-primary mb-2">+ Create</a>
        <!-- Role Table -->
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="datatables-users table border-top">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($stocks as $stock)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $stock->product->title ?? 'N/A' }}</td>

                                <td>{{ $stock->quantity }}</td>
                                <td>
                                    <a href="{{ route('admin.stock.edit', $stock->id) }}"
                                        class="btn btn-info">Edit</a>
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
