<div class="container-fluid px-0">
    <ul class="nav nav-tabs exams-section p-0" id="myTab" role="tablist">
        <li class="nav-item " role="presentation">
          <button class="nav-link rounded-0 px-5 active" id="for-class-tab" data-bs-toggle="tab" data-bs-target="#for-class" type="button" role="tab" aria-controls="for-class" aria-selected="true">
            اختبار فصل
        </button>
        </li>
        <li class="nav-item " role="presentation">
          <button class="nav-link rounded-0 px-5 " id="student-tab" data-bs-toggle="tab" data-bs-target="#student" type="button" role="tab" aria-controls="student" aria-selected="false">
            اختبار طالب
          </button>
        </li>

      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="for-class" role="tabpanel" aria-labelledby="for-class-tab">
            <div class="container-fluid px-0">
                 <div class="card rounded-0 border-0 shadow-0">
                    @livewire('admin.exams.add-to-class')
                 </div>
            </div>
        </div>
        <div class="tab-pane fade " id="student" role="tabpanel" aria-labelledby="student-tab">
            @livewire('admin.exams.student-exam')
        </div>

      </div>

</div>
