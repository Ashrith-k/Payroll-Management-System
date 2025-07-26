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
