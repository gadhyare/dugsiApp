<div class="container">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="container">
                <form method="post">
                    <div class="card rounded-0">
                        <div class="card-header title text-white rounded-0">
                            <i class="fa-solid fa-list"></i>
                            <span>
                                الدورات المالية
                            </span>
                        </div>


                        <div class="card-body">

                            <div class="form-group my-2">
                                <label class="container"> اسم الدورة المالية
                                    <span class="float-start">
                                        @error('name')
                                            <div class="bg-danger text-white px-2">
                                                مطلوب
                                            </div>
                                        @enderror
                                    </span> </label>
                                <input type="text" wire:model="name" class="form-control rounded-0">
                            </div>


                            <div class="form-group my-2">
                                <label class="container"> الرصيد الافتتاحي
                                    <span class="float-start">
                                        @error('initial_balance')
                                            <div class="bg-danger text-white px-2">
                                                مطلوب
                                            </div>
                                        @enderror
                                    </span> </label>
                                <input type="number" wire:model="initial_balance" class="form-control rounded-0">
                            </div>
                            <div class="form-group my-2">
                                <label class="container"> الحالة
                                    <span class="float-start">
                                        @error('active')
                                            <div class="bg-danger text-white px-2">
                                                مطلوب
                                            </div>
                                        @enderror
                                    </span> </label>
                                <select class="form-select px-5 rounded-0" wire:model="active">
                                    <option value="1">سارية </option>
                                    <option value="2"> مغلق </option>
                                </select>
                            </div>
                            <div class="form-group my-2">

                                <button type="submit"
                                    class="btn bg-{{ $color }}-dark text-white   shadow-lg float-end"
                                    wire:click.prevent="add">
                                    <i class="fa fa-solid fa-add"></i>
                                    <span>
                                        {{ $btnTitle }} دورة
                                    </span>
                                </button>

                                @if ($updateId)
                                    <button type="submit" class="btn bg-danger-dark text-white   shadow-lg float-start"
                                        wire:click.prevent="cancel">
                                        <span>
                                            تراجع
                                        </span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9">

            @if (Session::has('message'))
                <div class="alert alert-danger text-center ">{{ Session::get('message') }}</div>
            @endif
            <div class="card ">
                <div class="card-body">
                    <table class="table bg-white  ">
                        <thead class="text-center  title text-white">
                            <th>م</th>
                            <th> اسم الدورة </th>
                            <th> الرصيد الافتتاحي </th>
                            <th> حالة الدورة المالية</th>
                            <th> تعديل </th>
                            <th> حذف </th>
                        </thead>
                        <tbody>
                            @foreach ($billings as $billing)
                                <tr class="border text-center">
                                    <td class="border">م</td>
                                    <td class="border"> {{ $billing->name }} </td>
                                    <td class="border"> {{ $billing->initial_balance }} </td>
                                    <td class="border"> {{ $billing->active == 1 ? 'سارية' : 'مغلق' }} </td>
                                    <td class="border">
                                        <button class="btn bg-success-dark text-white  px-2 py-0 shadow-lg rounded-0"
                                            wire:click="updateRec({{ $billing->id }})"><i
                                                class="fa-solid fa-pen  "></i></button>
                                    </td>
                                    <td class="border">
                                        <button class="btn bg-danger-dark text-white  px-2 py-0 shadow-lg rounded-0"
                                            wire:click="deleteConfirmation({{ $billing->id }})"><i
                                                class="fa-solid fa-pen  "></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
