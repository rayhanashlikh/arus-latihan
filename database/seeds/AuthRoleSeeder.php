<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class AuthRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctorRole = new Role;
        $doctorRole->name = 'doctor';
        $doctorRole->description = 'Role for Doctor';
        $doctorRole->save();

        $patientRole = new Role;
        $patientRole->name = 'patient';
        $patientRole->description = 'Role for Patient';
        $patientRole->save();

        $doctor1 = new User;
        $doctor1->name = 'Rayhan';
        $doctor1->email = 'rayhanind24@gmail.com';
        $doctor1->password = bcrypt('12345678');
        $doctor1->phone = '085727746848';
        $doctor1->nik = 123123123;
        $doctor1->save();
        $doctor1->attachRole($doctorRole);

        $patient1 = new User;
        $patient1->name = 'Alan';
        $patient1->email = 'alan@gmail.com';
        $patient1->password = bcrypt('12345678');
        $patient1->phone = '085898391923';
        $patient1->nik = 321321321;
        $patient1->save();
        $patient1->attachRole($patientRole);
    }
}
