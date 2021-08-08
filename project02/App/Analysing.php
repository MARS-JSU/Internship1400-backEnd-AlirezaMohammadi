<?php
namespace App;

use App\Poly;

class Analysing {

    private string $inputText;
    private array $strings;
    private Poly $poly;

    public function __construct(string $inputText) {
        $this->setInputText($inputText);
        $this->start();
    }

    public function getInputText() {
        return $this->inputText;
    }

    public function setInputText(string $inputText) {
        $this->inputText = $inputText;
    }
    
    public function getStrings() {
        return $this->strings;
    }

    public function setStrings(array $strings) {
        $this->strings = $strings;
    }

    public function getPoly() {
        return $this->poly;
    }

    public function setPoly(Poly $poly) {
        $this->poly = $poly;
    }

    public function start() {
        $this->checkFirstOfString();
        $this->makeSpace();
        $this->makeCoefficientOne();
        $this->explodeFromSpace();
        $this->prepareMono();

        // var_dump($this->getStrings());
        // die();

        $this->setPoly(new Poly($this->getStrings()));
        $this->poly->makeMonos();
    }

    public function checkFirstOfString() {
        if ($this->getInputText()[0] != '-' 
            && $this->getInputText()[0] != '+') 
            $this->setInputText('+' . $this->getInputText());
        
    }

    public function makeSpace() {
        $this->setInputText(str_replace(['-', '+'], [' -', ' +'], $this->getInputText()));
    }

    public function makeCoefficientOne() {
        $this->setInputText(str_replace(['-x', '+x'], ['-1x', '+1x'], $this->getInputText()));
    }

    public function explodeFromSpace() {
        $this->setStrings(explode(' ', $this->getInputText()));
        unset($this->strings[0]);
        $this->setStrings(array_values($this->strings)); 
    }

    public function prepareMono() {
        foreach ($this->getStrings() as $key => $mono) {
            if (strpos($mono, 'x') && !strpos($mono, '^')) {
                $this->strings[$key] = $mono . '^1';
            } elseif (!strpos($mono, 'x')) {
                $this->strings[$key] = $mono . 'x^0';
            }
        }
    } 
}