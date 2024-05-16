<div id="app" class="container my-5">
    <div class="card   border-0 shadow ">
        <div class="card-header bg-white py-3 border-0">
            <i class="fa-solid fa-list" ></i>
            <span class="fw-bold">
                اضافة اختبار فصل
            </span>
            <span class="px-3 fw-bold bg-green-100 rounded-1 mx-2">
                {{ $programs->levels->name . " | " .$programs->classes->name  . " | " .$programs->shifts->name  . " | " .$programs->groups->name  . " | " .$programs->sections->name  }}
            </span>
        </div>
        <div class="container m-auto py-3 text-dark bg-white   p-2 border-bottom">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <div class="card shadow-0 rounded-0 border border-end-0   border-top-0 border-bottom-0">
                        <div class="card-body">
                                <div class="form-group"><label for="dep_id"> المادة </label>
                                    <select name="dep_id"
                                        id="dep_id" class="form-control rounded-0 "
                                        wire:model.live.debounce.300="subjects_distributions_id">
                                        <option selected> اختر المادة </option>
                                        @foreach ($subjects_distributions as $subjects_distribution)
                                            <option value="{{ $subjects_distribution->id }}">
                                                {{ $subjects_distribution->subjects->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9">
                @if($message !='')
                    <div class="alert alert-success text-center">{{$message}}</div>
                @endif
                    @if (count($students) > 0 && $subjects_distributions_id)
                    <span class="float-start">
                            <a href="{{route('students.list.export' , $programs_id)}}" class="btn btn-danger shadow-lg" >
                                تصدير ملف الطلبة
                            </a>
                    </span>
                    <br><br>
                    <form enctype="multipart/form-data">
                        <label for="file" class="w-100 bg-info rounded-0 border-0 p-5 text-light fw-bold text-center h1"     >
                                <i class="fa-solid fa-upload fw-b"></i>
                        </label>
                        <input type="file" id="file" wire:model.live.debounce.300="excelFile" class="d-none">
                        <button class="btn btn-danger py-3 col-12 m-auto  shadow fw-bold" wire:click.prevent="getRec">
                                <i class="fa-solid fa-arrow-up fw-bold"></i>
                                <span >  رفع  الملف   </span>
                        </button>
                    </form>
                    @else
                        <div class="alert alert-danger text-center">
                            لا توجد بيانات لعرضها
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
