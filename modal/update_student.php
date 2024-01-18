<!-- Modal -->
<div class="modal" id="update-student" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgba(0, 0, 0, 0);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="color: white;">Update Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: red;"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="updateForm" class="updateModal">
                    <div class="namedepartment">
                        <div class="name">
                            <label for="updateStudentName">Name:</label>
                            <input type="text" name="updateStudentName" id="updateStudentName" placeholder="Enter name" required>
                        </div>
                        <div class="department">
                            <label for="updateStudentDepartment">Department:</label>
                            <select name="updateStudentDepartment" id="updateStudentDepartment" required>
                                <option></option>
                                <?php
                                foreach ($departments as $department) {
                                ?>
                                    <option value="<?= $department->department_id ?>|<?= $department->department_name ?>"><?= $department->department_name ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="namedepartment">
                        <div class="name">
                            <label for="updateStudentCourse">Course:</label>
                            <select name="updateStudentCourse" id="updateStudentCourse" required>
                                <option></option>
                                <?php
                                foreach ($courses as $course) {
                                ?>
                                    <option value="<?= $course->course_id ?>|<?= $course->course_name ?>"><?= $course->course_name ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="department">
                            <label for="updateStudentYearlevel">Year Level:</label>
                            <select name="updateStudentYearlevel" id="updateStudentYearlevel" required>
                                <option></option>
                                <?php
                                foreach ($yearlevels as $yearlevel) {
                                ?>
                                    <option value="<?= $yearlevel->yearlevel_id ?>|<?= $yearlevel->year_level ?>"><?= $yearlevel->year_level ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <label for="updateStudentEmail">Email:</label>
                    <input type="text" name="updateStudentEmail" id="updateStudentEmail" placeholder="Enter email" required>
                    <label for="updateStudentPassword">Password:</label>
                    <i class="fa-regular fa-eye eyes" onclick="togglePassword('updateStudentPassword')"></i>
                    <input type="password" name="updateStudentPassword" id="updateStudentPassword" placeholder="Enter password" required>
                    <input type="hidden" name="updateStudentId" id="updateStudentId">
                    <div class="modal-footer">
                    <button class="submitbtn float-end" name="updateStudentAccount" onclick="submitUpdateForm()">Update</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId) {
        const passwordInput = document.getElementById(inputId);
        passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
    }
</script>

<style>

    .fa-regular.fa-eye {
        position: absolute;
        top: 10px;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
    }
</style>