<?php
require_once "../functions/dbconfig.php";
require "../functions/formfunctions.php";
usercheck_login();

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['createTeacherAccount'])) {
        $errors = createTeacherAccount($_POST);
    } elseif (isset($_POST['updateTeacherAccount'])) {
        $errors = updateTeacherAccount($_POST);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/teachers.css">
    <title>Document</title>
</head>

<body>
    <?php require_once('../inc/header.php'); ?>
    <div class="content-container">


        <section class="tables py-3">
            <div class="card border-0" style="background-color: rgba(0, 0, 0, 0);">
                <div class="card-header shadow-sm">
                    <button type="button" class="btn btn-warning" style="float: right;" data-bs-toggle="modal" data-bs-target="#create-teacher">
                        <i class="fa fa-plus"></i> Add Teacher
                    </button>
                    <h3 style="color:white;">Teacher List : </h3>
                </div>
                <div class="card-body" style="color:white;">
                    <div class="table-body col-12 text-center">
                        <table id="example4" class="display " style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">Teacher Profile</th>
                                    <th class="text-center">Teacher Name</th>
                                    <th class="text-center">Department Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody style="vertical-align: middle;">
                                <?php
                                require_once("../functions/dbconfig.php");
                                $newconnection = new Connection();
                                $connection = $newconnection->openConnection();

                                $sql = "SELECT * FROM teachers WHERE usertype != 'Admin'";
                                $result = $connection->query($sql);

                                if ($result->rowCount() > 0) {
                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                        <tr>
                                            <td><img src="<?= $row['teacher_profile'] ?>" alt="" style="border-radius:50%;hieght:50px;width:50px;"></td>
                                            <td> <?= $row['teacher_name'] ?></td>
                                            <td><?= $row['department_name'] ?></td>

                                            <td>
                                                <i class="fa-solid fa-edit" type="button" style="color: green" data-bs-toggle="modal" data-bs-target="#update-teacher" onclick="openUpdateModal(<?= $row['teacher_id'] ?>)"></i> |
                                                <a href="../functions/deleteTeacher.php?teacherId=<?= $row['teacher_id'] ?>" onclick="return confirm('Are you sure you want to delete this teacher?');"><i class="fa fa-trash _delete_cat" type="button" style="color:red"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <div class="noteacher">No teacher available.</div>
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
        ?>
<?php require_once('../modal/update_teacher.php'); ?>
</body>

</html>
<script src="../js/teachers.js"></script>
<?php require_once('../modal/create_teacher.php'); ?>

<?php require_once('../inc/footer.php'); ?>