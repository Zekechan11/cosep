<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="closeupdate" onclick="closeUpdateModal()">&times;</span>
        <h2 id="modalTitle">Update Teacher's Account</h2>
        <form method="POST" enctype="multipart/form-data" id="updateForm" class="updateModal">
            <div class="namedepartment">
                <div class="name">
                    <label for="updateTeacherName">Name:</label>
                    <input type="text" name="updateTeacherName" id="updateTeacherName" placeholder="Enter name" required>
                </div>
                <div class="department">
                    <label for="updateTeacherDepartment">Department:</label>
                    <select name="updateTeacherDepartment" id="updateTeacherDepartment" required>
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
            <label for="updateTeacherEmail">Email:</label>
            <input type="text" name="updateTeacherEmail" id="updateTeacherEmail" placeholder="Enter email" required>
            <label for="updateTeacherPassword">Password:</label>
            <div class="eyebutton"><img src="../images/show.png" alt="" class="icon" id="updateEyeIcon"></div>
            <input type="password" name="updateTeacherPassword" id="updateTeacherPassword" placeholder="Enter password" required>
            <div class="container2">
                <label for="updateProfile" class="custom-file-input">Teacher Profile:</label>
                <div class="profile_img" id="updateProfile" style="background-image: url('<?php echo $uploadedFilePath; ?>');"></div>
                <div class="profile_input">
                    <div class="file-input-container">
                        <input type="file" class="profile" name="updateTeacherProfile" onchange="handleFileSelectUpdate(this)" required>
                        <div class="file-name"></div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="updateTeacherId" id="updateTeacherId">
            <button class="submitbtn" name="updateTeacherAccount" onclick="submitUpdateForm()">Update</button>
        </form>
    </div>
</div>