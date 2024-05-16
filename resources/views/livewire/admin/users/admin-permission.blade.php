<div class="container bg-white shadow-1 rounded-1 my-2 p-3 " wire:poll.keep-alive>
    <div class="container px-0">
        <h6>
            <span>
                <i class="fa-solid fa-user"></i>
                <span class="mx-2"> {{ $admins->email }} | {{ $admins->name }} <span
                        class="badge bg-cyan-500 rounded-1 float-start  text-cyan-100">{{ $admins->role->name_ar }}</span> </span>
            </span>
        </h6>
    </div>

    <br>
    @if (count($permissions) > 0)
        @foreach ($tables as $item)
            <div class="card rounded-0 mb-2" wire:poll.keep-alive>
                <div class="card-header rounded-0 bg-blue-700 text-white fw-bold">
                    <i class="fa-solid fa-list"></i> <span class="mx-2"> {{ $item->name_ar }} </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action=""> 
                        @php $data = \App\Models\Permission::where('table_id' , '=' , $item->id)->get() @endphp
                        @foreach ($data as $permission)
                            <div class="col fw-bold" wire:poll.keep-alive> 
                                <input type="checkbox"  id="admin_per.{{$permission->id}}" wire:click="store({{$admin}} , {{$permission->id}})"
                                @if (\App\Models\AdminPermission::where('admin_id', $admin )->where('permission_id', $permission->id)->first())
                                    checked
                                @endif >
                                <label > {{$permission->name_ar}} </label>
                            </div>
                        @endforeach
                        </form>
                    </div>
                </div>

            </div>
        @endforeach
    @endif
</div>
