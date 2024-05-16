<ul class="nav nav-tabs exams-section p-0" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link  rounded-0 px-5  " id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
            type="button" role="tab" aria-controls="home" aria-selected="true">
            اختبار فصل
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link  rounded-0 px-5 active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
            type="button" role="tab" aria-controls="profile" aria-selected="false">
            اختبار طالب
        </button>
    </li>

</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
        @livewire('admin.exams.class-exam-report')
    </div>
    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @livewire('admin.exams.student-exam-report')
    </div>
</div>
