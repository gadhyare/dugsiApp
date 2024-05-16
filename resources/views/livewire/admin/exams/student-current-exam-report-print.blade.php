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

        <table class="table w-75 m-auto" style="font-size: 9px">
            <tr>
                <td colspan="3" class="text-center fw-bold" style="font-size:14px"> كشف درجات طالب  </td>
            </tr>
            <tr>
                <td> الاسم: {{ $student->name() }} </td>
                <td> معلومات الفصل الحالية:
                    {{ \App\Models\Programs::where('id', '=', $programs_id)->first()->program_name() }} </td>
                <td>
                    الرقم العائلي: {{ $student->family_number->fnumber }}
                </td>
            </tr>
        </table>

        <br>


        <table class="table table-bordered fw-bold " style="font-size: 9px">
            <tr>
                <td class="p-1" style="width:15%"> المادة </td>
                <td class="p-1"  style="width:10%"> الدرجة العليا </td>
                <td class="p-1"  style="width:10%"> الدرجة الدنيا </td>
                <td class="p-1"  style="width:10%"> الدرجة الأرقام </td>
                <td class="p-1"> الدرجة بالأحرف </td>
            </tr>
            @php $grandTotal = 0 @endphp
            @foreach ($exams as $exam)
                <tr>
                    <td class="p-1"> {{ $exam->subjects_distributions->subjects->name }} </td>
                    <td class="p-1"  style="width:10%"> 100 </td>
                    <td class="p-1"  style="width:10%"> 50 </td>
                    <td class="p-1"  style="width:10%"> @php $grandTotal += $exam->total() @endphp {{ $exam->total() }} </td>
                    <td class="p-1"  > {{SystemInfo::tafqiidNumber($exam->total())}} فقط لا غير </td>
                </tr>
            @endforeach

        </table>
        <br>
        <table class="table table-bordered fw-bold " style="font-size: 9px">

            <tr>
                <td class="p-1"  style="width:15%"> المجموع </td>
                <td class="p-1"  style="width:10%"> {{ count($exams) * 100 }} </td>
                <td class="p-1"  style="width:10%"> {{ count($exams) * 50 }}</td>
                <td class="p-1" style="width:10%"> {{ $grandTotal }} </td>
                <td class="p-1" >  {{SystemInfo::tafqiidNumber($grandTotal)}} فقط لا غير  </td>
            </tr>
        </table>

<table class="table  border-0" style="font-size: 9px">
            <tr>
                <td class="p-1"> </td>

                <td class="p-1"> التقدير {{$grandTotal /count($exams) }} % </td>
                <td class="p-1">
                     {{SystemInfo::tafqiidNumber($grandTotal /count($exams))}} فقط لا غير
                </td>
                <td class="p-1">

                    @if ($grandTotal >= (count($exams) * 50  ))

                        ناجح
                    @else
                            راسب
                    @endif
            </td>

            </tr>
</table>
        <table class="table  border-0" style="font-size: 9px">
            <tr>
                <td class="border-0 p-1">مدير المؤسسة: </td>
                <td class="border-0 p-1"> </td>
                <td class="border-0 p-1"> التوقيع </td>
            </tr>

            <tr>
                <td class="border-0 p-1"> مدير شؤون الطلاب : </td>
                <td class="border-0 p-1"> </td>
                <td class="border-0 p-1"> التوقيع </td>
            </tr>

            <tr>
                <td class="border-0 p-1"> رئيس قسم الاختبارات : </td>
                <td class="border-0 p-1"> </td>
                <td class="border-0 p-1"> التوقيع </td>
            </tr>
        </table>
    </div>

    <script>
        window.print();

        window.addEventListener('aftercancel', ()=> {
            window.close();
        })


                window.addEventListener('afterprint', ()=> {
            window.close();
        })
    </script>
