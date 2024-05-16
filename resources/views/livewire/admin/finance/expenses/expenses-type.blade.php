<div>
    <div class="card border-0 p-3 shadow-lg col-md-7">
        @if (Session::has('status'))
            <div class="alert alert-success text-center ">{{ Session::get('status') }}</div>
        @endif


        <span class="float-start">
            <a  class="btn title text-white  px-2 py-0 shadow-lg" href="{{route('expenses.index')}}" >
                <i class="fa-solid fa-file  " > </i>
                <span>
                    المصروفات
                </span>
            </a>
        </span>


        <x-modal btnTitle="اضافة">


            <form method="post" class="fw-bold">
                @csrf
                <div class="form-group my-2">

                    <label for="name">الاسم</label>
                    <input type="text" name="name" id="name" class="form-control bg-white"
                        wire:model.defer="name">
                    @error('name')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>
                <div class="form-group my-2">
                    <label for="active">الحالة</label>
                    <select name="active" id="active" class="form-control bg-white" wire:model.defer="active">
                        <option value="1">مفعل</option>
                        <option value="2">غير مفعل</option>
                    </select>
                    @error('active')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>
            </form>


        </x-modal>

        @php
            $serial = ($expensesTypes->currentpage() - 1) * $expensesTypes->perpage() + 1;
        @endphp
        {{-- Show all expenses type list --}}
        <x-table :headers="['#', 'جهة الصرف', 'تاريخ الاضافة', 'الحالة', 'التعديل', 'الحذف']">

            @foreach ($expensesTypes as $expensesType)
                <tr>
                    <td>{{ $serial++ }}</td>
                    <td>{{ $expensesType->name }}</td>
                    <td>{{ date('d-m-Y' , strtotime($expensesType->created_at)) }}</td>
                    <td>{{ $expensesType->active == 1 ? 'مفعل' : 'غير مفعل' }}</td>
                    <td>

                        <button wire:click="" class="btn btn-success px-2 py-0 shadow-lg"
                            wire:click="updateRec({{ $expensesType->id }})" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <i class="fa-solid fa-pencil  "> </i>
                        </button>

                    </td>
                    <td>


                        <x-delete-confirm btnTitle="حذف" recId="{{ $expensesType->id }}">
                            [{{ $expensesType->name }}]
                        </x-delete-confirm>

                    </td>
                </tr>
            @endforeach
        </x-table>


        {{ $expensesTypes->links() }}
    </div>
</div>
