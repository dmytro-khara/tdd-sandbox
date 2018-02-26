<?php
/**
 * Created by PhpStorm.
 * User: dmytro.khara
 * Date: 2018-02-26
 * Time: 14:52
 */

require_once __DIR__ . "/Model.php";

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

    public function getValue()
    {
        return $this->value;
    }

    public function addValue($value)
    {
        if(filter_var($value, FILTER_VALIDATE_FLOAT) && $value > 0) {
            $this->value += $value;
        } else {
            throw new InvalidArgumentException('Value should be positive float');
        }
    }

    /*
     * interest formula InvestmentValue * InterestRate/100 * NumberOfDaysOfActiveInvestment / NumberOfDaysInMonth
     */
    public function calculateInterest($interestRate, $startDate, $endDate)
    {
        $startDate = ($this->date >= $startDate) ? $this->date : $startDate;
        $interval = intval(date_diff($startDate, $endDate)->format('%a')) + 1;
        $numberOfDays = cal_days_in_month(CAL_GREGORIAN, $endDate->format('n'), $endDate->format('Y'));
        $interest = $this->value * ($interestRate / 100) * ($interval / $numberOfDays);
        return [$this->investor->getName() => round($interest, 2)];
    }
}