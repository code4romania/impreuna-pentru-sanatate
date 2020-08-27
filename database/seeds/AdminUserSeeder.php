<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class AdminUserSeeder
 */
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (empty(User::all()->count())) {
            /** @var User $admin */
            $admin = User::create([
                'name' => 'Administrator',
                'email' => 'admin@helpforhealth.ro',
                'email_verified_at' => Carbon::now(),
//            'password' => Hash::make(Str::random(16))
                'password' => Hash::make('tesT'),
                'country_id' => 178,
                'city' => 'Bucuresti'
            ]);

            $admin->assignRole('administrator');

            /** @var User $admin */
            $admin2 = User::create([
                'name' => 'Marius Administrator',
                'email' => 'marius+admin@citizennext.ro',
                'email_verified_at' => Carbon::now(),
//            'password' => Hash::make(Str::random(16))
                'password' => Hash::make('tesT'),
                'country_id' => 178,
                'city' => 'Bucuresti'
            ]);

            $admin2->assignRole('administrator');

            /** @var User $host */
            $host = User::create([
                'name' => 'Host',
                'email' => 'host@helpforhealth.ro',
                'email_verified_at' => Carbon::now(),
//            'password' => Hash::make(Str::random(16))
                'password' => Hash::make('tesT'),
                'country_id' => 178,
                'city' => 'Bucuresti'
            ]);

            $host->assignRole('host');
        }
    }
}
