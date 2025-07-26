ALTER TABLE payment
ADD COLUMN tax DECIMAL(10, 2) DEFAULT 0;

DELIMITER //

CREATE TRIGGER loan_balance_trigger
AFTER INSERT ON payment
FOR EACH ROW
BEGIN
    UPDATE employee
    SET loan = loan - NEW.loan_cut
    WHERE Employee_id = NEW.emp_id;
END //

DELIMITER ;
DELIMITER $$

CREATE FUNCTION calculate_tax(salary DECIMAL(10,2))
RETURNS DECIMAL(10,2)
DETERMINISTIC
BEGIN
    DECLARE tax_rate DECIMAL(5,2);
    IF salary > 50000 THEN
        SET tax_rate = 0.20; -- 20% tax rate for high income
    ELSE
        SET tax_rate = 0.10; -- 10% tax rate for low income
    END IF;
    RETURN salary * tax_rate;
END$$

DELIMITER ;
DELIMITER $$

CREATE PROCEDURE calculate_net_salary(
    IN basic_salary DECIMAL(10, 2),
    IN loan_cut DECIMAL(10, 2),
    IN pfund_cut DECIMAL(10, 2),
    IN medi_allow DECIMAL(10, 2),
    IN house_allow DECIMAL(10, 2),
    IN overtime DECIMAL(10, 2),
    IN sbonus DECIMAL(10, 2),
    IN obonus DECIMAL(10, 2)
)
BEGIN
    DECLARE net_salary DECIMAL(10, 2);
    
    -- Calculate the net salary based on the components
    SET net_salary = basic_salary + overtime + sbonus + obonus + medi_allow + house_allow - loan_cut - pfund_cut;
    
    -- Return the net salary
    SELECT net_salary AS net_salary;
END$$

DELIMITER ;
DELIMITER //

CREATE TRIGGER loan_balance_trigger
AFTER INSERT ON payment
FOR EACH ROW
BEGIN
    UPDATE employee
    SET loan = loan - NEW.loan_cut
    WHERE Employee_id = NEW.emp_id;
END //

DELIMITER ;
DELIMITER //
ALTER TABLE payment ADD COLUMN absence_deduction DECIMAL(10, 2) DEFAULT 0;
DELIMITER $$

CREATE TRIGGER before_payment_insert
BEFORE INSERT ON payment
FOR EACH ROW
BEGIN
    -- Variable to hold the basic salary
    DECLARE basic_salary DECIMAL(10,2);

    -- Fetch the employee's basic salary
    SELECT job.basic_salary 
    INTO basic_salary
    FROM employee
    INNER JOIN job ON employee.jobtitle = job.Job_Title
    WHERE employee.Employee_id = NEW.emp_id;

    -- Calculate absence deduction only if absence > 2 days
    IF NEW.absence > 2 THEN
        SET NEW.absence_deduction = (basic_salary / 30) * NEW.absence;
    ELSE
        SET NEW.absence_deduction = 0; -- No deduction for <= 2 days absence
    END IF;

    -- Final salary adjustments: deduct absence, loan cut, and PF
    SET NEW.total_pay = (basic_salary 
                        - NEW.absence_deduction 
                        - NEW.loan_cut 
                        - NEW.pfund_cut 
                        - NEW.tax
                        + NEW.overtime 
                        + NEW.season_bonus 
                        + NEW.other_bonus);
END$$

DELIMITER ;
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


