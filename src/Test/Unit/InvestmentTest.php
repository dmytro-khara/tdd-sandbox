<?php

/**
 * Created by PhpStorm.
 * User: dmytro.khara
 * Date: 2018-02-26
 * Time: 14:55
 */

require __DIR__ . "/../../Model/Investor.php";
require __DIR__ . "/../../Model/Investment.php";

class InvestmentTest extends PHPUnit_Framework_TestCase
{
    public function testGetInvestmentValue_ReturnsInvestedAmount()
    {
        $investor = $this->createMock('Investor');
        $investment = new Investment($investor, 100, new DateTime());
        $value = $investment->getValue();
        $this->assertSame(100, $value);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetInvestmentValue_WithInvalidValue_ThrowsException()
    {
        $investor = $this->createMock('Investor');
        $investment = new Investment($investor, -100, new DateTime());
    }

    public function testGetInvestmentValue_AfterAddingMoreValue_ReturnsSumInvestedAmount()
    {
        $investor = $this->createMock('Investor');
        $investment = new Investment($investor, 100, new DateTime());
        $investment->addValue(50);
        $value = $investment->getValue();
        $this->assertSame(150, $value);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetInvestmentValue_AfterAddingMoreValue_WithInvalidValue_ReturnsSumInvestedAmount()
    {
        $investor = $this->createMock('Investor');
        $investment = new Investment($investor, 100, new DateTime());
        $investment->addValue(-50);
    }

    /*
     * interest formula InvestmentValue * InterestRate/100 * NumberOfDaysOfActiveInvestment / NumberOfDaysInMonth
     */
    public function testCalculateInterest_ReturnsArrayOfInvestorsNameAsKey_WithCalculatedInvestments()
    {
        $investor = $this->createMock('Investor');

        $investor
            ->method('getName')
            ->willReturn('Investor1');

        $investment = new Investment($investor, 1000, new DateTime('03-10-2015'));
        $value = $investment->calculateInterest(3, new DateTime('01-10-2015'), new DateTime('31-10-2015'));
        $this->assertSame(['Investor1' => 28.06], $value);
    }
}
