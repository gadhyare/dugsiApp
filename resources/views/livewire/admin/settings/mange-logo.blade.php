<div class="container">
   
    <div class="card col-xs-12 col-sm-12 col-md-5 m-auto alert alert-info shadow-lg">
        @error('logo')
        <div class="alert alert-danger text-center">
            {{$message}}
        </div>
    @enderror
            @if($message)
        <div class="alert alert-danger text-center">
            {{$message}}
        </div>
    @endif
        <div class="card-body p-5 text-center">
            <label for="logo">
                <i class="fa-solid fa-cloud-arrow-up" style="font-size: 48px"></i>
                <div class="my-2">
                    اضغط هنا لاختيار الملف
                </div>
            </label>
            <input type="file"  id="logo" class="d-none" accept="image/png, image/gif, image/jpeg" wire:model.live.debounce.300="logo" >
            <button class="w-100 m-auto btn btn-primary" @if($logo == '')  disabled @endif  wire:click.prevent="uploadlogo"  wire:target="logo">
                upload
            </button>
        </div>
    </div>
    

    <br>

    @if ($info)
        <div class="card text-center border-0 p-2 my-3 w-100" style="background-color: #F0F1F3 !important">
        <img src="{{asset('storage/images/'. $info->logo)}}" alt="{{$info->name}}" class=" m-auto" style="height: 150px " >
    </div>
    @endif

  
    
</div>
