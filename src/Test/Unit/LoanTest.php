<?php

/**
 * Created by PhpStorm.
 * User: dmytro.khara
 * Date: 2018-02-26
 * Time: 14:53
 */

require __DIR__ . "/../../Model/Loan.php";
require __DIR__ . "/../../Model/Tranche.php";

class LoanTest extends PHPUnit_Framework_TestCase
{
    public function testAddTranche_ReturnsArray_WithAddedTranche()
    {
        $loan = new Loan(new DateTime('01-10-2015'), new DateTime('15-11-2015'));
        $tranche = $this->createMock('Tranche');
        $tranches = $loan->addTranche($tranche);
        $this->assertContains($tranche, $tranches);
    }
}