<?php
require_once "../functions/dbconfig.php";
require "../functions/formfunctions.php";
usercheck_login();

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['createCourse'])) {
        $errors = createCourse($_POST);
    } elseif (isset($_POST['updateCourse'])) {
        $errors = updateCourse($_POST);
    }
}


if (isset($_GET['department_id'])) {
    $departmentId = $_GET['department_id'];

    $newconnection = new Connection();
    $connection = $newconnection->openConnection();
    $stmt = $connection->prepare("SELECT * FROM department WHERE department_id = :department_id");
    $stmt->bindParam(':department_id', $departmentId);
    $stmt->execute();
    $department = $stmt->fetch(PDO::FETCH_OBJ);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/viewdepartmentt.css">
    <title>Document</title>
</head>

<body>
    <?php require('../inc/header.php'); ?>
    <div class="content-container">

        <button id="createCourse" onclick="openCreateModal()" class="btn btn-warning" style="float: right;position:relative;top:640px;right:30px;">
            <span class="material-icons">add</span>
        </button>

        <div class="">
            <div class="namebox">
                <div class="txtbox1"><?= strtoupper($department->department_name) ?></div>
            </div>
            <div class="txtbox2">Welcome to the <?= $department->department_acronym ?> department ! <br> Here are some of our available courses.</div>

            <?php
            require_once("../functions/dbconfig.php");
            $newconnection = new Connection();
            $connection = $newconnection->openConnection();

            $sql = "SELECT * FROM course WHERE department_id = $departmentId";
            $result = $connection->query($sql);

            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            ?>
                    <div class="course-card">
                        <div class="course-profile">
                            <img src="<?= $department->department_logo ?>" alt="">
                        </div>
                        <div class="course-info">
                            <div class="course-nametype">
                                <div class="course-name" style="color: white;">
                                    <?= $row->course_acronym ?>
                                </div>
                                <div class="course-type" style="color: white;">
                                    <?= $row->course_name ?>
                                </div>
                            </div>
                        </div>
                        <div class="buttons">
                            <button class="view-course-button" onclick="openCourseModal(<?= $row->course_id ?>)"><i class="fa-brands fa-searchengin" style="font-size: 30px;"></i></button>

                            <button class="update-course-button" id="updateCourseButton" onclick="openUpdateModal(<?= $row->course_id ?>)"><i class="fa-regular fa-pen-to-square" style="font-size: 30px;"></i></button>

                            <a href="../functions/deleteCourse.php?courseId=<?= $row->course_id ?>&departmentId=<?= $row->department_id ?>" onclick="return confirm('Are you sure you want to delete this course?');"><button class="delete-course-button"><i class="fa-solid fa-trash" style="font-size: 30px;"></i></button></a>

                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="nocourse">No courses available.</div>
            <?php
            }
            $newconnection->closeConnection();
            ?>
        </div>
    </div>

    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Create Course</h2>
            <form method="POST" enctype="multipart/form-data" id="courseForm" class="createModal">
                <label for="courseName">Course Name:</label>
                <input type="text" name="courseName" id="courseName" placeholder="Enter course name" required>
                <label for="courseAcronym">Course Acronym:</label>
                <input type="text" name="courseAcronym" id="courseAcronym" placeholder="Enter course acronym" required>
                <input type="hidden" name="courseId" id="courseId">
                <input type="hidden" name="departmentId" id="departmentId" value="<?= $department->department_id ?>">
                <button class="submitbtn" name="createCourse" onclick="submitForm()">Create</button>
            </form>
        </div>
    </div>
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="closeupdate" onclick="closeUpdateModal()">&times;</span>
            <h2 id="updateModalTitle">Update Course</h2>
            <form method="POST" enctype="multipart/form-data" id="updateForm" class="updateModal">
                <label for="updateCourseName">Course Name:</label>
                <input type="text" name="courseName" id="updateCourseName" placeholder="Enter course name" required>
                <label for="updateCourseAcronym">Course Acronym:</label>
                <input type="text" name="courseAcronym" id="updateCourseAcronym" placeholder="Enter course acronym" required>
                <input type="hidden" name="courseId" id="updateCourseId">
                <input type="hidden" name="departmentId" id="departmentId" value="<?= $department->department_id ?>">
                <button class="submitbtn" name="updateCourse" onclick="submitUpdateForm()">Update</button>
            </form>
        </div>
    </div>

    <div id="openCourseModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeCourseModal()">&times;</span>
            <h2 id="modalTitle">Year Levels</h2>

            <div class="year-level-type" id="CourseName"></div>

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
                            <div class="year-level-name">
                                <div class="year-level"><?= $yearLevel->year_level ?></div>
                            </div>
                        </div>
                    </div>
                    <form action="yearLevelpage.php" method="get">
                        <input type="hidden" name="department_id" value="<?= $departmentId ?>">
                        <input type="hidden" name="yearlevel_id" value="<?= $yearLevel->yearlevel_id ?>">
                        <input type="hidden" name="course_id" id="<?= 'CourseId' . $var ?>">
                        <div class="buttons">
                            <button type="submit" class="view-course-button">
                                <img src="../images/search.png" alt="">
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
    <script src="../js/viewdepartment.js"></script>
</body>

</html>
<?php require('../inc/footer.php'); ?>