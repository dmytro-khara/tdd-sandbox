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
    public function testCreateInvestor_WithName_ReturnsTrue()
    {
        $investor = new Investor('Investor1');
        $this->assertTrue($investor);
    }
}
