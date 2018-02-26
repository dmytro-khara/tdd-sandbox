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

    }
}