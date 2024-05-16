<div>
    <div class="card border-0 p-3 shadow-lg col-md-11">
        @if (Session::has('status'))
            <div class="alert alert-success text-center ">{{ Session::get('status') }}</div>
        @endif

        <x-modal btnTitle="اضافة">
            <div class="card-header title px-3 text-white"> اضافة قريب للطالب </div>


            <form method="post" class="fw-bold">
                @csrf


                <div class="form-group my-2">
                    <label for="emsections_id"> القسم الوظيفي </label>
                    <select name="emsections_id" id="emsections_id" class="form-control bg-white"
                        wire:model.defer="emsections_id">
                        <option selected> اختر القسم الوظيفي </option>

                        @foreach ($emsections as $emsection)
                            <option value="{{ $emsection->id }}"> {{ $emsection->name }}</option>
                        @endforeach

                    </select>
                    @error('emsections_id')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>


                <div class="form-group my-2">
                    <label for="levels_id"> الدرجة الوظيفية </label>
                    <select name="levels_id" id="levels_id" class="form-control bg-white" wire:model.defer="levels_id">
                        <option selected> اختر الدرجة الوظيفية </option>

                        @foreach ($emplooyes_levels as $emplooyes_level)
                            <option value="{{ $emplooyes_level->id }}"> {{ $emplooyes_level->name }}</option>
                        @endforeach

                    </select>
                    @error('levels_id')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>



                <div class="form-group my-2">
                    <label for="salary"> المرتب </label>
                    <input type="number" name="salary" id="salary" class="form-control bg-white" wire:model.defer="salary" />
                    @error('salary')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="start_date"> تاريخ البدء في الوظيفة </label>
                    <input type="date" name="start_date" id="start_date" class="form-control bg-white" wire:model.defer="start_date" />
                    @error('start_date')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="end_date"> تاريخ الإنتهاء من الوظيفة </label>
                    <input type="date" name="end_date" id="end_date" class="form-control bg-white" wire:model.defer="end_date" />
                    @error('end_date')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>


                <div class="form-group my-2">
                    <label for="note"> الملاحظة </label>
                    <textarea  cols="30" rows="10"  name="note" id="note" class="form-control bg-white" wire:model.defer="note"></textarea>

                    @error('note')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>



            </form>


        </x-modal>

        @php
            $serial = ($employye_jobs->currentpage() - 1) * $employye_jobs->perpage() + 1;
        @endphp
        {{-- Show all expenses type list --}}
        <x-table :headers="[
            '#',
            'القسم الوظيفي',
            'الدرجة الوظيفية',
            'المرتب',
            'تاريخ البدء',
            'تاريخ الانتهاء',
            'التعديل',
            'الحذف',
        ]">

            @foreach ($employye_jobs as $employye_job)
                <tr>
                    <td>{{ $serial++ }}</td>
                    <td>{{ $employye_job->Emsections->name }}</td>
                    <td>{{ $employye_job->EmplooyesLevels->name }}</td>
                    <td>{{ $employye_job->salary }}</td>
                    <td>{{ $employye_job->start_date }}</td>
                    <td>{{ $employye_job->end_date }}</td>
                    <td>
                        <small><i class="fa-solid fa-pen  bg-success  text-white  shadow p-1"
                                wire:click="updateRec({{ $employye_job->id }})" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"></i></small>
                    </td>
                    <td>


                        <x-delete-confirm btnTitle="حذف" recId="{{ $employye_job->id }}">
                            [{{ $employye_job->title }}]
                        </x-delete-confirm>
                    </td>
                </tr>
            @endforeach
        </x-table>



        {{ $employye_jobs->links() }}


    </div>
</div>
