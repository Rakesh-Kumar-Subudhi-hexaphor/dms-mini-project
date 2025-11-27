<x-backend.app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms/</span>Add Product</h4>
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6 mb-3" id="title-section">
                                    <label class="form-label" for="product-name">Product name</label>
                                    <input type="text" id="product-name" name="title" class="form-control"
                                        placeholder="Enter Title" />
                                    @error('title')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3" id="image-section">
                                    <label class="form-label" for="image">Image:</label>
                                    <div class="input-group mb-2">
                                        <input type="file" id="image" name="image" class="form-control"
                                            accept="image/*" />
                                    </div>


                                    <div id="image-preview" style="margin-top: 10px;">
                                        <img id="preview-img" src="#" alt="Image Preview"
                                            style="max-width: 100%; display: none;" />
                                    </div>

                                    @error('image')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3" id="meta-title-section">
                                    <label class="form-label" for="price">Price</label>
                                    <input type="text" id="price" name="price" class="form-control"
                                        placeholder="Enter price" />
                                    @error('price')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3" id="desc-section">
                                    <label class="form-label" for="desc">Description</label>
                                    <textarea name="desc" class="form-control" id="description" rows="10"></textarea>
                                    @error('desc')
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
