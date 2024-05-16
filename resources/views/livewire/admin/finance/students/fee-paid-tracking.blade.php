<div class="container ">

    <div class="row  justify-content-between">
        <div class="col-xs-12 col-md-4 ">
            <div class="card p-0 rounded-0 border  z-depth-0">

                <div class="card-header bg-white p-1">
                    <i class="fa-solid fa-list"></i>
                    معلومات السند
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <span> اسم الطالب </span>
                        <span class="px-2">
                            {{ SystemInfo::get_full_student_name($info->studentInfo->id) }}
                        </span>
                    </div>
                    <div class="form-group"> 
                            {{ $info->programs->program_name() }} 
                    </div>  
                    <div class="form-group">
                        <span> جهة الدفع </span>
                        <span class="px-2">
                            {{ $info->feestypes->name }}
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <span> الرسوم المقررة </span>
                                <span class="px-2">
                                    {{ $info->want }}$
                                </span>
                            </div>
                            <div class="col-6">
                                <span> متبقي سابق </span>
                                <span class="px-2">
                                    @php $prevBlance = SystemInfo::getPastStudentFee($info->studentInfo->id, $info->programs_id , $info->feestypes->id, $info->feestypes_id)  @endphp
                                    {{ SystemInfo::getPastStudentFee($info->studentInfo->id, $info->programs_id , $info->feestypes->id, $info->feestypes_id) }}
                                </span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <div class="col-xs-12 col-md-6">
            <div class="card rounded-0 border-0 ">
                <div class="card-header rounded-0 title text-white">
                    <i class="fa-solid fa-list"></i>
                    <span>
                        سند القبض
                    </span>

                </div>
                <div class="card-body">
                    <form method="POST" wire:submit.prevent="checkOpration">
                        <div class="form-group my-2">
                            <label for="banks_id" class="py-1">
                                رقم الحساب
                            </label>
                            <span class="float-start">
                                @error('banks_id')
                                    <div class="bg-danger text-white px-2">
                                        مطلوب
                                    </div>
                                @enderror
                            </span>

                            <select wire:model.live.debounce.300="banks_id" id="banks_id" class="form-select px-5 ">
                                <option selected> اختر رقم الحساب </option>
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}"> {{ $bank->name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group my-2">
                                    <label for="paid_date" class="py-1">
                                        تاريخ الدفع
                                    </label>
                                    <span class="float-start">
                                        @error('paid_date')
                                            <div class="bg-danger text-white px-2">
                                                مطلوب
                                            </div>
                                        @enderror
                                    </span>
                                    <input type="date" wire:model.live.debounce.300="paid_date" id="paid_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group my-2">
                                    <label for="descount" class="py-1">
                                        الخصم
                                    </label>
                                    <span class="float-start">
                                        @error('descount')
                                            <div class="bg-danger text-white px-2">
                                                مطلوب
                                            </div>
                                        @enderror
                                    </span>
                                    <input type="number" wire:model.live.debounce.300="descount" id="descount" class="form-control">
                                </div>
                            </div>
                        </div>





                        <div class="form-group my-2">
                            <label for="amount" class="py-1">
                                المبلغ المطلوب
                            </label>
                            <span class="float-start">
                                @error('amount')
                                    <div class="bg-danger text-white px-2">
                                        مطلوب
                                    </div>
                                @enderror
                            </span>
                            <input type="text" class="border-0 bg-white text-danger fw-bold" disabled
                                value="{{ $info->want + $prevBlance }}">
                            <input type="number" wire:model.live.debounce.300="amount" id="amount" class="form-control">
                        </div>

                        <div class="form-group my-2">
                            <label for="note" class="py-1">
                                الملاحظات
                            </label>
                            <span class="float-start">
                                @error('note')
                                    <div class="bg-danger text-white px-2">
                                        مطلوب
                                    </div>
                                @enderror
                            </span>

                            <textarea id="note" wire:model.live.debounce.300="note" cols="30" rows="2" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn title text-white col-12 m-auto">
                            <i class="fa-solid fa-dollar"></i>
                            <span>
                                 {{$btnTitle}}
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @php $i = 1 @endphp

    <div class="container px-0 my-2   rounded">

        <div class="container mb-1">
            <a href="{{ route('fees.fee-generate-pdf', ['id' => $ids, 'stu_id' => $stu_id]) }}"
                class="btn bg-primary-dark rounded-0 shadow-lg py-1 px-3 text-white" target="_blank">
                <i class="fa-solid fa-print"></i>
            </a>

        </div>

        <table class="table bg-white">
            <thead>
                <tr>
                    <th class="py-3 text-white bg-gray-dark"> م </th>
                    <th class="py-3 text-white bg-gray-dark"> تاريخ الدفع </th>
                    <th class="py-3 text-white bg-gray-dark"> رقم الحساب </th>
                    <th class="py-3 text-white bg-gray-dark"> الخصم </th>
                    <th class="py-3 text-white bg-gray-dark"> المبلغ المدفوع </th>
                    <th class="py-3 text-white bg-gray-dark"> التعديل </th>
                    <th class="py-3 text-white bg-gray-dark"> الحدف </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($feetrans as $item)
                    <tr>
                        <td> {{ $i++ }}</td>
                        <td> {{ $item->paid_date }}</td>
                        <td> {{ $item->banks->name }}</td>
                        <td> {{ $item->descount }}</td>
                        <td> {{ $item->amount }}</td>
                        <td>
                            <button wire:click="getDataToUpdate({{$item->id}})"
                                class="btn bg-primary-dark text-white  px-2 py-0 shadow-lg rounded-0">
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                        </td>
                        <td>
                            <button wire:click="confrimDalete({{$item->id}})"
                                class="btn bg-danger-dark text-white  px-2 py-0 shadow-lg rounded-0">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
