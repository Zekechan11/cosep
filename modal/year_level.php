<!-- Modal -->
<div class="modal" id="view-level" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgba(0, 0, 30, 20);">
            <div class="modal-header">
            <h2 id="modalTitle" style="color: white;">Year Levels</h2>
            <div class="year-level-type" id="CourseName" style="position: relative;top:30px;right:180px;color:white;"></div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: red;"></button>
            </div>
            <div class="modal-body">
            <span class="close" onclick="closeCourseModal()">&times;</span>

            <?php
            $newconnection = new Connection();
            $connection = $newconnection->openConnection();

            $stmt = $connection->prepare("SELECT * FROM yearlevels");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);

            // Define arrays
            $var = 1;
            foreach ($results as $yearLevel) {
                // Loop through indices
            ?>
                <div class="year-level-card">
                    <div class="year-level-profile">
                        <img src="<?= $department->department_logo ?>" alt="">
                    </div>
                    <div class="year-level-info">
                        <div class="year-level-nametype">
                            <div class="year-level-name" > 
                                <div class="year-level" style="color: white;"><?= $yearLevel->year_level ?></div>
                            </div>
                        </div>
                    </div>
                    <form action="yearLevelpage.php" method="get">
                        <input type="hidden" name="department_id" value="<?= $departmentId ?>">
                        <input type="hidden" name="yearlevel_id" value="<?= $yearLevel->yearlevel_id ?>">
                        <input type="hidden" name="course_id" id="<?= 'CourseId' . $var ?>">
                        <div class="buttons">
                            <button type="submit" class="view-course-button">
                            <i class="fa-solid fa-eye" style="color: blue;"></i>
                            </button>
                        </div>
                    </form>
                </div>
            <?php
                $var++;
            }
            ?>
            </div>
        </div>
    </div>
</div>