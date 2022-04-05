<?php

namespace App\Imports;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
class InvoicesImport implements ToCollection, WithHeadingRow
{
      /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
         Validator::make($rows->toArray(), [
             '*.item_id' => 'required',
             '*.covenant_type' => 'required',
             '*.supplier_id' => 'required',
             '*.business_nature_id' => 'required',
             '*.date_invoice' => 'required',
             '*.price' => 'required',
             '*.amount' => 'required',
             '*.total' => 'required',
             '*.approved' => 'required',
             '*.user_id' => 'required',
       
         ])->validate();
  
        foreach ($rows as $row) {
            Invoice::create([
                'item_id' => $row['item_id'],
                'project_id' => $row['project_id'],
                'business_nature_id' => $row['business_nature_id'],
                'covenant_type' => $row['covenant_type'],
                'detection_number' => $row['detection_number'],
                'supplier_id' => $row['supplier_id'],
                'po_number' => $row['po_number'],
                'date_invoice' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_invoice'])),
                'invoice_number' => $row['invoice_number'],
                'specifications' => $row['specifications'],
                'price' => $row['price'],
                'amount' => $row['amount'],
                'total' => $row['total'],
                'value_tax_rate' => $row['value_tax_rate'],
                'value_tax' => $row['value_tax'],
                'overall_total' => $row['overall_total'],
                'other_discount' => $row['other_discount'],
                'total_after_discount' => $row['total_after_discount'],
                'restrained_type' => $row['restrained_type'],
                'nature_dealing_id' => $row['nature_dealing_id'],
                'expense_type' => $row['expense_type'],
                'tax_deduction' => $row['tax_deduction'],
                'tax_deduction_value' => $row['tax_deduction_value'],
                'net_total' => $row['net_total'],
                'business_insurance_rate' => $row['business_insurance_rate'],
                'business_insurance_value' => $row['business_insurance_value'],
                'net_total_after_business_insurance' => $row['net_total_after_business_insurance'],
                'notes' => $row['notes'],
                'approved' => $row['approved'],
                'user_id' => $row['user_id'],
            ]);
        }
    }
  
}