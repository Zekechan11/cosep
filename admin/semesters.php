<?php
require_once "../functions/dbconfig.php";
require "../functions/formfunctions.php";
usercheck_login();

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['createSemester'])) {
        $errors = createSemester($_POST);
    } elseif (isset($_POST['updateSemester'])) {
        $errors = updateSemester($_POST);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/semesters.css">
    <title>Document</title>
</head>

<body>
    <?php require('../inc/header.php'); ?>
    <div class="content-container">
        <div class="">
            <section class="tables py-3">
                <div class="card border-0" style="background-color: rgba(0, 0, 0, 0);">
                    <div class="card-header shadow-sm">
                        <button type="button" class="btn btn-warning" style="float: right;" data-bs-toggle="modal" data-bs-target="#create-semester">
                            <i class="fa fa-plus"></i> Add Semester</button>
                        <h3 style="color:white;">Semester List : </h3>
                    </div>
                    <div class="card-body" style="color:white;">
                        <div class="table-body col-12 text-center">
                            <table id="example1" class="display " style="width:100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">Semester</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="vertical-align: middle;">
                                    <?php
                                    require_once("../functions/dbconfig.php");
                                    $newconnection = new Connection();
                                    $connection = $newconnection->openConnection();

                                    $sql = "SELECT * FROM semester";
                                    $result = $connection->query($sql);

                                    if ($result->rowCount() > 0) {
                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                            <tr>
                                                <td> <?= $row['semester'] ?></td>
                                                <td>
                                                    <i class="fa-solid fa-edit" type="button" style="color: green" data-bs-toggle="modal" data-bs-target="#update-semester" onclick="openUpdateSemesterModal(<?= $row['semester_id'] ?>)"></i> |
                                                    <a href="../functions/deleteSemester.php?semesterId=<?= $row['semester_id'] ?>" onclick="return confirm('Are you sure you want to delete this student?');"> <i class="fa fa-trash _delete_cat" type="button" style="color:red"></i></a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="nosemester">No semester available.</div>
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

    <?php require_once('../modal/create_semester.php'); ?>
    <?php require_once('../modal/update_semester.php'); ?>
    <script src="../js/semesters.js"></script>
</body>

</html>

<?php require_once('../inc/footer.php'); ?>