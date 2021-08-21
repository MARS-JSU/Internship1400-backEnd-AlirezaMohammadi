<?php

use App\Analyzing\Analyzor;
use App\Analyzing\RebuildString;
use App\Types\Poly;
use App\Operation\Operation;
use App\Operation\MonoOperation;
use App\Operation\PolyOperation;

include './vendor/autoload.php';

$str = 'x-2x^3+3x^2-4x^5+6x^5';
$str2 = '7x-5x^3+4x^2+1-4x^5+x^3';

$strA = new Analyzor(new Poly(),new RebuildString());
$strA2 = new Analyzor(new Poly(),new RebuildString());

$poly = $strA->getPolyFromText($str);
$poly2 = $strA2->getPolyFromText($str2);

echo PHP_EOL;
echo 'first str : ' . $poly;
echo PHP_EOL;
echo 'second str: ' . $poly2;

$polyOperation = new PolyOperation((new Poly()),(new MonoOperation()));
$monoOperation = new MonoOperation();

$operation = new Operation((new Poly()),$polyOperation, $monoOperation);

$x = 1;
$x2 = 2;

echo PHP_EOL;
echo PHP_EOL;
echo "first str value for ($x) : " . $operation->answerForValue($poly, $x);
echo PHP_EOL;
echo "second str value for ($x2): " . $operation->answerForValue($poly2, $x2);

echo PHP_EOL;
echo PHP_EOL;
echo "first derivative : " . $operation->derivative($poly);
echo PHP_EOL;
echo "second derivative: " . $operation->derivative($poly2);

echo PHP_EOL;
echo PHP_EOL;
echo "str1 + str2 : " . $operation->sum($poly, $poly2);
echo PHP_EOL;
echo "str1 - str2 : " . $operation->sub($poly, $poly2);
echo PHP_EOL;
echo "str1 × str2 : " . $operation->mul($poly, $poly2);
echo PHP_EOL;