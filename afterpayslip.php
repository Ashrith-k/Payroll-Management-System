<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Payslip</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 10px;
            border-bottom: 2px solid #4CAF50;
        }
        .header h2 {
            margin: 0;
            color: #4CAF50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .no-records {
            text-align: center;
            padding: 20px;
            color: #888;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9rem;
            color: #666;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            color: white;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s;
        }
        .back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Employee Payslip</h2>
        </div>
        <?php
        include('configall.php');

        $month = $_POST['month'] ?? '';
        $year = $_POST['year'] ?? '';

        if ($month && $year) {
            $sql = "SELECT payment.pay_no, payment.emp_id, employee.Name, employee.bank_accno,
                           payment.absence, payment.loan_cut, payment.pfund_cut, 
                           payment.overtime, payment.season_bonus, payment.other_bonus, payment.total_pay
                    FROM employee
                    INNER JOIN payment
                    ON employee.Employee_id = payment.emp_id
                    WHERE payment.month = ? AND payment.year = ?";

            $stmt = $connection->prepare($sql);
            $stmt->bind_param("si", $month, $year);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<table class='w3-table w3-striped w3-bordered'>";
                echo "<tr>
                        <th>Payment No</th>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Bank Account No</th>
                        <th>Absence Deduction</th>
                        <th>Loan Deduction</th>
                        <th>Provident Fund</th>
                        <th>Overtime Pay</th>
                        <th>Seasonal Bonus</th>
                        <th>Other Bonuses</th>
                        <th>Total Salary</th>
                    </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['pay_no']}</td>
                            <td>{$row['emp_id']}</td>
                            <td>{$row['Name']}</td>
                            <td>{$row['bank_accno']}</td>
                            <td>₹" . number_format($row['absence'], 2) . "</td>
                            <td>₹" . number_format($row['loan_cut'], 2) . "</td>
                            <td>₹" . number_format($row['pfund_cut'], 2) . "</td>
                            <td>₹" . number_format($row['overtime'], 2) . "</td>
                            <td>₹" . number_format($row['season_bonus'], 2) . "</td>
                            <td>₹" . number_format($row['other_bonus'], 2) . "</td>
                            <td>₹" . number_format($row['total_pay'], 2) . "</td>
                        </tr>";
                }
                echo "</table>";
            } else {
                echo "<div class='no-records'>No records found for $month $year.</div>";
            }

            $stmt->close();
        } else {
            echo "<div class='no-records'>Please provide both month and year to view payslip data.</div>";
        }

        $connection->close();
        ?>
        <div class="footer">
            <a href="setpayment.html" class="back-button">Back to Input Page</a>
        </div>
    </div>
</body>
</html>
