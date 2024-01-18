<!-- Modal -->
<div class="modal" id="update-teacher" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgba(0, 0, 0, 0);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="color: white;">Update Teacher</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: red;"></button>
            </div>
            <div class="modal-body">
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
            <i class="fa-regular fa-eye" onclick="togglePassword('updateTeacherPassword')"></i>
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
        top: 49%;
        right: 30px;
        transform: translateY(-50%);
        cursor: pointer;
        color: black;
    }
</style>