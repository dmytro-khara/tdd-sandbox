<?php
/**
 * Created by PhpStorm.
 * User: dmytro.khara
 * Date: 2018-02-26
 * Time: 14:51
 */

require_once __DIR__ . "/Model.php";

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

        if(filter_var($maxInvestmentValue, FILTER_VALIDATE_FLOAT) && $maxInvestmentValue > 0) {
            $this->maxInvestmentValue = $maxInvestmentValue;
        } else {
            throw new InvalidArgumentException('Max Investment Value should be positive float');
        }

    }

    public function getInterestRate()
    {
        return $this->interestRate;
    }

    public function getMaxInvestmentValue()
    {
        return $this->maxInvestmentValue;
    }

    public function addInvestment($investment)
    {
        $this->investments[] = $investment;
        return $this->investments;
    }

    public function calculateInterests()
    {

    }
}