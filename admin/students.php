<?php
require_once "../functions/dbconfig.php";
require "../functions/formfunctions.php";
usercheck_login();

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['createStudentAccount'])) {
        $errors = createStudentAccount($_POST);
    } elseif (isset($_POST['updateStudentAccount'])) {
        $errors = updateStudentAccount($_POST);
    }
}

?>
<?php require('../inc/header.php'); ?>
<div class="content-container">

    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-first" type="button" role="tab" aria-controls="nav-home" aria-selected="true">First Year</button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-second" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Second Year</button>
        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-third" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Third Year</button>
        <button class="nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-fourth" type="button" role="tab" aria-controls="nav-disabled" aria-selected="false">Fourth Year</button>
    </div>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-first" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">

            <div class="studenttxt"></div>
            <section class="tables py-3">
            <div class="card border-0" style="background-color: rgba(0, 0, 0, 0);">
                    <div class="card-header shadow-sm">
                        <button type="button" class="btn btn-warning" style="float: right;" data-bs-toggle="modal" data-bs-target="#create-student">
                            <i class="fa fa-plus"></i> Add Students</button>
                            <h3 style="color:white;">First Year : </h3>
                    </div>
                    <div class="card-body" style="color:white;">
                        <div class="table-body col-12 text-center">
                            <table id="example1" class="display " style="width:100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">Department Logo</th>
                                        <th class="text-center">Student Name</th>
                                        <th class="text-center">Department Name</th>
                                        <th class="text-center">Year</th>
                                        <th class="text-center">Course</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="vertical-align: middle;">
                                    <?php
                                    require_once("../functions/dbconfig.php");
                                    $newconnection = new Connection();
                                    $connection = $newconnection->openConnection();

                                    $sql = "SELECT * FROM students WHERE year_level = '1st Year' ORDER BY department_id";
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
                                                <td><?= $row['student_name'] ?></td>
                                                <td><?= $row['department_name'] ?></td>
                                                <td><?= $row['year_level'] ?></td>
                                                <td><?= $row['course_name'] ?></td>
                                                <td>
                                                    <i class="fa-solid fa-edit" type="button" style="color: green" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="openUpdateModal(<?= $row['student_id'] ?>)"></i> |
                                                    <a href="../functions/deleteStudent.php?studentId=<?= $row['student_id'] ?>" onclick="return confirm('Are you sure you want to delete this student?');"> <i class="fa fa-trash _delete_cat" type="button" style="color:red"></i></a>
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
        <div class="tab-pane fade" id="nav-second" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">

            <div class="studenttxt"></div>
            <section class="tables py-3">
            <div class="card border-0" style="background-color: rgba(0, 0, 0, 0);">
                    <div class="card-header shadow-sm">
                        <button type="button" class="btn btn-warning" style="float: right;" data-bs-toggle="modal" data-bs-target="#create-student">
                            <i class="fa fa-plus"></i> Add Students</button>
                            <h3 style="color:white;">Second Year : </h3>
                    </div>
                    <div class="card-body" style="color:white;">
                        <div class="table-body col-12 text-center">
                            <table id="example2" class="display " style="width:100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">Department Logo</th>
                                        <th class="text-center">Student Name</th>
                                        <th class="text-center">Department Name</th>
                                        <th class="text-center">Year</th>
                                        <th class="text-center">Course</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="vertical-align: middle;">
                                    <?php
                                    require_once("../functions/dbconfig.php");
                                    $newconnection = new Connection();
                                    $connection = $newconnection->openConnection();

                                    $sql = "SELECT * FROM students WHERE year_level = '2nd Year' ORDER BY department_id";
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
                                                <td><?= $row['student_name'] ?></td>
                                                <td><?= $row['department_name'] ?></td>
                                                <td><?= $row['year_level'] ?></td>
                                                <td><?= $row['course_name'] ?></td>
                                                <td>
                                                <i class="fa-solid fa-edit" type="button" style="color: green" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="openUpdateModal(<?= $row['student_id'] ?>)"></i> |
                                                    <a href="../functions/deleteStudent.php?studentId=<?= $row['student_id'] ?>" onclick="return confirm('Are you sure you want to delete this student?');"> <i class="fa fa-trash _delete_cat" type="button" style="color:red"></i></a>
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
        <div class="tab-pane fade" id="nav-third" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">

            <div class="studenttxt"></div>
            <section class="tables py-3">
            <div class="card border-0" style="background-color: rgba(0, 0, 0, 0);">
                    <div class="card-header shadow-sm">
                        <button type="button" class="btn btn-warning" style="float: right;" data-bs-toggle="modal" data-bs-target="#create-student">
                            <i class="fa fa-plus"></i> Add Students</button>
                            <h3 style="color:white;">Third Year : </h3>
                    </div>
                    <div class="card-body" style="color:white;">
                        <div class="table-body col-12 text-center">
                            <table id="example3" class="display " style="width:100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">Department Logo</th>
                                        <th class="text-center">Student Name</th>
                                        <th class="text-center">Department Name</th>
                                        <th class="text-center">Year</th>
                                        <th class="text-center">Course</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="vertical-align: middle;">
                                    <?php
                                    require_once("../functions/dbconfig.php");
                                    $newconnection = new Connection();
                                    $connection = $newconnection->openConnection();
                        
                                    $sql = "SELECT * FROM students WHERE year_level = '3rd Year' ORDER BY department_id";
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
                                                <td><?= $row['student_name'] ?></td>
                                                <td><?= $row['department_name'] ?></td>
                                                <td><?= $row['year_level'] ?></td>
                                                <td><?= $row['course_name'] ?></td>
                                                <td>
                                                <i class="fa-solid fa-edit" type="button" style="color: green" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="openUpdateModal(<?= $row['student_id'] ?>)"></i> |
                                                    <a href="../functions/deleteStudent.php?studentId=<?= $row['student_id'] ?>" onclick="return confirm('Are you sure you want to delete this student?');"> <i class="fa fa-trash _delete_cat" type="button" style="color:red"></i></a>
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
        <div class="tab-pane fade" id="nav-fourth" role="tabpanel" aria-labelledby="nav-disabled-tab" tabindex="0">

            <div class="studenttxt"></div>
            <section class="tables py-3">
            <div class="card border-0" style="background-color: rgba(0, 0, 0, 0);">
                    <div class="card-header shadow-sm">
                        <button type="button" class="btn btn-warning" style="float: right;" data-bs-toggle="modal" data-bs-target="#create-student">
                            <i class="fa fa-plus"></i> Add Students</button>
                            <h3 style="color:white;">Fourth Year : </h3>
                    </div>
                    <div class="card-body" style="color:white;">
                        <div class="table-body col-12 text-center">
                            <table id="example4" class="display " style="width:100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">Department Logo</th>
                                        <th class="text-center">Student Name</th>
                                        <th class="text-center">Department Name</th>
                                        <th class="text-center">Year</th>
                                        <th class="text-center">Course</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="vertical-align: middle;">
                                    <?php
                                     require_once("../functions/dbconfig.php");
                                     $newconnection = new Connection();
                                     $connection = $newconnection->openConnection();
                         
                                     $sql = "SELECT * FROM students WHERE year_level = '4th Year' ORDER BY department_id";
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
                                                <td><?= $row['student_name'] ?></td>
                                                <td><?= $row['department_name'] ?></td>
                                                <td><?= $row['year_level'] ?></td>
                                                <td><?= $row['course_name'] ?></td>
                                                <td>
                                                <i class="fa-solid fa-edit" type="button" style="color: green" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="openUpdateModal(<?= $row['student_id'] ?>)"></i> |
                                                    <a href="../functions/deleteStudent.php?studentId=<?= $row['student_id'] ?>" onclick="return confirm('Are you sure you want to delete this student?');"> <i class="fa fa-trash _delete_cat" type="button" style="color:red"></i></a>
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

        $stmt = $connection->prepare("SELECT * FROM department");
        $stmt->execute();
        $departments = $stmt->fetchAll(PDO::FETCH_OBJ);

        $stmt = $connection->prepare("SELECT * FROM course");
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_OBJ);

        $stmt = $connection->prepare("SELECT * FROM yearlevels");
        $stmt->execute();
        $yearlevels = $stmt->fetchAll(PDO::FETCH_OBJ);
        ?>
    </div>
</div>

<script src="../js/students.js"></script>
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

<?php require_once('../modal/student_create.php'); ?>
<?php require_once('../modal/update_student.php'); ?>
<?php require_once('../inc/footer.php'); ?>