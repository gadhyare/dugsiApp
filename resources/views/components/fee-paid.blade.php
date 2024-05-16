        {{-- Start of Button trigger Modal --}}

        <button class="btn btn-warning shadow border-0" data-bs-toggle="modal"
        data-bs-target="#FeePaidModal{{ $recId }}">
            <i class="fa-solid fa-pencil " ></i>
        </button>

        {{-- End of Button trigger Modal --}}
        {{-- Start of Modal --}}
        <div class="modal fade" id="FeePaidModal{{ $recId }}" tabindex="-1" aria-labelledby="FeePaidModalLabel"
            aria-hidden="true" wire:ignore.self>
            <div {{ $attributes->merge(['class' => 'modal-dialog']) }}>
                <div class="modal-content rounded-0 border-0 shadow-lg ">
                    <div class="modal-body rounded-0 border-0 shadow-lg ">

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
