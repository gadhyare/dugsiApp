<div class="container-fluid bg-white p-2">
    @if (session()->has('errorIn'))
        <div class="alert alert-danger text-center rounded-0">
            {{ Session::get('errorIn') }}
        </div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success text-center rounded-0">
            {{ Session::get('success') }}
        </div>
    @endif
    @if ($programs_id)

        @php
            $serial = 1;
        @endphp
        <div class="float-end">
            <span>
                معلومات الدورة المالية الحالية
            </span>
            <select wire:model="billingsId" class="form-select rounded-0 px-5 bg-light my-1">
                <option> اختر الدورة المالية</option>
                @foreach ($billings as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <button type="submit" wire:click.prevent="add"
                class="btn bg-gray-dark rounded-0 my-2 px-5 text-white  rounded  shadow-lg ">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                <span>
                    رفع الرسوم
                </span>
            </button>
        </div>
        <div class="float-start">
            <span>
                معلومات اضافية للرفع
            </span>
            <select class="form-select rounded-0 px-5 bg-light my-1" wire:model.lazy="active">
                <option value="1"> تفعيل الخصوم الدائمة </option>
                <option value="2"> عدم تفعيل الخصوم الدائمة </option>
            </select>
            <span class="float-start">
                @error('feestypes_id')
                    <div class="bg-danger-dark text-white px-2">
                        مطلوب
                    </div>
                @enderror
            </span>
            <select class="form-select rounded-0 px-5 bg-light my-1" wire:model.lazy="feestypes_id">
                <option selected> اختر جهة الدفع </option>
                @foreach ($feestypes as $feestype)
                    <option value="{{ $feestype->id }}"> {{ $feestype->name }} </option>
                @endforeach
            </select>
        </div>
        <table class="table table-bordered">
            <thead>
                <th class="py-2 bg-success-dark text-white text-center border-0"> م </th>
                <th class="py-2 bg-success-dark text-white text-center border-0">اسم الطالب</th>
                <th class="py-2 bg-success-dark text-white text-center border-0">رقم الطالب</th>
                <th class="py-2 bg-success-dark text-white text-center border-0"> الخصم الخاص بالطالب </th>
                <th class="py-2 bg-success-dark text-white text-center border-0"> الرسوم المقررة على جهة الدفع </th>
                <th class="py-2 bg-success-dark text-white text-center border-0"> اجمالي المطلوب </th>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $serial++ }}</td>
                        <td>{{ $student->studentInfo->name() }} </td>
                        <td>
                            {{ $student->studentInfo->family_number->fnumber }}-{{ $student->id }}</td>
                        <td>{{ $student->discount }} </td>
                        <td>{{ $amount }} </td>
                        <td>
                            @if ($feestypes_id !== null)
                                @if ($active == 1)
                                    {{ $amount - $student->discount }}
                                @else
                                    {{ $amount }}
                                @endif
                            @else
                                اختر جهة الدفع
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-danger text-center">
            لم تختر الفصل
            <p>
                <b>
                    <a href="{{ route('programs.index') }}" class="text-red-500 text-decoration-none">اضغط هنا لاختيار
                        الفصل</a>
                </b>
            </p>
        </div>
    @endif
</div>
