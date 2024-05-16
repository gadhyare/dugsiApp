@extends('admin.layouts.loged-master')
@section('content')
    <div class="container my-2 py-2 fw-bold">


        <div class="card  col-xs-12 col-sm-12 col-md-4 col-xs-3 m-auto ">
            <div class="card-header section-header text-white"> <i class="fa fa-plus"></i> تعديل المستوى
                <a href="{{route('classes.index')}}" class="btn text-white py-0 float-start"> <i class="fa fa-arrow-left"></i> تراجع </a>
                <br>
            </div>
            <div class="card-body ">
                <form action="{{route('classes.edit' , $classes->id)}}" method="post" class="fw-bold">
                    @csrf
                    <div class="form-group my-2">
                        <label for="name">الاسم</label>
                        <input type="text" name="name" id="name" class="form-control bg-white" value="{{$classes->name}}">
                        @error('name')
                            <small><i class="text-danger">{{$message}}</i></small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="active">الحالة</label>
                        <select name="active" id="active" class="form-select bg-white">
                            <option value="1" {{($classes->active == 1) ? ' selected' : ''}}>مفعل</option>
                            <option value="2" {{($classes->active == 2) ? ' selected' : ''}}>غير مفعل</option>
                        </select>
                        @error('active')
                            <small><i class="text-danger">{{$message}}</i></small>
                        @enderror

                    </div>
                    <button type="submit" class="btn btn-danger col-12 py-2 m-auto"> <i class="fa fa-info-circle"></i> تعديل</button>

                </form>
            </div>
        </div>


    </div>
@endsection
