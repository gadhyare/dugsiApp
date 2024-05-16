@extends('admin.layouts.loged-master')
@section('content')
    <div class="container my-2 py-2">
        <div class="container mt-5 p-3">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mt-2  text-center h5 "><a
                        href="{{route('employees.sections')}}" class="text-decoration-none">
                        <div class="card  bg-dark text-white rounded-0 p-5   "> الأقسام الوظيفية </div>
                    </a></div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mt-2  text-center h5 " ><a
                        href="{{route('employees.levels')}}"  class="text-decoration-none">
                        <div class="card  bg-dark text-white rounded-0 p-5   "> الدرجات الوظيفية </div>
                    </a></div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mt-2  text-center h5 " ><a
                        href="{{route('employees.info')}}"  class="text-decoration-none">
                        <div class="card  bg-dark text-white rounded-0 p-5   "> معلومات الموظفين </div>
                    </a></div>
            </div>
        </div>
    </div>
@endsection
