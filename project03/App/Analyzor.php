<?php
namespace App;

use App\Mono;
use App\Poly;
use App\MyString;

class Analyzor {
    public function __construct(
        private Poly $poly,
        private MyString $myString,
        private array $strings = []
    ) {}
    
    public function getPolyFromText(string $inputText) :Poly 
    {
        $text = $this->myString->rebuild($inputText);

        $this->explodeFromSpace($text);
        $this->repairPowers();
        
        $this->poly->makePoly($this->buildMonos());
        $this->poly->simplify();
        $this->poly->ordering();

        return $this->poly;
    }

    private function explodeFromSpace($text) 
    {
        $this->strings = explode(' ', $text);
        unset($this->strings[0]);
        $this->strings = array_values($this->strings); 
    }

    private function repairPowers() 
    {
        foreach ($this->strings as $key => $mono) {
            if (
                strpos($mono, 'x') && 
                !strpos($mono, '^')
            ) {
                $this->strings[$key] = $mono . '^1';
            } elseif (!strpos($mono, 'x')) {
                $this->strings[$key] = $mono . 'x^0';
            }
        }
    } 

    private function buildMonos()
    {
        $temps = [];
        foreach ($this->strings as $string) {
            array_push($temps, explode('x^',$string));
        }
        
        $monos = [];
        foreach ($temps as $temp) {
            array_push($monos, new Mono($temp[0], $temp[1]));
        }

        return $monos;
    }
}