<div class="container-fluid">
    <div class="card border-0 p-3 shadow-lg ">
        @if (Session::has('status'))
            <div class="alert alert-success text-center ">{{ Session::get('status') }}</div>
        @endif



        <div class="container my-2 px-0">
            <a href="{{ route('employees.register') }}" class="btn btn-warning float-start py-0 shadow px-3">
                <small><i class="fa-solid fa-plus "></i> <span>اضافة</span></small>
            </a>
        </div>

        {{-- أقرباء للطالب [{{$getStudent->name}} {{$getStudent->father->name}} - {{$getStudent->father->number}}] --}}

        @php
            $serial = ($emplooye_info->currentpage() - 1) * $emplooye_info->perpage() + 1;
        @endphp
        {{-- Show all expenses type list --}}
        <x-table :headers="[
            '#',
            'الصورة',
            'الاسم',
            'الجنس',
            'تاريخ التسجيل',
            'الهواتف',
            'المستحقات المالية',
            'البريد الإلكتروني',
            'محرر',
            'الحالة',
            'العمليات',
            'التعديل',
            'الحذف',
        ]">

            @foreach ($emplooye_info as $item)
                <tr>
                    <td>{{ $serial++ }}</td>
                    <td>{{ $item->phones }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->gender == 1 ? 'ذكر' : 'أنثى' }}</td>
                    <td>{{ $item->register_date }}</td>
                    <td>{{ $item->phones }}</td>
                    <td>{{ Systeminfo::get_employee_finance($item->id) }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->is_subscribed == 2 ? 'ليس بمحرر' : 'محرر' }}</td>
                    <td>{{ $item->active == 1 ? 'مفعل' : 'غير مفعل' }}</td>
                    <td>
                        <button class="border-0 dropdown-toggle" type="button" id="dropdownMenuButton{{ $item->id }}"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-check-double"></i> <span>العمليات</span>
                        </button>
                        <ul class="dropdown-menu text-end px-2"
                            aria-labelledby="dropdownMenuButton{{ $item->id }}">
                            <li><a class="dropdown-item" href="{{ route('employees.jobs', $item->id) }}"> الوظيفة الحالية
                                      </a></li>
                            <li><a class="dropdown-item" href="{{ route('employees.attachment', $item->id) }}"> مرفقات
                                    الموظف </a></li>
                                    <li><a class="dropdown-item" href="{{ route('employees.finance', $item->id) }}"> مالية
                                        الموظف </a></li>
                        </ul>
                    </td>
                    <td>

                        <small>
                            <a href="{{ route('employees.update', $item->id) }}">
                                <i class="fa-solid fa-pen  bg-success  text-white  shadow p-1"></i>
                            </a>
                        </small>
                    </td>
                    <td>


                        <x-delete-confirm btnTitle="حذف" recId="{{ $item->id }}">
                            [{{ $item->name }}]
                        </x-delete-confirm>

                    </td>
                </tr>
            @endforeach
        </x-table>



        {{ $emplooye_info->links() }}
    </div>
</div>
