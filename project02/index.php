<?php

use App\Poly;
use App\Mono;
use App\Analysing;


include './vendor/autoload.php';

$p = (new Analysing('2x-3x^5-4x^5-7x+2+6x'))->getPoly();
$p2 = (new Analysing('2x-x^5-4x^5-3+7x+2+6x'))->getPoly();

$n = 2;

echo 'first equation: ' . $p->toString();
echo '<br>';
echo "answer for ($n): " . $p->answerForValue($n);
echo '<br>';
echo 'first derivative: ' . ($p->derivative())->toString();
echo '<hr>';
echo 'second equation: ' . $p2->toString();
echo '<br>';
echo "answer for ($n): " . $p2->answerForValue($n);
echo '<br>';
echo 'second derivative: ' . ($p2->derivative())->toString();

echo '<hr>';

echo 'multiplication: ' . ($p->multiplication($p2))->toString();
echo '<br>';
echo 'sum: ' . ($p->sum($p2))->toString();
echo '<br>';
echo 'submission: ' . ($p->submission($p2))->toString();