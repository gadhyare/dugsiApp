<div class="card">

    <div class="card-body">
        <form class="fw-bold">
            <div class="card-hader title p-2"> تعديل معلومات طالب [
                {{ $student->name() . ' ' . $student->family_number->fnumber }} ]
 
                <span class="float-start"><button wire:click.prevent="update_student_info" class="btn bg-white text-green-500 fw-bold  py-1  " > تحديث المعلومات </button></span>
             <br>
             <br>
            </div>

            @csrf
            <div class="card rounded-0 p-1">
                <div class="card-body">

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group input-group-sm p-1 m-0"><label> الاسم الأول </label>
                                        <input type="text" name="first_name"
                                            class="form-control input-sm px-3 py-2 bg-white rounded-0"
                                            wire:model.live.debounce.300="first_name">

                                        @error('first_name')
                                            <small><i class="text-danger">{{ $message }}</i></small>
                                        @enderror
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group input-group-sm p-1 m-0"><label> الاسم الثاني </label>
                                        <input type="text" name="middle_name"
                                            class="form-control input-sm px-3 py-2 bg-white rounded-0"
                                            wire:model.live.debounce.300="middle_name">

                                        @error('middle_name')
                                            <small><i class="text-danger">{{ $message }}</i></small>
                                        @enderror
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group input-group-sm p-1 m-0"><label> الاسم الثالث </label>
                                        <input type="text" name="last_name"
                                            class="form-control input-sm px-3 py-2 bg-white rounded-0"
                                            wire:model.live.debounce.300="last_name">
                                        @error('last_name')
                                            <small><i class="text-danger">{{ $message }}</i></small>
                                        @enderror
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group input-group-sm p-1 m-0"><label for="fathers_id"> الرقم
                                            العائلي
                                        </label>
                                        <br>
                                        <input type="hidden" name="fathers_id" disabled
                                            class="form-control input-sm px-3 py-2 bg-white rounded-0"
                                            wire:model="fathers_id">
                                        {{ $students }}
                                </td>

                                <td>
                                    <div class="form-group input-group-sm p-1 m-0"><label>اسم الأم</label> <input
                                            type="text" name="mother" id="mother" wire:model="mother"
                                            class="form-control input-sm px-3 py-2 bg-white rounded-0">
                                        @error('mother')
                                            <small><i class="text-danger">{{ $message }}</i></small>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group input-group-sm p-1 m-0"><label> الجنس </label>
                                        <select wire:model="gender" name="gender" id=""
                                            class="form-control input-sm px-3 py-2 bg-white rounded-0">
                                            <option value="ذكر" selected="selected"> ذكر </option>
                                            <option value="أنثى"> أنثى </option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group input-group-sm p-1 m-0"><label> تاريخ الميلاد </label> <input
                                            type="date" name="date_of_birth" wire:model="date_of_birth"
                                            class="form-control input-sm px-3 py-2 bg-white rounded-0">
                                        @error('date_of_birth')
                                            <small><i class="text-danger">{{ $message }}</i></small>
                                        @enderror
                                    </div>
                                </td>

                                <td>
                                    <div class="form-group input-group-sm p-1 m-0"><label>مكان الميلاد </label>
                                        <input type="text" name="place_of_birth"id="place_of_birth"
                                            wire:model.live.debounce.300="place_of_birth"
                                            class="form-control input-sm px-3 py-2 bg-white rounded-0">
                                        @error('place_of_birth')
                                            <small><i class="text-danger">{{ $message }}</i></small>
                                        @enderror
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group input-group-sm p-1 m-0"><label> الجنسية </label>
                                        <input wire:model.laz="nationality" type="text" name="nationality"
                                            id="nationality" class="form-control input-sm px-3 py-2 bg-white rounded-0">
                                        @error('nationality')
                                            <small><i class="text-danger">{{ $message }}</i></small>
                                        @enderror
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group input-group-sm p-1 m-0"><label> العنوان </label>
                                        <input wire:model.laz="address" type="text" name="address" id="address"
                                            class="form-control input-sm px-3 py-2 bg-white rounded-0">
                                        @error('address')
                                            <small><i class="text-danger">{{ $message }}</i></small>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group input-group-sm p-1 m-0"><label> فصيلة الدم </label>
                                        <select wire:model.laz="blood_group" type="text" name="blood_group"
                                            id="blood_group" class="form-control input-sm px-3 py-2 bg-white rounded-0">
                                            <option> اختر فصيلة دم طالب </option>
                                            <option value="A+"> RhD positive (A+) </option>
                                            <option value="A-"> RhD negative (A-) </option>
                                            <option value="B+">B RhD positive (B+) </option>
                                            <option value="B-">B RhD negative (B-) </option>
                                            <option value="O+">O RhD positive (O+) </option>
                                            <option value="O-">O RhD negative (O-) </option>
                                            <option value="AB+">B RhD positive (AB+) </option>
                                            <option value="AB-">B RhD negative (AB-) </option>
                                        </select>
                                        @error('blood_group')
                                            <small><i class="text-danger">{{ $message }}</i></small>
                                        @enderror
                                    </div>
                                </td>

                                <td>
                                    <div class="form-group input-group-sm p-1 m-0"><label> المدينة </label>
                                        <input wire:model.laz="city" type="text" name="city" id="city"
                                            class="form-control input-sm px-3 py-2 bg-white rounded-0">
                                        @error('city')
                                            <small><i class="text-danger">{{ $message }}</i></small>
                                        @enderror
                                    </div>
                                </td>

                                <td>
                                    <div class="form-group input-group-sm p-1 m-0"><label> الهواتف </label>
                                        <input wire:model.laz="phone" type="text" name="Phones" value=""
                                            placeholder="الهواتف"
                                            class="form-control input-sm px-3 py-2 bg-white rounded-0">
                                        @error('phone')
                                            <small><i class="text-danger">{{ $message }}</i></small>
                                        @enderror
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="registration_date"> تاريخ التسجيل </label>
                                        <input wire:model.laz="registration_date" type="date"
                                            name="registration_date" id="registration_date"
                                            class="form-control rounded-0 p-1">
                                        @error('registration_date')
                                            <small><i class="text-danger">{{ $message }}</i></small>
                                        @enderror
                                    </div>
                                </td>
                                <td>

                                    <label for="photo" class="p-5 w-100 alert alert-info"></label>
                                    <input type="file" name="photo" id="photo" accept=".jpg,.png"
                                        class="d-none" wire:model.defer="photo">
                                    @error('photo')
                                        <small><i class="text-danger">{{ $message }}</i></small>
                                    @enderror
                                    <div class="w-100" wire:loading wire:target="photo" wire:key="photo">
                                        <i class="fa-solid fa-spinner m-auto"></i>

                                    </div> 
                                    @if ($photo)
                                        <img src="{{ $photo->temporaryUrl() }}" alt=""
                                            class="rounded shadow-lg" style="height:100px ; width:100px">
                                    @else
                                        <img src="{{ Storage::url('/uploads/' . $student->photo) }}"
                                            alt="{{ $student->name() }}" class="rounded-1 my-2 shadow-sm"
                                            style="width: 100px;height:100px">
                                    @endif

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>

    </form>
</div>
