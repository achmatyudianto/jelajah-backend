<?php

namespace App\Http\Controllers;

use App\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function index(Request $request)
    {
        $people = People::all();

        return response()->json(['data' => $people], 200);
    }

    public function store(Request $request)
    {
        $people = strtoupper($request->people);
        $isCity = false;
        $age = '0';
        $name = '';
        $city = '';
        for ($a = 0; $a < strlen($people); $a++) {
            if ($people[$a] == '0' || $people[$a] == '1' || $people[$a] == '2' || $people[$a] == '3' || $people[$a] == '4' || $people[$a] == '5' || $people[$a] == '6' || $people[$a] == '7' || $people[$a] == '8' || $people[$a] == '9') {
                $age = $age . $people[$a];
                $isCity = true;
            } else {
                if ($isCity) {
                    $city = $city . $people[$a];
                } else {
                    $name = $name . $people[$a];
                }
            }
        }

        $city = str_replace("TAHUN ", "", $city);
        $city = str_replace("THN ", "", $city);
        $city = str_replace("TH ", "", $city);

        $people = People::create([
            'name' => $name,
            'age' => (int)$age,
            'city' => $city,
        ]);

        return response()->json(['data' => $people], 200);
    }
}
