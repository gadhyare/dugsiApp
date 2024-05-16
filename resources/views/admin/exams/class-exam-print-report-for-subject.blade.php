@extends('admin.layouts.loged-master-no-header-for-non-livewire') <!-- -no-header -->
@section('content')
    <style>
        body {
            font-family: 'rubik' !important;
            direction: rtl !important;
            font-size: 14px
        }

        .title {
            text-align: center;
        }

         
    </style>
    <div class="container-fluid my-0 py-0 print-section text-center">
      <img src="{{ asset('storage/images/' . SystemInfo::setting('logo') ) }}" alt="{{ SystemInfo::setting('name') }}"
                    class=" w-75 m-auto" style="height: 120px " >
                <table  style="margin: 0 auto; width:100%" > 
                    <tr>
                        <td class="border-0 mt-0 py-1 text-center"> 
                            العنوان: {{ SystemInfo::setting('address') }}   -
                          الهواتف: {{ SystemInfo::setting('phones') }}    -
                          البريد الإلكتروني{{ SystemInfo::setting('email') }} </td>
                    </tr>
                </table>  
            <tr> 
                <td   style="border:none" class="p-0">
                    <div class="py-0"  >
                        <p  class="py-0" > كشف اختبار الفصل لمادة   - 
                            {{ \App\Models\Programs::where('id', '=', $program_id)->first()->program_name() }}  - عدد الطلبة:  {{ $exams->count() }}</p>
                    </div>
                </td>
            </tr>  
        </table>
    </div>

    <br>

    <table class="table table-bordered">
        <tr>
            <th class="p-1 fw-bold"  style="font-size: 10px">
                #
            </th>
            <th class="p-1 fw-bold"  style="font-size: 10px">
                الاسم
            </th> 
            <th class="p-1 fw-bold"  style="font-size: 10px">
                الاسئلة1
            </th>
            <th class="p-1 fw-bold"  style="font-size: 10px">
                الاختبار النصفي
            </th>
            <th class="p-1 fw-bold"  style="font-size: 10px">
                الأسئلة 2
            </th>
            <th class="p-1 fw-bold"  style="font-size: 10px">
                الاختبار النهائي
            </th>
            <th class="p-1 fw-bold"  style="font-size: 10px">
                الحضور
            </th>
            <th class="p-1 fw-bold"  style="font-size: 10px">
                المجموع
            </th> 
        </tr>
        @php $i = 1 @endphp
        @foreach ($exams as $exam)
            <tr>
                <td class="p-1 fw-bold"  style="font-size: 10px">
                    {{ $i++ }}
                </td>
                <td class="p-1 fw-bold"  style="font-size: 10px">
                    {{ SystemInfo::get_full_student_name($exam->students_info_id) }}
                </td> 

                <td class="p-1 fw-bold"  style="font-size: 10px">  {{$exam->qu1}}  </td>
                <td class="p-1 fw-bold"  style="font-size: 10px">  {{$exam->ex1}}  </td>
                <td class="p-1 fw-bold"  style="font-size: 10px">  {{$exam->qu2}}  </td>
                <td class="p-1 fw-bold"  style="font-size: 10px">  {{$exam->ex2}}  </td> 
                <td class="p-1 fw-bold"  style="font-size: 10px">  {{$exam->att}}  </td> 
                <td class="p-1 fw-bold"  style="font-size: 10px">
                        {{$exam->where('students_info_id', '=', $exam->students_info_id)->where('subjects_distributions_id' , '=' , $exam->subjects_distributions_id)->sum( 'qu1') + $exam->where('students_info_id', '=', $exam->students_info_id)->where('subjects_distributions_id' , '=' , $exam->subjects_distributions_id)->sum('ex1' ) + $exam->where('students_info_id', '=', $exam->students_info_id)->where('subjects_distributions_id' , '=' , $exam->subjects_distributions_id)->sum( 'qu2' ) +$exam->where('students_info_id', '=', $exam->students_info_id)->where('subjects_distributions_id' , '=' , $exam->subjects_distributions_id)->sum( 'ex2' ) +$exam->where('students_info_id', '=', $exam->students_info_id)->where('subjects_distributions_id' , '=' , $exam->subjects_distributions_id)->sum('att' )}}
                </td>  
            </tr>
        @endforeach
    </table>
@endsection


<script>
    window.print();
</script>