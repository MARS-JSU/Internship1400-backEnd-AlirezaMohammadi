<?php

use App\Poly;
use App\Mono;
use App\Processing;
echo '<pre>';


include './vendor/autoload.php';

$pross = (new Processing('2x-3x^5-4x^5-7x+2+6x'))->initialize();
$pross2 = (new Processing('2x-x^5-4x^5-3+7x+2+6x'))->initialize();

$p = new Poly($pross);
$p2 = new Poly($pross2);

$p->makeMonos();
$p2->makeMonos();

echo $p->printPhrase();
echo '<hr>';
echo $p->printDerivativePhrase();
echo '<hr>';
echo $p2->printPhrase();
echo '<hr>';
echo $p2->printDerivativePhrase();
echo '<hr>';

($p->multiplication($p2))->printPhrase();
echo '<hr>';
($p->sum($p2))->printPhrase();
echo '<hr>';
($p->submission($p2))->printPhrase();










echo '</pre>';