<!-- Modal -->
<div class="modal" id="create-subject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgba(0, 0, 0, 0);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="color: white;">Create Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: red;"></button>
            </div>
            <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" id="subjectForm" class="createModal">
                    <label>Subject No:</label>
                    <input type="text" name="subjectName" id="subjectName" placeholder="Enter subject no." required>
                    <label>Descriptive Title:</label>
                    <input type="text" name="descriptiveTitle" id="subjectName" placeholder="Enter desciptive title" required>
                    <label>Semester:</label>
                    <select name="semester" id="subjectSemester" required>
                        <option></option>
                        <?php
                        foreach ($semesters as $semester) {
                        ?>
                            <option value="<?= $semester->semester_id ?>|<?= $semester->semester ?>"><?= $semester->semester ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <input type="hidden" name="departmentId" id="departmentId" value="<?= $department->department_id ?>">
                    <input type="hidden" name="courseId" id="courseId" value="<?= $course->course_id ?>">
                    <input type="hidden" name="yearlevelId" id="yearlevelId" value="<?= $yearlevel->yearlevel_id ?>">
                    <button class="submitbtn" name="createSubject" onclick="submitForm()">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>