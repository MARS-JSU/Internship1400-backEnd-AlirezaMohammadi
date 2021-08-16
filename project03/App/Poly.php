<?php

namespace App;

use App\Contracts\MustHaveToString;
use App\Mono;

class Poly implements MustHaveToString
{
    function __construct(
        private array $monos = []
    ) {}

    public function getMonos()
    {
        return $this->monos;
    }
    
    public function addMono(Mono $mono)
    {
        array_push($this->monos, $mono);
    }

    public function makePoly(array $monos)
    {
        foreach ($monos as $mono) {
            $this->addMono($mono);
        }
    }
    
    public function simplify() 
    {
        $indexes = $this->increaseFirstCoefficientOfSamePowers();

        $this->deleteSamePowersExceptFirst($indexes);
    }

    private function increaseFirstCoefficientOfSamePowers() :array
    {
        $indexes = [];
        foreach ($this->monos as $index1 => &$mono1) {
            foreach ($this->monos as $index2 => &$mono2) {
                if (
                    !in_array($index1, $indexes) &&
                    !in_array($index2, $indexes) &&
                    $index1 < $index2 && 
                    $mono1->getPower() == $mono2->getPower()
                ){

                    $newCoefficient = $mono1->getCoefficient() + $mono2->getCoefficient();
                    $newMono = new Mono($newCoefficient, $mono1->getPower());
                    
                    $this->monos[$index1] = $newMono;

                    $indexes[] = $index2;
                }
            }
        }
        return $indexes;
    }

    private function deleteSamePowersExceptFirst(array $indexes)
    {
        foreach ($this->monos as $index => $mono) {
            if (in_array($index, $indexes)) {
                unset($this->monos[$index]);
            }
        }
        
        $this->monos = array_values($this->monos);
    }

    public function ordering() 
    {
        foreach ($this->monos as $index1 => &$mono1) {
            foreach ($this->monos as $index2 => &$mono2) {
                if ($index1 < $index2 && 
                    $mono1->getPower() < $mono2->getPower()) {

                    $temp = $this->monos[$index1];
                    $this->monos[$index1] = $this->monos[$index2];
                    $this->monos[$index2] = $temp;
                }
            }
        }
        // var_dump($this->monos);
    }

    public function toString() :string 
    {
        
        $polyString = '';

        foreach ($this->monos as $mono) {
            $polyString .= $mono->toString();
        }
       
        return ($polyString) ? $polyString : '0' ;

    }

    public function empty()
    {
        foreach ($this->monos as $key => $mono) {
            unset($this->monos[$key]);
        }
    }
}