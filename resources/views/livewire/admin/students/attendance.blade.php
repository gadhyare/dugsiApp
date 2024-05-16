<div class="container  bg-white p-2">
    <div class="container px-0 d-flex justify-content-between">
        <input type="date" wire:model.live.debounce.300="att_date" class="form-control w-25">
        <button wire:click="add" class="btn btn-green-500 shadow text-white fw-bold">
            <i class="fa-solid fa-plus"></i>
            <span>
                تحضير الفصل
            </span>
        </button>
        <a   href="{{route('student.attendance.report' , $programs_id)}}" class="btn btn-pink-500 shadow text-white fw-bold">
            <i class="fa-solid fa-print"></i>
            <span>التقريـــــر</span>
        </a>
    </div>
    @php
        $serial = 1;
    @endphp


    <div class="col-xs-12 col-sm-12 col-md-10">
        <div wire:loading.inline class="px-4 py-1 float-start "> <img
                src="{{ asset('images/loading-loading-forever.gif') }}" alt="loading" style="width: 15px;height:15px">
        </div>
        <table class="table table-bordered">
            <thead>
                <th> م </th>
                <th>اسم الطالب
                </th>
                <th>رقم الطالب</th>
                <th> الحضور </th>
            </thead>
            <br>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $serial++ }}</td>
                        <td>{{ SystemInfo::get_full_student_name($student->students_info_id) }} </td>
                        <td>{{ $student->studentInfo->family_number->fnumber }}-{{ $student->studentInfo->id }}
                        </td>
                        <td class="text-center p-2">
                            <input type="checkbox" value="{{ $student->students_info_id }}"
                                wire:model="students_info_id">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
