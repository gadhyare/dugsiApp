<div class="bg-white p-2">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="form-group">
                <label for="programs_id">
                    الدورة المالية
                </label>
                <span class="float-start">
                    @error('billing_cycle_id')
                        <div class="bg-danger text-white px-2">
                            مطلوب
                        </div>
                    @enderror
                </span>
                <select wire:model.lazy="billing_cycle_id" class="form-control rounded-0 alert alert-info py-2 my-2">
                    <option> اختر الدورة المالية </option>
                    @foreach ($billing_cycles as $billing_cycle)
                        <option value="{{ $billing_cycle->id }}"> {{ $billing_cycle->name }} </option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="form-group">
                <label for="programs_id">
                    الفصل
                </label>
                <span class="float-start">
                    @error('programs_id')
                        <div class="bg-danger text-white px-2">
                            مطلوب
                        </div>
                    @enderror
                </span>
                <select wire:model.lazy="programs_id" class="form-control rounded-0 alert alert-info py-2 my-2">
                    <option> اختر الفصل </option>
                    @foreach ($programs as $item)
                        <option value="{{ $item->id }}"> {{ $item->program_name() }} </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="form-group">
                <label for="to">
                    جهة الدفع
                </label>
                <span class="float-start">
                    @error('to')
                        <div class="bg-danger text-white px-2">
                            مطلوب
                        </div>
                    @enderror
                </span>
                <select wire:model.lazy="feestypes_id"
                    class="form-select rounded-0 alert alert-info w-100 py-2 my-2 px-5">
                    <option> اختر جهة الدفع </option>
                    @foreach ($feestypes as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    <div class="col-xs-12 col-sm-12 col-md-3">



    <div class="container fw-bold text-danger float-end" >
        
        <span wire:loading>
            <img src="{{ asset('/images/loading-loading-forever.gif') }}" alt="loading" style="width:15px; height:15px">
        </span>
   

        <span>
            اجمالي المبلغ المدفوع بين التاريخين: {{ $totalPaidBetweenTwoDateForStudent }}$
        @if (count($feetrans) > 0)
            <input type="hidden" wire:model.live.debounce.300=""> 
            <a class="float-start text-pink-500" target="_blank" 
                href="{{ route('print.fee.report.class', ['programs_id' => $programs_id, 'feestypes_id' => $feestypes_id , 'billing_cycle_id' => $billing_cycle_id]) }}">
                <i class="fa fa-print" style=""></i>
            </a>
        @endif
        </span>
    </div>
</div>
    @php $i = 1 ; @endphp
    <table class="table table-striped fw-bold">
        <thead>
            <th class="py-3 bg-gray-dark text-center border-0 text-white">#</th>
            <th class="py-3 bg-gray-dark text-center border-0 text-white"> اسم الطالب </th>
            <th class="py-3 bg-gray-dark text-center border-0 text-white"> رقم الرصيد </th>
            <th class="py-3 bg-gray-dark text-center border-0 text-white"> الخزينة </th>
            <th class="py-3 bg-gray-dark text-center border-0 text-white"> التاريخ </th>
            <th class="py-3 bg-gray-dark text-center border-0 text-white"> جهة الدفع </th> 
            <th class="py-3 bg-gray-dark text-center border-0 text-white"> المطلوب </th>
            <th class="py-3 bg-gray-dark text-center border-0 text-white"> الخصم </th>
            <th class="py-3 bg-gray-dark text-center border-0 text-white"> المدفوع </th>
            <th class="py-3 bg-gray-dark text-center border-0 text-white"> متبقي سابق </th>
            
            <th class="py-3 bg-gray-dark text-center border-0 text-white"> المتبقي </th>
            <th class="py-3 bg-gray-dark text-center border-0 text-white"> الحالة </th>
        </thead>
        <tbody>
            @foreach ($feetrans as $feetran)
                <tr>
                    <td> {{ $i++ }}</td>
                    <td> {{ SystemInfo::get_full_student_name($feetran->studentInfo->id) }} </td>
                    <td> {{ $feetran->id }} </td>
                    <td> {{ \App\Models\Banks::where('id' , '=' , $feetran?->banks_id)->first()?->name   ?? '--'}} </td>
                    <td> {{ $feetran->paid_date ?? '--' }} </td>
                    <td> {{ $feetran->feestypes->name }} </td>
                    <td> ${{ $feetran->want ?? 0 }} </td>
                    <td> ${{ $feetran->descount ?? 0 }} </td>
                    <td> ${{ $feetran->amount ?? 0 }} </td>
                    <td> ${{ SystemInfo::getPastStudentFee($feetran->studentInfo->id , $programs_id , $feestypes_id , $billing_cycle_id ) ?? 0 }} </td>
                    
                    <td> ${{ ($feetran->want +  SystemInfo::getPastStudentFee($feetran->studentInfo->id , $programs_id , $feestypes_id , $billing_cycle_id ) ) - ($feetran->amount+$feetran->descount)  ?? 0 }} </td>
                    <td> {{($feetran->amount) ? 'ليس عليه شيء' : 'عليه دين'}} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
