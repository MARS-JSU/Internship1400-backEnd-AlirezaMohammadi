<?php
namespace App\Contracts;

use App\Contracts\CusotmType;

interface MathOperations
{
    public function answerForValue(CusotmType $polyOrMono, float $value) :float;
    public function derivative(CusotmType $polyOrMono);
    public function sum(CusotmType $polyOrMono1, CusotmType $polyOrMono2);
    public function sub(CusotmType $polyOrMono1, CusotmType $polyOrMono2);
    public function mul(CusotmType $polyOrMono1, CusotmType $polyOrMono2);
}