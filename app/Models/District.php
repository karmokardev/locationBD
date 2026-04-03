<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class District extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    public static function allFromApi()
    {
        Cache::forget('api_districts');

        return Cache::remember('api_districts', 3600, function () {
            return Http::get('https://api.ongsho.com/api/v1/location/district')->json();
        });
    }


    public static function findFromApi($id)
    {
        return collect(self::allFromApi())->firstWhere('id', $id);
    }
    public static function byDivision($id)
    {
        return collect(self::allFromApi())->where('division_id', $id);
    }

    public static function byDivisionFromApi($id)
    {
        Cache::forget('api_districts_by_division');

        return Cache::remember('api_districts_by_division:' . $id, 3600, function () use ($id) {
            return Http::get('https://api.ongsho.com/api/v1/location/district?division_id=' . $id)->json();
        });
    }

    public static function search($search)
    {
        return collect(self::allFromApi())
            ->filter(function ($district) use ($search) {

                return stripos($district['name_en'], $search) !== false ||
                    stripos($district['name_bn'], $search) !== false;
            })
            ->values();
    }
}
