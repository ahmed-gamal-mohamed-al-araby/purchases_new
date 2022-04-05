<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $supplier = Supplier::create([
            'name_en' => '0',
            'name_ar' => '0',
            'type' => 'without',
            'nat_tax_number' => '0',
          
        ]);

    }
}
