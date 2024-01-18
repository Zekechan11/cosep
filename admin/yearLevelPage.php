<?php
require_once "../functions/dbconfig.php";
require "../functions/formfunctions.php";
usercheck_login();

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['createSubject'])) {
        $errors = createSubject($_POST);
    } elseif (isset($_POST['updateSubject'])) {
        $errors = updateSubject($_POST);
    } elseif (isset($_POST['assignTeacherToSubject'])) {
        $errors = assignTeacherToSubject($_POST);
    }
}

if (isset($_GET['department_id']) && isset($_GET['course_id']) && isset($_GET['yearlevel_id'])) {
    $departmentId = $_GET['department_id'];
    $courseId = $_GET['course_id'];
    $yearlevelId = $_GET['yearlevel_id'];

    $newconnection = new Connection();
    $connection = $newconnection->openConnection();

    $stmt = $connection->prepare("SELECT * FROM course WHERE department_id = :department_id AND course_id = :course_id");
    $stmt->bindParam(':department_id', $departmentId);
    $stmt->bindParam(':course_id', $courseId);
    $stmt->execute();
    $course = $stmt->fetch(PDO::FETCH_OBJ);

    $stmtDepartment = $connection->prepare("SELECT * FROM department WHERE department_id = :department_id");
    $stmtDepartment->bindParam(':department_id', $departmentId);
    $stmtDepartment->execute();
    $department = $stmtDepartment->fetch(PDO::FETCH_OBJ);

    $stmtyearlevel = $connection->prepare("SELECT * FROM yearlevels WHERE yearlevel_id = :yearlevel_id");
    $stmtyearlevel->bindParam(':yearlevel_id', $yearlevelId);
    $stmtyearlevel->execute();
    $yearlevel = $stmtyearlevel->fetch(PDO::FETCH_OBJ);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/yearLevelPagee.css">
    <title>Document</title>
</head>

<body>
    <?php require('../inc/header.php'); ?>
    <div class="content-container">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-first" type="button" role="tab" aria-controls="nav-home" aria-selected="true">First Semester</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-second" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Second Semester</button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-third" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Summer</button>
        </div>

        <div class="maincontainer">
            <div class="txtbox1" style="color: white;"><?= strtoupper($department->department_name) ?></div>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-first" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">

                    <?php
                    $newconnection = new Connection();
                    $connection = $newconnection->openConnection();

                    // Fetch subjects for the first semester only
                    $stmt = $connection->prepare("SELECT * FROM subjects WHERE department_id = :department_id AND course_id = :course_id AND yearlevel_id = :yearlevel_id AND semester_id = 1");
                    $stmt->bindParam(':department_id', $departmentId);
                    $stmt->bindParam(':course_id', $courseId);
                    $stmt->bindParam(':yearlevel_id', $yearlevelId);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

                    if (empty($result)) {
                        // Handle case where no subjects are found
                        echo "<div class='nosubject'>No subject found.</div>";
                    } else {
                    ?>
                        <section class="tables py-3">
                            <div class="card border-0" style="background-color: rgba(0, 0, 0, 0);">
                                <div class="card-header shadow-sm">
                                    <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#create-subject">
                                        <i class="fa fa-plus"></i> Add Subject</button>
                                    <center>
                                        <p style="color: white;">First Semester</p>
                                    </center>
                                </div>
                                <div class="card-body" style="color:white;">
                                    <div class="table-body col-12 text-center">
                                        <table id="example1" class="display " style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Subject No.</th>
                                                    <th class="text-center">Descriptive Title</th>
                                                    <th class="text-center">Instructor</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($result as $subject) : ?>
                                                    <tr>
                                                        <td><?= $subject->subject_name ?></td>
                                                        <td><?= $subject->descriptive_title ?></td>
                                                        <td><?= $subject->teacher_name ?></td>
                                                        <td>
                                                            <i class="fa-solid fa-user-plus" style="color: blue;" id="assignTeacherButton" data-bs-toggle="modal" data-bs-target="#assign-teacher" onclick="openAssignModal(<?= $subject->subject_id ?>)"></i> |
                                                            <i class="fa-solid fa-pen-to-square" style="color: green;" id="updateSubjectButton" data-bs-toggle="modal" data-bs-target="#update-subject" onclick="openUpdateModal(<?= $subject->subject_id ?>)"></i> |
                                                            <a href="deleteSubject.php?
                                                                    subjectId=<?= $subject->subject_id ?>
                                                                    &departmentId=<?= $subject->department_id ?>
                                                                    &courseId=<?= $subject->course_id ?>
                                                                    &yearlevelId=<?= $subject->yearlevel_id ?>" onclick="return confirm('Are you sure you want to delete this subject?');">
                                                                <i class="fa-solid fa-trash" style="color: red;"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php
                    }
                    ?>
                </div>
                <div class="tab-pane fade" id="nav-second" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    <?php
                    // Fetch subjects for the second semester only
                    $stmt = $connection->prepare("SELECT * FROM subjects WHERE department_id = :department_id AND course_id = :course_id AND yearlevel_id = :yearlevel_id AND semester_id = 2");
                    $stmt->bindParam(':department_id', $departmentId);
                    $stmt->bindParam(':course_id', $courseId);
                    $stmt->bindParam(':yearlevel_id', $yearlevelId);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

                    if (empty($result)) {
                        // Handle case where no subjects are found
                        echo "<div class='nosubject'>No subject found.</div>";
                    } else {
                    ?>
                        <section class="tables py-3">
                            <div class="card border-0" style="background-color: rgba(0, 0, 0, 0);">
                                <div class="card-header shadow-sm">
                                    <center>
                                        <p style="color: white;">Second Semester</p>
                                    </center>
                                </div>
                                <div class="card-body" style="color:white;">
                                    <div class="table-body col-12 text-center">
                                        <table id="example2" class="display " style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Subject No.</th>
                                                    <th class="text-center">Descriptive Title</th>
                                                    <th class="text-center">Instructor</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($result as $subject) : ?>
                                                    <tr>
                                                        <td><?= $subject->subject_name ?></td>
                                                        <td><?= $subject->descriptive_title ?></td>
                                                        <td><?= $subject->teacher_name ?></td>
                                                        <td>
                                                        <i class="fa-solid fa-user-plus" style="color: blue;" id="assignTeacherButton" data-bs-toggle="modal" data-bs-target="#assign-teacher" onclick="openAssignModal(<?= $subject->subject_id ?>)"></i> |
                                                            <i class="fa-solid fa-pen-to-square" style="color: green;" id="updateSubjectButton" data-bs-toggle="modal" data-bs-target="#update-subject" onclick="openUpdateModal(<?= $subject->subject_id ?>)"></i> |
                                                            <a href="deleteSubject.php?
                                                                    subjectId=<?= $subject->subject_id ?>
                                                                    &departmentId=<?= $subject->department_id ?>
                                                                    &courseId=<?= $subject->course_id ?>
                                                                    &yearlevelId=<?= $subject->yearlevel_id ?>" onclick="return confirm('Are you sure you want to delete this subject?');">
                                                                <i class="fa-solid fa-trash" style="color: red;"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php
                    }
                    ?>
                </div>
                <div class="tab-pane fade" id="nav-third" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                    <?php
                    // Fetch subjects for the Summer semester only
                    $stmt = $connection->prepare("SELECT * FROM subjects WHERE department_id = :department_id AND course_id = :course_id AND yearlevel_id = :yearlevel_id AND semester_id = 5");
                    $stmt->bindParam(':department_id', $departmentId);
                    $stmt->bindParam(':course_id', $courseId);
                    $stmt->bindParam(':yearlevel_id', $yearlevelId);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

                    if (empty($result)) {
                        // Handle case where no subjects are found
                        echo "<div class='nosubject'>No subject found.</div>";
                    } else {
                    ?>
                        <section class="tables py-3">
                            <div class="card border-0" style="background-color: rgba(0, 0, 0, 0);">
                                <div class="card-header shadow-sm">
                                <center><p style="color: white;">Summer</p></center>
                                </div>
                                <div class="card-body" style="color:white;">
                                    <div class="table-body col-12 text-center">
                                        <table id="example3" class="display" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Subject No.</th>
                                                    <th class="text-center">Descriptive Title</th>
                                                    <th class="text-center">Instructor</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($result as $subject) : ?>
                                                    <tr>
                                                        <td><?= $subject->subject_name ?></td>
                                                        <td><?= $subject->descriptive_title ?></td>
                                                        <td><?= $subject->teacher_name ?></td>
                                                        <td>
                                                        <i class="fa-solid fa-user-plus" style="color: blue;" id="assignTeacherButton" data-bs-toggle="modal" data-bs-target="#assign-teacher" onclick="openAssignModal(<?= $subject->subject_id ?>)"></i> |
                                                            <i class="fa-solid fa-pen-to-square" style="color: green;" id="updateSubjectButton" data-bs-toggle="modal" data-bs-target="#update-subject" onclick="openUpdateModal(<?= $subject->subject_id ?>)"></i> |
                                                            <a href="deleteSubject.php?
                                                                    subjectId=<?= $subject->subject_id ?>
                                                                    &departmentId=<?= $subject->department_id ?>
                                                                    &courseId=<?= $subject->course_id ?>
                                                                    &yearlevelId=<?= $subject->yearlevel_id ?>" onclick="return confirm('Are you sure you want to delete this subject?');">
                                                                <i class="fa-solid fa-trash" style="color: red;"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <div <?php
                require_once('../functions/dbconfig.php');

                $newconnection = new Connection();
                $connection = $newconnection->openConnection();

                $stmt = $connection->prepare("SELECT * FROM semester");
                $stmt->execute();
                $semesters = $stmt->fetchAll(PDO::FETCH_OBJ);
                ?> <div id="myModal" class="modal">

        </div>

        <?php
        require_once('../functions/dbconfig.php');

        $newconnection = new Connection();
        $connection = $newconnection->openConnection();

        $stmt = $connection->prepare("SELECT * FROM teachers WHERE department_id = :department_id");
        $stmt->bindParam(':department_id', $departmentId);
        $stmt->execute();
        $teachers = $stmt->fetchAll(PDO::FETCH_OBJ);
        ?>

    </div>
    <?php require_once('../modal/create_subject.php'); ?>
    <?php require_once('../modal/assign_teacher.php'); ?>
    <?php require_once('../modal/update_subject.php'); ?>

    <script src="../js/yearLevelPage.js"></script>

    <script>
        document.getElementById("defaultOpen").click();

        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;

            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
</body>

</html>

<?php require_once('../inc/footer.php'); ?>