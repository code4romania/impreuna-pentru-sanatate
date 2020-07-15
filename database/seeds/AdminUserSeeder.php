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
        /** @var User $admin */
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@helpforhealth.ro',
            'email_verified_at' => Carbon::now(),
//            'password' => Hash::make(Str::random(16))
            'password' => Hash::make('tesT')
        ]);

        $admin->assignRole('administrator');
    }
}
