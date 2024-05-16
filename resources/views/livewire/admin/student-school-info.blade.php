<div>
    <div class="card border-0 p-3 shadow-lg col-md-9">
        @if (Session::has('status'))
            <div class="alert alert-success text-center ">{{ Session::get('status') }}</div>
        @endif





        @php
            $serial =  1;
        @endphp
        {{-- Show all expenses type list --}}
        <x-table :headers="['#',    'المرحلة الدراسية'  ,'الفصل'  ,'المجموعة'  ,'الفترة'  ,'القسم'  ,'تاريخ التسجيل'  ,'الخصم' , 'الحالة'     ,    'الحذف' ]">

            @foreach ($students as $student)
                <tr wire:key="student-{{ $student->id }}">
                    <td>{{ $serial++ }}</td>
                    <td>{{ $student->programs->levels->name }}</td>
                    <td>{{ $student->programs->classes->name }}</td>
                    <td>{{ $student->programs->groups->name }}</td>
                    <td>{{ $student->programs->shifts->name }}</td>
                    <td>{{ $student->programs->sections->name }}</td>
                    <td>{{ $student->registered_date }}</td>
                    <td>{{ $student->discount }}</td>

                    <td>{{ $student->active == 1 ? 'مفعل' : 'غير مفعل' }}</td>

                
                    <td>

 
                        {{$deleteId}}

                        <button type="button" class="btn bg-danger-dark text-white  px-2 py-0 shadow-lg rounded-0"  wire:click.prevent="deleteConfirmation({{$student->id}})" > 
                        <i class="fa-solid fa-trash  " > </i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </x-table>

 
    </div>
</div>
