<x-admin-layout>
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Products</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Products</li>
                            
                            @if (request()->path() === 'product/create')
                                <li class="breadcrumb-item active" aria-current="page">Create</li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                            @endif
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
        
                    <form action="{{ (request()->path() === 'product/create') ? route('admin.product.store') : route('admin.product.update' , $product) }}" method="post" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        @if (request()->path() !== 'product/create')
                            @method('PUT')
                        @endif
        
                        <div class="col-md-4">
                            <label for="input1" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="input1" name="name" value="{{ old('name') ?? $product->name ?? null }}">
                            
                            <x-error name="name"/>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="input1" class="form-label">Product Price</label>
                            <input type="number" class="form-control" id="input1" name="price" value="{{ old('price') ?? $product->price ?? null }}">
                            
                            <x-error name="price"/>
                        </div>

                        <div class="col-md-4">
                            <label for="input1" class="form-label">Product Quantity</label>
                            <input type="number" class="form-control" id="input1" name="quantity" value="{{ old('quantity') ?? $product->quantity ?? null }}">
                        
                            <x-error name="quantity"/>
                        </div>
        
                        <div class="col-md-12">
                            <label for="input11" class="form-label">Product Description</label>
                            <textarea class="form-control" name="description" id="myeditorinstance" >{!! old('description') ?? $product->description ?? null !!}</textarea>
                        
                            <x-error name="description"/>
                        </div>



                        <div class="col-md-6">
                            <label for="input4" class="form-label">Main Image</label>
                            <input type="file" name="image" class="form-control mb-3" id="image" >
                            
                            <x-error name="image"/>

                            @if (request()->path() !== 'product/create')
                                <img id="showImage" src="{{ $product->oldestImage->url() }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="80">
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label for="input5" class="form-label">Gallery Image</label>
                            <input type="file" name="images[]" class="form-control mb-3" id="multiImg" multiple accept="image/jpeg , image/jpg , image/gif , image/png">
                            
                            <x-error name="images"/>

                            @if (request()->path() !== 'product/create')
                                @foreach ($product->images->except($product->oldestImage->id) as $image)
                                    <img src="{{ $image->url() }}" alt="Admin" class="bg-primary mx-1 mb-2" width="60">
                                @endforeach
                            @endif
                        </div>

                        
                        
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">{{ (request()->path() == 'product/create') ? "Create New product" : 'Update product' }}</button>
                            </div>
                        </div>
        
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>