<?php
namespace App;

use App\Mono;
use App\Poly;
use App\Contracts\MathOperation;

class Math implements MathOperation
{
    function __construct(
        private Poly $poly
    ){}

    public function answerForValue(Poly $poly, float $value) :float 
    {   
        $answer = 0;
        foreach ($poly->getMonos() as $mono) {
            $answer += $this->answerForValueMono($mono, $value);
        }
        return $answer;
    }

    public function answerForValueMono(Mono $mono, float $value) :float 
    {
        return $mono->getCoefficient() * ($value ** $mono->getPower());
    }

    public function derivative(Poly $poly) :Poly 
    {
        $this->poly->empty();

        foreach ($poly->getMonos() as $mono) {
            $this->poly->addMono($this->derivativeMono($mono));
        }
    
        return $this->poly;
    }
    
    public function derivativeMono(Mono $mono) :Mono 
    {
        $coefficient = $mono->getCoefficient() * $mono->getPower();
        $power = $mono->getPower() - 1;

        return (new Mono($coefficient, $power));
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
        
        return $this->poly;
    }

    public function submission(Poly $poly1, Poly $poly2) :Poly 
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
        
        return $this->poly;
    }

    public function multiplication(Poly $poly1, Poly $poly2) :Poly 
    {        
        $this->poly->empty();

        foreach ($poly1->getMonos() as $mono1) {
            foreach ($poly2->getMonos() as $mono2) {
               $this->poly->addMono($this->multiplicationMono($mono1, $mono2));
            }
        }

        $this->poly->simplify();
        $this->poly->ordering();

        return $this->poly;
    }

    public function multiplicationMono(Mono $mono1, Mono $mono2) :Mono 
    {
        $coefficient = $mono1->getCoefficient() * $mono2->getCoefficient();
        $power = $mono1->getPower() + $mono2->getPower();
         
        return new Mono($coefficient, $power);
    }
}