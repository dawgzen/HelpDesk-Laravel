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
            ["Eerstelijn", "Wachtend op eerstelijns"] ,
            ["Eerstelijn_toegewezen", "toegewezen op eerstelijns"] ,
            ["Tweedelijn", "Wachtend op eerstelijns"] ,
            ["Tweedelijn_toegewezen", "Toegewezen op eerstelijns"] ,
            ["Afgehandeld", "Ticket is afgehandeld"] ,
            ["UNASSIGNED", "unassigned"],
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
