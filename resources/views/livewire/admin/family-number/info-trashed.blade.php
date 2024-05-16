<div class="container-fluid my-2 p-5 rounded-3  bg-white">
                <a href="{{ route('fnumber.index') }}" class="btn bg-blue-500 text-white fw-bold float-start">
            <i class="fa-solid fa-home"></i>
            <span>
                 رئيسية الرقم العائلي  
            </span>
        </a>
        <br>
        <br>

            <table class="table table fw-bold">
                <thead>
                    <tr>
                        <th class="bg-blue-700 text-blue-100 text-center">#</th>
                        <th class="bg-blue-700 text-blue-100 text-center">الرقم العائلي</th> 
                        <th class="bg-blue-700 text-blue-100 text-center">استعادة</th>
                        <th class="bg-blue-700 text-blue-100 text-center">الحذف</th>
                    </tr>
                </thead>
                <tbody>
                    @php $serial = 1 ; @endphp 
                    @foreach ($fathers as $father)
                        <tr>
                            <td>{{ $serial++ }}</td>
                            <td class="text-center">{{ $father->fnumber }}</td>
                            <td class="text-center">
                                <button    class="btn text-orange-500 py-0 " wire:click="restore({{ $father->id }})">
                                    <i class="fa fa-recycle  p-1"></i>
                                </button>
                            </td>
                            
                            
                            <td class="text-center">

                                <i class="fa-solid fa-trash text-red-500 "
                                    wire:click="deleteConfirmation({{ $father }})"></i>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $fathers->links() }}
</div>
