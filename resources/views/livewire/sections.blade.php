<div class="container bg-white py-4">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="card shadow-md rounded-0 border-0">
                <div class="card-header   bg-white fw-bold rounded-0">
                    <i class="fa-solid fa-list"></i>
                    <span>
                        قائمة الأقسام
                    </span>
                </div>
                <div class="card-body">
                    <form method="post" class="fw-bold" wire:submit.prevent="checkOpration">
                        @csrf
                        <div class="form-group my-2">

                            <label for="name"> القسم </label>
                            <input type="text" name="name" id="name" class="form-control bg-white"
                                wire:model.defer="name">
                            @error('name')
                                <small><i class="text-danger">{{ $message }}</i></small>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="active">الحالة</label>
                            <select name="active" id="active" class="form-control bg-white"
                                wire:model.defer="active">
                                <option value="1">مفعل</option>
                                <option value="2">غير مفعل</option>
                            </select>
                            @error('active')
                                <small><i class="text-danger">{{ $message }}</i></small>
                            @enderror
                        </div>
                        <button type="submit"
                            class="btn @if ($updateId) bg-success-dark @else bg-primary-dark @endif text-white   shadow-sm float-end">
                            <i class="fa fa-plus"></i>
                            {{ $btnTitle }} مستوى
                        </button>
                        @if ($updateId)
                            <button type="submit" class="btn bg-danger-dark text-white   shadow-lg float-start"
                                wire:click.prevent="cancel">
                                <span>
                                    تراجع
                                </span>
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9">
                        <div class="float-start py-0">
                <a href="{{ route('sections.trashed') }}" class="btn bg-red-700 text-white rounded-1 shadow-2">
                    <i class="fa-solid fa-trash"></i>
                    <span>
                        سلة المهملات
                    </span>
                </a>
            </div>
            @php
                $serial = ($sections->currentpage() - 1) * $sections->perpage() + 1;
            @endphp
            {{-- Show all expenses type list --}}
            <x-table :headers="['#', 'القسم', 'الحالة',   'العمليات']" >
                @foreach ($sections as $section)
                    <tr>
                        <td class="text-bold-500">{{ $serial++ }}</td>
                        <td class="text-bold-500">{{ $section->name }}</td>
                        <td class="text-bold-500">{{ $section->active == 1 ? 'مفعل' : 'غير مفعل' }}</td>
                        <td class="text-bold-500  text-center ">
                            <span class="btn bg-green-500   text-white    py-1 px-2 mx-1 rounded-0"
                                wire:click="updateRec({{ $section->id }})"   >
                                <i class="fa-solid fa-pencil   "> </i>
                            </span>
                         
                            <span class="btn bg-red-500   text-white    py-1 px-2 mx-1 rounded-0"
                                wire:click="deleteConfirmation({{ $section->id }})">
                                
                                    <i class="fa-solid fa-trash  "></i>
                               
                            </span>

                        </td>
                    </tr>
                @endforeach
            </x-table>
            {{ $sections->links() }}
        </div>
    </div>
</div>
