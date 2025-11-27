<x-backend.app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms/</span>Add Stock</h4>
        <form action="{{ route('admin.stock.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6 mb-3" id="title-section">
                                    <label class="form-label" for="product-name">Product</label>
                                    <select name="product_id" class="form-control" id="">
                                        <option value="">Select Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                                        @endforeach
                                    </select>

                                    @error('product_id')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>



                                <div class="col-md-6 mb-3" id="meta-title-section">
                                    <label class="form-label" for="quantity">Quantity</label>
                                    <input type="number" id="quantity" name="quantity" class="form-control"
                                        placeholder="Enter quantity" />
                                    @error('quantity')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                <button type="reset" class="btn btn-label-secondary">Cancel</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const input = event.target;
            const preview = document.getElementById('preview-img');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        });
    </script>

</x-backend.app-layout>
