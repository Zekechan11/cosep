<?php
require_once('../functions/formfunctions.php');
usercheck_login();

require_once('../functions/dbconfig.php');


$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['addGrade'])) {
        $errors = addGrade($_POST);
    }
}

if (isset($_GET['subject_id'])) {
    $subjectId = $_GET['subject_id'];

    $newconnection = new Connection();
    $connection = $newconnection->openConnection();
    $stmt = $connection->prepare("SELECT * FROM subjects WHERE subject_id = :subject_id");
    $stmt->bindParam(':subject_id', $subjectId);
    $stmt->execute();
    $subject = $stmt->fetch(PDO::FETCH_OBJ);

    $subjectLevelId = $subject->yearlevel_id;
    $subjectCourseId = $subject->course_id;
    $subjectId = $subject->subject_id;
}


$teacherId = $_SESSION['USER']->teacher_id;

?>

<?php
require_once('../functions/dbconfig.php');

$departmentId = $_SESSION['USER']->department_id;

$newconnection = new Connection();
$connection = $newconnection->openConnection();

$stmt = $connection->prepare("SELECT * FROM department WHERE department_id = :department_id");
$stmt->bindParam(':department_id', $departmentId);
$stmt->execute();

$department = $stmt->fetch(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="../css/viewSubjectt.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <title>Document</title>
</head>

<body>
    <div class="sidebar">
        <div class="top">
            <div class="logo">
                <img src="../images/crmclogo.png" alt="">
                <span>CRMC SCHOOL SYSTEM</span>
            </div>
            <i class="bx bx-menu" id="sidebarbtn"></i>
        </div>
        <div class="user">
            <img src="<?= $_SESSION['USER']->teacher_profile ?>" alt="">
            <div>
                <p class="name"><?= $_SESSION['USER']->teacher_name ?></p>
                <p class="rank">Teacher</p>
            </div>
        </div>
        <ul>
            <li class="dashboard_btn">
                <a href="../php/teacherdashboard.php">
                    <i class="bx bxs-grid-alt"></i>
                </a>
            </li>
            <li class="dashboard_btn">
                <a href="../php/studentdashboard.php">
                    <i class="bx bxs-user"></i>
                </a>
            </li>
            <li class="logout_btn">
                <a href="logout.php" onclick="return confirm('Log out account?');">
                    <i class="bx bx-log-out"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <section class="tables py-3">
            <div class="txtbox1" style="color: white;"><?= strtoupper($department->department_name) ?></div>
            <div class="card border-0" style="background-color: rgba(0, 0, 0, 0);">
                <div class="card-body" style="color:white;">
                    <div class="table-body col-12 text-center">
                        <table id="example1" class="display " style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">Course Profile</th>
                                    <th class="text-center">Student Name</th>
                                    <th class="text-center">Course Type</th>
                                    <th class="text-center">Year Level</th>
                                    <th class="text-center">Course Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody style="vertical-align: middle;">
                                <?php
                                require_once('../functions/dbconfig.php');

                                $departmentId = $_SESSION['USER']->department_id;

                                $newconnection = new Connection();
                                $connection = $newconnection->openConnection();

                                $sql = "SELECT * FROM students WHERE yearlevel_id = :yearlevel_id AND department_id = :department_id AND course_id = :course_id ORDER BY department_id";
                                $stmt = $connection->prepare($sql);
                                $stmt->bindParam(':department_id', $departmentId);
                                $stmt->bindParam(':yearlevel_id', $subjectLevelId);
                                $stmt->bindParam(':course_id', $subjectCourseId);
                                $stmt->execute();

                                if ($stmt->rowCount() > 0) {
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                        $department = $row['department_id'];

                                        $stmtdepartment = $connection->prepare("SELECT * FROM department WHERE department_id = $department");
                                        $stmtdepartment->execute();
                                        $departments = $stmtdepartment->fetch(PDO::FETCH_OBJ);

                                ?>
                                        <tr>
                                            <td><img src="<?= $departments->department_logo ?>" alt="" style="border-radius:50%;hieght:50px;width:50px;"></td>
                                            <td><?= $row['student_name'] ?></td>
                                            <td><?= $row['department_name'] ?></td>
                                            <td><?= $row['year_level'] ?></td>
                                            <td><?= $row['course_name'] ?></td>

                                            <td>
                                                <i class="fa-solid fa-eye" style="color: blue;" data-bs-toggle="modal" data-bs-target="#create-grade" onclick="openCreateModal(<?= $row['student_id'] ?>, <?= $subjectId ?>, <?= $teacherId ?>)"></i> |
                                                <i class="fa-solid fa-print" style="color: blue;" id="printButton" onclick="updateStatus(<?= $row['student_id'] ?>, <?= $subjectId ?>)"></i>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <div class="nostudent">No student available.</div>
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
    

    <?php
    require_once('../functions/dbconfig.php');

    $newconnection = new Connection();
    $connection = $newconnection->openConnection();

    $stmt = $connection->prepare("SELECT * FROM department WHERE department_id = :department_id");
    $stmt->bindParam(':department_id', $departmentId);
    $stmt->execute();

    $department = $stmt->fetch(PDO::FETCH_OBJ);
    ?>
    
    <?php require_once('../modal/test.php'); ?>
    <script src="../js/viewSubject.js"></script>
    <script src="https://kit.fontawesome.com/7b92f6b770.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        new DataTable('#example1', {
            info: false,
            ordering: false,
            paging: false
        });
    </script>

</body>

</html>
