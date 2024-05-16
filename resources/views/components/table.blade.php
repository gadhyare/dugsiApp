{{-- Show all expenses type list --}}
<div class="form-group my-2 col-xs-12 col-sm-12 col-md-4">
    <span class="float-end" >
        <input type="search" class="form-control  " wire:model.live.debounce.300="search">
    </span>
    <span class="float-start" wire:loading  whire:target="search"  >
        da
    </span>
</div>
<br>
<br>
<div class="table-responsive" >
    <table class="table table-sm table-bordered fw-bold mb-0" >
        <thead>
            @foreach ($headers as $header)
                <th class="py-2 text-center   bg-white">{{ $header }}</th>
            @endforeach
        </thead>
        <tbody>
            {{ $slot }}
        </tbody> 
    </table>
</div>
