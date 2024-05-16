<div class="bg-white p-2">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2">
            <div class="card rounded-0">
                <div class="card-header  bg-white ">
                    <i class="fa-solid fa-list"></i>
                    معلومات الفصل
                </div>
                <div class="card-body">
                    <p>
                        <span> المرحلة: </span>
                        <span> {{ $programs->levels->name }} </span>
                    </p>
                    <p>
                        <span> الفصل: </span>
                        <span> {{ $programs->classes->name }} </span>
                    </p>
                    <p>
                        <span> الفترة: </span>
                        <span> {{ $programs->shifts->name }} </span>
                    </p>
                    <p>
                        <span> الشعبة: </span>
                        <span> {{ $programs->groups->name }} </span>
                    </p>
                    <p>
                        <span> القسم: </span>
                        <span> {{ $programs->sections->name }} </span>
                    </p>
                </div>
            </div>
        </div>

        @php
            $serial =   1;
        @endphp
        <div class="col-xs-12 col-sm-12 col-md-10">
            <button class="btn btn-purple-400 fw-bold text-white shadow px-3 rounded-1 float-start mb-2 " wire:click.prevent="exportData()">
                <i class="fa-solid fa-file-excel"></i>
                <span>
                    تصدير ملف إكسل
                </span>
            </button>
            <div class="my-2"></div>
            <table class="table table-bordered">
                <thead>
                    <th>no</th>
                    <th>اسم الطالب</th>
                    <th>رقم الطالب</th>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $serial++ }}</td>
                            <td>{{ $student->studentInfo->name() }} </td>
                            <td>{{ $student->studentInfo->family_number->fnumber }}-{{ $student->studentInfo->id }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
