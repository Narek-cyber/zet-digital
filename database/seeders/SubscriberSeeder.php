<?php

namespace Database\Seeders;

use App\Models\Subscriber;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Subscriber::query()->count() == 0) {
            $users = User::query()->pluck('id')->toArray();
            foreach($users as $key => $user) {
                Subscriber::query()->create([
                    'user_id' => $user,
                    'website_id' => $key + 1,
                    'email' => Factory::create()->unique()->email,
                ]);
            }
        }
    }
}
