<?php
require "config.php";
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit;
}
if ($_SESSION['prev_id'] == 2) {
    header("Location: ./index.php");
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/datatable.css">
    <title>Generate Bonafide</title>
    <link rel="icon" type="image/x-icon" href="./assets/education.png">

</head>

<body>
    <?php require_once('navbar.php'); ?>
    <div class="row1">
        <div class="columnz left">
            <?php require_once('sidebar.php'); ?>
        </div>
        <div class="columnz right">
            <?php
            $sql = "SELECT * FROM tbl_books;";
            $result = $conn->query($sql);
            ?>
            <form class="filter-form" action="generate-bonafide.php" method="post">
                <h2>Select Book</h2>
                <select class="col1" name="books" id="books">
                    <?php if ($result->num_rows > 0) : ?>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <option value="<?php echo $row['book_name']; ?>" <?php if($row['book_active']){ echo "selected";} ?>><?php echo $row['book_name']; if($row['book_active']){ echo " (Current)";} ?></option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
                <input class="col2" type="submit" class="btn" value="Submit">
            </form>
            <?php
                $tbl = $_POST['books'];
                $sql = "SELECT student_id,student_fname,student_mname,student_lname,student_grn,student_dob,student_sid,student_uid,student_gender FROM $tbl";
                $result = $conn->query($sql);
            ?>
            <table id="studentdata" class="show">
                <thead>
                    <?php $idx = 1; ?>
                    <tr>
                        <th>Sr.No</th>
                        <th>Student Name</th>
                        <th>GRN</th>
                        <th>Date of Birth</th>
                        <th>Student ID</th>
                        <th>Aadhar Number</th>
                        <th>Gender</th>
                        <th>View and Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0) : ?>
                        <?php while ($row = $result->fetch_assoc()) : ?>

                            <tr>
                                <td><?php echo $idx;
                                    $idx = $idx + 1; ?></td>
                                <td><?php echo $row['student_fname'] . " " . $row['student_mname'] . " " . $row['student_lname']; ?></td>
                                <td><?php echo $row['student_grn']; ?></td>
                                <td><?php echo $row['student_dob']; ?></td>
                                <td><?php echo $row['student_sid']; ?></td>
                                <td><?php echo $row['student_uid']; ?></td>
                                <td><?php echo $row['student_gender']; ?></td>
                                <td>
                                    <?php if ($_SESSION['prev_id'] == 1 || $_SESSION['prev_id'] == 3) : ?>
                                        <a class="editst" target="_blank" href="./bonafide.php?id=<?php echo $row['student_id']; ?>&xyz=<?php echo $tbl; ?>"><i class="fa fa-fw fa-lg fa-gears"></i> Generate</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/datatables.js"></script>
<script>
    $(document).ready(function() {
        $('#studentdata').DataTable({
            pagingType: 'full_numbers',
        });
    });
</script>

</html>