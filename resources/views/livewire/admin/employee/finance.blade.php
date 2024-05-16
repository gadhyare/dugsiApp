<div class="container bg-white p-4">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="card">
                <div class="card-header bg-gray-dark text-white">
                    <i class="fa-solid fa-list"></i>
                    <span>
                    المستحقات المالية   للموظف
                    </span>
                </div>
                <div class="card-body">
                    <form method="post" class="fw-bold" wire:submit.prevent="checkOpration">
                        @csrf

                        <div class="form-group my-2">
                            <label for="employees_info_id"> الموظف </label>
                            @error('employees_info_id')
                            <span class="bg-danger-dark text-white float-start px-2">
                                مطلوب
                            </span>
                        @enderror
                            <select name="employees_info_id"  class="form-control bg-white" wire:model.defer="employees_info_id">
                                 <option selected > اختر   الموظف </option>
                                 @foreach ($employees_info as $info)
                                 <option value="{{$info->id}}" > {{$info->name}}</option>
                                 @endforeach
                            </select>

                        </div>

                        <div class="form-group my-2">
                            <label for="allowance_types_id"> نوع العلاوة </label>
                            @error('allowance_types_id')
                            <span class="bg-danger-dark text-white float-start px-2">
                                مطلوب
                            </span>
                        @enderror
                            <select name="allowance_types_id"  class="form-control bg-white" wire:model.defer="allowance_types_id">
                                 <option selected > اختر   نوع العلاوة </option>
                                 @foreach ($allowance_type as $info)
                                 <option value="{{$info->id}}" > {{$info->name}}</option>
                                 @endforeach
                            </select>
                        </div>

            <div class="form-group my-2">

                <label for="amount">  المبلغ     </label>
                @error('amount')
                <span class="bg-danger-dark text-white float-start px-2">
                    مطلوب
                </span>
            @enderror
                <input type="text" name="amount" id="amount" class="form-control bg-white"
                    wire:model.defer="amount">

            </div>

            <div class="form-group my-2">

                <label for="note">  الملاحظات   </label>
                @error('note')
                <span class="bg-danger-dark text-white float-start px-2">
                    مطلوب
                </span>
            @enderror


                    <textarea name="note" id="note" cols="30" rows="10" wire:model.defer="note" class="form-control bg-white"></textarea>
            </div>

            <button type="submit"
            class="btn @if ($updateId) bg-success-dark @else bg-primary-dark @endif text-white   shadow-lg float-end">
            <i class="fa fa-plus"></i>
            {{ $btnTitle }}
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
        $serial = ($employee_finances->currentpage() - 1) * $employee_finances->perpage() + 1;
    @endphp
    {{-- Show all employee_finances type list --}}
    <x-table :headers="['#',  'نوع العلاوة' , 'المبلغ' , 'ملاحظات'   ,  'التعديل', 'الحذف']">
        @foreach ($employee_finances  as $item)
            <tr>
                <td>{{ $serial++ }}</td>
                <td>{{ $item->allowance_types->name }}</td>
                <td>{{ $item->amount  }}</td>
                <td>{{ $item->note  }}</td>
                <td>
                    <button class="btn bg-success-dark text-white  px-2 py-0 shadow-lg rounded-0" wire:click="updateRec({{ $item->id }})"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-pencil  "> </i>
                    </button>
                </td>
                <td>
                    <button class="btn bg-danger-dark text-white  px-2 py-0 shadow-lg rounded-0"
                    wire:click="deleteConfirmation({{ $item->id }})">
                    <small>
                        <i class="fa-solid fa-trash  "></i>
                    </small>
                </button>
                </td>
            </tr>
        @endforeach
    </x-table>
    {{ $employee_finances->links() }}
</div>
</div>
</div>
