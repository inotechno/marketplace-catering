<div>
    @livewire('component.page.breadcrumb', ['breadcrumbs' => [['name' => 'Catering', 'url' => '/']]])


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
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap table-check">
                            <thead class="table-light">
                                <tr>
                                    <th class="align-middle">Logo</th>
                                    <th class="align-middle">Merchant Name</th>
                                    <th class="align-middle">Contact Person</th>
                                    <th class="align-middle">Email</th>
                                    <th class="align-middle">Phone Number</th>
                                    <th class="align-middle">Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($merchants as $merchant)
                                    <tr>
                                        <td><img src="{{ $merchant->logo_url }}" class="rounded-circle avatar-xs" alt=""></td>
                                        <td><a href="{{route('catering.product', $merchant->uid)}}" class="">{{$merchant->company_name}}</a></td>
                                        <td>{{ $merchant->contact_person }}</td>
                                        <td>{{ $merchant->email }}</td>
                                        <td>{{ $merchant->phone_number }}</td>
                                        <td>{{ $merchant->address }}, {{ $merchant->city }}, {{ $merchant->province }}, {{ $merchant->country }}, {{ $merchant->postal_code }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{ $merchants->links() }}
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
