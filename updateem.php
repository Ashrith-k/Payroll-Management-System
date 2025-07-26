<?php
include('configall.php');

$empid = $_POST['empid'];
$name = $_POST['name'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$sdate = $_POST['sdate'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$loan = $_POST['loan'];
$pfund = $_POST['pfund'];
$jobtitle = $_POST['jobtitle'];
$address = $_POST['address'];
$depid = $_POST['depid'];
$manid = $_POST['manid'];
$bacc = $_POST['bacc'];

$manidValue = ($manid == 0) ? "NULL" : "'$manid'";

$sql = "UPDATE employee SET Name='$name', Address='$address', Phone_no='$phone', Email='$email', Start_date='$sdate', dob='$dob', gender='$gender', loan='$loan', p_fund='$pfund', jobtitle='$jobtitle', Depart_id='$depid', managesDepart_id=$manidValue, bank_accno='$bacc' WHERE Employee_id=$empid";

if (mysqli_query($connection, $sql)) {
    echo "Successfully updated info into the database";
    header("Location: employee.php");
} else {
    echo "Something went wrong: " . mysqli_error($connection);
}
?>
