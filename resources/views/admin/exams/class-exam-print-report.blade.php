@extends('admin.layouts.loged-master-no-header-for-non-livewire') <!-- -no-header -->
@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap') body {
            font-family: 'rubik' !important;
            direction: rtl !important;
        }

        .title {
            text-align: center;
        }

        @media print {
            @page {
                size: portrait 
            }
        }
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
    
    <div style="float: left; ">
        <table style="border:none; width:100% ">
            <tr>
                <td rowspan="5" style="border:none">
                    <img src="{{ $hedaer_logo }}" alt="" style="height:60px">
                </td>
            </tr>
            <tr>
                <td style="border:none; padding:1px 10px !important;text-algin:right">
                    {{ $data?->name }}
                </td>
                <td colspan="4" style="border:none">
                    <div class="title" style="font-size: 10px">
                        <p style="padding:2px 0">كشف اختبار الفصل لمادة </p>
                        <p style="padding:2px 0">
                            {{ \App\Models\Programs::where('id', '=', $program_id)->first()->program_name() }}</p>
                        <p style="padding:2px 0">عدد الطلبة:{{ $exams->count() }}</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border:none">
                    {{ $data?->description }}
                </td>
            </tr>
            <tr>
                <td style="border:none">
                    {{ $data?->address }}
                </td>
            </tr>
            <tr>
                <td style="border:none">
                    {{ $data?->phones }}
                </td>

            </tr>
        </table>
    </div>

    <br>

    <table>
        <tr>
            <th>
                #
            </th>
            <th>
                الاسم
            </th>
            @foreach ($subjects as $subject)
                <th class="title" style="padding:3px 7px">
                    {{ $subject->subjects_distributions->subjects->name }}
                </th>
            @endforeach
            <th>
                المجموع
            </th>
            <th>
                النسبة
            </th>
        </tr>
        @php $i = 1 @endphp
        @foreach ($exams as $exam)
            <tr>
                <td style="padding:3px 7px">
                    {{ $i++ }}
                </td>
                <td class="title">
                    {{ SystemInfo::get_full_student_name($exam->students_info_id) }}
                </td>

                @foreach ($subjects as $subject)
                    <td style="text-align: center ;padding:3px 7px" class="title">
                        {{ $exam->where('subjects_distributions_id', '=', $subject->subjects_distributions->id)->where('students_info_id', '=', $exam->students_info_id)->first()->total() }}
                    </td>
                @endforeach
                <td style="padding:3px 7px">
                        {{$exam->where('students_info_id', '=', $exam->students_info_id)->sum( 'qu1') + $exam->where('students_info_id', '=', $exam->students_info_id)->sum('ex1' ) + $exam->where('students_info_id', '=', $exam->students_info_id)->sum( 'qu2' ) +$exam->where('students_info_id', '=', $exam->students_info_id)->sum( 'ex2' ) +$exam->where('students_info_id', '=', $exam->students_info_id)->sum('att' )}}
                </td>
                <td style="padding:3px 7px">
                        {{($exam->where('students_info_id', '=', $exam->students_info_id)->sum( 'qu1') + $exam->where('students_info_id', '=', $exam->students_info_id)->sum('ex1' ) + $exam->where('students_info_id', '=', $exam->students_info_id)->sum( 'qu2' ) +$exam->where('students_info_id', '=', $exam->students_info_id)->sum( 'ex2' ) +$exam->where('students_info_id', '=', $exam->students_info_id)->sum('att' )) / $exam->where('students_info_id', '=', $exam->students_info_id)->count()}} %
                </td>

            </tr>
        @endforeach
    </table>

@endsection


<script>
    window.print();
</script>
