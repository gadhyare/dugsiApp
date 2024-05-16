<div class="container">
    <div class="card col-xs-12 col-sm-12 col-md-8 rounded-0 shadow-lg border-0">
        <div class="card-header title text-white rounded-0">
            <i class="fa-solid fa-cog"></i>
            <span>
                اعداد البرنامج
            </span>
        </div>



        <div class="card-body">
            <div class="container m-auto py-3 text-dark bg-white  p-2">
                <div class="card-header p-1 text-dark bg-white"><i class="fa fa-info"></i> تحديث معلومات البرنامج </div>
                <div class="card-body">
                    <form   method="post"  wire:submit.prevent="updateRec">
                        @csrf
                        <div class="row">
                            <div class="form-group col-xs-12 col-md-6 py-2">
                                <label for="siteName"> اسم المدرسة </label>
                                <span class="float-start mb-2">
                                    @error('name')
                                            <div class="bg-danger px-3  shadow-md text-center text-white">
                                                مطلوب
                                            </div>
                                    @enderror
                                </span>
                                <input type="text" wire:model="name"
                                    class="form-control rounded-0 col-12"></div>
                            <div class="form-group col-xs-12 col-md-6 py-2">
                                <label for="siteDisc"> الوصف</label>
                                                                    <span class="float-start mb-2">
                                    @error('description')
                                            <div class="bg-danger px-3  shadow-md text-center text-white">
                                                مطلوب
                                            </div>
                                    @enderror
                                </span>
                            <input
                                    type="text"   wire:model="description"
                                    class="form-control rounded-0 col-12"></div>
                            <div class="form-group col-xs-12 col-md-6 py-2">
                                <label for="siteAddr"> العنوان</label>
                                    <span class="float-start mb-2">
                                        @error('address')
                                                <div class="bg-danger px-3  shadow-md text-center text-white">
                                                    مطلوب
                                                </div>
                                        @enderror
                                    </span>
                                 <input
                                    type="text"    wire:model="address"
                                    class="form-control rounded-0 col-12"></div>
                            <div class="form-group col-xs-12 col-md-6 py-2">
                                <label for="siteEmail"> الهواتف</label>
                                    <span class="float-start mb-2">
                                        @error('phones')
                                                <div class="bg-danger px-3  shadow-md text-center text-white">
                                                    مطلوب
                                                </div>
                                        @enderror
                                    </span>
                                <input
                                    type="text" wire:model="phones"
                                    class="form-control rounded-0 col-12"></div>
                            <div class="form-group col-xs-12 col-md-6 py-2">
                                <label for="siteEmail"> البريد الإلكتروني</label>
                                    <span class="float-start mb-2">
                                        @error('email')
                                                <div class="bg-danger px-3  shadow-md text-center text-white">
                                                    مطلوب
                                                </div>
                                        @enderror
                                    </span>
                                 <input type="email"   wire:model="email" class="form-control rounded-0 col-12"></div>
                            <div class="form-group col-xs-12 col-md-6 py-2">
                                <label for="siteUrl"> رابط البرنامج</label>
                                    <span class="float-start mb-2">
                                        @error('url')
                                                <div class="bg-danger px-3  shadow-md text-center text-white">
                                                    مطلوب
                                                </div>
                                        @enderror
                                    </span>


                                <input type="text"    wire:model="url"
                                    class="form-control rounded-0 col-12"></div>


                            <div class="form-group col-xs-12 col-md-6 py-2"><label for="siteStatus"> الحالة </label> <select
                                wire:model="active" class="form-select rounded-0 col-12 px-5 ">
                                    <option value="2">اغلاق</option>
                                    <option value="1">مفعل</option>
                                </select></div>
                            <div class="form-group col-12">
                                <label for="siteColsemsg"> رسالة الموقع حال الإغلاق</label>

                                    <span class="float-start mb-2">
                                        @error('close_message')
                                                <div class="bg-danger px-3  shadow-md text-center text-white">
                                                    مطلوب
                                                </div>
                                        @enderror
                                    </span>

                                <textarea wire:model="close_message"  cols="30" rows="3" class="form-control rounded-0 col-12">

                                </textarea>
                            </div>

                        </div> <button type="submit"
                            class="btn bg-dark my-2 text-white     px-3 py-1 float-end"> تحديث </button>
                            <a  href="{{route('settings.manage_logo')}}" target="_blank"
                            class="btn bg-danger my-2 text-white     px-3 py-1 float-start"> شعار المؤسسة </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
