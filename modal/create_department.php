<!-- Modal -->
<div class="modal" id="create-department" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgba(0, 0, 0, 0);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="color: white;">Add Department</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: red;"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="departmentForm" class="createModal">
                    <!-- Department Name input -->
                    <label for="departmentName">Department Name:</label>
                    <input type="text" name="departmentName" id="departmentName" placeholder="Enter department name" required>

                    <label for="departmentAcronym">Department Acronym:</label>
                    <input type="text" name="departmentAcronym" id="departmentAcronym" placeholder="Enter department acronym" required>
                    <!-- Department Logo input -->
                    <div class="container2">
                        <label for="logo" class="custom-file-input">Departent Logo:</label>
                        <div class="profile_img" style="background-image: url('<?php echo $uploadedFilePath; ?>');"></div>
                        <div class="profile_input">
                            <div class="file-input-container">
                                <input type="file" class="logo" id="logo" name="departmentLogo" onchange="handleFileSelect(this)" required>
                                <div class="file-name"></div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="departmentId" id="departmentId">
                    <button class="submitbtn" name="createDepartment">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>