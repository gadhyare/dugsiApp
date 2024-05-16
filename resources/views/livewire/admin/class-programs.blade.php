<div>
    <div class="container-fluid bg-white">
        <div class="container  p-2 " >

            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="inputPassword6" class="col-form-label">المرحلة الدراسية </label>
                </div>
                <div class="col-auto">
                    <select wire:model.live="levels_id"
                        class="form-select  rounded-0 w-100 @error('levels_id') border-red-300 @enderror">
                        <option> اختر المرحلة الدراسية </option>
                        @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-auto">
                    <label for="inputPassword6" class="col-form-label"> الصف </label>
                </div>
                <div class="col-auto">
                    <select wire:model.live="classes_id"
                        class="form-select  rounded-0 w-100 @error('classes_id') border-red-300 @enderror">
                        <option> اختر الصف </option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-auto">
                    <label for="inputPassword6" class="col-form-label"> الشعبة </label>
                </div>
                <div class="col-auto">
                    <select wire:model.live="groups_id"
                        class="form-select  rounded-0 w-100 @error('groups_id') border-red-300 @enderror">
                        <option> اختر الشعبة </option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <label for="inputPassword6" class="col-form-label"> الفترة </label>
                </div>
                <div class="col-auto">
                    <select wire:model.live="shifts_id"
                        class="form-select  rounded-0 w-100 @error('shifts_id') border-red-300 @enderror">
                        <option> اختر الفترة </option>
                        @foreach ($shifts as $shift)
                            <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <label for="inputPassword6" class="col-form-label"> القسم </label>
                </div>
                <div class="col-auto">
                    <select wire:model.live="sections_id"
                        class="form-select  rounded-0 w-100 @error('sections_id') border-red-300 @enderror">
                        <option> اختر القسم </option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- //////////////////////////////////////////  --}}
                <div class="col-auto">
                    <label for="inputPassword6" class="col-form-label"> الحالة </label>
                </div>
                <div class="col-auto">
                    <select wire:model.live="status"
                        class="form-select  rounded-0 w-100  ">
                        <option value="1"> غير مؤرشفة </option>
                        <option value="2">   مؤرشفة </option>
                     
                    </select>
                </div>
                    
                {{-- //////////////////////////////////////////  --}}
                 
                 

                
                <div class="col-auto">
                    <button class="btn btn-success rounded shadow " wire:click="add"> اضافة </button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid bg-white p-2">
        <h4 class="text-end px-3 ">
            معلومات البرنامج
        </h4>

        <br>
        <div class="accordion rounded-0" id="accordionExample">
            @foreach ($programs as $program)
                <div class="accordion-item my-1 rounded-0 border">
                  <h1 class="accordion-header rounded-0" id="headingOne-{{$program->id}}">
                    <button class="accordion-button @if($program->status == 1)}} bg-indigo-400 @else bg-red-400 @endif  shadow fw-bold   text-white rounded-0 gadhyare"   type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-{{$program->id}}" aria-expanded="true" aria-controls="collapseOne-{{$program->id}}">
                       <b >
                            {{$program->levels->name}} | {{$program->classes->name}} | {{$program->shifts->name}} | {{$program->groups->name}} | {{$program->sections->name}}
                       </b>
                    </button>
                  </h1>
                  <div id="collapseOne-{{$program->id}}" class="accordion-collapse collapse   " aria-labelledby="headingOne-{{$program->id}}" data-bs-parent="#accordionExample">
                    <div class="accordion-body rounded-0">
                         <div class="row">
                            <div class="col-auto">
                                <a href="{{route('student.upload.list' ,  $program->id)}}" class="btn rounded-1 bg-pink-700  shadow fw-bold text-white" target="_blank" >
                                    قائمة الطلبة      
                                </a>
                            </div>
                            <div class="col-auto">
                                <a href="{{route('student.upload.list' ,  $program->id)}}" class="btn rounded-1 bg-green-400  shadow fw-bold text-white" target="_blank" >
                                    رفع قائمة الطلبة للبرنامج
                                </a>
                            </div>

                            <div class="col-auto">
                                <a href="{{route('fees.feeclasstran' ,    $program->id)}}" class="btn rounded-1 bg-cyan-600  shadow fw-bold text-white" target="_blank">
                                    رفع قائمة   الرسوم على الطلبة
                                </a>
                            </div>

                            <div class="col-auto">
                                <a href="{{route('students.upgrade' ,   $program->id )}}" class="btn rounded-1 bg-red-400  shadow fw-bold text-white" target="_blank">
                                    تصعيد قائمة فصل
                                </a>
                            </div>

                            <div class="col-auto">
                                <a href="{{route('exams.index' , ['programs_id' => $program->id])}}" class="btn rounded-1 bg-blue-700  shadow fw-bold text-white" target="_blank">
                                      اختبارات فصل
                                </a>
                            </div>

                             <div class="col-auto">
                                <a href="{{route('student.attendance' ,  ['programs_id' => $program->id])}}" class="btn rounded-1 bg-yellow-700  shadow fw-bold text-white" target="_blank">
                                      تحضير فصل
                                </a>
                            </div>
                         </div>
                    </div>
                  </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
