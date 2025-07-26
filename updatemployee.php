<?php
include('configall.php');

// Retrieve employee details if edit is requested
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $rec = mysqli_query($connection, "SELECT * FROM employee WHERE Employee_id=$id;");
    $record = mysqli_fetch_array($rec);

    $name = $record['Name'];
    $dob = $record['dob'];
    $gender = $record['gender'];
    $sdate = $record['Start_date'];
    $email = $record['Email'];
    $phone = $record['Phone_no'];
    $loan = $record['loan'];
    $pfund = $record['p_fund'];
    $jobtitle = $record['jobtitle'];
    $address = $record['Address'];
    $depid = $record['Depart_id'];
    $manid = $record['managesDepart_id'] ?? 0;
    $bacc = $record['bank_accno'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title text-center">Update Employee Details</h3>
        </div>
        <div class="card-body">
            <form action="updateem.php" method="post">
                <input type="hidden" name="empid" value="<?php echo $id; ?>">

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                </div>

                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $dob; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Gender</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php echo ($gender == 'male') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php echo ($gender == 'female') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="sdate" class="form-label">Joining Date</label>
                    <input type="date" class="form-control" id="sdate" name="sdate" value="<?php echo $sdate; ?>">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>">
                </div>

                <div class="mb-3">
                    <label for="loan" class="form-label">Loan</label>
                    <input type="number" class="form-control" id="loan" name="loan" value="<?php echo $loan; ?>">
                </div>

                <div class="mb-3">
                    <label for="pfund" class="form-label">Provident Fund</label>
                    <input type="number" class="form-control" id="pfund" name="pfund" value="<?php echo $pfund; ?>">
                </div>

                <div class="mb-3">
                    <label for="bacc" class="form-label">Bank Account No</label>
                    <input type="text" class="form-control" id="bacc" name="bacc" value="<?php echo $bacc; ?>">
                </div>

                <div class="mb-3">
                    <label for="jobtitle" class="form-label">Job Title</label>
                    <select class="form-select" id="jobtitle" name="jobtitle">
                        <option value="executive" <?php if($jobtitle == 'executive') echo 'selected'; ?>>Executive</option>
                        <option value="manager" <?php if($jobtitle == 'manager') echo 'selected'; ?>>Manager</option>
                        <option value="director" <?php if($jobtitle == 'director') echo 'selected'; ?>>Director</option>
                        <option value="accountant" <?php if($jobtitle == 'accountant') echo 'selected'; ?>>Accountant</option>
                        <option value="chief" <?php if($jobtitle == 'chief') echo 'selected'; ?>>Chief</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
                </div>

                <div class="mb-3">
                    <label for="depid" class="form-label">Employee Department</label>
                    <input type="number" class="form-control" id="depid" name="depid" value="<?php echo $depid; ?>">
                </div>

                <div class="mb-3">
                    <label for="manid" class="form-label">Managing Department</label>
                    <input type="number" class="form-control" id="manid" name="manid" value="<?php echo $manid; ?>">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
