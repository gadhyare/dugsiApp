<div class="container-fluid bg-white p-2">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2">
            <div class="card rounded-0">
                <div class="card-header  bg-white ">
                    <i class="fa-solid fa-list"></i>
                    قائمة الفصل
                </div>
                <div class="card-body">
                        <div class="form-group my-2 fw-bold">
                            <label class="container px-0 py-2" for="group"> المجموعة
                                <span class="float-start">
                                    @error('att_date')
                                        <div class="bg-danger text-white px-2">
                                            مطلوب
                                        </div>
                                    @enderror
                                </span>
                            </label>
                            <input type="date" wire:model.live.debounce.300="att_date" class="form-control  ">
                        </div>
                        @if ($att_date && count($studentsInfos) > 0)
                           <a href="{{route('student.attendance.print.report' , ['programs_id' => $programs_id , 'att_date' => $att_date])}}" class="btn btn-red-500 text-white fw-bold">
                        <i class="fa-solid fa-print"></i>
                </a>
                        @endif

                </div>
            </div>
        </div>
        @php
            $serial = 1;
        @endphp
        <div class="col-xs-12 col-sm-12 col-md-10">
            <div wire:loading.inline class="px-4 py-1 float-start "> <img
                    src="{{ asset('images/loading-loading-forever.gif') }}" alt="loading"
                    style="width: 15px;height:15px"> </div>

            <div class="container fw-bold text-center">
                <div>
                    تقرير حضور | الشهر

                    @if ($att_date)
                        {{ SystemInfo::getMonthName(date('m', strtotime($att_date))) . ' - ' . date('Y', strtotime($att_date)) }}
                    @endif
                </div>
                <div>
                    {{ \App\Models\Programs::where('id', '=', $programs_id)->first()->program_name() }}
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th> م </th>
                        <th>اسم الطالب
                        </th>
                        <th>رقم الطالب</th>
                        @if (count($studentsInfos) > 0)
                            @foreach ($data_range as $item)
                                <th>{{ date('d', strtotime($item->att_date)) }}</th>
                            @endforeach
                        @endif
                    </tr>
                </thead>
                @php $i = 1; @endphp
                <br>
                <tbody>
                    @if (count($studentsInfos) > 0)
                        @foreach ($studentsInfos as $info)
                            <tr>
                                <td>
                                    {{ $i++ }}
                                </td>
                                <td>
                                    {{ $info->studentInfo->name() }}
                                </td>
                                <td>
                                    {{ $info->studentInfo->student_number() }}
                                </td>
                                @foreach ($data_range as $item)
                                    <td> {{ $xuduurs->where('att_date', $item->att_date)->where('students_info_id', $info->students_info_id)->first()?->Att_status() ?? '-' }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
