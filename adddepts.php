<?php
include('configall.php');

// Ensure data is received from the form
if (isset($_POST["depid"]) && isset($_POST["depname"])) {
    $depid = mysqli_real_escape_string($connection, $_POST["depid"]);
    $depname = mysqli_real_escape_string($connection, $_POST["depname"]);

    // Insert query
    $sql = "INSERT INTO department (Depart_id, Depart_name) VALUES ('$depid', '$depname')";
    if (mysqli_query($connection, $sql)) {
        echo "Department added successfully!";
        header('Location: departments.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($connection);
    }
} else {
    echo "Please fill all fields.";
}
?>
