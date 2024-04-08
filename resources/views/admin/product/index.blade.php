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
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="d-flex align-items-center">    
                <h6 class="mb-0 text-uppercase">Products</h6>

                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
                            Create New Product
                        </a>
                    </div>
                </div>
            </div>

            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>price</th>
                                    <th>quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ Str::words($product->name , 3) }}</td>
                                        
                                        <td><img src="{{ $product->oldestImage->url() ?? null }}" alt="" width="90" height="60"></td>
                                        
                                        <td>{!! Str::words($product->description , 3) !!}</td>
                                        <td>{{ number_format($product->price) }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>
                                            @can('update', $product)
                                                <a href="{{ route('admin.product.edit' , $product) }}" class="btn btn-outline-warning px-3 radius-30">Edit</a>
                                            @endcan
                                            @can('delete', $product)
                                                <a onclick="event.preventDefault();document.getElementById('deleteCategorie{{ $product->id }}').submit()" href="#" class="btn btn-outline-danger px-3 radius-30" id="delete">Delete</a>
                                                <form action="{{ route('admin.product.destroy' , $product) }}" method="post" id="deleteCategorie{{ $product->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>           
                                @endforeach                   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-admin-layout>