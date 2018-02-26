<?php

/**
 * Created by PhpStorm.
 * User: dmytro.khara
 * Date: 2018-02-26
 * Time: 14:55
 */

require __DIR__ . "/../../Model/Investor.php";

class InvestorTest extends PHPUnit_Framework_TestCase
{
    public function testGetInvestorName_ReturnsName()
    {
        $investor = new Investor('Investor1');
        $name = $investor->getName();
        $this->assertEquals('Investor1', $name);
    }

    public function testGetInvestorWalletValue_WithNoFounds_Returns0()
    {
        $investor = new Investor('Investor1');
        $value = $investor->getWalletValue();
        $this->assertSame(0, $value);
    }

    public function testGetInvestorWalletValue_WithFounds_ReturnsInvestedAmount()
    {
        $investor = new Investor('Investor1');
        $investor->addFunds(100);
        $value = $investor->getWalletValue();
        $this->assertSame(100, $value);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetInvestorWalletValue_WithInvalidFounds_ThrowsException()
    {
        $investor = new Investor('Investor1');
        $investor->addFunds(100);
    }
}
