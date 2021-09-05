<?php 
namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\V1\Types\Mono;
use App\Http\Controllers\V1\Types\Poly;

class PolyService
{
    public function makePolyByRequestMonos(Request $request, string $monosName = 'monos') :Poly
    {
        $poly = new Poly();
        foreach ($request->$monosName as $mono) {
            $poly->addMono(new Mono($mono['coefficient'],$mono['power']));
        }   
        return $poly;
    }

    public function getArrayMonos(Poly $poly) :array
    {
        $monos = [];
        foreach ($poly->getMonos() as $mono) {
            $monos[] = [
                'coefficient' => $mono->getCoefficient(),
                'power' => $mono->getPower()
            ];
        }
        return $monos;
    }
}