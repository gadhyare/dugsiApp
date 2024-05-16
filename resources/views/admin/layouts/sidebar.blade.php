<div class="sidebar bg-indigo-700" id="side_bav">
    <div class="header-box px-3 pt-3 pb-4">
        <h1 class="fs-4">
            <span class="text-white">  لوحة التحكم  </span>
            <button class="btn d-md-none d-block close-btn px-1 py-0 text-white">
                <i class="fa fa-stream"></i>
            </button>
        </h1>
    </div>
    <ul class="list-unstyled px-2">
        <li class="px-2">
            <a href="{{route('admin.dashboard')}}" class="text-decoration-none pz-3 py-2 d-block text-white">
                <i class="fa-solid fa-house"></i> <span>الرئيسية</span>
            </a>
        </li>

        <li class="px-2">
            <a href="{{ route('fnumber.index') }}" wire:navigate class="text-decoration-none pz-3 py-2 d-block text-white">
                <i class="fa-solid fa-feather"></i> <span>الرقم العائلي</span>
            </a>
        </li>
        <li class="px-2">
            <a href="{{ route('students.info') }}" wire:navigate class="text-decoration-none pz-3 py-2 d-block text-white">
                <i class="fa-solid fa-graduation-cap"></i> <span>الطلبة</span>
            </a>
        </li>
        <li class="px-2">
            <a href="{{ route('levels.index') }}" wire:navigate class="text-decoration-none pz-3 py-2 d-block text-white">
                <i class="fa-solid fa-level-up"></i> <span>المراحل الدراسية</span>
            </a>
        </li>
        <li class="px-2">
            <a href="{{ route('classes.index') }}" wire:navigate class="text-decoration-none pz-3 py-2 d-block text-white">
                <i class="fa-solid fa-puzzle-piece"></i> <span>الفصول</span>
            </a>
        </li>
        <li class="px-2">
            <a href="{{ route('groups.index') }}" wire:navigate class="text-decoration-none pz-3 py-2 d-block text-white">
                <i class="fa-solid fa-layer-group"></i> <span>الشعب</span>
            </a>
        </li>
        <li class="px-2">
            <a href="{{ route('shifts.index') }}" wire:navigate class="text-decoration-none pz-3 py-2 d-block text-white">
                <i class="fa-brands fa-swift"></i> <span>الفترات</span>
            </a>
        </li>
        <li class="px-2">
            <a href="{{ route('sections.index') }}" wire:navigate class="text-decoration-none pz-3 py-2 d-block text-white">
                <i class="fa-solid fa-snowflake"></i> <span>الأقسام</span>
            </a>
        </li>

        <li class="px-2">
            <a href="{{ route('programs.index') }}" wire:navigate class="text-decoration-none pz-3 py-2 d-block text-white">
                <i class="fa-solid fa-snowflake"></i> <span>توزيع الفصول</span>
            </a>
        </li>
    </ul>
    <hr class="text-light" />
    <ul class="list-unstyled px-2">

        <li class="px-2">
            <a href="{{ route('subjects.index') }}" wire:navigate class="text-decoration-none pz-3 py-2 d-block text-white">
                <i class="fa-solid fa-book-open-reader"></i> <span>المواد</span>
            </a>
        </li>
        {{-- <li class="px-2">
            <a href="{{ route('exams.index') }}" wire:navigate class="text-decoration-none pz-3 py-2 d-block text-white">
                <i class="fa-solid fa-vials"></i> <span>الاختبارات</span>
            </a>
        </li> --}}

        <li class="px-2">
            <a href="{{ route('employees.index') }}" wire:navigate class="text-decoration-none pz-3 py-2 d-block text-white">
                <i class="fa-solid fa-user-doctor"></i> <span>الموظفين</span>
            </a>
        </li>
        <li class="px-2">
            <a href="" class="nav-link dropdown-toggle px-sm-0 px-1 text-white  " id="dropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-wallet"></i> <span>المالية</span>
            </a>

            <ul class="dropdown-menu text-small yare  shadow text-end" aria-labelledby="dropdown" id="sub-menu">
                <li>
                    <a class="dropdown-item text-white" href="{{ route('fees.billing_cycle') }}" wire:navigate>
                        <i class="fa fa-list"></i> <span> الدورة المالية </span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item text-white" href="{{ route('fees.index') }}" wire:navigate>
                        <i class="fa fa-list"></i> <span> مالية الطلبة </span>
                    </a>
                </li>

                 <li>
                    <a class="dropdown-item text-white" href="{{ route('print.billing.cycle.report') }}" wire:navigate>
                        <i class="fa fa-list"></i> <span> التقرير النهائي  </span>
                    </a>
                </li>               
                {{-- <li><a class="dropdown-item text-white" href="{{ route('sallary.index') }}" wire:navigate>
                        <i class="fa fa-list"></i> <span> مالية الموظفين </span> </a>
                </li>
                <li><a class="dropdown-item text-white" href="{{ route('employee.debt') }}" wire:navigate>
                        <i class="fa fa-list"></i> <span> طلب سلفة لموظف   </span> </a>
                </li>
                <li><a class="dropdown-item text-white" href="{{ route('employee.deduction') }}" wire:navigate>
                    <i class="fa fa-list"></i> <span>   العقويات المالية لموظف   </span> </a>
            </li>


                <li><a class="dropdown-item text-white" href="{{ route('expenses.index') }}" wire:navigate>
                        <i class="fa fa-list"></i> <span> المصروفات </span></a></li>
                <li><a class="dropdown-item text-white" href="{{ route('allowance.index') }}" wire:navigate>
                        <i class="fa fa-list"></i> <span> العلاوات </span></a></li>
                <li><a class="dropdown-item text-white" href="{{ route('finance.reports.index') }}" wire:navigate>
                        <i class="fa fa-list"></i> <span> التقارير المالية </span> </a></li> --}}

            </ul>

        </li>
        <li class="px-2">
            <a href="{{ route('banks.index') }}" wire:navigate class="text-decoration-none pz-3 py-2 d-block text-white">
                <i class="fa-solid fa-bank"></i> <span> الخزينة </span>
            </a>
        </li>
        <li class="px-2">
            <a href="" class="text-decoration-none pz-3 py-2 d-block text-white">
                <i class="fa-solid fa-users"></i> <span>الأعضاء</span>
            </a>
        </li>
    </ul>

    <hr class="text-light" />
    <ul class="list-unstyled px-2">
        <li class="px-2">
            <a href="" class="text-decoration-none pz-3 py-2 d-block text-white">
                <i class="fa-solid fa-comment"></i> <span>التنبيهات</span>
            </a>
        </li>
        <li class="px-2">
            <a href="" class="text-decoration-none pz-3 py-2 d-block text-white">
                <i class="fa-solid fa-list-ol"></i> <span>المهام</span>
            </a>
        </li>
        <li class="px-2">
            <a href="{{ route('filesmanager.index') }}" wire:navigate class="text-decoration-none pz-3 py-2 d-block text-white">
                <i class="fa-solid fa-folder-open"></i> <span>مدير الملفات</span>
            </a>
        </li>
        <li class="px-2">
            <a href="{{ route('settings.index') }}" wire:navigate class="text-decoration-none pz-3 py-2 d-block text-white">
                <i class="fa-solid fa-gear"></i> <span>الإعدادات</span>
            </a>
        </li>

    </ul>
</div>


