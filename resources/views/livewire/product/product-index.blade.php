<div>
    @livewire('component.page.breadcrumb', ['breadcrumbs' => [['name' => 'Product', 'url' => '/']]])


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box me-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Search..." wire:model.live="search">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end">
                                <a href="{{ route('product.create') }}"
                                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i
                                        class="mdi mdi-plus me-1"></i> Add New Product</a>
                            </div>
                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap table-check">
                            <thead class="table-light">
                                <tr>
                                    <th class="align-middle">
                                        Images
                                    </th>
                                    <th class="align-middle">Product Name</th>
                                    <th class="align-middle">Category Name</th>
                                    <th class="align-middle">Price</th>
                                    <th class="align-middle">Status</th>
                                    <th class="align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <div class="avatar-group">
                                                @if ($product->images->count() > 0)
                                                    @foreach ($product->images as $image)
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block">
                                                                <img src="{{ $image->image_url }}" alt=""
                                                                    class="rounded-circle avatar-xs">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </td>
                                        <td><a href="{{ route('product.edit', $product->id) }}">{{ $product->name }}</a>
                                            </td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>Rp {{ $product->price }}</td>
                                        <td>{{ $product->status }}</td>

                                        <td>
                                            <div class="d-flex gap-3">
                                                <a href="{{ route('product.edit', $product->id) }}"
                                                    class="btn btn-success btn-rounded waves-effect waves-light"><i
                                                        class="mdi mdi-pencil font-size-16"></i></a>
                                                <button type="button"
                                                    class="btn btn-danger btn-rounded waves-effect waves-light"><i
                                                        class="mdi mdi-delete font-size-16" wire:click="confirmDelete({{ $product->id }})"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <!-- apexcharts -->
        <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- dashboard init -->
        <script src="{{ asset('js/pages/dashboard.init.js') }}"></script>
    @endpush
</div>
