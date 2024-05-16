<div class="container-fluid py-3">
    <div class="container-fluid mb-3">
        <a href="{{ route('fees.feedelete_for_class') }}" class="btn bg-primary-dark text-white rounded-1   py-1 px-3">

            <i class="fa-solid fa-trash"></i>
            <span>
                تحديث معلومات الرسوم
            </span>
        </a>

        <thead>

    </div>


    <br>
    <div class="container-fluid my-2">
        <div class="row">
            <div class="col">
                <select wire:model.lazy="billingCyclesId" class="form-select    float-end ">
                    <option> اختر الدورة المالية </option>
                    @foreach ($billingCylces as $billingCylce)
                        <option value="{{ $billingCylce->id }}">{{ $billingCylce->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col">
                <select wire:model.lazy="studentsInfoId" class="form-select   float-start ">
                    <option> اختر الرقم العائلي </option>
                    @foreach ($familyNumbers as $familyNumber)
                        <option value="{{ $familyNumber->id }}">{{ $familyNumber->fnumber }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col p-0">
                <select wire:model.lazy="feestypesId" class="form-select   float-start ">
                    <option> اختر جهة الدفع </option>
                    @foreach ($feeTypes as $feeType)
                        <option value="{{ $feeType->id }}">{{ $feeType->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col   px-3">
                <select wire:model.lazy="banksId" class="form-select   float-start ">
                    <option> اختر الخزنة </option>
                    @foreach ($banks as $bank)
                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                    @endforeach
                </select>
            </div>



            <div class="col py-0 px-3">
                <span class="float-start fw-bold  " wire:loading wire:target="banksId">
                    <img src="{{ asset('/images/loading-loading-forever.gif') }}" alt="loading"
                        style="width:15px; height:15px">
                </span>
            </div>

            <div class="col p-0">
                @if ($checked)
                    <div class="dropdown">
                        <button class="btn bg-danger-dark text-white rounded-1   py-1 px-3 dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            عدد السجلات المختارة
                            ({{ count($checked) }})
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <a href="#" class="dropdown-item" type="button"
                                    onclick="confirm('Are you sure you want to delete these Records?') || event.stopImmediatePropagation()"
                                    wire:click="deleteRecords()" >
                                    حذف متعدد
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="#" wire:click="multiPaidFee()">
                                دفع رسوم متعدد
                            </a></li>
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col p-0">
            </div>
        </div>
    </div>
    <br>




    @php $i = 1 @endphp
    <table class="table  border border-light rounded" style="border-spacing: 0px;">
        <thead>
            <tr>
                <th class="py-3 bg-gray-dark text-white text-center ">م</th>
                <th class="py-3 bg-gray-dark text-white text-center ">
                    <input type="checkbox" wire:model.lazy="selectPage">
                </th>
                <th class="py-3 bg-gray-dark text-white text-center ">الاسم</th>
                <th class="py-3 bg-gray-dark text-white text-center ">الرقم العائلي</th>
                <th class="py-3 bg-gray-dark text-white text-center ">المرحلة الدراسية</th>
                <th class="py-3 bg-gray-dark text-white text-center ">الصف</th>
                <th class="py-3 bg-gray-dark text-white text-center ">الفترة</th>
                <th class="py-3 bg-gray-dark text-white text-center ">المجموعة</th>
                <th class="py-3 bg-gray-dark text-white text-center ">القسم</th>
                <th class="py-3 bg-gray-dark text-white text-center ">جهة الدفع</th>
                <th class="py-3 bg-gray-dark text-white text-center ">الدورة المالية</th>
                <th class="py-3 bg-gray-dark text-white text-center ">المطلوب</th>
                <th class="py-3 bg-gray-dark text-white text-center "> دفع الرسوم </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr class="@if ($this->isChecked($invoice->id)) bg-primary @endif">
                    <td class="bg-white ">
                        {{ $i++ }}
                    </td>
                    <td class="bg-white ">
                        <input type="checkbox" value="{{ $invoice->id }}" wire:model.live.debounce.300="checked">
                    </td>
                    <td class="bg-white ">
                        {{ SystemInfo::get_full_student_name($invoice->studentInfo->id) }}
                    </td>
                    <td class="bg-white ">
                        {{ $invoice->studentInfo->family_number->fnumber }}
                    </td>
                    <td class="bg-white ">
                        {{ $invoice->programs->levels->name }}
                    </td>
                    <td class="bg-white ">
                        {{ $invoice->programs->classes->name }}
                    </td>
                    <td class="bg-white ">
                        {{ $invoice->programs->shifts->name }}
                    </td>
                    <td class="bg-white ">
                        {{ $invoice->programs->groups->name }}
                    </td>
                    <td class="bg-white ">
                        {{ $invoice->programs->sections->name }}
                    </td>
                    <td class="bg-white ">
                        {{ $invoice->feestypes->name }}
                    </td>
                    <td class="bg-white ">
                        {{ $invoice->from }} -{{ $invoice->to }}
                    </td>
                    <td class="bg-white ">
                        {{ $invoice->want }}$
                    </td>
                    <td class="bg-white ">
                        <a href="{{ route('fees.fee-paidtracking', ['id' => $invoice->id, 'stu_id' => $invoice->studentInfo->id]) }}"
                            target="__blank" class="btn btn-warning shadow-md py-0">
                            <small style="font-size: 10px;">
                                <i class="fa-solid fa-dollar"></i>
                                <span>
                                    <small>
                                        دفع الرسوم
                                    </small>
                                </span>
                            </small>
                        </a>
                        <button class="btn bg-danger-dark text-white shadow-md py-0"
                            onclick="confirm('Are you sure you want to export these Records?') || event.stopImmediatePropagation()"
                            wire:click="deleteSingleRecord({{ $invoice->id }})">
                            <small style="font-size: 10px;">
                                <i class="fa-solid fa-trash"></i>
                                <span>
                                    <small>
                                        حذف
                                    </small>
                                </span>
                            </small>
                        </button>
                    </td>

                </tr>
            @endforeach
        </tbody>

    </table>
</div>
