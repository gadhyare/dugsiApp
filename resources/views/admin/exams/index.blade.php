@extends('admin.layouts.loged-master')

@section('content')
@if (   $programs_id)
    <div class="container py-3  my-5   ">
        <div class="row gap-2 justify-content-center    ">
            <a href="{{route('exams.add.for.class' , ['programs_id' => $programs_id ])}}"
                class="col-xs-12 col-sm-12 col-md-2  py-5 px-3 bg-blue-700 text-center text-white shadow rounded-2 text-wrap h2 text-decoration-none ">
                اختبار فصل
            </a>
            <a href="{{route('exams.add.for.student' , ['programs_id' => $programs_id ])}}"
                class="col-xs-12 col-sm-12 col-md-2   py-5 px-3 bg-blue-700 text-center text-white shadow rounded-2 text-wrap h2 text-decoration-none ">
                اختبار طالب
            </a>

            <a  href="{{route('exams.report.for.class' , ['programs_id' => $programs_id ])}}"
                class="col-xs-12 col-sm-12 col-md-2   py-5 px-3 bg-blue-700 text-center text-white shadow rounded-2 text-wrap h2 text-decoration-none ">
                تقرير فصل
            </a>
            <a href="{{route('exams.report.for.student' , ['programs_id' => $programs_id ]) }}"
                class="col-xs-12 col-sm-12 col-md-2   py-5 px-3 bg-blue-700 text-center text-white shadow rounded-2 text-wrap h2 text-decoration-none ">
                تقرير طالب
            </a>
        </div>
    </div>
    @else

    <div class="alert alert-danger text-center">
         لم تختر الفصل
         <p>

            <b>
                <a href="{{route('programs.index')}}" class="text-red-500 text-decoration-none">اضغط هنا لاختيار الفصل</a>
            </b>
         </p>
    </div>
    @endif
@endsection
