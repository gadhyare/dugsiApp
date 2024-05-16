<div class="container py-2">
    @if (count($students) > 0)
        <div class="row gap-3 fw-bold">
            @foreach ($students as $student)
                <div class="col-xs-12 col-sm-12 col-md-3 my-1">
                    <div class="card mb-3 border-0 rounded-none w-100 shadow"  >
                        <div class="row g-0">
                            <div class="col-md-4">
                                @php $src = ($student->photo != '') ? $student->photo : 'muunad.jpg' @endphp
                                <img src="{{ Storage::url('/uploads/images/students/' . $src) }}"
                                    class="img-fluid rounded-none rounded"   alt="{{ $student->name() }}" style="height: 130px">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-blue-500" >{{ $student->name() }}</h5>
                                    <p class="card-text">
                                        <a href="" class=" text-red-500  text-decoration-none fw-bold col-12"> الاختبارات
                                        </a> <br>
                                        <a href="" class=" text-red-500  text-decoration-none fw-bold col-12"> المالية
                                        </a> <br>
                                        <a href="" class=" text-red-500  text-decoration-none fw-bold col-12"> الحضور </a>
                                        <br> 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
