<div class="bg-white p-2">
    @if ( isset( $programs_id) )
          
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label   class="col-form-label">المرحلة الدراسية </label>
                </div>
                <div class="col-auto">
                        
                    <select wire:model.live.debounce.250ms="levels_id"
                        class="form-select  rounded-0 w-100 @error('levels_id') bg-danger text-white @enderror">
                        <option> اختر المرحلة الدراسية </option>
                        @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-auto">
                    <label   class="col-form-label"> الصف </label>
                </div>
                <div class="col-auto">
                    <select wire:model.live.debounce.250ms="classes_id"
                        class="form-select  rounded-0 w-100 @error('classes_id') bg-danger text-white @enderror">
                        <option> اختر الصف </option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                    
                </div>

                <div class="col-auto">
                    <label   class="col-form-label"> الشعبة </label>
                </div>
                <div class="col-auto">
                    <select wire:model.live.debounce.250ms="groups_id"
                        class="form-select  rounded-0 w-100 @error('groups_id') bg-danger text-white @enderror">
                        <option> اختر الشعبة </option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <label   class="col-form-label"> الفترة </label>
                </div>
                <div class="col-auto">
                    <select wire:model.live.debounce.250ms="shifts_id"
                        class="form-select  rounded-0 w-100 @error('shifts_id') bg-danger text-white @enderror">
                        <option> اختر الفترة </option>
                        @foreach ($shifts as $shift)
                            <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <label   class="col-form-label"> القسم </label>
                </div>
                <div class="col-auto">
                    <select wire:model.live.debounce.250ms="sections_id"
                        class="form-select  rounded-0 w-100 @error('sections_id') bg-danger text-white @enderror">
                        <option> اختر القسم </option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-success rounded shadow "> اضافة </button>
                </div>
            </div>
       
        <div class="container">


                @php
                    $serial = ($students->currentpage() - 1) * $students->perpage() + 1;
                @endphp

                <span class="float-start">
                    <button type="submit" class="btn btn-primary rounded-0 shadow" wire:click='upgrade' wire:confirm="Are you sure you want to delete this post?">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>
                            تصعيد الفصل
                        </span>
                    </button>

                </span>
                <br>
                <br>
                <table class="table table-bordered">
                    <thead>
                        <th>no</th>
                        <th>اسم الطالب</th>
                        <th>رقم الطالب</th>
                    </thead>
                    <tbody>

                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $serial }}</td>
                                <td>{{  $student->studentInfo->name()  }}   </td>
                                <td>{{ $student->studentInfo->family_number->fnumber }}-{{ $student->id }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

        </div>
@else

    <div class="alert alert-danger text-center">
         لم تختر الفصل
         <p>

            <b>
                <a href="{{route('programs.index')}}" class="text-red-500 text-decoration-none">اضغط هنا لاختيار الفصل</a>
            </b>
         </p>
    </div>
    @endif
</div>
