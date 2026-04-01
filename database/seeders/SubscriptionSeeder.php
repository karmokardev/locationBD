<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pin;
use App\Models\Subscription;
use App\Models\MembershipPlan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SubscriptionSeeder extends Seeder
{
    public function run()
    {
        $customers = User::role('customer')->get();
        $plans = MembershipPlan::where('status', 'Active')->get();

        $pins = [];
        $subscriptions = [];

        foreach ($customers as $customer) {

            $plan = $plans->random();

            $pins[] = [
                'code' => strtoupper(Str::random(12)),
                'membership_plan_id' => $plan->id,
                'used' => true,
                'used_by' => $customer->id,
                'created_at' => $customer->created_at,
                'updated_at' => $customer->updated_at,
            ];

            $subscriptions[] = [
                'user_id' => $customer->id,
                'membership_plan_id' => $plan->id,
                'amount' => $plan->price,
                'start_date' => now(),
                'status' => 'active',
                'created_at' => $customer->created_at,
                'updated_at' => $customer->updated_at,
            ];
        }

        Pin::insert($pins);
        Subscription::insert($subscriptions);
    }
}
