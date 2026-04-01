<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pin;
use App\Models\Subscription;
use Carbon\Carbon;

class PinRedeemSeeder extends Seeder
{
    public function run()
    {
        $users = User::all(); // সমস্ত ব্যবহারকারী
        $pins = Pin::where('used', false)->get();

        foreach ($users as $user) {
            if ($pins->isEmpty())
                break;

            // একটি র্যান্ডম পিন নিন
            $pin = $pins->random();

            // সাবস্ক্রিপশন তৈরি করুন
            $startDate = Carbon::now();
            $endDate = $pin->membershipPlan->duration === 'monthly'
                ? $startDate->copy()->addMonth()
                : $startDate->copy()->addYear();

            Subscription::create([
                'user_id' => $user->id,
                'membership_plan_id' => $pin->membership_plan_id,
                'start_date' => $startDate->toDateString(),
                'end_date' => $endDate->toDateString(),
                'status' => 'active',
            ]);

            // পিন মার্ক করুন ইউজড
            $pin->used = true;
            $pin->used_by = $user->id;
            $pin->save();

            // Remove used pin from collection
            $pins = $pins->where('id', '!=', $pin->id);
        }
    }
}
