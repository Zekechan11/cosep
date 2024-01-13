<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admindashboardd.css">
    <title>Document</title>
</head>

<body>
    <?php require('../inc/header.php'); ?>
    </div>
    <div class="content-container">

        <button type="button" class="btn btn-warning float-end" data-bs-toggle="modal" data-bs-target="#create-department" style="float: right;position:relative;top:640px;right:30px;">
            <span class="material-icons">add</span>
        </button>

        <div class="container">
            <div class="department-box">
                <?php
                require_once("../functions/dbconfig.php");
                $newconnection = new Connection();
                $connection = $newconnection->openConnection();

                $sql = "SELECT * FROM department";
                $result = $connection->query($sql);

                if ($result->rowCount() > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>

                        <div class="department-card">
                            <div class="department-profile">
                                <img src="<?= $row['department_logo'] ?>" alt="">
                            </div>
                            <div class="department-info">
                                <div class="department-nametype">
                                    <div class="department-name" style="color: white;">
                                        <?= $row['department_acronym'] ?>
                                    </div>
                                    <div class="department-type" style="color: white;">
                                        <?= $row['department_name'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons">
                                <a href="viewdepartment.php?department_id=<?= $row['department_id'] ?>"><i class="fa-brands fa-searchengin" style="font-size: 30px;"></i></button></a>

                                <button class="update-department-button" id="updateDepartmentButton" onclick="openUpdateModal(<?= $row['department_id'] ?>)"><i class="fa-regular fa-pen-to-square" style="font-size: 30px;"></i></button>

                                <a href="deleteDepartment.php?departmentId=<?= $row['department_id'] ?>" onclick="return confirm('Are you sure you want to delete this department?');"><i class="fa-solid fa-trash" style="font-size: 30px;"></i></a>

                            </div>
                        </div>

                    <?php
                    }
                } else {
                    ?>
                    <div class="nodepartment">No departments available.</div>
                <?php
                }
                $newconnection->closeConnection();
                ?>
            </div>
        </div>

    </div>
    <script src="../js/admindashboard.js"></script>
</body>

</html>

<?php require('../modal/create_department.php'); ?>
<?php require('../modal/update_department.php'); ?>
<?php require('../inc/footer.php'); ?>