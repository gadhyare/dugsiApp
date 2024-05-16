@extends('admin.layouts.loged-master')
@section('content')
    <div class="container p-3 fw-bold">
        <div class="row">
            <x-states title="تقسيم الطلبة على العائلات" icon="-solid fa-feather"
                number="{{ \App\Models\FamilyNumber::where('active', '=', 1)->count() }}" description="" bg="blue-500" />
            <x-states title="الطلاب" icon="-solid fa-graduation-cap"
                number="{{ \App\Models\StudentsSchoolInfo::where('active', '=', 1)->count() }}" description=""
                bg="green-500" />
            <x-states title="المراحل الدراسية" icon="-solid fa-level-up"
                number="{{ \App\Models\Levels::where('active', '=', 1)->count() }}" description="" bg="orange-500" />
            <x-states title="الفصول الدراسية" icon="-solid fa-puzzle-piece"
                number="{{ \App\Models\Classes::where('active', '=', 1)->count() }}" description="" bg="indigo-500" />
            <x-states title="الشعب الدارسية" icon="-solid fa-layer-group"
                number="{{ \App\Models\Groups::where('active', '=', 1)->count() }}" description="" bg="pink-500" />
            <x-states title="الفترات الدارسية" icon="-brands fa-swift"
                number="{{ \App\Models\Shifts::where('active', '=', 1)->count() }}" description="" bg="yellow-500" />
            <x-states title="الأقسام الدارسية" icon="-solid fa-snowflake"
                number="{{ \App\Models\Sections::where('active', '=', 1)->count() }}" description="" bg="cyan-500" />
            <x-states title="المواد" icon="-solid fa-book-open-reader"
                number="{{ \App\Models\Subjects::where('active', '=', 1)->count() }}" description="" bg="red-500" />
        </div>

        <br>
    </div>

    <div class="container p-3 fw-bold  ">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-5">
                <div class="card ">
                    @php $students  = \App\Models\StudentsSchoolInfo::where('active' , '=' , 1)->take(10)->orderBy('id' , 'DESC')->get()   @endphp
                    @php $i =  1 @endphp
                    <div class="card-header bg-white">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <span>
                            آخر الطلبة المسجلين
                        </span>
                        <div class="badge float-start bg-indigo-500 rounded-1">
                            {{ $students->count() }}
                        </div>
                    </div>
                    <div class="card-body p-0">

                        <ul class="list-group ">
                            @foreach ($students as $item)
                                <li class="list-group-item border-0 py-2 bg-white"> {{ $i++ }} -
                                    {{ $item->studentInfo->name() }} <div class="badge rounded-1 bg-red-500 float-start">
                                        {{ $item->studentInfo->family_number->fnumber }}</div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-7">
                <div class="card ">
                    <div class="card-header bg-white">
                        @php $students_fee_baid  = \App\Models\FeeTrans::take(10)->orderBy('id' , 'DESC')->get()   @endphp
                        @php $i =  1 @endphp
                        <i class="fa-solid fa-money-bill"></i>
                        <span>
                            آخر من دفع الرسوم
                        </span>
                        <div class="badge float-start bg-indigo-500 rounded-1">
                            {{ $students_fee_baid->count() }}
                        </div>
                    </div>
                    <div class="card-body p-0 ">

                        <ul class="list-group bg-white">
                            @foreach ($students_fee_baid as $info)
                                <li class="list-group-item bg-white border-0 py-2"> {{ $i++ }} -
                                    {{ $info->invoices->studentInfo->name() }}

                                    <div class="badge rounded-1 bg-red-500 mx-1 float-start">${{ $info->amount }}</div>
                                    <div class="badge rounded-1 bg-black mx-1 float-start">{{ $info->paid_date }}</div>
                                    <div class="badge rounded-1 bg-blue-500 mx-1 float-start">
                                        {{ $info->invoices->feestypes->name }}</div>
                                    <div class="badge rounded-1 bg-orange-500 mx-1 float-start">
                                        {{ $info->invoices->programs->program_name() }}</div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
