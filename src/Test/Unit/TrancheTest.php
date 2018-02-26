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
        $tranche = new Tranche(3, 1000);
        $value = $tranche->getInterestRate();
        $this->assertSame(3, $value);
    }
    public function testGetMaxInvestmentValue_ReturnsPresetAmount()
    {
        $tranche = new Tranche(3, 1000);
        $value = $tranche->getMaxInvestmentValue();
        $this->assertSame(1000, $value);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCreateTranche_WithInvalidRate()
    {
        $tranche = new Tranche(-3, 1000);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCreateTranche_WithInvalidMaxInvestmentValue()
    {
        $tranche = new Tranche(3, -1000);
    }

    public function testAddInvestment_ReturnsArray_WithAddedInvestment()
    {
        $tranche = new Tranche(3, 1000);
        $investment = $this->getMockClass('Investment');
        $investments = $tranche->addInvestment($investment);
        $this->assertContains($investment, $investments);
    }
}
