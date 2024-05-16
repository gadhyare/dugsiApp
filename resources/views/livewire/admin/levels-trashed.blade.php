     <div class="container bg-white p-3 my-5 rounded-2">
            @php
                $serial = ($levels->currentpage() - 1) * $levels->perpage() + 1;
            @endphp

            <a href="{{route('levels.index')}}" class="btn bg-indigo-600 text-white"   >  <i class="fa-solid fa-arrow-right"></i>  </a>
            {{-- Show all expenses type list --}}
            <x-table :headers="['#', 'المرحلة الدراسية',  'استعادة', 'الحذف النهائي']">

                @foreach ($levels as $level)
                    <tr>
                        <td>{{ $serial++ }}</td>
                        <td>{{ $level->name }}</td> 
                        <td>
                            <button class="btn bg-success-dark text-white  px-2 py-0 shadow-lg rounded-0" wire:click="restore({{ $level->id }})" >
                                <i class="fa-solid fa-pencil  "> </i>
                            </button>
                        </td>
                        <td>
                            <button class="btn bg-danger-dark text-white  px-2 py-0 shadow-lg rounded-0"
                            wire:click="deleteConfirmation({{ $level->id }})">
                            <small>
                                <i class="fa-solid fa-trash  "></i>
                            </small>
                        </button>

                        </td>
                    </tr>
                @endforeach
            </x-table>


            {{ $levels->links() }}
        </div>