@extends('admin.layouts.loged-master')
@section('content')
    <div class="container my-2 py-2"> 
        <div>

    <form enctype="multipart/form-data" method="POST" action="{{route("student.upload.list.action")}}" class="card p-0 rounded-0 border-0 col-xs-12 col-sm-12 col-md-6 m-auto">
        @csrf
        <div class="card-header border-0 bg-white">
            <i class="fa-solid fa-list">
            </i>
            <span>
                رفع قائمة فصل
            </span>
        </div>
     
        <div class="card-body">
            <div class="form-group py-2">
                <label >
                    المرحلة الدراسية
                </label> 
                <select class="form-select rounded-0"  name="levels_id" >
                    <option > اختر المرحلة</option>
                    @foreach ($levels as $level)
                        <option value="{{$level->id}}">{{$level->name}}</option>
                    @endforeach
                </select>
                @error('levels_id') 
                        <small><i class="text-danger">{{ $message }}</i></small> 
                @enderror
            </div>  
            <div class="form-group py-2">
                <label >
                      الفصل الدراسي
                </label>
            
                <select class="form-select rounded-0"   name="classes_id">
                    <option > اختر الفصل الدراسي</option>
                    @foreach ($classes as $class)
                        <option value="{{$class->id}}">{{$class->name}}</option>
                    @endforeach
                </select>
                @error('classes_id') 
                        <small><i class="text-danger">{{ $message }}</i></small> 
                @enderror
            </div> 
            <div class="form-group py-2">
                <label >
                    الفترة  
                </label>
         
                <select class="form-select rounded-0"   name="shifts_id">
                    <option > اختر الفترة</option>
                    @foreach ($shifts as $shift)
                        <option value="{{$shift->id}}">{{$shift->name}}</option>
                    @endforeach
                </select>
                @error('shifts_id') 
                        <small><i class="text-danger">{{ $message }}</i></small> 
                @enderror
            </div> 
            <div class="form-group py-2">
                <label >
                    الشعبة الدراسية
                </label>
         
                <select class="form-select rounded-0"   name="groups_id">
                    <option > اختر الشعبة</option>
                    @foreach ($groups as $group)
                        <option value="{{$group->id}}">{{$group->name}}</option>
                    @endforeach
                </select>
                @error('groups_id')
                        <small><i class="text-danger">{{ $message }}</i></small>
                @enderror
            </div> 


                        <div class="form-group py-2">
                <label >
                    القسم  
                </label>
         
                <select class="form-select rounded-0"   name="sections_id">
                    <option > اختر القسم</option>
                    @foreach ($sections as $section)
                        <option value="{{$section->id}}">{{$section->name}}</option>
                    @endforeach
                </select>
                @error('sections_id')
                        <small><i class="text-danger">{{ $message }}</i></small>
                @enderror
            </div> 

            <label class="card-body p-5 rounded-0 m-0  text-center alert alert-info w-100" for="fileUpload">
            <span>
                اضغط هنا لفرع الملف
            </span>
            <input type="file" name="fileUpload" id="fileUpload" style="display: none"   name="fileUpload"  >
        </label>
        </div> 
        <div class="card-footer border-0 bg-white">
            <button  class="btn btn-primary col-12 m-auto"  >
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
 
        
    </form>
</div>

    </div>
@endsection
