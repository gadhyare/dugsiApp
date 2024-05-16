@include('admin.layouts.header')
<div class="main-container d-flex">
    @include('admin.layouts.sidebar')
    <div class="content ">
        @include('admin.layouts.top-nav')
        {{ $slot }}
    </div>
</div>
@include('admin.layouts.footer')
