<div class="container-fluid bg-white py-5"> 
    <form method="POST" class=" col-xs-12 col-sm-12 col-md-5" wire:submit.prevent="checkOpration">
        @csrf 
        <div class="container"> 
                <div class="form-group row">
                    <div class="col-xs-12 col-sm-12 col-md-3">
                        <label for=""  >الرقم العائلي</label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <input type="text" class="form-control col-xs-12 col-sm-12 col-md-12 float-end" wire:model.live.debounce.300="fnumber" >
                        @error('fnumber')
                            <div class="text-red-500 fw-bold">  {{$message}} </div>
                        @enderror
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3">
                        <div class="form-group">
                    <button type="submit"
                        class="btn @if ($updateId) bg-success-dark @else bg-primary-dark @endif text-white rounded-1  shadow-lg float-end">
                        <i class="fa fa-plus"></i>
                        {{ $btnTitle }} 
                    </button>
                    @if ($updateId)
                        <button type="submit" class="btn bg-danger-dark text-white   shadow-lg float-start  rounded-1 "
                            wire:click.prevent="cancel">
                            <span>
                                تراجع
                            </span>
                        </button>
                    @endif
                        </div>
                    </div>    
                </div> 
        </div> 
    </form>

    <div class="clearfix"></div>
    <br>
    <br>
    <br>


    @php
        $serial = 1;
    @endphp
    <div class="table-responsive">
    {{-- Show all expenses type list --}}
    <div class="container-fluid  px-0">
        <a href="{{ route('fnumber.trashed') }}" class="btn bg-red-500 text-white fw-bold float-start">
            <i class="fa-solid fa-trash"></i>
            <span>
                سلة المهملات
            </span>
        </a>
        <span class="float-end w-25">
            <input type="text" class="form-control my-2  rounded-1" wire:model.live.debounce.300="search">
        </span>
        <span class="float-end w-25">
            <button class="btn bg-orange-500 m-2  rounded-1" wire:click.prevent="cancel">
                <i class="fa-solid fa-filter"></i>
            </button>
        </span>
    </div>

    <table class="table table-strped fw-bold">
        <thead>
            <tr>
                <th class="bg-blue-700 text-blue-100 text-center">#</th>
                <th class="bg-blue-700 text-blue-100 text-center">الرقم العائلي</th>
                <th class="bg-blue-700 text-blue-100 text-center"> أكثر </th>
                <th class="bg-blue-700 text-blue-100 text-center">الحالة</th>
                <th class="bg-blue-700 text-blue-100 text-center">اضافة أطفال</th>
                <th class="bg-blue-700 text-blue-100 text-center"> العمليات </th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($fathers as $father)
                <tr>
                    <td class="fw-bold">{{ $serial++ }}</td>
                    <td class="text-center   fw-bold">{{ $father->fnumber }}</td>
                    <td class="text-center   fw-bold">
                        <a href="{{ route('fnumber.info', $father) }}"
                            class="btn bg-red-500 text-white fw-bold btn-sm px-3">
                            <i class="fa fa-users  p-1"></i>
                        </a>
                    </td>
                    <td class="text-center ">
                        <x-active active="{{ $father->active }}" wire:click="changeActiveStatus({{ $father->id }})" />
                    </td>
                    <td class="fw-bold text-center ">
                        <a href="{{ route('students.register', $father->id) }}" 
                            class="btn bg-indigo-500 text-white fw-bold btn-sm px-3">
                            <i class="fa fa-child p-1"   > </i> 
                        </a>
                    </td>
                    <td class="text-center ">
                        <button type="button" class="btn bg-green-500 text-white fw-bold btn-sm px-3" 
                            wire:click="updateRec({{ $father->id }})">
                            <i class="fa-solid fa-check" ></i>
                        </button>
                   
                        <button type="button" class="btn bg-red-500 text-white fw-bold btn-sm px-3" 
                            wire:click="deleteConfirmation({{ $father }})">
                            <i class="fas fa-times" ></i>
                        </button>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $fathers->links() }}
 
</div>
</div>
 
 