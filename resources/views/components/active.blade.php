@props(['active' => 1])


@if ($active == 1 )
    <span class="btn bg-pink-500 text-white fw-bold btn-sm  px-3" >
        <i class="fa-solid fa-toggle-on "></i>
    </span>
@else
    <span class="btn bg-dark text-white fw-bold btn-sm px-3 ">
        <i class="fa-solid fa-toggle-off "></i>
    </span>
@endif
