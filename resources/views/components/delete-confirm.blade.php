        {{-- Start of Button trigger Modal --}}


            <button wire:click="" class="btn bg-danger-dark text-white  px-2 py-0 shadow-lg rounded-0" data-bs-toggle="modal"
            data-bs-target="#DeleteModal{{$recId}}">
                <i class="fa-solid fa-trash  " > </i>
            </button>
        {{-- End of Button trigger Modal --}}

        {{-- Start of Modal --}}
        <div class="modal xidh fade" id="DeleteModal{{$recId}}" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true"
            wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                          هل أنت متأكد من حذف السجل {{ $slot }} ؟
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">تراجع</button>
                        <button type="button" class="btn btn-success"  wire:click.defer="deleteRec({{$recId}})" >{{ $btnTitle }}</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- End of Modal --}}
