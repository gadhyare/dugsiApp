        {{-- Start of Button trigger Modal --}}
        <div class="container my-2 px-0">
            <button type="button" class="btn btn-warning float-start py-0 shadow px-3" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                <small><i class="fa-solid fa-plus "></i> <span>{{$btnTitle}}</span></small>
            </button>
        </div>
        {{-- End of Button trigger Modal --}}

        {{-- Start of Modal --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self >
            <div {{$attributes->merge(['class' => 'modal-dialog'])}} >
                <div class="modal-content">
                    <div class="modal-body">
                            {{ $slot }}
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">تراجع</button>
                        <button type="button" class="btn btn-success"
                            wire:click.perevent="add">{{ $btnTitle }}</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- End of Modal --}}
