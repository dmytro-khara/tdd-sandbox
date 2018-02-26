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

    public function testCalculateTotalInterests_ReturnsArray_WithTotalInterestPerInvestor()
    {
        $loan = new Loan(new DateTime('01-10-2015'), new DateTime('15-11-2015'));
        $tranche1 = $this->createMock('Tranche');

        $tranche1
            ->method('calculateInterests')
            ->willReturn([['Investor1' =>50], ['Investor2' =>150]]);

        $tranche2 = $this->createMock('Tranche');

        $tranche2
            ->method('calculateInterests')
            ->willReturn([['Investor1' =>50], ['Investor3' =>200]]);

        $loan->addTranche($tranche1);
        $loan->addTranche($tranche2);
        $interests = $loan->calculateTotalInterests(new DateTime('01-10-2015'), new DateTime('31-10-2015'));

        $expectedInterests = [
            ['Investor1' =>100],
            ['Investor2' =>150],
            ['Investor3' =>200]
        ];

        $this->assertEquals($expectedInterests, $interests);
    }
}