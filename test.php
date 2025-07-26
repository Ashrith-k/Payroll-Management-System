<?php
// payroll.php
include('configall.php');

// Query to fetch employee and payment data
$query = "SELECT e.Employee_id, e.Name, e.jobtitle, e.Depart_id, d.Depart_name, p.month, p.year, p.total_pay
          FROM employee e
          JOIN department d ON e.Depart_id = d.Depart_id
          JOIN payment p ON e.Employee_id = p.emp_id";
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* style.css */
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
}

h2 {
    color: #343a40;
}

.table {
    margin-top: 20px;
}

.table thead {
    background-color: #343a40;
    color: #ffffff;
}

.table tbody tr:hover {
    background-color: #f1f1f1;
}

    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Payroll Management System</h2>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Job Title</th>
                <th>Department</th>
                <th>Month</th>
                <th>Year</th>
                <th>Total Pay</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = oci_fetch_assoc($stmt)): ?>
            <tr>
                <td><?php echo $row['EMPLOYEE_ID']; ?></td>
                <td><?php echo $row['NAME']; ?></td>
                <td><?php echo $row['JOBTITLE']; ?></td>
                <td><?php echo $row['DEPART_NAME']; ?></td>
                <td><?php echo $row['MONTH']; ?></td>
                <td><?php echo $row['YEAR']; ?></td>
                <td><?php echo number_format($row['TOTAL_PAY'], 2); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
// Close the database connection
oci_free_statement($stmt);
oci_close($conn);
?>
