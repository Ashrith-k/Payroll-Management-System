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
                        + NEW.overtime 
                        + NEW.season_bonus 
                        + NEW.other_bonus);
END$$

DELIMITER ;
