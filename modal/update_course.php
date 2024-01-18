
<div class="modal" id="update-course" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgba(0, 0, 0, 0);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="color: white;">Update Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: red;"></button>
            </div>
            <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" id="updateForm" class="updateModal">
                    <label for="updateCourseName">Course Name:</label>
                    <input type="text" name="courseName" id="updateCourseName" placeholder="Enter course name" required>
                    <label for="updateCourseAcronym">Course Acronym:</label>
                    <input type="text" name="courseAcronym" id="updateCourseAcronym" placeholder="Enter course acronym" required>
                    <input type="hidden" name="courseId" id="updateCourseId">
                    <input type="hidden" name="departmentId" id="departmentId" value="<?= $department->department_id ?>">
                    <button class="submitbtn" name="updateCourse" onclick="submitUpdateForm()">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>