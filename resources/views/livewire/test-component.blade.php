<div>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist" wire:ignore>
                                @foreach ($components as $category => $componentList)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                            href="#{{ $category }}" role="tab">
                                            <span class="d-none d-sm-block">{{ $category }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content p-3 text-muted" wire:ignore>
                                @foreach ($components as $category => $componentList)
                                    <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="{{ $category }}"
                                        role="tabpanel">
                                        @foreach ($componentList as $comp)
                                            <button class="btn btn-outline-primary waves-effect m-1"
                                                wire:click="selectComponent('{{ $comp }}')">
                                                {{ $comp }}
                                            </button>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Preview Component</h4>
                            @if($component)
                                                        @livewire(
                                    'component.' . $component,
                                    [
                                        'attributes' => [
                                            'element_id' => $component,
                                            'class' => 'btn btn-soft-primary',
                                            'text' => 'Click Button'
                                        ],
                                    ],
                                    key($component)
                                )
                            @else
                                <p>No component selected.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>