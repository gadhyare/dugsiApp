<div>
    <div class="card border-0 p-3 shadow-lg col-md-7">
        @if (Session::has('status'))
            <div class="alert alert-success text-center ">{{ Session::get('status') }}</div>
        @endif

        <x-modal btnTitle="اضافة">


            <form method="post" class="fw-bold">
                @csrf
                <div class="form-group my-2">

                    <label for="type"> نوع الرسوم   </label>
                    <input type="text" name="name" id="type" class="form-control bg-white"
                        wire:model.defer="name">
                    @error('type')
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
            $serial = ($feestypes->currentpage() - 1) * $feestypes->perpage() + 1;
        @endphp
        {{-- Show all expenses type list --}}
        <x-table :headers="['#', 'نوع الرسوم', 'الحالة', 'التعديل', 'الحذف']">

            @foreach ($feestypes as $feestype)
                <tr>
                    <td>{{ $serial++ }}</td>
                    <td>{{ $feestype->name }}</td>
                    <td>{{ $feestype->active == 1 ? 'مفعل' : 'غير مفعل' }}</td>
                    <td>
                        <small><i class="fa-solid fa-pen  bg-success  text-white  shadow p-1"
                                wire:click="updateRec({{ $feestype->id }})" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"></i></small>
                    </td>
                    <td>


                        <x-delete-confirm btnTitle="حذف" recId="{{ $feestype->id }}">
                            [{{ $feestype->name }}]
                        </x-delete-confirm>

                    </td>
                </tr>
            @endforeach
        </x-table>


        {{ $feestypes->links() }}
    </div>
</div>
