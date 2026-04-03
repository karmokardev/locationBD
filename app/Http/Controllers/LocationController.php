<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function locations(Request $request) {
        $divisions = collect(Division::allFromApi());
        $districts = collect(District::allFromApi());
        $thanas = collect(Thana::allFromApi());

        $result = $divisions->map(function ($division) use ($districts, $thanas) {
            $division['districts'] = $districts->where('division_id', $division['id'])->values()->map(function ($district) use ($thanas) {
                $district['thanas'] = $thanas->where('district_id', $district['id'])->values();
                return $district;
            });
            return $division;
        });

        return response()->json($result);
    }
}
