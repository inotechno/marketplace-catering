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
                                    @if ($role == 'Customer')
                                        <th class="align-middle">Merchant Name</th>
                                    @elseif($role == 'Merchant')
                                        <th class="align-middle">Customer Name</th>
                                    @endif

                                    <th class="align-middle">Order ID</th>
                                    <th class="align-middle">Total Amount</th>
                                    <th class="align-middle">Payment Method</th>
                                    <th class="align-middle">Order At</th>
                                    <th class="align-middle">Payment At</th>
                                    <th class="align-middle">Delivery At</th>
                                    <th class="align-middle">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        @if ($role == 'Customer')
                                            <td>{{ $order->merchant->company_name }}</td>
                                        @elseif($role == 'Merchant')
                                            <td>{{ $order->customer->company_name }}</td>
                                        @endif

                                        <td>{{ $order->order_id }}</td>
                                        <td>{{ $order->total_amount }}</td>
                                        <td>{{ $order->paymentMethod->name }}</td>
                                        <td>{{ $order->ordered_at }}</td>

                                        <td>
                                            @if ($order->payment_at != null)
                                                <span class="badge bg-success">
                                                    {{ $order->payment_at }}
                                                </span>
                                                @if ($role == 'Merchant' && $order->status == 'waiting approval')
                                                    <button wire:click="confirmApprove({{ $order->id }})"
                                                        type="button"
                                                        class="btn btn-success btn-sm btn-rounded waves-effect waves-light">Approve
                                                        Payment</button>
                                                @endif
                                            @elseif ($order->payment_at == null && $role == 'Customer')
                                                <div class="form-group">
                                                    <input type="file" id="file-upload" style="display: none;"
                                                        wire:model="proff_file">
                                                    <button type="button"
                                                        class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                                                        onclick="document.getElementById('file-upload').click();"
                                                        wire:click="setOrder({{ $order->id }})">
                                                        Upload Bukti
                                                    </button>
                                                </div>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($order->delivery_at != null)
                                                <span class="badge bg-success">
                                                    {{ $order->delivery_at }}
                                                </span>
                                            @endif

                                            @if ($role == 'Merchant' && $order->status == 'delivery')
                                                <button wire:click="confirmDeliver({{ $order->id }})" type="button"
                                                    class="btn btn-success btn-sm btn-rounded waves-effect waves-light">Confirm
                                                    Delivery</button>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($order->status == 'pending')
                                                <span class="badge bg-warning">{{ $order->status }}</span>
                                            @elseif($order->status == 'waiting approval')
                                                <span class="badge bg-info">{{ $order->status }}</span>
                                            @elseif($order->status == 'delivery')
                                                <span class="badge bg-primary">{{ $order->status }}</span>
                                            @elseif($order->status == 'delivered')
                                                <span class="badge bg-success">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{ $orders->links() }}
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
