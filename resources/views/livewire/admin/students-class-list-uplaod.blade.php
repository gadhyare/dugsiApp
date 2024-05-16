<div class="container-fluid bg-white p-2">
    @if (   $programs_id)
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <form enctype="multipart/form-data" class="card p-2 shadow-0" >
                @csrf
                @if (Session::has('success'))
                    <p class="alert alert-danger">{{ Session::get('success') }}</p>
                @endif
                <div class="card-body ">
                    <div class="card-header border-0 bg-white px-0 py-2">
                        <i class="fa-solid fa-list">
                        </i>
                        <span>
                            رفع قائمة فصل   <span wire:loading wire:target="updatedfileUpload()"  > dfvdb  </span>
                        </span>
                    </div>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>
                                المرحلة الدراسية
                            </td>
                            <td>
                                {{ $programs->levels->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                الصف
                            </td>
                            <td>
                                {{ $programs->classes->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                الشعبة
                            </td>
                            <td>
                                {{ $programs->groups->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                الفترة
                            </td>
                            <td>
                                {{ $programs->shifts->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                القسم
                            </td>
                            <td>
                                {{ $programs->sections->name }}
                            </td>
                        </tr>
                    </table>
                    <label class="p-5 rounded-0 m-0  text-center alert alert-info w-100" for="fileUpload">
                        <span>
                            اضغط هنا لفرع الملف
                        </span>
                        <input type="file" name="fileUpload" id="fileUpload" accept=".xlsx" style="display: none" wire:model="fileUpload">
                    </label>
                    @error('fileUpload')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>
                <div class="card-footer border-0 bg-white">
                    <button class="btn btn-primary col-12 m-auto py-2 rounded-0" wire:click.prevent="uploadList"  @if (!$info) disabled @endif>
                        <i class="fa-solid fa-upload"></i>
                        <span>رفع الملف</span>
                    </button>
                </div>

                <div class="card-footer bg-white p-2">
                    @if ( $fileInfo != null  )
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>
                                اسم الملف
                            </td>
                            <td>
                                {{$fileInfo['name']}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                نوع الملف
                            </td>
                            <td>
                                {{$fileInfo['tyep']}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                حجم الملف
                            </td>
                            <td>
                                {{ floor($fileInfo['size'] / 1024)   }}  kbytes
                            </td>
                        </tr>
                    </table>
                    @endif
                </div>
            </form>

            <a href="{{route('download.student.simple.file')}}">تحميل</a>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8">
            @if (count($items) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>الأب</th>
                        <th>الجد</th>
                        <th>الرقم العائلي</th>
                        <th>الجنس</th>
                        <th>فصيلة الدم</th>
                        <th>الهاتف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td>#</td>
                        <td> {{$item->first_name}} </td>
                        <td> {{$item->middle_name}} </td>
                        <td> {{$item->last_name}} </td>
                        <td> {{$item->family_number_id}} </td>
                        <td> {{$item->sex}} </td>
                        <td> {{$item->blood_group}} </td>
                        <td> {{$item->phone}} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        </div>
    </div>

     @else

    <div class="alert alert-danger text-center">
         لم تختر الفصل
         <p>

            <b>
                <a href="{{route('programs.index')}}" class="text-red-500 text-decoration-none">اضغط هنا لاختيار الفصل</a>
            </b>
         </p>
    </div>
    @endif
</div>
