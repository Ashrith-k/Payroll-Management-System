DELIMITER $$

CREATE PROCEDURE GetPayslipDetails(IN empid INT, IN year INT, IN month INT)
BEGIN
    SELECT 
        absence AS AbsenceDays,
        loan_cut AS LoanDeduction,
        pfund_cut AS PFDeduction,
        overtime AS OvertimePay,
        season_bonus AS SeasonalBonus,
        other_bonus AS OtherBonus,
        total_pay AS FinalSalary
    FROM payment
    WHERE emp_id = empid AND year = year AND month = month;
END$$

DELIMITER ;
