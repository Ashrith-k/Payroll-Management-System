<?php
include('configall.php');

// Check if 'del' parameter is set
if (isset($_GET['del'])) {
    $id = mysqli_real_escape_string($connection, $_GET['del']);

    // Delete query
    $sql = "DELETE FROM department WHERE Depart_id='$id'";
    if (mysqli_query($connection, $sql)) {
        echo "Department deleted successfully!";
        header('Location: departments.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($connection);
    }
} else {
    echo "Invalid request.";
}
?>
