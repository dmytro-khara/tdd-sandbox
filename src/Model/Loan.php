<?php
/**
 * Created by PhpStorm.
 * User: dmytro.khara
 * Date: 2018-02-26
 * Time: 14:51
 */

require_once __DIR__ . "/Model.php";

class Loan extends Model
{
    private $startDate;
    private $endDate;
    private $tranches = [];

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function addTranche($tranche)
    {
        $this->tranches[] = $tranche;
        return $this->tranches;
    }

    public function calculateTotalInterests($startDate, $endDate)
    {
        $startDate = ($this->startDate >= $startDate) ? $this->startDate : $startDate;
        $endDate = ($this->endDate <= $endDate) ? $this->endDate : $endDate;

        $interests = [];

        foreach ($this->tranches as $tranche) {
            $interests[] = $tranche->calculateInterests($startDate, $endDate);
        }

        return $this->_mergeInterests($interests);
    }

    private function _mergeInterests($interests)
    {
        $merged = array();
        foreach ($interests as $interest) {
            foreach ($interest as $key => $value) {
                if ( ! is_numeric($value)) {
                    continue;
                }
                if ( ! isset($merged[$key])) {
                    $merged[$key] = $value;
                }
                else {
                    $merged[$key] += $value;
                }
            }
        }

        return $merged;
    }
}