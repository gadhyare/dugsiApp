@extends('admin.layouts.loged-master')
@section('content')


    @if(SystemInfo::checkAdminAuth('home' ))
    <div class="container my-3 py-5">
        <div class="col-xs-12 col-sm-12 col-md-4 m-auto">
            <div class="row gap-2">
            <a href="{{ route('user.admin') }}" class="col bg-orange-300 text-dark text-center rounded-2 p-4 h3  text-decoration-none fw-bold ">
                الإدارة
            </a>
            <a href="{{ route('user.user') }}" class="col bg-orange-300 text-dark text-center rounded-2 p-4 h3  text-decoration-none fw-bold ">
                الأعضاء
            </a>
        </div>
        </div>
    </div>
    @endif
@endsection
