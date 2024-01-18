<!-- Modal -->
<div class="modal" id="assign-teacher" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgba(0, 0, 0, 0);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="color: white;">Create Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: red;"></button>
            </div>
            <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" id="assignForm" class="assignModal">
                    <label>Department teachers:</label>
                    <select name="departmentTeacher" id="departmentTeacher" required>
                        <option></option>
                        <?php
                        foreach ($teachers as $teacher) {
                        ?>
                            <option value="<?= $teacher->teacher_id ?>|<?= $teacher->teacher_name ?>"><?= $teacher->teacher_name ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <input type="hidden" name="subjectId" id="assignSubjectId">
                    <button class="submitbtn" name="assignTeacherToSubject" onclick="submitAssignForm()">Assign</button>
                </form>
            </div>
        </div>
    </div>
</div>