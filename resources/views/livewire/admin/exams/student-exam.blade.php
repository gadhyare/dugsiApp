<div class="container my-3 py-3 ">
    @if ($message_error != '')
        <div class="alert alert-danger text-center botder-0 fw-bold">
            {{ $message_error }}
        </div>
    @endif

    @if ($message_success != '')
        <div class="alert alert-success text-center botder-0 fw-bold">
            {{ $message_success }}
        </div>
    @endif
    <form method="POST">
        @csrf
        <div class="card shadow-lg rounded-2 border-0 py-2 px-2">
            <span class="px-1  bg-green-100 fw-bold rounded-1">
                اسم الطالب:
                @if ($students_info_id)
                    {{ \App\Models\Students_info::where('id', '=', $students_info_id)->first()->name() }}
                @endif
            </span>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 ">
                    <div class="card rounded-0 border p-2">
                        <div class="card-header rounded-0 text-white title">

                            <i class="fa-solid fa-paper-plane"></i>
                            <span>
                                بيانات الاختبار
                            </span>
                        </div>
                        <div class="card-body  ">
                            <div class="form-group"><label for="students_info_id"> رقم الطالب </label>
                                <span class="float-start">
                                    @error('students_info_id')
                                        <div class="bg-danger text-white px-2">
                                            مطلوب
                                        </div>
                                    @enderror
                                </span>

                                <input list="students_info_ids" wire:model.live.debounce.300="students_info_id"
                                    class="form-control rounded-1">
                                <datalist id="students_info_ids">
                                    @foreach ($students as $student)
                                        <option value="{{ $student->studentInfo->id }}">
                                            {{ $student->studentInfo->name() }} </option>
                                    @endforeach


                                </datalist>
                            </div>

                            <div class="form-group"><label for="subjects_distributions_id"> المادة </label>
                                <span class="float-start">
                                    @error('subjects_distributions_id')
                                        <div class="bg-danger text-white px-2">
                                            مطلوب
                                        </div>
                                    @enderror
                                </span>

                                <select name="subjects_distributions_id" id="subjects_distributions_id"
                                    class="form-control rounded-1 " wire:model.live.debounce.300="subjects_distributions_id">
                                    <option selected> اختر المادة </option>
                                    @foreach ($subjects_distributions as $subjects_distribution)
                                        <option value="{{ $subjects_distribution->id }}">
                                            {{ $subjects_distribution->subjects->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="clearfix my-2"></div>


                            <button type="submit" wire:click.prevent="add_new_exam_for_student"
                                class="btn title  text-white col-12 m-auto rounded-2">
                                اضافة الاختبار
                            </button>


                            <br>
                            @if ($active)
                                <button type="submit" wire:click.prevent="getDate"
                                    class="btn btn-primary  text-white col-12 m-auto rounded-0">
                                    جلب نتائج الطالب
                                </button>
                            @endif
                        </div>


                    </div>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-9">
                    <div class="card p-2 shadow-none border-0">
                        <table class="table table-bordered text-center   border  m-auto w-100">
                            <tbody>

                                <tr  >
                                    <td class="text-white text-center border  fw-bold  bg-purple-500 p-2"> أعمال السنة 1</td>
                                    <td class="text-white text-center border  fw-bold  bg-purple-500 p-2"> الاختبار النصفي</td>
                                    <td class="text-white text-center border  fw-bold  bg-purple-500 p-2"> أعمال السنة 2</td>
                                    <td class="text-white text-center border  fw-bold  bg-purple-500 p-2"> الاختبار النهائي </td>
                                    <td class="text-white text-center border  fw-bold  bg-purple-500 p-2"> الحضور</td>
                                    <td class="text-white text-center border  fw-bold  bg-purple-500 p-2"> المجموع </td>
                                </tr>
                            </tbody>
                            <tbody>

                                <tr class="title">

                                    <td class="py-1">
                                        <input type="text" wire:model.live.debounce.300="qu1"
                                            class="form-control py-0 rounded-0 text-center @error('qu1') bg-danger @enderror ">
                                    </td>
                                    <td class="py-1">
                                        <input type="text" wire:model.live.debounce.300="ex1"
                                            class="form-control py-0 rounded-0 text-center  @error('ex1') bg-danger @enderror "">
                                    </td>
                                    <td class="py-1">
                                        <input type="text" wire:model.live.debounce.300="qu2"
                                            class="form-control py-0 rounded-0 text-center  @error('qu2') bg-danger @enderror "">
                                    </td>
                                    <td class="py-1">
                                        <input type="text" wire:model.live.debounce.300="ex2"
                                            class="form-control py-0 rounded-0 text-center  @error('ex2') bg-danger @enderror "">
                                    </td>
                                    <td class="py-1">
                                        <input type="text" wire:model.live.debounce.300="att"
                                            class="form-control py-0 rounded-0 text-center  @error('att') bg-danger @enderror "">
                                    </td>
                                    <td class="py-1">
                                        <input type="text" wire:model.live.debounce.300="total"
                                            class="form-control py-0 rounded-0 text-center  bg-white" disabled>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
