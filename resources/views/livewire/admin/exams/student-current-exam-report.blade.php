<div class="container bg-white p-3 my-3">
    <div class="row g-3">
        <div class="col">
            <input list="familyNumbers" class="form-select rounded-0" wire:model.live.debounce.300="familyNumberId">
            <datalist name="familyNumbers" id="familyNumbers">
                @foreach ($familyNumbers as $item)
                    <option value="{{ $item->id }}"> {{ $item->fnumber }} </option>
                @endforeach
            </datalist>
        </div>

        <div class="col">
            <button class="btn bg-green-500 text-green-100 rounded-0"> اختيار </button>
        </div>

        <div class="col">
            
        </div>
    </div>

    <hr>

         <div class="row gap-3 fw-bold">
            @foreach ($students as $student)
                <div class="col-xs-12 col-sm-12 col-md-3 my-1">
                    <div class="card mb-3 border-0 rounded-none w-100 shadow p-2"  >
                        <div class="row g-0">
                            <div class="col-md-4">
                                @php $src = ($student->photo != '') ? $student->photo : 'muunad.jpg' @endphp
                                <img src="{{ Storage::url('/uploads/' . $src) }}"
                                    class="img-fluid rounded-none rounded"   alt="{{ $student->name() }}" style="height: 130px">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-blue-500" >{{ $student->name() }}</h5>
                                    <p class="card-text">
                                         <a href="{{route("exams.report.for.student.print" , ['programs_id' => $programs_id , 'students_info_id' =>  $student->id])}}" target="_blank" class="btn bg-indigo-500 text-indigo-100 fw-bold m-auto"> أظهر تقرير الاختبارات</a>
   
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

                          

</div>
