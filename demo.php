<?php

/**
 * Learn public / protected / private
 * 
 */

class Public_class{
    public $public_name;
    private $private_name;
    protected $protected_name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    function public_function()
    {
        // access protected variable
        echo $this->protected_name = 'Hi protected can access in the class or derived from that class <br>';
        echo $this->private_name = 'Hi private_name can only access within class not out side of class <br>';
        echo $this->protected_name = 'Its variable in ' . __FUNCTION__ . ' and class ' . __CLASS__;
    }

    protected function protected_function()
    {
        echo '<br><br> Hi I am ' . __FUNCTION__ .' of '. __CLASS__;
    }

    private function private_function($message)
    {
        echo '<br> Hi, ' . __FUNCTION__ . ' of ' . __CLASS__;
        echo $message;
    }

    function all_function_access()
    {
        echo '<br><br> Hi ' . $this->name;
        $message = '<br> Message form ' . __FUNCTION__ . ' sended by ' . $this->name;
        $this->protected_function();
        $this->private_function($message);
    }

    protected function addition($one, $two)
    {
        return $one + $two;
    }

    private function sum_2_function_data($function1Data, $function2Data)
    {
        return $function1Data + $function2Data;
    }

    protected function get_function_result($data1, $data2)
    {
        $result = $this->sum_2_function_data($data1, $data2);
        return '<br><br> Result ' . __CLASS__ . ' ' . __FUNCTION__ . ' : ' . $result;
    }
}

class Protected_class extends Public_class{
    function check_data()
    {
        $recive = $this->all_function_access();
        echo '<br><br>' . __CLASS__ . ' in ' . __FUNCTION__ . '<br> Details: ';
    }
    function get_user_input_for_addition($one, $two)
    {
        echo '<br> Answer form ' . __CLASS__ . ' in ' . __FUNCTION__ . '<br>Result is: ' . $this->addition($one, $two);

        // echo '<br><br> ' . 
    }

    function access_private()
    {
        echo $this->get_function_result(1,5);
    }
}

// $public_class = new Public_class('Sushil');



$public_class = new Public_class('sushil');
$public_class->public_function();
$public_class->all_function_access();

$protected_class = new Protected_class('Sushil');
$protected_class->check_data();
$protected_class->get_user_input_for_addition(5, 15);
$protected_class->access_private();