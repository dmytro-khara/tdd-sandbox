<?php
/**
 * Created by PhpStorm.
 * User: dmytro.khara
 * Date: 2018-02-26
 * Time: 14:51
 */

require __DIR__ . "/Model.php";

class Tranche extends Model
{
    private $interestRate;
    private $maxInvestmentValue;
    private $currentInvestmentValue;
    private $investments = [];

    public function __construct($interestRate, $maxInvestmentValue)
    {

        if(filter_var($interestRate, FILTER_VALIDATE_FLOAT) && $interestRate > 0) {
            $this->interestRate = $interestRate;
        } else {
            throw new InvalidArgumentException('Interest Rate should be positive float');
        }

        $this->maxInvestmentValue = $maxInvestmentValue;
    }

    public function getInterestRate()
    {
        return $this->interestRate;
    }

    public function getMaxInvestmentValue()
    {
        return $this->maxInvestmentValue;
    }
}