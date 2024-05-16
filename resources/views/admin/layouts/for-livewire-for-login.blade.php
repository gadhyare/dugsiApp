@include('admin.layouts.header')
    <div class="main-container d-flex"> 
        <div class="content ">
            {{$slot}}
        </div>
    </div>
    @include('admin.layouts.footer')
