<?php

namespace App;

use App\Contracts\MustHaveToString;

class Mono implements MustHaveToString
{
    public function __construct(
        private float $coefficient, 
        private float $power
    ) {}

    public function getCoefficient()
    {
        return $this->coefficient;
    }

    public function getPower()
    {
        return $this->power;
    }

    public function toString() :string 
    {
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
}