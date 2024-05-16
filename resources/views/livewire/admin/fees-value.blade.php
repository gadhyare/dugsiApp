<div>
    <div class="card border-0 p-3 shadow-lg col-md-11">
        @if (Session::has('status'))
            <div class="alert alert-success text-center ">{{ Session::get('status') }}</div>
        @endif

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="card">
                    <div class="card-header title"></div>
                    <div class="card-body">
                        <form method="post" class="fw-bold">
                            @csrf
                            <div class="form-group my-2">
                                <label for="amount"> القيمة </label>
                                <input type="text" name="amount" id="amount" class="form-control bg-white"
                                    wire:model="amount">
                                @error('amount')
                                    <small><i class="text-danger">{{ $message }}</i></small>
                                @enderror
                            </div>


                            <div class="form-group my-2">

                                <label for="levels">   المرحلة الدراسية  </label>
                                <select name="levels" id="levels" name="selectLevel"
                                    class="form-control bg-white" wire:model="selectPrograms" multiple  >
                                    <option selected> اختر المرحلة الدراسية   </option>
                                    @foreach ($programs as $program )
                                        <option value="{{ $program->id }}">{{ $program->levels->name . '-' .$program->classes->name . '-' .$program->groups->name . '-' .$program->shifts->name . '-' .$program->sections->name      }}</option>
                                    @endforeach
                                </select>
                                @error('programs')
                                    <small><i class="text-danger">{{ $message }}</i></small>
                                @enderror
                            </div>
 


                            <div class="form-group my-2">
                                <label for="feestypes_id"> جهة الدفع </label>

                                <select name="feestypes_id" id="feestypes_id" name="feestypes_id"
                                    class="form-control bg-white" wire:model="feestypes_id">
                                    <option selected> اختر جهة الدفع </option>
                                    @foreach ($feestypes as $feestype)
                                        <option value="{{ $feestype->id }}">{{ $feestype->name }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" class="form-control bg-white">
                                @error('feestypes_id')
                                    <small><i class="text-danger">{{ $message }}</i></small>
                                @enderror
                            </div>


                            <div class="form-group my-2">
                                <label for="active">الحالة</label>
                                <select name="active" id="active" class="form-control bg-white"
                                    wire:model="active">
                                    <option value="1">مفعل</option>
                                    <option value="2">غير مفعل</option>
                                </select>
                                @error('active')
                                    <small><i class="text-danger">{{ $message }}</i></small>
                                @enderror
                            </div>

                            <button type="submit" wire:click.prevent="add" class="btn btn-success col-12 m-auto" > <i class="fa-solid fa-plus"></i> <span> {{$btnTitle}} </span>  </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8">

                @php
                    $serial = ($feesValues->currentpage() - 1) * $feesValues->perpage() + 1;
                @endphp
                {{-- Show all expenses type list --}}
                <x-table :headers="['#',    'المرحلة الدراسية' ,'الصف' , 'جهة الدفع',  'قيمة الرسوم', 'الحالة', 'التعديل', 'الحذف']">

                    @foreach ($feesValues as $feesValue)
                        <tr>
                            <td>{{ $serial++ }}</td>
                            <td>{{ $feesValue->programs->levels->name  }}</td>
                            <td>{{ $feesValue->programs->classes->name}}</td>
                            <td>{{  $feesValue->feestypes->name }}</td>
                            <td>{{ $feesValue->amount }}</td>
                            <td>{{ $feesValue->active == 1 ? 'مفعل' : 'غير مفعل' }}</td>
                            <td>
                                <small><i class="fa-solid fa-pen  bg-success  text-white  shadow p-1"
                                        wire:click="updateRec({{ $feesValue->id }})" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal"></i></small>
                            </td>
                            <td>


                                <x-delete-confirm btnTitle="حذف" recId="{{ $feesValue->id }}">
                                    [{{ $feesValue->feestypes->name }}]
                                </x-delete-confirm>

                            </td>
                        </tr>
                    @endforeach
                </x-table>


                {{ $feesValues->links() }}

            </div>
        </div>

    </div>
</div>
