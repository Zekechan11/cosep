 <!-- Modal -->
<div class="modal" id="update-subject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgba(0, 0, 0, 0);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="color: white;">Create Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: red;"></button>
            </div>
            <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" id="updateForm" class="updateModal">
                    <label>Subject No:</label>
                    <input type="text" name="subjectName" id="updateSubjectName" placeholder="Enter subject no." required>
                    <label>Descriptive Title:</label>
                    <input type="text" name="descriptiveTitle" id="updateDescriptiveTitle" placeholder="Enter descriptive title" required>
                    <label>Semester:</label>
                    <select name="semester" id="updateSubjectSemester" required>
                        <option></option>
                        <option value="First Semester" <?= $subject->semester === 'First Semester' ? 'selected' : '' ?>>First Semester</option>
                        <option value="Second Semester" <?= $subject->semester === 'Second Semester' ? 'selected' : '' ?>>Second Semester</option>
                    </select>
                    <input type="hidden" name="subjectId" id="updateSubjectId">
                    <button class="submitbtn" name="updateSubject" onclick="submitUpdateForm()">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>