<?php

namespace App;

class Mono {

    private $coefficient;
    private $power;
    private $derivativeCoefficient;
    private $derivativePower;
    private $sent;

    public function getCoefficient() {
        return $this->coefficient;
    }

    public function setCoefficient($coefficient) {
        $this->coefficient = $coefficient;
    }

    public function getPower() {
        return $this->power;
    }

    public function setPower($power) {
        $this->power = $power;
    }

    public function getDerivativeCoefficient() {
        return $this->derivativeCoefficient;
    }

    public function setDerivativeCoefficient($derivativeCoefficient) {
        $this->derivativeCoefficient = $derivativeCoefficient;
    }

    public function getDerivativePower() {
        return $this->derivativePower;
    }

    public function setDerivativePower($derivativePower) {
        $this->derivativePower = $derivativePower;
    }

    public function setSent(bool $sent){
        $this->sent = $sent;
    }

    public function getSent() {
        return $this->sent;
    }

    public function __construct(float $coefficient, float $power) {
        $this->setCoefficient($coefficient);
        $this->setPower($power);

        $this->setDerivativeCoefficient($this->getCoefficient() * $this->getPower());
        $this->setDerivativePower($this->getPower() - 1);

        $this->setSent(false);
    }

    public function printPhrase() {
        $coefficient = $this->coefficient;
        $power = $this->power;

        if ($coefficient == 1) {
            echo '+';
            if($power == 0){
                echo 1;
                return 1;
            }else if ($power == 1) {
                echo 'x';
                return 1;
            } elseif ($power > 1) {
                echo 'x^' . $power;
                return 1;
            }
        } elseif ($coefficient == -1) {
            echo '-';
            if($power == 0){
                echo 1;
                return 1;
            }else if ($power == 1) {
                echo 'x';
                return 1;
            } elseif ($power > 1) {
                echo 'x^' . $power;
                return 1;
            }
        } elseif ($coefficient < 0) {
            echo $coefficient;
            if ($power == 1) {
                echo 'x';
                return 1;
            } elseif ($power > 1) {
                echo 'x^' . $power;
                return 1;
            }
        } elseif ($coefficient > 0) {
            echo '+' . $coefficient;
            if ($power == 1) {
                echo 'x';
                return 1;
            } elseif ($power > 1) {
                echo 'x^' . $power;
                return 1;
            }
        }
        return 0;
    }

    public function printDerivativePhrase() {
        $coefficient = $this->derivativeCoefficient;
        $power = $this->derivativePower;

        if ($coefficient == 1) {
            echo '+';
            if($power == 0){
                echo 1;
                return 1;
            }else if ($power == 1) {
                echo 'x';
                return 1;
            } elseif ($power > 1) {
                echo 'x^' . $power;
                return 1;
            }
        } elseif ($coefficient == -1) {
            echo '-';
            if ($power == 1) {
                echo 'x';
                return 1;
            } elseif ($power > 1) {
                echo 'x^' . $power;
                return 1;
            }
        } elseif ($coefficient < 0) {
            echo $coefficient;
            if ($power == 1) {
                echo 'x';
                return 1;
            } elseif ($power > 1) {
                echo 'x^' . $power;
                return 1;
            }
        } elseif ($coefficient > 0) {
            echo '+' . $coefficient;
            if ($power == 1) {
                echo 'x';
                return 1;
            } elseif ($power > 1) {
                echo 'x^' . $power;
                return 1;
            }
        }
        return 0;
    }

    public function solve($n) {
        return $this->coefficient * $n ** $this->power;
    }

    public function sum(Mono $a) {
        $coefficient = floatval($a->coefficient) + floatval($this->coefficient);
        $power = floatval($this->power);
        
        return $coefficient.'x^'.$power;
    }

    public function submission(Mono $a) {
        $coefficient = floatval($this->coefficient) - floatval($a->coefficient);
        $power = floatval($this->power);
        
        return $coefficient.'x^'.$power;
    }

    public function multiplication(Mono $a) {
        $coefficient = floatval($a->getCoefficient()) * floatval($this->getCoefficient());
        $power = floatval($a->getPower()) + floatval($this->getPower());
        
        return $coefficient.'x^'.$power;
    }

}