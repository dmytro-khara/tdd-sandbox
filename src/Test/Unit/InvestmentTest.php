<?php

/**
 * Created by PhpStorm.
 * User: dmytro.khara
 * Date: 2018-02-26
 * Time: 14:55
 */

require __DIR__ . "/../../Model/Investment.php";

class InvestmentTest extends PHPUnit_Framework_TestCase
{
    public function testGetInvestmentValue_ReturnsInvestedAmount()
    {
        $investor = '';
        $investment = new Investment($investor, 100, new DateTime());
        $value = $investment->getValue();
        $this->assertSame(100, $value);
    }
}
