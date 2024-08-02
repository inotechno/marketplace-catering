<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ end($breadcrumbs)['name'] }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        @foreach($breadcrumbs as $breadcrumb)
                            @if(!$loop->last)
                                <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a></li>
                            @else
                                <li class="breadcrumb-item active">{{ $breadcrumb['name'] }}</li>
                            @endif
                        @endforeach
                    </ol>
                </div>

            </div>
        </div>
    </div>
</div>
