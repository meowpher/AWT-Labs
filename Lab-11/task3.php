<?php
/* Create a PHP constructor to set employee name, designation, basic salary,
 allowances amount and deduction amount. 
Display gross salary and net salary using destructor. */
class Employee {
    private $name;
    private $designation;
    private $basicSalary;
    private $allowances;
    private $deductions;

    public function __construct($name, $designation, $basicSalary, $allowances, $deductions) {
        $this->name = $name;
        $this->designation = $designation;
        $this->basicSalary = $basicSalary;
        $this->allowances = $allowances;
        $this->deductions = $deductions;
    }

    public function __destruct() {
        $gross = $this->basicSalary + $this->allowances;
        $net = $gross - $this->deductions;
        echo "Employee: {$this->name} ({$this->designation})<br>";
        echo "Gross Salary: {$gross}<br>";
        echo "Net Salary: {$net}<br>";
    }
}

// Example Usage
$emp = new Employee("Taha", "Developer", 35000, 7000, 2500);
?>