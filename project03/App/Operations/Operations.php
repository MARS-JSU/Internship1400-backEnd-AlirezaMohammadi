<?php
namespace App\Operations;

use App\Contracts\CusotmType;
use App\Contracts\MathOperations;
use Exception;

class Operations implements MathOperations
{
    function __construct(
        private CusotmType $cusotmType,
        private PolyOperations $polyOperations,
        private MonoOperations $monoOperations,
    ){}

    public function answerForValue(CusotmType $cusotmType, float $value) :float 
    {  
        if($cusotmType::class == 'App\Types\Poly'){
            return $this->polyOperations->answerForValue($cusotmType, $value);
        }
        return $this->monoOperations->answerForValue($cusotmType, $value);
    }

    public function derivative(CusotmType $cusotmType) :CusotmType
    {
        if($cusotmType::class == 'App\Types\Poly'){
            return $this->polyOperations->derivative($cusotmType);
        }
        return $this->monoOperations->derivative($cusotmType);
    }
    
    public function sum(CusotmType $cusotmType1, CusotmType $cusotmType2) :CusotmType 
    {
        if($cusotmType1::class != $cusotmType2::class) {
            throw new Exception('invalid arguments type');
        }
        if($cusotmType1::class == 'App\Types\Poly'){
            return $this->polyOperations->sum($cusotmType1, $cusotmType2);
        }
    }

    public function sub(CusotmType $cusotmType1, CusotmType $cusotmType2) :CusotmType 
    {
        if($cusotmType1::class != $cusotmType2::class) {
            throw new Exception('invalid arguments type');
        }
        if($cusotmType1::class == 'App\Types\Poly'){
            return $this->polyOperations->sub($cusotmType1, $cusotmType2);
        }
    }

    public function mul(CusotmType $cusotmType1, CusotmType $cusotmType2) :CusotmType 
    {        
        if($cusotmType1::class != $cusotmType2::class) {
            throw new Exception('invalid arguments type');
        }
        if($cusotmType1::class == 'App\Types\Poly'){
            return $this->polyOperations->mul($cusotmType1, $cusotmType2);
        }
        return $this->monoOperations->mul($cusotmType1, $cusotmType2);
    }
}