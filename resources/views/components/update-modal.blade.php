        {{-- Start of Button trigger Modal --}}

        <i class="fa-solid fa-pencil  bg-info  text-white  shadow p-1" data-bs-toggle="modal"
            data-bs-target="#UpdateModal{{$recId}}" ></i>

        {{-- End of Button trigger Modal --}}


{{-- Start of Modal --}}
<div class="modal fade" id="UpdateModal{{$recId}}" tabindex="-1" aria-labelledby="UpdateModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div {{ $attributes->merge(['class' => 'modal-dialog']) }}>
        <div class="modal-content">
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">تراجع</button>
                <button type="button" class="btn btn-success" wire:click.perevent="add" >{{ $btnTitle }}</button>
            </div>
        </div>
    </div>
</div>

{{-- End of Modal --}}
