<div>
    @livewire('component.page.breadcrumb', ['breadcrumbs' => [['name' => 'Product', 'url' => '/'], ['name' => 'Create', 'url' => '/product/create']]])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="store" class="needs-validation form-horizontal">

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="image">Image</label>
                                <input id="images" name="images" wire:model="images" type="file" class="form-control" multiple>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="productname">Product Name</label>
                                <input id="productname" name="productname" wire:model="name" type="text"
                                    class="form-control" placeholder="Product Name">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="price">Price</label>
                                <input id="price" name="price" wire:model="price" type="text"
                                    class="form-control" placeholder="Price">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="stock">Category</label>
                                <select id="stock" name="stock" wire:model="category_id" class="form-select">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" wire:model="description" class="form-control" rows="5"></textarea>
                            </div>

                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-primary waves-effect waves-light"
                            type="submit">Save</button>
                            <button type="button" class="btn btn-light">Reset</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @push('css')
        <link href="{{ asset('libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    @push('js')
        <script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script>
    @endpush
</div>
