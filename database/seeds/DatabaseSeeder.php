<?php

use Database\Seeders\BankTableSeeder;
use Database\Seeders\BusinessNatureTableSeeder;
use Database\Seeders\DiscountTypeTableSeeder;
use Database\Seeders\ItemTableSeeder;
use Database\Seeders\NatureDealingTableSeeder;
use Database\Seeders\ProjectTableSeeder;
use Database\Seeders\SupplierTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(BankTableSeeder::class);
        $this->call(ItemTableSeeder::class);
        $this->call(BusinessNatureTableSeeder::class);
        $this->call(DiscountTypeTableSeeder::class);
        $this->call(NatureDealingTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(SupplierTableSeeder::class);
    }
}
