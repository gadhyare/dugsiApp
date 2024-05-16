<div class="container-fluid shadow-sm rounded bg-white p-3">
    <div class="card-header bg-green-100 text-green-500 py-2 px-4 rounded-2  shadow  my-2 fw-bold border-0 ">
        <span>
            تقرير اختبار فصل
        </span>
        <span>
            {{ $programs->first()->program_name() }}
        </span>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2">
            <div class="card shadow-0 rounded-0 border border-end-0   border-top-0 border-bottom-0">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data" id="frm1">

                        <div class="form-group"><label for="sub_id"> المادة </label> <select name="cls_id"
                                id="sub_id" class="form-select  rounded-0 px-5 "
                                wire:model.live.debounce.300="subjects_distributions_id">
                                <option selected> اختر المادة </option>
                                @foreach ($subjects_distributions as $subjects_distribution)
                                    <option value="{{ $subjects_distribution->id }}">
                                        {{ $subjects_distribution->subjects->name }}</option>
                                @endforeach
                            </select></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-10 px-3">

            <span class="float-start">
                    <a href="{{ route('exams.report.print.for.class', ['programs_id' => $programs_id]) }}"
                        class="btn btn-pink-400 text-pink-100 shadow border-0 rounded-1 py-1 px-3 ">
                        <i class="fa-solid fa-print"></i>
                    </a>
                </span>
            @if (count($exams) > 0)


            <a href="{{route('exams.report.print.for.class.for.subject' , ['programs_id' => $programs_id , 'subjects_distributions_id' => $subjects_distributions_id ])}}" class="btn bg-cyan-700 text-white rounded-1 my-2 shadow">
                طباعة تقرير المادة
            </a>

                <table class="table">
                    <thead>
                        <tr>
                            <th>م</th>
                            <th>اسم الطالب</th>
                            <th>رقم الطالب</th>
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
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-center">{{ $exam->students_info->name() }} </td>
                                <td class="text-center">{{ $exam->students_info->family_number->fnumber }} -
                                    {{ $exam->students_info->id }}</td>
                                <td class="text-center">{{ $exam->qu1 }} </td>
                                <td class="text-center">{{ $exam->ex1 }} </td>
                                <td class="text-center">{{ $exam->qu2 }} </td>
                                <td class="text-center">{{ $exam->ex2 }} </td>
                                <td class="text-center">{{ $exam->att }} </td>
                                <td class="text-center">
                                    {{ $exam->qu1 + $exam->ex1 + $exam->qu2 + $exam->ex2 + $exam->att }} </td>

                                <td class="text-center">
                                    <div class="container">
                                        <button class="btn btn-warning   shadow-sm rounded-1 py-0 px-2 "
                                            wire:click="get_data_to_update({{ $exam->id }})">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                        <button class="btn btn-danger shadow-sm rounded-1 py-0 px-2 "
                                            wire:click="deleteRec({{ $exam->id }})"
                                            wire:confirm="هل أنت متأكد من حذف السجل؟">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>

                            </tr>
                            @if ($updateId == $exam->id)
                                <tr>
                                    <td class="text-center title">
                                        <button class="btn btn-danger text-white shadow-sm rounded-1 py-0 px-2 "
                                            id="cancel-{{ $exam->id }}" wire:click="resetData">
                                            تراجع
                                        </button>
                                    </td>
                                    <td class="text-center title"> </td>
                                    <td class="text-center title"> </td>
                                    <td class="text-center title"> <input type="text" wire:change="getTotal"
                                            class="form-control   border-0 @error('qu1') alert alert-danger @enderror rounded-0 m-auto py-0 px-1 text-center "
                                            wire:model="qu1" style="width:50px"> </td>
                                    <td class="text-center title"> <input type="text" wire:change="getTotal"
                                            class="form-control   border-0 @error('ex1') alert alert-danger @enderror rounded-0 m-auto py-0 px-1 text-center "
                                            wire:model="ex1" style="width:50px"> </td>
                                    <td class="text-center title"> <input type="text" wire:change="getTotal"
                                            class="form-control   border-0 @error('qu2') alert alert-danger @enderror rounded-0 m-auto py-0 px-1 text-center "
                                            wire:model="qu2" style="width:50px"> </td>
                                    <td class="text-center title"> <input type="text" wire:change="getTotal"
                                            class="form-control   border-0 @error('ex2') alert alert-danger @enderror rounded-0 m-auto py-0 px-1 text-center "
                                            wire:model="ex2" style="width:50px"> </td>
                                    <td class="text-center title"> <input type="text" wire:change="getTotal"
                                            class="form-control   border-0 @error('att') alert alert-danger @enderror rounded-0 m-auto py-0 px-1 text-center "
                                            wire:model="att" style="width:50px"> </td>
                                    <td class="text-center title"> <input type="text" disabled
                                            class="form-control   border-0  rounded-0 m-auto py-0 px-1 text-center "
                                            wire:model="total" style="width:50px"> </td>

                                    <td class="text-center title">
                                        <div class="container">
                                            <button class="btn btn-success text-white shadow-sm rounded-1 py-0 px-2 "
                                                id="update-{{ $exam->id }}"
                                                wire:click.prevent="updateRec({{ $exam->id }})">
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
