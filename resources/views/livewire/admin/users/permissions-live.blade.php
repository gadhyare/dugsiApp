<div class="container bg-white my-3 p-3 rounded-1 shadow-sm">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="card rounded-0 border-0 shadow-sm bg-white">
                <div class="card-header rounded-0 bg-blue-700 text-white fw-bold">
                    <i class="fa-solid fa-list"></i> <span class="mx-2"> صفحة الصلاحيات </span>
                </div>
                <div class="card-body">
                    <div class="form-group my-2">
                        <input type="text" class="px-3 rounded-1 form-control " wire:model.live.debounce.300="name"
                            placeholder="الصفحة بالانجليزي">
                    </div>
                    <div class="form-group my-2">
                        <input type="text" class="px-3 rounded-1 form-control "
                            wire:model.live.debounce.300="name_ar" placeholder="الصفحة بالعربي">
                    </div>

                    <div class="form-group my-2">
                        <select name="" id="" class="px-5 rounded-1 form-select "
                            wire:model.live.debounce.300="table_id">
                            <option> اختر الجدول </option>
                            @foreach ($tables as $table)
                                <option value="{{ $table->id }}">{{ $table->name_ar }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group my-2">


                        @if ($updateId)
                            <button class="btn bg-green-500 text-green-100 fw-bold rounded-1 float-end"
                                wire:click.prevent="ConfirmpUdateRec({{ $updateId }})">
                                تعديل
                            </button>
                            <button class="btn bg-red-500 text-red-100 fw-bold rounded-1 float-start"
                                wire:click.prevent="cancel">
                                تراجع
                            </button>
                        @else
                            <button class="btn bg-indigo-500 text-indigo-100 fw-bold rounded-1"
                                wire:click.prevent="store">
                                اضافة
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8">
            @if (count($permissions) > 0)
                @foreach ($tables as $item)
                    <div class="card rounded-0 mb-2">
                        <div class="card-header rounded-0 bg-blue-700 text-white fw-bold">
                            <i class="fa-solid fa-list"></i> <span class="mx-2"> {{ $item->name_ar }} </span>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> الصفحة</th>
                                    <th> اسم الصفحة بالعربي</th>
                                    <th> العمليات </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $data = \App\Models\Permission::where('table_id' , '=' , $item->id)->get() @endphp
                                @foreach ($data as $permission)
                                    <tr>
                                        <td>#</td>
                                        <td> {{ $permission->name }} </td>
                                        <td> {{ $permission->name_ar }} </td>
                                        <td>
                                            <button
                                                class="btn bg-success-dark text-white  px-2 py-0 shadow-sm rounded-0"
                                                wire:click="updateRec({{ $permission->id }})">
                                                <i class="fa-solid fa-pencil  "> </i>
                                            </button>
                                            <button class="btn bg-danger-dark text-white  px-2 py-0 shadow-sm rounded-0"
                                                wire:click="deleteConfirmation({{ $permission->id }})">
                                                <i class="fa-solid fa-trash  "> </i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
</div>
