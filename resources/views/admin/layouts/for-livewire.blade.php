@extends('admin.layouts.loged-master')
@section('content')
    <div class="container-fluid my-2 py-2">
        {{$slot}}
    </div>
@endsection
