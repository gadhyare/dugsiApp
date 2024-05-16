<div>
    <div class="card border-0 p-3 ">

        <div class="card-header bg-white py-2  ">
            <h5><i class="fa fa-level-up"></i> <span> معلومات الخزينة والبنك </span> </h5>
        </div>
        <div class="card-body   rounded px-0 ">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <form wire:submit.prevent="add">
                                @csrf
                                <div class="form-group my-2">
                                    <label for="name">اسم الحساب
                                    </label>

                                    @error('name')
                                        <span class="float-start bg-danger-dark text-white px-3">
                                             مطلوب
                                        </span>
                                        @enderror
                                    <input type="text" name="name" id="name" class="form-control bg-white rounded-0 my-1"
                                        wire:model="name">

                                </div>
                                <div class="form-group my-2">
                                    <label for="bank_number">رقم الحساب</label>
                                    @error('bank_number')
                                    <span class="float-start bg-danger-dark text-white px-3">
                                         مطلوب
                                    </span>
                                    @enderror
                                    <input type="text" name="bank_number" id="bank_number"
                                        class="form-control bg-white rounded-0 my-1" wire:model="bank_number">

                                </div>

                                <div class="form-group my-2">
                                    <label for="open_date">تاريخ الافتتاح</label>

                                    @error('open_date')
                                    <span class="float-start bg-danger-dark text-white px-3">
                                         مطلوب
                                    </span>
                                    @enderror
                                    <input type="date" name="open_date" id="open_date" class="form-control bg-white rounded-0 my-1"
                                        wire:model="open_date">

                                </div>

                                <div class="form-group my-2">
                                    <label for="op_acc">الحساب الافتتاحي</label>
                                    @error('op_acc')
                                    <span class="float-start bg-danger-dark text-white px-3">
                                         مطلوب
                                    </span>
                                    @enderror
                                    <input type="number" name="op_acc" id="op_acc" class="form-control bg-white rounded-0 my-1"
                                        wire:model.lazy="op_acc">

                                </div>


                                <div class="form-group my-2">
                                    <label for="active">الحالة</label>
                                    <select name="active" id="active" class="form-control bg-white rounded-0 my-1"
                                        wire:model="active">
                                        <option value="1">مفعل</option>
                                        <option value="2">غير مفعل</option>
                                    </select>
                                    @error('active')
                                        <small><i class="text-danger">{{ $message }}</i></small>
                                    @enderror

                                </div>
                                <button type="submit" class="btn bg-primary-dark text-white   shadow-lg float-end"> <i
                                        class="fa fa-plus"></i>
                                    @if ($updateId)
                                        تعديل
                                    @else
                                        اضافة
                                    @endif
                                </button>
                                @if ($updateId)
                                    <button type="submit" class="btn bg-danger-dark text-white   shadow-lg float-start"
                                        wire:click.prevent="cancel">
                                        <span>
                                            تراجع
                                        </span>
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <table class="table table-striped">
                        <thead>
                            <th class="py-1 table-header text-white">#</th>
                            <th class="py-1 table-header text-white"> اسم الحساب </th>
                            <th class="py-1 table-header text-white"> رقم الحساب </th>
                            <th class="py-1 table-header text-white">تاريخ الافتتاح</th>
                            <th class="py-1 table-header text-white">الحالة</th>
                            <th class="py-1 table-header text-white">التعديل</th>
                            <th class="py-1 table-header text-white">الحذف</th>
                        </thead>
                        <tbody>
                            @foreach ($banks as $bank)
                                <tr>
                                    <td>#</td>
                                    <td>{{ $bank->name }}</td>
                                    <td>{{ $bank->bank_number }}</td>
                                    <td>{{ date('Y-m-d', strtotime($bank->open_date)) }}</td>
                                    <td>{{ $bank->active == 1 ? 'مفعل' : 'غير مفعل' }}</td>
                                    <td>
                                        <button class="btn bg-success-dark text-white  px-2 py-0 shadow-lg rounded-0"
                                            wire:click="updateRec({{ $bank->id }})">
                                            <small>
                                                <i class="fa-solid fa-pen  "></i>
                                            </small>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn bg-danger-dark text-white  px-2 py-0 shadow-lg rounded-0"
                                            wire:click="deleteConfirmation({{ $bank->id }})">
                                            <small>
                                                <i class="fa-solid fa-trash  "></i>
                                            </small>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="py-1 table-footer text-white">#</td>
                                <td class="py-1 table-footer text-white"> اسم الحساب </td>
                                <td class="py-1 table-footer text-white"> رقم الحساب </td>
                                <td class="py-1 table-footer text-white">تاريخ الافتتاح</td>
                                <td class="py-1 table-footer text-white">الحالة</td>
                                <td class="py-1 table-footer text-white">التعديل</td>
                                <td class="py-1 table-footer text-white">الحذف</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
