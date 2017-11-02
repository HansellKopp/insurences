<?php

use App\Branch;
use App\Company;
use App\Client;
use App\Insurance;
use App\Receipt;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // disable table constrains 
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // remove pre existing data if any
        Insurance::truncate();
        Receipt::truncate();
        Branch::truncate();
        Company::truncate();
        Client::truncate();

        // Start using Factories
        factory(Branch::class, 20)->create();
        factory(Company::class, 50)->create();
        factory(Client::class, 200)->create();
        factory(Insurance::class, 200)->create();
        factory(Receipt::class, 200)->create(); 
        // $this->call(UsersTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
