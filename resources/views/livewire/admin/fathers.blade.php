<div class="container bg-white py-5">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="card">
                <div class="card-header bg-gray-dark text-white">
                    <i class="fa-solid fa-list"></i>
                    <span>
                         قائمة      الرقم العائلي
                    </span>
                </div>
                <div class="card-body">
                    <form method="post" class="fw-bold" wire:submit.prevent="checkOpration">
                    @csrf
                    <div class="form-father my-2">
                        <label for="number"> الرقم العائلي </label>
                        <input type="text" name="number" id="number" class="form-control bg-white"
                            wire:model.defer="number">
                        @error('number')
                            <small><i class="text-danger">{{ $message }}</i></small>
                        @enderror
                    </div>
                    <div class="form-father my-2">
                        <label for="active">الحالة</label>
                        <select name="active" id="active" class="form-control bg-white" wire:model.defer="active">
                            <option value="1">مفعل</option>
                            <option value="2">غير مفعل</option>
                        </select>
                        @error('active')
                            <small><i class="text-danger">{{ $message }}</i></small>
                        @enderror
                    </div>
                    <button type="submit"
                        class="btn @if ($updateId) bg-success-dark @else bg-primary-dark @endif text-white   shadow-lg float-end">
                        <i class="fa fa-plus"></i>
                        {{ $btnTitle }} علاوة موظف
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
                $serial = ($fathers->currentpage() - 1) * $fathers->perpage() + 1;
            @endphp
            {{-- Show all expenses type list --}}
            <x-table :headers="['#', 'الرقم العائلي', 'الحالة', 'اضافة أطفال', 'التعديل', 'الحذف']">

                @foreach ($fathers as $father)
                    <tr>
                        <td>{{ $serial++ }}</td>
                        <td>{{ $father->number }}</td>
                        <td>{{ $father->active == 1 ? 'مفعل' : 'غير مفعل' }}</td>
                        <td>
                            <a href="{{ route('students.register', $father->id) }}" class="btn btn-success py-0 ">
                                <small style="font-size: 9px"><i class="fa fa-child p-1"> <i
                                            class="fa fa-plus  p-1"></i> </i></small>
                            </a>
                        </td>
                        <td>
                            <button class="btn bg-success-dark text-white  px-2 py-0 shadow-lg rounded-0"
                                wire:click="updateRec({{ $father->id }})" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="fa-solid fa-pencil  "> </i>
                            </button>
                        </td>
                        <td>
                            <button class="btn bg-danger-dark text-white  px-2 py-0 shadow-lg rounded-0"
                                wire:click="deleteConfirmation({{ $father->id }})">
                                <small>
                                    <i class="fa-solid fa-trash  "></i>
                                </small </tr>
                @endforeach
            </x-table>


            {{ $fathers->links() }}
        </div>
    </div>
</div>

</div>
