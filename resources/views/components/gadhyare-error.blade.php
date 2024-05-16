@props(['error' => 'error' ])

@if ($error)
    @error($error)
        <div class="alert alert-danger text-center py-1"> {{$message}} </div>
    @enderror
@endif