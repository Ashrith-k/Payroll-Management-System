<?php
include('configall.php');

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $sql = "DELETE FROM employee WHERE Employee_id=$id";
    mysqli_query($connection, $sql);
    
    header("Location: employee.php");
    exit;
}
?>
