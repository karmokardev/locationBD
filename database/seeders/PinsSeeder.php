<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pin;
use App\Models\MembershipPlan;
use Illuminate\Support\Str;

class PinsSeeder extends Seeder
{
    public function run()
    {
        $plans = MembershipPlan::all();

        foreach ($plans as $plan) {
            for ($i = 1; $i <= 20; $i++) {
                Pin::create([
                    'code' => strtoupper(Str::random(12)),
                    'membership_plan_id' => $plan->id,
                    'used' => false,
                ]);
            }
        }
    }
}
