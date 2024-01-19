<?php
require_once('../functions/formfunctions.php');
usercheck_login();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/teacherdashboardd.css">
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
                <a href="" class="admindashboard_btn">
                    <i class="bx bxs-grid-alt"></i>
                </a>
            </li>
            <li class="dashboard_btn">
                <a href="allstudents.php">
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
    <div class="main-content">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-first" type="button" role="tab" aria-controls="nav-home" aria-selected="true">First Year</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-second" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Second Year</button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-third" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Third Year</button>
            <button class="nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-fourth" type="button" role="tab" aria-controls="nav-disabled" aria-selected="false">Fourth Year</button>
        </div>

        <div class="tab-content" id="nav-tabContent">
            <div class="txtbox1"><?= strtoupper($department->department_name) ?></div>
            <div class="tab-pane fade show active" id="nav-first" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                <section class="tables py-3">
                    <h3 style="color: white;">First year subjects :</h3>
                    <div class="card border-0" style="background-color: rgba(0, 0, 0, 0);">
                        <div class="card-body" style="color:white;">
                            <div class="table-body col-12 text-center">
                                <table id="example" class="display " style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Course Name</th>
                                            <th class="text-center">Subject Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="vertical-align: middle;">
                                        <?php
                                        require_once('../functions/dbconfig.php');

                                        $departmentId = $_SESSION['USER']->department_id;
                                        $teacherId = $_SESSION['USER']->teacher_id;

                                        $newconnection = new Connection();
                                        $connection = $newconnection->openConnection();

                                        // Fetch subjects from the database
                                        $sql = "SELECT * FROM subjects WHERE yearlevel_id = '1' AND department_id = :department_id AND teacher_id = :teacher_id ORDER BY subject_id";
                                        $stmt = $connection->prepare($sql);
                                        $stmt->bindParam(':department_id', $departmentId);
                                        $stmt->bindParam(':teacher_id', $teacherId);
                                        $stmt->execute();

                                        if ($stmt->rowCount() > 0) {
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                $subjectId = $row['subject_id'];
                                        ?>
                                                <tr>
                                                    <td><?= $row['subject_name'] ?></td>
                                                    <td><?= $row['descriptive_title'] ?></td>
                                                    <td>
                                                        <a href="../admin/viewSubject.php?subject_id=<?= $subjectId ?>"><i class="fa-regular fa-eye" style="color: blue;"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <div class="nostudent">No subject available.</div>
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

            <div class="tab-pane fade" id="nav-second" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                <section class="tables py-3">
                    <h3 style="color: white;">Second Year subjects :</h3>
                    <div class="card border-0" style="background-color: rgba(0, 0, 0, 0);">
                        <div class="card-body" style="color:white;">
                            <div class="table-body col-12 text-center">
                                <table id="example" class="display " style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Course Name</th>
                                            <th class="text-center">Subject Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="vertical-align: middle;">
                                        <?php
                                        require_once('../functions/dbconfig.php');

                                        $departmentId = $_SESSION['USER']->department_id;
                                        $teacherId = $_SESSION['USER']->teacher_id;

                                        $newconnection = new Connection();
                                        $connection = $newconnection->openConnection();

                                        // Fetch subjects from the database
                                        $sql = "SELECT * FROM subjects WHERE yearlevel_id = '2' AND department_id = :department_id AND teacher_id = :teacher_id ORDER BY subject_id";
                                        $stmt = $connection->prepare($sql);
                                        $stmt->bindParam(':department_id', $departmentId);
                                        $stmt->bindParam(':teacher_id', $teacherId);
                                        $stmt->execute();

                                        if ($stmt->rowCount() > 0) {
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                $subjectId = $row['subject_id'];
                                        ?>
                                                <tr>
                                                    <td><?= $row['subject_name'] ?></td>
                                                    <td><?= $row['descriptive_title'] ?></td>

                                                    <td>
                                                    <a href="../admin/viewSubject.php?subject_id=<?= $subjectId ?>"><i class="fa-regular fa-eye" style="color: blue;"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <div class="nostudent">No subject available.</div>
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

            <div class="tab-pane fade" id="nav-third" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">

                <section class="tables py-3">
                    <h3 style="color: white;">Third Year subjects :</h3>
                    <div class="card border-0" style="background-color: rgba(0, 0, 0, 0);">
                        <div class="card-body" style="color:white;">
                            <div class="table-body col-12 text-center">
                                <table id="example" class="display " style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Course Name</th>
                                            <th class="text-center">Subject Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="vertical-align: middle;">
                                        <?php
                                        require_once('../functions/dbconfig.php');

                                        $departmentId = $_SESSION['USER']->department_id;
                                        $teacherId = $_SESSION['USER']->teacher_id;

                                        $newconnection = new Connection();
                                        $connection = $newconnection->openConnection();

                                        // Fetch subjects from the database
                                        $sql = "SELECT * FROM subjects WHERE yearlevel_id = '3' AND department_id = :department_id AND teacher_id = :teacher_id ORDER BY subject_id";
                                        $stmt = $connection->prepare($sql);
                                        $stmt->bindParam(':department_id', $departmentId);
                                        $stmt->bindParam(':teacher_id', $teacherId);
                                        $stmt->execute();

                                        if ($stmt->rowCount() > 0) {
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                $subjectId = $row['subject_id'];
                                        ?>
                                                <tr>
                                                    <td><?= $row['subject_name'] ?></td>
                                                    <td><?= $row['descriptive_title'] ?></td>

                                                    <td>
                                                    <a href="../admin/viewSubject.php?subject_id=<?= $subjectId ?>"><i class="fa-regular fa-eye" style="color: blue;"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <div class="nostudent">No subject available.</div>
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
            <div class="tab-pane fade" id="nav-fourth" role="tabpanel" aria-labelledby="nav-disabled-tab" tabindex="0">

                <section class="tables py-3">
                    <h3 style="color: white;">Fourth Year subjects :</h3>
                    <div class="card border-0" style="background-color: rgba(0, 0, 0, 0);">
                        <div class="card-body" style="color:white;">
                            <div class="table-body col-12 text-center">
                                <table id="example" class="display " style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Course Name</th>
                                            <th class="text-center">Subject Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="vertical-align: middle;">
                                        <?php
                                        require_once('../functions/dbconfig.php');

                                        $departmentId = $_SESSION['USER']->department_id;
                                        $teacherId = $_SESSION['USER']->teacher_id;

                                        $newconnection = new Connection();
                                        $connection = $newconnection->openConnection();

                                        // Fetch subjects from the database
                                        $sql = "SELECT * FROM subjects WHERE yearlevel_id = '4' AND department_id = :department_id AND teacher_id = :teacher_id ORDER BY subject_id";
                                        $stmt = $connection->prepare($sql);
                                        $stmt->bindParam(':department_id', $departmentId);
                                        $stmt->bindParam(':teacher_id', $teacherId);
                                        $stmt->execute();

                                        if ($stmt->rowCount() > 0) {
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                $subjectId = $row['subject_id'];
                                        ?>
                                                <tr>
                                                    <td><?= $row['subject_name'] ?></td>
                                                    <td><?= $row['descriptive_title'] ?></td>

                                                    <td>
                                                    <a href="../admin/viewSubject.php?subject_id=<?= $subjectId ?>"><i class="fa-regular fa-eye" style="color: blue;"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <div class="nostudent">No subject available.</div>
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
        </div>
    </div>
    <script src="../js/teacherdashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/7b92f6b770.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        new DataTable('#example', {
            info: false,
            ordering: false,
            paging: false
        });
    </script>

</body>

</html>