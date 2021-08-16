<?php
namespace App\Contracts;

use App\Mono;
use App\Poly;

interface MathOperation
{
    public function answerForValue(Poly $poly, float $value) :float;
    public function derivative(Poly $poly) :Poly;
    public function sum(Poly $poly1, Poly $poly2) :Poly;
    public function submission(Poly $poly1, Poly $poly2) :Poly;
    public function multiplicationMono(Mono $mono1, Mono $mono2) :Mono;
}