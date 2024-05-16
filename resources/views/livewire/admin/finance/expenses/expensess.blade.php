<div class="container bg-white p-4">
    <a href="{{ route('expenses.type') }}" class="btn btn-danger px-3 py-1 shadow-lg">
        <i class="fa-solid fa-file-archive"></i>
        <span>
            انواع المصروفات
        </span>
    </a>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="card">
                <div class="card-header bg-gray-dark text-white">
                    <i class="fa-solid fa-list"></i>
                    <span>
                        قائمة المصروفات
                    </span>
                </div>
                <div class="card-body">
                    <form method="post" class="fw-bold" wire:submit.prevent="add">
                        @csrf
                        <div class="form-group my-2">

                            <label for="amount">المبلغ</label>
                            <input type="text" name="amount" id="amount" class="form-control bg-white"
                                wire:model.defer="amount">
                            @error('amount')
                                <small><i class="text-danger">{{ $message }}</i></small>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="expenses_types_id"> جهةالصرف </label>
                            <select name="expenses_types_id" class="form-control bg-white"
                                wire:model.defer="expenses_types_id">
                                <option selected> اختر جهة الصرف </option>
                                @foreach ($expenses_type as $item)
                                    <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('expenses_types_id')
                                <small><i class="text-danger">{{ $message }}</i></small>
                            @enderror
                        </div>

                        <div class="form-group my-2">
                            <label for="date"> التاريخ </label>
                            <input type="date" name="date" id="date" class="form-control bg-white"
                                wire:model.defer="date">
                            @error('date')
                                <small><i class="text-danger">{{ $message }}</i></small>
                            @enderror
                        </div>


                        <div class="form-group my-2">
                            <label for="note"> ملاحظات </label>
                            <input type="text" name="note" id="note" class="form-control bg-white"
                                wire:model.defer="note">
                        </div>

                        <button type="submit" class="btn @if ($updateId) bg-success-dark @else bg-primary-dark @endif text-white   shadow-lg float-end"> <i
                            class="fa fa-plus"></i>
                        {{$btnTitle}} صرفية
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
    @php
        $serial = ($expensess->currentpage() - 1) * $expensess->perpage() + 1;
    @endphp
    {{-- Show all expenses type list --}}
    <x-table :headers="['#', 'جهة الصرف', 'تاريخ الاضافة', 'الدورة المالية', 'المبلغ', 'التعديل', 'الحذف']">

        @foreach ($expensess as $expense)
            <tr>
                <td>{{ $serial++ }}</td>
                <td>{{ $expense->expensesType->name }}</td>
                <td>{{ $expense->date }}</td>
                <td>{{ $expense->billing_cycle->name }}  </td>
                <td>{{ $expense->amount }}</td>

                <td>

                    <button class="btn btn-success px-2 py-0 shadow-lg" wire:click="updateRec({{ $expense->id }})"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-pencil  "> </i>
                    </button>

                </td>
                <td>


                    <x-delete-confirm btnTitle="حذف" recId="{{ $expense->id }}">
                        [{{ $expense->name }}]
                    </x-delete-confirm>

                </td>
            </tr>
        @endforeach
    </x-table>


    {{ $expensess->links() }}

</div>
</div>
</div>
