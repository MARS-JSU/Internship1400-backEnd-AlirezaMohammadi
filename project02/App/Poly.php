<?php

namespace App;

use App\Mono;

class Poly{
    
    private array $poly;
    private array $monos;
    private float $solve;

    public function __construct(array $poly = []) {
        $this->setPoly($poly);
        $this->setSolve(0);
    }

    public function makeMonos() {
        $this->splitToMakeArray();
        $this->simplify();
        $this->Ordering();

        foreach ($this->getPoly() as $mono) {
            $this->monos[] = new Mono($mono[0],$mono[1]);
        }
    }

    public function splitToMakeArray() {
        foreach ($this->getPoly() as $index => $mono) {
            $this->poly[$index] = explode('x^', $mono);
            $this->poly[$index][0] = floatval($this->poly[$index][0]);
            $this->poly[$index][1] = floatval($this->poly[$index][1]);
        }
    }

    public function simplify() {

        foreach ($this->getPoly() as $index1 => $mono1) {
            foreach ($this->poly as $index2 => $mono2) {
                if ($index1 < $index2 && $mono1[1] == $mono2[1]) {
                    $this->poly[$index1][0] += $mono2[0];
                    $this->poly[$index2][1]='invalid';
                }
            }
        }
        foreach ($this->getPoly() as $index => $mono) {
            if ($mono[1]=='invalid') {
                unset($this->poly[$index]);
            }
        }

        $this->setPoly(array_values($this->getPoly()));
    }

    public function Ordering() {
        foreach ($this->poly as $key => &$m) {
            foreach ($this->poly as $key2 => &$m2) {
                if ($key2 > $key && $m[1] < $m2[1]) {
                    $temp = $m;
                    $m = $m2;
                    $m2 = $temp;
                }
            }
        }
    }

    public function printPhrase() {
        
        $s = 0;
        foreach ($this->getMonos() as $mono) {
            $s += $mono->printPhrase();
        }
       
        if($s == 0){
            echo 0;
        }
    }
    
    public function printDerivativePhrase() {
        
        $s =0;
        foreach ($this->getMonos() as $mono) {
            $s+=$mono->printDerivativePhrase();
        }
       
        if($s == 0){
            echo 0;
        }
    }
    
    public function solve(float|int $n) {
        foreach ($this->monos as $mono) {
            $this->solve += $mono->solve($n);
        }
        return $this->solve;
    }

    public function sum(Poly $poly) {
        $newPoly = new Poly();

        foreach ($this->monos as &$mono1) {
            foreach ($poly->monos as &$mono2) {
                if($mono1->getPower() == $mono2->getPower()){
                    $newPoly->poly[] = $mono1->sum($mono2);
                    $mono1->setSent(true);
                    $mono2->setSent(true);
                }
            }
        }

        foreach ($this->monos as $mono) {
            if(!$mono->getSent()){
                $newPoly->poly[] = $mono->coefficient.'x^'.$mono->power;                
            }
        }

        foreach ($poly->getMonos() as $mono) {
            if(!$mono->getSent()){
                $newPoly->poly[] = $mono->coefficient.'x^'.$mono->power;                
            }
        }

        $newPoly->makeMonos();
        
        return $newPoly;
    }

    public function submission(Poly $poly) {
        
        $newPoly = new Poly();

        foreach ($this->getMonos() as &$mono1) {
            foreach ($poly->getMonos() as &$mono2) {
                if($mono1->getPower() == $mono2->getPower()){
                    $newPoly->poly[] = $mono1->submission($mono2);
                    $mono1->setSent(true);
                    $mono2->setSent(true);
                }
            }
        }

        foreach ($this->getMonos() as $mono) {
            if(!$mono->getSent()){
                $newPoly->poly[] = $mono->coefficient.'x^'.$mono->power;                
            }
        }

        foreach ($poly->getMonos() as $mono) {
            if(!$mono->getSent()){
                $newPoly->poly[] = (-1*$mono->coefficient).'x^'.$mono->power;                
            }
        }

        $newPoly->makeMonos();
        
        return $newPoly;
    }

    public function multiplication(Poly $poly) {
        
        $newPoly = new Poly();
        
        foreach ($this->getMonos() as $mono1) {
            foreach ($poly->getMonos() as $mono2) {
               $newPoly->poly[] = $mono1->multiplication($mono2);
            }
        }

        $newPoly->makeMonos();

        return $newPoly;
    }

    public function getPoly() {
        return $this->poly;
    }

    public function setPoly($poly) {
        $this->poly = $poly;

        return $this;
    }

    public function getMonos() {
        return $this->monos;
    }

    public function setMonos($monos) {
        $this->monos = $monos;

        return $this;
    }

    public function getSolve() {
        return $this->solve;
    }

    public function setSolve(float $solve) {
        $this->solve = $solve;
    }
}