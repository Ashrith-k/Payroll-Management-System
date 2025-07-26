<?php
include('configall.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $emp_id = $_POST['emp_id'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $absence = $_POST['absence'];
    $loan_cut = $_POST['loan_cut'];
    $pfund_cut = $_POST['pfund_cut'];
    $overtime = $_POST['overtime'];
    $season_bonus = $_POST['season_bonus'];
    $other_bonus = $_POST['other_bonus'];
    $medi_allow = $_POST['medi_allow'];
    $house_allow = $_POST['house_allow'];

    // Prepare and execute the stored procedure
    $stmt = $connection->prepare("CALL generate_payslip(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, @total_pay)");
    $stmt->bind_param("iissddddddd", $emp_id, $year, $month, $absence, $loan_cut, $pfund_cut, $overtime, $season_bonus, $other_bonus, $medi_allow, $house_allow);
    
    if ($stmt->execute()) {
        // Fetch the total salary from the OUT parameter
        $result = $connection->query("SELECT @total_pay AS total_pay");
        $row = $result->fetch_assoc();
        $total_pay = $row['total_pay'];

        echo "<p>Payslip generated successfully for Employee ID: $emp_id.<br>Total Pay: $total_pay</p>";
    } else {
        echo "<p>Error generating payslip: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $connection->close();
}
?>
