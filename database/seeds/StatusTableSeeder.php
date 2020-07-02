<?php

use App\Status;
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
            [Status::FIRSTLINE, "Ticket waiting for assigning"] ,
            [Status::FIRSTLINE_ASSIGNED, "Ticket assigned to firstline"] ,
            [Status::SECONDLINE, "Ticket waiting for assigning"] ,
            [Status::SECONDLINE_ASSIGNED, "Ticket assigned to secondline"] ,
            [Status::DONE, "Ticket handled"] ,
        ];

        foreach ($status as $stats) {
            DB::insert(
                "INSERT INTO statuses(name, description, created_at, updated_at)
                      VALUES (:name , :description, now(), now())"
                ,
                [
                    "name" => $stats[0],
                    "description"=> $stats[1]
                ]
            );
        }
    }
}
