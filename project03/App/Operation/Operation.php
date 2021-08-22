<?php
namespace App\Operation;

use App\Contracts\CusotmTypeInterface;
use App\Contracts\MathOperationInterface;
use Exception;

class Operation implements MathOperationInterface
{
    private PolyOperation $polyOperation;
    private MonoOperation $monoOperation;

    function __construct()
    {
        $this->polyOperation = new PolyOperation();
        $this->monoOperation = new MonoOperation();
    }

    public function answerForValue(CusotmTypeInterface $cusotmTypeInterface, float $value) :float 
    {
        if($cusotmTypeInterface::class == 'App\Types\Poly'){
            return $this->polyOperation->answerForValue($cusotmTypeInterface, $value);
        }
        return $this->monoOperation->answerForValue($cusotmTypeInterface, $value);
    }

    public function derivative(CusotmTypeInterface $cusotmTypeInterface) :CusotmTypeInterface
    {
        if($cusotmTypeInterface::class == 'App\Types\Poly'){
            return $this->polyOperation->derivative($cusotmTypeInterface);
        }
        return $this->monoOperation->derivative($cusotmTypeInterface);
    }
    
    public function sum(CusotmTypeInterface $cusotmTypeInterface1, CusotmTypeInterface $cusotmTypeInterface2) :CusotmTypeInterface 
    {
        if($cusotmTypeInterface1::class != $cusotmTypeInterface2::class) {
            throw new Exception('invalid arguments type');
        }
        if($cusotmTypeInterface1::class == 'App\Types\Poly'){
            return $this->polyOperation->sum($cusotmTypeInterface1, $cusotmTypeInterface2);
        }
    }

    public function sub(CusotmTypeInterface $cusotmTypeInterface1, CusotmTypeInterface $cusotmTypeInterface2) :CusotmTypeInterface 
    {
        if($cusotmTypeInterface1::class != $cusotmTypeInterface2::class) {
            throw new Exception('invalid arguments type');
        }
        if($cusotmTypeInterface1::class == 'App\Types\Poly'){
            return $this->polyOperation->sub($cusotmTypeInterface1, $cusotmTypeInterface2);
        }
    }

    public function mul(CusotmTypeInterface $cusotmTypeInterface1, CusotmTypeInterface $cusotmTypeInterface2) :CusotmTypeInterface 
    {        
        if($cusotmTypeInterface1::class != $cusotmTypeInterface2::class) {
            throw new Exception('invalid arguments type');
        }
        if($cusotmTypeInterface1::class == 'App\Types\Poly'){
            return $this->polyOperation->mul($cusotmTypeInterface1, $cusotmTypeInterface2);
        }
        return $this->monoOperation->mul($cusotmTypeInterface1, $cusotmTypeInterface2);
    }
}