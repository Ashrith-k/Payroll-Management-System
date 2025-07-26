<?php include('configall.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Data</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
       
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th {
            background-color: green;
            color: white;
            padding: 10px;
            text-align: left;
        }
        td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .w3-main {
            margin-left: 320px; 
            padding: 20px;
        }
    </style>
</head>
<body>
<nav class="w3-sidebar w3-light-blue w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
    <div class="w3-container w3-dark-grey">
        <h4>Menu</h4>
    </div>
    <img src="payroll.jpg" alt="Snow" style="width:100%;padding-top: 15px;padding-bottom: 15px">
    <div class="w3-container w3-dark-grey">
        <h4>Payroll system</h4>
        <div class="w3-bar-block">
            <dl>
                <dt><a href="homepage.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-red">Home</a></dt>
                <dt><a href="departments.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Department</a></dt>
                <dt><a href="employee.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Employee</a></dt>
                <dt><a href="setsalary.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Set Salary</a></dt>
                <dt><a href="setpayment.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Set Payment</a></dt>
                <dt><a href="payslip.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Pay Slip</a></dt>
                <dt><a href="paymenthistory.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Payment History</a></dt>
                <dt><a href="login.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Log Out</a></dt>
            </dl>
        </div>
    </div>
</nav>

<div class="w3-main">
    <!-- Header -->
    <div class="w3-display-container w3-text-blue" style="font-size: 50px">
        <img src="banner.jpg" alt="Lights" style="height: 100px; width:100%; object-fit:cover">
        <div class="w3-display-middle w3-large"><h1>Payroll Management System</h1></div>
    </div>
    <div class="w3-display-container w3-text-white">
        <img src="home.jpg" alt="Lights" style="width:100%">
        <div class="w3-display-topmiddle" style="font-size: 20px">
            <h2><center>Welcome to Payroll System</center></h2>
            <center><h3>This is the homepage</h3></center>
        </div>
    </div>

    <div class="w3-container">
        <h4>Employee Data</h4>
        <a href="addemployee.html" class="w3-button w3-blue w3-right">Add Employee <span class="w3-text-red">+</span></a>
        <br><br>
        <div style="max-height: 500px; overflow-y: auto; border: 1px solid #ddd;">
        <table>
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Job Title</th>
                    <th>Salary</th>
                    <th>Loan</th>
                    <th>Provident Fund</th>
                    <th>Bank Number</th>
                    <th>Start Date</th>
                    <th>Date of Birth</th>
                    <th>Department</th>
                    <th>Managing Department</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT employee.*, job.basic_salary FROM employee INNER JOIN job ON employee.jobtitle = job.Job_Title;";
                $result = mysqli_query($connection, $sql);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $row['Employee_id']; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['Address']; ?></td>
                    <td><?php echo $row['Email']; ?></td>
                    <td><?php echo $row['Phone_no']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['jobtitle']; ?></td>
                    <td><?php echo $row['basic_salary']; ?></td>
                    <td><?php echo $row['loan']; ?></td>
                    <td><?php echo $row['p_fund']; ?></td>
                    <td><?php echo $row['bank_accno']; ?></td>
                    <td><?php echo $row['Start_date']; ?></td>
                    <td><?php echo $row['dob']; ?></td>
                    <td><?php echo $row['Depart_id']; ?></td>
                    <td><?php echo $row['managesDepart_id'] ?? '--'; ?></td>
                    <td><a href="updatemployee.php?edit=<?php echo $row['Employee_id']; ?>" class="w3-button w3-teal">Edit</a></td>
                    <td><a href="delemployee.php?del=<?php echo $row['Employee_id']; ?>" class="w3-button w3-red">Delete</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
    </div>
</div>
</body>
</html>
