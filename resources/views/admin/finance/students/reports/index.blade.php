@extends('admin.layouts.loged-master')
@section('content')
    <div class="container-fluid bg-white p-4 my-3 rounded shadow-0">
        <div class="container-fluid">
            <div class="h4">
                <i class="fa-solid fa-file"></i>
                <span>
                    التقارير المالية للطلبة
                </span>
            </div>
        </div>
        <br>
        <ul class="nav nav-tabs fw-bold px-0" id="myTab" role="tablist">
            <li class="nav-item px-0 mx-0" role="presentation">
                <button class="nav-link text-white title   rounded-0 active" id="between-two-date-tab" data-bs-toggle="tab" data-bs-target="#between-two-date" type="button"
                    role="tab" aria-controls="between-two-date" aria-selected="true">
                    بين تاريخين
                </button>
            </li>
            <li class="nav-item px-0 mx-0" role="presentation">
                <button class="nav-link text-white title mx-2 rounded-0" id="class-report-tab" data-bs-toggle="tab" data-bs-target="#class-report" type="button"
                    role="tab" aria-controls="class-report" aria-selected="false">تقرير فصل </button>
            </li>
            <li class="nav-item px-0 mx-0 " role="presentation">
                <button class="nav-link text-white title mx-2 rounded-0" id="student-report-tab" data-bs-toggle="tab" data-bs-target="#student-report" type="button"
                    role="tab" aria-controls="student-report" aria-selected="false"> تقرير طالب </button>
            </li>
            
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="between-two-date" role="tabpanel" aria-labelledby="between-two-date-tab">
                @livewire('admin.finance.students.resports.between-two-date-report')
            </div>
            <div class="tab-pane fade " id="class-report" role="tabpanel" aria-labelledby="class-report-tab">.

                @livewire('admin.finance.students.resports.classes-report')

            </div>
            <div class="tab-pane fade " id="student-report" role="tabpanel" aria-labelledby="student-report-tab">
                @livewire('admin.finance.students.resports.student-report') 
            </div> 
             
        </div>

    </div>
@endsection
