<div id="myModal" class="modal">
    <div class="modal-content" style="background-color: rgba(0, 0, 30, 20);">
        <div class="modal-header">
            <h2 id="modalTitle" style="color: white;"><?= $subject->subject_name ?> | <?= $subject->descriptive_title ?></h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: red;" onclick="closeModal()"></button>
        </div>
        <label id="studentName"></label>
        <form method="POST" enctype="multipart/form-data" id="semesterForm" class="createModal text-white">
            <div class="namedepartment">
                <div class="name">
                    <label>Prelim :</label>
                    <input type="text" name="prelimScore" id="prelimScore" placeholder="Enter prelim score (100 maximum)">
                </div>
                <div class="department">
                    <label>Midterm :</label>
                    <input type="text" name="midtermScore" id="midtermScore" placeholder="Enter midterm score (100 maximum)">
                </div>
            </div>
            <div class="namedepartment">
                <div class="name">
                    <label>Semi-Final :</label>
                    <input type="text" name="semifinalScore" id="semifinalScore" placeholder="Enter semifinal score (100 maximum)">
                </div>
                <div class="department">
                    <label>Final :</label>
                    <input type="text" name="finalScore" id="finalScore" placeholder="Enter final score (100 maximum)">
                </div>
            </div>
            <br>
            <h1>FINAL GRADE :</h1>
            <h2 id="finalGrade" name="finalGrade"></h2>
            <p id="remarks"></p>
            <input type="hidden" name="studentId" id="studentId">
            <input type="hidden" name="subjectId" id="subjectId">
            <input type="hidden" name="teacherId" id="teacherId">
            <input type="hidden" name="semesterName" value="<?= $subject->semester ?>">
            <button class="submitbtn" name="addGrade" onclick="submitForm()">Done</button>
        </form>
    </div>
</div>