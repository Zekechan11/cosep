<div id="updateModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="closeupdate" onclick="closeUpdateModal()">&times;</span>
        <h2 id="updateModalTitle">Update Department</h2>
        <form method="POST" enctype="multipart/form-data" id="updateForm" class="updateModal">
            <!-- Department Name input -->
            <label for="updateDepartmentName">Department Name:</label>
            <input type="text" name="departmentName" id="updateDepartmentName" placeholder="Enter department name" required>

            <label for="updateDepartmentAcronym">Department Acronym:</label>
            <input type="text" name="departmentAcronym" id="updateDepartmentAcronym" placeholder="Enter department acronym" required>
            <!-- Department Logo input -->
            <div class="container2">
                <label for="logo" class="custom-file-input">Department Logo:</label>
                <div class="profile_img2" id="updateLogo2" style="background-image: url('<?php echo $uploadedFilePath; ?>');"></div>
                <div class="profile_input">
                    <div class="file-input-container">
                        <input type="file" class="logo" id="updateLogo" name="departmentLogo" onchange="handleFileSelect2(this)" required>
                        <div class="file-name" id="updateFileName"></div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="departmentId" id="updateDepartmentId">
            <button class="submitbtn" name="updateDepartment" onclick="submitUpdateForm()">Update</button>
        </form>
    </div>
</div>