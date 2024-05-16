<div class="container   p-4">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="card">
                <div class="card-header bg-gray-dark text-white">
                    <i class="fa-solid fa-list"></i>
                    <span>
                        قائمة صرف مرتب الموظف
                    </span>
                </div>
                <div class="card-body">
                    <form method="post" class="fw-bold" wire:submit.prevent="checkOpration">
                        @csrf
                        @php $total = 0 @endphp
                        <div class="form-group my-2">
                            <label for="billing_cycles_id"> الدورة المالية </label>
                            @error('billing_cycles_id')
                                <span class="bg-danger-dark text-white float-start px-2">
                                    مطلوب
                                </span>
                            @enderror
                            <select name="billing_cycles_id" class="form-control bg-white rounded-0"
                                wire:model="billing_cycles_id">
                                <option  value="" selected> اختر الدورة المالية </option>
                                @foreach ($billing_cycles as $billing_cycle)
                                    <option value="{{ $billing_cycle->id }}"> {{ $billing_cycle->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group my-2">
                            <label for="employees_info_id"> الموظف </label>
                            @error('employees_info_id')
                                <span class="bg-danger-dark text-white float-start px-2">
                                    مطلوب
                                </span>
                            @enderror
                            <select name="employees_info_id" class="form-control bg-white rounded-0"
                                wire:model="employees_info_id">
                                <option selected> اختر الموظف </option>
                                @foreach ($employees_info as $info)
                                    <option value="{{ $info->id }}"> {{ $info->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group my-2">
                            <div class="card-body px-0">
                                @if (count($employees_finances) > 0)
                                    <h6>معلومات المستحقات المالية للموظف </h6>
                                    <table class="table">
                                        @foreach ($employees_finances as $employees_finance)
                                            <tr>
                                                <td class="py-1 text-danger">
                                                    {{ $employees_finance->amount??0 }} </td>
                                                <td class="py-1 text-danger">
                                                    {{ $employees_finance->allowance_types->name }}
                                                </td>
                                                <td class="py-1 text-danger">
                                                    {{ date('Y-m-d', strtotime($employees_finance->created_at)) }}
                                                    @php $total += $employees_finance->amount??0  @endphp </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif
                                @if (count($employees_deductions) > 0)
                                    <h6>معلومات المقتطعات المالية للموظف </h6>
                                    <table class="table">
                                        @foreach ($employees_deductions as $employees_deduction)
                                            <tr>
                                                <td class="py-1 text-danger">{{ $employees_deduction->amount??0 }} </td>
                                                <td class="py-1 text-danger">

                                                    {{ $employees_deduction->note }}
                                                </td>
                                                <td class="py-1 text-danger"> {{ date('Y-m-d', strtotime($employees_finance->created_at)) }}@php $total -= $employees_deduction->amount  @endphp
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif
                                @if (count($employees_debts) > 0)
                                    <h6>معلومات الديون المالية للموظف </h6>
                                    <table class="table">
                                        @foreach ($employees_debts as $employees_debt)
                                            <tr>
                                                <td class="py-1 text-danger">{{ $employees_debt->amount }} </td>
                                                <td class="py-1 text-danger">
                                                    {{ $employees_debt->note }} </td>
                                                <td class="py-1 text-danger">{{ date('Y-m-d', strtotime($employees_finance->created_at)) }}@php $total -= $employees_debt->amount  @endphp
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif
                            </div>
                            <label for="amount"> إجمالي المستحق المالي  </label>
                            @error('amount')
                                <span class="bg-danger-dark text-white float-start px-2">
                                    مطلوب
                                </span>
                            @enderror
                            <input type="text" name="amount" id="amount" class="form-control bg-white rounded-0"
                              wire:model="info">
                        </div>
                        <div class="form-group my-2">
                            <label for="note"> الملاحظات   </label>
                            <textarea class="form-control bg-white rounded-0" rows="5" cols="10"
                                 ></textarea>
                        </div>
                        <div class="form-group my-2">
                            <label for="date"> التاريخ </label>
                            @error('date')
                                <span class="bg-danger-dark text-white float-start px-2">
                                    مطلوب
                                </span>
                            @enderror
                            <input type="date" name="date" id="date" class="form-control bg-white rounded-0"
                                wire:model="date">
                        </div>
                        <button type="submit"
                            class="btn @if ($updateId) bg-success-dark @else bg-primary-dark @endif text-white   shadow-lg float-end">
                            <i class="fa fa-plus"></i>
                            {{ $btnTitle }} مرتب موظف
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
                $serial = ($employee_salaries->currentpage() - 1) * $employee_salaries->perpage() + 1;
            @endphp
            {{-- Show all employee_salaries type list --}}
            <x-table :headers="[
                '#',
                'اسم الموظف',
                'المرتب الأساسي',
                'صافي المرتب',
                'تاريخ الاضافة',
                'الدورة المالية',
                'التعديل',
                'الحذف',
            ]">
                @foreach ($employee_salaries as $item)
                    <tr>
                        <td>{{ $serial++ }}</td>
                        <td>{{ $item->employeesInfo->name }}</td>
                        <td>{{ $item->amount }}</td>
                        <td>{{ $item->note }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->billing_cycle->from }} - {{ $item->billing_cycle->to }}</td>
                        <td>
                            <button class="btn bg-success-dark text-white  px-2 py-0 shadow-lg rounded-0"
                                wire:click="updateRec({{ $item->id }})" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
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
            {{ $employee_salaries->links() }}
        </div>
    </div>
</div>
