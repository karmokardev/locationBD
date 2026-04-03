<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class Division extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    public static function allFromApi()
    {
        Cache::forget('api_divisions');

        return Cache::remember('api_divisions', 3600, function () {

            return Http::get('https://api.ongsho.com/api/v1/location/division')->json();
        });
    }


    public static function findFromApi($id)
    {
        return collect(self::allFromApi())->firstWhere('id', $id);
    }

    public static function search($search)
    {
        return collect(self::allFromApi())
            ->filter(function ($division) use ($search) {

                return stripos($division['name_en'], $search) !== false ||
                    stripos($division['name_bn'], $search) !== false;
            })
            ->values();
    }
}
