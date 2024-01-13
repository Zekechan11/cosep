<!-- Modal -->
<div class="modal" id="create-student" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgba(0, 0, 0, 0);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="color: white;">Add Department</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: red;"></button>
            </div>
            <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" id="create-student" class="createModal">
                    <div class="namedepartment">
                        <div class="name">
                            <label for="studentName">Name:</label>
                            <input type="text" name="studentName" id="studentName" placeholder="Enter name" required>
                        </div>
                        <div class="department">
                            <label for="studentDepartment">Department:</label>
                            <select name="studentDepartment" id="studentDepartment" required>
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
                            <label for="studentCourse">Course:</label>
                            <select name="studentCourse" id="studentCourse" required>
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
                            <label for="studentYearlevel">Year Level:</label>
                            <select name="studentYearlevel" id="studentYearlevel" required>
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
                    <label for="studentEmail">Email:</label>
                    <input type="text" name="studentEmail" id="studentEmail" placeholder="Enter email" required>
                    <label for="studentPassword">Password:</label>
                    <div class="eyebutton"><img src="../images/show.png" alt="" class="icon" id="eyeicon"></div>
                    <input type="password" name="studentPassword" id="studentPassword" placeholder="Enter password" required>
                    <div class="modal-footer">
                    <button class="submitbtn px-4" name="createStudentAccount" onclick="submitForm()">Create</button>
                    </form>
            </div>
        </div>
    </div>
</div>