<x-backend.app-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms/</span>Edit Product</h4>

        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">

                            <div class="row g-3">



                                <div class="col-md-6 mb-3" id="title-section">
                                    <label class="form-label" for="product-name">Product name</label>
                                    <input type="text" id="product-name" name="title"
                                        value="{{ old('title', $product->title) }}" class="form-control"
                                        placeholder="Enter Title" />
                                    @error('title')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6" id="image-section">
                                    <label class="form-label" for="multicol-username">Image</label>
                                    <div class="input-group">
                                        <input type="file" id="multicol-username" name="image"
                                            class="form-control" />
                                    </div>

                                    @error('image')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                    @if ($product->image)
                                        <img src="{{ asset($product->image) }}" alt="Current Image" class="mt-3"
                                            style="max-width: 100px;">
                                    @endif
                                </div>


                                <div class="col-md-6 mb-3" id="meta-title-section">
                                    <label class="form-label" for="price">Price</label>
                                    <input type="text" id="price" name="price"
                                        value="{{ old('price', $product->price) }}" class="form-control"
                                        placeholder="Enter price" />
                                    @error('price')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description Section -->
                                <div class="col-md-12" id="desc-section">
                                    <label class="form-label" for="desc">Description</label>
                                    <textarea name="desc" class="form-control" id="description" cols="30" rows="10">{{ old('desc', $product->desc) }}</textarea>
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

</x-backend.app-layout>
