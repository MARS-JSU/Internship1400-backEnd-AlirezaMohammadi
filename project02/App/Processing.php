<?php
namespace App;

class Processing {

    private $string;
    
    public function __construct($string) {
        $this->setString($string);
    }
    
    public function getString() {
        return $this->string;
    }

    public function setString($string) {
        $this->string = $string;
    }

    public function initialize() {
        $this->checkFirstOfString();
        $this->makeSpace();
        $this->makeCoefficientOne();
        $this->explodeFromSpace();
        $this->prepareMono();
        
        return $this->getString();
    }

    public function checkFirstOfString() {
        if ($this->getString()[0] != '-' 
            && $this->getString()[0] != '+') 
            $this->setString('+' . $this->string);
        
    }

    public function makeSpace() {
        $this->setString(str_replace(['-', '+'], [' -', ' +'], $this->getString()));
    }

    public function makeCoefficientOne() {
        $this->setString(str_replace(['-x', '+x'], ['-1x', '+1x'], $this->getString()));
    }

    public function explodeFromSpace() {
        $this->setString(explode(' ', $this->string));
        unset($this->string[0]);
        $this->setString(array_values($this->string)); 
    }

    public function prepareMono() {
        foreach ($this->getString() as $key => $mono) {
            if (strpos($mono, 'x') && !strpos($mono, '^')) {
                $this->string[$key] = $mono . '^1';
            } elseif (!strpos($mono, 'x')) {
                $this->string[$key] = $mono . 'x^0';
            }
        }
    }

}