     <div class="container bg-white p-3 my-5 rounded-2">
            @php
                $serial = ($groups->currentpage() - 1) * $groups->perpage() + 1;
            @endphp

            <a href="{{route('groups.index')}}" class="btn bg-indigo-600 text-white"   >  
                <i class="fa-solid fa-arrow-right"></i>  
                <span>
                    رئيسية الشعب
                </span>
            </a>
            {{-- Show all expenses type list --}}
            <x-table :headers="['#', 'الشعبة',  'استعادة', 'الحذف النهائي']">

                @foreach ($groups as $group)
                    <tr>
                        <td>{{ $serial++ }}</td>
                        <td>{{ $group->name }}</td> 
                        <td>
                            <button class="btn bg-success-dark text-white  px-2 py-0 shadow-lg rounded-0" wire:click="restore({{ $group->id }})" >
                                <i class="fa-solid fa-pencil  "> </i>
                            </button>
                        </td>
                        <td>
                            <button class="btn bg-danger-dark text-white  px-2 py-0 shadow-lg rounded-0"
                            wire:click="deleteConfirmation({{ $group->id }})">
                            <small>
                                <i class="fa-solid fa-trash  "></i>
                            </small>
                        </button>

                        </td>
                    </tr>
                @endforeach
            </x-table>


            {{ $groups->links() }}
        </div>