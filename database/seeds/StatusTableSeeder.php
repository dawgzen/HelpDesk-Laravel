<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status =[
            ["FIRSTLINE", "Wachtend op eerstelijns"] ,
            ["FIRSTLINE_ASSIGNED", "toegewezen op eerstelijns"] ,
            ["SECONDLINE", "Wachtend op eerstelijns"] ,
            ["SECONDLINE_ASSIGNED", "Toegewezen op eerstelijns"] ,
            ["DONE", "Ticket is afgehandeld"] ,
        ];
        foreach ($status as $stats) {
            DB::insert(
                "INSERT INTO statuses(name, description)
                      VALUES (:name , :description)"
                ,
                [
                    "name" => $stats[0],
                    "description"=> $stats[1]
                ]
            );
        }
    }

}
