<?php
/**
 * Created by PhpStorm.
 * User: dmytro.khara
 * Date: 2018-02-26
 * Time: 14:52
 */


require __DIR__ . "/Model.php";

class Investor extends Model
{
    private $name;
    private $walletValue = 0;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getWalletValue()
    {
        return $this->walletValue;
    }

    public function addFunds($funds)
    {
        return true;
    }
}