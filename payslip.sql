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

CREATE PROCEDURE generate_payslip(
    IN emp_id INT,
    IN year INT,
    IN month VARCHAR(50),
    IN absence INT,
    IN loan_cut DECIMAL(10, 2),
    IN pfund_cut DECIMAL(10, 2),
    IN overtime DECIMAL(10, 2),
    IN season_bonus DECIMAL(10, 2),
    IN other_bonus DECIMAL(10, 2),
    IN medi_allow DECIMAL(10, 2),
    IN house_allow DECIMAL(10, 2),
    OUT total_pay DECIMAL(10, 2)
)
BEGIN
    DECLARE basic_salary DECIMAL(10, 2);

    -- Retrieve basic salary from the employee table
    SELECT basic_salary INTO basic_salary
    FROM employee
    WHERE Employee_id = emp_id;

    -- Validate if the basic salary is NULL
    IF basic_salary IS NULL THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Employee not found or missing basic salary.';
    END IF;

    -- Calculate total pay using the calculate_net_salary function
    SET total_pay = calculate_net_salary(
        basic_salary, 
        loan_cut, 
        pfund_cut, 
        medi_allow, 
        house_allow, 
        overtime, 
        season_bonus, 
        other_bonus
    );

    -- Insert the payslip record into the payment table
    INSERT INTO payment (
        emp_id, year, month, absence, loan_cut, pfund_cut, overtime, 
        season_bonus, other_bonus, medi_allow, house_allow, total_pay
    ) VALUES (
        emp_id, year, month, absence, loan_cut, pfund_cut, overtime, 
        season_bonus, other_bonus, medi_allow, house_allow, total_pay
    );
END //

DELIMITER ;
