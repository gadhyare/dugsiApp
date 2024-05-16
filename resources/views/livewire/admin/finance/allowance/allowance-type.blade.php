<div class="container bg-white p-4">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="card">
                <div class="card-header bg-gray-dark text-white">
                    <i class="fa-solid fa-list"></i>
                    <span>
                         قائمة أنواع العلاوات
                    </span>
                </div>
                <div class="card-body">
                    <form method="post" class="fw-bold" wire:submit.prevent="checkOpration">
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
        <span class="float-start">
            <a  class="btn bg-success-dark text-white text-white  px-2 py-0 shadow-lg" href="{{route('allowance.index')}}" >
                <i class="fa-solid fa-file  " > </i>
                <span class="mx-2">
                    العلاوات
                </span>
            </a>
        </span>
        @php
            $serial = ($allowanceTypes->currentpage() - 1) * $allowanceTypes->perpage() + 1;
        @endphp
        {{-- Show all allowance type list --}}
        <x-table :headers="['#', 'نوع العلاوة', 'تاريخ الاضافة', 'الحالة', 'التعديل', 'الحذف']">

            @foreach ($allowanceTypes as $allowanceType)
                <tr>
                    <td>{{ $serial++ }}</td>
                    <td>{{ $allowanceType->name }}</td>
                    <td>{{ date('d-m-Y' , strtotime($allowanceType->created_at))}}</td>
                    <td>{{ $allowanceType->active == 1 ? 'مفعل' : 'غير مفعل' }}</td>
                    <td>
                        <button class="btn bg-success-dark text-white  px-2 py-0 shadow-lg rounded-0" wire:click="updateRec({{ $allowanceType->id }})"
                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-pencil  "> </i>
                        </button>
                    </td>
                    <td>
                        <button class="btn bg-danger-dark text-white  px-2 py-0 shadow-lg rounded-0"
                        wire:click="deleteConfirmation({{ $allowanceType->id }})">
                        <small>
                            <i class="fa-solid fa-trash  "></i>
                        </small>
                    </button>
                    </td>
                </tr>
            @endforeach
        </x-table>
        {{ $allowanceTypes->links() }}
    </div>
    </div>
    </div>
