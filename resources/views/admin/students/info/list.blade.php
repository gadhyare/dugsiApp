@extends('admin.layouts.loged-master')
@section('content')
    <div class="container-fluid my-2 py-2 px-0">

    @livewire('admin.students.students-list' , ['programs_id' => $programs_id])

    </div>
@endsection
