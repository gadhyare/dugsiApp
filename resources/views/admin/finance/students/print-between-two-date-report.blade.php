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
                size: landscape /*portrait*/
            }
        }
    </style>
    <div class="container-fluid  print-section">

        <table style="margin: 0 auto; width:100%">
            <tr>
                <td>
                    <img src="{{ asset('storage/images/' . SystemInfo::setting('logo')) }}"
                        alt="{{ SystemInfo::setting('name') }}" class=" m-auto" style="height: 120px; width:100% ">
                </td>
            </tr>
            <tr>
                <td class="border-0 mt-0 py-1 text-center" style="font-size: 12px">
                    العنوان: {{ SystemInfo::setting('address') }} -
                    الهواتف: {{ SystemInfo::setting('phones') }} -
                    البريد الإلكتروني{{ SystemInfo::setting('email') }} </td>
            </tr>
        </table>

        <table class="table  m-auto" style="font-size: 9px">
            <tr>
                <td colspan="3" class="text-center fw-bold" style="font-size:12px">   كشف مدفوعات الطلبة الطلبة ما بين :[ {{$from}}] - [{{$to}}] </td>
            </tr>

        </table>


    <br>

    <table class="table table-bordered fw-bold " style="font-size:12px">
        <tr>
            <td class="p-1">الرقم</td>
            <td class="p-1">الاسم</td>
            <td class="p-1">الرقم العائلي</td>
            <td class="p-1"> الفصل </td>
            <td class="p-1">نوع الرسوم</td>
            <td class="p-1"> المبلغ  </td>
            <td class="p-1"> التاريخ  </td>
            <td class="p-1"> الخزينة  </td>
        </tr>
        @php $i = 1 @endphp
        @php $total = 0 @endphp
        @foreach ($feetrans as $item)
        <tr>
            <td class="p-1"  style="font-size:9px"> {{ $i++ }}</td>
            <td class="p-1"  style="font-size:9px"> {{ $item->invoices->programs->Students_schoolInfo->where('students_info_id' , '=' , $item->invoices->students_info_id)->first()->studentInfo->name()    }} </td>
            <td class="p-1"  style="font-size:9px">{{ $item->invoices->programs->Students_schoolInfo->where('students_info_id' , '=' , $item->invoices->students_info_id)->first()->studentInfo->getFamilyNumber()   }}     </td>
            <td class="p-1"  style="font-size:9px"> {{ $item->invoices->programs->program_name()    }} </td>
            <td class="p-1"  style="font-size:9px"> {{ $item->invoices->feestypes->name   }}  </td>
            <td class="p-1"  style="font-size:9px"> @php $total +=$item->amount @endphp ${{  $item->amount    }}  </td>
            <td class="p-1"  style="font-size:9px"> {{ $item->paid_date    }}  </td>
            <td class="p-1"  style="font-size:9px"> {{$item->banks->name}}  </td>
        </tr>
        @endforeach
        <tr>
        <td class="p-1" colspan="7"  style="font-size:9px"> الإجمالي : </td>
        <td class="p-1"  style="font-size:9px">${{$total}}</td>
        </tr>
    </table>
@endsection
<script>
    window.print();
</script>
