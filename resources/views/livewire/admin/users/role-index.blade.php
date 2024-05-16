<div class="container bg-white my-3 p-3 rounded-1 shadow-sm">

    <div class="card col-xs-12 col-sm-12 col-md-8 m-auto border-0 p-2">
        <div class="row">
            <div class="col">
                <input type="text" class="form-control " wire:model.live.debounce.300="name">
            </div>
            <div class="col">
                <input type="text" class="form-control " wire:model.live.debounce.300="name_ar">
            </div>

            <div class="col">
                @if ($updateId)
                    <button class="btn bg-blue-500 text-blue-100 fw-bold"
                        wire:click.prevent="ConfirmpUdateRec({{ $updateId }})"> تعديل </button>
                    <button class="btn bg-red-500 text-red-100 fw-bold"
                        wire:click.prevent="cancel"> تراجع </button>
                @else
                    <button class="btn bg-indigo-500 text-indigo-100 fw-bold" wire:click.prevent="store"> اضافة
                    </button>
                @endif
            </div>
        </div>
    </div>

    <br>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th> الدرجة</th>
                <th> اسم الدرجة بالعربي</th>
                <th> العمليات </th>
            </tr>
        </thead>
        <tbody>
            @if (count($roles) > 0)
                @foreach ($roles as $role)
                    <tr>
                        <td>#</td>
                        <td> {{ $role->name }} </td>
                        <td> {{ $role->name_ar }} </td>
                        <td>
                            <button class="btn bg-success-dark text-white  px-2 py-0 shadow-lg rounded-0"
                                wire:click="updateRec({{ $role->id }})">
                                <i class="fa-solid fa-pencil  "> </i>
                            </button>
                            <button class="btn bg-danger-dark text-white  px-2 py-0 shadow-lg rounded-0"
                                wire:click="deleteConfirmation({{ $role->id }})">
                                <i class="fa-solid fa-trash  "> </i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
