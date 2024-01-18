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

        <div class="namebox">
            <div class="txtbox1"><?= strtoupper($department->department_name) ?></div>
        </div>

        <section class="tables py-3">
            <div class="card border-0" style="background-color: rgba(0, 0, 0, 0);">
                <div class="card-header shadow-sm">
                    <button type="button" class="btn btn-warning" style="float: right;" data-bs-toggle="modal" data-bs-target="#create-year">
                        <span class="material-icons">add</span>
                    </button>
                </div>
                <div class="card-body" style="color:white;">
                    <div class="table-body col-12 text-center">
                        <table id="example1" class="display " style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">Course Profile</th>
                                    <th class="text-center">Course Name</th>
                                    <th class="text-center">Course Type</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody style="vertical-align: middle;">
                                <?php
                                require_once("../functions/dbconfig.php");
                                $newconnection = new Connection();
                                $connection = $newconnection->openConnection();

                                $sql = "SELECT * FROM course WHERE department_id = $departmentId";
                                $result = $connection->query($sql);

                                if ($result->rowCount() > 0) {
                                    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                                ?>
                                        <tr>
                                            <td><img src="<?= $department->department_logo ?>" alt="Course Profile" style="border-radius:50%;hieght:50px;width:50px;"></td>
                                            <td> <?= $row->course_acronym ?></td>
                                            <td> <?= $row->course_name ?></td>

                                            <td>

                                                <i class="fa-regular fa-eye" style="color: blue;" data-bs-toggle="modal" data-bs-target="#view-level" onclick="openCourseModal(<?= $row->course_id ?>)"></i> |
                                                <i class="fa-solid fa-pen-to-square" style="color: green;" data-bs-toggle="modal" data-bs-target="#update-course" onclick="openUpdateModal(<?= $row->course_id ?>)"></i> |
                                                <a href="../functions/deleteCourse.php?courseId=<?= $row->course_id ?>&departmentId=<?= $row->department_id ?>" onclick="return confirm('Are you sure you want to delete this course?');"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <div class="nocourse">No courses available.</div>
                                <?php
                                }
                                $newconnection->closeConnection();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="../js/viewdepartment.js"></script>
    <?php require_once('../modal/create_course.php'); ?>
    <?php require_once('../modal/update_course.php'); ?>
    <?php require_once('../modal/year_level.php'); ?>
</body>

</html>
<?php require('../inc/footer.php'); ?>