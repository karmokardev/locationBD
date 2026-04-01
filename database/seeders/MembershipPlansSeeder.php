<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MembershipPlan;

class MembershipPlansSeeder extends Seeder
{
  public function run()
  {
    MembershipPlan::insert([
      [
        'name' => 'Silver Membership',
        'price' => 480,
        'commission_percent' => 15,
        'description' => 'Silver',
        'status' => 'Active',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Gold Membership',
        'price' => 980,
        'commission_percent' => 20,
        'description' => 'Gold',
        'status' => 'Active',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Diamond Membership',
        'price' => 1480,
        'commission_percent' => 25,
        'description' => 'Diamond',
        'status' => 'Active',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Platinum Membership',
        'price' => 1980,
        'commission_percent' => 30,
        'description' => 'Platinum',
        'status' => 'Active',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'General Membership',
        'price' => 2480,
        'commission_percent' => 35,
        'description' => 'General',
        'status' => 'Active',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
