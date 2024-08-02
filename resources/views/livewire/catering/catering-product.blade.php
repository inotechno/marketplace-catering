<div>
    @livewire('component.page.breadcrumb', ['breadcrumbs' => [['name' => 'Product', 'url' => '/'], ['name' => 'Catering', 'url' => route('catering.index')]]])


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box me-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Search..."
                                        wire:model.live="search">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap table-check">
                            <thead class="table-light">
                                <tr>
                                    <th class="align-middle">Images</th>
                                    <th class="align-middle">Product Name</th>
                                    <th class="align-middle">Category Name</th>
                                    <th class="align-middle">Price</th>
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
                                        <td><a href="javascript: void(0);" class="text-body fw-bold"></a>
                                            {{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>Rp {{ $product->price }}</td>

                                        <td>
                                            <div class="d-flex gap-3">
                                                <button type="button"
                                                    class="btn btn-success btn-rounded waves-effect waves-light"
                                                    wire:click="openModal({{ $product->id }})">Pesan
                                                    Catering</button>
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


    @if ($showModal)
        <div class="modal fade show" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-modal="true"
            style="display: block;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="order" class="needs-validation form-horizontal">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" id="quantity"
                                            placeholder="Enter quantity" wire:model="quantity">
                                    </div>

                                    <div class="mb-3">
                                        <label for="payment_method_id" class="form-label">Payment Method</label>
                                        <select class="form-select" id="payment_method_id"
                                            wire:model="payment_method_id">
                                            <option value="">-- Choose Payment Method --</option>
                                            @foreach ($payment_methods as $payment_method)
                                                <option value="{{ $payment_method->id }}">
                                                    {{ $payment_method->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit"
                                        class="btn btn-primary waves-effect waves-light">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endif

</div>
