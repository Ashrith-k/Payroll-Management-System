<?php
include('configall.php');

// Error handling for database connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM department";
$result = mysqli_query($connection, $sql);

// Error handling for query execution
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Department Data</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body {
    margin: 0; /* Removes default body margin */
    padding: 0; /* Removes default body padding */
    box-sizing: border-box; /* Ensures consistent padding and borders */
}
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
            margin-left: 320px; /* Adjusted to accommodate the sidebar */
            padding: 20px; /* Added padding for better spacing */
        }
        /* Centering container */
.center-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f4f4f4;
    margin: 0;
}

/* Styling the form */
.add-department-form {
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ddd;
    width: 50%;
    max-width: 500px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    text-align: center; /* Ensures all child elements are centered */

}

/* Form-specific styles */
.add-department-form h3 {
    margin-bottom: 15px;
    color: #333;
}

.add-department-form label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
    color: #555;
}

.add-department-form input[type="text"] {
    width: 80%;
    padding: 8px;
    margin-top: 5px;
    margin-bottom: 15px;
    border-radius: 4px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

.add-department-form button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
    margin-top: 15px; /* Add spacing above the button */
}

.add-department-form button:hover {
    background-color: #45a049;
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
                <dt><a href="setsalary.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Set Salary</a></dt>
                <dt><a href="payment.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Set Payment</a></dt>
                <dt><a href="payslip.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Pay Slip</a></dt>
                <dt><a href="paymenthistory.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Payment History</a></dt>
                <dt><a href="index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Log Out</a></dt>
            </dl>
        </div>
    </div>
</nav>

<div class="w3-main">
    <div class="w3-display-container w3-text-blue" style="font-size: 50px">
        <img src="banner.jpg" alt="Lights" style="height: 100px; width:100%; object-fit:cover">
        <div class="w3-display-middle w3-large"><h1>Payroll Management System</h1></div>
    </div>
    <div class="w3-display-container w3-text-white">
        <img src="home.jpg" alt="Lights" style="width:100%">
        <div class="w3-display-topmiddle" style="font-size: 20px">
            <h2><center>Welcome to Payroll System</center></h2>
           
        </div>
    </div>

    <div class="w3-container">
        <h4>Department Data</h4>
        <table>
            <thead>
                <tr>
                    <th>Department ID</th>
                    <th>Department Name</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['Depart_id']; ?></td>
                <td><?php echo $row['Depart_name']; ?></td>
                <td>
                    <a href="deldepts.php?del=<?php echo $row['Depart_id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
            </tbody>
        </table>
        <div class="center-container">
    <div class="add-department-form">
        <h3>Add Department</h3>
        <form action="adddepts.php" method="POST">
            <label>Department ID:</label>
            <input type="text" name="depid" required><br>
            <label>Department Name:</label>
            <input type="text" name="depname" required><br>
            <button type="submit" class="w3-button w3-blue">Add Department</button>
        </form>
    </div>
</div>
</div>
</div>
</body>
</html>
