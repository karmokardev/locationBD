<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Commission;
use App\Models\User;

class CommissionSeeder extends Seeder
{
    public function run()
    {
        $users = User::whereNotNull('referred_by')
            ->with(['referrer.activeSubscription.membershipPlan', 'activeSubscription.membershipPlan'])
            ->get();

        $commissions = [];

        foreach ($users as $user) {

            if (!$user->referrer?->activeSubscription)
                continue;

            $referrerPlan = $user->referrer->activeSubscription->membershipPlan;
            $userPlan = $user->activeSubscription->membershipPlan ?? null;

            if (!$userPlan)
                continue;

            $amount = ($userPlan->price * $referrerPlan->commission_percent) / 100;

            $randomMonth = rand(1, 12);

            $randomDate = Carbon::create(
                now()->year,
                $randomMonth,
                rand(1, 28)
            );

            $commissions[] = [
                'user_id' => $user->referrer->id,
                'from_user_id' => $user->id,
                'membership_plan_id' => $userPlan->id,
                'amount' => $amount,
                'created_at' => $randomDate,
                'updated_at' => now(),
            ];
        }

        // 🔥 Single bulk insert
        Commission::insert($commissions);
    }
}
