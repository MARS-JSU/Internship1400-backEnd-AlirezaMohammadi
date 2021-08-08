<?php

namespace App;

class Mono {

    private float $coefficient;
    private float $power;
    private bool $sent;

    public function getCoefficient() :float {
        return $this->coefficient;
    }

    public function setCoefficient($coefficient) :void {
        $this->coefficient = $coefficient;
    }

    public function getPower() :float {
        return $this->power;
    }

    public function setPower($power) :void {
        $this->power = $power;
    }

    public function setSent(bool $sent):void {
        $this->sent = $sent;
    }

    public function getSent():bool {
        return $this->sent;
    }

    public function __construct(float $coefficient, float $power) {
        $this->setCoefficient($coefficient);
        $this->setPower($power);
        $this->setSent(false);
    }

    public function toString() :string {
        $coefficient = $this->coefficient;
        $power = $this->power;

        $answer = '';

        if ($coefficient == 1) {
            $answer .= '+';
            if($power == 0){
                $answer .= '1';
            }else if ($power == 1) {
                $answer .= 'x';
            } elseif ($power > 1) {
                $answer .= 'x^' . "$power";
            }
        } elseif ($coefficient == -1) {
            $answer .= '-';
            if($power == 0){
                $answer .= 1;
            }else if ($power == 1) {
                $answer .= 'x';
            } elseif ($power > 1) {
                $answer .= 'x^' . "$power";
            }
        } elseif ($coefficient < 0) {
            $answer .= "$coefficient";
            if ($power == 1) {
                $answer .= 'x';
            } elseif ($power > 1) {
                $answer .= 'x^' . "$power";
            }
        } elseif ($coefficient > 0) {
            $answer .= '+' . "$coefficient";
            if ($power == 1) {
                $answer .= 'x';
            } elseif ($power > 1) {
                $answer .= 'x^' . "$power";
            }
        }

        return $answer;
    }

    public function derivative() :Mono {
        $coefficient = $this->coefficient * $this->power;
        $power = $this->power - 1;

        return (new Mono($coefficient, $power));
    }

    public function answerForValue(float $value) :float {
        return $this->coefficient * ($value ** $this->power);
    }

    public function sum(Mono $a) :string {
        $coefficient = $a->getCoefficient() + $this->getCoefficient();
        $power = $this->getPower();
        
        return $coefficient.'x^'.$power;
    }

    public function submission(Mono $a) :string {
        $coefficient = $this->getCoefficient() - $a->getCoefficient();
        $power = $this->getPower();
        
        return $coefficient.'x^'.$power;
    }

    public function multiplication(Mono $a) :string {
       $coefficient = $a->getCoefficient() * $this->getCoefficient();
       $power = $a->getPower() + $this->getPower();
        
       return $coefficient.'x^'.$power;
    }
}