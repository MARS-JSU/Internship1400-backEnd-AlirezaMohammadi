<?php

use App\Types\Mono;
use App\Types\Poly;
use App\Analyzing\Analyzor;
use App\Operations\Operations;
use App\Analyzing\RebuildString;
use App\Operations\MonoOperations;
use App\Operations\PolyOperations;

include './vendor/autoload.php';

$str = 'x-2x^3+3x^2-4x^5+6x^5';
$str2 = '7x-5x^3+4x^2+1-4x^5+x^3';

$poly = new Poly();
$poly2 = new Poly();

$RebuildString = new RebuildString();
$RebuildString2 = new RebuildString();

$strA = new Analyzor($poly,$RebuildString);
$strA2 = new Analyzor($poly2,$RebuildString2);

$poly = $strA->getPolyFromText($str);
$poly2 = $strA2->getPolyFromText($str2);

echo PHP_EOL;
echo 'first str : ' . $poly;
echo PHP_EOL;
echo 'second str: ' . $poly2;

$polyOperation = new PolyOperations((new Poly()),(new MonoOperations()));
$monoOperation = new MonoOperations();

$operations = new Operations((new Poly()),$polyOperation, $monoOperation);

$x = 1;
$x2 = 2;

echo PHP_EOL;
echo PHP_EOL;
echo "first str value for ($x) : " . $operations->answerForValue($poly, $x);
echo PHP_EOL;
echo "second str value for ($x2): " . $operations->answerForValue($poly2, $x2);

echo PHP_EOL;
echo PHP_EOL;
echo "first derivative : " . $operations->derivative($poly);
echo PHP_EOL;
echo "second derivative: " . $operations->derivative($poly2);

echo PHP_EOL;
echo PHP_EOL;
echo "str1 + str2 : " . $operations->sum($poly, $poly2);
echo PHP_EOL;
echo "str1 - str2 : " . $operations->sub($poly, $poly2);
echo PHP_EOL;
echo "str1 × str2 : " . $operations->mul($poly, $poly2);
echo PHP_EOL;