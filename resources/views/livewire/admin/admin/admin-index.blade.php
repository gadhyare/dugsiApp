<div class="container bg-white p-3 my-2 rounded-1 shadow-sm">



    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">

            <div class="card rounded-1 shadow-sm border-0">
                <div class="card-header       bg-blue-700 text-blue-100"> <i class="fa-solid fa-list"></i> <span> صفحة
                        الأدمن </span> </div>
                <div class="card-body bg-blue-100 fw-bold">
                    <form action="">
                        <div class="form-group p-2">
                            <label for="name">الاسم </label>
                            <input type="text" wire:model.live.debounce.300="name" class="form-control rounded-1">
                            @error('name')
                                <x-gadhyare-error error="name" />
                            @enderror
                        </div>

                        <div class="form-group p-2">
                            <label for="email"> البريد الإلكتروني </label>
                            <input type="email" wire:model.live.debounce.300="email" class="form-control rounded-1">
                            @error('email')
                                <x-gadhyare-error error="email" />
                            @enderror
                        </div>


                        <div class="form-group p-2">
                            <label for="password"> كلمة المرور </label>
                            <input type="password" wire:model.live.debounce.300="password"
                                class="form-control rounded-1">
                            @error('password')
                                <x-gadhyare-error error="password" />
                            @enderror
                        </div>

                        <div class="form-group p-2">
                            <label for="password_confirmation"> اعادة كلمة المرور </label>
                            <input type="text" wire:model.live.debounce.300="password_confirmation"
                                class="form-control rounded-1">
                            @error('password_confirmation')
                                <x-gadhyare-error error="password_confirmation" />
                            @enderror
                        </div>

                        <div class="form-group p-2">
                            <label for="role_id"> الدرجة </label>
                            <select wire:model.live.debounce.300="role_id" class="form-select rounded-1">
                                <option>اختر الدرجة</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name_ar }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <x-gadhyare-error error="role_id" />
                            @enderror
                        </div>

                        @if ($updateId)
                            <button type="submit" wire:click.prevent="ConfirmpUdateRec({{ $updateId }})"
                                class="btn bg-green-500 text-green-100 fw-bold float-end "> تعديل </button>
                            <button type="submit" wire:click.prevent="cancel"
                                class="btn bg-red-500 text-red-100 fw-bold float-start "> تراجع </button>
                        @else
                            <button type="submit" wire:click.prevent="store"
                                class="btn bg-blue-500 text-blue-100 fw-bold "> اضافة </button>
                        @endif

                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>العضو</th>
                        <th>الإيميل</th>
                        <th> الدرجة </th>
                        <th>العلميات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td>#</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->role->name_ar }}</td>
                            <td>
                                <a href="{{route('permission.admin.permission.index' , $admin)}}" class="btn text-pink-500    px-2 py-0   " >
                                    <i class="fa-solid fa-eye  "> </i>
                                </a>
                                <button class="btn text-green-500  px-2 py-0  rounded-0"
                                    wire:click="updateRec({{ $admin->id }})">
                                    <i class="fa-solid fa-pencil  "> </i>
                                </button>
                                <button class="btn text-red-500  px-2 py-0  rounded-0"
                                    wire:click="deleteConfirmation({{ $admin->id }})">
                                    <i class="fa-solid fa-trash  "> </i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
