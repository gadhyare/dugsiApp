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
                @if($updateId)
                <button class="btn bg-pink-400 text-pink-100 fw-bold" wire:click.prevent="ConfirmpUdateRec({{$updateId}})">  تعديل </button>
                @else
                <button class="btn bg-indigo-400 text-indigo-100 fw-bold" wire:click.prevent="store">  اضافة </button>
                @endif
            </div>
        </div>
    </div>

    <br>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>   الجدول</th>
                <th> اسم الجدول بالعربي</th>
                <th> العمليات </th>
            </tr>
        </thead>
        <tbody>
            @if (count($tables) > 0)
                @foreach ($tables as $table)
                    <tr>
                        <td>#</td>
                        <td>  {{$table->name}}  </td>
                        <td>  {{$table->name_ar}}  </td>
                        <td> 
                            <button class="btn bg-success-dark text-white  px-2 py-0 shadow-lg rounded-0" wire:click="updateRec({{$table->id}})">
                                <i class="fa-solid fa-pencil  "> </i>
                            </button> 
                            <button class="btn bg-danger-dark text-white  px-2 py-0 shadow-lg rounded-0" wire:click="deleteConfirmation({{$table->id}})">
                                <i class="fa-solid fa-trash  "> </i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endif 
        </tbody>
    </table>
</div>
