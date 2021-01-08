<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ReferrerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('referrers')->insert([
            ['name' => 'tools.sendmarc.com', 'token' => Hash::make('f5af9f51-07e6-4332-8f1a-c0c11c1e3728')],
            ['name' => 'sendmarc.com', 'token' => Hash::make('f725f747-3a65-49f6-a231-3e8944ce464d')],
            ['name' => 'ultra-magnus.test', 'token' => Hash::make('f725f747-3a65-49f6-a231-3e8944ce464d4')]
        ]);
    }
}
