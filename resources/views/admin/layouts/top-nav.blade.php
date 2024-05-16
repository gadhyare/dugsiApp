<nav class="navbar navbar-expand-lg bg-indigo-700  ">
    <div class="container-fluid">
        <button class="btn text-white me-3 show-sidebar d-md-none d-lg-none d-block">
            <i class="fa fa-list "></i>
        </button>

        <div class="container ">
            <div class="float-start">
                <form action="{{route('admin.logout')}}" method="POST">
                    @csrf
                    <button class="btn bg-white   border-0">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
