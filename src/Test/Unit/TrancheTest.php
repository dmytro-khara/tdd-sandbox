<?php

/**
 * Created by PhpStorm.
 * User: dmytro.khara
 * Date: 2018-02-26
 * Time: 14:55
 */

require __DIR__ . "/../../Model/Tranche.php";

class TrancheTest extends PHPUnit_Framework_TestCase
{
    public function testGetInterestRate_ReturnsPresetAmount()
    {
        $investment = new Tranche(3, 1000);
        $value = $investment->getInterestRate();
        $this->assertSame(3, $value);
    }
    public function testGetMaxInvestmentValue_ReturnsPresetAmount()
    {
        $investment = new Tranche(3, 1000);
        $value = $investment->getMaxInvestmentValue();
        $this->assertSame(1000, $value);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCreateTranche_WithInvalidRate()
    {
        $investment = new Tranche(-3, 1000);
    }
}
