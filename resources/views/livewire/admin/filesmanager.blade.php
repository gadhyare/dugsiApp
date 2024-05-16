<div>

    <div class="card col-xs-12 col-sm-12 col-md-7">
        <form enctype="multipart/form-data">
            <div class="card-body">
                @if(! empty($message) )
                    <div class="alert alert-{{$message[0]}}">{{$message[1]}}</div>
                @endif
                <div class="gorm-group">
                    <label for="image" class="p-5 w-100 alert alert-info"></label>
                    <input type="file" name="image" id="image" class="d-none" wire:model="image">
                </div>
                <button type="submit" wire:click.prevent="uploadFile" class="btn btn-danger col-12 "> <i class="fa-solid fa-cloud-arrow-up"></i> <span>Upload</span>  </button>
                <div class="w-100" wire:loading wire:target="image" wire:key="image">
                    <i class="fa-solid fa-spinner m-auto"></i>
                </div>

                @if($image)
                    <img src="{{$image->temporaryUrl()}}" alt="">
                @endif
            </div>
        </form>
    </div>
</div>
