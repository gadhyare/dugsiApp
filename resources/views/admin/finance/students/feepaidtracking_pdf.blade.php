@extends('admin.layouts.loged-master-no-header')
@section('content')
    <style>
        body,
        table td,
        th {
            font-size: 10px;
        }
    </style>
    <div class="container-fluid my-2 py-2">
        <div class="row  ">
            <div class="col-4 ">
                <table class="table">
                    <tr>
                        <td class="border-0 mt-0 py-0"> {{ SystemInfo::setting('name') }} </td>
                    <tr>
                        <td class="border-0 mt-0 py-0"> {{ SystemInfo::setting('description') }} </td>
                    </tr>
                    <tr>
                        <td class="border-0 mt-0 py-0"> {{ SystemInfo::setting('address') }} </td>
                    </tr>
                    <tr>
                        <td class="border-0 mt-0 py-0"> {{ SystemInfo::setting('phones') }} </td>
                    </tr>
                    <tr>
                        <td class="border-0 mt-0 py-0"> {{ SystemInfo::setting('email') }} </td>
                    </tr>
                </table>
            </div>

            <div class="col-2 ">
                <img src="{{ url('storage/images/' . SystemInfo::setting('logo')) }}" alt="{{ SystemInfo::setting('name') }}"
                    class=" m-auto" style="height: 80px;width:80px ;">
            </div>
            <div class="col-6 ">
                <div class="card p-0 rounded-0 border  z-depth-0">

                    <div class="card-header p-1">
                        <i class="fa-solid fa-list"></i>
                        رقم السند: #00{{ request()->route('id') }}
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <span> اسم الطالب </span>
                            <span class="px-2">
                                {{ SystemInfo::get_full_student_name($info->studentInfo->id) }}
                            </span>
                        </div>
                        <div class="form-group">
                            <span> المرحلة الدراسية </span>
                            <span class="px-2">
                                {{ $info->levels->name }}
                            </span>
                        </div>

                        <div class="form-group">
                            <span> الصف </span>
                            <span class="px-2">
                                {{ $info->classes->name }}
                            </span>
                        </div>
                        <div class="form-group">
                            <span> الفترة </span>
                            <span class="px-2">
                                {{ $info->shifts->name }}
                            </span>
                        </div>



                        <div class="form-group">
                            <span> القسم </span>
                            <span class="px-2">
                                {{ $info->sections->name }}
                            </span>
                        </div>
                        <div class="form-group">
                            <span> المجموعة </span>
                            <span class="px-2">
                                {{ $info->groups->name }}
                            </span>
                        </div>

                        <div class="form-group">
                            <span> جهة الدفع </span>
                            <span class="px-2">
                                {{ $info->feestypes->name }}
                            </span>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <span> الرسوم المقررة </span>
                                    <span class="px-2">
                                        {{ $info->want }}$
                                    </span>
                                </div>
                                <div class="col-6">
                                    <span> متبقي سابق </span>
                                    <span class="px-2">
                                         {{ SystemInfo::get_current_student_previous_balance(request()->route('stu_id') , request()->route('id'))}}
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>

        @php $i = 1 @endphp

        <div class="container-fluid px-0 my-2   rounded">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="border "> م </th>
                        <th class="border "> تاريخ الدفع </th>
                        <th class="border "> رقم الحساب </th>
                        <th class="border "> الخصم </th>
                        <th class="border "> المبلغ المدفوع </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($feetrans as $item)
                        <tr>
                            <td class="border"> {{ $i++ }}</td>
                            <td class="border"> {{ $item->paid_date }}</td>
                            <td class="border"> {{ $item->banks->name }}</td>
                            <td class="border"> {{ $item->descount }}</td>
                            <td class="border"> {{ $item->amount }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-end">
                            المتبقي
                        </td>
                        <td>
                            {{ $totalOfWantForCurrentStudent - $totalOfPaymentForCurrentStudent - $totalOfDescountForCurrentStudent }}
                            $
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>
@endsection


<script type="text/javascript">
    window.print();
    window.onfocus = function() {
        window.close();
    }
</script>
