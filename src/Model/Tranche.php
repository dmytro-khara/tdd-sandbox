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
        $this->interestRate = $interestRate;
        $this->maxInvestmentValue = $maxInvestmentValue;
    }

    public function getInterestRate()
    {

    }

    public function getMaxInvestmentValue()
    {

    }
}