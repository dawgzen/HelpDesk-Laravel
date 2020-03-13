<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [\App\Role::CUSTOMER],
            [\App\Role::FIRSTLINE],
            [\App\Role::SECONDLINE],
            [\App\Role::ADMIN],
        ];


        foreach ($roles as $role) {
            DB::insert(
                "INSERT INTO roles(name, created_at, updated_at)
                      VALUES (:name, now(), now())"
                ,
                [
                    "name" => $role[0]
                ]
            );
        }
    }
}
