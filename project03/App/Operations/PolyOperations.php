<?php
namespace App\Operations;

use App\Types\Poly;
use App\Types\Mono;

class PolyOperations
{
    function __construct(
        private Poly $poly,
        private MonoOperations $monoOperations
    ){}

    public function answerForValue(Poly $poly, float $value) :float 
    {  
        $answer = 0;
        foreach ($poly->getMonos() as $mono) {
            $answer += $this->monoOperations->answerForValue($mono, $value);
        }
        return $answer;    
    }

    public function derivative(Poly $poly) :Poly 
    {
        $this->poly->empty();
        foreach ($poly->getMonos() as $mono) {
            $this->poly->addMono($this->monoOperations->derivative($mono));
        }
        return clone $this->poly;
    }

    public function sum(Poly $poly1, Poly $poly2) :Poly 
    {
        $this->poly->empty();

        foreach ($poly1->getMonos() as $mono) {
            $this->poly->addMono($mono);                  
        }

        foreach ($poly2->getMonos() as $mono) {
            $this->poly->addMono($mono);                  
        }

        $this->poly->simplify();
        $this->poly->ordering();
        
        return clone $this->poly;
    }

    public function sub(Poly $poly1, Poly $poly2) :Poly 
    {
        $this->poly->empty();

        foreach ($poly1->getMonos() as $mono) {
            $this->poly->addMono($mono);                  
        }
        
        foreach ($poly2->getMonos() as $mono) {
            $newMono = new Mono(-1 * $mono->getCoefficient(),$mono->getPower());
            $this->poly->addMono($newMono);                  
        }

        $this->poly->simplify();
        $this->poly->ordering();
        
        return clone $this->poly;
    }

    public function mul(Poly $poly1, Poly $poly2) :Poly 
    {
        $this->poly->empty();

        foreach ($poly1->getMonos() as $mono1) {
            foreach ($poly2->getMonos() as $mono2) {
               $this->poly->addMono($this->monoOperations->mul($mono1, $mono2));
            }
        }

        $this->poly->simplify();
        $this->poly->ordering();

        return clone $this->poly;
    }
}