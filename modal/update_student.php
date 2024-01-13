<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="closeupdate" onclick="closeUpdateModal()">&times;</span>
        <h2 id="modalTitle">Update Student's Account</h2>
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
            <div class="eyebutton"><img src="../images/show.png" alt="" class="icon" id="updateEyeIcon"></div>
            <input type="password" name="updateStudentPassword" id="updateStudentPassword" placeholder="Enter password" required>
            <input type="hidden" name="updateStudentId" id="updateStudentId">
            <button class="submitbtn" name="updateStudentAccount" onclick="submitUpdateForm()">Update</button>
        </form>
    </div>
</div>
