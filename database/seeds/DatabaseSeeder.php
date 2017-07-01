<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'name' =>  'Admin',
            'id_no'=> '201400000',
            'email'=> 'admin@up.edu.ph',
            'password'=> bcrypt('sysadupvtc'),
            'isAdmin'=> true,
            'isActivated'=> true,
        ],
            ['name' =>  'User',
            'id_no'=> '201400001',
            'email'=> 'user@up.edu.ph',
            'password'=> bcrypt('201400001'),
            'isAdmin'=> false,
            'isActivated'=> true,
            ]
        ]);
    }
}
