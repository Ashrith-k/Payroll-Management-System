<?php
include('configall.php');
$id = $_POST['id'];
if ($id) {
    $sql = "SELECT payment.year, payment.month, payment.pay_no, payment.emp_id, employee.Name, employee.bank_accno, payment.total_pay 
            FROM `employee` 
            INNER JOIN `payment` 
            ON employee.Employee_id = payment.emp_id 
            WHERE employee.Employee_id = $id;";
    $result = mysqli_query($connection, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment History</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fc;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 40px 200px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #f1f1f1;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }

        /* Header Section */
        .header-section {
            text-align: center;
            padding-bottom: 20px;
        }
        .header-section h4 {
            font-size: 1.8em;
            color: #4CAF50;
            margin: 0;
        }
        .header-section p {
            font-size: 1em;
            color: #555;
            margin-top: 5px;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
            th, td {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="w3-container container">
        <div class="header-section">
            <h4>Employee Payment History</h4>
            <p>Details of past payments for Employee ID: <strong><?php echo htmlspecialchars($id); ?></strong></p>
        </div>
        <table class="w3-table w3-bordered">
            <tr>
                <th>Payment No</th>
                <th>Year</th>
                <th>Month</th>
                <th>Bank Account No</th>
                <th>Total Salary</th>
            </tr>
            <?php 
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['pay_no']); ?></td>
                        <td><?php echo htmlspecialchars($row['year']); ?></td>
                        <td><?php echo ucfirst(htmlspecialchars($row['month'])); ?></td>
                        <td><?php echo htmlspecialchars($row['bank_accno']); ?></td>
                        <td><?php echo "$" . htmlspecialchars(number_format($row['total_pay'], 2)); ?></td>
                    </tr>
                <?php } 
            } else { ?>
                <tr>
                    <td colspan="5" class="w3-center">No records found for this Employee ID.</td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
