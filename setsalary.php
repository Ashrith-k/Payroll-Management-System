<?php
include('configall.php');

// Check if salary and job title are set to prevent undefined index errors
if (isset($_POST["salary"]) && isset($_POST["jobtitle"])) {
    // Sanitize and validate inputs
    $salary = mysqli_real_escape_string($connection, $_POST["salary"]);
    $jobtitle = mysqli_real_escape_string($connection, $_POST["jobtitle"]);

    // Ensure salary is a positive number
    if ($salary > 0) {
        // Prepare and execute the SQL statement
        $sql = "UPDATE `job` SET `basic_salary` = '$salary' WHERE `Job_Title` = '$jobtitle';";
        $test = mysqli_query($connection, $sql);

        if ($test) {
            header('Location: employee.php'); // Redirect to employee list on success
            exit();
        } else {
            echo 'Failed to update salary: ' . mysqli_error($connection);
        }
    } else {
        echo "Invalid salary amount. Please enter a positive number.";
    }
} else {
    echo "Please fill out both fields.";
}
?>
