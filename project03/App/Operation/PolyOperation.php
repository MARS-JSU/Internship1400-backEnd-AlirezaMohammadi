<?php
namespace App\Operation;

use App\Types\Mono;
use App\Types\Poly;
use App\Operation\MonoOperation;

class PolyOperation
{
    function __construct(
        private Poly $poly,
        private MonoOperation $monoOperation
    ){}

    public function answerForValue(Poly $poly, float $value) :float 
    {  
        $answer = 0;
        foreach ($poly->getMonos() as $mono) {
            $answer += $this->monoOperation->answerForValue($mono, $value);
        }
        return $answer;    
    }

    public function derivative(Poly $poly) :Poly 
    {
        $this->poly->setMonos([]);

        foreach ($poly->getMonos() as $mono) {
            $this->poly->addMono($this->monoOperation->derivative($mono));
        }

        return clone $this->poly;
    }

    public function sum(Poly $poly1, Poly $poly2) :Poly 
    {
        $newMonos = [...$poly1->getMonos(), ...$poly2->getMonos()];               
        
        $this->poly->setMonos($newMonos);

        $this->poly->simplify();
        $this->poly->ordering();
        
        return clone $this->poly;
    }

    public function sub(Poly $poly1, Poly $poly2) :Poly 
    {        
        $newMonos = [...$poly1->getMonos(), ...$poly2->getNegative()->getMonos()];                

        $this->poly->setMonos($newMonos);

        $this->poly->simplify();
        $this->poly->ordering();
        
        return clone $this->poly;
    }

    public function mul(Poly $poly1, Poly $poly2) :Poly 
    {
        $this->poly->setMonos([]);

        foreach ($poly1->getMonos() as $mono1) {
            foreach ($poly2->getMonos() as $mono2) {
               $this->poly->addMono($this->monoOperation->mul($mono1, $mono2));
            }
        }

        $this->poly->simplify();
        $this->poly->ordering();

        return clone $this->poly;
    }
}