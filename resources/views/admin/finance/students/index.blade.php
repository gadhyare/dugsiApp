@extends('admin.layouts.loged-master')
@section('content')
    <div class="container mt-5 p-3 text-center m-atuo">
        <div class="row text-center m-atuo">
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 mt-2  m-auto"><a href="{{ route('fees.type') }}"
                    class="text-decoration-none">
                    <div class="card p-2 bg-dark text-white rounded py-4"> جهات الدفع </div>
                </a></div>
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 mt-2  m-auto"><a href="{{ route('fees.feesvalue') }}"
                    class="text-decoration-none">
                    <div class="card p-2 bg-dark text-white rounded py-4"> قيمة الرسوم </div>
                </a></div>
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 mt-2  m-auto">
                <a href="{{ route('fees.feeclasstran' , 0 ) }}" class="text-decoration-none">
                    <div class="card p-2 bg-dark text-white rounded py-4"> رفع رسوم </div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 mt-2  m-auto"><a href="{{ route('fees.feepaid') }}"
                    class="text-decoration-none">
                    <div class="card p-2 bg-dark text-white rounded py-4"> دفع رسوم </div>
                </a></div>
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 mt-2  m-auto"><a href="{{ route('fees.index-report') }}"
                    class="text-decoration-none">
                    <div class="card p-2 bg-dark text-white rounded py-4"> تقارير الرسوم </div>
                </a></div>
        </div>
    </div>
@endsection
