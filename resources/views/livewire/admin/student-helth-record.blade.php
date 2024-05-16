<div>
    <div class="card border-0 p-3 shadow-lg col-md-9">
        @if (Session::has('status'))
            <div class="alert alert-success text-center ">{{ Session::get('status') }}</div>
        @endif

        <x-modal btnTitle="اضافة" >
            <div class="card-header title px-3 text-white"> اضافة سجل مرضي للطالب     </div>

            <form method="post" class="fw-bold" enctype="multipart/form-data">
                @csrf



                @if($students_info_id)
                    <input type="hidden" name="students_info_id" id="students_info_id" class="form-control bg-white"
                wire:model="students_info_id">
                @else
                    <input type="hidden" name="students_info_id" id="students_info_id" class="form-control bg-white"
                wire:model="getId">
                @endif


                <div class="form-group my-2">
                    <label for="disease"> نوع المرض </label>
                    <input type="text" name="disease" id="disease" class="form-control bg-white"
                        wire:model.defer="disease">
                    @error('disease')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="date_of_injury"> تاريخ الإصابة   </label>
                    <input type="date" name="date_of_injury" id="date_of_injury" class="form-control bg-white"
                        wire:model.defer="date_of_injury">
                    @error('date_of_injury')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>


                <div class="form-group my-2">
                    <label for="hereditary"> صلة القرابة</label>

                    <select name="hereditary"     id="hereditary" name="hereditary" class="form-control bg-white" wire:model.defer="hereditary" >
                        <option   value="1"> نعم    </option>
                        <option   value="2"> لا </option>
                    </select>
                    <input type="hidden"  class="form-control bg-white" >
                    @error('hereditary')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>


                <div class="form-group my-2">
                    <label for="case_now"> الحالة الآن </label>
                    <input type="text" name="case_now" id="case_now" class="form-control bg-white"
                        wire:model.defer="case_now">
                    @error('case_now')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="h_comments">   الملاحظات </label>

                        <textarea  name="h_comments" id="h_comments" class="form-control bg-white"
                        wire:model.defer="h_comments"  cols="30" rows="6" ></textarea>
                    @error('h_comments')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="register_date"> تاريخ التسجيل  </label>
                    <input type="date" name="register_date" id="register_date" class="form-control bg-white"
                        wire:model.defer="register_date">
                    @error('register_date')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>

            </form>


        </x-modal>


        @php
            $serial = ($students->currentpage() - 1) * $students->perpage() + 1;
        @endphp
        {{-- Show all expenses type list --}}
        <x-table :headers="['#',   'نوع المرض' ,  'تاريخ الإصابة' , 'وراثي' , 'الحالة الآن' , 'تاريخ التسجيل'  , 'التعديل' , 'الحذف' ]">

            @foreach ($students as $student)
                <tr>
                    <td>{{ $serial++ }}</td>
                    <td>{{ $student->disease }}</td>
                    <td>{{ $student->date_of_injury }}</td>
                    <td>{{ $student->hereditary == 1 ? 'وراثي' : 'غير وراثي' }}</td>
                    <td>{{ $student->case_now }}</td>
                    <td>{{ $student->register_date }}</td>

                    <td>
                        <small><i class="fa-solid fa-pen  bg-success  text-white  shadow p-1"
                                wire:click="updateRec({{ $student->id }})" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"></i></small>
                    </td>
                    <td>


                        <x-delete-confirm btnTitle="حذف" recId="{{ $student->id }}">
                            [{{ $student->id}}]
                        </x-delete-confirm>

                    </td>
                </tr>
            @endforeach
        </x-table>



        {{ $students->links() }}
    </div>
</div>
