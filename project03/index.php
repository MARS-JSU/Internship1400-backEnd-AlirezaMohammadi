<?php

use App\Analyzor;
use App\Math;
use App\MyString;
use App\Poly;

include './vendor/autoload.php';

$str = 'x-2x^3+3x^2-4x^5+6x^5';
$str2 = '7x-5x^3+4x^2+1-4x^5+x^3';

$poly = new Poly();
$poly2 = new Poly();

$myString = new MyString();
$myString2 = new MyString();

$strA = new Analyzor($poly,$myString);
$strA2 = new Analyzor($poly2,$myString2);

$poly = $strA->getPolyFromText($str);
$poly2 = $strA2->getPolyFromText($str2);

echo PHP_EOL;
echo 'first str : ' . $poly->toString();
echo PHP_EOL;
echo 'second str: ' . $poly2->toString();

$x = 1;
$x2 = 2;

$tempPoly = new Poly();
$math = new Math($tempPoly);

echo PHP_EOL;
echo PHP_EOL;
echo "first str value for ($x) : " . $math->answerForValue($poly, $x);
echo PHP_EOL;
echo "second str value for ($x2): " . $math->answerForValue($poly2, $x2);

echo PHP_EOL;
echo PHP_EOL;
echo "first derivative : " . $math->derivative($poly)->toString();
echo PHP_EOL;
echo "second derivative: " . $math->derivative($poly2)->toString();

echo PHP_EOL;
echo PHP_EOL;
echo "str1 + str2 : " . $math->sum($poly, $poly2)->toString();
echo PHP_EOL;
echo "str1 - str2 : " . $math->submission($poly, $poly2)->toString();
echo PHP_EOL;
echo "str1 × str2 : " . $math->multiplication($poly, $poly2)->toString();
echo PHP_EOL;