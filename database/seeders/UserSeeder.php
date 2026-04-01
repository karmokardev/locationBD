<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
  public function run(): void
  {
    $faker = Faker::create();
    // Ensure roles exist
    $roles = ['admin', 'customer', 'manager'];
    foreach ($roles as $role) {
      Role::firstOrCreate(['name' => $role]);
    }

    // Admin user
    $admin = User::create([
      'name' => 'Admin User',
      'email' => 'admin@ongsho.com',
      'phone' => '01700000000',
      'email_verified_at' => now(),
      'phone_verified_at' => now(),
      'password' => Hash::make('12345678'),
      'status' => 'Active',
    ]);
    $admin->assignRole('admin');

    $users = [];
    // Step 1: Create users without referrals
    for ($i = 1; $i <= 10; $i++) {
      $user = User::create([
        'name' => $faker->name(),
        'email' => 'user' . $i . '@ongsho.com',
        'phone' => $faker->unique()->phoneNumber(),
        'password' => Hash::make('12345678'),
        'status' => 'Active',
      ]);

      $user->assignRole('customer');

      $users[] = $user;
    }

    // Step 2: Assign referrals
    $customers = collect($users)->values()->shuffle();

    $totalUsers = $customers->count();
    $topFivePercent = max(1, floor($totalUsers * 0.05));
    $nextFifteenPercent = max(1, floor($totalUsers * 0.15));

    $groupA = $customers->slice(0, $topFivePercent);
    $groupB = $customers->slice($topFivePercent, $nextFifteenPercent);
    $groupC = $customers->slice($topFivePercent + $nextFifteenPercent);

    $updates = [];

    foreach ($customers as $user) {

      $rand = rand(1, 100);

      if ($rand <= 50 && $groupA->isNotEmpty()) {
        $referrer = $groupA->random();
      } elseif ($rand <= 80 && $groupB->isNotEmpty()) {
        $referrer = $groupB->random();
      } else {
        $referrer = $groupC->random();
      }

      if ($referrer->id !== $user->id) {
        $updates[] = [
          'id' => $user->id,
          'referred_by' => $referrer->id
        ];
      }
    }

    // 🔥 Bulk update
    foreach ($updates as $data) {
      User::where('id', $data['id'])
        ->update(['referred_by' => $data['referred_by']]);
    }

  }

}