     <div class="container bg-white p-3 my-5 rounded-2">
                    <div class="col-xs-12 col-sm-12 col-md-8">
             <a href="{{route('classes.index')}}" class="btn bg-indigo-700 text-white"> <i class="fa fa-arrow-right"></i> </a>
            @php
                $serial = ($classes->currentpage() - 1) * $classes->perpage() + 1;
            @endphp
            {{-- Show all expenses type list --}}
            <x-table :headers="['#', 'الصف', 'المرحلة الدراسية',   'استرجاع', 'الحذف النهائي']">
                @foreach ($classes as $classe)
                    <tr>
                        <td>{{ $serial++ }}</td>
                        <td>{{ $classe->name }}</td>
                        <td>{{ $classe->levels->name }}</td> 
                        <td>
                            <button class="btn bg-success-dark text-white  px-2 py-0 shadow-lg rounded-0">
                                <i class="fa-solid fa-pencil"
                                    wire:click="restore({{ $classe->id }})"></i></button>
                        </td>
                        <td>
                            <button class="btn bg-danger-dark text-white  px-2 py-0 shadow-lg rounded-0"
                                wire:click="deleteConfirmation({{ $classe->id }})">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </x-table>
            {{ $classes->links() }}
        </div>
        </div>