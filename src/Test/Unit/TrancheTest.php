<?php

/**
 * Created by PhpStorm.
 * User: dmytro.khara
 * Date: 2018-02-26
 * Time: 14:55
 */

require __DIR__ . "/../../Model/Tranche.php";
require __DIR__ . "/../../Model/Investment.php";

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
        $investment = $this->createMock('Investment');
        $investments = $tranche->addInvestment($investment);
        $this->assertContains($investment, $investments);
    }

    /**
     * @expectedException UnexpectedValueException
     */
    public function testAddInvestment_WithValueGreaterThenCurrentMaxInvestmentValue()
    {
        $tranche = new Tranche(3, 1000);
        $investment = $this->createMock('Investment');

        $investment
            ->method('getValue')
            ->willReturn(1100);

        $investments = $tranche->addInvestment($investment);
    }

    public function testCalculateInterest_ReturnsArrayOfInvestorsNames_WithCalculatedInvestments()
    {
        $tranche = new Tranche(3, 1000);

        $investment1 = $this->createMock('Investment');

        $investment1
            ->method('calculateInterest')
            ->willReturn(['Investor1' =>28.6]);

        $investment2 = $this->createMock('Investment');

        $investment2
            ->method('calculateInterest')
            ->willReturn(['Investor2' =>21.29]);

        $tranche->addInvestment($investment1);
        $tranche->addInvestment($investment2);
        $interests = $tranche->calculateInterests(new DateTime('01-10-2015'), new DateTime('31-10-2015'));

        $expectedInterests = [
            'Investor1' =>28.6,
            'Investor2' =>21.29
        ];

        $this->assertEquals($expectedInterests, $interests);
    }

    public function testCalculateInterest_WithNoInvestments_ReturnsEmptyArray()
    {
        $tranche = new Tranche(3, 1000);

        $interests = $tranche->calculateInterests(new DateTime('01-10-2015'), new DateTime('31-10-2015'));

        $expectedInterests = [

        ];

        $this->assertEquals($expectedInterests, $interests);
    }
}
