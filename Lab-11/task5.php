<?php
//Write a PHP code to create constructor to set array elements and destructor to find minimum and maximum value from it.
class ArrayMinMax {
    private $arr;

    public function __construct($elements) {
        $this->arr = $elements;
    }

    public function __destruct() {
        $min = min($this->arr);
        $max = max($this->arr);
        echo "Minimum value: $min<br>";
        echo "Maximum value: $max<br>";
    }
}

$arr = [4, 12, 7, 9, 21, 3];
$obj = new ArrayMinMax($arr);
?>