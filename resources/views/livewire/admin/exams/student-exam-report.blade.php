<div class="container-fluid shadow-sm rounded bg-white p-3">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="card shadow-0 rounded-0 border border-end-0   border-top-0 border-bottom-0">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data" id="frm1">

                        <div class="form-group py-3">
                            <label  > رقم الطالب  </label>
                            <input type="text"   wire:model="students_info_id" class="form-control rounded-0">
                        </div>


                         
                        <div class="form-group"><label for="classes_id"> الصف الدراسي </label>
                            <select name="classes_id" id="classes_id" class="form-select  rounded-0 px-5 "
                                wire:model="classes_id">
                                <option selected> اختر الصف الدراسي </option>
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}">{{ $program->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        @if( $students )

                            {{$students->studentInfo->name}} {{$students->studentInfo->father->name}} || <span style="direction: ltr !important">{{$students->studentInfo->father->number}}-{{$students->studentInfo->id}}</span>

                            <a href="{{route('exams.student.pdf' , ['students_info_id' => $students_info_id  , 'classes_id' => $classes_id  ]  )}}"  target="_blank" class="btn btn-primary">
                                    <i class="fa-solid fa-file-pdf"></i>
                            </a>

                        @endif

                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9">

            <div class="clearfix"></div>
            @if (count($exams) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                               <th>م</th>
                               <th> المادة  </th>
                               <th>الواجبات</th>
                               <th>الاختبار النصفي</th>
                               <th>الواجبات 2</th>
                               <th>الاختبار النهائي</th>
                               <th>الحضور</th>
                               <th>المجموع</th>
                               <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach ($exams as $exam)
                            <tr>
                                <td class="text-center">{{$i++}}</td>
                                <td class="text-center">{{$exam->subjects_distributions->subjects->name?? 'ss'}}</td>
                                <td class="text-center">{{$exam->qu1}} </td>
                                <td class="text-center">{{$exam->ex1}} </td>
                                <td class="text-center">{{$exam->qu2}} </td>
                                <td class="text-center">{{$exam->ex2}} </td>
                                <td class="text-center">{{$exam->att}} </td>
                                <td class="text-center">{{$exam->qu1 + $exam->ex1 + $exam->qu2 + $exam->ex2 +$exam->att }} </td>
                                <td class="text-center">
                                    <div class="container">
                                        <button class="btn btn-warning   shadow-sm rounded-1 py-0 px-2 " wire:click="get_data_to_update({{ $exam->id }})">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                        <button class="btn btn-danger shadow-sm rounded-1 py-0 px-2 ">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>

                             </tr>
                             @if( $updateId == $exam->id)
                             <tr>
                                <td class="text-center title">
                                    <button class="btn btn-danger text-white shadow-sm rounded-1 py-0 px-2 "  id="cancel-{{$exam->id}}" wire:click="resetData">
                                        تراجع
                                   </button>
                                </td>
                                <td class="text-center title"> </td>
                                <td class="text-center title"> </td>
                                <td class="text-center title"> <input type="text" wire:change="getTotal"  class="form-control   border-0 @error('qu1') alert alert-danger @enderror rounded-0 m-auto py-0 px-1 text-center " wire:model="qu1" style="width:50px" >  </td>
                                <td class="text-center title"> <input type="text" wire:change="getTotal"  class="form-control   border-0 @error('ex1') alert alert-danger @enderror rounded-0 m-auto py-0 px-1 text-center " wire:model="ex1" style="width:50px" >  </td>
                                <td class="text-center title"> <input type="text" wire:change="getTotal"  class="form-control   border-0 @error('qu2') alert alert-danger @enderror rounded-0 m-auto py-0 px-1 text-center " wire:model="qu2" style="width:50px" >  </td>
                                <td class="text-center title"> <input type="text" wire:change="getTotal"  class="form-control   border-0 @error('ex2') alert alert-danger @enderror rounded-0 m-auto py-0 px-1 text-center " wire:model="ex2" style="width:50px" >  </td>
                                <td class="text-center title"> <input type="text" wire:change="getTotal"  class="form-control   border-0 @error('att') alert alert-danger @enderror rounded-0 m-auto py-0 px-1 text-center " wire:model="att" style="width:50px" >  </td>
                                <td class="text-center title"> <input type="text" disabled  class="form-control   border-0  rounded-0 m-auto py-0 px-1 text-center " wire:model="total" style="width:50px" >  </td>

                                <td class="text-center title" >
                                    <div class="container">
                                        <button class="btn btn-success text-white shadow-sm rounded-1 py-0 px-2 "  id="update-{{$exam->id}}" wire:click.prevent="updateRec({{$exam->id}})">
                                             تحديث
                                        </button>
                                    </div>
                                </td>
                             </tr>
                             @endif
                             @endforeach
                        </tbody>
                    </table>
            @endif


        </div>
    </div>
</div>



