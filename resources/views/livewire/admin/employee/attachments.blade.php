<div>
    <div class="card border-0 p-3 shadow-lg col-md-11">
        @if (Session::has('status'))
            <div class="alert alert-success text-center ">{{ Session::get('status') }}</div>
        @endif


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="card">
                    <div class="card-header title px-3 text-white"> الملفات المرفة للموظف  [{{$current_employee_info->name}}] </div>

                    <div class="card-body">


            <form method="post" class="fw-bold"  enctype="multipart/form-data">
                @csrf
                <div class="form-group my-2">
                    <input type="hidden" class="form-control bg-white"
                        wire:model.defer="employees_info_id">
                    <label for="title"> العنوان </label>
                    <input type="text" name="title" id="title" class="form-control bg-white"
                        wire:model.defer="title">


                    @error('title')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>
                <div class="form-group my-2">
                    <label for="description"> الوصف </label>

                        <textarea name="description" id="description" class="form-control bg-white"
                        wire:model.defer="description" cols="30" rows="6"></textarea>
                    @error('description')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="file_name"> الملف </label>
                    <input type="file" name="file_name" id="file_name" class="form-control bg-white"
                        wire:model.defer="file_name">
                    @error('file_name')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>


                <button class="btn btn-success col-12 m-auto" wire:click.prevent="add"> <i class="fa fa-upload"></i> <span>رفع المرفقات </span> </button>

            </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8">




        @php
            $serial = ($employyes_attachments->currentpage() - 1) * $employyes_attachments->perpage() + 1;
        @endphp
        {{-- Show all expenses type list --}}
        <x-table :headers="['#',  'العنوان'  , 'الوصف', 'اسم الملف', 'تاريخ الانشاء',    'التعديل' , 'الحذف' ]">

            @foreach ($employyes_attachments as $employyes_attachment)
                <tr>
                    <td>{{ $serial++ }}</td>
                    <td>{{ $employyes_attachment->title }}</td>
                    <td>{{ $employyes_attachment->description }}</td>
                    <td>{{ $employyes_attachment->file_name }}</td>
                    <td>{{ $employyes_attachment->created_at }}</td>
                    <td>
                        <small><i class="fa-solid fa-pen  bg-success  text-white  shadow p-1"
                                wire:click="updateRec({{ $employyes_attachment->id }})" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"></i></small>
                    </td>
                    <td>


                        <x-delete-confirm btnTitle="حذف" recId="{{ $employyes_attachment->id }}">
                            [{{ $employyes_attachment->title}}]
                        </x-delete-confirm>

                    </td>
                </tr>
            @endforeach
        </x-table>



        {{ $employyes_attachments->links() }}


    </div>
</div>
    </div>
</div>
