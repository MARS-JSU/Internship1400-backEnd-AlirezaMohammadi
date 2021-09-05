<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Poly\Analyzing\Analyzor;
use App\Http\Controllers\Poly\Operation\PolyOperation;
use App\Http\Controllers\Poly\Types\Poly;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('poly')->group(function () {
    // Route::get('/{analyzor}',function (Analyzor $analyzor) {
    //     dd($analyzor);
    // });
    // Route::get('/{Analyzor}',[Poly::class, 'test']);
    // Route::get('derivate',);
    // Route::get('calculate/{x}',);
    // Route::get('sum',);
    // Route::get('sub',);
    // Route::get('mul',);
});

Route::get('/', function () {
    $str = 'x-2x^3+3x^2-4x^5+6x^5';
    $str2 = '7x-5x^3+4x^2+1-4x^5+x^3';

    $strA = new Analyzor();
    $strA2 = new Analyzor();

    $poly = $strA->getPolyFromText($str);
    $poly2 = $strA2->getPolyFromText($str2);

    return 'first str : ' . $poly;
    echo PHP_EOL;
    echo 'second str: ' . $poly2;
    echo PHP_EOL;


    $poly->simplify();
    $poly->ordering();
    echo PHP_EOL;
    echo 'first str : ' . $poly;
    $poly2->simplify();
    $poly2->ordering();
    echo PHP_EOL;
    echo 'second str : ' . $poly2;

    $operation = new PolyOperation();

    $x = 1;
    $x2 = 2;

    echo PHP_EOL;
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
    return view('welcome');
});
// Route::get('x', function () {
//     $x = 10;
//     $y = 12;
//     print_r(compact('x','y'));
// });
// Route::get('xx', function () {
//     $poly = new Poly([
//         [['coefficient'] => +1, ['power'] => 1],
//         [['coefficient'] => +1, ['power'] => 1],
//         [['coefficient'] => +1, ['power'] => 1],
//         [['coefficient'] => +1, ['power'] => 1],
//         [['coefficient'] => +1, ['power'] => 1]
//     ]);
// });