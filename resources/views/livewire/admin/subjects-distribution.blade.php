<div>
    <div class="card border-0 p-3 shadow-lg ">
        @if (Session::has('status'))
            <div class="alert alert-success text-center ">{{ Session::get('status') }}</div>
        @endif


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="card">
                    <div class="card-header title px-3 text-white"> اضافة قريب للطالب </div>
                    <div class="card-body">

                        <form method="post" class="fw-bold" >
                            @csrf

                            <div class="form-group my-2">
                                <label for="subjects_id"> المادة </label>

                                <select  
                                    class="form-control bg-white" wire:model.lazy="subjects_id">

                                    <option selected> اختر المادة</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}"> {{ $subject->name }} </option>
                                    @endforeach
                                </select> 
                                @error('subjects_id')
                                    <small><i class="text-danger">{{ $message }}</i></small>
                                @enderror
                            </div>
                            <div class="form-group my-2">
                                <label for="programs_id"> البرنامج  </label>

                                <select   class="form-control bg-white"
                                    wire:model.lazy="programs_id">

                                    <option selected> اختر البرنامج </option>
                                    @foreach ($programs as $program)
                                        <option value="{{ $program->id }}"> {{ $program->program_name()  }} </option>
                                    @endforeach
                                </select> 
                                @error('programs_id')
                                    <small><i class="text-danger">{{ $message }}</i></small>
                                @enderror
                            </div>
 
                            <div class="form-group">
                                <label for="max_mark">الدرجة العليا</label>
                                <input type="number" name="max_mark" id="max_mark" class="form-control bg-white" wire:model="max_mark">
                            </div>

                            <div class="form-group">
                                <label for="min_mark">الدرجة الدنيا</label>
                                <input type="number" name="min_mark" id="min_mark" class="form-control bg-white" wire:model="min_mark">
                            </div>
                            <div class="form-group mb-1">
                                <label for="rank">  الترتيب على الكشف  </label>
                                <input type="number" name="rank" id="rank" class="form-control bg-white" wire:model="rank">
                            </div>
                            <button type="submit"
                            class="btn @if ($updateId) bg-success-dark @else bg-primary-dark @endif text-white   shadow-lg float-end"  wire:click.prevent="checkOpration">
                            <i class="fa fa-plus"></i>
                            {{ $btnTitle }} مستوى
                        </button>
                        @if ($updateId)
                            <button type="submit" class="btn bg-danger-dark text-white   shadow-lg float-start"
                                wire:click.prevent="cancel">
                                <span>
                                    تراجع
                                </span>
                            </button>
                        @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8"> 
               
                
                {{-- Show all expenses type list --}}
                <x-table :headers="[
                    '#',
                    'المادة',
                    'الدرجة العليا',
                    'الدرجة الدنيا',
                    'التعديل',
                    'الترتيب على الكشف',
                    'الحذف',
                ]">

                    @foreach ($SubjectsDistributions as $SubjectsDistribution)
                        <tr>
                            <td>#</td>
                            <td>{{ $SubjectsDistribution->subjects->name }}</td>
                            <td>{{ $SubjectsDistribution->max_mark }}</td>
                            <td>{{ $SubjectsDistribution->min_mark }}</td>
                            <td>{{ $SubjectsDistribution->rank }}</td>
                            <td>
                                <button class="btn bg-success-dark text-white  px-2 py-0 shadow-lg rounded-0" wire:click="updateRec({{ $SubjectsDistribution->id }})"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-solid fa-pencil  "> </i>
                                </button>
                            </td>
                            <td>
                                <button class="btn bg-danger-dark text-white  px-2 py-0 shadow-lg rounded-0"
                                wire:click="deleteConfirmation({{ $SubjectsDistribution->id }})">
                                <small>
                                    <i class="fa-solid fa-trash  "></i>
                                </small>
                            </button>
                        </tr>
                    @endforeach
                </x-table>
                 
             
                 
                
            </div>
        </div>
    </div>
</div>
