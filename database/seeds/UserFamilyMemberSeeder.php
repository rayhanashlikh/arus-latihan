<?php

use Illuminate\Database\Seeder;

class UserFamilyMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_family_members')->insert([
            'user_id' => 2,
            'name' => 'Anung',
            'nik' => 123456789,
            'gender' => 'male',
            'date_of_birth' => '2019-10-10',
            'place_of_birth' => 'Semarang'
        ]);
    }
}
