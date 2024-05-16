@extends('admin.layouts.loged-master-no-header-for-non-livewire') <!-- -no-header -->
@section('content')
<style>
    
    body,table{
        font-size:12px !important;
    }
    @page { size: protrait; }
</style>
    <div class="container-fluid my-2 py-2 print-section">
      
        
                <table  style="margin: 0 auto; width:100%" >
                    <tr>
                        <td >
                            <img src="{{ asset('storage/images/' . SystemInfo::setting('logo')) }}" alt="{{ SystemInfo::setting('name') }}"
                    class=" m-auto" style="height: 120px; width:100% ">
                        </td>
                    </tr> 
                    <tr>
                        <td class="border-0 mt-0 py-1 text-center"> 
                            العنوان: {{ SystemInfo::setting('address') }}   -
                          الهواتف: {{ SystemInfo::setting('phones') }}    -
                          البريد الإلكتروني{{ SystemInfo::setting('email') }} </td>
                    </tr>
                </table> 
            
    </div>
    <div class="container-fluid">
        <h4 class="text-center">
            معلومات الطالب
        
        <span class="float-start">
           <img src="{{ Storage::url('/uploads/' . $students->photo) }}"
                                            alt="{{ $students->name() }}" class="rounded-1 my-2 shadow-sm"
                                            style="width: 80px;height:80px">
        </span>
        </h4>
    </div>

    <div class="container-fluid px-0">

        <table class="table">
            <tr>
                <td class="border p-0">اسم الطالب : {{SystemInfo::get_full_student_name($id)}}</td>
                <td class="border p-0"> الرقم العائلي   : {{ $students->family_number->fnumber}}</td>
                <td class="border p-0">   اسم الأم   : {{ $students->mother }}</td>
                <td class="border p-0">   الجنس   : {{ $students->gender}}</td>
            </tr>

            <tr>
                <td class="border p-0" > تاريخ الميلاد: {{$students->date_of_birth}} </td>
                <td class="border p-0" > مكان الميلاد: {{$students->place_of_birth}} </td>
                <td class="border p-0" >   الجنسية: {{$students->nationality}} </td>
                <td class="border p-0" >   العنوان: {{$students->address}} </td>

            </tr>

            <tr>
                <td class="border p-0" >  المدينة: {{$students->city}} </td>
                <td class="border p-0" >  الهواتف: {{$students->phone}} </td>
                <td class="border p-0" >  تاريخ التسجيل: {{$students->registration_date}} </td>
                <td class="border p-0" >  فصيلة الدم: {{$students->blood_group}} </td>
            </tr>
        </table>
        <div class="container-fluid px-0">
            <p>
                <i class="fa-solid fa-book"></i>
                المعلومات الدراسية للطالب
            </p> 
            <table class="table ">
                <tr>
                    <td class="border p-0">#</td>
                    <td class="border p-0">المرحلة الدراسية</td>
                    <td class="border p-0">الصف  </td>
                    <td class="border p-0">الشعبة  </td>
                    <td class="border p-0">القسم  </td>
                    <td class="border p-0">الفترة  </td>
                    <td class="border p-0"> تاريخ التسجيل  </td>
                    <td class="border p-0"> الخصم الدائم  </td>
                    <td class="border p-0"> الحالة  </td>
                </tr>
                
                    
                
                <tr>
                    @if ($student_schools)
                    <td class="border p-0">#</td>
                    <td class="border p-0">{{$student_schools->programs->levels->name  }}</td>
                    <td class="border p-0">{{$student_schools->programs->classes->name}}</td>
                    <td class="border p-0">{{$student_schools->programs->groups->name}}</td>
                    <td class="border p-0">{{$student_schools->programs->sections->name}}</td>
                    <td class="border p-0">{{$student_schools->programs->shifts->name}}</td>
                    <td class="border p-0">{{$student_schools->registered_date ?? '--'}}</td>
                    <td class="border p-0">{{$student_schools->discount ?? 0}}</td>
                    <td class="border p-0">{{$student_schools->active}}</td>
                    @else 
                    <td class="border p-0" colspan="9" >
                        <div class="alert alert-danger text-center m-0 rounded-0 border-0">
                        لا توجد بيانات لعرضها      
                        </div>  
                    </td>
                    @endif
                </tr>
              
            </table>
        </div>

        <div class="container-fluid px-0">
            <p>
                <i class="fa-solid fa-info"></i>
                معلومات أقرباء الطالب
            </p>
 
           
            <table class="table">
                <tr>
                    <td class="py-1">#</td>
                    <td class="py-1">الاسم</td>
                    <td class="py-1">صلة القرابة</td>
                    <td class="py-1">درجة القرابة</td>
                    <td class="py-1">العنوان</td>
                    <td class="py-1">البريد الإلكتروني</td>
                    <td class="py-1"> الهواتف  </td> 
                    <td class="py-1"> الوصول للتطبيق  </td> 
                </tr>
                @if (count($student_rels) > 0) 
                @foreach ($student_rels as $student_rel)
                <tr>
                    <td class="py-1">#</td>
                    <td class="py-1"> {{$student_rel->name}} </td>
                    <td class="py-1"> {{$student_rel->rel_type}} </td>
                    <td class="py-1"> {{$student_rel->rel_lev}} </td>
                    <td class="py-1"> {{$student_rel->address}} </td>
                    <td class="py-1"> {{$student_rel->email}} </td>
                    <td class="py-1"> {{$student_rel->phones}} </td> 
                    <td class="py-1"> {{($student_rel->is_subscribe == 1) ? 'له الصلاحية' : 'ليس له الصلاحية'}} </td> 
                </tr>
                @endforeach
                @else 
                    <td class="border p-0" colspan="8" >
                        <div class="alert alert-danger text-center m-0 rounded-0 border-0">
                        لا توجد بيانات لعرضها      
                        </div>  
                    </td>
                @endif
            </table>
             
        </div>


        <div class="container-fluid px-0">
            <p>
                <i class="fa-solid fa-info"></i>
                 السجل المرضي للطالب
            </p>

            <table class="table">
                <tr>
                    <td class="py-1">#</td>
                    <td class="py-1">اسم المرض </td>
                    <td class="py-1"> تاريخ الإصابة  </td>
                    <td class="py-1"> وراثي  </td>
                    <td class="py-1"> الحالةالآن </td>
                    <td class="py-1"> تعليق طبي  </td>
                    <td class="py-1"> تاريخ تسجيل الاصابة  </td>  
                </tr>
                @if ( $student_helths   ) 
                @foreach ($student_helths as $student_helth)
                <tr>
                    <td class="py-1">#</td>
                    <td class="py-1"> {{$student_helth->disease}} </td>
                    <td class="py-1"> {{$student_helth->date_of_injury}} </td>
                    <td class="py-1"> {{$student_helth->hereditary}} </td>
                    <td class="py-1"> {{$student_helth->case_now}} </td>
                    <td class="py-1"> {{$student_helth->h_comments}} </td>
                    <td class="py-1"> {{$student_helth->register_date}} </td> 
                </tr>
                @endforeach
                @else 
                    <td class="border p-0" colspan="8" >
                        <div class="alert alert-danger text-center m-0 rounded-0 border-0">
                        لا توجد بيانات لعرضها      
                        </div>  
                    </td>
                @endif
            </table>
        </div>
    </div>
@endsection


<script>
    window.print();

  
        window.addEventListener("afterprint", function() {
            window.close();
        });
           window.addEventListener("aftercancel", function() {
            window.close();
        });
   
</script>