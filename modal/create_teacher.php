<!-- Modal -->
<div class="modal" id="create-teacher" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgba(0, 0, 0, 0);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="color: white;">Add Teacher</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: red;"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="teacherForm" class="createModal">
                    <div class="namedepartment">
                        <div class="name">
                            <label for="teacherName">Name:</label>
                            <input type="text" name="teacherName" id="teacherName" placeholder="Enter name" required>
                        </div>
                        <div class="department">
                            <label for="teacherDepartment">Department:</label>
                            <select name="teacherDepartment" id="teacherDepartment" required>
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
                    <label for="teacherEmail">Email:</label>
                    <input type="text" name="teacherEmail" id="teacherEmail" placeholder="Enter email" required>
                    <label for="teacherPassword">Password:</label>
                    <i class="fa-regular fa-eye eyes" onclick="togglePassword('teacherPassword')"></i>
                    <input type="password" name="teacherPassword" id="teacherPassword" placeholder="Enter password" required>
                    <div class="container2">
                        <label for="profile" class="custom-file-input">Teacher Profile:</label>
                        <div class="profile_img" style="background-image: url('<?php echo $uploadedFilePath; ?>');"></div>
                        <div class="profile_input">
                            <div class="file-input-container">
                                <input type="file" class="profile" id="profile" name="teacherProfile" onchange="handleFileSelect(this)" required>
                                <div class="file-name"></div>
                            </div>
                        </div>
                    </div>
                    <button class="submitbtn" name="createTeacherAccount" onclick="submitForm()">Create</button>
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