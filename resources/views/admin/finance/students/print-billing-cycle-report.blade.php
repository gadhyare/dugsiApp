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
                <td colspan="3" class="text-center fw-bold" style="font-size:12px">   كشف مدفوعات حسب الدورة المنالية  </td>  
                <td colspan="3" class="text-center fw-bold" style="font-size:12px">   الدورة المالية    :  {{ \App\Models\BillingCycle::where('id' , '=' , $billing_cycle_id)->first()->name }} </td>
            </tr> 
        </table> 
    <br>
 
@endsection
<script>
    window.print();


    window.addEventListener('afterprint', function() {
  window.close();
});
</script>
