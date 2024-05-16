     <div class="contianer-fluid border-0 py-3  ">
        @if (Session::has('status'))
            <div class="alert alert-success text-center ">{{ Session::get('status') }}</div>
        @endif 
        <div>
            <a href="{{route('students.register')}}" class="btn bg-red-500 text-white fw-bold float-start"> تسجيل طالب جديد </a>
        </div>
        <br> 
        @php
            $serial = 1;
        @endphp
        {{-- Show all expenses type list --}}
        <div class=" px-0">
            <span class="float-end w-25">
                <input type="text" class="form-control my-2  rounded-1" wire:model.live.debounce.300="search">
            </span>
            <span class="float-end w-25">
                <button class="btn bg-orange-500 m-2  rounded-1" wire:click.prevent="cancel">
                    <i class="fa-solid fa-filter"></i>
                </button>
            </span>
        </div>

        <table class="table border">
            <thead>
                <tr>
                    <th class="bg-blue-700 text-blue-100">#</th>
                    <th class="bg-blue-700 text-blue-100">الاسم</th>
                    <th class="bg-blue-700 text-blue-100">الرقم العائلي</th>
                    <th class="bg-blue-700 text-blue-100">الجنس</th>
                    <th class="bg-blue-700 text-blue-100">فصيلة الدم </th>
                    <th class="bg-blue-700 text-blue-100">المدينة</th>
                    <th class="bg-blue-700 text-blue-100">الهواتف</th>
                    <th class="bg-blue-700 text-blue-100">الصورة</th>
                    <th class="bg-blue-700 text-blue-100">العمليات</th> 
                </tr>
            </thead>
            <tbody>

                @foreach ($students as $student)
                    <tr>
                        <td>{{ $serial++ }}</td>
                        <td>{{ SystemInfo::get_full_student_name($student->id) }} </td>
                        <td> {{ $student->family_number->fnumber }} </td>
                        <td>{{ $student->sex }}</td>
                        <td>{{ $student->blood_group }}</td>
                        <td>{{ $student->city }}</td>
                        <td>{{ $student->phone }}</td>
                        <td>
                            @php $src = ($student->photo != '') ? $student->photo : 'muunad.jpg' @endphp
                            <img src="{{ Storage::url('uploads/images/students/' .   $src) }}"
                                class="rounded-circle shadow-lg" style="width:30px; height: 30px" />
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="border-0 dropdown-toggle bg-blue-700 text-blue-100 rounded-1" type="button"
                                    id="dropdownMenuButton{{ $student->id }}" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                     <span>العمليات</span>
                                </button>
                                <ul class="dropdown-menu text-end px-2"
                                    aria-labelledby="dropdownMenuButton{{ $student->id }}">
                                    <li >
                                        <a class="dropdown-item"
                                            href="{{ route('students.current.info.update', $student) }}"> التعديل
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item" target="_blank"
                                            href="{{ route('students.current.info.pdf', $student->id) }}"> طباعة </a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('strurel.index', $student->id) }}">
                                            أقرباء
                                            للطالب </a></li>
                                    <li><a class="dropdown-item" href="{{ route('helth.record', $student->id) }}">
                                            السجل
                                            الطبي </a></li>
                                    <li><a class="dropdown-item" href="{{ route('school.record', $student->id) }}">
                                            السجل
                                            الدراسي </a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('student.attachment', $student->id) }}">
                                            مرفقات الطالب </a></li>
                                </ul>
                            </div>
                        </td>
                       
                    </tr>
                @endforeach
            </tbody>

        </table>
{{ $students->links() }}
    </div>
 
 
