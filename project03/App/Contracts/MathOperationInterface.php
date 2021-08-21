<?php
namespace App\Contracts;

use App\Contracts\CusotmTypeInterface;

interface MathOperationInterface
{
    public function answerForValue(CusotmTypeInterface $polyOrMono, float $value) :float;
    public function derivative(CusotmTypeInterface $polyOrMono);
    public function sum(CusotmTypeInterface $polyOrMono1, CusotmTypeInterface $polyOrMono2);
    public function sub(CusotmTypeInterface $polyOrMono1, CusotmTypeInterface $polyOrMono2);
    public function mul(CusotmTypeInterface $polyOrMono1, CusotmTypeInterface $polyOrMono2);
}