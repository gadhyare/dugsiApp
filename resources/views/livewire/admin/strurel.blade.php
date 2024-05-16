<div>
    <div class="card border-0 p-3 shadow-lg col-md-7">
        @if (Session::has('status'))
            <div class="alert alert-success text-center ">{{ Session::get('status') }}</div>
        @endif


        <x-modal btnTitle="اضافة">
            <div class="card-header title px-3 text-white"> اضافة قريب للطالب   </div>


            <form method="post" class="fw-bold">
                @csrf
                <div class="form-group my-2">
                    <label for="name"> الاسم </label>
                    <input type="text" name="name" id="name" class="form-control bg-white"
                        wire:model.defer="name">


                    @error('name')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="rel_type"> صلة القرابة</label>

                    <select name="rel_type"     id="rel_type" name="rel_type" class="form-control bg-white" wire:model.defer="rel_type" >

                        <option   selected> اختر صلة القرابة</option>
                        <option   value="1"> الأب</option>
                        <option   value="2"> الأم</option>
                        <option   value="3"> الأخوة</option>
                        <option   value="4"> عم - عمة</option>
                        <option   value="5"> خالة - خالة</option>
                        <option   value="6"> جد - جدة</option>
                        <option   value="7"> زوج أم - زوجة أب</option>
                        <option   value="8"> غير ذلك</option>

                    </select>
                    <input type="hidden"  class="form-control bg-white" >
                    @error('rel_type')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="rel_lev"> درجة القرابة</label>

                    <select name="rel_lev"     id="rel_lev" name="rel_lev" class="form-control bg-white" wire:model.defer="rel_lev" >

                        <option   selected> اختر درجة القرابة</option>
                        <option   value="1"> الأولى</option>
                        <option   value="2"> الثانية</option>
                        <option   value="3"> الثالثة</option>
                        <option   value="4"> غير ذلك</option>

                    </select>
                    <input type="hidden"  class="form-control bg-white" >
                    @error('rel_lev')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="address"> العنوان </label>
                    <input type="text" name="address" id="address" class="form-control bg-white"
                        wire:model.defer="address">


                    @error('address')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="email"> البريد الإلكتروني </label>
                    <input type="email" name="email" id="email" class="form-control bg-white"
                        wire:model.defer="email">


                    @error('email')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="phones"> الهواتف </label>
                    <input type="text" name="phones" id="phones" class="form-control bg-white"
                        wire:model.defer="phones">


                    @error('phones')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="is_subscribe"> ولي الأمر </label>
                    <select name="is_subscribe" id="is_subscribe" class="form-control bg-white" wire:model.defer="is_subscribe">
                        <option value="1">نعم</option>
                        <option value="2">لا   </option>
                    </select>
                    @error('is_subscribe')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="active">الحالة</label>
                    <select name="active" id="active" class="form-control bg-white" wire:model.defer="active">
                        <option value="1">مفعل</option>
                        <option value="2">غير مفعل</option>
                    </select>
                    @error('active')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>
            </form>


        </x-modal>

          {{-- أقرباء للطالب [{{$getStudent->name}} {{$getStudent->father->name}} - {{$getStudent->father->number}}] --}}

        @php
            $serial = ($strurels->currentpage() - 1) * $strurels->perpage() + 1;
        @endphp
        {{-- Show all expenses type list --}}
        <x-table :headers="['#',   'الاسم' , 'صلة القرابة' , 'درجة القرابة' , 'العنوان' , 'البريد الإلكتروني' ,'الهواتف' , 'ولي الأمر' , 'الحالة', 'التعديل' , 'الحذف' ]">

            @foreach ($strurels as $strurel)
                <tr>
                    <td>{{ $serial++ }}</td>
                    <td>{{ $strurel->name }}</td>
                    <td>{{ $strurel->rel_type }}</td>
                    <td>{{ $strurel->rel_lev }}</td>
                    <td>{{ $strurel->address }}</td>
                    <td>{{ $strurel->email }}</td>
                    <td>{{ $strurel->phones }}</td>
                    <td>{{ $strurel->is_subscribe }}</td>
                    <td>{{ $strurel->active == 1 ? 'مفعل' : 'غير مفعل' }}</td>
                    <td>
                        <small><i class="fa-solid fa-pen  bg-success  text-white  shadow p-1"
                                wire:click="updateRec({{ $strurel->id }})" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"></i></small>
                    </td>
                    <td>


                        <x-delete-confirm btnTitle="حذف" recId="{{ $strurel->id }}">
                            [{{ $strurel->name}}]
                        </x-delete-confirm>

                    </td>
                </tr>
            @endforeach
        </x-table>



        {{ $strurels->links() }}
    </div>
</div>
