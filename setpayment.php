<?php
include('configall.php'); // Include database connection

if (isset($_POST["submit"])) {
    // Retrieve and sanitize inputs
    $empid = mysqli_real_escape_string($connection, $_POST["empid"]);
    $year = mysqli_real_escape_string($connection, $_POST["year"]);
    $month = mysqli_real_escape_string($connection, $_POST["month"]);
    $absence = mysqli_real_escape_string($connection, $_POST["absence"]);
    $overtime = mysqli_real_escape_string($connection, $_POST["overtime"]);
    $sbonus = mysqli_real_escape_string($connection, $_POST["sbonus"]);
    $obonus = mysqli_real_escape_string($connection, $_POST["obonus"]);

    // Fetch employee basic salary, loan details, and calculate loan and PF cuts
    $query = "SELECT job.basic_salary, employee.loan 
              FROM employee 
              INNER JOIN job ON employee.jobtitle = job.Job_Title 
              WHERE employee.Employee_id = '$empid'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $basic_salary = $row['basic_salary'];
        $loan_cut = $row['loan'] * 0.05; // Assuming loan_cut is 5% of the loan
        $pfund_cut = $basic_salary * 0.10; // Fixed PF rate (10%)

        // Fetch tax using the `calculate_tax` function
        $tax_query = "SELECT calculate_tax($basic_salary) AS tax";
        $tax_result = mysqli_query($connection, $tax_query);
        $tax = 0; // Default tax value
        if ($tax_result && mysqli_num_rows($tax_result) > 0) {
            $tax_row = mysqli_fetch_assoc($tax_result);
            $tax = $tax_row['tax'];
        }

        // Insert payment into the database
        $insert_query = "INSERT INTO payment 
                         (emp_id, year, month, absence, loan_cut, pfund_cut, overtime, season_bonus, other_bonus, tax) 
                         VALUES 
                         ('$empid', '$year', '$month', '$absence', '$loan_cut', '$pfund_cut', '$overtime', '$sbonus', '$obonus', '$tax')";
        if (mysqli_query($connection, $insert_query)) {
            // Payment successfully recorded
            echo "<div class='w3-container w3-green'><p>Payment successfully recorded!</p></div>";
            // Redirect to employee.php
            header("Location: employee.php");
            exit();
        } else {
            // Error inserting payment
            echo "<div class='w3-container w3-red'><p>Error: " . mysqli_error($connection) . "</p></div>";
        }
    } else {
        echo "<div class='w3-container w3-red'><p>Employee not found!</p></div>";
    }
}
?>
