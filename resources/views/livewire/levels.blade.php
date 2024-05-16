<div class="container-fluid bg-white p-4">
    <form method="POST" class=" col-xs-12 col-sm-12 col-md-5" wire:submit.prevent="checkOpration">
        @csrf
        <div class="container">
            <div class="form-group row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <label for=""> المرحة الجامعية  </label>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <input type="text" class="form-control col-xs-12 col-sm-12 col-md-12 float-end"
                        wire:model.live.debounce.300="name">
                    @error('name')
                        <div class="text-red-500 fw-bold"> {{ $message }} </div>
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
                            <button type="submit"
                                class="btn bg-danger-dark text-white   shadow-lg float-start  rounded-1 "
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


    <br>
    <br>
    <br>

    @php
        $serial = 1;
    @endphp
    <div class="table-responsive">
    {{-- Show all expenses type list --}}
    <div class="container-fluid  px-0">
        <a href="{{ route('levels.trashed') }}" class="btn bg-red-500 text-white fw-bold float-start">
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
                <th class="bg-blue-700 text-blue-100 text-center"> المرحلة الجامعية  </th>
                <th class="bg-blue-700 text-blue-100 text-center"> الحالة </th>  
                <th class="bg-blue-700 text-blue-100 text-center">  العمليات </th>
            </tr>
        </thead>
        <tbody>


    {{-- Show all expenses type list --}}
   
        @foreach ($levels as $level)
            <tr>
                <td class="bg-white py-3 fw-bold">{{ $serial++ }}</td>
                <td class="bg-white py-3 fw-bold">{{ $level->name }}</td>
                <td class="bg-white py-3 fw-bold">{{ $level->active == 1 ? 'مفعل' : 'غير مفعل' }}</td>
                <td class="bg-white py-3 fw-bold">
                     
                        <button type="button" class="btn bg-green-500 text-white fw-bold btn-sm px-3" 
                            wire:click="updateRec({{ $level->id }})">
                            <i class="fa-solid fa-check" ></i>
                        </button>
                   
                        <button type="button" class="btn bg-red-500 text-white fw-bold btn-sm px-3" 
                            wire:click="deleteConfirmation({{ $level->id  }})">
                            <i class="fas fa-times" ></i>
                        </button>
                </td>
            </tr>
        @endforeach
      
        </tbody>
    </table>


    {{ $levels->links() }}

</div>
</div>
