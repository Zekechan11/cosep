<!-- Modal -->
<div class="modal" id="create-semester" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgba(0, 0, 0, 0);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="color: white;">Add Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: red;"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="semesterForm" class="createModal">
                    <div class="namedepartment">
                        <div class="name">
                            <label for="semesterName">Semester :</label>
                            <input type="text" name="semesterName" id="semesterName" placeholder="Enter semester" required>
                        </div>
                    </div>
                    <button class="submitbtn" name="createSemester" onclick="submitForm()">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>