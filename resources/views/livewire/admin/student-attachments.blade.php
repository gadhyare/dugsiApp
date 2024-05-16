<div>
    <div class="card border-0 p-3 shadow-lg col-md-11">
        @if (Session::has('status'))
            <div class="alert alert-success text-center ">{{ Session::get('status') }}</div>
        @endif


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="card">
                    <div class="card-header title px-3 text-white"> اضافة قريب للطالب   </div>

                    <div class="card-body">


            <form method="post" class="fw-bold"  enctype="multipart/form-data">
                @csrf
                <div class="form-group my-2">
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
                    <label for="file"> الوصف </label>
                    <input type="file" name="file" id="file" class="form-control bg-white"
                        wire:model.defer="file">
                    @error('file')
                        <small><i class="text-danger">{{ $message }}</i></small>
                    @enderror
                </div>


                <button class="btn btn-success col-12 m-auto" wire:click.prevent="uploadFile"> <i class="fa fa-upload"></i> <span>رفع المرفقات </span> </button>

            </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8">




        @php
            $serial = ($students_attachments->currentpage() - 1) * $students_attachments->perpage() + 1;
        @endphp
        {{-- Show all expenses type list --}}
        <x-table :headers="['#',  'العنوان'  , 'الوصف', 'اسم الملف', 'تاريخ الانشاء',  'التعديل' , 'الحذف' ]">

            @foreach ($students_attachments as $students_attachment)
                <tr>
                    <td>{{ $serial++ }}</td>
                    <td>{{ $students_attachment->title }}</td>
                    <td>{{ $students_attachment->description }}</td>
                    <td>{{ $students_attachment->file_name }}</td>
                    <td>{{ $students_attachment->created_at }}</td>
                    <td>
                        <small><i class="fa-solid fa-pen  bg-success  text-white  shadow p-1"
                                wire:click="updateRec({{ $students_attachment->id }})" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"></i></small>
                    </td>
                    <td>


                        <x-delete-confirm btnTitle="حذف" recId="{{ $students_attachment->id }}">
                            [{{ $students_attachment->id}}]
                        </x-delete-confirm>

                    </td>
                </tr>
            @endforeach
        </x-table>



        {{ $students_attachments->links() }}


    </div>
</div>
    </div>
</div>
