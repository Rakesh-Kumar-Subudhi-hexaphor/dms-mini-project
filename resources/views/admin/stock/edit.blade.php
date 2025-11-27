<x-backend.app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Edit Stock</h4>

        <form action="{{ route('admin.stock.update', $stock->id) }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">

                                {{-- SELECT PRODUCT --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Product</label>
                                    <select name="product_id" class="form-control">
                                        <option value="">Select Product</option>

                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"
                                                {{ $product->id == $stock->product_id ? 'selected' : '' }}>
                                                {{ $product->title }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('product_id')
                                        <p class="text-danger text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- QUANTITY --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" name="quantity" value="{{ $stock->quantity }}"
                                        class="form-control" placeholder="Enter quantity">
                                    @error('quantity')
                                        <p class="text-danger text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div> {{-- row --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- BUTTONS --}}
            <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Update</button>
                <a href="{{ route('admin.stock') }}" class="btn btn-label-secondary">Cancel</a>
            </div>

        </form>
    </div>
</x-backend.app-layout>
