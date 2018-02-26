<?php
/**
 * Created by PhpStorm.
 * User: dmytro.khara
 * Date: 2018-02-26
 * Time: 14:52
 */


require_once __DIR__ . "/Model.php";

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
        if(filter_var($funds, FILTER_VALIDATE_FLOAT) && $funds > 0) {
            $this->walletValue += $funds;
            return true;
        } else {
            throw new InvalidArgumentException('Funds should be positive float');
        }

    }

    public function withdrawFunds($funds)
    {
        if(filter_var($funds, FILTER_VALIDATE_FLOAT) && $funds > 0) {
            if($this->walletValue >= $funds) {
                $this->walletValue -= $funds;
                return true;
            } else {
                throw new UnexpectedValueException('Wallet Value is insufficient. Current remaining value is ' . $this->walletValue);
            }
        } else {
            throw new InvalidArgumentException('Funds should be positive float');
        }
    }
}