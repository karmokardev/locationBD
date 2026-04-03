<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class Thana extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    public static function allFromApi()
    {
        Cache::forget('api_thanas');

        return Cache::remember('api_thanas', 3600, function () {

            return Http::get('https://api.ongsho.com/api/v1/location/thana')->json();
        });
    }


    public static function findFromApi($id)
    {
        return collect(self::allFromApi())->firstWhere('id', $id);
    }

    public static function byDistrict($id)
    {
        return collect(self::allFromApi())->where('district_id', $id);
    }
    public static function byDistrictFromApi($id)
    {
        Cache::forget('api_thanas_by_district');

        return Cache::remember('api_thanas_by_district:' . $id, 3600, function () use ($id) {
            return Http::get('https://api.ongsho.com/api/v1/location/thana?district_id=' . $id)->json();
        });
    }

    public static function search($search)
    {
        return collect(self::allFromApi())
            ->filter(function ($thana) use ($search) {

                return stripos($thana['name_en'], $search) !== false ||
                    stripos($thana['name_bn'], $search) !== false;
            })
            ->values();
    }
}
