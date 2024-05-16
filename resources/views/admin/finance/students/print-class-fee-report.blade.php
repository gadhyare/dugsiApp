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
                size: portrait  /*landscape*/
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
                <td colspan="3" class="text-center fw-bold" style="font-size:12px">   كشف مدفوعات فصل  </td>
                <td colspan="3" class="text-center fw-bold" style="font-size:12px">   {{\App\Models\Programs::where('id' , '=' , $programs_id)->first()->program_name()}} </td>
                <td colspan="3" class="text-center fw-bold" style="font-size:12px">   جهة الدفع: {{ \App\Models\FeesType::where('id' , '=' , $feestypes_id)->first()->name }} </td>
                <td colspan="3" class="text-center fw-bold" style="font-size:12px">   الدورة المالية    :  {{ \App\Models\BillingCycle::where('id' , '=' , $billing_cycle_id)->first()->name }} </td>
            </tr>

        </table>

 
    <br>

    <table class="table table-bordered fw-bold " style="font-size:12px">
        <tr>
            <td class="p-1">الرقم</td>
            <td class="p-1">الاسم</td>
            <td class="p-1">الرقم العائلي</td> 
            <td class="p-1"> التاريخ  </td> 
            <td class="p-1"> المطلوب  </td> 
            <td class="p-1"> الخصم  </td> 
            <td class="p-1"> المدفوع  </td>
            <td class="p-1"> متبقي سابق  </td>
            <td class="p-1">  إجمال متبقي على الطالب  </td>
            
        </tr>
        @php $i = 1 @endphp
        @php $amount = 0 @endphp
        @php $want = 0 @endphp
        @php $bastBlacne = 0 @endphp
        @php $descount = 0 @endphp
        @foreach ($feetrans as $item)
        <tr>
            <td class="p-1 text-center"  style="font-size:9px"> {{ $i++ }}</td>
            <td class="p-1 "  style="font-size:9px"> {{ $item->programs->Students_schoolInfo->where('students_info_id' , '=' , $item->students_info_id)->first()->studentInfo->name()    }} </td>
            <td class="p-1 text-center"  style="font-size:9px">{{ $item->programs->Students_schoolInfo->where('students_info_id' , '=' , $item->students_info_id)->first()->studentInfo->getFamilyNumber()   }}     </td>
            <td class="p-1 text-center"  style="font-size:9px"> {{ $item->paid_date ?? '--'   }}  </td>
            <td class="p-1 text-center"  style="font-size:9px"> @php $want +=$item->want @endphp ${{ $item->want    }}  </td>
            <td class="p-1 text-center"  style="font-size:9px"> @php $descount +=$item->descount @endphp ${{ $item->descount    }}  </td>
            <td class="p-1 text-center"  style="font-size:9px"> @php $amount +=$item->amount @endphp ${{  $item->amount ??0   }}  </td>
            <td class="p-1 text-center"  style="font-size:9px"> @php $bastBlacne +=SystemInfo::getPastStudentFee($item->studentInfo->id , $programs_id , $feestypes_id , $billing_cycle_id ) @endphp ${{ SystemInfo::getPastStudentFee($item->studentInfo->id , $programs_id , $feestypes_id , $billing_cycle_id ) ?? 0 }}  </td>
            <td class="p-1 text-center"  style="font-size:9px"> ${{ ($item->want  +  SystemInfo::getPastStudentFee($item->studentInfo->id , $programs_id , $feestypes_id , $billing_cycle_id )) - ($item->amount + $item->descount) ?? 0    }}  </td>
             
        </tr>
        @endforeach
        <tr>
        <td class="p-1 text-center" colspan="4"  style="font-size:9px"> الإجمالي : </td>
        <td class="p-1 text-center"  style="font-size:9px">${{$want}}</td>
        <td class="p-1 text-center"  style="font-size:9px">${{$descount}}</td>
        <td class="p-1 text-center"  style="font-size:9px">${{$amount}}</td>
        <td class="p-1 text-center"  style="font-size:9px">${{$bastBlacne}}</td>
        <td class="p-1 text-center"  style="font-size:9px">${{($want + $bastBlacne) - $amount}}</td>
        </tr>
    </table>
@endsection
<script>
    window.print();


    window.addEventListener('afterprint', function() {
  window.close();
});
</script>
