<!-- Modal -->
<div class="modal" id="update-semester" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgba(0, 0, 0, 0);">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="color: white;">Update Teacher</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: red;"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="updateSemesterForm" class="createModal">
                    <input type="hidden" name="semesterId" id="updateSemesterId">
                    <div class="namedepartment">
                        <div class="name">
                            <label for="updateSemesterName">Semester :</label>
                            <input type="text" name="updateSemesterName" id="updateSemesterName" placeholder="Enter semester" required>
                        </div>
                    </div>
                    <button class="submitbtn" name="updateSemester" onclick="submitUpdateForm()">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>