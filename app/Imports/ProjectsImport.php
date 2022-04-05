<?php
  
namespace App\Imports;

use App\Models\Supplier;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
  
class ProjectsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
         Validator::make($rows->toArray(), [
             '*.type' => 'required',
             '*.name_ar' => 'required',
             '*.name_en' => 'required',
             '*.nat_tax_number' => 'required|numeric|unique:suppliers',

         ])->validate();
  
        foreach ($rows as $row) {
            Supplier::create([
                'type'     => $row['type'],
                'name_ar'    => $row['name_ar'],
                'name_en'    => $row['name_en'],
                'nat_tax_number'    => $row['nat_tax_number']
            ]);
        }
    }
  
}