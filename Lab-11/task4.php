<?php
//Write a PHP code to find simple interest using constructor and destructor concept.
class SimpleInterest {
    private $principal;
    private $rate;
    private $time;

    public function __construct($principal, $rate, $time) {
        $this->principal = $principal;
        $this->rate = $rate;
        $this->time = $time;
    }

    public function __destruct() {
        $si = ($this->principal * $this->rate * $this->time) / 100;
        echo "Simple Interest: {$si}<br>";
    }
}
$siObj = new SimpleInterest(5000, 5, 2);
?>