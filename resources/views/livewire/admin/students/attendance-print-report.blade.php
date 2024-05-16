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
                size: landscape
            }
        }
    </style>
    <div class="container-fluid my-0 py-0 print-section text-center">
        <img src="{{ asset('storage/images/' . SystemInfo::setting('logo')) }}" alt="{{ SystemInfo::setting('name') }}"
            class=" w-75 m-auto" style="height: 120px ">
    </div>
    <table style="margin: 0 auto; width:100% ; font-size:11px " class="fw-bold">
        <tr>
            <td class="border-0 mt-0 py-1 text-center">
                العنوان: {{ SystemInfo::setting('address') }} -
                الهواتف: {{ SystemInfo::setting('phones') }} -
                البريد الإلكتروني{{ SystemInfo::setting('email') }} </td>
        </tr>

        <tr>
            <td style="border:none" class="p-0">
                <div class="py-0 text-center">
                    {{ \App\Models\Programs::where('id', '=', request()->programs_id)->first()->program_name() }} - عدد
                    الطلبة: {{ $studentsInfos->count() }}
                </div>

            </td>
        </tr>
        <tr>
            <td class="border-0 mt-0 py-1 text-center">
                كشف حضور لشهر : {{ SystemInfo::getMonthName(date('m', strtotime(request()->att_date)))     }}  {{date('Y', strtotime(request()->att_date))}}
            </td>
        </tr>
    </table>

    <table class="table table-bordered">
        <tr>
            <th class="p-1 fw-bold" style="font-size: 10px"> م </th>
            <th class="p-1 fw-bold" style="font-size: 10px">اسم الطالب
            </th>
            <th class="p-1 fw-bold" style="font-size: 10px">رقم الطالب</th>
            @if (count($studentsInfos) > 0)
                @foreach ($data_range as $item)
                    <th class="p-1 fw-bold" style="font-size: 10px">{{ date('d', strtotime($item->att_date)) }}</th>
                @endforeach
                <th class="p-1 fw-bold" style="font-size: 10px"> ا.حضور </th>
                <th class="p-1 fw-bold" style="font-size: 10px"> ا.غياب </th>
            @endif
        </tr>

        @php $i = 1; @endphp
        <br>

        @if (count($studentsInfos) > 0)
            @foreach ($studentsInfos as $info)
                <tr>
                    <td class="p-1 fw-bold" style="font-size: 10px">
                        {{ $i++ }}
                    </td>
                    <td class="p-1 fw-bold" style="font-size: 10px">
                        {{ $info->studentInfo->name() }}
                    </td>
                    <td class="p-1 fw-bold" style="font-size: 10px">
                        {{ $info->studentInfo->student_number() }}
                    </td>
                    @foreach ($data_range as $item)
                        <td class="p-1 fw-bold" style="font-size: 10px">
                            {{ $xuduurs->where('att_date', $item->att_date)->where('students_info_id', $info->students_info_id)->first()?->Att_status() ?? '-' }}
                        </td>
                    @endforeach
                    <td class="p-1 fw-bold" style="font-size: 10px">
                        {{ $xuduurs->where('students_info_id', $info->students_info_id)->where('status', '=', 1)->count() ?? '-' }}
                    </td>
                    <td class="p-1 fw-bold" style="font-size: 10px">
                        {{ $xuduurs->where('students_info_id', $info->students_info_id)->where('status', '=', 0)->count() ?? '-' }}
                    </td>
                </tr>
            @endforeach
        @endif

    </table>

@endsection


<script>
    window.print();
</script>
