<?php

namespace App\Http\Controllers\AccountStatement;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\PaymentInvoice;
use App\Models\Supplier;
use Illuminate\Http\Request;

class AccountStatementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('reports.report_accountStatement', compact("suppliers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $sum_invoice_value = 0;
        $sum_value_tax = 0;
        $sum_tax_deduction_value = 0;
        $sum_other_discount = 0;
        $sum_business_insurance_value = 0;
        $sum_net_total = 0;
        $Opening_balance = 0;
        $total_Opening_balance = 0;
        $total = 0;
        $newarray = array();
        //  return $request->supplier_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $supplier = Supplier::select("name_ar","nat_tax_number")->where("id", $request->supplier_id)->first();
        if (!$request->from_date && !$request->to_date) {
            $Opening_balance = 0;
            $invoices = Invoice::where("supplier_id", $request->supplier_id)->get();
            $payments = PaymentInvoice::where("supplier_id", $request->supplier_id)->get();
        } elseif ($request->from_date && !$request->to_date) {
            $invoices = Invoice::where("supplier_id", $request->supplier_id)->where("date_invoice", ">=", $request->from_date)->get();
            $payments = PaymentInvoice::where("supplier_id", $request->supplier_id)->where("date_payment", ">=", $request->from_date)->get();
            $invoices_Opening_balance = Invoice::where("supplier_id", $request->supplier_id)->where("date_invoice", "<", $request->from_date)->get();
            $payments_Opening_balance = PaymentInvoice::where("supplier_id", $request->supplier_id)->where("date_payment", "<", $request->from_date)->get();

            $t = collect($invoices_Opening_balance)->merge(collect($payments_Opening_balance));
            foreach ($t as $key => $value) {
                foreach (json_decode($value) as $key1 => $value1) {
                    if ($key1 === 'date_payment') {
                        $key1 = 'date_invoice';
                    }
                    $newarray[$key][$key1] = $value1;
                }
            }
            $all_data = $newarray;
            usort($all_data, function ($a, $b) {

                return ($a["date_invoice"] > $b["date_invoice"]);
            });
            foreach ($newarray as $key => $signal_data) {
                if (isset($signal_data["expense_type"]) && $signal_data["expense_type"] == "cashe") {
                    $total_Opening_balance = $total_Opening_balance - filter_var($signal_data["total"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                        + filter_var($signal_data["value_tax"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                        + filter_var($signal_data["tax_deduction_value"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                        + filter_var($signal_data["other_discount"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                        + filter_var($signal_data["net_total"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                } elseif (isset($signal_data["expense_type"]) && $signal_data["expense_type"] == "okay") {
                    $total_Opening_balance = $total_Opening_balance - filter_var($signal_data["total"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                        + filter_var($signal_data["value_tax"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                        + filter_var($signal_data["tax_deduction_value"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                        + filter_var($signal_data["other_discount"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                } else {
                    $total_Opening_balance = $total_Opening_balance + $signal_data["value"];
                }
            }
        } elseif (!$request->from_date && $request->to_date) {
            $invoices = Invoice::where("supplier_id", $request->supplier_id)->where("date_invoice", "<=", $request->to_date)->get();
            $payments = PaymentInvoice::where("supplier_id", $request->supplier_id)->where("date_payment", "<=", $request->to_date)->get();
        } else {
            $invoices = Invoice::where("supplier_id", $request->supplier_id)->where("date_invoice", ">=", $request->from_date)->where("date_invoice", "<=", $request->to_date)->get();
            $payments = PaymentInvoice::where("supplier_id", $request->supplier_id)->where("date_payment", ">=", $request->from_date)->where("date_payment", "<=", $request->to_date)->get();
            $invoices_Opening_balance = Invoice::where("supplier_id", $request->supplier_id)->where("date_invoice", "<", $request->from_date)->get();
            $payments_Opening_balance = PaymentInvoice::where("supplier_id", $request->supplier_id)->where("date_payment", "<", $request->from_date)->get();

            $t = collect($invoices_Opening_balance)->merge(collect($payments_Opening_balance));
            foreach ($t as $key => $value) {
                foreach (json_decode($value) as $key1 => $value1) {
                    if ($key1 === 'date_payment') {
                        $key1 = 'date_invoice';
                    }
                    $newarray[$key][$key1] = $value1;
                }
            }
            $all_data = $newarray;
            usort($all_data, function ($a, $b) {

                return ($a["date_invoice"] > $b["date_invoice"]);
            });
            foreach ($newarray as $key => $signal_data) {
                if (isset($signal_data["expense_type"]) && $signal_data["expense_type"] == "cashe") {
                    $total_Opening_balance = $total_Opening_balance - filter_var($signal_data["total"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                        + filter_var($signal_data["value_tax"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                        + filter_var($signal_data["tax_deduction_value"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                        + filter_var($signal_data["other_discount"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                        + filter_var($signal_data["net_total"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                } elseif (isset($signal_data["expense_type"]) && $signal_data["expense_type"] == "okay") {
                    $total_Opening_balance = $total_Opening_balance - filter_var($signal_data["total"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                        + filter_var($signal_data["value_tax"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                        + filter_var($signal_data["tax_deduction_value"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                        + filter_var($signal_data["other_discount"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                } else {
                    $total_Opening_balance = $total_Opening_balance + $signal_data["value"];
                }
            }
        }

        $t = collect($invoices)->merge(collect($payments));
        foreach ($t as $key => $value) {
            foreach (json_decode($value) as $key1 => $value1) {
                if ($key1 === 'date_payment') {
                    $key1 = 'date_invoice';
                }
                $newarray[$key][$key1] = $value1;
            }
        }
        $all_data = $newarray;

        //  $all_data = $all_data->sortBy('date_invoice');
        //  $all_data = $all_data->sortBy('date_invoice', SORT_REGULAR, true);

        usort($all_data, function ($a, $b) {

            return ($a["date_invoice"] > $b["date_invoice"]);
        });

        // return $all_data;
        foreach ($all_data as $key => $value) {

            if (isset($value["total"])) {
                $sum_invoice_value += filter_var($value["total"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            }
            if (isset($value["value_tax"])) {
                $sum_value_tax +=  filter_var($value["value_tax"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            }
            if (isset($value["tax_deduction_value"])) {
                $sum_tax_deduction_value +=  filter_var($value["tax_deduction_value"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            }
            if (isset($value["other_discount"])) {
                $sum_other_discount += filter_var($value["other_discount"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            }
            if (isset($value["business_insurance_value"])) {
                $sum_business_insurance_value += filter_var($value["business_insurance_value"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            }

            if (isset($value["net_total"]) && $value["expense_type"] == "cashe") {
                $sum_net_total += filter_var($value["net_total"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            }
            if (isset($value["value"])) {
                $sum_net_total += filter_var($value["value"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            }
        }
        // $all_data->values()->all();
        $total = $total_Opening_balance;
        return view('reports.table_report_supplier_statement', compact("from_date", "to_date", "total_Opening_balance", "supplier", "all_data", "total", "sum_invoice_value", "sum_value_tax", "sum_tax_deduction_value", "sum_other_discount", "sum_business_insurance_value", "sum_net_total"));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
