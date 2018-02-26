<?php
/**
 * Created by PhpStorm.
 * User: dmytro.khara
 * Date: 2018-02-26
 * Time: 14:52
 */

require __DIR__ . "/Model.php";

class Investment extends Model
{
    private $investor;
    private $value;
    private $date;

    public function __construct($investor, $value, $date)
    {
        $this->investor = $investor;

        if(filter_var($value, FILTER_VALIDATE_FLOAT) && $value > 0) {
            $this->value = $value;
        } else {
            throw new InvalidArgumentException('Value should be positive float');
        }

        $this->date = $date;
    }

    public function getValue() {
        return $this->value;
    }
}