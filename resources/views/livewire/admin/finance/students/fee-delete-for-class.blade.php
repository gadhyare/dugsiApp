<div class="container bg-white p-2" style="overflow: hidden">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="card rounded-0  ">
                <div class="card-body border-0">
                    <form action="post" wire:submit.prevent="add">
                        <div class="form-group my-2 fw-bold">
                            <label class="container px-0 py-2" for="level">المرحلة الدراسية
                                <span class="float-start">
                                    @error('levels_id')
                                        <div class="bg-danger-dark text-white px-2">
                                            مطلوب
                                        </div>
                                    @enderror
                                </span>
                            </label>
                            <select wire:model.lazy="levels_id" class="form-select pe-5 rounded-0">
                                <option selected> اختر المرحلة الدراسية </option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group my-2 fw-bold">
                            <label class="container px-0 py-2" for="classes"> الصف
                                <span class="float-start">
                                    @error('classes_id')
                                        <div class="bg-danger-dark text-white px-2">
                                            مطلوب
                                        </div>
                                    @enderror
                                </span>
                            <span class="float-start fw-bold  " wire:loading wire:target="levels_id">
                            <i class="fa-solid fa-spinner fa-spin-pulse"   ></i>
                            </span>
                            </label>  
                            <select wire:model.lazy="classes_id" class="form-select pe-5 rounded-0"> 
                                <option selected   > اختر الصف   </option> 
                                    @if (count($classes) > 0)
                                        @foreach ($classes as $classe)
                                            <option value="{{ $classe->id }}">{{ $classe->name }}</option>
                                        @endforeach 
                                    @endif 
                            </select>
                        </div>
                        <div class="form-group my-2 fw-bold">
                            <label class="container px-0 py-2" for="shift"> الفترة الدراسية
                                <span class="float-start">
                                    @error('shifts_id')
                                        <div class="bg-danger-dark text-white px-2">
                                            مطلوب
                                        </div>
                                    @enderror
                                </span>
                            </label>
                            <select wire:model.lazy="shifts_id" class="form-select pe-5 rounded-0">
                                <option selected> اختر الفترة الدراسية </option>
                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group my-2 fw-bold">
                            <label class="container px-0 py-2" for="section"> القسم
                                <span class="float-start">
                                    @error('sections_id')
                                        <div class="bg-danger-dark text-white px-2">
                                            مطلوب
                                        </div>
                                    @enderror
                                </span>
                            </label>
                            <select wire:model.lazy="sections_id" class="form-select pe-5 rounded-0">
                                <option selected> اختر القسم </option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group my-2 fw-bold">
                            <label class="container px-0 py-2" for="group"> المجموعة
                                <span class="float-start">
                                    @error('groups_id')
                                        <div class="bg-danger-dark text-white px-2">
                                            مطلوب
                                        </div>
                                    @enderror
                                </span>
                            </label>
                            <select wire:model.lazy="groups_id" class="form-select pe-5 rounded-0">
                                <option selected> اختر المجموعة
                                </option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group my-2 fw-bold">
                            <label class="container px-0 py-2" for="group"> جهة الدفع
                                <span class="float-start">
                                    @error('feestypes_id')
                                        <div class="bg-danger-dark text-white px-2">
                                            مطلوب
                                        </div>
                                    @enderror
                                </span>
                            </label>
                            <select class="form-select rounded-0 px-5 bg-light my-1" wire:model.lazy="feestypes_id">
                                <option selected> اختر جهة الدفع </option>
                                @foreach ($feestypes as $feestype)
                                    <option value="{{ $feestype->id }}"> {{ $feestype->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn bg-primary-dark text-white px-5" wire:click.prevent="getData">
                            <span class="float-start fw-bold  " wire:loading wire:target="getData">
                            <i class="fa-solid fa-spinner fa-spin-pulse"   ></i>
                            </span>
                            <span class="px-1">
                                ابحث
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7">
            @if (count($invoices_info) > 0) 
                <button class="btn bg-primary-dark text-white   rounded-1 shadow-sm" wire:click="deleteConfirmation">
                    <i class="fa-solid fa-trash"></i>
                    <small class="px-3">
                        حذف المحدد
                    </small>
                </button>
                <br>
                <br>
                @php $i = 1 ; @endphp
                <table class="table table-striped border border-light" id="myTable">
                    <thead>
                        <tr>
                            <th class="py-2 bg-gray-dark text-white">#</th>
                            <th class="py-2 bg-gray-dark text-white"> اسم الطالب </th>
                            <th class="py-2 bg-gray-dark text-white"> المطلوب </th>
                            <th class="py-2 bg-gray-dark text-white"> الخصم </th>
                        </tr>
                    </thead>
                    <tbody>
                       
                            @foreach ($invoices_info as $item)
                                <tr>
                                    <td> {{ $i++ }}</td>
                                    <td> {{ SystemInfo::get_full_student_name($item->studentInfo->id) }} </td>
                                    <td> {{ $item->want }} </td>
                                    <td> {{ $item->discount }} </td>
                                </tr>
                            @endforeach 
                    </tbody>
                </table>

                @else 
                <div class="alert alert-info text-center border-0 rounded-0">
                    لم تختر بيانات لعرضها 
                                     </div>
            @endif
        </div>
    </div>
</div>
