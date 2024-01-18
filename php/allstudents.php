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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/allstudentss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <a href="teacherdashboard.php">
                    <i class="bx bxs-grid-alt"></i>
                </a>
            </li>
            <li class="dashboard_btn">
                <a href="" class="admindashboard_btn">
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
            <?php
            require_once('../functions/dbconfig.php');

            $newconnection = new Connection();
            $connection = $newconnection->openConnection();

            $stmt = $connection->prepare("SELECT * FROM department");
            $stmt->execute();
            $departments = $stmt->fetchAll(PDO::FETCH_OBJ);

            $uearlevelstmt = $connection->prepare("SELECT * FROM yearlevels");
            $uearlevelstmt->execute();
            $yearlevels = $uearlevelstmt->fetchAll(PDO::FETCH_OBJ);
            ?>
            <form action="" method="POST">
                <div class="row g-3" style="position: relative;left:50%;">
                <div class="col-md-4">
                    <label for="department">Department</label>
                    <select name="department" id="department">
                        <option value="All">All</option>
                        <?php
                        foreach ($departments as $department) {
                        ?>
                            <option value="<?= $department->department_id ?>|<?= $department->department_name ?>"><?= $department->department_name ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="yearlevel">Year Level</label>
                    <select name="yearlevel" id="yearlevel">
                        <option value="All">All</option>
                        <?php
                        foreach ($yearlevels as $yearlevel) {
                        ?>
                            <option value="<?= $yearlevel->yearlevel_id ?>|<?= $yearlevel->year_level ?>"><?= $yearlevel->year_level ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                </div>
                <div class="filter">
                    <button type="submit" name="filter"  style="position: relative;bottom:95px;left:30%;" class="filter-button">Filter</button>
                </div>
            </form>
            <div class="card border-0" style="background-color: rgba(0, 0, 0, 0);">
                <div class="card-body" style="color:white;">
                    <div class="table-body col-12 text-center">
                        <table class="table table-striped" style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">Department Logo</th>
                                    <th class="text-center">Student Name</th>
                                    <th class="text-center">Department Name</th>
                                    <th class="text-center">Year Level</th>
                                    <th class="text-center">Course Name</th>
                                </tr>
                            </thead>
                            <tbody style="vertical-align: middle;">
                                <?php
                                require_once('../functions/dbconfig.php');
                                $newconnection = new Connection();
                                $connection = $newconnection->openConnection();

                                if (isset($_POST['filter'])) {
                                    $selectedDepartment = $_POST['department'];
                                    $selectedYearLevel = $_POST['yearlevel'];

                                    $filterCondition = "WHERE usertype != 'Admin'";

                                    if ($selectedDepartment !== "All") {
                                        list($departmentId, $departmentName) = explode("|", $selectedDepartment);
                                        $filterCondition .= " AND department_id = $departmentId";
                                    }

                                    if ($selectedYearLevel !== "All") {
                                        list($yearlevelId, $yearLevel) = explode("|", $selectedYearLevel);
                                        $filterCondition .= " AND year_level = '$yearLevel'";
                                    }

                                    $sql = "SELECT * FROM students $filterCondition ORDER BY student_id";
                                } else {
                                    $sql = "SELECT * FROM students WHERE usertype != 'Admin' ORDER BY student_id";
                                }

                                $result = $connection->query($sql);

                                if ($result->rowCount() > 0) {
                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                                        $department = $row['department_id'];

                                        $stmt = $connection->prepare("SELECT * FROM department WHERE department_id = $department");
                                        $stmt->execute();
                                        $departments = $stmt->fetch(PDO::FETCH_OBJ);

                                ?>
                                        <tr>
                                            <td><img src="<?= $departments->department_logo ?>" alt="" style="border-radius:50%;hieght:50px;width:50px;"></td>
                                            <td> <?= $row['student_name'] ?></td>
                                            <td> <?= $row['department_name'] ?></td>
                                            <td><?= $row['year_level'] ?> </td>
                                            <td> <?= $row['course_name'] ?></td>

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

    <script src="../js/teacherdashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script></script>
</body>

</html>