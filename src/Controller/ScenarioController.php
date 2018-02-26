<?php
/**
 * Created by PhpStorm.
 * User: dmytro.khara
 * Date: 2018-02-26
 * Time: 21:33
 */

require_once __DIR__ . "/Controller.php";
require_once __DIR__ . "/../Model/Investment.php";
require_once __DIR__ . "/../Model/Investor.php";
require_once __DIR__ . "/../Model/Loan.php";
require_once __DIR__ . "/../Model/Tranche.php";

class ScenarioController extends Controller
{
    public function runScenario()
    {
        $loan = new Loan(new DateTime('01-10-2015'), new DateTime('15-11-2015'));

        $trancheA = new Tranche(3,1000);
        $trancheB = new Tranche(6,1000);

        $loan->addTranche($trancheA);
        $loan->addTranche($trancheB);

        $investor1 = new Investor('Investor1');
        $investor1->addFunds(1000);

        $investor2 = new Investor('Investor2');
        $investor2->addFunds(1000);

        $investor3 = new Investor('Investor3');
        $investor3->addFunds(1000);

        $investor4 = new Investor('Investor4');
        $investor4->addFunds(1000);

        print_r('>>>>Adding Investment for Investor1 to trancheA Value 1000' . PHP_EOL);
        $value = 1000;

        $enoughFunds = false;

        try {
            $enoughFunds = $investor1->withdrawFunds($value);
        } catch (Exception $e) {
            print_r($e->getMessage() . PHP_EOL);
        }

        if($enoughFunds) {
            try {
                $investment = new Investment($investor1, $value, new DateTime('03-10-2015'));
                print_r($trancheA->addInvestment($investment));
            } catch (Exception $e) {
                $investor1->addFunds($value);
                print_r($e->getMessage() . PHP_EOL);
            }
        }
        print_r('<<<<Finished Adding Investment for Investor1 to trancheA Value 1000' . PHP_EOL);

        print_r('>>>>Adding Investment for Investor2 to trancheA Value 1' . PHP_EOL);
        $value = 1;

        $enoughFunds = false;

        try {
            $enoughFunds = $investor2->withdrawFunds($value);
        } catch (Exception $e) {
            print_r($e->getMessage() . PHP_EOL);
        }

        if($enoughFunds) {
            try {
                $investment = new Investment($investor2, $value, new DateTime('04-10-2015'));
                print_r($trancheA->addInvestment($investment));
            } catch (Exception $e) {
                $investor2->addFunds($value);
                print_r($e->getMessage() . PHP_EOL);
            }
        }

        print_r('<<<<Finished Adding Investment for Investor2 to trancheA Value 1' . PHP_EOL);

        print_r('>>>>Adding Investment for Investor3 to trancheB Value 500' . PHP_EOL);
        $value = 500;

        $enoughFunds = false;

        try {
            $enoughFunds = $investor3->withdrawFunds($value);
        } catch (Exception $e) {
            print_r($e->getMessage() . PHP_EOL);
        }

        if($enoughFunds) {
            try {
                $investment = new Investment($investor3, $value, new DateTime('10-10-2015'));
                print_r($trancheB->addInvestment($investment));
            } catch (Exception $e) {
                $investor3->addFunds($value);
                print_r($e->getMessage() . PHP_EOL);
            }
        }

        print_r('<<<<Finished Adding Investment for Investor3 to trancheB Value 500' . PHP_EOL);

        print_r('>>>>Adding Investment for Investor4 to trancheB Value 1100' . PHP_EOL);
        $value = 1100;

        $enoughFunds = false;

        try {
            $enoughFunds = $investor4->withdrawFunds($value);
        } catch (Exception $e) {
            print_r($e->getMessage() . PHP_EOL);
        }

        if($enoughFunds) {
            try {
                $investment = new Investment($investor4, $value, new DateTime('25-10-2015'));
                $trancheB->addInvestment($investment);
            } catch (Exception $e) {
                $investor4->addFunds($value);
                print_r($e->getMessage() . PHP_EOL);
            }
        }
        print_r('<<<<Finished Adding Investment for Investor4 to trancheB Value 1100' . PHP_EOL);

        print_r('>>>>Outputting Total Interests' . PHP_EOL);
        print_r($loan->calculateTotalInterests(new DateTime('01-10-2015'), new DateTime('31-10-2015')));
        print_r('<<<<Finished Outputting Total Interests' . PHP_EOL);
    }
}