@extends('admin.layouts.loged-master')
@section('content')
    <div class="container  bg-white my-2 py-2 text-center">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mt-2  text-center h5 "><a
                    href="{{route('finance.reports.by-billing-cycle')}}" class="text-decoration-none">
                    <div class="card  bg-dark text-white rounded-0 p-5   ">  البحث بالدورة المالية   </div>
                </a></div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mt-2  text-center h5 "><a
                    href="http://localhost:8000/admin/employees/levels" class="text-decoration-none">
                    <div class="card  bg-dark text-white rounded-0 p-5   "> الدرجات الوظيفية </div>
                </a></div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mt-2  text-center h5 "><a
                    href="http://localhost:8000/admin/employees/info" class="text-decoration-none">
                    <div class="card  bg-dark text-white rounded-0 p-5   "> معلومات الموظفين </div>
                </a></div>
        </div>
    </div>
@endsection
