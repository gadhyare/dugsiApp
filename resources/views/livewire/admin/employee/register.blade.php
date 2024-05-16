<div class="container my-2 py-2">
<div class="card  border-0 col-xs-12 col-sm-12 col-md-8">
    <div class="card-header title px-3 text-white"> اضافة   موظف جديد   </div>
    <div class="card-body">

        <form  class="fw-bold" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group my-2">
                        <label for="name"> الاسم </label>
                        <input type="text" name="name" id="name" class="form-control bg-white"
                            wire:model.defer="name">


                        @error('name')
                            <small><i class="text-danger">{{ $message }}</i></small>
                        @enderror
                    </div>

                    <div class="form-group my-2">
                        <label for="gender">الجنس</label>
                        <select name="gender" id="gender" class="form-control bg-white" wire:model.defer="gender">
                            <option value="1">ذكر</option>
                            <option value="2"> أنثى </option>
                        </select>
                        @error('gender')
                            <small><i class="text-danger">{{ $message }}</i></small>
                        @enderror
                    </div>

                    <div class="form-group my-2">
                        <label for="date_of_birth"> تاريخ الولادة </label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control bg-white"
                            wire:model.defer="date_of_birth">
                        @error('date_of_birth')
                            <small><i class="text-danger">{{ $message }}</i></small>
                        @enderror
                    </div>

                    <div class="form-group my-2">
                        <label for="place_of_birth"> مكان الولادة </label>
                        <input type="text" name="place_of_birth" id="place_of_birth" class="form-control bg-white"
                            wire:model.defer="place_of_birth">
                        @error('place_of_birth')
                            <small><i class="text-danger">{{ $message }}</i></small>
                        @enderror
                    </div>

                    <div class="form-group my-2">
                        <label for="nationality"> الجنسية </label>
                        <input type="text" name="nationality" id="nationality" class="form-control bg-white"
                            wire:model.defer="nationality">
                        @error('nationality')
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
                        <label for="photo"> صورة الموظف </label>
                        <input type="file" name="photo" id="photo" class="form-control bg-white"
                            wire:model.defer="photo">
                        @error('photo')
                            <small><i class="text-danger">{{ $message }}</i></small>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
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
                        <label for="register_date"> تاريخ التسجيل </label>
                        <input type="date" name="register_date" id="register_date" class="form-control bg-white"
                            wire:model.defer="register_date">
                        @error('register_date')
                            <small><i class="text-danger">{{ $message }}</i></small>
                        @enderror
                    </div>


                    <div class="form-group my-2">
                        <label for="note">   ملاحظات </label>

                            <textarea cols="30" rows="6" name="note" id="note" class="form-control bg-white"
                            wire:model.defer="note"></textarea>
                        @error('note')
                            <small><i class="text-danger">{{ $message }}</i></small>
                        @enderror
                    </div>


                    <div class="form-group my-2">
                        <label for="is_subscribed"> محرر   </label>
                        <select name="is_subscribed" id="is_subscribed" class="form-control bg-white" wire:model.defer="is_subscribed">
                            <option value="1">نعم</option>
                            <option value="2">لا   </option>
                        </select>
                        @error('is_subscribed')
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
                </div>
            </div>


            <button type="submit" wire:click.prevent="add" class="btn btn-success col-12 m-auto">
                <i class="fa-solid fa-plus"></i>
                <span>تسجيل</span>
            </button>

        </form>
    </div>
</div>
</div>


