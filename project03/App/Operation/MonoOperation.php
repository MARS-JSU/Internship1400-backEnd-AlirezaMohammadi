<?php
namespace App\Operation;

use App\Types\Mono;

class MonoOperation
{
    public function answerForValue(Mono $mono, float $value) :float 
    {   
        return $mono->getCoefficient() * ($value ** $mono->getPower());
    }
    
    public function derivative(Mono $mono) :Mono 
    {
        $coefficient = $mono->getCoefficient() * $mono->getPower();
        $power = $mono->getPower() - 1;

        return (new Mono($coefficient, $power));
    }

    public function mul(Mono $mono1, Mono $mono2) :Mono 
    {     
        $coefficient = $mono1->getCoefficient() * $mono2->getCoefficient();
        $power = $mono1->getPower() + $mono2->getPower();
         
        return new Mono($coefficient, $power);
    }
}