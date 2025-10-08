<?php
/* Write a PHP class called Calculator
 that has a private property called result. Implement
  methods to perform basic arithmetic operations like
   addition, subtraction, multiplication and division. */
class Calculator {
    private $result;

    public function __construct() {
        $this->result = 0;
    }

    public function getResult() {
        return $this->result;
    }

    public function add($number) {
        $this->result += $number;
    }

    public function subtract($number) {
        $this->result -= $number;
    }

    public function multiply($number) {
        $this->result *= $number;
    }

    public function divide($number) {
        if ($number != 0) {
            $this->result /= $number;
        } else {
            throw new Exception("Division by zero is not allowed.");
        }
    }
}
$calc = new Calculator();
$calc->add(10);
$calc->subtract(2);
$calc->multiply(3);
$calc->divide(4);
echo $calc->getResult(); // Output: 6
?>