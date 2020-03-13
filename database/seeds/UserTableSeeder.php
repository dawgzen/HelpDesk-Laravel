<?php

use App\Role;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =[
        ["Henk jan pieters", "henkjanpieters@gmail.kut", bcrypt("klant1"), Role::CUSTOMER] ,
        ["Jan henk pieters", "janhenkpieters@gmail.kut", bcrypt("klant2"), Role::CUSTOMER] ,
        ["piet henk janners", "piethenkjanners@gmail.kut", bcrypt("sukkel1"), Role::FIRSTLINE] ,
        ["Henk piet janners", "henkpietjanners@gmail.kut", bcrypt("sukkel2"), Role::FIRSTLINE] ,
        ["piet jan henkers", "pietjanhenkers@gmail.kut", bcrypt("sukkel3"), Role::SECONDLINE] ,
        ["jan piet henkers", "janpiethenkers@gmail.kut", bcrypt("sukkel4"), Role::SECONDLINE] ,
        ["Dawgsen", "dawgsen@gmail.kut", bcrypt("admin"), Role::ADMIN] ,
        ];

        $role_ids = DB::table('roles')->pluck("id", "name");

        foreach ($users as $user) {
            DB::insert(
                "INSERT INTO users (name, email, password, role_id, created_at, updated_at)
                VALUES(:name, :email, :password, :role_id, now(), now())"
                ,
            [
                "name" =>$user[0],
                "email" => $user[1],
                "password" => $user[2],
                "role_id" => $role_ids[$user[3]],
            ]

            );
        }
    }
}
