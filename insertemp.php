<?php
include('configall.php');

$empid = $_POST["empid"];
$name = $_POST["name"];
$dob = $_POST["dob"];
$gender = $_POST["gender"];
$sdate = $_POST["sdate"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$loan = 0; // Default value
$pfund = 0; // Default value
$jobtitle = $_POST["jobtitle"];
$address = $_POST["address"];
$depid = $_POST["depid"];
$manid = $_POST["managedepid"];
$bacc = $_POST["bacc"];

// Prepare SQL query based on managing department presence
if (empty($manid)) {
    $sql = "INSERT INTO employee (Employee_id, Name, Address, Phone_no, Email, Start_date, dob, gender, loan, p_fund, jobtitle, Depart_id, managesDepart_id, bank_accno)
            VALUES ('$empid', '$name', '$address', '$phone', '$email', '$sdate', '$dob', '$gender', '$loan', '$pfund', '$jobtitle', '$depid', NULL, '$bacc')";
} else {
    $sql = "INSERT INTO employee (Employee_id, Name, Address, Phone_no, Email, Start_date, dob, gender, loan, p_fund, jobtitle, Depart_id, managesDepart_id, bank_accno)
            VALUES ('$empid', '$name', '$address', '$phone', '$email', '$sdate', '$dob', '$gender', '$loan', '$pfund', '$jobtitle', '$depid', '$manid', '$bacc')";
}

// Execute query and check for success
if ($connection->query($sql) === TRUE) {
    echo "Successfully inserted into database";
    header("Location: employee.php"); // Redirect to employee list
    exit();
} else {
    echo "Something went wrong: " . $connection->error;
}
?>
