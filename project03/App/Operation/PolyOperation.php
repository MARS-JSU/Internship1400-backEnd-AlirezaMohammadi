<?php
namespace App\Operation;

use App\Types\Mono;
use App\Types\Poly;
use App\Operation\MonoOperation;

class PolyOperation
{
    private MonoOperation $monoOperation;

    function __construct()
    {
        $this->monoOperation = new MonoOperation();
    }

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
        $derivativePoly = new Poly();

        foreach ($poly->getMonos() as $mono) {
            $derivativePoly->addMono($this->monoOperation->derivative($mono));
        }

        return $derivativePoly;
    }

    public function sum(Poly $poly1, Poly $poly2) :Poly 
    {
        $newPoly = new Poly([...$poly1->getMonos(), ...$poly2->getMonos()]);

        $newPoly->simplify();
        
        return $newPoly;
    }

    public function sub(Poly $poly1, Poly $poly2) :Poly 
    {        
        $newPoly = new Poly([...$poly1->getMonos(), ...$poly2->getNegative()->getMonos()]);

        $newPoly->simplify();
        
        return $newPoly;
    }

    public function mul(Poly $poly1, Poly $poly2) :Poly 
    {
        $newPoly = new Poly();

        foreach ($poly1->getMonos() as $mono1) {
            foreach ($poly2->getMonos() as $mono2) {
               $newPoly->addMono($this->monoOperation->mul($mono1, $mono2));
            }
        }

        $newPoly->simplify();

        return $newPoly;
    }
}